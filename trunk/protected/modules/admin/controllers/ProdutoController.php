<?php
class ProdutoController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Produto";
    }

    public function actionMovimentacao() {
        $model = $this->loadProduto();

        $mes = date("m");
        $ano = date("Y");

$sql = "
SELECT
    *
FROM
    (
        SELECT
            p.idProduto as produto,
            c.dataCompra as data,
            'Compra' as operacao,
            ci.quantidadeCompraItem as quantidade,
            ci.precoCompraItem as preco,
            p.quantAtualProduto as quantidadeAtual
        FROM
            Compra c
            INNER JOIN CompraItem ci ON (
                c.idCompra = ci.idCompra
            )
            INNER JOIN Produto p ON (
                ci.idProduto = p.idProduto
            )
        --WHERE MONTH(c.dataCompra) = '$mes' AND YEAR(c.dataCompra) = '$ano'

        UNION

        SELECT
            p.idProduto as produto,
            pe.dataPedido as data,
            'Venda' as operacao,
            pi.quantidadePedidoItem as quantidade,
            pi.valorPedidoItem as preco,
            p.quantAtualProduto as quantidadeAtual
        FROM
            Pedido pe
            INNER JOIN PedidoItem pi ON (
                pe.idPedido = pi.idPedido
            )
            INNER JOIN Produto p ON (
                pi.idProduto = p.idProduto
            )
        --WHERE MONTH(pe.dataPedido) = '$mes' AND YEAR(pe.dataPedido) = '$ano'
    )
ORDER BY
    data
";
    }

    public function actionEntrada() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.decimal');

        $produtos = CHtml::listData(Produto::model()->findALl(array('order'=>'nomeProduto ASC')),'idProduto','nomeProduto');

        $valores = array(
            'pis'           => '1.65',
            'confins'       => '7.60',
            'icms'          => '12.00',
            'ipi'           => '15.00',
            'transporte'    => '1.00',
            'logistica'     => '1.00',
            'comissao'      => '1.00',
            'bancarias'     => '0.50',
            'inadimplencia' => '0.50',
            'propaganda'    => '1.00',
            'rma'           => '0.50',
            'fixas'         => '3.50',
            'lucro'         => '10.00',
            'pis2'          => '1.65',
            'confins2'      => '7.80',
            'icms2'         => '18.00',
            'ipi2'          => '15.00',
        );

        $erros = array();

        if (isset($_POST['formaEntrada'])) {
            foreach ($valores as $k=>$v) {
                if (isset($_POST[$k])) $valores[$k] = $_POST[$k];
            }

            $formaEntrada = (int) $_POST['formaEntrada'];

            if ($formaEntrada == 1) {
                $valorTotal = isset($_POST['valorTotal']) ? number_format((float) $_POST['valorTotal'], 2, '.','') : null;
                $quantidade = isset($_POST['quantidade']) ? (int) $_POST['quantidade'] : null;
                $produto = isset($_POST['produto']) ? (int) $_POST['produto'] : null;

                if (empty($valorTotal)) $erros[] = "Erro ao calcular o valor total";
                if (empty($quantidade)) $erros[] = "Você deve informar a quantidade";
                if (empty($produto)) $erros[] = "Você deve selecionar um produto";

                if (empty($erros)) {
                    $sql = "UPDATE Produto SET quantAtualProduto = quantAtualProduto + $quantidade, precoProduto = $valorTotal WHERE idProduto = $produto";
                    if (Yii::app()->db->createCommand($sql)->execute()) {
                        $this->refresh();
                    } else {
                        $erros[] = "Não foi possível salvar os dados";
                    }
                }
            } elseif ($formaEntrada == 2) {
                $totalRetornaveis = isset($_POST['totalRetornaveis']) ? (float) $_POST['totalRetornaveis'] : null;
                $totalVariaveis = isset($_POST['totalVariaveis']) ? (float) $_POST['totalVariaveis'] : null;
                $totalFixas = isset($_POST['totalFixas']) ? (float) $_POST['totalFixas'] : null;
                $totalImpostos = isset($_POST['totalImpostos']) ? (float) $_POST['totalImpostos'] : null;

                $arquivo = isset($_FILES['arquivo']) ? (array) $_FILES['arquivo'] : array();

                if (empty($totalRetornaveis) || empty($totalVariaveis) || empty($totalFixas) || empty($totalImpostos)) {
                    $erros[] = "Erro no envio do formulário";
                } elseif (empty($arquivo) || $arquivo['size'] <= 0 || $arquivo['error'] != 0) {
                    $erros[] = "Erro no envio do arquivo";
                } elseif ($arquivo['type'] != 'text/xml') {
                    $erros[] = "Arquivo inválido";
                } else {
                    $xml = simplexml_load_file($arquivo['tmp_name']);

                    $produtos = array();
                    foreach ($xml->produtos->produto as $produto) {
                        $quantidade = (int) $produto->qtde;
                        if ($quantidade <= 0) continue;
                        $model = Produto::model()->findByPk($produto->codigo);
                        if (empty($model)) continue;
                        $preco = (float) $produto->preco;

                        $total = 0;
                        $total -= $preco*$totalRetornaveis/100;
                        $total += $preco*$totalVariaveis/100;
                        $total += $preco*$totalFixas/100;
                        $total += $preco*$totalImpostos/100;
                        $total += $preco;

                        $produtos[] = array(
                            'model'=>$model,
                            'quantidade'=>$quantidade,
                            'total'=>$total,
                        );
                    }

                    $quantProdutos = count($produtos);
                    if ($quantProdutos == 0) {
                        $erros[] = "Nenhum produto para atualizar";
                    } else {
                        $compra = new Compra();
                        $compra->freteCompra = $xml->rodape->frete;
                        $compra->icmsCompra = (float) $xml->rodape->icms;

                        if ($compra->save()) {
                            $div = ($xml->rodape->frete + (float) $xml->rodape->icms) / $quantProdutos;

                            foreach ($produtos as $v) {
                                $model = $v['model'];

                                $compraItem = new CompraItem();
                                $compraItem->idCompra = $compra->idCompra;
                                $compraItem->idCategoria = $model->idCategoria;
                                $compraItem->idProduto = $model->idProduto;
                                $compraItem->quantidadeCompraItem = $v['quantidade'];
                                $compraItem->precoCompraItem = number_format($v['total'], 2, '.','');
                                $compraItem->save();

                                $model->quantAtualProduto += $v['quantidade'];
                                $model->precoProduto = number_format($v['total'] + $div, 2, '.','');
                                if (!$model->save()) {
                                    $erros[] = "Erro ao atualizar o produto ".$model->nomeProduto;
                                }
                            }
                        } else {
                            $erros[] = "Não foi possível salvar a compra";
                        }
                    }

                    if (empty($erros)) {
                        $this->refresh();
                    }
                }
                die();
            } else {
                $erros[] = "Envio inválido.";
            }
        }

        $this->render('entrada',array(
            'produtos'=>$produtos,
            'valores'=>$valores,
            'erros'=>$erros,
        ));
    }

    public function actionXmlEnvio() {
        ob_start();
        CTXSession::open();
        $quant = isset($_SESSION['quant']) ? $_SESSION['quant'] : null;

        if (empty($quant)) {
            $this->redirect(array('produto/'));
        }

        $produtos = array();
        foreach ($quant as $k=>$v) {
            $produto = Produto::model()->findByPk($k);
            $produtos[] = array($produto,$v);
        }

        $series = array('A','B','C');
        shuffle($series);
        $serie = array_shift($series);

        $numero = time();

        $cgc = "74.363.415/0001-66";
        $nome = "Loja Rei Artur Ltda";
        $telefone = "(32) 3232-9865";
        $endereco = "Av. Rio Branco, 1897 loja 42 - Centro - Juiz de Fora - MG";
        $comprador = "Loja Rei Artur Ltda";

        $xml = $this->renderPartial('xmlEnvio',array(
            'serie'=>$serie,
            'numeroPedido'=>$numero,
            'cgc'=>$cgc,
            'nome'=>$nome,
            'telefone'=>$telefone,
            'endereco'=>$endereco,
            'comprador'=>$comprador,
            'quant'=>$quant,
            'produtos'=>$produtos,
            ),true);

        $xmlLen = strlen($xml);

        $fileName = date("Y-m-d-H-i-s").".xml";

        header("Content-Type: application/octet-stream");
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        echo $xml;
        ob_end_flush();
    }

    public function actionEstoque() {
        CTXSession::open();
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
    YEAR(p.dataPedido) as anoPedido,
    pr.quantMaxProduto,
    pr.quantAtualProduto
FROM
    Pedido p
    INNER JOIN PedidoItem pi ON (
        p.idPedido = pi.idPedido
    )
    INNER JOIN Produto pr ON (
        pi.idProduto = pr.idProduto
    )
WHERE
    MONTH(p.dataPedido) = '$mes'
    AND YEAR(p.dataPedido) BETWEEN '$ano1' AND '$ano2'
    AND p.statusPedido = 1
ORDER BY
    idProduto ASC,
    anoPedido ASC
                ";
            $itens = Yii::app()->db->createCommand($sql)->queryAll();

            $produtos = array();
            $max = array();
            $atual = array();

            foreach ($itens as $v) {
                if (!isset($produtos[$v['idProduto']][$v['anoPedido']])) $produtos[$v['idProduto']][$v['anoPedido']] = 0;
                $produtos[$v['idProduto']][$v['anoPedido']] += $v['quantidadePedidoItem'];
                $max[$v['idProduto']] = $v['quantMaxProduto'];
                $atual[$v['idProduto']] = $v['quantAtualProduto'];
            }

            $quant = array();
            foreach ($produtos as $k=>$v) {
                if (count($v) != 2) continue;
                $q1 = $v[$ano1];
                $q2 = $v[$ano2];
                $dif = $q2-$q1;
                if ($dif <= 0) $dif = $q2;
                $quant[$k] = $q2 + $dif;
                if ($quant[$k] >= $max[$k]) $quant[$k] = ($max[$k] - $atual[$k] < 0 ? 0 : $max[$k] - $atual[$k]);
                if ($quant[$k] + $atual[$k] > $max[$k]) $quant[$k] = $max[$k] - $atual[$k];
                if ($quant[$k] < 0) $quant[$k] = 0;
            }

            $this->render('estoque',array(
                'mes'=>$mes,
                'quant'=>$quant
            ));
            return;
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
