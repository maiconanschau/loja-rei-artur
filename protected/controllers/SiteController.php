<?php
class SiteController extends CController {
    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionIndex() {
        $this->render('index');
    }

    public function actionContato() {
        $model = new ContatoForm();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['ContatoForm'];
            if ($model->validate()) {
                $this->redirect(array('/site/contatoEnviado'));
            }
        }

        $this->render('contato',array('model'=>$model));
    }

    public function actionContatoEnviado() {
        $this->render("contatoEnviado");
    }
}