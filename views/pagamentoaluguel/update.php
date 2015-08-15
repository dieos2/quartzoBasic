<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PagamentoAluguel */

$this->title = 'Update Pagamento Aluguel: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pagamento Aluguels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pagamento-aluguel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
