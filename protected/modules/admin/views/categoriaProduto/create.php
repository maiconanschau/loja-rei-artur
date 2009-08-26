<h2>New CategoriaProduto</h2>

<div class="actionBar">
[<?php echo CHtml::link('CategoriaProduto List',array('list')); ?>]
[<?php echo CHtml::link('Manage CategoriaProduto',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
)); ?>