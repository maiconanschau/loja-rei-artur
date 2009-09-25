<h2>Editar cupom <?php echo $model->chaveCupom; ?></h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo cupom',array('create')); ?>]
    [<?php echo CHtml::link('Listar cupons',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>true,
        'clientes'=>$clientes,
)); ?>