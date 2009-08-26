<h2>Managing Endereco</h2>

<div class="actionBar">
[<?php echo CHtml::link('Endereco List',array('list')); ?>]
[<?php echo CHtml::link('New Endereco',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $sort->link('idCliente'); ?></th>
    <th><?php echo $sort->link('idEndereco'); ?></th>
    <th><?php echo $sort->link('tipoEndereco'); ?></th>
    <th><?php echo $sort->link('ruaEndereco'); ?></th>
    <th><?php echo $sort->link('numeroEndereco'); ?></th>
    <th><?php echo $sort->link('complementoEndereco'); ?></th>
    <th><?php echo $sort->link('bairroEndereco'); ?></th>
    <th><?php echo $sort->link('cepEndereco'); ?></th>
    <th><?php echo $sort->link('cidadeEndereco'); ?></th>
    <th><?php echo $sort->link('estadoEndereco'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idCliente,array('show','id'=>$model->idCliente)); ?></td>
    <td><?php echo CHtml::encode($model->idEndereco); ?></td>
    <td><?php echo CHtml::encode($model->tipoEndereco); ?></td>
    <td><?php echo CHtml::encode($model->ruaEndereco); ?></td>
    <td><?php echo CHtml::encode($model->numeroEndereco); ?></td>
    <td><?php echo CHtml::encode($model->complementoEndereco); ?></td>
    <td><?php echo CHtml::encode($model->bairroEndereco); ?></td>
    <td><?php echo CHtml::encode($model->cepEndereco); ?></td>
    <td><?php echo CHtml::encode($model->cidadeEndereco); ?></td>
    <td><?php echo CHtml::encode($model->estadoEndereco); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->idCliente)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idCliente),
      	  'confirm'=>"Are you sure to delete #{$model->idCliente}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>