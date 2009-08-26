<h2>Managing CategoriaProduto</h2>

<div class="actionBar">
[<?php echo CHtml::link('CategoriaProduto List',array('list')); ?>]
[<?php echo CHtml::link('New CategoriaProduto',array('create')); ?>]
</div>

<table class="dataGrid">
  <tr>
    <th><?php echo $sort->link('idCategoria'); ?></th>
    <th><?php echo $sort->link('nomeCategoria'); ?></th>
    <th><?php echo $sort->link('visivelCategoria'); ?></th>
	<th>Actions</th>
  </tr>
<?php foreach($models as $n=>$model): ?>
  <tr class="<?php echo $n%2?'even':'odd';?>">
    <td><?php echo CHtml::link($model->idCategoria,array('show','id'=>$model->idCategoria)); ?></td>
    <td><?php echo CHtml::encode($model->nomeCategoria); ?></td>
    <td><?php echo CHtml::encode($model->visivelCategoria ? "Sim" : "Não"); ?></td>
    <td>
      <?php echo CHtml::link('Editar',array('update','id'=>$model->idCategoria)); ?>
      <?php echo CHtml::linkButton('Apagar',array(
      	  'submit'=>'',
      	  'params'=>array('command'=>'delete','id'=>$model->idCategoria),
      	  'confirm'=>"Deseja apagar a categoria #{$model->idCategoria}?")); ?>
	</td>
  </tr>
<?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>