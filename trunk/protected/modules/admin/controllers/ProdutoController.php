<?php

class ProdutoController extends CController {
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
     * Shows a particular model.
     */
    public function actionShow() {
        $this->render('show',array('model'=>$this->loadProduto()));
    }

    public function actionFotos() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.txupload');
        CTXClientScript::registerScriptFile('jquery.blockui');
        CTXClientScript::registerScriptFile('jquery.ajaxmanager');

        $model = $this->loadProduto();

        $fotos = $model->fotos;

        $table = new CTXTable();
        $table->attr('class','dataGrid');

        $coluna = 1;
        $row = $table->addRow();
        foreach ($fotos as $v) {
            $size = 140;
            $src = CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$v->idFotoProduto,'l'=>$size,'a'=>$size,'f'=>'frame'));
            $img = "<img src='$src' alt='{$model->nomeProduto}'/>";

            $links  = "<a href='#".CHtml::normalizeUrl(array('ajax/apagaFotoProduto','id'=>$v->idFotoProduto))."' class='apagaFoto'><img src='".Yii::app()->baseUrl."/images/icons/delete.png' alt='Apagar'/></a>";
            $links .= " <a href='#".CHtml::normalizeUrl(array('ajax/visivelFotoProduto','id'=>$v->idFotoProduto))."' class='visivelFoto'><img src='".Yii::app()->baseUrl."/images/icons/".($v->visivelFotoProduto ? 'eye_gray.png' : 'eye.png')."' alt='Apagar'/></a>";

            $tdContent = "<div>$img<br/>$links</div>";
            $row->addCol($tdContent)->css('text-align','center')->css('padding','0');
            if ($coluna++ >= 4) {
                $coluna = 0;
                $row = $table->addRow();
            }
        }

        $this->render('fotos',array(
                'model'=>$model,
                'table'=>$table,
            ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'show' page.
     */
    public function actionCreate() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.decimal');

        $model=new Produto;

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

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'show' page.
     */
    public function actionUpdate() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.decimal');

        $model=$this->loadProduto();

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
        $this->render('update',array('model'=>$model,'categorias'=>$categorias));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $this->processAdminCommand();

        $criteria=new CDbCriteria;

        $pages=new CPagination(Produto::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Produto');
        $sort->applyOrder($criteria);

        $models=Produto::model()->findAll($criteria);

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
    public function loadProduto($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Produto::model()->findbyPk($id!==null ? $id : $_GET['id']);
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
            $this->loadProduto($_POST['id'])->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
