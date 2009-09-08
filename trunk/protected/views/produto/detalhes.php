<h2><?php echo $produto->nomeProduto; ?></h2>

<div class="produto">
    <div class="apresentacao">
        <ul class="fotos">

            <?php foreach ($fotos as $foto) : ?>
            <img src="<?php echo CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$foto->idFotoProduto,'a'=>200,'l'=>150)); ?>" alt="Foto de <?php echo $produto->nomeProduto; ?>"/>
            <?php endforeach; ?>
        </ul>
        
        <div class="descricaoCurta">
            <?php echo $produto->descricaoCurtaProduto; ?>
        </div>
    </div>
    <div class="detalhes">
        <div class="descricaoLonga">
            <?php echo $produto->descricaoLongaProduto; ?>
        </div>
    </div>
    <div class="info">
   <p>Por :</p> R$ <?php echo number_format($produto->precoProduto, 2,',','.'); ?>
        </div>
</div>