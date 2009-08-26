<h3>Login</h3>

<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CTXFeedback::displayAll(); ?>

    <div class="simple">
        <?php echo CHtml::label('Chave', 'chave'); ?>
        <strong><?php echo $num; ?></strong>
    </div>

    <div class="simple">
        <?php echo CHtml::label('Senha', 'senha'); ?>
        <?php echo CHtml::passwordField('senha'); ?>
    </div>

    <div class='action'>
        <?php echo CHtml::submitButton('Login'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div>