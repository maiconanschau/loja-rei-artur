<h2>Adicionar endereço</h2>

<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <!-- INICIO FORM ENDEREÇO -->
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'ruaEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'ruaEndereco',array('size'=>60,'maxlength'=>150)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'numeroEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'numeroEndereco',array('size'=>30)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'complementoEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'complementoEndereco',array('size'=>30)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'cepEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'cepEndereco'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'bairroEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'bairroEndereco'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'cidadeEndereco'); ?>
        <?php echo CHtml::activeTextField($model, 'cidadeEndereco'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model, 'estadoEndereco'); ?>
        <?php echo CHtml::activeDropDownList($model, 'estadoEndereco', CTXEstados::getOptions()); ?>
    </div>
    <div class="action">
        <?php echo CHtml::submitButton('Cadastrar'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#Endereco_cepEndereco').mask('99999-999');
        $('#Endereco_numeroEndereco').numeric();
    });
</script>