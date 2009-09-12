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
        $categoriaMenu = CTXRequest::getParam('categoria');

        $models = array();
        $pages = null;
        $table = null;
        $modelCategoria = null;

        if (!empty($termo) || !empty($categoriaMenu)) {
            CTXSession::open();

            if (!isset($_SESSION['Produto']['busca']['termos'])) $_SESSION['Produto']['busca']['termos'] = array();
            if (!in_array($termo, $_SESSION['Produto']['busca']['termos'])) $_SESSION['Produto']['busca']['termos'][] = $termo;

            $criteria = new CDbCriteria();
            if (!empty($termo)) {
                $criteria->condition = "(nomeProduto LIKE '%$termo%' OR descricaoCurtaProduto LIKE '%$termo%' OR descricaoLongaProduto LIKE '%$termo%')".($categoria == 0 ? '' : " AND idCategoria = '$categoria'");
            } elseif (!empty($categoriaMenu)) {
                $criteria->condition = "idCategoria = '$categoriaMenu'";
                $modelCategoria = CategoriaProduto::model()->findByPk($categoriaMenu);
            }

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
        $this->render('busca',array('termo'=>$termo,'models'=>$models,'pages'=>$pages,'tabelaProdutos'=>$table,'categoria'=>$modelCategoria));
    }

    public function actionDetalhes() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.carousellite');
        CTXClientScript::registerScriptFile('jquery.lightbox');

        CTXClientScript::registerCssFile('jquery.lightbox');

        $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>Yii::app()->user->id));

        $produto = $this->loadProduto();
        //$produto = $this->clique();

        $produto->cliquesProduto++; // Adiciona um clique ao produto
        $produto->save(); // Salva o novo clique no banco

        $comentarios = Comentario::model()->findAll(array('condition'=>"idProduto = {$produto->idProduto}",'order'=>'dataComentario DESC'));

        if (!Yii::app()->user->isGuest && Yii::app()->user->id != 'admin') {
            $model = new Comentario();

            if (isset($_POST['Comentario'])) {
                $model->attributes = $_POST['Comentario'];

                $model->idProduto = $produto->idProduto;
                $model->idCliente = $cliente->idCliente;

                if ($model->save()) {
                    $this->refresh();
                }
            }
            
            $comentario = $this->renderPartial('/comentario/create', array('model'=>$model), true);
        }

        $fotos = $produto->fotosVisiveis;
        $this->render('detalhes',array('produto'=>$produto,'fotos'=>$fotos,'comentario'=>$comentario,'comentarios'=>$comentarios));
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