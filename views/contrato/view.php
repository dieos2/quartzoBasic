<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Despesa;
use app\models\Pagamento;
use app\models\Setup;
use app\models\PagamentoAluguel;
use app\models\Montante;

/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="row">

	<div class="col-md-12">

		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="panel-title">Detalhes de Contrato</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Contrato</th>
						<th>Inquilino</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="padding-lg">
						
							
									<div class="form-group">
							<div class="input-group">
								<div class="input-group-addon">
									<i class="entypo-home"></i>
								</div>
								
                                                            <label type="text" class="form-control" name="name" id="name" >Sala:  <?= $model->getSala()->one()->numero ?></label>
							</div>
						</div>
								
									<div class="form-group">
                                                                            <div class="input-group" style="width: 50%; float: left">
								<div class="input-group-addon">
									<i class="entypo-calendar"></i>
								</div>
								
                                                            <label type="text" class="form-control" name="name" id="name" >Data de Inicio:     <?= Setup::DepoisDePegar($model->data_inicio) ?></label>
                                                            
							</div>
                                                                            <div class="input-group" style="width: 50%">
								<div class="input-group-addon">
									<i class="entypo-calendar"></i>
								</div>
								
                                                                                <label type="text" class="form-control" name="name" id="name" >Data de Termino:  <?= Setup::DepoisDePegar($model->data_termino) ?></label>
							</div>
						</div>
								
									<div class="form-group">
							<div class="input-group" style="width: 50%; float: left">
								<div class="input-group-addon">
									R$
								</div>
								
                                                            <label type="text" class="form-control" name="name" id="name" >Valor:  <?= Setup::FormataMoeda($model->valor) ?></label>
							</div>
						</div>
								
									<div class="form-group">
							<div class="input-group" style="width: 50%;" >
								<div class="input-group-addon">
									<i class="entypo-attention"></i>
								</div>
								
                                                            <label type="text" class="form-control" name="name" id="name" >Dia de Vencimento:  <?= $model->dia_vencimento ?></label>
							</div>
						</div>
								
									<div class="form-group">
							<div class="input-group">
								
								<?php if($model->ativo== 1){ ?>
                                                            <div class="input-group-addon">
									<i class="entypo-thumbs-up"></i>
								</div>
                                                            <label type="text" class="form-control" name="name" id="name" >Ativo</label>
							
                                                                <?php }else{ ?>
                                                            <div class="input-group-addon">
									<i class="entypo-thumbs-down"></i>
								</div>
                                                              <label type="text" class="form-control" name="name" id="name" >Desativado</label>
                                                         <?php } ?>
                                                        </div>
						</div>
							
							
						</td>
						
						<td class="padding-lg">
						
							<div class="list-group">
                                                            <?php foreach($model->getContratoInquilinos()->all() as $inquilino){?>
								<a href="#" class="list-group-item ">
									<span class="badge badge-primary"><?= $inquilino->percentual_pagamento ?>%</span>
									<?= \app\models\Inquilino::findOne($inquilino->id_inquilino)->nome ?>
								</a>
                                                            <?php } ?>
								
							</div>
							
						</td>
					</tr>
					
                                        
				</tbody>
			</table>
		</div>
		
	</div>
    <div class="col-md-12" style="text-align: center">
       
             <ul class="pagination">
							<li><a href="/contrato/view/?id=<?=$model->id?>&mes=<?=12?>&ano=<?=$ano-1?>"><i class="entypo-left-open-mini"></i></a></li>
							
							<li class="active"><a href="#"><?= $ano ?></a></li>
							<li><a href="/contrato/view/?id=<?=$model->id?>&mes=<?=1?>&ano=<?=$ano+1?>"><i class="entypo-right-open-mini"></i></a></li>
						</ul>
        <br \>
    <ul class="pagination"> <?php  if($mes != 1){ ?>
							<li><a href="/contrato/view/?id=<?=$model->id?>&mes=<?=$mes-1?>&ano=<?=$ano?>"><i class="entypo-left-open-mini"></i></a></li>
							  <?php }?>
                                                            <?php for($i = 1; $i < 13; $i++){?>
                                                         <?php  if($i == $mes){ $classe = 'active';}else {$classe='';} ?>
                                                        <li class="<?=$classe?>"><a href="/contrato/view/?id=<?=$model->id?>&mes=<?=$i?>&ano=<?=$ano?>" ><?= $i?></a></li>
                                                        <?php }?>
							 <?php  if($mes != 12){ ?>
							<li><a href="/contrato/view/?id=<?=$model->id?>&mes=<?=$mes+1?>&ano=<?=$ano?>"><i class="entypo-right-open-mini"></i></a></li>
                                                             <?php }?>
    </ul>
      </div>
   
        <div class="col-md-7">
            <div class="panel panel-primary">
            <div class="panel-heading">
				<div class="panel-title">Despesas e Aluguel</div>
				<div class="panel-options">
					<button data-target="#modalDespesa" data-toggle="modal" type="button" class="btn btn-topo-panel btn-green btn-icon icon-left">
						Cadastrar Despesa Individual
						<i class="entypo-check"></i>
					</button>
                                   
					
				</div>
				
			</div>
                <div class="panel-body">
            <table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Aluguel</th>
						<th>Valor</th>
                                                <th>Teste</th>
					</tr>
				</thead>
				<tbody><?php foreach($alugueis as $aluguel){ ?>
					<tr>
                                            
                                            <td class=""><?= $aluguel->idTituloDespesa->titulo ?></td>
                                      
                                            <td class=""><?= Setup::FormataMoeda($aluguel->valor) ?></td>
                                     
                                            <td class=""><input type="checkbox" /></td>
                                            
                                        </tr><?php } ?>
                                </tbody>
            </table>
                
                   <table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Despesas</th>
						<th>Valor Total</th>
                                                <th>Nº Salas</th>
                                                <th>Valor por Sala</th>
                                                <th>Teste</th>
					</tr>
				</thead>
				<tbody><?php foreach($despesas as $despesa){ ?>
					<tr>
                                            <td class=""><?= $despesa->idTituloDespesa->titulo ?></td>
                                      
                                            <td class=""><?php if($despesa->idCategoria->categoria == 'Individual'){echo Setup::FormataMoeda($despesa->valor);}else{echo Setup::FormataMoeda($despesa->getValorTotal());} ?></td>
                                     <td class=""><?php if($despesa->idCategoria->categoria == 'Individual'){echo '<span>1</span>'; }else{echo $despesa->getNumeroDeSalas();} ?></td>
                                     <td class=""><?= Setup::FormataMoeda($despesa->valor) ?></td>
                                            <td class=""><input type="checkbox" /></td>
                                        </tr><?php } ?>
                                        <tr style="background-color: #ADADAD;  color: #fff;"><td >Total</td><td style="text-align:center" colspan="3"><?= Setup::FormataMoeda(\app\models\Montante::getPorContrato($model->id, $mes, $ano)->valor)?></td>    <td class=""><input type="checkbox" /></td></tr>
                                </tbody>
            </table>
        </div> </div>
        </div>
        <div class="col-md-5">
            <div class="panel panel-primary">
            <div class="panel-heading">
				<div class="panel-title">Pagamentos</div>
				<div class="panel-options">
                                <button data-target="#modalPagamento" data-toggle="modal" type="button" class="btn btn-topo-panel btn-green btn-icon icon-left">
						Registrar Pagamento
						<i class="entypo-check"></i>
					</button>
                                </div>
			</div>
                  <div class="panel-body">
             <table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Pagamentos Aluguel</th>
						<th>Data</th>
                                                <th>Valor</th>
					</tr>
				</thead>
				<tbody><?php foreach($pagamentosAluguel as $pagamentoAluguel){ ?>
					<tr>
                                           <td class=""><?= $pagamentoAluguel->idDespesa->idTituloDespesa->titulo?></td> 
                                            <td class=""><?= Setup::DepoisDePegar($pagamentoAluguel->data) ?></td> 
                                            <td class=""><?= Setup::FormataMoeda($pagamentoAluguel->valor) ?></td>
                                        </tr><?php }?>
                                </tbody>
            </table>
                       <table class="table table-bordered">
				<thead>
					<tr>
						<th width="50%">Pagamentos Despesas</th>
						<th>Data</th>
                                                <th>Valor</th>
                                </tr>
				</thead>
				<tbody><?php foreach($pagamentos as $pagamento){ ?>
					<tr>
                                            <td class=""><?= $pagamento->idMontante->mes ?>/<?= $pagamento->idMontante->ano ?></td> 
                                            <td class=""><?= Setup::DepoisDePegar($pagamento->data) ?></td> 
                                            <td class=""><?= Setup::FormataMoeda($pagamento->valor) ?></td>
                                        </tr><?php }?>
                                </tbody>
            </table>
                       <table class="table table-bordered ">
				<thead>
					<tr >
						<th width="40%" class="">Demostrativo Individual</th>
						<th>Aluguel a Pagar</th>
                                                <th>Despesas a Pagar</th>
					</tr>
				</thead>
				<tbody><?php foreach($model->getContratoInquilinos()->all() as $inquilino){ ?>
					<tr>
                                            <td class=""><?= \app\models\Inquilino::findOne($inquilino->id_inquilino)->nome ?></td> 
                                            <td class=""><?= Setup::FormataMoeda(Setup::CalculaPorcentagem($inquilino->percentual_pagamento, Despesa::getAlugelParaPagamento($model->id, $mes, $ano)->valor));  ?></td> 
                                            <td class=""><?=  Setup::FormataMoeda(Setup::CalculaPorcentagem($inquilino->percentual_pagamento, Montante::getPorContrato($model->id, $mes, $ano)->valor)); ?></td>
                                        </tr><?php }?>
                                </tbody>
            </table>
        </div>
            </div>
        </div>
    
   
    </div>

 
<?php $this->beginBlock('modals'); ?>

<div class="modal fade" id="modalDespesa">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nova Despesa Individual</h4>
            </div>

            <div class="modal-body">
                <?=
                $this->render('..\despesa\_formIndividual', [
                    'model' => new Despesa(array('id_categoria' => 3, 'id_sala'=> $model->id_sala, 'id_contrato' => $model->id, 'id_modalidade'=>2 )),
                ])
                ?>
            </div>

         
        </div>
    </div>
</div>
<div class="modal fade" id="modalPagamento">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Novo Pagamento</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
						<label class="col-sm-3 control-label"></label>
						
						<div class="col-sm-7">
							<select class="form-control selectPagamento">
								<option>Selecione o tipo de pagamento</option>
                                                                <option value="Pagamento">Pagamento de Despesas</option>
                                                                <option value="PagamentoAluguel">Pagamento de Aluguel</option>
								
							</select>
						</div>
					</div>
                <br \>
                <div id="formPagamento">  <?=
                $this->render('..\pagamento\_form', [
                    'model' => new Pagamento(array('id_contrato' => $model->id, 'id_montante'=>  Montante::getPorContrato($model->id,$mes, $ano))),
                ])
                ?>
                    </div>
                <div id="formPagamentoAluguel">
                 <?=
                $this->render('..\pagamentoAluguel\_form', [
                    'model' => new PagamentoAluguel(array('id_contrato' => $model->id, 'id_despesa'=> Despesa::getAlugelParaPagamento($model->id, $mes, $ano))),
                ])
                ?>
                    </div>
            </div>

         
        </div>
    </div>
</div>

<?php $this->endBlock(); ?>

<script>
    $(function () {
        $('#formPagamentoAluguel').hide();
        $('#formPagamento').hide();
        $('.selectPagamento').change(function(){
            var tipoDePagamento = $(this).val();
            if(tipoDePagamento == 'PagamentoAluguel'){
                  $('#formPagamento').hide();
                 $('#formPagamentoAluguel').slideDown();
            }else if(tipoDePagamento == 'Pagamento'){
                 $('#formPagamentoAluguel').hide();
                   $('#formPagamento').slideDown();
            }else{
                   $('#formPagamentoAluguel').hide();
        $('#formPagamento').hide();
            }
        });
        $('#frm-despesa').on('beforeSubmit', function (event, jqXHR, settings) {
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
                    $('#frm-despesa')[0].reset();
                    
                    $('.modal').modal('hide');
                   
                        location.reload();
                }
            });
 
            return false;
        });

    $('#frm-pagamento').on('beforeSubmit', function (event, jqXHR, settings) {
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
                  
                        location.reload();
                }
            });

            return false;
        });


   
$('#frm-pagamentoAluguel').on('beforeSubmit', function (event, jqXHR, settings) {
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
                  
                        location.reload();
                }
            });

            return false;
        });


    });


</script>