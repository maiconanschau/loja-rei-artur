<h2>Update Cliente <?php echo $model->idCliente; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Cliente List',array('list')); ?>]
[<?php echo CHtml::link('New Cliente',array('create')); ?>]
[<?php echo CHtml::link('Manage Cliente',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>