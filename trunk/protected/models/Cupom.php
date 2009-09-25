<?php

class Cupom extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'Cupom':
	 * @var integer $idCupom
	 * @var string $chaveCupom
	 * @var string $valorCupom
	 * @var integer $tipoCupom
	 * @var integer $restritoCupom
	 */

         const TIPO_VALOR = 1;
         const TIPO_PORCENTAGEM = 2;

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

        public function getTipoOptions() {
            return array(
                self::TIPO_VALOR => "Valor",
                self::TIPO_PORCENTAGEM => "Porcentagem",
            );
        }

        public function getTipoTexto() {
            $options = $this->getTipoOptions();
            return isset($options[$this->tipoCupom]) ? $options[$this->tipoCupom] : "desconhecido ({$this->tipoCupom})";
        }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('chaveCupom','length','max'=>45),
			array('chaveCupom','unique'),
			array('valorCupom','length','max'=>10),
			array('chaveCupom, valorCupom, tipoCupom', 'required'),
			array('tipoCupom, restritoCupom', 'numerical', 'integerOnly'=>true),
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
                    'cliente'=>array(self::MANY_MANY, 'Cliente', 'ClienteCupom(idCupom,idCliente)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idCupom'=>'Id',
			'chaveCupom'=>'Chave',
			'valorCupom'=>'Valor',
			'tipoCupom'=>'Tipo',
			'restritoCupom'=>'Restrito',
		);
	}

        public function beforeValidate() {
            if (empty($this->chaveCupom)) {
                $this->chaveCupom = substr(md5(microtime()), 0, 20);
            }
            return true;
        }
}