<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagamento".
 *
 * @property integer $id
 * @property string $valor
 * @property string $data
 * @property string $acrescimo
 * @property integer $id_inquilino
 * @property integer $id_contrato
 * @property integer $id_montante
 *
 * @property Contrato $idContrato
 * @property Inquilino $idInquilino
 * @property Montante $idMontante
 */
class Pagamento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'id_inquilino', 'id_contrato', 'id_montante'], 'required'],
            [['valor', 'acrescimo'], 'number'],
            [['data'], 'safe'],
            [['id_inquilino', 'id_contrato', 'id_montante'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'valor' => 'Valor',
            'data' => 'Data',
            'acrescimo' => 'Acrescimo',
            'id_inquilino' => 'Id Inquilino',
            'id_contrato' => 'Id Contrato',
            'id_montante' => 'Id Montante',
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
    public function getIdInquilino()
    {
        return $this->hasOne(Inquilino::className(), ['id' => 'id_inquilino']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMontante()
    {
        return $this->hasOne(Montante::className(), ['id' => 'id_montante']);
    }
}
