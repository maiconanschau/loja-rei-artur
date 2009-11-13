<?php

class Mensagem extends CActiveRecord {
/**
 * The followings are the available columns in table 'Mensagem':
 * @var integer $idMensagem
 * @var string $assuntoMensagem
 * @var string $conteudoMensagem
 * @var integer $statusMensagem
 * @var integer $idCupom
 */

    const STATUS_AGUARDANDO = 0;
    const STATUS_ENVIANDO = 1;
    const STATUS_CONCLUIDO = 2;

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
        return 'Mensagem';
    }

    public static function getStatusOptions() {
        return array(
            self::STATUS_AGUARDANDO =>  'Aguardando',
            self::STATUS_ENVIANDO   =>  'Enviando',
            self::STATUS_CONCLUIDO  =>  'Concluido',
        );
    }

    public static function getStatusText() {
        $options = self::getStatusOptions();
        return isset($options[$this->statusMensagem]) ? $options[$this->statusMensagem] : "desconhecido ({$this->statusMensagem})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('assuntoMensagem','length','max'=>150),
        array('assuntoMensagem, conteudoMensagem, statusMensagem', 'required'),
        array('statusMensagem, idCupom', 'numerical', 'integerOnly'=>true),
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
        'idMensagem'=>'Id',
        'assuntoMensagem'=>'Assunto',
        'conteudoMensagem'=>'Conteúdo',
        'statusMensagem'=>'Status',
        'idCupom'=>'Cupom',
        );
    }

    public function beforeValidate() {
        if (empty($this->statusMensagem)) $this->statusMensagem = self::STATUS_AGUARDANDO;
        return true;
    }
}