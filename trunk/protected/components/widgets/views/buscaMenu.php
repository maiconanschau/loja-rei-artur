<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Busca</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline">
        <?php echo CHtml::beginForm(array('produto/busca'),'get'); ?>

        <?php echo CHtml::textField('q',null,array('style'=>'width:186px;')); ?>

        <?php echo CHtml::dropDownList('c', null, $categorias, array('style'=>'width:190px;')); ?>

        <input type="submit" value="Buscar"/>
        <?php echo CHtml::endForm(); ?>
    </td>
</tr>
<?php if (count($termos)) : ?>
<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Buscas recentes</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline" class="buscasRecentes">
        <?php foreach ($termos as $v) : ?>
        <a href="<?php echo CHtml::normalizeUrl(array('produto/busca','q'=>$v)); ?>"><?php echo $v; ?></a>&nbsp;
        <?php endforeach; ?>
    </td>
</tr>
<?php endif; ?>