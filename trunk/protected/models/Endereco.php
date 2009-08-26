<?php

class Endereco extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Endereco':
	 * @var integer $idCliente
	 * @var integer $idEndereco
	 * @var integer $tipoEndereco
	 * @var string $ruaEndereco
	 * @var string $numeroEndereco
	 * @var string $complementoEndereco
	 * @var string $bairroEndereco
	 * @var string $cepEndereco
	 * @var string $cidadeEndereco
	 * @var string $estadoEndereco
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
		return 'Endereco';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('ruaEndereco','length','max'=>150),
			array('numeroEndereco','length','max'=>10),
			array('complementoEndereco','length','max'=>10),
			array('bairroEndereco','length','max'=>45),
			array('cepEndereco','length','max'=>8),
			array('cidadeEndereco','length','max'=>150),
			array('estadoEndereco','length','max'=>2),
			array('idCliente, idEndereco, tipoEndereco, ruaEndereco, numeroEndereco, bairroEndereco, cepEndereco, cidadeEndereco, estadoEndereco', 'required'),
			array('idCliente, idEndereco, tipoEndereco', 'numerical', 'integerOnly'=>true),
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
			'idCliente'=>'Id Cliente',
			'idEndereco'=>'Id Endereco',
			'tipoEndereco'=>'Tipo Endereco',
			'ruaEndereco'=>'Rua Endereco',
			'numeroEndereco'=>'Numero Endereco',
			'complementoEndereco'=>'Complemento Endereco',
			'bairroEndereco'=>'Bairro Endereco',
			'cepEndereco'=>'Cep Endereco',
			'cidadeEndereco'=>'Cidade Endereco',
			'estadoEndereco'=>'Estado Endereco',
		);
	}
}