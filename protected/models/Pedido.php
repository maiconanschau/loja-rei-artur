<?php

class Pedido extends CActiveRecord {
/**
 * The followings are the available columns in table 'Pedido':
 * @var integer $idPedido
 * @var integer $idCupom
 * @var integer $idCliente
 * @var integer $idEndereco
 * @var string $dataPedido
 * @var string $valorEntrega
 */

    const FORMA_BOLETO = 1;
    const FORMA_TRANSFERENCIA = 2;

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
        return 'Pedido';
    }

    public static function getFormaOptions() {
        return array(
        self::FORMA_BOLETO => "Boleto bancário",
        self::FORMA_TRANSFERENCIA => "Débito em conta",
        );
    }

    public function getFormaText() {
        $options = $this->getFormaOptions();
        return isset($options[$this->formaPagamentoPedido]) ? $options[$this->formaPagamentoPedido] : "desconhecido ({$this->formaPagamentoPedido})";
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        return array(
        array('valorEntrega','length','max'=>10),
        array('dataPedido, valorEntrega, formaPagamentoPedido', 'required'),
        array('idCupom, formaPagamentoPedido', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
    // NOTE: you may need to adjust the relation name and the related
    // class name for the relations automatically generated below.
        return array(
        'cliente'=>array(self::BELONGS_TO, 'Cliente','idCliente'),
        'item'=>array(self::HAS_MANY,'PedidoItem','idPedido'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
        'idPedido'=>'Id',
        'idCupom'=>'Cupom',
        'idCliente'=>'Cliente',
        'idEndereco'=>'Endereço',
        'dataPedido'=>'Data',
        'valorEntrega'=>'Valor',
        );
    }

    public function beforeValidate() {
        if (empty($this->dataPedido)) {
            $this->dataPedido = date("Y-m-d H:i:s");
        }
        return true;
    }
}