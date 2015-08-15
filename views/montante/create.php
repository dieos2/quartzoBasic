<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\montante */

$this->title = 'Create Montante';
$this->params['breadcrumbs'][] = ['label' => 'Montantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="montante-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
