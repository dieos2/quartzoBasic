<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pagamento_aluguel".
 *
 * @property integer $id
 * @property string $valor
 * @property string $data
 * @property string $acrescimo
 * @property integer $id_inquilino
 * @property integer $id_contrato
 * @property integer $id_despesa
 *
 * @property Despesa $idDespesa
 * @property Inquilino $idInquilino
 * @property Contrato $idContrato
 */
class PagamentoAluguel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pagamento_aluguel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['valor', 'id_inquilino', 'id_contrato', 'id_despesa'], 'required'],
            [['valor', 'acrescimo'], 'number'],
            [['data'], 'safe'],
            [['id_inquilino', 'id_contrato', 'id_despesa'], 'integer']
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
            'id_despesa' => 'Id Despesa',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDespesa()
    {
        return $this->hasOne(Despesa::className(), ['id' => 'id_despesa']);
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
    public function getIdContrato()
    {
        return $this->hasOne(Contrato::className(), ['id' => 'id_contrato']);
    }
}
