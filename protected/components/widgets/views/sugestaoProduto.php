<tr>
    <td colspan="2" valign="baseline" bgcolor="#CC9933">
        <strong>Compre agora!</strong>
    </td>
</tr>
<tr>
    <td width="121" align="left" valign="baseline" class="sugestaoProduto produtoHome">
        <div class="nome"><?php echo $produto->nomeProduto ?></div>
        <div class="foto">
            <img src="<?php echo CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$foto->idFotoProduto,'a'=>160,'l'=>100)); ?>" alt="<?php echo "Foto de ".$produto->nomeProduto; ?>"/>
        </div>
        <div class="preco">
            R$ <?php echo number_format($produto->precoProduto, 2,',','.'); ?>
        </div>
    </td>
</tr>