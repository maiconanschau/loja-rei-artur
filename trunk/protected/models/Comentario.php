<?php

class Comentario extends CActiveRecord {
/**
 * The followings are the available columns in table 'Comentario':
 * @var integer $idComentario
 * @var string $conteudoComentario
 * @var integer $statusComentario
 * @var string $dataComentario
 * @var integer $idCliente
 * @var integer $idProduto
 */

    const STATUS_NOVO = 0;
    const STATUS_APROVADO = 1;

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
        return 'Comentario';
    }

    public function getStatusOptions() {
        return array(
            self::STATUS_NOVO=>'Novo',
            self::STATUS_APROVADO=>'Aprovado'
        );
    }

    public function getStatusText() {
        $options = $this->getStatusOptions();
        return isset($options[$this->statusComentario]) ? $options[$this->statusComentario] : "desconhecido ({$this->statusComentario})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('conteudoComentario, statusComentario, dataComentario, idCliente, idProduto', 'required'),
        array('conteudoComentario','length','max'=>1000),
        array('statusComentario, idCliente, idProduto', 'numerical', 'integerOnly'=>true),
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
        'produto'=>array(self::BELONGS_TO,'Produto','idProduto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idComentario'=>'Id',
        'conteudoComentario'=>'Comentário',
        'statusComentario'=>'Status',
        'dataComentario'=>'Data',
        'idCliente'=>'Cliente',
        'idProduto'=>'Produto',
        );
    }

    public function beforeValidate() {
        if (empty($this->dataComentario)) $this->dataComentario = date("Y-m-d H:i:s");
        if (empty($this->statusComentario)) $this->statusComentario = self::STATUS_NOVO;
        return true;
    }
}