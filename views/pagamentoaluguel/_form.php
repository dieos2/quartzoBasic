<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Contrato;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\pagamentoAluguel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagamento-aluguel-form">

    <?php $form = ActiveForm::begin(['id' => 'frm-pagamentoAluguel','action' => '/pagamentoaluguel/create']); ?>

    <div class="row">
    <div class="col-sm-12">
    <?= $form->field($model, 'id_inquilino')->dropDownList(ArrayHelper::map(Contrato::findOne($model->id_contrato)->getInquilinos()->all(),'id','nome')) ?>
        </div>
</div>
<div class="row">
    <div class="col-sm-6">
    <?= $form->field($model, 'valor')->textInput(['maxlength' => 10]) ?>
        </div>

    <div class="col-sm-6">
    <?= $form->field($model, 'acrescimo')->textInput(['maxlength' => 10]) ?>
        </div>
</div>
<div class="row">
    <div class="col-sm-12">
    <?= $form->field($model, 'data')->textInput(array( 'data-provide'=>"datepicker", 'value'=> $model->isNewRecord ? date('d/m/Y') : $model->data )) ?>
        </div>
</div>

<div class="row">
    <div class="col-sm-12">
    <?= $form->field($model, 'id_contrato')->hiddenInput()->label(false) ?>
         <?= $form->field($model, 'id_despesa')->hiddenInput()->label(false) ?>
        
    </div>
</div>

   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
