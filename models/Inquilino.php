<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "inquilino".
 *
 * @property integer $id
 * @property string $nome
 * @property string $nacionalidade
 * @property string $estado_civil
 * @property string $profissao
 * @property integer $identidade
 * @property integer $cpf
 * @property string $endereco
 * @property string $bairro
 * @property string $fone
 * @property string $email
 * @property string $obs
 *
 * @property ContratoInquilino[] $contratoInquilinos
 * @property Contrato[] $idContratos
 * @property Pagamento[] $pagamentos
 * @property User $user
 */
class Inquilino extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inquilino';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'nacionalidade', 'estado_civil', 'profissao', 'identidade', 'cpf', 'endereco', 'bairro', 'fone', 'email', 'obs'], 'required'],
            [['id', 'identidade', 'cpf'], 'integer'],
            [['nome', 'profissao', 'bairro', 'email'], 'string', 'max' => 100],
            [['nacionalidade', 'estado_civil'], 'string', 'max' => 50],
            [['endereco'], 'string', 'max' => 150],
            [['fone'], 'string', 'max' => 12],
            [['obs'], 'string', 'max' => 200],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'nacionalidade' => 'Nacionalidade',
            'estado_civil' => 'Estado Civil',
            'profissao' => 'Profissao',
            'identidade' => 'Identidade',
            'cpf' => 'Cpf',
            'endereco' => 'Endereco',
            'bairro' => 'Bairro',
            'fone' => 'Fone',
            'email' => 'Email',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratoInquilinos()
    {
        return $this->hasMany(ContratoInquilino::className(), ['id_inquilino' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contrato::className(), ['id' => 'id_contrato'])->viaTable('contrato_inquilino', ['id_inquilino' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagamentos()
    {
        return $this->hasMany(Pagamento::className(), ['id_inquilino' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
}
