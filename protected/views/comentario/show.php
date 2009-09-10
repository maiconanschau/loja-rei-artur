<?php Yii::import('application.extensions.TXGruppi.Util.CTXDate'); ?>
<div class="comentario">
    <?php echo nl2br($model->conteudoComentario); ?>
    <div class="data">
        <?php echo CTXDate::toDate($model->dataComentario); ?> - por <?php echo $model->cliente->tipoCliente == Cliente::TIPO_FISICO ? $model->cliente->clienteFisico->nomeCliente : $model->cliente->clienteJuridico->razaoSocialCliente; ?>
    </div>
</div>