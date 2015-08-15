<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Setup;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Despesas';
$this->params['breadcrumbs'][] = $this->title;
$titulos = \app\models\TituloDespesa::find()->all();

?>

<div class="despesa-index">

    

   
    <div class="col-md-12">
		
        <div class="panel panel-primary" style="background-color: #ebebeb;">
                    <div class="panel-heading" style="color: #fff;
  background-color: #303641;">
				<div class="panel-title">Filtrar</div>
				
				<div class="panel-options">
                                    <a href="../create/<?= $id_categoria?>" style="  margin-top: 7px;  padding: 7px;" class = 'btn btn-default'> <i class="entypo-down-open"></i> Nova Despesas </a>
					
				</div>
			</div>
			
			<div class="panel-body">
                            <form id="formFiltro">
				
				<p class="bs-example">
					 <div class="col-sm-3"> <input id="dataini" class="form-control input-sm" data-provide="datepicker" value="<?= $dataIni?>">
                        </div>
                      <div class="col-sm-3"> <input id="datafim" class="form-control input-sm" data-provide="datepicker" value="<?= $dataFim?>">
                        </div>
                                        <div class="col-sm-4"> <select id="titulo" class="form-control input-sm">
                                                <option value="0" >Todos</option>
                                                <?php foreach ($titulos as $item){
                                     echo '<option value="'.$item->id.'" >'.$item->titulo.'</option>';
                                 } ?>
                                    </select>
                        </div>
                                 <a href="#" id="btnFiltrar"  class = 'btn btn-success'> <i class="entypo-search"></i> Filtrar </a>
                                  <a href="../index/<?= $id_categoria?>" id=""  class = 'btn btn-default'> <i class="entypo-search"></i> Limpar </a>
			</form>
                        </div>
			
			
		</div>
	

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [ 'attribute' => 'data',
                                'format' => ['date', 'php:d/m/Y']
                ],
            
            [
                'attribute' => 'id_categoria',
                'label' => 'Tipo',
                'format' => 'raw',
                'value' => function ($model) {
                return $model->idCategoria->categoria;  },
                'filter' => true,  
                        ],
                        
            ['attribute' => 'id_titulo_despesa',
                 'label' => 'Titulo da Despesa',
                'format' => 'raw',
                'value' => function ($model) {
                return $model->idTituloDespesa->titulo;  },
                'filter' => true,  
                ],
            [
                'attribute' => 'valor',
                'format' => 'raw',
                 'value' => function ($model) {
                  return Setup::FormataMoeda(app\models\Despesa::find()->where(['=','data', $model->data])->andWhere(['=','id_titulo_despesa', $model->id_titulo_despesa])->sum('valor'));},
            ],
           [
                'label'=> 'Salas',
               'format' => 'raw',
               'value' => function($model){
                return' <button class="btn btn-orange btn-despesas" data-id='.$model->id.'>('.app\models\Despesa::find()->where(['=','data', $model->data])->andWhere(['=','id_titulo_despesa', $model->id_titulo_despesa])->count().') Detalhes</button>';}
            ],
                    [
                'label'=> '',
               'format' => 'raw',
               'value' => function($model){
                return ' <a href="/despesa/update/'.$model->id.'" class="btn btn btn-success">Editar</a> <a href="/despesa/delete/'.$model->id.'" class="btn btn btn-success">Excluir</a>';}
            ],
                    
            // 'id_categoria',
            // 'id_modalidade',
            // 'descricao',
            // 'id_titulo_despesa',

           
        ],
    ]); ?>

</div></div>
<?php $this->beginBlock('modals'); ?>

<div class="modal fade" id="modalSalas">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Nova Sala</h4>
            </div>

            <div class="modal-body">
               
            </div>

         
        </div>
    </div>
</div>


<?php $this->endBlock(); ?>
<script>
    jQuery(function(){
        
    jQuery("#btnFiltrar").click(function(){
        location.href = "../index/?id=<?= $id_categoria?>&dataIni="+$("#dataini").val()+"&dataFim="+$("#datafim").val()+"&id_titulo="+$("#titulo").val();
        debugger;
    
    });
    
    jQuery(".btn-despesas").click(function(){
        var id = jQuery(this).attr("data-id");
        $.ajax({
                url: "/despesa/detalhes/"+id,
                type: 'post',
               
                success: function (data) {
                    console.log(data);
                    var corpoModal = "<table class='table table-bordered table-responsive'><thead><tr><th>Sala</th><th>Valor</th></tr></thead><tbody>"
                    debugger
                    for(var i = 0; data.length > i; i++){
                    corpoModal = corpoModal + "<tr><td>"+data[i][0]+"</td><td>R$"+data[i][1]+"</td></tr>"
        }
        corpoModal = corpoModal + "</tbody></table>";
                   jQuery("#modalSalas").find(".modal-body").html(corpoModal);
                    jQuery("#modalSalas").modal("show");
                }
            });
        
        
    });
    });
        
    
    </script>