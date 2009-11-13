<?php

class PedidoItem extends CActiveRecord {
/**
 * The followings are the available columns in table 'PedidoItem':
 * @var integer $idCliente
 * @var integer $idEndereco
 * @var integer $idCategoria
 * @var double $idProduto
 * @var integer $idPedido
 * @var integer $quantidadePedidoItem
 * @var string $valorPedidoItem
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
        return 'PedidoItem';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('valorPedidoItem','length','max'=>10),
        array('idCliente, idEndereco, idCategoria, idProduto, idPedido, quantidadePedidoItem, valorPedidoItem', 'required'),
        array('idCliente, idEndereco, idCategoria, idPedido, quantidadePedidoItem', 'numerical', 'integerOnly'=>true),
        array('idProduto', 'numerical'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
            'produto'=>array(self::BELONGS_TO, 'Produto', 'idProduto'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idCliente'=>'Id Cliente',
        'idEndereco'=>'Id Endereco',
        'idCategoria'=>'Id Categoria',
        'idProduto'=>'Id Produto',
        'idPedido'=>'Id Pedido',
        'quantidadePedidoItem'=>'Quantidade Pedido Item',
        'valorPedidoItem'=>'Valor Pedido Item',
        );
    }
}