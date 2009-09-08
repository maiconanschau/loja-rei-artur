<?php

class Comentario extends CActiveRecord
{
	const STATUS_PENDENTE=0;
	const STATUS_APROVADO=1;
        

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	public function tableName()
	{
		return 'Comentario';
	}

	
	public function rules()
	{
		return array(
			array('conteudo', 'required'),
                        array('conteudo','length','max'=>300)
		);
	}

	
	public function relations()
	{	
		return array(
	'produto'=>array(self::BELONGS_TO, 'Produto', 'idProduto', 'joinType'=>'INNER JOIN'),
        'cliente'=>array(self::BELONGS_TO,'Cliente','idCliente,joinType'=>'INNER JOIN'),
		);
	}

        public function accessRules()
	{
		return array(
			array('allow', 	'actions'=>array('listar'),'users'=>array('*'),	),
			array('allow','users'=>array('@'),),			
		);
	}

        public function getStatus()
	{
		return array(
			self::STATUS_PENDENTE=>'Pendente',
			self::STATUS_APROVADO=>'Aprovado',
		);
	}
	
	public function attributeLabels()
	{
		return array(
			'idComentario' => 'Id Comentario',
			'conteudo' => 'Conteudo',
			'status' => 'Status',
			'dataCriacao' => 'Data Criacao',
			'idCliente' => 'Id Cliente',
			'idProduto' => 'Id Produto',
		);
	}
}