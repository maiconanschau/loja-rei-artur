<h2>Finalizar pedido</h2>
<br/>
<p>
    Para finalizar seu pedido é necessário que você esteja logado.
    <br/>
    Efetue seu login no formulário abaixo ou clique <?php echo CHtml::link("aqui", array('/cliente/cadastro'),array('style'=>'color:#0000FF;')); ?> para se cadastrar.
</p>
<br/>
<div class="yiiForm">
    <?php echo CHtml::beginForm(array('cliente/login')); ?>
    <?php echo CHtml::errorSummary($model); ?>
    <div class="simple">
        <?php echo CHtml::activeLabel($model,'email'); ?>
        <?php echo CHtml::activeTextField($model,'email') ?>
    </div>
    <div class="simple">
        <?php echo CHtml::activeLabel($model,'senha'); ?>
        <?php echo CHtml::activePasswordField($model,'senha') ?>
    </div>
    <div class="action">
        <?php echo CHtml::submitButton('Login'); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>