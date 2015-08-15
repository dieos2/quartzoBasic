<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PagamentoAluguel */

$this->title = 'Create Pagamento Aluguel';
$this->params['breadcrumbs'][] = ['label' => 'Pagamento Aluguels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pagamento-aluguel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
