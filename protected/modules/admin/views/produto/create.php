<h2>New Produto</h2>

<div class="actionBar">
[<?php echo CHtml::link('Produto List',array('list')); ?>]
[<?php echo CHtml::link('Manage Produto',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
        'categorias'=>$categorias
)); ?>