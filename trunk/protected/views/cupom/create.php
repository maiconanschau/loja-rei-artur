<h2>New Cupom</h2>

<div class="actionBar">
[<?php echo CHtml::link('Cupom List',array('list')); ?>]
[<?php echo CHtml::link('Manage Cupom',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>