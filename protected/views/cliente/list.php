<h2>Cliente List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New Cliente',array('create')); ?>]
[<?php echo CHtml::link('Manage Cliente',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idCliente')); ?>:
<?php echo CHtml::link($model->idCliente,array('show','id'=>$model->idCliente)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipoCliente')); ?>:
<?php echo CHtml::encode($model->tipoCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('emailCliente')); ?>:
<?php echo CHtml::encode($model->emailCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('senhaCliente')); ?>:
<?php echo CHtml::encode($model->senhaCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('telefoneCliente')); ?>:
<?php echo CHtml::encode($model->telefoneCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('celularCliente')); ?>:
<?php echo CHtml::encode($model->celularCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('chamadoCliente')); ?>:
<?php echo CHtml::encode($model->chamadoCliente); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('newsletterCliente')); ?>:
<?php echo CHtml::encode($model->newsletterCliente); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>