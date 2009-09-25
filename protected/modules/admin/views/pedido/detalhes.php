<h2>Detalhes</h2>
<br/>
<?php if (isset($_GET['c'])) : ?>
<p>Seu pedido foi confirmado.</p>
<br/>
<?php endif; ?>
<table class="pedido" width="100%" cellpadding="0" cellspacing="1">
    <tr>
        <th>Cliente</th>
        <td colspan="3"><?php echo $cliente->chamadoCliente; ?></td>
    </tr>
    <tr>
        <th>Data da compra</th>
        <td><?php echo CTXDate::toDate($model->dataPedido); ?></td>
        <th>Quantidade produtos</th>
        <td><?php echo $quantidadeProdutos; ?></td>
    </tr>
    <tr>
        <td colspan="4" class="noStyle">
            <table width="100%" class="itens" cellpadding="0" cellspacing="1">
                <tr>
                    <th>Quantidade</th>
                    <th>Produto</th>
                    <th>Valor unitário</th>
                    <th>Valor total</th>
                </tr>
                <?php foreach ($produtos as $v) : ?>
                <tr>
                    <td><?php echo $v['item']->quantidadePedidoItem; ?></td>
                    <td><?php echo $v['produto']->nomeProduto; ?></td>
                    <td><?php echo CTXUtil::formatMoney($v['item']->valorPedidoItem); ?></td>
                    <td><?php echo CTXUtil::formatMoney($v['item']->quantidadePedidoItem * $v['item']->valorPedidoItem); ?></td>
                </tr>
                    <?php endforeach; ?>
                <tr>
                    <th colspan="3" class="alignRight">Valor entrega</th>
                    <td><?php echo CTXUtil::formatMoney($model->valorEntrega); ?></td>
                </tr>
                <?php if (!empty($cupom)) : ?>
                <tr>
                    <th colspan="3" class="alignRight">Cupom de desconto</th>
                    <td><?php echo CTXUtil::formatMoney($valorCupom); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th colspan="3" class="alignRight">Total</th>
                    <td><?php echo CTXUtil::formatMoney($totalPedido); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table class="pedido" width="100%">
    <tr>
        <th width="150px">Rua</th>
        <td><?php echo $endereco->ruaEndereco; ?></td>
    </tr>
    <tr>
        <th>Número</th>
        <td><?php echo $endereco->numeroEndereco; ?></td>
    </tr>
    <tr>
        <th>Complemento</th>
        <td><?php echo empty($endereco->complementoEndereco) ? '-' : $endereco->complementoEndereco; ?></td>
    </tr>
    <tr>
        <th>CEP</th>
        <td><?php echo $endereco->cepEndereco; ?></td>
    </tr>
    <tr>
        <th>Bairro</th>
        <td><?php echo $endereco->bairroEndereco; ?></td>
    </tr>
    <tr>
        <th>Cidade</th>
        <td><?php echo $endereco->cidadeEndereco; ?></td>
    </tr>
    <tr>
        <th>Estado</th>
        <td><?php echo CTXEstados::getTexto($endereco->estadoEndereco); ?></td>
    </tr>
</table>