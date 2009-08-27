<?php
class ClienteController extends CController {
    const PAGE_SIZE=10;
    public $defaultAction='login';
    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Cliente";
    }

    public function filters() {
        return array(
        'accessControl', // perform access control for CRUD operations
        );
    }

    public function accessRules() {
        return array(
        array('allow',
        'users'=>array('*'),
        ),
        array('deny',
        'actions'=>array('*'),
        'users'=>array('admin'),
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

    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionFimCadastro() {
        $model = $this->loadCliente();
        $this->render('fimCadastro',array('model'=>$model));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'show' page.
     */
    public function actionCadastro() {
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

    public function loadCliente($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Cliente::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
