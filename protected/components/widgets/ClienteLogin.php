<?php
class ClienteLogin extends CWidget {
    public $file = 'clienteLogin';
    public function run() {
        if (!Yii::app()->user->isGuest) {
            if (Yii::app()->user->id == 'admin') {
                $this->render('adminLogout');
            } else {
                $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>Yii::app()->user->id));
                $quest = count(QuestionarioCliente::model()->findAllByAttributes(array('idCliente'=>$cliente->idCliente))) == 0;
                $this->render('clienteLogout',array('quest'=>$quest));
            }
            return;
        }
        if (preg_match("'cliente\/login'",Yii::app()->request->pathInfo)) return;
        $model = new ClienteLoginForm();
        $this->render($this->file,array('model'=>$model));
    }
}