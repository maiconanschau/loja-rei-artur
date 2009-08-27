<?php

class DefaultController extends CController {
    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionIndex() {
        $this->render('index');
    }
}