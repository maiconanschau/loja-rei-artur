<div class="yiiForm">

    <p>
        Fields with <span class="required">*</span> are required.
    </p>

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'tipoCliente'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipoCliente', $model->getTipoOptions()); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'emailCliente'); ?>
        <?php echo CHtml::activeTextField($model,'emailCliente',array('size'=>60,'maxlength'=>150)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'senhaCliente'); ?>
        <?php echo CHtml::activePasswordField($model,'senhaCliente',array('size'=>32,'maxlength'=>32)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'senha2Cliente'); ?>
        <?php echo CHtml::activePasswordField($model,'senha2Cliente',array('size'=>32,'maxlength'=>32)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'telefoneCliente'); ?>
        <?php echo CHtml::activeTextField($model,'telefoneCliente'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'celularCliente'); ?>
        <?php echo CHtml::activeTextField($model,'celularCliente'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'chamadoCliente'); ?>
        <?php echo CHtml::activeTextField($model,'chamadoCliente',array('size'=>45,'maxlength'=>45)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'newsletterCliente'); ?>
        <?php echo CHtml::activeCheckBox($model, 'newsletterCliente'); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->