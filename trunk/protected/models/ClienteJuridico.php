<?php

class ClienteJuridico extends CActiveRecord {
/**
 * The followings are the available columns in table 'ClienteJuridico':
 * @var integer $idCliente
 * @var string $razaoSocialCliente
 * @var integer $cnpjCliente
 * @var string $inscricaoEstadualCliente
 * @var string $responsavelCliente
 */

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
        return 'ClienteJuridico';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('razaoSocialCliente','length','max'=>150),
        array('inscricaoEstadualCliente','length','max'=>45),
        array('responsavelCliente','length','max'=>150),
        array('razaoSocialCliente, cnpjCliente, inscricaoEstadualCliente, responsavelCliente', 'required'),
        array('idCliente', 'numerical', 'integerOnly'=>true),
        array('cnpjCliente','application.extensions.TXGruppi.Validators.CTXCnpjValidator'),
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
        'razaoSocialCliente'=>'Razão Social',
        'cnpjCliente'=>'CNPJ',
        'inscricaoEstadualCliente'=>'Incricao Estadual',
        'responsavelCliente'=>'Responsável',
        );
    }

    public function beforeValidate() {
        $this->cnpjCliente = preg_replace("/[^0-9]/","",$this->cnpjCliente);
        return true;
    }
}