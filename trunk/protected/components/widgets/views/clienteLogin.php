<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Cliente</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline">
        <?php echo CHtml::beginForm(array('cliente/login')); ?>
        <?php echo CHtml::activeLabel($model,'email',array('style'=>'width:55px;float:left;')); ?>
        <?php echo CHtml::activeTextField($model,'email',array('size'=>18)) ?><br/>
        <?php echo CHtml::activeLabel($model,'senha',array('style'=>'width:55px;float:left;')); ?>
        <?php echo CHtml::activePasswordField($model,'senha',array('size'=>10)) ?>
        <?php echo CHtml::submitButton('Login'); ?>
        <?php echo CHtml::endForm(); ?>
    </td>
</tr>