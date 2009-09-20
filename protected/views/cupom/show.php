<h2>View Cupom <?php echo $model->idCupom; ?></h2>

<div class="actionBar">
[<?php echo CHtml::link('Cupom List',array('list')); ?>]
[<?php echo CHtml::link('New Cupom',array('create')); ?>]
[<?php echo CHtml::link('Update Cupom',array('update','id'=>$model->idCupom)); ?>]
[<?php echo CHtml::linkButton('Delete Cupom',array('submit'=>array('delete','id'=>$model->idCupom),'confirm'=>'Are you sure?')); ?>
]
[<?php echo CHtml::link('Manage Cupom',array('admin')); ?>]
</div>

<table class="dataGrid">
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('chaveCupom')); ?>
</th>
    <td><?php echo CHtml::encode($model->chaveCupom); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('valorCupom')); ?>
</th>
    <td><?php echo CHtml::encode($model->valorCupom); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('tipoCupom')); ?>
</th>
    <td><?php echo CHtml::encode($model->tipoCupom); ?>
</td>
</tr>
<tr>
	<th class="label"><?php echo CHtml::encode($model->getAttributeLabel('restritoCupom')); ?>
</th>
    <td><?php echo CHtml::encode($model->restritoCupom); ?>
</td>
</tr>
</table>
