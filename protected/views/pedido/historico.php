<h2>Histórido de pedidos</h2>
<br/>
<table class="dataGrid">
    <tr>
        <th>Pedido</th>
        <th>Cupom</th>
        <th>Data</th>
        <th>Valor</th>
        <th>Ações</th>
    </tr>
    <?php foreach($models as $n=>$model): ?>
        <?php $cupom = !empty($model->idCupom) ? Cupom::model()->findByPk($model->idCupom) : null; ?>
    <tr class="<?php echo $n%2?'even':'odd';?>">
        <td><?php echo CHtml::link($model->idPedido); ?></td>
        <td><?php echo CHtml::encode($cupom ? $cupom->chaveCupom : "-"); ?></td>
        <td><?php echo CHtml::encode(CTXDate::toDate($model->dataPedido)); ?></td>
        <td>
                <?php
                $pedidoItem = PedidoItem::model()->findAllByAttributes(array('idPedido'=>$model->idPedido));
                $total = 0;
                foreach ($pedidoItem as $v) {
                    $total += $pedidoItem->valorPedidoItem * $pedidoItem->quantidadePedidoItem;
                }
                if ($cupom->tipoCupom == Cupom::TIPO_VALOR) {
                    $valorCupom = $cupom->valorCupom;
                } elseif ($cupom->tipoCupom == Cupom::TIPO_PORCENTAGEM) {
                    $valorCupom = $totalPedido*($cupom->valorCupom/100);
                }
                $total -= $valorCupom;
                $total += $model->valorEntrega;
                echo CTXUtil::formatMoney($total);
                ?>
        </td>
        <td>
                <?php echo CHtml::link('Detalhes',array('detalhes','id'=>$model->idPedido)); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br/>
<?php $this->widget('CLinkPager',array('pages'=>$pages)); ?>