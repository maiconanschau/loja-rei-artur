<?php
class CategoriaprodutoController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Categoria";
    }

    public function actionCreate() {
        $model=new CategoriaProduto;
        if(isset($_POST['CategoriaProduto'])) {
            $model->attributes=$_POST['CategoriaProduto'];
            if($model->save())
                $this->redirect(array('create'));
        }
        $this->render('create',array('model'=>$model));
    }

    public function actionUpdate() {
        $model=$this->loadCategoriaProduto();
        if(isset($_POST['CategoriaProduto'])) {
            $model->attributes=$_POST['CategoriaProduto'];
            if($model->save())
                $this->redirect(array('admin'));
        }
        $this->render('update',array('model'=>$model));
    }

    public function actionAdmin() {
        $this->processAdminCommand();

        $criteria=new CDbCriteria;

        $pages=new CPagination(CategoriaProduto::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('CategoriaProduto');
        $sort->applyOrder($criteria);

        $models=CategoriaProduto::model()->findAll($criteria);

        $this->render('admin',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
        ));
    }

    public function loadCategoriaProduto($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=CategoriaProduto::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    protected function processAdminCommand() {
        if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete') {
            $this->loadCategoriaProduto($_POST['id'])->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
