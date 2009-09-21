<?php
class CarrinhoController extends CController {
    protected $_modelProduto = null;

    public function actionFinalizar() {
        if (Yii::app()->user->isGuest || Yii::app()->user->id == 'admin') {
            $model = new ClienteLoginForm();
            $this->render("finalizar",array('model'=>$model));
        } else {
            $this->redirect(array('/pedido/finalizar'));
        }
    }

    public function actionExibir() {
        Yii::import("application.components.widgets.Carrinho");
        
        $produtos = Carrinho::getProdutos();

        if (Yii::app()->request->isPostRequest) {
            if (isset($_POST['produto'])) foreach ($_POST['produto'] as $k=>$v) {
                Carrinho::quantProduto($k, $v);
            }
            $this->refresh();
        }

        $this->render('exibir',array('produtos'=>$produtos));
    }

    public function actionRemover() {
        Yii::import("application.components.widgets.Carrinho");

        $produto = $this->loadProduto();

        Carrinho::removeProduto($produto);

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    public function actionAdicionar() {
        Yii::import("application.components.widgets.Carrinho");

        $produto = $this->loadProduto();

        Carrinho::addProduto($produto, 1);

        $this->redirect($_SERVER['HTTP_REFERER']);
    }

    protected function loadProduto() {
        if($this->_modelProduto===null) {
            if($id!==null || isset($_GET['id']))
                $this->_modelProduto=Produto::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_modelProduto===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_modelProduto;
    }
}