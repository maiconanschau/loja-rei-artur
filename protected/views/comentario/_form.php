<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'conteudo'); ?>
<?php echo CHtml::activeTextArea($model,'conteudo',array('rows'=>6, 'cols'=>50)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'status'); ?>
<?php echo CHtml::activeTextField($model,'status'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'dataCriacao'); ?>
<?php echo CHtml::activeTextField($model,'dataCriacao'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idCliente'); ?>
<?php echo CHtml::activeTextField($model,'idCliente'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'idProduto'); ?>
<?php echo CHtml::activeTextField($model,'idProduto'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->