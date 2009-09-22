<h2>Cupom List</h2>

<div class="actionBar">
[<?php echo CHtml::link('New Cupom',array('create')); ?>]
[<?php echo CHtml::link('Manage Cupom',array('admin')); ?>]
</div>

<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>

<?php foreach($models as $n=>$model): ?>
<div class="item">
<?php echo CHtml::encode($model->getAttributeLabel('idCupom')); ?>:
<?php echo CHtml::link($model->idCupom,array('show','id'=>$model->idCupom)); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('chaveCupom')); ?>:
<?php echo CHtml::encode($model->chaveCupom); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('valorCupom')); ?>:
<?php echo CHtml::encode($model->valorCupom); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('tipoCupom')); ?>:
<?php echo CHtml::encode($model->tipoCupom); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('usoUnicoCupom')); ?>:
<?php echo CHtml::encode($model->usoUnicoCupom); ?>
<br/>
<?php echo CHtml::encode($model->getAttributeLabel('restritoCupom')); ?>:
<?php echo CHtml::encode($model->restritoCupom); ?>
<br/>

</div>
<?php endforeach; ?>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>