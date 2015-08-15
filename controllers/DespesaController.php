<?php

namespace frontend\controllers;

use Yii;
use app\Models\despesa;
use app\Models\sala;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Contrato;
use yii\web\Response;

/**
 * DespesaController implements the CRUD actions for despesa model.
 */
class DespesaController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all despesa models.
     * @return mixed
     */
   public function actionIndex($id = 0, $dataIni = 0, $dataFim =0 , $id_titulo = 0)
    {
       
         $dataProvider = Despesa::find()->groupBy(['data', 'id_titulo_despesa']);
              
        
       if($id != 0){
        $dataProvider = $dataProvider->where(['=', 'id_categoria', $id]);
        
        
       }
       if($dataIni != 0){
           // date to search  
        $date = Setup::AntesDeSalvar($dataIni); // the date
       
        $end_time = Setup::AntesDeSalvar(date('j/m/Y'));

       
           $dataProvider = $dataProvider->where('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $date,
            ':end_time' => $end_time));
       }
        if($dataFim != 0){
            $date = Setup::AntesDeSalvar('01/01/1970'); // the date
       
            $end_time = Setup::AntesDeSalvar($dataFim);
            $dataProvider = $dataProvider->where('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $date,
            ':end_time' => $end_time));
       }
        if($id_titulo != 0){
           $dataProvider = $dataProvider->where(['=', 'id_titulo_despesa', $id_titulo]);
       }
            $dataProvider = new ActiveDataProvider([
            'query' => $dataProvider
        ]);
       
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'id_categoria' => $id,
            'dataIni' =>$dataIni ,
            'dataFim' => $dataFim,
            'id_titulo' => $id_titulo
        ]);
    }

    /**
     * Displays a single Despesa model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
 public function actionDetalhes($id)
    {   $request = Yii::$app->request;
       $model = $this->findModel($id);
       $data = $model->data;
       $id_titulo_despesa = $model->id_titulo_despesa;
         if($request->isAjax){
                  Yii::$app->response->format = Response::FORMAT_JSON;
                   $modelList = \app\Models\Despesa::find()->where(['=','data', $data])->andWhere(['=','id_titulo_despesa', $id_titulo_despesa])->all();
                   $salas = [];
                  
                   foreach ($modelList as $value) {
                        $sala = [];
                       $item = Sala::findOne($value->id_sala);
                       array_push($sala,$item->numero,$value->valor ); 
                       array_push($salas, $sala);
                   }
                  return $salas;
            }
      
    }
    /**
     * Creates a new Despesa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = 0)
    {   $request = Yii::$app->request;
        $model = new Despesa();
        if($id != 0){
        $model->id_categoria =$id;
        }
        if ($model->load(Yii::$app->request->post()))
        {   
           
            if($model->id_categoria != 3){
                //pega as salas com os seus contratos ativos
                $salaAlugadas = Contrato::find()->where(['=', 'ativo', 1])->all();
                $count = count($salaAlugadas);
                $model->valor = $model->valor/$count;
                
                //divide o valor da despesa para os numero de salas
                foreach ($salaAlugadas as $item) {
                    $modelContrato = Contrato::find()->where(['=','id_sala', $item->id_sala])->andWhere(['=','ativo', 1])->one();
            
                     $modelIndividual = new Despesa();
                    
                     $modelIndividual->id_sala = $item->id_sala;
                     $modelIndividual->valor = $model->valor;
                      $modelIndividual->data = Setup::AntesDeSalvar ( $model->data);
                       $modelIndividual->obs = $model->obs;
                        $modelIndividual->id_categoria = $model->id_categoria;
                         $modelIndividual->id_modalidade = $model->id_modalidade;
                          $modelIndividual->descricao = $model->descricao;
                           $modelIndividual->id_titulo_despesa = $model->id_titulo_despesa;
                           $modelIndividual->id_contrato =  $modelContrato->id;
                     $modelIndividual->save();
                     \app\models\Montante::Atualiza($modelIndividual->id);
                     continue;
                     
                }
               
                 return $this->redirect(['index', 'id' => $model->idCategoria->id]);
            }
             $modelContrato = Contrato::find()->where(['=','id_sala', $model->id_sala])->andWhere(['=','ativo', 1])->one();
             $model->data = Setup::AntesDeSalvar ( $model->data);
                $model->id_contrato = $modelContrato->id;
                if ($model->save()) {
                    \app\models\Montante::Atualiza($model->id);
                    if($request->isAjax){
                 Yii::$app->response->format = Response::FORMAT_JSON;
                 
                return $model;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }} else if($request->isAjax){
                 Yii::$app->response->format = Response::FORMAT_JSON;
                 
                return $model;
            }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing despesa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing despesa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the despesa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return despesa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = despesa::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
