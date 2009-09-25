<?php
class CupomForm extends CFormModel {
    public $chave;
    public $cliente;

    public function rules() {
        return array(
            array('chave','validar'),
        );
    }

    public function validar($attribute,$params) {
        if (!empty($this->chave)) {
            if (empty($this->cliente)) {
                $this->addError($attribute, "Erro ao processar cupom.");
                return;
            }

            $cupom = Cupom::model()->findByAttributes(array('chaveCupom'=>$this->chave));
            if (empty ($cupom)) {
                $this->addError($attribute, "Cupom inválido.");
                return;
            }

            if ($cupom->restritoCupom == 1) {
                $clienteCupom = ClienteCupom::model()->findByAttributes(array('idCliente'=>$this->cliente,'idCupom'=>$cupom->idCupom));
                if (empty($clienteCupom)) {
                    $this->addError($attribute, "Cupom inválido.");
                    return;
                }
            }

            $pedido = Pedido::model()->findByAttributes(array('idCliente'=>$this->cliente,'idCupom'=>$cupom->idCupom));
            if (!empty($pedido)) {
                $this->addError($attribute, "Você já utilizou este cupom.");
                return;
            }
        }
    }

    public function attributeLabels() {
        return array(
        'chave' => 'Código',
        );
    }
}