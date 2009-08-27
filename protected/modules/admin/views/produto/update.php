<h2>Editar produto '<?php echo $model->nomeProduto; ?>'</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo produto',array('create')); ?>]
    [<?php echo CHtml::link('Listar produtos',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
'model'=>$model,
'update'=>true,
'categorias'=>$categorias
)); ?>