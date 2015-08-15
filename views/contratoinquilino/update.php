<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ContratoInquilino */

$this->title = 'Update Contrato Inquilino: ' . ' ' . $model->id_contrato;
$this->params['breadcrumbs'][] = ['label' => 'Contrato Inquilinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_contrato, 'url' => ['view', 'id_contrato' => $model->id_contrato, 'id_inquilino' => $model->id_inquilino]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contrato-inquilino-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
