<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sala".
 *
 * @property integer $id
 * @property string $numero
 * @property integer $dimensao
 * @property string $finalidade
 * @property string $endereco
 * @property string $obs
 *
 * @property Contrato[] $contratos
 * @property Despesa[] $despesas
 */
class Sala extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sala';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero', 'dimensao', 'finalidade', 'endereco'], 'required'],
            [['dimensao'], 'integer'],
            [['numero'], 'string', 'max' => 6],
            [['finalidade'], 'string', 'max' => 20],
            [['endereco'], 'string', 'max' => 150],
            [['obs'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'dimensao' => 'Dimensao',
            'finalidade' => 'Finalidade',
            'endereco' => 'Endereco',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id_sala' => 'id']);
    }

     public function getContratoAtivo()
    {
        return $this->hasOne(Contrato::className(), ['id_sala' => 'id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
            return $this->hasMany(Despesa::className(), ['id_sala' => 'id']);
    }
    
    public static function getSalasSemContratoAtivo(){
        

        return Sala::find()
                ->joinWith('contratos')
                ->where(['contrato.id_sala' => null])
                ->orWhere(['contrato.ativo' => 0])->all();
    }
    
    public static function salasCadastradas(){
        
            return Sala::find()->count() > 0;
    }
    
 
}
