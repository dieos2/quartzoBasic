<?php

namespace frontend\controllers;

use Yii;
use app\models\Inquilino;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InquilinoController implements the CRUD actions for Inquilino model.
 */
class InquilinoController extends Controller {

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
     * Lists all Inquilino models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Inquilino::find(),
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inquilino model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inquilino model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inquilino();
        $request = Yii::$app->request;

        if ($model->load(Yii::$app->request->post())) {

            $modelUser = new \frontend\models\SignupForm();
            $username = explode(' ', $model->nome, -1);
            $modelUser->username = strtolower($username[0] . end($username));
            $modelUser->password = '123456';
            $modelUser->email = $model->email;
            if ($user = $modelUser->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    $model->id = $user->id;
                    if ($model->save()) {
                        if ($request->isAjax) {
                            Yii::$app->response->format = Response::FORMAT_JSON;
                            return $model;
                        }
                        return $this->redirect(['index']);
                    }
                }
            }
        } else {

            if ($request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;

                return $model;
            }
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Inquilino model.
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
     * Deletes an existing Inquilino model.
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
     * Finds the Inquilino model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inquilino the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inquilino::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
