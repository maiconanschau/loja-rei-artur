<h2>View Endereco <?php echo $model->idCliente; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Endereco List',array('list')); ?>]
[<?php echo CHtml::link('New Endereco',array('create')); ?>]
[<?php echo CHtml::link('Update Endereco',array('update','id'=>$model->idCliente)); ?>]
[<?php echo CHtml::linkButton('Delete Endereco',array('submit'=>array('delete','id'=>$model->idCliente),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Endereco',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->idEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipoEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipoEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('ruaEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->ruaEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('numeroEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->numeroEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('complementoEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->complementoEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('bairroEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->bairroEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cepEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->cepEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('cidadeEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->cidadeEndereco); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('estadoEndereco')); ?>
</th>
    <td><?php echo CHtml::encode($model->estadoEndereco); ?>
</td>
</tr>
</table>
