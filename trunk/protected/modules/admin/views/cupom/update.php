<h2>Update Cupom <?php echo $model->idCupom; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Cupom List',array('list')); ?>]
[<?php echo CHtml::link('New Cupom',array('create')); ?>]
[<?php echo CHtml::link('Manage Cupom',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>