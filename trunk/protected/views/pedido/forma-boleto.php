<p><strong>Você selecionou a forma de pagamento Boleto Bancário</strong></p>
<p>
    Para gerar seu boleto acesse o endereço:
    <a href="http://<?php echo $_SERVER['HTTP_HOST'].Yii::app()->baseUrl."/boleto/?pedido=".$pedido->idPedido; ?>">http://<?php echo $_SERVER['HTTP_HOST'].Yii::app()->baseUrl."/boleto/?pedido=".$pedido->idPedido; ?></a>
</p>