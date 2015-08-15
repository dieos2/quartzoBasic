<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria_despesa".
 *
 * @property integer $id
 * @property string $categoria
 *
 * @property Despesa[] $despesas
 */
class CategoriaDespesa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categoria_despesa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['categoria'], 'required'],
            [['categoria'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'categoria' => 'Categoria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDespesas()
    {
        return $this->hasMany(Despesa::className(), ['id_categoria' => 'id']);
    }
}
