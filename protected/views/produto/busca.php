<h2><?php echo empty($categoria) ? 'Busca' : 'Categoria '.$categoria->nomeCategoria; ?></h2>
<br/>
<?php if (count($models)) : ?>
<?php echo $tabelaProdutos; ?>
<div id="paginacao">
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>
</div>
<?php else : ?>
<p>Nenhum resultado encontrado.</p>
<?php endif; ?>