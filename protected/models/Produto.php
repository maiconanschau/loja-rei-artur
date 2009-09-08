<?php

class Produto extends CActiveRecord {
/**
 * The followings are the available columns in table 'Produto':
 * @var string $idProduto
 * @var string $idCategoria
 * @var string $nomeProduto
 * @var string $descricaoProduto
 * @var double $pesoProduto
 * @var string $precoProduto
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
        return 'Produto';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('idProduto','length','max'=>20),
        array('idCategoria','length','max'=>20),
        array('nomeProduto','length','max'=>45),
        array('precoProduto','length','max'=>10),
        array('fabricanteProduto','length','max'=>255),
        array('idCategoria, nomeProduto, descricaoCurtaProduto, descricaoLongaProduto, fabricanteProduto, pesoProduto, precoProduto', 'required'),
        array('pesoProduto', 'numerical'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
            'fotos'=>array(self::HAS_MANY,'FotoProduto','idProduto'),
            'fotosVisiveis'=>array(self::HAS_MANY,'FotoProduto','idProduto','condition'=>'??.visivelFotoProduto = 1'),
            'categoria'=>array(self::BELONGS_TO,'CategoriaProduto','idCategoria'),
            'comentarios'=>array(self::HAS_MANY, 'Comentario', 'idComentario', 'order'=>'??.dataCriacao'),
        );
    }

    
    public function attributeLabels() {
        return array(
        'idProduto'=>'Id',
        'idCategoria'=>'Categoria',
        'nomeProduto'=>'Nome',
        'descricaoCurtaProduto'=>'Descrição curta',
        'descricaoLongaProduto'=>'Descrição longa',
        'fabricanteProduto'=>'Fabricante',
        'pesoProduto'=>'Peso',
        'precoProduto'=>'Preço',
        );
    }
}