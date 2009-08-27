<?php

class ClienteIdentity extends CUserIdentity {
    public function authenticate() {
        $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>$this->username));

        if (empty ($cliente)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif ($cliente->senhaCliente != md5($this->password.Yii::app()->params['md5Salt'])) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }
}