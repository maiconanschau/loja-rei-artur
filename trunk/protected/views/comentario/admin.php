<h2>Managing Comentario</h2>

<div class="actionBar">
[<?php echo CHtml::link('Comentario List',array('list')); ?>]
[<?php echo CHtml::link('New Comentario',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idComentario'); ?></th>
    <th><?php echo $sort->link('status'); ?></th>
    <th><?php echo $sort->link('dataCriacao'); ?></th>
    <th><?php echo $sort->link('idCliente'); ?></th>
    <th><?php echo $sort->link('idProduto'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idComentario,array('show','id'=>$model->idComentario)); ?></td>
    <td><?php echo CHtml::encode($model->status); ?></td>
    <td><?php echo CHtml::encode($model->dataCriacao); ?></td>
    <td><?php echo CHtml::encode($model->idCliente); ?></td>
    <td><?php echo CHtml::encode($model->idProduto); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->idComentario)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idComentario),
      	  'confirm'=>"Are you sure to delete #{$model->idComentario}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>