<?php

class ClienteLoginForm extends CFormModel {
    public $email;
    public $senha;

    public function rules() {
        return array(
        array('email, senha', 'required'),
        array('senha', 'authenticate'),
        );
    }

    public function attributeLabels() {
        return array(
        'email'=>'E-mail',
        'senha'=>'Senha'
        );
    }

    public function authenticate($attribute,$params) {
        if(!$this->hasErrors()) {
            $identity=new ClienteIdentity($this->email,$this->senha);
            $identity->authenticate();
            switch($identity->errorCode) {
                case ClienteIdentity::ERROR_NONE:
                    Yii::app()->user->login($identity,0);
                    break;
                case ClienteIdentity::ERROR_USERNAME_INVALID:
                    $this->addError('username','E-mail está incorreto.');
                    break;
                default: // UserIdentity::ERROR_PASSWORD_INVALID
                    $this->addError('password','Senha inválida.');
                    break;
            }
        }
    }
}
