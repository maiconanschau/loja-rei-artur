<h2>Relatório</h2>
<br/>
<div class="yiiForm">
    <?php echo CHtml::beginForm('','get'); ?>

    De
    <?php echo CHtml::textField('di', CTXDate::toDate($dataInicial)); ?>
    até
    <?php echo CHtml::textField('df', CTXDate::toDate($dataFinal)); ?>

    <?php echo CHtml::submitButton("Filtrar"); ?>

    <?php echo CHtml::endForm(); ?>
</div>
<br/>
<table class="dataGrid">
    <tr>
        <th>Produto</th>
        <th>Quantidade</th>
        <th>Valor unitário</th>
        <th>Valor total</th>
    </tr>
    <?php foreach ($produtos as $v) : ?>
    <tr>
        <td><?php echo $v['produto']->nomeProduto; ?></td>
        <td><?php echo $v['item']->quantidadePedidoItem; ?></td>
        <td>R$ <?php echo number_format($v['item']->valorPedidoItem, 2,',','.'); ?></td>
        <td>R$ <?php echo number_format($v['item']->valorPedidoItem * $v['item']->quantidadePedidoItem, 2,',','.'); ?></td>
    </tr>
    <?php endforeach; ?>
    <tr>
        <th>Total produtos</th>
        <td colspan="3"><?php echo $totalProdutos; ?></td>
    </tr>
    <tr>
        <th>Total Período</th>
        <td colspan="3">R$ <?php echo number_format($totalPeriodo, 2,",","."); ?></td>
    </tr>
    <tr>
        <th>Valor médio por produto</th>
        <td colspan="3">R$ <?php echo number_format($mediaPeriodo, 2,",","."); ?></td>
    </tr>
</table>
<script type="text/javascript">
    $('#di, #df').mask('99/99/9999');
</script>