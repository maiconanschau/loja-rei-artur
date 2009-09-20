<?php

class Cliente extends CActiveRecord {
/**
 *
 * The followings are the available columns in table 'Cliente':
 * @var integer $idCliente
 * @var integer $tipoCliente
 * @var string $emailCliente
 * @var string $senhaCliente
 * @var integer $telefoneCliente
 * @var integer $celularCliente
 * @var string $chamadoCliente
 * @var integer $newsletterCliente
 */

    const TIPO_FISICO = 1;
    const TIPO_JURIDICO = 2;

    public $senha2Cliente;

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className=__CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'Cliente';
    }

    public function getTipoOptions() {
        return array(
            self::TIPO_FISICO=>'Físico',
            self::TIPO_JURIDICO=>'Jurídico'
        );
    }

    public function getTipoTexto() {
        $options = $this->getTipoOptions();
        return isset($options[$this->tipoCliente]) ? $options[$this->tipoCliente] : "desconhecido ({$this->tipoCliente})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('emailCliente','length','max'=>150),
        array('emailCliente','email'),
        array('emailCliente','unique'),
        array('senhaCliente','length','max'=>32),
        array('senhaCliente', 'compare', 'compareAttribute'=>'senha2Cliente', 'on'=>'create'),
        array('senha2Cliente', 'required', 'on'=>'create'),
        array('chamadoCliente','length','max'=>45),
        array('tipoCliente, emailCliente, senhaCliente, chamadoCliente', 'required'),
        array('tipoCliente, telefoneCliente, celularCliente, newsletterCliente', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
        'clienteFisico'=>array(self::HAS_ONE,'ClienteFisico','idCliente'),
        'clienteJuridico'=>array(self::HAS_ONE,'ClienteJuridico','idCliente'),
        'enderecos'=>array(self::HAS_MANY,'Endereco','idCliente'),
        'respostasQuestionario'=>array(self::HAS_MANY,'QuestionarioCliente','idCliente'),
        'cupom'=>array(self::HAS_MANY, 'Cupom', 'idCliente'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idCliente' => 'Id',
        'tipoCliente' => 'Tipo',
        'emailCliente' => 'E-mail',
        'senhaCliente' => 'Senha',
        'senha2Cliente' => 'Confirmação',
        'telefoneCliente' => 'Telefone',
        'celularCliente' => 'Celular',
        'chamadoCliente' => 'Tratamento',
        'newsletterCliente' => 'Newsletter',
        );
    }

    public function beforeValidate() {
        $this->telefoneCliente = preg_replace("/[^0-9]/","",$this->telefoneCliente);
        $this->celularCliente = preg_replace("/[^0-9]/","",$this->celularCliente);
        return true;
    }

    public function beforeSave() {
        $this->senhaCliente = md5($this->senhaCliente.Yii::app()->params['md5Salt']);
        return true;
    }
}