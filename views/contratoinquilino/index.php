<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contrato Inquilinos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-inquilino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Contrato Inquilino', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_contrato',
            'id_inquilino',
            'percentual_pagamento',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
