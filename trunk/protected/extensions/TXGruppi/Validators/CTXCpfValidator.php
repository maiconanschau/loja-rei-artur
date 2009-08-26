<?php
class CTXCpfValidator extends CValidator {
    protected function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if (!$this->_validateCpf($value)) {
            $model->addError($attribute,"Você deve informar um CPF válido.");
        }
    }

    protected function _validateCpf($cpf) {
        if ($cpf == '12345678909') return false;
        if (!preg_match("/^[0-9]{11}$/",$cpf)) return false;

        $soma1 = $soma2 = array();
        for ($x = 0; $x < 10; $x++) {
            if ($cpf == str_repeat($x, 11)) return false;
            if ($x < 9) $soma1[] = $cpf[$x] * (10 - $x);
            $soma2[] = $cpf[$x] * (11 - $x);
        }

        $soma1 = array_sum($soma1) % 11;
        $soma2 = array_sum($soma2) % 11;

        if(($soma1<2?0:11-$soma1)!=$cpf{9})return false;
        return (($soma2<2?0:11-$soma2)==$cpf{10});
    }
}