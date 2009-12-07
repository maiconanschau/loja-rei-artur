<?php
class RelatorioController extends CController {

    public function init() {
        $this->pageTitle = Yii::app()->name." - Relatórios";
    }

    public function actionRelatorio2() {
        $nomesMeses = array(1=>'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
        $ano = isset($_GET['ano']) ? (int) $_GET['ano'] : date("Y");
        $sql = "
SELECT
    pr.idProduto as idProduto,
    pr.nomeProduto as nomeProduto,
    pi.quantidadePedidoItem as quantidadeProduto,
    pi.valorPedidoItem as valorProduto,
    MONTH(p.dataPedido) as mesOperacao,
    'v' as tipoOperacao
FROM
    Pedido p
    INNER JOIN PedidoItem pi ON (
        p.idPedido = pi.idPedido
    )
    INNER JOIN Produto pr ON (
        pi.idProduto = pr.idProduto
    )
WHERE
    YEAR(p.dataPedido) = $ano
    AND p.statusPedido = 1

UNION

SELECT
    p.idProduto as idProduto,
    p.nomeProduto as nomeProduto,
    ci.quantidadeCompraItem as quantidadeProduto,
    ci.precoCompraItem as valorProduto,
    MONTH(c.dataCompra) as mesOperacao,
    'c' as tipoOperacao
FROM
    Compra c
    INNER JOIN CompraItem ci ON (
        c.idCompra = ci.idCompra
    )
    INNER JOIN Produto p ON (
        ci.idProduto = p.idProduto
    )
WHERE
    YEAR(c.dataCompra) = $ano

ORDER BY
    mesOperacao,
    idProduto
            ";
        $itens = Yii::app()->db->createCommand($sql)->queryAll();

        if (count($itens)) {
            $produtos = array();

            $dados = array();
            foreach ($itens as $v) {
                if (!isset($produtos[$v['idProduto']])) $produtos[$v['idProduto']] = $v['nomeProduto'];
                if (!isset($dados[$v['mesOperacao']])) $dados[$v['mesOperacao']] = array();
                if (!isset($dados[$v['mesOperacao']][$v['idProduto']])) $dados[$v['mesOperacao']][$v['idProduto']] = array(
                        'c'=>array('quant'=>0,'valor'=>0),
                        'v'=>array('quant'=>0,'valor'=>0),
                    );

                $dados[$v['mesOperacao']][$v['idProduto']][$v['tipoOperacao']]['quant'] += $v['quantidadeProduto'];
                $dados[$v['mesOperacao']][$v['idProduto']][$v['tipoOperacao']]['valor'] += $v['quantidadeProduto'] * $v['valorProduto'];
            }

            $table = new CTXTable();
            $table->attr('class','dataGrid');
            $rowCabecalho1 = $table->addRow();
            $rowCabecalho2 = $table->addRow();

            $rowCabecalho1->addHea('')->attr('rowspan',2);

            $produtosHea = true;
            $rowProduto = array();

            $anualTotalCompra = array();
            $anualTotalVenda = array();
            $anualQuantCompra = array();
            $anualQuantVenda = array();
            $anualLucro = array();

            foreach ($dados as $mes=>&$dadosMes) {
                $rowCabecalho1->addHea($nomesMeses[$mes]."/".$ano)->attr('colspan',5);
                $rowCabecalho2->addHea('Vendas',true)->addHea('Previsão',true)->addHea('Total compra',true)->addHea('Total venda',true)->addHea('Lucro');

                $mesTotalCompra = 0;
                $mesTotalVenda = 0;
                $mesQuantCompra = 0;
                $mesQuantVenda = 0;
                $mesLucro = 0;

                foreach ($produtos as $idProduto=>$nomeProduto) {
                    if (!isset($rowProduto[$idProduto])) {
                        $rowProduto[$idProduto] = $table->addRow();
                    }

                    $row = $rowProduto[$idProduto];
                    if ($produtosHea) {
                        $row->addHea($nomeProduto);
                    }

                    if (!isset($dadosMes[$idProduto])) {
                        $dadosMes[$idProduto] = array(
                            'c'=>array('quant'=>0,'valor'=>0),
                            'v'=>array('quant'=>0,'valor'=>0),
                        );
                    }

                    $totalCompra = $dadosMes[$idProduto]['c']['valor'];
                    $totalVenda = $dadosMes[$idProduto]['v']['valor'];
                    $quantCompra = $dadosMes[$idProduto]['c']['quant'];
                    $quantVenda = $dadosMes[$idProduto]['v']['quant'];

                    if (!isset($anualTotalCompra[$idProduto])) $anualTotalCompra[$idProduto] = 0;
                    if (!isset($anualTotalVenda[$idProduto])) $anualTotalVenda[$idProduto] = 0;
                    if (!isset($anualQuantCompra[$idProduto])) $anualQuantCompra[$idProduto] = 0;
                    if (!isset($anualQuantVenda[$idProduto])) $anualQuantVenda[$idProduto] = 0;
                    if (!isset($anualLucro[$idProduto])) $anualLucro[$idProduto] = 0;

                    $anualTotalCompra[$idProduto] += $totalCompra;
                    $anualTotalVenda[$idProduto] += $totalVenda;
                    $anualQuantCompra[$idProduto] += $quantCompra;
                    $anualQuantVenda[$idProduto] += $quantVenda;
                    $mesTotalCompra += $totalCompra;
                    $mesTotalVenda += $totalVenda;
                    $mesQuantCompra += $quantCompra;
                    $mesQuantVenda += $quantVenda;

                    if ($quantCompra > 0 && $quantVenda > 0) {
                        $lucro = $totalVenda - $totalCompra;
                        $anualLucro[$idProduto] += $lucro;
                        $mesLucro += $lucro;
                    } else {
                        $lucro = '-';
                    }

                    $row->addCol($quantVenda);
                    $row->addCol($quantCompra);
                    $row->addCol($totalCompra);
                    $row->addCol($totalVenda);
                    $row->addCol($lucro);
                }

                if (!isset($rowProduto['x'])) {
                    $rowProduto['x'] = $table->addRow();
                }

                $row = $rowProduto['x'];
                if ($produtosHea) {
                    $row->addHea('Total');
                }
                $row->addCol($mesQuantVenda);
                $row->addCol($mesQuantCompra);
                $row->addCol($mesTotalCompra);
                $row->addCol($mesTotalVenda);
                $row->addCol($mesLucro);

                $produtosHea = false;
            }

            $rowCabecalho1->addHea('Anual')->attr('colspan',5);
            $rowCabecalho2->addHea('Vendas',true)->addHea('Previsão',true)->addHea('Total compra',true)->addHea('Total venda',true)->addHea('Lucro');

            $totalQuantVenda = 0;
            $totalQuantCompra = 0;
            $totalTotalVenda = 0;
            $totalTotalCompra = 0;
            $totalLucro = 0;
            foreach ($rowProduto as $k=>$v) {
                if ($k == 'x') continue;
                $totalQuantVenda += $anualQuantVenda[$k];
                $totalQuantCompra += $anualQuantCompra[$k];
                $totalTotalVenda += $anualTotalVenda[$k];
                $totalTotalCompra += $anualTotalCompra[$k];
                $totalLucro += $anualLucro[$k];

                $v->addCol($anualQuantVenda[$k]);
                $v->addCol($anualQuantCompra[$k]);
                $v->addCol($anualTotalVenda[$k]);
                $v->addCol($anualTotalCompra[$k]);
                $v->addCol($anualLucro[$k]);
            }

            $row = $rowProduto['x'];
            $row->addCol($mesQuantVenda);
            $row->addCol($mesQuantCompra);
            $row->addCol($mesTotalCompra);
            $row->addCol($mesTotalVenda);
            $row->addCol($mesLucro);

            $this->render('relatorio2',array(
                'table'=>$table,
                'ano'=>$ano,
            ));
        } else {
            $this->render('relatorio2',array(
                'semRs'=>true,
                'ano'=>$ano,
            ));
        }
    }

    public function actionRelatorio3() {
        $valores = array(
            'pis'           => '1.65',  'confins'       => '7.60',  'icms'          => '12.00',
            'ipi'           => '15.00', 'transporte'    => '1.00',  'logistica'     => '1.00',
            'comissao'      => '1.00',  'bancarias'     => '0.50',  'inadimplencia' => '0.50',
            'propaganda'    => '1.00',  'rma'           => '0.50',  'fixas'         => '3.50',
            'lucro'         => '10.00', 'pis2'          => '1.65',  'confins2'      => '7.80',
            'icms2'         => '18.00', 'ipi2'          => '15.00');

        $ano = isset($_GET['ano']) ? (int) $_GET['ano'] : date("Y");
        $nomesMeses = array(1=>'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
        $mesPadrao = array(
            'total'=>0,
            'transporte'=>0,
            'logistica'=>0,
            'comissao'=>0,
            'bancarias'=>0,
            'inadimplencia'=>0,
            'propaganda'=>0,
            'rma'=>0,
            'fixas'=>0,
            'lucro'=>0,
            'pis'=>0,
            'confins'=>0,
            'icms'=>0,
            'ipi'=>0,
        );
        $nomesValores = array(
            'total'=>'Total',
            'transporte'=>'Transporte',
            'logistica'=>'Logística e armazenagem',
            'comissao'=>'Comissão',
            'bancarias'=>'Despesas Bancárias',
            'inadimplencia'=>'Inadimplência',
            'propaganda'=>'Propaganda',
            'rma'=>'RMA',
            'fixas'=>'Despesas fixas',
            'lucro'=>'Margem de Lucro',
            'pis'=>'PIS',
            'confins'=>'CONFINS',
            'icms'=>'ICMS',
            'ipi'=>'IPI',
        );

        $sql = "SELECT *, MONTH(p.dataPedido) as mesPedido FROM Pedido p INNER JOIN PedidoItem pi ON (p.idPedido = pi.idPedido) WHERE YEAR(p.dataPedido) = '$ano' AND p.statusPedido = 1 ORDER BY p.dataPedido ASC";
        $pedidosDb = Yii::app()->db->createCommand($sql)->queryAll();

        if (count($pedidosDb)) {
            $pedidos = array();
            $meses = array();

            foreach ($pedidosDb as $v) {
                if (!isset($meses[$v['mesPedido']])) $meses[$v['mesPedido']] = $mesPadrao;
                $mes = $meses[$v['mesPedido']];
                $mes['total'] += $v['valorPedidoItem'] * $v['quantidadePedidoItem'];
                $mes['total'] = number_format($mes['total'], 2,'.','');
                $meses[$v['mesPedido']] = $mes;
            }

            $anual = $mesPadrao;
            foreach ($meses as &$mes) {
                foreach ($mes as $k=>$v) {
                    if ($k == 'total') {
                        $anual['total'] += $v;
                        $anual['total'] = number_format($anual['total'], 2,'.','');
                        continue;
                    }
                    $mes[$k] = $mes['total'] * ($valores[$k]/100);
                    $anual[$k] += $mes[$k];
                }
            }
            unset($mes);

            $table = new CTXTable();
            $table->attr('class','dataGrid');
            $rowCabecalho = $table->addRow();
            $rowVendas = $table->addRow();
            $rowCabecalho->addHea('Valores')->attr('colspan',2);
            $rowVendas->addHea('Vendas')->attr('colspan',2);
            foreach ($meses as $k=>$v) {
                $nome = $nomesMeses[$k]."/".$ano;
                $rowCabecalho->addHea($nome);
                $rowVendas->addCol($v['total']);
            }
            $rowCabecalho->addHea('Anual');
            $rowVendas->addCol($anual['total']);

            $estoque = array();
            foreach ($anual as $k=>$v) {
                if ($k == 'total') continue;
                $row = $table->addRow();
                $row->addHea($nomesValores[$k]);
                $row->addCol(number_format($valores[$k], 2,'.',''));
                foreach ($meses as $k2=>$v2) {
                    if (!isset($estoque[$k2])) $estoque[$k2] = $v2['total'];
                    if ($k != 'pis' && $k != 'confins' && $k != 'icms' && $k != 'ipi') $estoque[$k2] -= $v2[$k];
                    $row->addCol(number_format($v2[$k], 2,'.',''));
                }
                $row->addCol(number_format($v,2,'.',''));
            }

            $totalEstoque = 0;
            $row = $table->addRow();
            $row->addHea('Preço estoque')->attr('colspan',2);
            foreach ($estoque as $v) {
                $totalEstoque += $v;
                $row->addCol(number_format($v,2,'.',''));
            }
            $row->addCol($totalEstoque);

            $this->render('relatorio3',array(
                'table'=>$table,
                'ano'=>$ano,
            ));
        } else {
            $this->render('relatorio3',array(
                'semRs'=>true,
                'ano'=>$ano,
            ));
        }
    }
}
