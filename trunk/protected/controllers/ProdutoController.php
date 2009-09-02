<?php
class ProdutoController extends CController {
    public $_model = null;

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionDetalhes() {
        $produto = $this->loadProduto();
        $fotos = $produto->fotosVisiveis;

        $this->render('detalhes',array('produto'=>$produto,'fotos'=>$fotos));
    }

    public function loadProduto($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Produto::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}