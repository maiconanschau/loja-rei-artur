<?php

class CategoriaProdutoController extends CController {
    const PAGE_SIZE=10;
    
    /**
     * @var string specifies the default action to be 'admin'.
     */
    public $defaultAction='admin';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'create' page.
     */
    public function actionCreate() {
        $model=new CategoriaProduto;
        if(isset($_POST['CategoriaProduto'])) {
            $model->attributes=$_POST['CategoriaProduto'];
            if($model->save())
                $this->redirect(array('create'));
        }
        $this->render('create',array('model'=>$model));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'admin' page.
     */
    public function actionUpdate() {
        $model=$this->loadCategoriaProduto();
        if(isset($_POST['CategoriaProduto'])) {
            $model->attributes=$_POST['CategoriaProduto'];
            if($model->save())
                $this->redirect(array('admin'));
        }
        $this->render('update',array('model'=>$model));
    }

    /**
     * Manages all models.
     */
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

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the primary key value. Defaults to null, meaning using the 'id' GET variable
     */
    public function loadCategoriaProduto($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=CategoriaProduto::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    /**
     * Executes any command triggered on the admin page.
     */
    protected function processAdminCommand() {
        if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete') {
            $this->loadCategoriaProduto($_POST['id'])->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
