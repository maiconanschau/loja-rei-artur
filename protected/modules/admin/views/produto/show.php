<h2>Produto '<?php echo $model->nomeProduto; ?>'</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo produto',array('create')); ?>]
    [<?php echo CHtml::link('Listar produtos',array('admin')); ?>]
</div>

<table class="dataGrid">
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('idCategoria')); ?>
        </th>
        <td><?php echo CHtml::encode($model->categoria->nomeCategoria); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('nomeProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->nomeProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('descricaoCurtaProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->descricaoCurtaProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('descricaoLongaProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->descricaoLongaProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('pesoProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->pesoProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('fabricanteProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->fabricanteProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('precoProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->precoProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('quantMinProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->quantMinProduto); ?>
        </td>
    </tr>
    <tr>
        <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('quantMaxProduto')); ?>
        </th>
        <td><?php echo CHtml::encode($model->quantMaxProduto); ?>
        </td>
    </tr>
</table>
