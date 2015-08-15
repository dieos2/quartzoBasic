<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoInquilino */

$this->title = $model->id_contrato;
$this->params['breadcrumbs'][] = ['label' => 'Contrato Inquilinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-inquilino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_contrato' => $model->id_contrato, 'id_inquilino' => $model->id_inquilino], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_contrato' => $model->id_contrato, 'id_inquilino' => $model->id_inquilino], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_contrato',
            'id_inquilino',
            'percentual_pagamento',
        ],
    ]) ?>

</div>
