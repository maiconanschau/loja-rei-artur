<?php

class ClienteController extends CController {
    const PAGE_SIZE=10;

    /**
     * @var string specifies the default action to be 'list'.
     */
    public $defaultAction='login';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
        'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
        array('deny',
        'actions'=>array('*'),
        'users'=>array('admin'),
        ),
        array('allow',
        'users'=>array('*'),
        ),
        );
    }

    public function actionLogin() {
        $model = new ClienteLoginForm();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes=$_POST['ClienteLoginForm'];
            if ($model->validate()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('login',array('model'=>$model));
    }

    public function actionFimCadastro() {
        $model = $this->loadCliente();
        $this->render('fimCadastro',array('model'=>$model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'show' page.
     */
    public function actionCreate() {
        Yii::import('application.extensions.TXGruppi.Util.*');

        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.maskedinput');

        $model=new Cliente;
        $model->setScenario('create');

        $modelFisico = new ClienteFisico;
        $modelJuridico = new ClienteJuridico;
        $modelEndereco = new Endereco;

        if(isset($_POST['Cliente'])) {
            $model->attributes=$_POST['Cliente'];
            $model->senha2Cliente = $_POST['Cliente']['senha2Cliente'];
            $modelFisico->attributes=$_POST['ClienteFisico'];
            $modelJuridico->attributes=$_POST['ClienteJuridico'];
            $modelEndereco->attributes=$_POST['Endereco'];

            $validoFisico = $model->tipoCliente == 1 ? $modelFisico->validate('create') : true;
            $validoJuridico = $model->tipoCliente == 2 ? $modelJuridico->validate('create') : true;
            $validoCliente = $model->validate('create');
            $validoEndereco = $modelEndereco->validate();
            if ($validoCliente && $validoFisico && $validoJuridico && $validoEndereco) {
                if ($model->save()) {
                    $modelEndereco->idCliente = $model->idCliente;
                    if ($modelEndereco->save()) {
                        if ($model->tipoCliente == 1) {
                            $modelFisico->idCliente = $model->idCliente;
                            if ($modelFisico->save()) {
                                $this->redirect(array('fimCadastro','id'=>$model->idCliente));
                            }
                        } elseif ($model->tipoCliente == 2) {
                            $modelJuridico->idCliente = $model->idCliente;
                            if ($modelJuridico->save()) {
                                $this->redirect(array('fimCadastro','id'=>$model->idCliente));
                            }
                        }
                    }
                }
            }
        }
        $this->render('create',array('model'=>$model,'modelFisico'=>$modelFisico,'modelJuridico'=>$modelJuridico,'modelEndereco'=>$modelEndereco));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'show' page.
     */
    public function actionUpdate() {
        $model=$this->loadCliente();
        if(isset($_POST['Cliente'])) {
            $model->attributes=$_POST['Cliente'];
            if($model->save())
                $this->redirect(array('show','id'=>$model->idCliente));
        }
        $this->render('update',array('model'=>$model));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->processAdminCommand();

        $criteria=new CDbCriteria;

        $pages=new CPagination(Cliente::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Cliente');
        $sort->applyOrder($criteria);

        $models=Cliente::model()->findAll($criteria);

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
    public function loadCliente($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Cliente::model()->findbyPk($id!==null ? $id : $_GET['id']);
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
            $this->loadCliente($_POST['id'])->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
