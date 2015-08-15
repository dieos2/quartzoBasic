<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Sala;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Despesa */
/* @var $form yii\widgets\ActiveForm */
$salas= Sala::find()->all();
$listData=ArrayHelper::map($salas,'id','numero');

$categorias = \app\models\CategoriaDespesa::find()->all();
$listCategorias = ArrayHelper::map($categorias,'id','categoria');

$titulos = \app\models\TituloDespesa::find()->all();
$listTitulos = ArrayHelper::map($titulos,'id','titulo');

$modalidade = \app\models\Modalidade::find()->all();
$listModalidade = ArrayHelper::map($modalidade, 'id', 'nome');
?>


		<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">	
			<div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'frm-despesa','action' => '/despesa/create']); ?>
                           
						<?= $form->field($model,'id_categoria')->hiddenInput()->label(false); ?>
                            <?= $form->field($model,'id_sala')->hiddenInput()->label(false); ?>
					<?= $form->field($model,'id_contrato')->hiddenInput()->label(false); ?>
                            <?= $form->field($model,'id_modalidade')->hiddenInput()->label(false); ?>
					
						<div class="col-sm-12">
                                                     <label>Titulo</label>
    <?= $form->field($model, 'id_titulo_despesa' )->dropDownList($listTitulos)->label(false)  ?>
                                                </div>
                                        
                            			
						<div class="col-sm-6">    
                                                     <label>Valor</label>
    <?= $form->field($model, 'valor')->textInput(['maxlength' => 10])->label(false) ?>
  </div>
    
                                                    
						<div class="col-sm-6">
                                                     <label>Data</label>
    <?= $form->field($model, 'data')->textInput(array('class'=>'form-control input-sm', 'data-provide'=>"datepicker", 'value'=> $model->isNewRecord ? date('d/m/Y') : $model->data ))->label(false) ?>  </div>
     
 <div class="clear"></div>
					<br />
						<div class="col-sm-12">
                                                     <label>Observação</label>
    <?= $form->field($model, 'obs')->textInput(['maxlength' => 200])->label(FALSE) ?>  </div>
    

     
 

                                                    
                                                 
						<div class="col-sm-12">
                                                     <label>Descrição</label>
    <?= $form->field($model, 'descricao')->textInput(['maxlength' => 45])->label(FALSE) ?>  </div>
      
 
						
		
             
 <div class="clear"></div>
					<br />
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
                </div>    </div>    </div>
            