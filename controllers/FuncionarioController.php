<?php

namespace frontend\controllers;

use Yii;
use app\models\Funcionario;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FuncionarioController implements the CRUD actions for Funcionario model.
 */
class FuncionarioController extends Controller
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
     * Lists all Funcionario models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Funcionario::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Funcionario model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
          $model->data_admissao = Setup::DepoisDePegar($model->data_admissao);
            
            $model->data_demissao = Setup::DepoisDePegar($model->data_demissao);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Funcionario model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Funcionario();

        if ($model->load(Yii::$app->request->post())) {
            
            $model->data_admissao = Setup::AntesDeSalvar($model->data_admissao);
            
            $model->data_demissao = Setup::AntesDeSalvar($model->data_demissao);
            //Cria Usuario
            $modelUser = new \frontend\models\SignupForm();
            $username = explode(' ', $model->nome, -1);
            $modelUser->username = strtolower($username[0].end($username));
            $modelUser->password ='123456';
            $modelUser->email = $model->email;
           if ($user = $modelUser->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                $model->id = $user->id;
                 if($model->save()) {
                
                 return $this->redirect(['index']);
                 
                 }
                }
           }   
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Funcionario model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->data_admissao = Setup::DepoisDePegar($model->data_admissao);
        $model->data_demissao = Setup::DepoisDePegar($model->data_demissao);
        if ($model->load(Yii::$app->request->post())) {
            $model->data_admissao = Setup::AntesDeSalvar($model->data_admissao);
            $model->data_demissao = Setup::AntesDeSalvar($model->data_demissao);
            
                  if($model->save()) {
                
                    return $this->redirect(['index']);
           }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Funcionario model.
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
     * Finds the Funcionario model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Funcionario the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Funcionario::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
