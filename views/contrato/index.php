<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Setup;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Gerenciar Contratos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contrato-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
   
    <?php if ($dataProvider->getCount() == 0) {
        ?>
        <div class="panel panel-info panel-shadow" data-collapsed="0"> 
            <!-- panel head --> 
            <div class="panel-heading"> 
                <div class="panel-title">Iniciando gestão de contratos</div> 
                <div class="panel-options"> 
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> 
                    
                </div> 
            </div> <!-- panel body --> 
            <div class="panel-body"> 
                <p>Você ainda não possui nenhum contrato de aluguel cadastrado. É preciso criar um novo contrato de aluguel, relacionando uma sala disponível a um ou mais inquilinos. <br/><strong>Clique no botão abaixo para começar.</strong></p> 
                 <p>
        <?= Html::a('Novo Contrato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
            </div> 
        </div> 

<?php } else { ?>
      <p>
        <?= Html::a('Novo Contrato', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'rowOptions' => function ($model) {

            if (!$model->ativo) {
                return ['class' => 'inactive'];
            } else {
                return [];
            }
        },
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'inquilinos',
                        'label' => 'Iniquilinos',
                        'format' => 'raw',
                        'value' => function ($model) {
                            $inquilinos = [];
                            if ($model->inquilinos) {
                                foreach ($model->inquilinos as $inquilino) {
                                    $inquilinos[] = $inquilino->nome;
                                }
                            }
                            return implode(', ', $inquilinos);
                        },
                                'filter' => true,
                            ],
                            [
                                'attribute' => 'id_sala',
                                'label' => 'Sala',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    return $model->sala->numero;
                                },
                                'filter' => true,
                            ],
                            [
                                'attribute' => 'data_inicio',
                                'format' => ['date', 'php:d/m/Y']
                            ],
                            [
                                'attribute' => 'data_termino',
                                'format' => ['date', 'php:d/m/Y']
                            ],
                            'ativo:boolean',
                            [
                                'attribute' => 'expirando',
                                'label' => 'Expiracao',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    return $model->expiraEmDias(5);
                                },
                                'filter' => true,
                            ],
                            'dia_vencimento',
                                        [
                                'attribute' => 'valor',
                                'label' => 'Valor',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    return Setup::formataMoeda($model->valor);
                                },
                                'filter' => true,
                            ],
                            [
                                'attribute' => '',
                                'format' => 'raw',
                                'value' => function ($model) {

                                    return '<a class="btn btn-success" href="/contrato/view/' . $model->id . '">Detalhes</a>';
                                },
                            ],
                        ],
                    ]);
                    ?>
                <?php } ?>
 
</div>
