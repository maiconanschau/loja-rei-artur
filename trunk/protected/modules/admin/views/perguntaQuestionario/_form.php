<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'tipoPergunta'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipoPergunta', $model->getTipoOptions()); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'textoPergunta'); ?>
        <?php echo CHtml::activeTextField($model,'textoPergunta',array('size'=>45,'maxlength'=>45)); ?>
    </div>

    <div class="simple" id="divLista">
        <?php echo CHtml::activeLabelEx($model,'opcoesPergunta'); ?>
        <?php echo CHtml::activeTextArea($model, 'opcoesPergunta',array('cols'=>30)); ?>
        <p class="hint">Informe uma opção por linha.</p>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Adicionar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#PerguntaQuestionario_tipoPergunta').change(function(){
            var val = $(this).val();
            var $div = $('#divLista');
            if (val == 3 || val == 4 || val == 5) {
                $div.show();
            } else {
                $div.hide();
            }
        }).change();
    });
</script>