<?php
class CTXCnpjValidator extends CValidator {
    protected function validateAttribute($model, $attribute) {
        $value = $model->$attribute;
        if (!$this->_validateCnpj($value)) {
            $model->addError($attribute,"Você deve informar um CNPJ válido.");
        }
    }

    protected function _validateCnpj($cnpj) {
        if (!preg_match("/^[0-9]{14}$/",$cnpj)) return false;

        $pesos1 = array(5,4,3,2,9,8,7,6,5,4,3,2);
        $pesso2 = array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        $soma1 = $soma2 = array();
        for ($x = 0; $x < 13; $x++) {
            if ($x < 12) $soma1[] = $cnpj[$x] * $pesos1[$x];
            $soma2[] = $cnpj[$x] * $pesso2[$x];
        }

        $soma1 = array_sum($soma1) % 11;
        $soma2 = array_sum($soma2) % 11;

        if (($soma1<2?0:11-$soma1)!=$cnpj[12]) return false;
        return (($soma2<2?0:11-$soma2)==$cnpj[13]);
    }
}