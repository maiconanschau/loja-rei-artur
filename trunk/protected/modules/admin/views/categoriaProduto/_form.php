<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'nomeCategoria'); ?>
        <?php echo CHtml::activeTextField($model,'nomeCategoria',array('size'=>45,'maxlength'=>45)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'descricaoCategoria'); ?>
        <?php echo CHtml::activeTextField($model,'descricaoCategoria',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'visivelCategoria'); ?>
        <?php echo CHtml::activeDropDownList($model, 'visivelCategoria', array(1=>'Sim',0=>'Não')); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Adicionar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->