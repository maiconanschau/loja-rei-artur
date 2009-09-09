<?php
class ProdutoController extends CController {
    const PAGE_SIZE=10;

    public $_model = null;

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionBusca() {
        $termo = CTXRequest::getParam('q');
        $categoria = CTXRequest::getParam('c');

        $models = array();
        $pages = null;
        $table = null;

        if (!empty($termo)) {
            $criteria = new CDbCriteria();
            $criteria->condition = "(nomeProduto LIKE '%$termo%' OR descricaoCurtaProduto LIKE '%$termo%' OR descricaoLongaProduto LIKE '%$termo%')".($categoria == 0 ? '' : " AND idCategoria = '$categoria'");
            $criteria->order = 'cliquesProduto DESC, nomeProduto ASC';

            $pages = new CPagination(Produto::model()->count($criteria));
            $pages->pageSize = 6;
            $pages->applyLimit($criteria);

            $models = Produto::model()->findAll($criteria);

            $table = new CTXTable();
            $table->attr('width','100%');
            $row = $table->addRow();

            foreach ($models as $k=>$v) {
                $fotos = $v->fotosVisiveis;
                $foto = array_shift($fotos);
                $produto = $this->renderPartial('/site/produtoHome', array('produto'=>$v,'foto'=>$foto), true);
                $row->addCol($produto);
                if ($k == 2) {
                    $row = $table->addRow();
                }
            }
        }
        $this->render('busca',array('termo'=>$termo,'models'=>$models,'pages'=>$pages,'tabelaProdutos'=>$table));
    }

    public function actionDetalhes() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.carousellite');
        CTXClientScript::registerScriptFile('jquery.lightbox');

        CTXClientScript::registerCssFile('jquery.lightbox');

        $produto = $this->loadProduto();
        //$produto = $this->clique();

        $produto->cliquesProduto++; // Adiciona um clique ao produto
        $produto->save(); // Salva o novo clique no banco

        $fotos = $produto->fotosVisiveis;
        $this->render('detalhes',array('produto'=>$produto,'fotos'=>$fotos));
    }

    /*
    public function clique() {
        $sql = "UPDATE Produto SET cliquesProduto=:cliquesProduto " .
            "WHERE idProduto=:idProduto";
        $comando = Yii::app() -> db -> createCommand($sql);
        $comando -> bindParam(":cliquesProduto", $this -> cliquesProduto + 1, PDO::PARAM_STR);
        $comando -> bindParam(":idProduto", $this -> idProduto, PDO::PARAM_STR);
        $control = $comando -> execute();
        return ($control > 0);
    }
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
}