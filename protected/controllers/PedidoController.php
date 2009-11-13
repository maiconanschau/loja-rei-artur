<?php
class PedidoController extends CController {
    const PAGE_SIZE = 10;

    protected $_model;

    public function init() {
        if (Yii::app()->user->isGuest) {
            $this->redirect(array("/cliente/login"));
        }
        $this->pageTitle = Yii::app()->name." - Pedido";
    }

    public function actionConfirmacao() {
        $this->render("confirmacao");
    }

    public function actionDetalhes() {
        Yii::import("application.extensions.TXGruppi.Util.*");

        $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>Yii::app()->user->id));
        $model = $this->loadPedido();
        $cupom = !empty($model->idCupom) ? Cupom::model()->findByAttributes(array('idCupom'=>$model->idCupom)) : null;

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

    public function actionHistorico() {
        Yii::import("application.extensions.TXGruppi.Util.CTXDate");

        $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>Yii::app()->user->id));

        $criteria=new CDbCriteria;
        $criteria->condition = "idCliente = '$cliente->idCliente'";
        $criteria->order = "dataPedido DESC";

        $pages=new CPagination(Pedido::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Pedido');
        $sort->applyOrder($criteria);

        $models=Pedido::model()->findAll($criteria);

        $this->render('historico',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
        ));
    }

    public function actionFinalizar() {
        Yii::import("application.components.widgets.Carrinho");
        Yii::import("application.extensions.TXGruppi.Util.CTXEstados");

        CTXSession::open();
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.maskedinput');
        CTXClientScript::registerScriptFile('jquery.numeric');

        $produtosCarrinho = Carrinho::getProdutos();
        $cliente = Cliente::model()->findByAttributes(array('emailCliente'=>Yii::app()->user->id));

        $modelEndereco = new Endereco();
        $enderecos = $cliente->enderecos;

        $cupomForm = new CupomForm();
        $exibeCupom = false;
        $valorCupom = 0;
        $totalPedido = 0;

        foreach ($produtosCarrinho as $v) {
            $totalPedido += $v['quant'] * $v['produto']->precoProduto;
        }

        if (isset($_POST['CupomForm']['chave']) || isset($_SESSION['CupomForm']['chave'])) {
            $cupomForm->chave = isset($_POST['CupomForm']['chave']) ? $_POST['CupomForm']['chave'] : (isset($_SESSION['CupomForm']['chave']) ? $_SESSION['CupomForm']['chave'] : null);
            $cupomForm->cliente = $cliente->idCliente;
            if ($cupomForm->validate()) {
                $descontoValido = true;
                $exibeCupom = true;
                $_SESSION['CupomForm']['chave'] = $cupomForm->chave;
                $cupom = Cupom::model()->findByAttributes(array('chaveCupom'=>$cupomForm->chave));

                $cupomMeta['categorias'] = CupomMeta::model()->findAllByAttributes(array('chaveCupomMeta'=>'categoria','idCupom'=>$cupom->idCupom));
                $cupomMeta['produtos'] = CupomMeta::model()->findAllByAttributes(array('chaveCupomMeta'=>'produto','idCupom'=>$cupom->idCupom));
                $cupomMeta['valorMin'] = CupomMeta::model()->findByAttributes(array('chaveCupomMeta'=>'valorMin','idCupom'=>$cupom->idCupom));
                $cupomMeta['valorMax'] = CupomMeta::model()->findByAttributes(array('chaveCupomMeta'=>'valorMax','idCupom'=>$cupom->idCupom));

                if (!empty($cupomMeta['categorias']) || !empty($cupomMeta['produtos']) || !empty($cupomMeta['valorMin']) || !empty($cupomMeta['valorMax'])) {
                    $descontoValido = false;
                    $produtosValidosPorProduto = array();
                    $produtosValidosPorCategoria = array();
                    foreach ($cupomMeta['produtos'] as $v) {
                        if (isset($produtosCarrinho[$v->valorCupomMeta])) {
                            $p = $produtosCarrinho[$v->valorCupomMeta]['produto'];
                            $produtosValidosPorProduto[] = $p->idProduto;
                        }
                    }
                    foreach ($cupomMeta['categorias'] as $v) {
                        foreach ($produtosCarrinho as $p) {
                            $p = $p['produto'];
                            if ($p->idCategoria == $v->valorCupomMeta) {
                                $produtosValidosPorCategoria[] = $p->idProduto;
                            }
                        }
                    }
                    if (empty($produtosValidosPorCategoria) && empty($cupomMeta['categorias']) && empty($produtosValidosPorProduto) && empty($cupomMeta['produtos'])) {
                        $descontoValido = true;
                    } elseif (empty($produtosValidosPorCategoria) && empty($cupomMeta['categorias'])) {
                        $produtosValidosChaves = $produtosValidosPorProduto;
                    } elseif (empty($produtosValidosPorProduto) && empty($cupomMeta['produtos'])) {
                        $produtosValidosChaves = $produtosValidosPorCategoria;
                    } else {
                        $produtosValidosChaves = array_intersect($produtosValidosPorCategoria, $produtosValidosPorProduto);
                    }
                    $produtosValidosValores = array();
                    foreach ($produtosValidosChaves as $v) {
                        $produtosValidosValores[$v] = $produtosCarrinho[$v]['produto']->precoProduto;
                    }
                }

                if (!empty($produtosValidosValores)) {
                    $totalPedidoDesconto = array_sum($produtosValidosValores);
                    $descontoValido = true;
                } else {
                    $totalPedidoDesconto = $totalPedido;
                }

                if ($cupom->tipoCupom == Cupom::TIPO_VALOR) {
                    $valorCupom = $cupom->valorCupom;
                } elseif ($cupom->tipoCupom == Cupom::TIPO_PORCENTAGEM) {
                    $valorCupom = $totalPedidoDesconto*($cupom->valorCupom/100);
                }

                if ($descontoValido) {
                    if (!empty($cupomMeta['valorMin']) && !empty($cupomMeta['valorMax'])) {
                        if ($totalPedido < $cupomMeta['valorMin']->valorCupomMeta || $totalPedido > $cupomMeta['valorMax']->valorCupomMeta) {
                            $descontoValido = false;
                        } else {
                            $descontoValido = true;
                        }
                    } elseif (!empty($cupomMeta['valorMin'])) {
                        if ($totalPedido < $cupomMeta['valorMin']->valorCupomMeta) {
                            $descontoValido = false;
                        } else {
                            $descontoValido = true;
                        }
                    } elseif (!empty($cupomMeta['valorMax'])) {
                        if ($totalPedido > $cupomMeta['valorMax']->valorCupomMeta) {
                            $descontoValido = false;
                        } else {
                            $descontoValido = true;
                        }
                    }
                }

                if (!$descontoValido) {
                    $valorCupom = 0;
                }
            } else {
                $cupomForm->chave = "";
            }
        }

        if (isset($_GET['endereco'])) {
            $endereco = CTXRequest::getParam('endereco');
            $endereco = Endereco::model()->findByPk($endereco);
            if (!empty($endereco)) {
                $this->finalizaPedido($produtosCarrinho,$cliente,$cupomForm,$exibeCupom,$valorCupom,$totalPedido,$endereco);
            }
        }

        if (isset($_POST['Endereco'])) {
            $modelEndereco->attributes = $_POST['Endereco'];
            $modelEndereco->idCliente = $cliente->idCliente;

            if ($modelEndereco->save()) {
                $this->finalizaPedido($produtosCarrinho,$cliente,$cupomForm,$exibeCupom,$valorCupom,$totalPedido,$modelEndereco);
            }
        }

        $this->render('finalizar',array(
            'produtosCarrinho'=>$produtosCarrinho,
            'cliente'=>$cliente,
            'cupomForm'=>$cupomForm,
            'exibeCupom'=>$exibeCupom,
            'valorCupom'=>$valorCupom,
            'totalPedido'=>$totalPedido,
            'modelEndereco'=>$modelEndereco,
            'enderecos'=>$enderecos,
        ));
    }

    public function finalizaPedido($produtos,$cliente,$cupom,$exibeCupom,$valorCupom,$total,$endereco) {
        CTXSession::open();
        $pedido = new Pedido();
        if ($exibeCupom) {
            $cupom = Cupom::model()->findByAttributes(array('chaveCupom'=>$cupom->chave));
            $pedido->idCupom = $cupom->idCupom;
        } else {
            $pedido->idCupom = 0;
        }

        $pedido->idCliente = $cliente->idCliente;
        $pedido->idEndereco = $endereco->idEndereco;
        $pedido->valorEntrega = 10;

        if ($pedido->save()) {
            foreach ($produtos as $v) {
                $v['produto'] = Produto::model()->findByPk($v['produto']->idProduto);
                if ($v['produto']->quantAtualProduto <= 0) {
                    $pedido->delete();
                    Carrinho::removeProduto($v['produto']->idProduto);
                    $this->redirect(array('pedido/finalizar'));
                }
                $v['produto']->quantAtualProduto--;
                $v['produto']->save();

                $temp = new PedidoItem();
                $temp->idCliente = $cliente->idCliente;
                $temp->idEndereco = $endereco->idEndereco;
                $temp->idCategoria = $v['produto']->idCategoria;
                $temp->idProduto = $v['produto']->idProduto;
                $temp->idPedido = $pedido->idPedido;
                $temp->quantidadePedidoItem = $v['quant'];
                $temp->valorPedidoItem = $v['produto']->precoProduto;
                $temp->save();
            }
            Carrinho::clearProdutos();
            unset($_SESSION['CupomForm']['chave']);
            $this->redirect(array('/pedido/detalhes','id'=>$pedido->idPedido,'c'=>1));
        } else {
            $this->redirect(array('/pedido/finalizar'));
        }
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