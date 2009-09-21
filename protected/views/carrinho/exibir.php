<h2>Carrinho</h2>
<br/>
<?php if (count($produtos)) : ?>
<form method="post" class="formCarrinho">
    <table width="100%" border="1">
        <?php foreach ($produtos as $v) : ?>
        <tr class="produtoCarrinho">
            <td><?php echo $v['produto']->nomeProduto; ?></td>
            <td width="1"><input type="text" name="produto[<?php echo $v['produto']->idProduto; ?>]" value="<?php echo $v['quant']; ?>" style="width:30px;text-align:center;"/></td>
            <td width="150px" align="center">
                <?php echo CHtml::link('Remover do carrinho', array("/carrinho/remover",'id'=>$v['produto']->idProduto), array('confirm'=>'Deseja remover este item?')); ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <div align="right">
        <input type="reset" value="Cancelar alterações"/>
        <input type="submit" value="Salvar alterações"/>
    </div>
</form>
<div class="carrinhoLinkFinalizar">
    <?php echo CHtml::link('Finalizar compra',array('/carrinho/finalizar')); ?>
</div>
<?php else : ?>
<h4>Seu carrinho está vazio.<br/>Navegue pela nossa loja e encontre os produtos que procura.</h4>
<?php endif; ?>