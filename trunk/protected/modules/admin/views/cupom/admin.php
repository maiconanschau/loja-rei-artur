<h2>Cupons</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo cupom',array('create')); ?>]
    [<?php echo CHtml::link('Listar cupons',array('admin')); ?>]
</div>

<table class="dataGrid">
    <tr>
        <th><?php echo $sort->link('chaveCupom'); ?></th>
        <th><?php echo $sort->link('valorCupom'); ?></th>
        <th><?php echo $sort->link('tipoCupom'); ?></th>
        <th><?php echo $sort->link('restritoCupom'); ?></th>
        <th>Actions</th>
    </tr>
    <?php foreach($models as $n=>$model): ?>
    <tr class="<?php echo $n%2?'even':'odd';?>">
        <td><?php echo CHtml::encode($model->chaveCupom); ?></td>
        <td><?php echo CHtml::encode($model->valorCupom); ?></td>
        <td><?php echo CHtml::encode($model->getTipoTexto()); ?></td>
        <td><?php echo CHtml::encode($model->restritoCupom ? "Sim" : "Não"); ?></td>
        <td>
                <?php echo CHtml::link('Editar',array('update','id'=>$model->idCupom)); ?>
                <?php echo CHtml::linkButton('Apagar',array(
                'submit'=>'',
                'params'=>array('command'=>'delete','id'=>$model->idCupom),
                'confirm'=>"Are you sure to delete #{$model->idCupom}?")); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>