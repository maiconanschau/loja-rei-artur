<style>
    .field, .noaction, .quant, .valorTotal {
        text-align:     right;
        width:          60px;
        border:         0;
        background:     #FCFCFC;
    }

    .noaction {
        background:     #EEEEDD !important;
    }

    .erro {
        padding:        5px 10px;
        border:         1px solid #FF0000;
        margin:         5px 0px;
        background:     #FFEEEE;
    }

    label {
        width:          150px !important;
    }
</style>

<?php if (!empty($erros)) : ?>
<div class="erro">
        <?php echo implode("<br/>",$erros); ?>
</div>
<?php endif; ?>
<div class="yiiForm">
    <?php echo CHtml::beginForm('','post',array('class'=>'formEntrada','enctype'=>'multipart/form-data')); ?>

    <fieldset class="compra">
        <legend>Compra</legend>

        <div class="simple">
            <?php echo CHtml::radioButtonList('formaEntrada', 1, array(1=>'Entrada manual','Enviar XML'), array('class'=>'formaEntrada','style'=>'margin:2px auto;')); ?>
        </div>
        <br/>

        <div class="manual">
            <div class="simple">
                <?php echo CHtml::label('Produto', 'produto'); ?>
                <?php echo CHtml::dropDownList('produto', null, $produtos); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::label('Valor unitário', 'valorUnitario'); ?>
                <?php echo CHtml::textField('valorUnitario',0,array('class'=>'field valorUnitario')); ?>
            </div>

            <div class="simple">
                <?php echo CHtml::label('Quantidade', 'quantidade'); ?>
                <?php echo CHtml::textField('quantidade',1,array('class'=>'quant')); ?>
            </div>
        </div>

        <div class="xml" style="display:none;">
            <div class="simple">
                <?php echo CHtml::label('Arquivo XML', 'arquivo'); ?>
                <?php echo CHtml::fileField('arquivo'); ?>
            </div>
        </div>
    </fieldset>

    <fieldset class="retornaveis">
        <legend>Impostos retornáveis</legend>
        <div class="simple">
            <?php echo CHtml::label('PIS', 'pis'); ?>
            <?php echo CHtml::textField('pis',$valores['pis'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('CONFINS', 'confins'); ?>
            <?php echo CHtml::textField('confins',$valores['confins'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('ICMS', 'icms'); ?>
            <?php echo CHtml::textField('icms',$valores['icms'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('IPI', 'ipi'); ?>
            <?php echo CHtml::textField('ipi',$valores['ipi'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <label>Total</label>
            <input type="text" value="0.00" readonly class="noaction rem" name="totalRetornaveis"/>%
        </div>
    </fieldset>

    <fieldset class="variaveis">
        <legend>Despesas variáveis</legend>
        <div class="simple">
            <?php echo CHtml::label('Transporte', 'transporte'); ?>
            <?php echo CHtml::textField('transporte',$valores['transporte'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Logística', 'logistica'); ?>
            <?php echo CHtml::textField('logistica',$valores['logistica'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Comissão', 'comissao'); ?>
            <?php echo CHtml::textField('comissao',$valores['comissao'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Des. bancárias', 'bancarias'); ?>
            <?php echo CHtml::textField('bancarias',$valores['bancarias'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Inadimplência', 'inadimplencia'); ?>
            <?php echo CHtml::textField('inadimplencia',$valores['inadimplencia'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Propaganda', 'propaganda'); ?>
            <?php echo CHtml::textField('propaganda',$valores['propaganda'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('RMA', 'rma'); ?>
            <?php echo CHtml::textField('rma',$valores['rma'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <label>Total</label>
            <input type="text" value="0.00" readonly class="noaction add" name="totalVariaveis"/>%
        </div>
    </fieldset>

    <fieldset class="fixas">
        <legend>Despesas fixas e lucro</legend>

        <div class="simple">
            <?php echo CHtml::label('Despesas fixas', 'fixas'); ?>
            <?php echo CHtml::textField('fixas',$valores['fixas'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('Lucro', 'lucro'); ?>
            <?php echo CHtml::textField('lucro',$valores['lucro'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <label>Total</label>
            <input type="text" value="0.00" readonly class="noaction add" name="totalFixas"/>%
        </div>
    </fieldset>

    <fieldset class="impostos">
        <legend>Impostos</legend>

        <div class="simple">
            <?php echo CHtml::label('PIS', 'pis'); ?>
            <?php echo CHtml::textField('pis2',$valores['pis2'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('CONFINS', 'confins'); ?>
            <?php echo CHtml::textField('confins2',$valores['confins2'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('ICMS', 'icms'); ?>
            <?php echo CHtml::textField('icms2',$valores['icms2'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <?php echo CHtml::label('IPI', 'ipi'); ?>
            <?php echo CHtml::textField('ipi2',$valores['ipi2'],array('class'=>'field')); ?>%
        </div>

        <div class="simple">
            <label>Total</label>
            <input type="text" value="0.00" readonly class="noaction add" name="totalImpostos"/>%
        </div>
    </fieldset>

    <fieldset class="valorFinal">
        <legend>Valor unitário de venda</legend>

        <div class="simple">
            <label>Total</label>
            <input type="text" value="R$ 0.00" readonly class="valorTotal" name="valorTotal"/>
        </div>
    </fieldset>

    <div class="action">
        <?php echo CHtml::submitButton('Enviar'); ?>
    </div>

    <?php echo CHtml::endForm(); ?>
</div>
<script type="text/javascript">
    function somaFieldset($this) {
        var $inputs = $this.find('input:not(.noaction)');
        var $total = $this.find('.noaction');

        var total = 0;
        $inputs.each(function(){
            var valor = parseFloat($(this).val());
            total += valor;
        });

        $total.val(total);
        atualizaTotal();
    }

    function atualizaTotal() {
        var $totais = $('.noaction');
        var valor = parseFloat($('.valorUnitario').val());
        var valorTotal = 0;

        $totais.each(function(){
            if ($(this).hasClass('add')) {
                valorTotal += valor * $(this).val()/100;
            } else {
                valorTotal -= valor * $(this).val()/100;
            }
        });

        valorTotal += valor;

        $('.valorTotal').val(valorTotal);
    }

    function mudaFormaEntrada() {
        var $radio = $('.formaEntrada:checked');
        var value = $radio.val();

        $('#valorUnitario').val('0');

        if (value == 1) {
            $('.manual, .valorFinal').show();
            $('.xml').hide();
        } else if (value == 2) {
            $('.manual, .valorFinal').hide();
            $('.xml').show();
        }

        atualizaTotal();
    }

    $(function(){
        $('.field').decimal();
        $('.noaction').prev().css({
            color:'#990000',
            fontWeight:'bold'
        });

        $('.compra input').blur(atualizaTotal);
        $('.retornaveis .field').blur(function(){somaFieldset($(this).parent().parent());});
        $('.variaveis .field').blur(function(){somaFieldset($(this).parent().parent());});
        $('.fixas .field').blur(function(){somaFieldset($(this).parent().parent());});
        $('.impostos .field').blur(function(){somaFieldset($(this).parent().parent());});
        $('.formEntrada').submit(atualizaTotal);

        somaFieldset($('.retornaveis'));
        somaFieldset($('.variaveis'));
        somaFieldset($('.fixas'));
        somaFieldset($('.impostos'));

        $('.formaEntrada').change(mudaFormaEntrada);
    });
</script>