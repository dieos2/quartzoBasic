<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\Models\modalidade */

$this->title = 'Create Modalidade';
$this->params['breadcrumbs'][] = ['label' => 'Modalidades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modalidade-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
