<?php

namespace frontend\controllers;

use Yii;
use app\models\ContratoInquilino;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ContratoinquilinoController implements the CRUD actions for ContratoInquilino model.
 */
class ContratoinquilinoController extends Controller
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
     * Lists all ContratoInquilino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ContratoInquilino::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContratoInquilino model.
     * @param integer $id_contrato
     * @param integer $id_inquilino
     * @return mixed
     */
    public function actionView($id_contrato, $id_inquilino)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_contrato, $id_inquilino),
        ]);
    }

    /**
     * Creates a new ContratoInquilino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ContratoInquilino();
        
        if ($model->load(Yii::$app->request->post()))
        {
            if(Yii::$app->request->post('status') == 'true'){
             $this->findModel($model->id_contrato, $model->id_inquilino)->delete();
              echo json_encode('Inquilino Removido com sucesso');
            }else
            {
                $model->save();
            echo json_encode('Inquilino Adicionado com sucesso');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ContratoInquilino model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_contrato
     * @param integer $id_inquilino
     * @return mixed
     */
    public function actionUpdate($id_contrato, $id_inquilino)
    {
        $model = $this->findModel($id_contrato, $id_inquilino);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_contrato' => $model->id_contrato, 'id_inquilino' => $model->id_inquilino]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ContratoInquilino model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_contrato
     * @param integer $id_inquilino
     * @return mixed
     */
    public function actionDelete($id_contrato, $id_inquilino)
    {
        $this->findModel($id_contrato, $id_inquilino)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ContratoInquilino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_contrato
     * @param integer $id_inquilino
     * @return ContratoInquilino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_contrato, $id_inquilino)
    {
        if (($model = ContratoInquilino::findOne(['id_contrato' => $id_contrato, 'id_inquilino' => $id_inquilino])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
