<h2>Comentario List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New Comentario',array('create')); ?>]
[<?php echo CHtml::link('Manage Comentario',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idComentario')); ?>:
<?php echo CHtml::link($model->idComentario,array('show','id'=>$model->idComentario)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('conteudo')); ?>:
<?php echo CHtml::encode($model->conteudo); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('status')); ?>:
<?php echo CHtml::encode($model->status); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('dataCriacao')); ?>:
<?php echo CHtml::encode($model->dataCriacao); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idCliente')); ?>:
<?php echo CHtml::encode($model->idCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idProduto')); ?>:
<?php echo CHtml::encode($model->idProduto); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>