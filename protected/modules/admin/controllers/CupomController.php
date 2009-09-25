<?php

class CupomController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    /**
     * @return array action filters
     */
    public function filters() {
        return array();
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'show' page.
     */
    public function actionCreate() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.decimal');

        $model=new Cupom;

        $clientesModel = Cliente::model()->findAll(array('order'=>'chamadoCliente'));
        $clientes = new CTXTable();
        $clientes->attr('width','100%');
        $row = $clientes->addRow();
        foreach ($clientesModel as $k=>$v) {
            if ($k % 3 == 0 && $k > 0) {
                $row = $clientes->addRow();
            }
            $checked = false;
            $row->addCol(CHtml::checkBox('cliente['.$v->idCliente.']', $checked)." ".CHtml::label($v->chamadoCliente,"",array('style'=>'font-size:12px;')));
        }

        if(isset($_POST['Cupom'])) {
            $model->attributes=$_POST['Cupom'];

            if (isset($_POST['cliente'])) {
                $model->restritoCupom = 1;
            } else {
                $model->restritoCupom = 0;
            }
            if($model->save()) {
                if (isset($_POST['cliente'])) {
                    $clientes = $_POST['cliente'];

                    foreach ($clientes as $k=>$v) {
                        $temp = new ClienteCupom();
                        $temp->idCliente = $k;
                        $temp->idCupom = $model->idCupom;
                        $temp->save();
                    }
                }
                $this->redirect(array('create'));
            }
        }
        $this->render('create',array('model'=>$model,'clientes'=>$clientes));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'show' page.
     */
    public function actionUpdate() {
        $model=$this->loadCupom();

        $clientesSelecionadosModel = $model->cliente;
        $clientesSelecionados = array();
        foreach ($clientesSelecionadosModel as $v) {
            $clientesSelecionados[] = $v->idCliente;
        }

        $clientesModel = Cliente::model()->findAll(array('order'=>'chamadoCliente'));
        $clientes = new CTXTable();
        $clientes->attr('width','100%');
        $row = $clientes->addRow();
        foreach ($clientesModel as $k=>$v) {
            if ($k % 3 == 0 && $k > 0) {
                $row = $clientes->addRow();
            }
            $checked = in_array($v->idCliente, $clientesSelecionados);
            $row->addCol(CHtml::checkBox('cliente['.$v->idCliente.']', $checked)." ".CHtml::label($v->chamadoCliente,"",array('style'=>'font-size:12px;')));
        }

        if(isset($_POST['Cupom'])) {
            if (isset($_POST['cliente'])) {
                $model->restritoCupom = 1;
            } else {
                $model->restritoCupom = 0;
            }

            $model->attributes=$_POST['Cupom'];
            if($model->save()) {
                if (isset($_POST['cliente'])) {
                    $novosClientes = array_keys($_POST['cliente']);
                    $difClientes = CTXUtil::compareArrays($clientesSelecionados, $novosClientes);
                    foreach ($difClientes[0] as $v) {
                        $temp = new ClienteCupom();
                        $temp->idCliente = $v;
                        $temp->idCupom = $model->idCupom;
                        $temp->save();
                    }

                    foreach ($difClientes[1] as $v) {
                        $temp = ClienteCupom::model()->findByAttributes(array('idCupom'=>$model->idCupom,'idCliente'=>$v));
                        if (!empty($temp)) {
                            Yii::app()->db->createCommand("DELETE FROM ClienteCupom WHERE idCliente = '$v' AND idCupom = '{$model->idCupom}'")->execute();
                        }
                    }
                }

                $this->redirect(array('admin'));
            }
        }
        $this->render('update',array('model'=>$model,'clientes'=>$clientes));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     */
    public function actionDelete() {
        if(Yii::app()->request->isPostRequest) {
        // we only allow deletion via POST request
            $this->loadCupom()->delete();
            $this->redirect(array('list'));
        }
        else
            throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->processAdminCommand();

        $criteria=new CDbCriteria;

        $pages=new CPagination(Cupom::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Cupom');
        $sort->applyOrder($criteria);

        $models=Cupom::model()->findAll($criteria);

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
    public function loadCupom($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Cupom::model()->findbyPk($id!==null ? $id : $_GET['id']);
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
            $this->loadCupom($_POST['id'])->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
