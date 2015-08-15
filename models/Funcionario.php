<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "funcionario".
 *
 * @property integer $id
 * @property string $nome
 * @property string $endereco
 * @property string $estado_civil
 * @property integer $n_filhos_menores
 * @property integer $rg
 * @property integer $cpf
 * @property integer $ctps
 * @property integer $pis_pasep
 * @property string $funcao
 * @property string $data_admissao
 * @property string $data_demissao
 * @property string $salario
 * @property integer $carga_horaia
 * @property string $obs
 * @property string $email
 *
 * @property User $id0
 */
class Funcionario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'funcionario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'endereco', 'estado_civil', 'n_filhos_menores', 'rg', 'cpf', 'ctps', 'pis_pasep', 'funcao', 'salario', 'carga_horaia', 'email'], 'required'],
            [['n_filhos_menores', 'rg', 'cpf', 'ctps', 'pis_pasep', 'carga_horaia'], 'integer'],
            [['data_admissao', 'data_demissao'], 'safe'],
            [['salario'], 'number'],
            [['nome', 'endereco', 'email'], 'string', 'max' => 150],
            [['estado_civil'], 'string', 'max' => 8],
            [['funcao', 'obs'], 'string', 'max' => 200]
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
            'endereco' => 'Endereco',
            'estado_civil' => 'Estado Civil',
            'n_filhos_menores' => 'N Filhos Menores',
            'rg' => 'Rg',
            'cpf' => 'Cpf',
            'ctps' => 'Ctps',
            'pis_pasep' => 'Pis Pasep',
            'funcao' => 'Funcao',
            'data_admissao' => 'Data Admissao',
            'data_demissao' => 'Data Demissao',
            'salario' => 'Salario',
            'carga_horaia' => 'Carga Horaia',
            'obs' => 'Obs',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
    
}
