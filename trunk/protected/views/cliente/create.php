<h2>New Cliente</h2>

<div class="actionBar">
[<?php echo CHtml::link('Cliente List',array('list')); ?>]
[<?php echo CHtml::link('Manage Cliente',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
        'modelFisico'=>$modelFisico,
        'modelJuridico'=>$modelJuridico,
        'modelEndereco'=>$modelEndereco,
	'update'=>false,
)); ?>