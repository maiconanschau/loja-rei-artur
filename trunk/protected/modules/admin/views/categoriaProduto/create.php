<h2>Nova categoria</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Nova categoria',array('create')); ?>]
    [<?php echo CHtml::link('Listar categorias',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
'model'=>$model,
'update'=>false,
)); ?>