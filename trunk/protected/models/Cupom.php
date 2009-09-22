<?php

class Cupom extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Cupom':
	 * @var integer $idCupom
	 * @var string $chaveCupom
	 * @var string $valorCupom
	 * @var integer $tipoCupom
	 * @var integer $usoUnicoCupom
	 * @var integer $restritoCupom
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
		return 'Cupom';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('chaveCupom','length','max'=>45),
			array('valorCupom','length','max'=>10),
			array('chaveCupom, valorCupom, tipoCupom, usoUnicoCupom, restritoCupom', 'required'),
			array('tipoCupom, usoUnicoCupom, restritoCupom', 'numerical', 'integerOnly'=>true),
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
			'idCupom'=>'Id Cupom',
			'chaveCupom'=>'Chave Cupom',
			'valorCupom'=>'Valor Cupom',
			'tipoCupom'=>'Tipo Cupom',
			'usoUnicoCupom'=>'Uso Unico Cupom',
			'restritoCupom'=>'Restrito Cupom',
		);
	}
}