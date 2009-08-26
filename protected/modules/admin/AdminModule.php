<?php

class AdminModule extends CWebModule {
    public function init() {
        $this->setImport(array(
            'admin.models.*',
            'admin.components.*',
        ));

        Yii::app()->theme = 'admin';

        if (Yii::app()->user->isGuest && !preg_match("'admin\/site\/login'",Yii::app()->request->pathInfo)) {
            Yii::app()->request->redirect(CHtml::normalizeUrl(array('admin/site/login')));
        }
    }

    public function beforeControllerAction($controller, $action) {
        if(parent::beforeControllerAction($controller, $action)) {
            return true;
        }
        else
            return false;
    }
}
