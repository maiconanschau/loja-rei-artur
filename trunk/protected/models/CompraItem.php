<?php

class CompraItem extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'CompraItem':
	 * @var double $idCompraItem
	 * @var double $idCompra
	 * @var integer $idCategoria
	 * @var integer $idProduto
	 * @var integer $quantidadeCompraItem
	 * @var string $precoCompraItem
	 */

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CompraItem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('precoCompraItem','length','max'=>10),
			array('idCompra, idCategoria, idProduto, quantidadeCompraItem, precoCompraItem', 'required'),
			array('idCategoria, idProduto, quantidadeCompraItem', 'numerical', 'integerOnly'=>true),
			array('idCompraItem, idCompra', 'numerical'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCompraItem'=>'Id Compra Item',
			'idCompra'=>'Id Compra',
			'idCategoria'=>'Id Categoria',
			'idProduto'=>'Id Produto',
			'quantidadeCompraItem'=>'Quantidade Compra Item',
			'precoCompraItem'=>'Preco Compra Item',
		);
	}
}