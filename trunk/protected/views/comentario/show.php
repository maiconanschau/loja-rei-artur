<h2>View Comentario <?php echo $model->idComentario; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Comentario List',array('list')); ?>]
[<?php echo CHtml::link('New Comentario',array('create')); ?>]
[<?php echo CHtml::link('Update Comentario',array('update','id'=>$model->idComentario)); ?>]
[<?php echo CHtml::linkButton('Delete Comentario',array('submit'=>array('delete','id'=>$model->idComentario),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Comentario',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('conteudo')); ?>
</th>
    <td><?php echo CHtml::encode($model->conteudo); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?>
</th>
    <td><?php echo CHtml::encode($model->status); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('dataCriacao')); ?>
</th>
    <td><?php echo CHtml::encode($model->dataCriacao); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idCliente')); ?>
</th>
    <td><?php echo CHtml::encode($model->idCliente); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idProduto')); ?>
</th>
    <td><?php echo CHtml::encode($model->idProduto); ?>
</td>
</tr>
</table>
