<?php
class PedidoController extends CController {
    const PAGE_SIZE=10;

    protected $_model;

    public $defaultAction='listar';

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionRelatorio() {
        Yii::import("application.extensions.TXGruppi.Util.*");

        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.maskedinput');

        $dataInicial = CTXDate::toSql(urldecode(CTXRequest::getParam('di',date("Y-m-d 00:00:00",strtotime("-1month")))));
        $dataFinal = CTXDate::toSql(urldecode(CTXRequest::getParam('df', date("Y-m-d 23:59:59"))));

        if ($dataFinal < $dataInicial) {
            $this->redirect(array('pedido/relatorio'));
        }

        $pedidos = Pedido::model()->findAll(array('condition'=>"dataPedido BETWEEN '$dataInicial' AND '$dataFinal'"));
        $totalPeriodo = $mediaPeriodo = $totalProdutos = 0;
        $produtos = array();
        foreach ($pedidos as $v) {
            $itens = PedidoItem::model()->findAllByAttributes(array('idPedido'=>$v->idPedido));
            foreach ($itens as $i) {
                $totalProdutos += $i->quantidadePedidoItem;
                if (!isset($produtos[$i->idProduto])) {
                    $arr = $produtos[$i->idProduto];
                } else {
                    $arr = $produtos[$i->idProduto];
                }

                $arr['produto'] = Produto::model()->findByAttributes(array('idProduto'=>$i->idProduto));
                $arr['item'] = $i;
                if (!isset($arr['quant'])) $arr['quant'] = 0;
                $arr['quant'] += $i->quantidadePedidoItem;
                if (!isset($arr['total'])) $arr['total'] = 0;
                $arr['total'] += $i->valorPedidoItem * $i->quantidadePedidoItem;
                $totalPeriodo += $i->valorPedidoItem * $i->quantidadePedidoItem;

                $produtos[$i->idProduto] = $arr;
            }
        }

        if ($totalProdutos > 0) $mediaPeriodo = $totalPeriodo / $totalProdutos;

        $this->render("relatorio",array(
            'dataInicial'=>$dataInicial,
            'dataFinal'=>$dataFinal,
            'produtos'=>$produtos,
            'totalPeriodo'=>$totalPeriodo,
            'totalProdutos'=>$totalProdutos,
            'mediaPeriodo'=>$mediaPeriodo,
        ));
    }

    public function actionDetalhes() {
        Yii::import("application.extensions.TXGruppi.Util.*");

        $model = $this->loadPedido();
        $cupom = !empty($model->idCupom) ? Cupom::model()->findByAttributes(array('idCupom'=>$model->idCupom)) : null;
        $cliente = Cliente::model()->findByPk($model->idCliente);

        $totalPedido = 0;

        $pedidoItem = PedidoItem::model()->findAllByAttributes(array('idPedido'=>$model->idPedido));
        $produtos = array();
        $quantidadeProdutos = 0;
        foreach ($pedidoItem as $v) {
            $produtos[] = array('item'=>$v,'produto'=>Produto::model()->findByAttributes(array('idProduto'=>$v->idProduto)));
            $quantidadeProdutos += $v->quantidadePedidoItem;
            $totalPedido += $v->quantidadePedidoItem * $v->valorPedidoItem;
        }

        $totalPedido += $model->valorEntrega;

        if (!empty($cupom)) {
            if ($cupom->tipoCupom == Cupom::TIPO_VALOR) {
                $valorCupom = $cupom->valorCupom;
            } elseif ($cupom->tipoCupom == Cupom::TIPO_PORCENTAGEM) {
                $valorCupom = $totalPedido*($cupom->valorCupom/100);
            }
        } else {
            $valorCupom = 0;
        }

        $totalPedido -= $valorCupom;

        $endereco = Endereco::model()->findByPk($model->idEndereco);

        $this->render('detalhes',array(
            'cliente'=>$cliente,
            'model'=>$model,
            'produtos'=>$produtos,
            'quantidadeProdutos'=>$quantidadeProdutos,
            'cupom'=>$cupom,
            'valorCupom'=>$valorCupom,
            'totalPedido'=>$totalPedido,
            'endereco'=>$endereco,
        ));
    }

    public function actionListar() {
        Yii::import("application.extensions.TXGruppi.Util.*");

        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.maskedinput');

        $datai = $dataf = "";

        if (isset($_POST['datai']) && isset($_POST['dataf'])) {
            $datai = CTXDate::toSql($_POST['datai']);
            $dataf = CTXDate::toSql($_POST['dataf']);
            $this->redirect(array('listar','datai'=>$datai,'dataf'=>$dataf));
        }

        $criteria=new CDbCriteria;
        $criteria->order = "dataPedido DESC";

        if (isset($_GET['datai']) && isset($_GET['dataf'])) {
            $datai = (urldecode($_GET['datai']));
            $dataf = (urldecode($_GET['dataf']));

            $criteria->condition = "dataPedido BETWEEN '$datai' AND '$dataf'";

            $datai = CTXDate::toDate($datai);
            $dataf = CTXDate::toDate($dataf);
        }

        $pages=new CPagination(Pedido::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Pedido');
        $sort->applyOrder($criteria);

        $models=Pedido::model()->findAll($criteria);

        $this->render('listar',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
            'datai'=>$datai,
            'dataf'=>$dataf,
        ));
    }

    public function loadPedido($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Pedido::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}