<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoInquilino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contrato-inquilino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_contrato')->textInput() ?>

    <?= $form->field($model, 'id_inquilino')->textInput() ?>

    <?= $form->field($model, 'percentual_pagamento')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
