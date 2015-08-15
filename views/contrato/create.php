<?php

use yii\helpers\Html;
use app\models\Inquilino;
use app\models\Sala;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */


$this->title = 'Novo Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$listInquilinos = Inquilino::find()->all();
$temInquilinos = Inquilino::find()->exists();
?>


<h1><?= Html::encode($this->title) ?></h1>
<hr>
<div class=" row contrato-create">



    <div class="contrato-form col-sm-8">
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
    <div class="col-sm-4">
        <div class="panel panel-primary" data-collapsed="0">

            <!-- panel head -->
            <div class="panel-heading">
                <div class="panel-title">Inquilinos</div>

                <div class="panel-options">
                    <a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
                    <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
                    <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
                    <a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
                </div>
            </div>

            <!-- panel body -->
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <p>Você precisa vincular um ou mais inquilinos ao contrato.</strong></p> 
                        <p>
                            <button type = "button" data-target="#modalInquilino" data-toggle="modal" class="btn  btn-success btn-lg btn-icon icon-left"> Cadastre um inquilino<i class="entypo-user-add"></i></button>
                        </p>
                    </div>
                  
                <?php if ($temInquilinos) { ?> 
                    <div class="col-md-12">
                    <p>ou</p>                              
                    <select id="selectInquilinos" data-allow-clear="true" data-placeholder="Escolha um ou mais da lista... " class="form-control select2" multiple="">
                        <option></option>
                        <?php
                        foreach ($listInquilinos as $item)
                        {
                            echo '<option value="' . $item->id . '" >' . $item->nome . '</option>';
                        }
                        ?>

                    </select>
                     </div>
                    <div class="col-md-12">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                <?php } ?> 
                    
                </div>
            </div>

        </div>

    </div>
</div>

<?php $this->beginBlock('modals'); ?>

<div class="modal fade" id="modalInquilino">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Novo Inquilino</h4>
            </div>

            <div class="modal-body">
                <?=
                $this->render('..\inquilino\_form', [
                    'model' => new Inquilino(),
                ])
                ?>
            </div>

         
        </div>
    </div>
</div>
<div class="modal fade" id="modalSala">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nova Sala</h4>
            </div>

            <div class="modal-body">
                <?=
                $this->render('..\sala\_form', [
                    'model' => new Sala(),
                ])
                ?>
            </div>

         
        </div>
    </div>
</div>

<?php $this->endBlock(); ?>


<script>
    $(function () {
        $('#frm-sala').on('beforeSubmit', function (event, jqXHR, settings) {
            var form = $(this);
            if (form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (data) {
                    console.log(data);
                    $('#frm-sala')[0].reset();
                    $('#contrato-id_sala').append('<option value="' + data.id + '" selected="selected">' + data.endereco.toUpperCase() + ' - ' + data.numero + '</option>'.toUpperCase());
                    $('.modal').modal('hide');
                    if ($('#contrato-ativo').length == 0)
                        location.reload();
                }
            });

            return false;
        });

    $('#frm-inquilino').on('beforeSubmit', function (event, jqXHR, settings) {
            var form = $(this);
            if (form.find('.has-error').length) {
                return false;
            }

            $.ajax({
                url: form.attr('action'),
                type: 'post',
                data: form.serialize(),
                success: function (data) {
                    console.log(data);
                    $('#frm-inquilino')[0].reset();
                    $('#contrato-id_inquilino').append('<option value="' + data.id + '" selected="selected">' + data.nome +'</option>'.toUpperCase());
                    $('.modal').modal('hide');
                    if ($('#contrato-ativo').length == 0)
                        location.reload();
                }
            });

            return false;
        });


    });



</script>


