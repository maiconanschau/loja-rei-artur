<?php

class CupomMeta extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'CupomMeta':
	 * @var integer $idCupomMeta
	 * @var string $chaveCupomMeta
	 * @var string $valorCupomMeta
	 * @var integer $idCupom
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
		return 'CupomMeta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('chaveCupomMeta','length','max'=>255),
			array('chaveCupomMeta, valorCupomMeta, idCupom', 'required'),
			array('idCupom', 'numerical', 'integerOnly'=>true),
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
			'idCupomMeta'=>'Id Cupom Meta',
			'chaveCupomMeta'=>'Chave Cupom Meta',
			'valorCupomMeta'=>'Valor Cupom Meta',
			'idCupom'=>'Id Cupom',
		);
	}
}