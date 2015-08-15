<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ContratoInquilino */

$this->title = 'Create Contrato Inquilino';
$this->params['breadcrumbs'][] = ['label' => 'Contrato Inquilinos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-inquilino-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
