<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\TituloDespesa */

$this->title = 'Create Titulo Despesa';
$this->params['breadcrumbs'][] = ['label' => 'Titulo Despesas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titulo-despesa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
