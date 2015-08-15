<?php

use yii\helpers\Html;
use \kartik\form\ActiveForm;
use app\models\Sala;
use yii\helpers\ArrayHelper;
use app\models\Inquilino;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */
/* @var $form yii\widgets\ActiveForm */
$salas = Sala::salasCadastradas();
$salasSemContrato = Sala::getSalasSemContratoAtivo();


$listData = ArrayHelper::map($salasSemContrato, 'id', function($sala, $defaultValue) {
            return strtoupper($sala->endereco . ' - ' . $sala->numero);
        });
?>
<?php $form = ActiveForm::begin(); ?>
<?php if (!($salas and $salasSemContrato)) { ?>
    <div class="panel panel-gray" data-collapsed="0"> 
        <!-- panel head --> 
        <div class="panel-heading"> 
            <div class="panel-title">Você não tem salas disponíveis.</div> 
            <div class="panel-options"> 
                <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a> 

            </div> 
        </div> <!-- panel body --> 
        <div class="panel-body"> 
            <p>Para criar um contrato de aluguel é preciso ter pelo menos uma sala disponível.</strong></p> 
            <p>

                <button type = "button" data-target="#modalSala" data-toggle="modal" class="btn btn-success btn-lg btn-icon icon-left">Criar nova Sala
                    <i class="entypo-address"></i>
                </button>
            </p>
        </div> 
    </div> 

<?php } else { ?>
    <div class="panel panel-default" data-collapsed="0"> 
        <!-- panel body --> 
        <div class="panel-body"> 
            <?= $form->field($model, 'id_sala')->dropDownList($listData)->label($label = "Escolha a Sala") ?> 
            ou <a class='text-success bold' href='#' data-target='#modalSala' data-toggle="modal"> crie uma nova sala [+]</a>
        </div>
    
    
        <div class="panel-body row"> 
            <div class="col-md-6">
                <?= $form->field($model, 'data_inicio')->textInput(array('class' => ' form-control input-sm ', 'data-provide' => "datepicker"))->label($label = "Início do contrato") ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'data_termino')->textInput(array('class' => 'form-control input-sm ', 'data-provide' => "datepicker"))->label($label = "Termino do contrato (opcional)") ?>
            </div>
            <div class="row"></div>
            <div class="col-md-6">
                <?= $form->field($model, 'valor',  ['addon' => ['prepend' => ['content' => 'R$ ']]])->textInput(array('class' => 'form-control input-sm '))->label($label = "Valor do Contrato") ?>
                
            </div>
            <div class="col-md-12">  
                <?= $form->field($model, 'dia_vencimento')->radioList(array(5 => '5', 10 => '10', 15 => '15'))->label("Escolha o dia de vencimento"); ?>      
            </div>
                <?= $form->field($model, 'ativo')->hiddenInput(['value' => true])->label(false) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar contrato' : 'Atualizar contrato', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
<?php } ?>
<?php ActiveForm::end(); ?>