<?php
class ProdutoController extends CController {
    public $_model = null;

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionDetalhes() {
        $produto = $this->loadProduto();
        $produto = $this -> clique();
        $fotos = $produto->fotosVisiveis;
        $this->render('detalhes',array('produto'=>$produto,'fotos'=>$fotos));
    }

    public function clique(){
    $sql = "UPDATE Produto SET cliquesProduto=:cliquesProduto " .
           "WHERE idProduto=:idProduto";
    $comando = Yii::app() -> db -> createCommand($sql);
    $comando -> bindParam(":cliquesProduto", $this -> cliquesProduto + 1, PDO::PARAM_STR);
    $comando -> bindParam(":idProduto", $this -> idProduto, PDO::PARAM_STR);
    $control = $comando -> execute();
    return ($control > 0);
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