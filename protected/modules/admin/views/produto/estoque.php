<h2>Previsão de estoque</h2>
<br/>
<div class="yiiForm">
    <?php echo CHtml::beginForm('','get'); ?>

    Mes <?php echo CHtml::textField('mes', (empty($mes) ? date("m") : $mes)); ?>

    <?php echo CHtml::submitButton("Filtrar"); ?>

    <?php echo CHtml::endForm(); ?>
</div>
<?php if (!empty($mes)) : ?>
<br/>
<table class="dataGrid">
    <tr>
        <th>Produto</th>
        <th>Quantidade para o mês <?php echo $mes; ?></th>
    </tr>
    <?php foreach ($quant as $k=>$v) : ?>
    <tr>
        <td><?php echo Produto::model()->findByPk($k)->nomeProduto; ?></td>
        <td><?php echo $v; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>