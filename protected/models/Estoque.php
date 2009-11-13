<?php

class Estoque extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Estoque':
	 * @var integer $idEstoque
	 * @var integer $idCategoria
	 * @var integer $idProduto
	 * @var integer $mesEstoque
	 * @var integer $anoEstoque
	 * @var integer $quantEstoque
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
		return 'Estoque';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('idEstoque, idCategoria, idProduto, mesEstoque, anoEstoque, quantEstoque', 'required'),
			array('idEstoque, idCategoria, idProduto, mesEstoque, anoEstoque, quantEstoque', 'numerical', 'integerOnly'=>true),
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
			'idEstoque'=>'Id Estoque',
			'idCategoria'=>'Id Categoria',
			'idProduto'=>'Id Produto',
			'mesEstoque'=>'Mes Estoque',
			'anoEstoque'=>'Ano Estoque',
			'quantEstoque'=>'Quant Estoque',
		);
	}
}