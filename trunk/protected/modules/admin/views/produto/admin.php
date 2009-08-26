<h2>Managing Produto</h2>

<div class="actionBar">
[<?php echo CHtml::link('Produto List',array('list')); ?>]
[<?php echo CHtml::link('New Produto',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $sort->link('idProduto'); ?></th>
    <th><?php echo $sort->link('idCategoria'); ?></th>
    <th><?php echo $sort->link('nomeProduto'); ?></th>
    <th><?php echo $sort->link('pesoProduto'); ?></th>
    <th><?php echo $sort->link('precoProduto'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idProduto,array('show','id'=>$model->idProduto)); ?></td>
    <td><?php echo CHtml::encode($model->idCategoria); ?></td>
    <td><?php echo CHtml::encode($model->nomeProduto); ?></td>
    <td><?php echo CHtml::encode($model->pesoProduto); ?></td>
    <td><?php echo CHtml::encode($model->precoProduto); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->idProduto)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idProduto),
      	  'confirm'=>"Are you sure to delete #{$model->idProduto}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>