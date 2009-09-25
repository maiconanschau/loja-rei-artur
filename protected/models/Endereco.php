<?php

class Endereco extends CActiveRecord {
/**
 * The followings are the available columns in table 'Endereco':
 * @var integer $idCliente
 * @var integer $idEndereco
 * @var integer $tipoEndereco
 * @var string $ruaEndereco
 * @var string $numeroEndereco
 * @var string $complementoEndereco
 * @var string $bairroEndereco
 * @var string $cepEndereco
 * @var string $cidadeEndereco
 * @var string $estadoEndereco
 */

const TIPO_PADRAO = 1;
const TIPO_EXTRA = 2;

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
        return 'Endereco';
    }

    public function getTipoOptions() {
        return array(
            self::TIPO_PADRAO=>"Padrão",
            self::TIPO_EXTRA=>"Extra"
        );
    }

    public function getTipoTexto() {
        $options = $this->getTipoOptions();
        return isset($options[$this->tipoEndereco]) ? $options[$this->tipoEndereco] : "desconhecido ({$this->tipoEndereco})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('ruaEndereco','length','max'=>150),
        array('numeroEndereco','length','max'=>10),
        array('complementoEndereco','length','max'=>10),
        array('bairroEndereco','length','max'=>45),
        array('cepEndereco','length','max'=>8),
        array('cidadeEndereco','length','max'=>150),
        array('estadoEndereco','length','max'=>2),
        array('idCliente, tipoEndereco, ruaEndereco, numeroEndereco, bairroEndereco, cepEndereco, cidadeEndereco, estadoEndereco', 'required'),
        array('idCliente, idEndereco, tipoEndereco', 'numerical', 'integerOnly'=>true),
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
        'idCliente'=>'Cliente',
        'idEndereco'=>'Id',
        'tipoEndereco'=>'Tipo',
        'ruaEndereco'=>'Rua',
        'numeroEndereco'=>'Número',
        'complementoEndereco'=>'Complemento',
        'bairroEndereco'=>'Bairro',
        'cepEndereco'=>'CEP',
        'cidadeEndereco'=>'Cidade',
        'estadoEndereco'=>'Estado',
        );
    }

    public function beforeValidate() {
        if (!is_numeric($this->tipoEndereco)) $this->tipoEndereco = self::TIPO_PADRAO;
        $this->cepEndereco = preg_replace("/[^0-9]/", "", $this->cepEndereco);
        return true;
    }
}