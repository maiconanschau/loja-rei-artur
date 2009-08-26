<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idEndereco'); ?>
<?php echo CHtml::activeTextField($model,'idEndereco'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipoEndereco'); ?>
<?php echo CHtml::activeTextField($model,'tipoEndereco'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'ruaEndereco'); ?>
<?php echo CHtml::activeTextField($model,'ruaEndereco',array('size'=>60,'maxlength'=>150)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'numeroEndereco'); ?>
<?php echo CHtml::activeTextField($model,'numeroEndereco',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'complementoEndereco'); ?>
<?php echo CHtml::activeTextField($model,'complementoEndereco',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'bairroEndereco'); ?>
<?php echo CHtml::activeTextField($model,'bairroEndereco',array('size'=>45,'maxlength'=>45)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cepEndereco'); ?>
<?php echo CHtml::activeTextField($model,'cepEndereco',array('size'=>8,'maxlength'=>8)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'cidadeEndereco'); ?>
<?php echo CHtml::activeTextField($model,'cidadeEndereco',array('size'=>60,'maxlength'=>150)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'estadoEndereco'); ?>
<?php echo CHtml::activeTextField($model,'estadoEndereco',array('size'=>2,'maxlength'=>2)); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->