<div class="yiiForm">

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'conteudoComentario'); ?>
        <?php echo CHtml::activeTextArea($model,'conteudoComentario',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    
    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Criar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->