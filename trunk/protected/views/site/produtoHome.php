<div class="produtoHome">
    <a href="<?php echo CHtml::normalizeUrl(array('/produto/detalhes','id'=>$produto->idProduto)); ?>">
        <div class="nome"><?php echo $produto->nomeProduto ?></div>
        <div class="foto">
            <img src="<?php echo CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$foto->idFotoProduto,'a'=>200,'l'=>150)); ?>" alt="<?php echo "Foto de ".$produto->nomeProduto; ?>"/>
        </div>
        <div class="preco">
            R$ <?php echo number_format($produto->precoProduto, 2,',','.'); ?>
        </div>
    </a>
</div>
