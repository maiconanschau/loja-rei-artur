<?php

class FotoProduto extends CActiveRecord {
/**
 * The followings are the available columns in table 'FotoProduto':
 * @var string $idProduto
 * @var integer $idFotoProduto
 * @var string $arquivoFotoProduto
 * @var integer $visivelFotoProduto
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
        return 'FotoProduto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('idProduto','length','max'=>20),
        array('arquivoFotoProduto','length','max'=>45),
        array('idProduto, arquivoFotoProduto, visivelFotoProduto', 'required'),
        array('idFotoProduto, visivelFotoProduto', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
            'produto'=>array(self::BELONGS_TO,'Produto','idProduto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idProduto'=>'Produto',
        'idFotoProduto'=>'Id',
        'arquivoFotoProduto'=>'Arquivo',
        'visivelFotoProduto'=>'Visível',
        );
    }
}