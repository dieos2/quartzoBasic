<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "contrato_inquilino".
 *
 * @property integer $id_contrato
 * @property integer $id_inquilino
 * @property integer $percentual_pagamento
 *
 * @property Contrato $idContrato
 * @property Inquilino $idInquilino
 */
class ContratoInquilino extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contrato_inquilino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_contrato', 'id_inquilino'], 'required'],
            [['id_contrato', 'id_inquilino', 'percentual_pagamento'], 'integer']
          
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_contrato' => 'Id Contrato',
            'id_inquilino' => 'Id Inquilino',
            'percentual_pagamento' => 'Percentual Pagamento'
           
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
}
