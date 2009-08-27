<h2>Contato</h2>

<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    
    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'nome'); ?>
        <?php echo CHtml::activeTextField($model, 'nome',array('size'=>60)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'email'); ?>
        <?php echo CHtml::activeTextField($model, 'email',array('size'=>60)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'assunto'); ?>
        <?php echo CHtml::activeTextField($model, 'assunto',array('size'=>60)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'mensagem'); ?>
        <?php echo CHtml::activeTextArea($model, 'mensagem',array('cols'=>40,'rows'=>10)); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton('Enviar'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>
