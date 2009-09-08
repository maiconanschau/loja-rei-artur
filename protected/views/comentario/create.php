<h2>New Comentario</h2>

<div class="actionBar">
[<?php echo CHtml::link('Comentario List',array('list')); ?>]
[<?php echo CHtml::link('Manage Comentario',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>