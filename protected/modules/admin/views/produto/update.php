<h2>Update Produto <?php echo $model->idProduto; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Produto List',array('list')); ?>]
[<?php echo CHtml::link('New Produto',array('create')); ?>]
[<?php echo CHtml::link('Manage Produto',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
        'categorias'=>$categorias
)); ?>