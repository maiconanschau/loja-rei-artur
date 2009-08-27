<h3>Login</h3>
<div class="yiiForm">
    <?php echo CHtml::beginForm(); ?>
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