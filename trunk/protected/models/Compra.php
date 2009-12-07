<?php

class Compra extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Compra':
	 * @var double $idCompra
	 * @var string $freteCompra
	 * @var string $icmsCompra
	 * @var string $dataCompra
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
		return 'Compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('freteCompra','length','max'=>10),
			array('icmsCompra','length','max'=>10),
			array('freteCompra, icmsCompra', 'required'),
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
			'idCompra'=>'Id Compra',
			'freteCompra'=>'Frete Compra',
			'icmsCompra'=>'Icms Compra',
			'dataCompra'=>'Data Compra',
		);
	}

        public function beforeValidate() {
            if (empty($this->dataCompra)) $this->dataCompra = date("Y-m-d H:i:s");
            return true;
        }
}