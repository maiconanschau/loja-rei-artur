<?php
class PerguntaQuestionarioController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Perguntas";
    }

    public function actionShow() {
        $this->render('show',array('model'=>$this->loadPerguntaQuestionario()));
    }

    public function actionCreate() {
        CTXClientScript::registerScriptFile('jquery');

        $model=new PerguntaQuestionario;

        $categorias = array();
        $mCategorias = CategoriaProduto::model()->findAll(array('order'=>'nomeCategoria'));
        foreach ($mCategorias as $v) {
            $categorias[$v->idCategoria] = $v->nomeCategoria;
        }

        if(isset($_POST['Produto'])) {
            $model->attributes=$_POST['Produto'];
            if($model->save())
                $this->redirect(array('show','id'=>$model->idProduto));
        }

        $this->render('create',array('model'=>$model,'categorias'=>$categorias));
    }

    public function actionUpdate() {
        
    }

    public function actionAdmin() {
        $this->processAdminCommand();

        $criteria=new CDbCriteria;

        $pages=new CPagination(PerguntaQuestionario::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Produto');
        $sort->applyOrder($criteria);

        $models=PerguntaQuestionario::model()->findAll($criteria);

        $this->render('admin',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
        ));
    }

    public function loadPerguntaQuestionario($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=PerguntaQuestionario::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    protected function processAdminCommand() {
        if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete') {
            $this->loadPerguntaQuestionario($_POST['id'])->delete();
            $this->refresh();
        }
    }
}
