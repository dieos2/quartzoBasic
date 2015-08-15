<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "despesa".
 *
 * @property integer $id
 * @property integer $id_sala
 * @property string $valor
 * @property string $data
 * @property string $obs
 * @property integer $id_categoria
 * @property integer $id_modalidade
 * @property string $descricao
 * @property integer $id_titulo_despesa
 * @property integer $id_contrato
 *
 * @property Modalidade $idModalidade
 * @property Contrato $idContrato
 * @property Sala $idSala
 * @property TituloDespesa $idTituloDespesa
 * @property CategoriaDespesa $idCategoria
 * @property PagamentoAluguel[] $pagamentoAluguels
 */
class Despesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'despesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sala', 'valor', 'obs', 'id_categoria', 'id_modalidade', 'id_titulo_despesa', 'id_contrato'], 'required'],
            [['id_sala', 'id_categoria', 'id_modalidade', 'id_titulo_despesa', 'id_contrato'], 'integer'],
            [['valor'], 'number'],
            [['data'], 'safe'],
            [['obs'], 'string', 'max' => 200],
            [['descricao'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sala' => 'Id Sala',
            'valor' => 'Valor',
            'data' => 'Data',
            'obs' => 'Obs',
            'id_categoria' => 'Id Categoria',
            'id_modalidade' => 'Id Modalidade',
            'descricao' => 'Descricao',
            'id_titulo_despesa' => 'Id Titulo Despesa',
            'id_contrato' => 'Id Contrato',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdModalidade()
    {
        return $this->hasOne(Modalidade::className(), ['id' => 'id_modalidade']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdContrato()
    {
        return $this->hasOne(Contrato::className(), ['id' => 'id_contrato']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTituloDespesa()
    {
        return $this->hasOne(TituloDespesa::className(), ['id' => 'id_titulo_despesa']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoria()
    {
        return $this->hasOne(CategoriaDespesa::className(), ['id' => 'id_categoria']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentoAluguels()
    {
        return $this->hasMany(PagamentoAluguel::className(), ['id_despesa' => 'id']);
    }
    public static function verificaAluguel($id_contrato)
    {
     
         
         $aluguel = Despesa::find()->where(['=','id_contrato', $id_contrato])->andWhere(['=','id_categoria',4])->orderBy(['data'=>SORT_DESC])->one();
        if($aluguel != null){
         return $aluguel;
        }else
        {
            return false;
        }
    }
    public static function LancaAluguel($data, $id_contrato)
    {
        $mes = \frontend\controllers\Setup::ExtraiMes($data);
        $ano = \frontend\controllers\Setup::ExtraiAno($data);
         $contrato = Contrato::findOne($id_contrato);
        $data = date('Y-m-d', strtotime($ano.'-'.$mes.'-'.$contrato->dia_vencimento));
       
        $despesa = new Despesa();
        $despesa->valor = $contrato->valor;
        $despesa->id_sala = $contrato->id_sala;
        $despesa->id_contrato = $contrato->id;
        $despesa->data = $data;
        $despesa->obs = '.';
        $despesa->descricao = 'aluguel';
        $despesa->id_modalidade = 2;
        $despesa->id_categoria = 4;
        $despesa->id_titulo_despesa = 5;
        $despesa->save();
         return $despesa;
    }
    
    public function getValorTotal(){
         return $this->hasMany(Despesa::className(), ['id_titulo_despesa' => 'id_titulo_despesa', 'data' => 'data'])->where(['<>','id_categoria', 3 ])->sum('valor');
    }
    public function getNumeroDeSalas(){
         return $this->hasMany(Despesa::className(), ['id_titulo_despesa' => 'id_titulo_despesa', 'data' => 'data'])->where(['<>','id_categoria', 3 ])->count();
    }
    public static function getAlugelParaPagamento($id, $mes, $ano){
            $dataInicio = date('Y-m-d', strtotime($ano.'-'.$mes.'-01'));
            $dataFim = date('Y-m-d', strtotime($ano.'-'.$mes.'-31'));
            $despesa = \app\models\Despesa::find()->where(['=','id_categoria', 4])->andWhere(['=','id_contrato', $id])->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->one();
       if($despesa != null)
       {
           return $despesa;
           
       }
       else
       {
           return new Despesa(['valor'=> 0]);
       }
    }
}
