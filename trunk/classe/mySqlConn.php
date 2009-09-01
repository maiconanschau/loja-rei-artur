<?php 

abstract class mySqlConn{

	protected $host, $user, $pass, $dba, $conn, $sql, $qr, $data, $status, $totalFields, $error;
	
	//incializa  as variáaveis de conexão
	public function __construct(){
		$this->host = "localhost";
		$this->user = "root";
		$this->pass = "";
		$this->dba = "vianna_reiartur";
		self::connect(); // executa o método de conexão automaticamente ao herdar a classe
	}
	
	// efetuar a conexão com o banco de dados
	protected function connect(){
		$this->conn = @mysql_connect($this->host, $this->user, $this->pass) or die 
	("<b><center>Erro ao acessar banco de dados </b></center><br />".mysql_error());
		$this->dba = @mysql_select_db($this->dba) or die 
	("<b><center>Erro ao selecionar banco de dados: </b></center><br />".mysql_error());
	}
	//  executar comandos SQL
	protected function execSQL($sql){
		$this->qr = @mysql_query($sql) or die ("<b><center>Erro ao Executar o Query: $sql - </b></center><br />".mysql_error());
		return $this->qr;
	}
	
	//  executa e lista dados do banco 
	protected function listQr($qr){
		$this->data = @mysql_fetch_assoc($qr);
		return $this->data;
	}

	//  lista a quantidade de dados encontrados no query
	protected function countData($qr){
		$this->totalFields = mysql_num_rows($qr);
		return $this->totalFields;
	}
}
?>