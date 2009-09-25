<div class="yiiForm">

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'chaveCupom'); ?>
        <?php echo CHtml::activeTextField($model,'chaveCupom',array('size'=>45,'maxlength'=>45)); ?>
        <div style="color:#555555;">Se deixado em branco será gerada uma chave aleatória.</div>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'valorCupom'); ?>
        <?php echo CHtml::activeTextField($model,'valorCupom',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'tipoCupom'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipoCupom', $model->getTipoOptions()); ?>
    </div>

    <div class="action">
        <?php echo $clientes; ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Adicionar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#Cupom_valorCupom').decimal();
        $('#Cupom_chaveCupom').change(function(){
            var chave = $(this).val();
            chave = chave.toUpperCase();

            var er = new RegExp("[^0-9A-Z]",'gi');
            while (er.test(chave)) chave = chave.replace(er,"");

            $(this).val(chave);
        });
    });
</script>