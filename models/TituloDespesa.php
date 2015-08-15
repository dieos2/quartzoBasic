<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "titulo_despesa".
 *
 * @property integer $id
 * @property string $titulo
 *
 * @property Despesa[] $despesas
 */
class TituloDespesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'titulo_despesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titulo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['id_titulo_despesa' => 'id']);
    }
}
