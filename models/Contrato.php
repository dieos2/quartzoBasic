<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato".
 *
 * @property integer $id
 * @property string $data_inicio
 * @property integer $id_sala
 * @property boolean $ativo
 * @property integer $dia_vencimento
 * @property string $data_termino
 *
 * @property Sala $idSala
 * @property ContratoInquilino[] $contratoInquilinos
 * @property Inquilino[] $idInquilinos
 * @property Pagamento[] $pagamentos
 */
class Contrato extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contrato';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['data_inicio', 'id_sala', 'dia_vencimento','valor'], 'required'],
            [['data_inicio', 'data_termino'], 'safe'],
            [['id_sala', 'dia_vencimento'], 'integer'],
            [['ativo'], 'boolean'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data_inicio' => 'Data Inicio',
            'id_sala' => 'Id Sala',
            'ativo' => 'Ativo',
            'dia_vencimento' => 'Dia Vencimento',
            'data_termino' => 'Data Termino',
            'valor' => 'Valor do Contrato'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSala()
    {
        return $this->hasOne(Sala::className(), ['id' => 'id_sala']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoInquilinos()
    {
        
       
        return $this->hasMany(ContratoInquilino::className(), ['id_contrato' => 'id']);
    }
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInquilinos()
    {
        return $this->hasMany(Inquilino::className(), ['id' => 'id_inquilino'])->viaTable('contrato_inquilino', ['id_contrato' => 'id']);
    }
public  function  getDespesas()
{
    return $this->hasMany(Despesa::className(), ['id_contrato' => 'id']);
}

/**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['id_contrato' => 'id']);
    }
     public function getPagamentosAlugel()
    {
        return $this->hasMany(PagamentoAluguel::className(), ['id_contrato' => 'id']);
    }
    public function  expiraEmDias($dias){
        
        // Define os valores a serem usados
        $hoje = date('d/m/y');
        $data_final = $this->data_termino;

        // Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($hoje);
        $time_final = strtotime($data_final);

        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos

        // Calcula a diferença de dias
        $diferencaEmDias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias

        return $diferencaEmDias <= $dias;
        
    }
    
    
    public static function getAtivos()
    {
         return Contrato::find()->where(['=', 'ativo', 1])->all();
    }
    
}
