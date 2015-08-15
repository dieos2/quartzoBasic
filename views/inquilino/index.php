<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Inquilinos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inquilino-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Criar Inquilino', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           // 'id',
            'nome',
            'nacionalidade',
            'estado_civil',
            'profissao',
            // 'identidade',
            // 'cpf',
            // 'endereco',
            // 'bairro',
            // 'fone',
            // 'email:email',
            // 'obs',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
