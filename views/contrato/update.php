<?php

use yii\helpers\Html;
use app\models\Inquilino;
/* @var $this yii\web\View */
/* @var $model app\models\Contrato */

$this->title = 'Atualizar Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$listInquilinos = Inquilino::find()->all();
?>
<div class="contrato-update">

    <h1><?= Html::encode($this->title) ?></h1>
 <div class="contrato-form col-sm-8">
    <?= $this->render('_form', [
        'model' => $model,
       
    ]) ?>
 </div>
<script type="text/javascript">
	// Code used to add Todo Tasks
	jQuery(document).ready(function($)
	{
			
		$('#select2').change(function(ev)
		{
                    debugger;
			var $todo_tasks = $("#todo_tasks");
		
				ev.preventDefault();
				
				if($.trim($(this).val()).length)
				{
                                     debugger;
         AtualizaInquilinoNoContrato($('#select2 option:selected').val(), false);
					 var $todo_entry = $('<li><div class="checkbox checkbox-replace color-white" data-id="'+$('#select2 option:selected').val()+'"><input  type="checkbox" /><label>'+$('#select2 option:selected').text()+'<input type="text" class="form-control porcentagemInquilino" value="" /></label></div></li>');
					$todo_entry.appendTo($todo_tasks.find('.todo-list'));
					$todo_entry.hide().slideDown('fast');
					replaceCheckboxes();
				
			}
		});
                
                jQuery('.teste').click(function(){
                if(jQuery(this).parent().parent().hasClass('checked')){
                AtualizaInquilinoNoContrato(jQuery(this).attr('data-id'), true)
            }else{
                  AtualizaInquilinoNoContrato(jQuery(this).attr('data-id'), false)
        }
            });
                function AtualizaInquilinoNoContrato(id_inquilino, status){
                  $("#status").val(status);     
                                                $("#contratoinquilino-id_inquilino").val(id_inquilino);
          var url = "index.php?r=contratoinquilino/create";
          var data = $('#contratoInquilino-form').serialize(); debugger;
          $.ajax({
  type: "POST",
  url: url,
  data: data,
dataType: "json",
            success: function(response, status) {
            var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": rtl() || public_vars.$pageContainer.hasClass('right-sidebar') ? "toast-top-left" : "toast-top-right",
			"toastClass": "black",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};

		toastr.success(response, "Contrato Atualizado", opts);   
                                   

}      });
                }
	});
</script>
	<div class="col-sm-4">
		<div class="tile-block tile-aqua" id="todo_tasks">
			
			<div class="tile-header">
				<i class="entypo-list"></i>
				
				<a href="#">
					Inquilinos
					<span>Escolha um ou mais na lista.</span>
				</a>
			</div>
			

   
			<div class="tile-content">
                            <select id="select2" class="form-control select2">
                                <option value="">Selecione o Inquilino</option>
				  <?php foreach ($listInquilinos as $item){
                                     echo '<option value="'.$item->id.'" >'.$item->nome.'</option>';
                                 } ?>
				
				</select>
				
				
				
				<ul class="todo-list">
				 <?php foreach ($model->getContratoInquilinos()->all() as $items){
                                    
                                     echo '<li><div class="checkbox  checkbox-replace color-white" ><input data-id="'.$items->id_inquilino.'" class="teste" type="checkbox" /><label>'.$items->idInquilino->nome.'<input type="text" class="form-control porcentagemInquilino" value="'.$items->percentual_pagamento.'%" /></label> </div></li>';
                                 } ?>
					
				</ul>
				
			</div>
			
			<div class="tile-footer">
			
			</div>
			
		</div> 
	</div>
		<form id="contratoInquilino-form" action="/quartzo/quartzo/frontend/web/index.php?r=contratoinquilino/create" method="post">
                            <input type="hidden" name="_csrf" value="<?php echo \yii::$app->request->csrfToken ?>">
                            <input type="hidden" id="contratoinquilino-id_contrato" class="form-control" name="ContratoInquilino[id_contrato]" value="<?php echo $model->id?>">

                            <input  type="hidden" value="" id="contratoinquilino-id_inquilino" name="ContratoInquilino[id_inquilino]" />
                            <input  type="hidden" value="" id="status" name="status" />
                            <input type="hidden" id="contratoinquilino-percentual_pagamento" class="form-control" name="ContratoInquilino[percentual_pagamento]" value="50">

    </form>
     						
				
</div>
