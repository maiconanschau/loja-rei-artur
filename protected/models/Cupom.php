<?php

class Cupom extends CActiveRecord
{

        const TIPO_PERCENTUAL = 0;
        const TIPO_VALOR = 1;
        const RESTRITO = 0;
        const NAO_RESTRISTO = 1;
	/**
        	 * The followings are the available columns in table 'Cupom':
	 * @var integer $idCupom
	 * @var string $chaveCupom
	 * @var string $valorCupom
	 * @var integer $tipoCupom
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
			array('tipoCupom, restritoCupom', 'required'),
			array('tipoCupom, restritoCupom', 'numerical', 'integerOnly'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		 return array(
          'cliente'=>array(self::HAS_MANY, 'Cliente', 'idCliente'),
          'pedido'=>array(self::HAS_MANY,'Pedido','idCupom'),
        );
	}

          public function getTipoCupom() {
        return array(
            self::TIPO_PERCENTUAL=>'Percentual',
            self::TIPO_VALOR=>'Valor'
         );
    }

        public function getRestritoCupom() {
        return array(
            self::RESTRITO=>'Restrito',
            self::NAO_RESTRITO=>'Nao Restrito'
         );
    }
   

    public function getTipoText() {
        $options = $this->getTipoCupom();
        return isset($options[$this->tipoCupom]) ? $options[$this->tipoCupom] : "desconhecido ({$this->tipoCupom})";
    }

      public function getRestritoText() {
        $options = $this->getTipoCupom();
        return isset($options[$this->restritoCupom]) ? $options[$this->restritoCupom] : "desconhecido ({$this->restritoCupom})";
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
     public function attributeLabels()
	{
		return array(
			'idCupom' => 'Id Cupom',
			'chaveCupom' => 'Chave Cupom',
			'valorCupom' => 'Valor Cupom',
			'tipoCupom' => 'Tipo Cupom',
			'restritoCupom' => 'Restrito Cupom',
		);
	}

//gera chave aleatoria
     function GeraChave()
     {
        $caracteres = "A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,X,W,Y,Z,1,2,3,4,5,6,7,8,9,0";
        $array = explode(",", $caracteres);
        shuffle($array);
        $chave = implode($array,"");
        return substr($chave,0,5);
     }
     
//pra incluir um cupom
   public function incluirCupom()
    {
    $sql = "INSERT INTO Cupom(idCupom, chaveCupom, valorCupom,tipoCupom,restritoCupom) " .
           "VALUES (:idCupom, :chaveCupom, :valorCupom, :tipoCupom, :restritoCupom)";

    $comando = Yii::app() -> db -> createCommand($sql);
    $comando -> bindParam(":idCupom", $this -> idCupom, PDO::PARAM_STR);
    $comando -> bindParam(":chaveCupom", $this -> chaveCupom, PDO::PARAM_STR);
    $comando -> bindParam(":valorCupom", $this -> valorCupom, PDO::PARAM_INT);
    $comando -> bindParam(":tipoCupom", $this -> tipoCupom, PDO::PARAM_INT);
    $comando -> bindParam(":restritoCupom", $this -> restritoCupom, PDO::PARAM_INT);
    $control = $comando -> execute();
    return ($control > 0);
    }

    //pra pegar um cupom específico
    public function pegarCupom()  {
    $sql = "SELECT * FROM cupom WHERE idCupom = :idCupom";
    $comando = Yii::app() -> db -> createCommand($sql);
    $comando -> bindParam(":idCupom", $this -> idCupom, PDO::PARAM_STR);
    $fila = $comando -> queryRow();
    if($fila === false)
    return false;
    $this -> idCupom   = $fila['idCupom'];
    $this -> chaveCupom = $fila['chaveCupom'];
    $this -> valorCupom = $fila['valorCupom'];
    $this -> tipoCupom = $fila['tipoCupom'];
    $this -> restritoCupom = $fila['restritoCupom'];
    return true;
     }
}