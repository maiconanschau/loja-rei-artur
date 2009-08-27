<?php

class CategoriaProduto extends CActiveRecord {
/**
 * The followings are the available columns in table 'CategoriaProduto':
 * @var string $idCategoria
 * @var string $nomeCategoria
 * @var integer $visivelCategoria
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
        return 'CategoriaProduto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('idCategoria','length','max'=>20),
        array('nomeCategoria','length','max'=>45),
        array('descricaoCategoria','length','max'=>255),
        array('nomeCategoria, visivelCategoria, descricaoCategoria', 'required'),
        array('visivelCategoria', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
            'produtos'=>array(self::HAS_MANY,'Produto','idCategoria'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idCategoria'=>'Id',
        'nomeCategoria'=>'Nome',
        'descricaoCategoria'=>'Descrição',
        'visivelCategoria'=>'Visível',
        );
    }
}