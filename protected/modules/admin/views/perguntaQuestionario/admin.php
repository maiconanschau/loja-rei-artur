<h2>Perguntas</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Nova pergunta',array('create')); ?>]
    [<?php echo CHtml::link('Listar perguntas',array('admin')); ?>]
</div>

<table class="dataGrid">
    <tr>
        <th><?php echo $sort->link('idPergunta'); ?></th>
        <th><?php echo $sort->link('textoPergunta'); ?></th>
        <th><?php echo $sort->link('tipoPergunta'); ?></th>
        <th><?php echo $sort->link('ativoPergunta'); ?></th>
        <th>Ações</th>
    </tr>
    <?php foreach($models as $n=>$model): ?>
    <tr class="<?php echo $n%2?'even':'odd';?>">
        <td><?php echo CHtml::encode($model->idPergunta); ?></td>
        <td><?php echo CHtml::encode($model->textoPergunta); ?></td>
        <td><?php echo CHtml::encode($model->getTipoText()); ?></td>
        <td><?php echo CHtml::encode($model->ativoPergunta ? "Sim" : "Não"); ?></td>
        <td>
                <?php echo CHtml::linkButton('Apagar',array(
                'submit'=>'',
                'params'=>array('command'=>'delete','id'=>$model->idPergunta),
                'confirm'=>"Gostaria de apagar a pergunta '{$model->textoPergunta}'?")); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<?php //$this->widget('CLinkPager',array('pages'=>$pages)); ?>