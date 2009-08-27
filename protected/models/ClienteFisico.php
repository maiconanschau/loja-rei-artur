<?php

class ClienteFisico extends CActiveRecord {
/**
 * The followings are the available columns in table 'ClienteFisico':
 * @var integer $idCliente
 * @var string $nomeCliente
 * @var integer $cpfCliente
 * @var string $sexoCliente
 * @var string $nascimentoCliente
 */

    const SEXO_MASCULINO = "M";
    const SEXO_FEMININO = "F";

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
        return 'ClienteFisico';
    }

    public function getSexoOptions() {
        return array(
            self::SEXO_MASCULINO=>'Masculino',
            self::SEXO_FEMININO=>'Feminino'
        );
    }

    public function getSexoTexto() {
        $options = $this->getSexoOptions();
        return isset($options[$this->sexoCliente]) ? $options[$this->sexoCliente] : "desconhecido ({$this->sexoCliente})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('nomeCliente','length','max'=>150),
        array('sexoCliente','length','max'=>1),
        array('cpfCliente','unique'),
        array('nomeCliente, cpfCliente, sexoCliente, nascimentoCliente', 'required'),
        array('idCliente', 'numerical', 'integerOnly'=>true),
        array('cpfCliente','application.extensions.TXGruppi.Validators.CTXCpfValidator'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
        'cliente'=>array(self::BELONGS_TO,'Cliente','idCliente'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idCliente'=>'Id',
        'nomeCliente'=>'Nome',
        'cpfCliente'=>'CPF',
        'sexoCliente'=>'Sexo',
        'nascimentoCliente'=>'Nascimento',
        );
    }

    public function beforeValidate() {
        $this->cpfCliente = preg_replace("/[^0-9]/","",$this->cpfCliente);
        return true;
    }
}