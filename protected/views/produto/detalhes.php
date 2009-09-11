<h2><?php echo $produto->nomeProduto; ?></h2>
<br/>
<div class="produto">
    <div class="apresentacao">
        <div class="info">
            <p>Por :</p> R$ <?php echo number_format($produto->precoProduto, 2,',','.'); ?>
        </div>

        <div class="fotos">

            <div class="carousel">
                <ul>
                    <?php foreach ($fotos as $k=>$foto) : ?>
                    <li class="li<?php echo $k+1; ?>">
                        <a href="<?php echo CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$foto->idFotoProduto,'a'=>800,'l'=>'800','f'=>'none')); ?>" class="lightBox">
                            <img src="<?php echo CHtml::normalizeUrl(array('/fotoProduto/exibir','i'=>$foto->idFotoProduto,'a'=>200,'l'=>150,'zoom'=>1)); ?>" alt="Foto de <?php echo $produto->nomeProduto; ?>"/>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="carouselNav">
                <?php for ($x = 0; $x < count($fotos); $x++) : $ids[] = '#'.($id = 'foto'.$x); ?>
                <button id="<?php echo $id; ?>" class="<?php echo $x == 0 ? 'active' : ''; ?>"><?php echo $x+1; ?></button>
                <?php endfor; ?>
            </div>
        </div>

        <div class="descricaoCurta">
            <?php echo $produto->descricaoCurtaProduto; ?>
        </div>
    </div>
    <div class="detalhes">
        <div class="descricaoLonga">
            <?php echo $produto->descricaoLongaProduto; ?>
        </div>
    </div>
    <div class="comentarios">
        <div class="listaComentarios">
            <?php foreach ($comentarios as $v) $this->renderPartial('/comentario/show',array('model'=>$v)); ?>
        </div>
        <?php if (!empty($comentario)) : ?>
        <div class="formComentario">
            <?php echo $comentario; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.carousel').jCarouselLite({
            visible:1,
            circular: false,
            btnNext: ".carouselNext",
            btnPrev: ".carouselPrev",
            btnGo: ["<?php echo implode('","',$ids); ?>"],
            afterEnd: function(el){
                var num = $(el[0]).attr('class').substr(2);
                $('.carouselNav button').removeClass('active');
                $('.carouselNav button:contains('+num+')').addClass('active');
            }
        });
        $('.lightBox').lightBox({
            imageLoading:   '<?php echo Yii::app()->baseUrl; ?>/images/jquery.lightbox/lightbox-ico-loading.gif',
            imageBtnPrev:   '<?php echo Yii::app()->baseUrl; ?>/images/jquery.lightbox/lightbox-btn-prev.gif',
            imageBtnNext:   '<?php echo Yii::app()->baseUrl; ?>/images/jquery.lightbox/lightbox-btn-next.gif',
            imageBtnClose:  '<?php echo Yii::app()->baseUrl; ?>/images/jquery.lightbox/lightbox-btn-close.gif',
            imageBlank:     '<?php echo Yii::app()->baseUrl; ?>/images/jquery.lightbox/lightbox-blank.gif',
            txtImage:       'Imagem',
            txtOf:          'de'
        });
    });
</script>