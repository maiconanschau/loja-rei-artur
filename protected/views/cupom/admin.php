<h2>Managing Cupom</h2>

<div class="actionBar">
[<?php echo CHtml::link('Cupom List',array('list')); ?>]
[<?php echo CHtml::link('New Cupom',array('create')); ?>]
</div>

<table class="dataGrid">
  <thead>
  <tr>
    <th><?php echo $sort->link('idCupom'); ?></th>
    <th><?php echo $sort->link('chaveCupom'); ?></th>
    <th><?php echo $sort->link('valorCupom'); ?></th>
    <th><?php echo $sort->link('tipoCupom'); ?></th>
    <th><?php echo $sort->link('restritoCupom'); ?></th>
	<th>Actions</th>
  </tr>
  </thead>
  <tbody>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idCupom,array('show','id'=>$model->idCupom)); ?></td>
    <td><?php echo CHtml::encode($model->chaveCupom); ?></td>
    <td><?php echo CHtml::encode($model->valorCupom); ?></td>
    <td><?php echo CHtml::encode($model->tipoCupom); ?></td>
    <td><?php echo CHtml::encode($model->restritoCupom); ?></td>
    <td>
      <?php echo CHtml::link('Update',array('update','id'=>$model->idCupom)); ?>
      <?php echo CHtml::linkButton('Delete',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idCupom),
      	  'confirm'=>"Are you sure to delete #{$model->idCupom}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>