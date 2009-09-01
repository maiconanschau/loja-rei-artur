<?php

include_once("mySqlConn.php");

class ManipulateData extends mySqlConn{
	
	protected $sql, $table, $fields, $dados, $status, $fieldId, $valueId; 

	//envia o nome da tabela a ser usada na classe
	public function setTable($t){
		$this->table = $t;
	}
	
	//envia os campos a serem usados na classe
	public function setFields($f){
		$this->fields = $f;
	}
	
	// envia os dados a serem usados na classe
	public function setDados($d){
		$this->dados = $d;
	}
	
	//envia o campo de pesquisa, normalmente o campo código
	public function setFieldId($fi){
		$this->fieldId = $fi;
	}
	
	// envia os dados a serem cadastrados ou pesquisados
	public function setValueId($vi){
		$this->valueId = $vi;
	}	
	
	//recebe o status atual, erros ou acertos
	public function getStatus(){
		return $this->status;
	}
	
	//método que efetua cadastro de dados no banco
	public function insert(){
		$this->sql = "INSERT INTO $this->table(
							$this->fields
					  )VALUES(
					  		$this->dados
					  )";
		if(self::execSql($this->sql)){
			$this->status = "Cadastrado com Sucesso!!!";
		}			  
	}
	
	// método que efetua a exclusão de dados no banco
	public function delete(){
		$this->sql = "DELETE FROM $this->table WHERE $this->fieldId = '$this->valueId'";
		if(self::execSQL($this->sql)){
			$this->status = "Apagado com Sucesso!!!";
		}
	}
	
	// método que faz a alteraçao de dados no banco
	public function update(){
		$this->sql = "UPDATE $this->table SET
							$this->fields
					  WHERE
					  		$this->fieldId = '$this->valueId'
					  ";
		if(self::execSql($this->sql)){
			$this->status = "Alterado com Sucesso!!!";
		}		
	}

	//método que busca o ultimo código na tabela cadastrada
	public function getLastId(){
		$this->sql = "SELECT $this->fieldId FROM $this->table ORDER BY $this->fieldId DESC LIMIT 1";
		$this->qr = self::execSql($this->sql);
		$this->data = self::listQr($this->qr);
		return $this->data["$this->fieldId"];
	}
	
	// método que verifica se existem valores duplicados, returna 1 existe 0 nao existe
	public function getDadosDuplicados($valorPesquisado){
		$this->sql = "SELECT $this->fieldId FROM $this->table WHERE $this->fieldId = '$valorPesquisado'";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr);
	}
	
	// método que busca o total de dadoa cadastrado em uma query
	public function getTotalData(){
		$this->sql = "SELECT $this->fieldId FROM $this->table ORDER BY $this->fieldId";
		$this->qr = self::execSql($this->sql);
		return self::countData($this->qr);
	}
}

?>