<h2>Questionários Sócio-economico</h2>

<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>

    <?php foreach ($perguntas as $v) : ?>
    <div class="simple">
            <?php echo CHtml::activeLabelEx($model, $v->_fieldName); ?>
            <?php
            if (in_array($v->tipoPergunta,array(PerguntaQuestionario::TIPO_TEXTFIELD,PerguntaQuestionario::TIPO_TEXTAREA))) {
                echo call_user_func_array('CHtml::'.$v->_formMethod, array($model,$v->_fieldName));
            } elseif ($v->tipoPergunta == PerguntaQuestionario::TIPO_SELECT) {
                echo call_user_func_array('CHtml::'.$v->_formMethod, array($model,$v->_fieldName,$v->_options));
            } else { ?>
        <div class="optionList">
                    <?php echo call_user_func_array('CHtml::'.$v->_formMethod, array($model,$v->_fieldName,$v->_options)); ?>
        </div>
            <?php } ?>
    </div>
    <?php endforeach; ?>

    <div class="action">
        <?php echo CHtml::submitButton('Enviar'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>