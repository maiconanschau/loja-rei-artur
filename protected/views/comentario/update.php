<h2>Update Comentario <?php echo $model->idComentario; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Comentario List',array('list')); ?>]
[<?php echo CHtml::link('New Comentario',array('create')); ?>]
[<?php echo CHtml::link('Manage Comentario',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
)); ?>