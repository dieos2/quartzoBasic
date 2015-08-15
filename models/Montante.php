<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "montante".
 *
 * @property integer $id
 * @property integer $mes
 * @property integer $ano
 * @property integer $id_contrato
 * @property string $valor
 * @property integer $status
 *
 * @property Contrato $idContrato
 * @property Pagamento[] $pagamentos
 */
class Montante extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'montante';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mes', 'ano', 'id_contrato', 'valor', 'status'], 'required'],
            [['mes', 'ano', 'id_contrato', 'status'], 'integer'],
            [['valor'], 'number']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mes' => 'Mes',
            'ano' => 'Ano',
            'id_contrato' => 'Id Contrato',
            'valor' => 'Valor',
            'status' => 'Status',
        ];
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
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['id_montante' => 'id']);
    }
     public static function Atualiza($id= 0)
    {   $despesa = \app\models\Despesa::find()->where(['=','id', $id])->andwhere(['<>','id_categoria', 4])->one();
        $model = new Montante();

       if($id != 0){
           $model->mes = \frontend\controllers\Setup::ExtraiMes($despesa->data);
           $model->ano = \frontend\controllers\Setup::ExtraiAno($despesa->data);
            $dataInicio = date('Y-m-d', strtotime($model->ano.'-'.$model->mes.'-01'));
            $dataFim = date('Y-m-d', strtotime($model->ano.'-'.$model->mes.'-31'));
           
            $modelMontante= Montante::find()->where(['=','mes', $model->mes])->andWhere(['=','ano', $model->ano])->andWhere(['=','id_contrato', $despesa->id_contrato])->one();
           if($modelMontante != null){
               $modelMontante->valor = \app\models\Despesa::find()->where(['=','id_contrato', $despesa->id_contrato])->andwhere(['<>','id_categoria', 4])->andWhere('data BETWEEN :start_time AND :end_time', array(
            ':start_time' => $dataInicio,
            ':end_time' => $dataFim))->sum('valor');
               $modelMontante->save();
           }  else {
               $model->valor = $despesa->valor;
               $model->status = 0;
               $model->id_contrato = $despesa->id_contrato;
               $model->save();
           }
        }else{
            
        }
    }
    public static function getPorContrato($id, $mes, $ano){
       $montante = \app\models\Montante::findOne(['mes'=> $mes, 'ano'=> $ano, 'id_contrato'=> $id]);
       if($montante != null)
       {
           return $montante;
           
       }
       else
           
       {
           return new Montante(['valor'=> 0]);
       }
    }
}
