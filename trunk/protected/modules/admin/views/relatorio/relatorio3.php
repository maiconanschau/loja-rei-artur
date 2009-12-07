<?php
echo CHtml::link('Próximo ano', array('relatorio3','ano'=>$ano+1),array('style'=>'float:right;'));
echo CHtml::link('Ano anterior', array('relatorio3','ano'=>$ano-1));
if (isset($semRs)) {
    echo "<br/><br/><h3 style='text-align:center;'>Sem vendas no ano de $ano</h3>";
} else {
    echo $table;
}