<?php

class ClienteMensagem extends CActiveRecord {
/**
 * The followings are the available columns in table 'ClienteMensagem':
 * @var integer $idMensagem
 * @var integer $idCliente
 * @var integer $statusClienteMensagem
 */

    const STATUS_AGUARDANDO = 0;
    const STATUS_ENVIADO = 1;
    
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
        return 'ClienteMensagem';
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_AGUARDANDO => 'Aguardando',
            self::STATUS_ENVIADO    => 'Enviado',
        );
    }

    public function getStatusText() {
        $options = $this->getStatusOptions();
        return isset($options[$this->statusClienteMensagem]) ? $options[$this->statusClienteMensagem] : "desconhecido ({$this->statusClienteMensagem})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('idMensagem, idCliente, statusClienteMensagem', 'required'),
        array('idMensagem, idCliente, statusClienteMensagem', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idMensagem'=>'Id Mensagem',
        'idCliente'=>'Id Cliente',
        'statusClienteMensagem'=>'Status Cliente Mensagem',
        );
    }
}