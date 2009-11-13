<h2>Nova mensagem</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Nova mensagem',array('create')); ?>]
    [<?php echo CHtml::link('Listar mensagens',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
        'form'=>$form,
	'update'=>false,
        'categorias'=>$categorias,
        'produtos'=>$produtos,
)); ?>