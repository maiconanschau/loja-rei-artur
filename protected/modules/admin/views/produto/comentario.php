<h2>Comentários</h2>

<div class="listaComentarios">
    <?php if (!count($comentarios)) : ?>
    <div class="comentario">Nenhum comentário pendente.</div>
    <?php endif; ?>
    <?php foreach ($comentarios as $v) : ?>
    <div class="comentario">
            <?php echo nl2br($v->conteudoComentario); ?>
        <div class="data">
                <?php echo CTXDate::toDate($v->dataComentario); ?> - por <?php echo CHtml::encode($v->cliente->tipoCliente == Cliente::TIPO_FISICO ? $v->cliente->clienteFisico->nomeCliente : $v->cliente->clienteJuridico->razaoSocialCliente); ?>
        </div>
        <div class="acoes">
                <?php echo CHtml::link('Aprovar', array('aprovarComentario','id'=>$v->idComentario), array('confirm'=>'Deseja aprovar este comentário?')); ?>
                <?php echo CHtml::link('Deletar', array('deletarComentario','id'=>$v->idComentario), array('confirm'=>'Deseja deletar este comentário?')); ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>