<div class="yiiForm">

<p>
Fields with <span class="required">*</span> are required.
</p>

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="simple">
<?php echo CHtml::activeLabelEx($model,'chaveCupom'); ?>
<?php echo CHtml::activeTextField($model,'chaveCupom',array('size'=>45,'maxlength'=>45)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'valorCupom'); ?>
<?php echo CHtml::activeTextField($model,'valorCupom',array('size'=>10,'maxlength'=>10)); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'tipoCupom'); ?>
<?php echo CHtml::activeTextField($model,'tipoCupom'); ?>
</div>
<div class="simple">
<?php echo CHtml::activeLabelEx($model,'restritoCupom'); ?>
<?php echo CHtml::activeTextField($model,'restritoCupom'); ?>
</div>

<div class="action">
<?php echo CHtml::submitButton($update ? 'Save' : 'Create'); ?>
</div>

<!-- ///////////////////////////////////////////////////////////// -->

<?php echo CHtml::hiddenField('Cliente[elemento]', '', array()); ?>

<table style='border: 1px;'>
<tr style='background-color:blue; text-align: center; font-weight: bold;'>
    <td>Seleciona</td>
    <td>Cliente</td>
  </tr>

<?php $i = 0; ?>
<?php foreach($cliente as $cliente): ?>
<tr>
   
    <td style='text-align: center;'>
        <?= CHtml::checkBox("UsuarioForm[seleciona][{$i}]", false, array('value' => $cliente['idCliente'])); ?>
    </td>
  
    <td><?= $usuario['username']; ?></td>
  
    <td><?= CHtml::submitButton('Incluir', array(
        'onClick' => "document.getElementById('Cliente_elemento').value = '{$usuario['idCliente']}'"
    )); ?></td>
</tr>
<?php $i++; ?>
<?php endforeach; ?>
</table>

<?php echo CHtml::endForm(); ?>
</div><!-- yiiForm -->