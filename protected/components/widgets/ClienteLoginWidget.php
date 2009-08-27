<?php
class ClienteLoginWidget extends CWidget {
    public function run() {
        if (!Yii::app()->user->isGuest) return;
        $model = new ClienteLoginForm();
        $this->render('clienteLoginWidget',array('model'=>$model));
    }
}