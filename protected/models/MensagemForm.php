<?php

class MensagemForm extends CFormModel {
    public $assunto;
    public $conteudo;
    public $desconto;

    public $valor;

    public $idadeMin;
    public $idadeMax;
    public $rendaMin;
    public $rendaMax;
    public $sexo;

    public $categorias;
    public $produtos;

    public $valorMin;
    public $valorMax;

    public function rules() {
        return array(
        array('assunto,conteudo','required'),
        array('idadeMin,idadeMax,rendaMin,rendaMax,valorMin,valorMax','numerical'),
        array('valor','requiredIf','target'=>'desconto'),
        array('sexo','validaSexo'),
        array('categorias,produtos','validaArray'),
        array('idadeMin','menorQue','target'=>'idadeMax'),
        array('rendaMin','menorQue','target'=>'rendaMax'),
        array('valorMin','menorQue','target'=>'valorMax'),
        );
    }

    public function attributeLabels() {
        return array(
        'assunto'   =>'Assunto',
        'conteudo'  =>'Conteúdo',
        'desconto'  =>'Desconto',
        'valor'     =>'Valor',
        'idadeMin'  =>'Idade mínima',
        'idadeMax'  =>'Idade máxima',
        'rendaMin'  =>'Renda mínima',
        'rendaMax'  =>'Renda máxima',
        'sexo'      =>'Sexo',
        'categorias'=>'Categorias',
        'produtos'  =>'Produtos',
        'valorMin'  =>'Valor mínimo',
        'valorMax'  =>'Valor máximo',
        );
    }

    public function requiredIf($attribute,$params) {
        $target = $params['target'];
        $value1 = $this->$attribute;
        $value2 = $this->$target;

        if ($value2 && empty($value1)) {
            $this->addError($attribute, 'Você deve informar o valor do desconto');
            return false;
        }
        return true;
    }

    public function menorQue($attribute,$params) {
        $target = $params['target'];
        $value1 = $this->$attribute;
        $value2 = $this->$target;

        if (!is_numeric($value2)) return true;
        if ($value1 > $value2) {
            $this->addError($attribute, 'Este campo deve ser menor que seu correspondente');
            return false;
        }
        return true;
    }

    public function validaSexo($attribute,$params) {
        $value = $this->$attribute;
        $value = strtolower($value);
        if (!empty($value) && $value != 'm' && $value != 'f') {
            $this->addError($attribute, 'Sexo inválido.');
            return false;
        }
        return true;
    }

    public function validaArray($attribute,$params) {
        $value = $this->$attribute;
        if (!is_array($value)) {
            $this->addError($attribute, 'O atributo '.$attribute.' deve ser um array');
            return false;
        }
        return true;
    }

    public function beforeValidate() {
        $this->desconto = empty($this->desconto) ? 0 : $this->desconto;
        $this->valor = empty($this->valor) ? 0 : $this->valor;
        $this->idadeMin = empty($this->idadeMin) ? 0 : $this->idadeMin;
        $this->idadeMax = empty($this->idadeMax) ? 0 : $this->idadeMax;
        $this->rendaMin = empty($this->rendaMin) ? 0 : $this->rendaMin;
        $this->rendaMax = empty($this->rendaMax) ? 0 : $this->rendaMax;
        $this->categorias = empty($this->categorias) ? array() : $this->categorias;
        $this->produtos = empty($this->produtos) ? array() : $this->produtos;
        $this->valorMin = empty($this->valorMin) ? 0 : $this->valorMin;
        $this->valorMax = empty($this->valorMax) ? 0 : $this->valorMax;
        return true;
    }
}