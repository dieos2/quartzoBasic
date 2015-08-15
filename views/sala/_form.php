<?php

use yii\helpers\Html;

use \kartik\form\ActiveForm

/* @var $this yii\web\View */
/* @var $model app\models\Sala */
/* @var $form \kartik\form\ActiveForm */
?>
<?php $form = ActiveForm::begin(['id' => 'frm-sala', 'action' => '/sala/create']); ?>

<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'numero')->textInput(['maxlength' => 6]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-6"> 
        <?= $form->field($model, 'dimensao',  ['addon' => ['append' => ['content' => 'm2']]])->textInput() ?>
    </div>
    <div class="col-sm-6"> 
        <?= $form->field($model, 'finalidade')->textInput(['maxlength' => 20]) ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <?= $form->field($model, 'endereco')->textInput(['maxlength' => 150]) ?>
    </div>
</div>
<div class="row">
<div class="col-sm-12">
    <?= $form->field($model, 'obs')->textarea(['maxlength' => 200]) ?>
</div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Criar Sala' : 'Atualizar Sala', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>