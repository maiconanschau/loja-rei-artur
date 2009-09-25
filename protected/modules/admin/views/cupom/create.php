<h2>Novo cupom</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo cupom',array('create')); ?>]
    [<?php echo CHtml::link('Listar cupons',array('admin')); ?>]
</div>

<?php echo $this->renderPartial('_form', array(
	'model'=>$model,
	'update'=>false,
        'clientes'=>$clientes,
)); ?>