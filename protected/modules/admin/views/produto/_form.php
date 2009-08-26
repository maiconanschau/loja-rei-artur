<div class="yiiForm">

    <p>
        Fields with <span class="required">*</span> are required.
    </p>

    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($model); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'idCategoria'); ?>
        <?php echo CHtml::activeDropDownList($model, 'idCategoria', $categorias); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'nomeProduto'); ?>
        <?php echo CHtml::activeTextField($model,'nomeProduto',array('size'=>45,'maxlength'=>45)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'descricaoProduto'); ?>
        <?php echo CHtml::activeTextArea($model,'descricaoProduto',array('rows'=>6, 'cols'=>50)); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'pesoProduto'); ?>
        <?php echo CHtml::activeTextField($model,'pesoProduto'); ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabelEx($model,'precoProduto'); ?>
        <?php echo CHtml::activeTextField($model,'precoProduto',array('size'=>10,'maxlength'=>10)); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#Produto_pesoProduto').decimal('.',3);
        $('#Produto_precoProduto').decimal();
    });
</script>