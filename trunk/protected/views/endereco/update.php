<h2>Update Endereco <?php echo $model->idCliente; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Endereco List',array('list')); ?>]
[<?php echo CHtml::link('New Endereco',array('create')); ?>]
[<?php echo CHtml::link('Manage Endereco',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>