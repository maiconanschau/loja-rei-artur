<ul id="menutt">
    <?php foreach ($categorias as $v) : ?>
    <li><a href="<?php echo CHtml::normalizeUrl(array('categoria/'.$v->idCategoria)); ?>"><?php echo CHtml::encode($v->nomeCategoria); ?><span><?php echo CHtml::encode($v->descricaoCategoria); ?></span></a></li>
    <?php endforeach; ?>
</ul>