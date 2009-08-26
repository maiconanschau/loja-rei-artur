<h2>Endereco List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New Endereco',array('create')); ?>]
[<?php echo CHtml::link('Manage Endereco',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idCliente')); ?>:
<?php echo CHtml::link($model->idCliente,array('show','id'=>$model->idCliente)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('idEndereco')); ?>:
<?php echo CHtml::encode($model->idEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipoEndereco')); ?>:
<?php echo CHtml::encode($model->tipoEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('ruaEndereco')); ?>:
<?php echo CHtml::encode($model->ruaEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('numeroEndereco')); ?>:
<?php echo CHtml::encode($model->numeroEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('complementoEndereco')); ?>:
<?php echo CHtml::encode($model->complementoEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('bairroEndereco')); ?>:
<?php echo CHtml::encode($model->bairroEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('cepEndereco')); ?>:
<?php echo CHtml::encode($model->cepEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('cidadeEndereco')); ?>:
<?php echo CHtml::encode($model->cidadeEndereco); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('estadoEndereco')); ?>:
<?php echo CHtml::encode($model->estadoEndereco); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>