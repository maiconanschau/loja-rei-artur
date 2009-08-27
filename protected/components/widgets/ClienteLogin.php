<?php
class ClienteLogin extends CWidget {
    public $file = 'clienteLogin';
    public function run() {
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->user->id == 'admin') {
                $this->render('adminLogout');
            } else {
                $this->render('clienteLogout');
            }
            return;
        }
        if (preg_match("'cliente\/login'",Yii::app()->request->pathInfo)) return;
        $model = new ClienteLoginForm();
        $this->render($this->file,array('model'=>$model));
    }
}