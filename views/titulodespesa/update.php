<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TituloDespesa */

$this->title = 'Update Titulo Despesa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Titulo Despesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="titulo-despesa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
