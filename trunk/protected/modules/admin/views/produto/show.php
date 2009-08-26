<h2>View Produto <?php echo $model->idProduto; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Produto List',array('list')); ?>]
[<?php echo CHtml::link('New Produto',array('create')); ?>]
[<?php echo CHtml::link('Update Produto',array('update','id'=>$model->idProduto)); ?>]
[<?php echo CHtml::linkButton('Delete Produto',array('submit'=>array('delete','id'=>$model->idProduto),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Produto',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idCategoria')); ?>
</th>
    <td><?php echo CHtml::encode($model->idCategoria); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('nomeProduto')); ?>
</th>
    <td><?php echo CHtml::encode($model->nomeProduto); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('descricaoProduto')); ?>
</th>
    <td><?php echo CHtml::encode($model->descricaoProduto); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('pesoProduto')); ?>
</th>
    <td><?php echo CHtml::encode($model->pesoProduto); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('precoProduto')); ?>
</th>
    <td><?php echo CHtml::encode($model->precoProduto); ?>
</td>
</tr>
</table>
