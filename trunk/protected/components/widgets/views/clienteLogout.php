<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Dados Pessoais</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline">
        <a href="<?php echo CHtml::normalizeUrl(array("/cliente/novoEndereco")); ?>"><strong>Adicionar endereço</strong></a><br/>
    </td>
</tr>
<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Pedidos</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline">
        <a href="<?php echo CHtml::normalizeUrl(array("/pedido/historico")); ?>"><strong>Histórico</strong></a><br/>
    </td>
</tr>
<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Sistema</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline">
        <?php if ($quest) : ?>
        <a href="<?php echo CHtml::normalizeUrl(array("/cliente/questionario")); ?>"><strong>Questionário sócio-economico</strong></a><br/>
        <?php endif; ?>
        <a href="<?php echo CHtml::normalizeUrl(array("/cliente/logout")); ?>"><strong>Sair</strong></a><br/>
    </td>
</tr>
