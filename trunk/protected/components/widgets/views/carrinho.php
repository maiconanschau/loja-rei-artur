<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Carrinho</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline" class="carrinhoMenu">
        <a href="<?php echo CHtml::normalizeUrl(array('/carrinho/exibir')); ?>">
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/imagens/carrinho.jpg" alt="Carrinho"/>
            <p>Você possui <?php echo $quant; ?> produto<?php echo $quant == 1 ? "" : "s"; ?> em seu carrinho.</p>
            <div class="clear">&nbsp;</div>
        </a>
    </td>
</tr>