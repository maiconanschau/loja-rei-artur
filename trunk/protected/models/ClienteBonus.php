<?php

class ClienteBonus extends CActiveRecord {
/**
 * The followings are the available columns in table 'ClienteBonus':
 * @var integer $idBonus
 * @var integer $idCliente
 * @var string $valorBonus
 * @var string $origemBonus
 * @var string $dataBonus
 */

 const ORIGEM_QUESTIONARIOSE = 'questionarioSocioEconomico';

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
        return 'ClienteBonus';
    }

    public function getOrigemOptions() {
        return array(
            self::ORIGEM_QUESTIONARIOSE=>'Questionário Sócio-economico',
        );
    }

    public function getOrigemTexto() {
        $options = $this->getOrigemOptions();
        return isset($options[$this->origemBonus]) ? $options[$this->origemBonus] : "desonhecido ({$this->origemBonus})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('valorBonus','length','max'=>10),
        array('origemBonus','length','max'=>255),
        array('idCliente, valorBonus, origemBonus, dataBonus', 'required'),
        array('idCliente', 'numerical', 'integerOnly'=>true),
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
        'idBonus' => 'Id',
        'idCliente' => 'Cliente',
        'valorBonus' => 'Valor',
        'origemBonus' => 'Origem',
        'dataBonus' => 'Data',
        );
    }

    public function beforeValidate() {
        if (empty($this->dataBonus)) $this->dataBonus = date("Y-m-d H:i:s");
        return true;
    }
}