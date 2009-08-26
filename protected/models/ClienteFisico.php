<?php

class ClienteFisico extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'ClienteFisico':
	 * @var integer $idCliente
	 * @var string $nomeCliente
	 * @var integer $cpfCliente
	 * @var string $sexoCliente
	 * @var string $nascimentoCliente
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
		return 'ClienteFisico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('nomeCliente','length','max'=>150),
			array('sexoCliente','length','max'=>1),
			array('idCliente, nomeCliente, cpfCliente, sexoCliente, nascimentoCliente', 'required'),
			array('idCliente, cpfCliente', 'numerical', 'integerOnly'=>true),
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
			'nomeCliente'=>'Nome Cliente',
			'cpfCliente'=>'Cpf Cliente',
			'sexoCliente'=>'Sexo Cliente',
			'nascimentoCliente'=>'Nascimento Cliente',
		);
	}
}