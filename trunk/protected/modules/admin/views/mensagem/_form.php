<style>
.cCategorias label, .cProdutos label {
	width:		300px !important;
}
</style>
<div class="yiiForm">

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($form); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'assunto'); ?>
        <?php echo CHtml::activeTextField($form, 'assunto'); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'conteudo'); ?>
        <?php echo CHtml::activeTextArea($form, 'conteudo',array('cols'=>60)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($form, 'desconto'); ?>
        <?php echo CHtml::activeCheckBox($form, 'desconto'); ?>
    </div>

    <div class="containerCupom">
        <fieldset>
            <legend>Desconto</legend>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'valor'); ?>
                <?php echo CHtml::activeTextField($form, 'valor'); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Clientes</legend>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'idadeMin'); ?>
                <?php echo CHtml::activeTextField($form, 'idadeMin'); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'idadeMax'); ?>
                <?php echo CHtml::activeTextField($form, 'idadeMax'); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'rendaMin'); ?>
                <?php echo CHtml::activeTextField($form, 'rendaMin'); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'rendaMax'); ?>
                <?php echo CHtml::activeTextField($form, 'rendaMax'); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'sexo'); ?>
                <?php echo CHtml::activeDropDownList($form, 'sexo', array(''=>'Selecione...','m'=>'Masculino','f'=>'Feminino')); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Categorias</legend>

            <div class="simple cCategorias">
                <?php echo CHtml::activeCheckBoxList($form, 'categorias', $categorias, array('style'=>'margin-bottom:7px;')); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Produtos</legend>

            <div class="simple cProdutos">
                <?php echo CHtml::activeCheckBoxList($form, 'produtos', $produtos, array('style'=>'margin-bottom:7px;')); ?>
            </div>
        </fieldset>

        <fieldset>
            <legend>Compra</legend>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'valorMin'); ?>
                <?php echo CHtml::activeTextField($form, 'valorMin'); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::activeLabelEx($form, 'valorMax'); ?>
                <?php echo CHtml::activeTextField($form, 'valorMax'); ?>
            </div>
        </fieldset>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Salvar' : 'Adicionar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<script type="text/javascript">
    $(function(){
        $('#MensagemForm_conteudoMensagem').wysiwyg();
        $('#MensagemForm_desconto').click(verificaDesconto);
        $('.containerCupom').hide();
        function verificaDesconto() {
            var show = $('#MensagemForm_desconto').attr('checked');
            if (show) {
                $('.containerCupom').show();
            } else {
                $('.containerCupom').hide();
            }
        }
        verificaDesconto();
    });
</script>