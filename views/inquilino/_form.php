<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inquilino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inquilino-form">

    <?php $form =  ActiveForm::begin(['id' => 'frm-inquilino', 'action' => '/inquilino/create']); ?>

  
    <?= $form->field($model, 'nome')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'nacionalidade')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'estado_civil')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'profissao')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'identidade')->textInput() ?>

    <?= $form->field($model, 'cpf')->textInput() ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'bairro')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'fone')->textInput(['maxlength' => 12]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'obs')->textInput(['maxlength' => 200]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
