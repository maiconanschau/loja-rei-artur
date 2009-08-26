<?php

class ClienteJuridico extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'ClienteJuridico':
	 * @var integer $idCliente
	 * @var string $razaoSocialCliente
	 * @var integer $cnpjCliente
	 * @var string $incricaoEstadualCliente
	 * @var string $responsavelCliente
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
		return 'ClienteJuridico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('razaoSocialCliente','length','max'=>150),
			array('incricaoEstadualCliente','length','max'=>45),
			array('responsavelCliente','length','max'=>150),
			array('idCliente, razaoSocialCliente, cnpjCliente, incricaoEstadualCliente, responsavelCliente', 'required'),
			array('idCliente, cnpjCliente', 'numerical', 'integerOnly'=>true),
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
			'razaoSocialCliente'=>'Razao Social Cliente',
			'cnpjCliente'=>'Cnpj Cliente',
			'incricaoEstadualCliente'=>'Incricao Estadual Cliente',
			'responsavelCliente'=>'Responsavel Cliente',
		);
	}
}