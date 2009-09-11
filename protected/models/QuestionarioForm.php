<?php
class QuestionarioForm extends CFormModel {
    public $rules = array();
    public $labels = array();

    public function rules() {
        return $this->rules;
    }

    public function attributeLabels() {
        return $this->labels;
    }

    public function __set($name,$value) {
        $this->$name = $value;
    }
}