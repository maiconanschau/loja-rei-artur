<?php
class ProdutoController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Produto";
    }

    public function actionEstoque() {
        $mes = CTXRequest::getParam('mes');

        if (!empty($mes)) {
            $ano = date("Y",strtotime("-2years"));
            $ano1 = $ano;
            $ano2 = $ano+1;
            $mes = intval($mes);
            $mes = $mes <= 9 ? "0$mes" : $mes;
            $sql = "
SELECT
    pi.idProduto,
    pi.quantidadePedidoItem,
    YEAR(p.dataPedido) as anoPedido
FROM
    Pedido p
    INNER JOIN PedidoItem pi ON (
        p.idPedido = pi.idPedido
    )
WHERE
    MONTH(p.dataPedido) = '$mes'
    AND YEAR(p.dataPedido) BETWEEN '$ano1' AND '$ano2'
ORDER BY
    idProduto ASC,
    anoPedido ASC
                ";
            $itens = Yii::app()->db->createCommand($sql)->queryAll();

            $produtos = array();

            foreach ($itens as $v) {
                if (!isset($produtos[$v['idProduto']][$v['anoPedido']])) $produtos[$v['idProduto']][$v['anoPedido']] = 0;
                $produtos[$v['idProduto']][$v['anoPedido']] += $v['quantidadePedidoItem'];
            }

            $quant = array();
            foreach ($produtos as $k=>$v) {
                if (count($v) != 2) continue;
                $q1 = $v[$ano1];
                $q2 = $v[$ano2];
                $dif = $q2-$q1;
                if ($dif <= 0) $dif = $q2;
                $quant[$k] = $q2 + $dif;
            }

            $this->render('estoque',array(
                'mes'=>$mes,
                'quant'=>$quant
            ));
        }

        $this->render('estoque',array(
            'mes'=>$mes
        ));
    }

    public function actionAprovarComentario() {
        $comentario = $this->loadComentario();
        $comentario->statusComentario = 1;
        $comentario->save();
        $this->redirect(array('comentario','id'=>$comentario->idProduto));
    }

    public function actionDeletarComentario() {
        $comentario = $this->loadComentario();
        $comentario->delete();
        $this->redirect(array('comentario','id'=>$comentario->idProduto));
    }

    public function actionComentario() {
        Yii::import('application.extensions.TXGruppi.Util.CTXDate');
        $model = $this->loadProduto();

        $comentarios = $model->comentariosPendentes;

        $this->render('comentario',array('comentarios'=>$comentarios));
    }

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

    public function loadProduto($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Produto::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    public function loadComentario($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Comentario::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }

    protected function processAdminCommand() {
        if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete') {
            $produto = $this->loadProduto($_POST['id']);

            $fotos = $produto->fotos;
            foreach ($fotos as $v) {
                @unlink(Yii::app()->params['imagePath']."/".$v->arquivoFotoProduto);
                $v->delete();
            }

            $produto->delete();
            // reload the current page to avoid duplicated delete actions
            $this->refresh();
        }
    }
}
