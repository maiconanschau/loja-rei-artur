<h2>Managing Cliente</h2>

<div class="actionBar">
[<?php echo CHtml::link('Cliente List',array('list')); ?>]
[<?php echo CHtml::link('New Cliente',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idCliente'); ?></th>
    <th><?php echo $sort->link('tipoCliente'); ?></th>
    <th><?php echo $sort->link('emailCliente'); ?></th>
    <th><?php echo $sort->link('senhaCliente'); ?></th>
    <th><?php echo $sort->link('telefoneCliente'); ?></th>
    <th><?php echo $sort->link('celularCliente'); ?></th>
    <th><?php echo $sort->link('chamadoCliente'); ?></th>
    <th><?php echo $sort->link('newsletterCliente'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idCliente,array('show','id'=>$model->idCliente)); ?></td>
    <td><?php echo CHtml::encode($model->tipoCliente); ?></td>
    <td><?php echo CHtml::encode($model->emailCliente); ?></td>
    <td><?php echo CHtml::encode($model->senhaCliente); ?></td>
    <td><?php echo CHtml::encode($model->telefoneCliente); ?></td>
    <td><?php echo CHtml::encode($model->celularCliente); ?></td>
    <td><?php echo CHtml::encode($model->chamadoCliente); ?></td>
    <td><?php echo CHtml::encode($model->newsletterCliente); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->idCliente)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idCliente),
      	  'confirm'=>"Are you sure to delete #{$model->idCliente}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>