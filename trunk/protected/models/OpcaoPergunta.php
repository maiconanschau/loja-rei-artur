<?php

class OpcaoPergunta extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'OpcaoPergunta':
	 * @var integer $idOpcao
	 * @var integer $idPergunta
	 * @var string $valorOpcao
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
		return 'OpcaoPergunta';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('valorOpcao','length','max'=>150),
			array('idPergunta, valorOpcao', 'required'),
			array('idPergunta', 'numerical', 'integerOnly'=>true),
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
                    'pergunta'=>array(self::HAS_ONE,'PerguntaQuestionario','idPergunta'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idOpcao' => 'Id Opcao',
			'idPergunta' => 'Id Pergunta',
			'valorOpcao' => 'Valor Opcao',
		);
	}
}