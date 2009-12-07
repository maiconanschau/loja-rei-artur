<?xml version="1.0" encoding="UTF-8"?>
<nota_pedido_compra>
    <cabecalho>
        <numero serie="<?php echo $serie; ?>"><?php echo $numeroPedido; ?></numero>
        <empresa>
            <cgc><?php echo $cgc; ?></cgc>
            <nome><?php echo $nome; ?></nome>
            <telefone><?php echo $telefone; ?></telefone>
            <endereco><?php echo $endereco; ?></endereco>
            <comprador><?php echo $comprador; ?></comprador>
        </empresa>
        <data_emissao><?php echo date("d/m/Y H:i:s"); ?></data_emissao>
    </cabecalho>
    <itens>
        <?php foreach ($produtos as $k=>$v) : ?><item>
            <numero_linha><?php echo $k+1; ?></numero_linha>
            <id><?php echo $v[0]->idProduto; ?></id>
            <descricao_produto><?php echo $v[0]->nomeProduto; ?></descricao_produto>
            <quantidade><?php echo $v[1]; ?></quantidade>
            <preco_max><?php echo number_format($v[0]->precoProduto*.7,2); ?></preco_max>
        </item>
    <?php endforeach; ?></itens>
</nota_pedido_compra>