<?php

namespace frontend\controllers;
 
use Yii;
use app\models\Contrato;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Setup;

/**
 * ContratoController implements the CRUD actions for Contrato model.
 */
class ContratoController extends Controller {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'delete' => [ 
										'post' 
								] 
						] 
				] 
		];
	}
	
	/**
	 * Lists all Contrato models.
	 * 
	 * @return mixed
	 */
	public function actionIndex() {
		$query = Contrato::find ();
		$dataProvider = new ActiveDataProvider ( [ 
				
				'query' => $query 
		]
		 );
		
		return $this->render ( 'index', [ 
				'dataProvider' => $dataProvider 
		] );
	}
	
	/**
	 * Displays a single Contrato model.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionView($id, $id_contrato = 0, $mes = 0, $ano = 0) {
            ($mes == 0 ? $mes = Setup::ExtraiMes(date('Y-m-d')) : $mes = $mes);
            ($ano == 0 ? $ano = Setup::ExtraiAno(date('Y-m-d')) : $ano = $ano);
            
            $dataInicio = date('Y-m-d', strtotime($ano.'-'.$mes.'-01'));
            $dataFim = date('Y-m-d', strtotime($ano.'-'.$mes.'-31'));
             /**
            *Pega o contrato
	 */
            $contrato = $this->findModel ( $id );
           
             /**
            *Pega todas as despesas
	 */
            $array  = $contrato->getDespesas();
            
             /**
            *Filtra pelas datas (tem que ser assim repetindo porque o query fica uma só usando o andQuere e as despesas acaba sendo influenciado pelo aluguel)
	 */
           
            
            
            $alugueis = $array;
            $despesas = $array;   
             /**
            *Pega só os alugueis
	 */
        $alugueis  = $alugueis->Where(['=','id_categoria', 4])->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->all();
         /**
            *Pega só as despesas
	 */
        
        $despesas = $despesas->Where(['<>','id_categoria', 4])->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->all();
         /**
          * Pega os pagamentos
	 */
        $pagamentos = $contrato->getPagamentos()->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->all();
         /**
          * Pega os pagamentos de alugueis
	 */
        $pagamentosAluguel= $contrato->getPagamentosAlugel()->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->all();
            return $this->render ( 'view', [ 
				'model' => $contrato ,
                                'alugueis' => $alugueis,
                                'despesas' => $despesas,
                                'pagamentos' => $pagamentos,
                                'pagamentosAluguel' =>$pagamentosAluguel,
                                'datainicio' => $dataInicio,
                                'datafim' => $dataFim,
                                'mes'=> $mes,
                                'ano' => $ano
		] );
	}
	
	/**
	 * Creates a new Contrato model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @return mixed
	 */
	public function actionCreate() {
		$model = new Contrato ();
		
		if ($model->load ( Yii::$app->request->post () )) {
			$model->data_inicio = Setup::AntesDeSalvar ( $model->data_inicio );
			$model->data_termino = Setup::AntesDeSalvar ( $model->data_termino );
			if ($model->save ()) {
				return $this->redirect ( [ 
						'update',
						'id' => $model->id
				] );
			}
		} else {
			
			return $this->render ( 'create', [ 
					'model' => $model 
			]
			 );
		}
	}
	
	/**
	 * Updates an existing Contrato model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionUpdate($id) {
		$model = $this->findModel ( $id );
		$model->data_inicio = Setup::DepoisDePegar ( $model->data_inicio );
		
		$model->data_termino = Setup::DepoisDePegar ( $model->data_termino );
		if ($model->load ( Yii::$app->request->post () ) && $model->save ()) {
			return $this->redirect ( [ 
					'view',
					'id' => $model->id 
			] );
		} else {
			
			return $this->render ( 'update', [ 
					'model' => $model 
			]
			 );
		}
	}
	
	/**
	 * Deletes an existing Contrato model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * 
	 * @param integer $id        	
	 * @return mixed
	 */
	public function actionDelete($id) {
		$this->findModel ( $id )->delete ();
		
		return $this->redirect ( [ 
				'index' 
		] );
	}
	
	/**
	 * Finds the Contrato model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * 
	 * @param integer $id        	
	 * @return Contrato the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id) {
		if (($model = Contrato::findOne ( $id )) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException ( 'The requested page does not exist.' );
		}
	}
}
