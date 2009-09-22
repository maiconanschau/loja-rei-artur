<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'chaveCupom'); ?>
<?php echo CHtml::activeTextField($model,'chaveCupom',array('size'=>45,'maxlength'=>45)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'valorCupom'); ?>
<?php echo CHtml::activeTextField($model,'valorCupom',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipoCupom'); ?>
<?php echo CHtml::activeTextField($model,'tipoCupom'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'usoUnicoCupom'); ?>
<?php echo CHtml::activeTextField($model,'usoUnicoCupom'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'restritoCupom'); ?>
<?php echo CHtml::activeTextField($model,'restritoCupom'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->