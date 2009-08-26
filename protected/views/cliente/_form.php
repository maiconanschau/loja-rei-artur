<div class="yiiForm">

    <p>
        Fields with <span class="required">*</span> are required.
    </p>

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>
    <?php echo CHtml::errorSummary($modelFisico); ?>
    <?php echo CHtml::errorSummary($modelJuridico); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'tipoCliente'); ?>
        <?php echo CHtml::activeDropDownList($model, 'tipoCliente', $model->getTipoOptions()); ?>
    </div>

    <!-- INICIO FORM CLIENTE FISICO -->
    <div class="formFisico" style="display:none;">
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelFisico, 'nomeCliente'); ?>
            <?php echo CHtml::activeTextField($modelFisico, 'nomeCliente',array('size'=>60,'maxlength'=>150)); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelFisico, 'cpfCliente'); ?>
            <?php echo CHtml::activeTextField($modelFisico, 'cpfCliente',array('size'=>25,'maxlength'=>14)); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelFisico, 'sexoCliente'); ?>
            <?php echo CHtml::activeDropDownList($modelFisico, 'sexoCliente', $modelFisico->getSexoOptions()); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelFisico, 'nascimentoCliente'); ?>
            <?php echo CHtml::activeTextField($modelFisico, 'nascimentoCliente',array('size'=>15,'maxlength'=>10)); ?>
        </div>
    </div>
    <!-- FIM FORM CLIENTE FISICO -->

    <!-- INICIO FORM CLIENTE JURIDICO -->
    <div class="formJuridico" style="display:none;">
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelJuridico, 'razaoSocialCliente'); ?>
            <?php echo CHtml::activeTextField($modelJuridico, 'razaoSocialCliente',array('size'=>60,'maxlength'=>150)); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelJuridico, 'cnpjCliente'); ?>
            <?php echo CHtml::activeTextField($modelJuridico, 'cnpjCliente',array('size'=>25,'maxlength'=>18)); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelJuridico, 'inscricaoEstadualCliente'); ?>
            <?php echo CHtml::activeTextField($modelJuridico, 'inscricaoEstadualCliente',array('size'=>45,'maxlength'=>45)); ?>
        </div>
        <div class="simple">
            <?php echo CHtml::activeLabelEx($modelJuridico, 'responsavelCliente'); ?>
            <?php echo CHtml::activeTextField($modelJuridico, 'responsavelCliente'); ?>
        </div>
    </div>
    <!-- FIM FORM CLIENTE JURIDICO -->

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'emailCliente'); ?>
        <?php echo CHtml::activeTextField($model,'emailCliente',array('size'=>60,'maxlength'=>150)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'senhaCliente'); ?>
        <?php echo CHtml::activePasswordField($model,'senhaCliente',array('size'=>30)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'senha2Cliente'); ?>
        <?php echo CHtml::activePasswordField($model,'senha2Cliente',array('size'=>30)); ?>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('#ClienteFisico_cpfCliente').mask('999.999.999-99');
        $('#ClienteFisico_nascimentoCliente').mask('99/99/9999');
        $('#ClienteJuridico_cnpjCliente').mask('99.999.999/9999-99');
        $('#Cliente_telefoneCliente').add('#Cliente_celularCliente').mask('99 9999-9999');

        /* FORM FISICO/JURIDICO */
        function exibeForm() {
            var $formFisico = $('.formFisico');
            var $formJuridico = $('.formJuridico');

            var opt = $('#Cliente_tipoCliente').val();
            if (opt == 1) {
                $formFisico.show();
                $formJuridico.hide();
            } else if (opt == 2) {
                $formFisico.hide();
                $formJuridico.show();
            } else {
                $formFisico.hide();
                $formJuridico.hide();
            }
        }

        $('#Cliente_tipoCliente').change(exibeForm).change();
    });
</script>