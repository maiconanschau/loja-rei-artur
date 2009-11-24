<h2>Finalizar pedido</h2>
<br/>
<h3>Dados do pedido</h3>
<table class="pedido" width="100%" cellpadding="0" cellspacing="1">
    <tr>
        <th>Cliente</th>
        <td colspan="3"><?php echo $cliente->chamadoCliente; ?></td>
    </tr>
    <tr>
        <th>Data da compra</th>
        <td><?php echo date("d/m/Y"); ?></td>
        <th>Quantidade produtos</th>
        <td>
            <?php
            $quant = 0;
            foreach ($produtosCarrinho as $v) {
                $quant += $v['quant'];
            }
            echo $quant;
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="4" class="noStyle">
            <table width="100%" class="itens" cellpadding="0" cellspacing="1">
                <tr>
                    <th>Quantidade</th>
                    <th>Produto</th>
                    <th>Valor unitário</th>
                    <th>Valor total</th>
                </tr>
                <?php foreach ($produtosCarrinho as $v) : ?>
                <tr>
                    <td><?php echo $v['quant']; ?></td>
                    <td><?php echo $v['produto']->nomeProduto; ?></td>
                    <td><?php echo CTXUtil::formatMoney($v['produto']->precoProduto); ?></td>
                    <td><?php echo CTXUtil::formatMoney($v['quant'] * $v['produto']->precoProduto); ?></td>
                </tr>
                    <?php endforeach; ?>
                <tr>
                    <th colspan="3" class="alignRight">Valor entrega</th>
                    <td><?php echo CTXUtil::formatMoney(10); ?></td>
                </tr>
                <?php if ($exibeCupom) : ?>
                <tr>
                    <th colspan="3" class="alignRight">Cupom de desconto</th>
                    <td><?php echo CTXUtil::formatMoney($valorCupom); ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th colspan="3" class="alignRight">Total</th>
                    <td><?php echo $exibeCupom ? CTXUtil::formatMoney($totalPedido + 10 - $valorCupom) : CTXUtil::formatMoney($totalPedido + 10); ?></td>
                </tr>
                <tr>
                    <th colspan="2">Forma de pagamento</th>
                    <td colspan="2"><?php echo CHtml::radioButtonList('formaPagamento', $formaPagamento, Pedido::getFormaOptions(),array('class'=>'formaPagamento')); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<div class="yiiForm">
    <p><strong>Caso tenha o código de um cupom de desconto informe no formulário abaixo.</strong></p>
    <br/>
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($cupomForm); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($cupomForm, 'chave'); ?>
        <?php echo CHtml::activeTextField($cupomForm, 'chave'); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton("Verificar cupom"); ?>
    </div>
    <?php CHtml::endForm(); ?>
</div>
<br/>
<div>
    <h3>Endereço de entrega</h3>
    <p>Selecione um dos endereços abaixo ou cadastre um novo endereço.</p>
    <?php echo CHtml::link("Cadastrar um novo endereço", "#", array('id'=>'linkEndereco','style'=>'color:blue;')); ?>
</div>
<br/>
<div class="enderecos">
    <?php foreach ($enderecos as $v) : ?>
    <table class="endereco" width="100%" style="border:1px solid;">
        <tr>
            <td colspan="2" style="text-align:center;">
                <?php echo CHtml::link("Selecionar este endereço", array("/pedido/finalizar",'endereco'=>$v->idEndereco),array('style'=>'color:blue;','confirm'=>"Ao selecionar este endereço o pedido será finalizado.")); ?>
            </td>
        </tr>
        <tr>
            <th width="150px">Rua</th>
            <td><?php echo $v->ruaEndereco; ?></td>
        </tr>
        <tr>
            <th>Número</th>
            <td><?php echo $v->numeroEndereco; ?></td>
        </tr>
        <tr>
            <th>Complemento</th>
            <td><?php echo $v->complementoEndereco; ?></td>
        </tr>
        <tr>
            <th>CEP</th>
            <td><?php echo $v->cepEndereco; ?></td>
        </tr>
        <tr>
            <th>Bairro</th>
            <td><?php echo $v->bairroEndereco; ?></td>
        </tr>
        <tr>
            <th>Cidade</th>
            <td><?php echo $v->cidadeEndereco; ?></td>
        </tr>
        <tr>
            <th>Estado</th>
            <td><?php echo CTXEstados::getTexto($v->estadoEndereco); ?></td>
        </tr>
    </table>
    <br/>
    <?php endforeach; ?>
</div>
<br/>
<div class="yiiForm novoEndereco">
    <?php echo CHtml::beginForm(); ?>

    <?php echo CHtml::errorSummary($modelEndereco); ?>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'ruaEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'ruaEndereco',array('size'=>60,'maxlength'=>150)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'numeroEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'numeroEndereco',array('size'=>30)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'complementoEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'complementoEndereco',array('size'=>30)); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'cepEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'cepEndereco'); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'bairroEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'bairroEndereco'); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'cidadeEndereco'); ?>
        <?php echo CHtml::activeTextField($modelEndereco, 'cidadeEndereco'); ?>
    </div>

    <div class="simple">
        <?php echo CHtml::activeLabelEx($modelEndereco, 'estadoEndereco'); ?>
        <?php echo CHtml::activeDropDownList($modelEndereco, 'estadoEndereco', CTXEstados::getOptions()); ?>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton("Adicionar",array('confirm'=>"Ao selecionar este endereço o pedido será finalizado.")); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#CupomForm_chave').change(function(){
            var chave = $(this).val();
            chave = chave.toUpperCase();

            var er = new RegExp("[^0-9A-Z]",'gi');
            while (er.test(chave)) chave = chave.replace(er,"");

            $(this).val(chave);
        });
        $('#Endereco_cepEndereco').mask('99999-999');
        $('#Endereco_numeroEndereco').numeric();
        if ($('.errorSummary:visible').length) {
            $('.enderecos').hide();
        } else {
            $('.novoEndereco').hide();
            $('.novoEndereco :input').attr('disabled',true);
        }

        var textoLinkAdd = $('#linkEndereco').html();
        var textoLinkSel = "Selecionar um endereço já cadastrado";

        $('#linkEndereco').click(function(e){
            e.preventDefault();
            if ($('.novoEndereco:visible').length) {
                $('.enderecos').show();
                $('.novoEndereco').hide();
                $(this).html(textoLinkAdd);
                $('.novoEndereco :input').attr('disabled',true);
            } else {
                $('.enderecos').hide();
                $('.novoEndereco').show();
                $(this).html(textoLinkSel);
                $('.novoEndereco :input').attr('disabled',false);
            }
        });

        $('.formaPagamento').click(function(e){
            document.location = document.location + "?fp="+$(this).val();
        });
    });
</script>