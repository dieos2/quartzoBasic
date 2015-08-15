<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Funcionario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="funcionario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput() ?>

    <?= $form->field($model, 'endereco')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'estado_civil')->textInput(['maxlength' => 8]) ?>

    <?= $form->field($model, 'n_filhos_menores')->textInput() ?>

    <?= $form->field($model, 'rg')->textInput() ?>

    <?= $form->field($model, 'cpf')->textInput() ?>

    <?= $form->field($model, 'ctps')->textInput() ?>

    <?= $form->field($model, 'pis_pasep')->textInput() ?>

    <?= $form->field($model, 'funcao')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'data_admissao')->textInput(array('class'=>' form-control input-sm', 'data-provide'=>"datepicker")) ?>

    <?= $form->field($model, 'data_demissao')->textInput(array('class'=>' form-control input-sm', 'data-provide'=>"datepicker")) ?>

    <?= $form->field($model, 'salario')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'carga_horaia')->textInput() ?>

    <?= $form->field($model, 'obs')->textInput(['maxlength' => 200]) ?>
<?= $form->field($model, 'email')->textInput(['maxlength' => 150]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
