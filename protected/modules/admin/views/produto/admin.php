<h2>Produtos</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo produto',array('create')); ?>]
    [<?php echo CHtml::link('Listar produtos',array('admin')); ?>]
</div>

<table class="dataGrid">
    <tr>
        <th><?php echo $sort->link('idProduto'); ?></th>
        <th><?php echo $sort->link('idCategoria'); ?></th>
        <th><?php echo $sort->link('nomeProduto'); ?></th>
        <th><?php echo $sort->link('pesoProduto'); ?></th>
        <th><?php echo $sort->link('precoProduto'); ?></th>
        <th>Actions</th>
    </tr>
    <?php foreach($models as $n=>$model): ?>
    <tr class="<?php echo $n%2?'even':'odd';?>">
        <td><?php echo CHtml::link($model->idProduto,array('show','id'=>$model->idProduto)); ?></td>
        <td><?php echo CHtml::encode($model->idCategoria); ?></td>
        <td><?php echo CHtml::encode($model->nomeProduto); ?></td>
        <td><?php echo CHtml::encode($model->pesoProduto); ?></td>
        <td><?php echo CHtml::encode($model->precoProduto); ?></td>
        <td>
                <?php echo CHtml::link('Fotos',array('fotos','id'=>$model->idProduto)); ?>
                <?php echo CHtml::link('Editar',array('update','id'=>$model->idProduto)); ?>
                <?php echo CHtml::linkButton('Apagar',array(
                'submit'=>'',
                'params'=>array('command'=>'delete','id'=>$model->idProduto),
                'confirm'=>"Gostaria de apagar o produto '{$model->nomeProduto}'?")); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>