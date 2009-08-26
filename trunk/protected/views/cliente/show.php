<h2>View Cliente <?php echo $model->idCliente; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Cliente List',array('list')); ?>]
[<?php echo CHtml::link('New Cliente',array('create')); ?>]
[<?php echo CHtml::link('Update Cliente',array('update','id'=>$model->idCliente)); ?>]
[<?php echo CHtml::linkButton('Delete Cliente',array('submit'=>array('delete','id'=>$model->idCliente),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Cliente',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipoCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipoCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('emailCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->emailCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('senhaCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->senhaCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('telefoneCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->telefoneCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('celularCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->celularCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('chamadoCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->chamadoCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('newsletterCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->newsletterCliente); ?>
</td>
</tr>
</table>
