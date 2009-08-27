<h2>Fotos do produto '<?php echo $model->nomeProduto; ?>'</h2>

<div class="actionBar">
    [<?php echo CHtml::link('Novo produto',array('create')); ?>]
    [<?php echo CHtml::link('Listar produtos',array('admin')); ?>]
</div>

<div class="yiiForm">
    <?php echo CHtml::beginForm(CHtml::normalizeUrl(array('ajax/novaFotoProduto','produto'=>$model->idProduto)),'post',array('id'=>'formFotos','enctype'=>'multipart/form-data')); ?>
    <div class="action">
        <div>
            <?php echo CHtml::fileField('foto[]'); ?>
        </div>
    </div>

    <div class="action">
        <?php echo CHtml::submitButton("Enviar fotos"); ?>
    </div>
    <?php echo CHtml::endForm(); ?>
</div>
<br/>
<?php echo $table; ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#formFotos').TXUpload();
        $('#formFotos').find('input[type^=file]').change(addFileField);
        function addFileField(e) {
            var inputs = 0;
            var $input = $(this);
            $('input[type^=file]').each(function(){
                if (this.value == '') inputs++;
                if ($(this).val() == $input.val() && this !== $input.get(0)) {
                    e.preventDefault();
                    $input.val('');
                    alert("Arquivo já seleconado.");
                    return;
                }
            });
            if (inputs <= 0) {
                var $div = $("<div>"+$(e.target).parent().html()+"</div>");
                $input.parent().parent().append($div);
                $div.find('input').change(addFileField);
            }
        }

        $('.visivelFoto').removeClass('visivelFoto').click(function(e){
            e.preventDefault();
            var $link = $(this);
            var url = $link.attr('href').substr(1);
            var src = $link.find('img').attr('src').replace(/[^/]+$/,"");
            $link.parent().block({
                message:null
            });

            var request = $.manageAjax.create('ajax',{
                complete:function(){
                    $link.parent().parent().unblock();
                },
                success: function(r){
                    if (r == 1) {
                        var img = $link.find('img[src$=gray.png]').length ? 'eye.png' : 'eye_gray.png';
                        src += img;
                        $link.find('img').attr('src',src);
                    }
                }
            });
            request.add({
                url:url
            });
        });

        $('.apagaFoto').removeClass('apagaFoto').click(function(e){
            e.preventDefault();

            if (!confirm("Deseja apagar esta foto?")) return;

            var $link = $(this);
            var url = $link.attr('href').substr(1);
            var src = $link.find('img').attr('src').replace(/[^/]+$/,"");
            var srcLoader = src.replace(/[^\/]+\/$/,"");
            $link.parent().parent().block({
                message:"<img src='"+srcLoader+"loader02.gif'/>",
                css: {
                    background:'transparent',
                    border:0
                }
            });

            var request = $.manageAjax.create('ajax',{
                complete:function(){
                    $link.parent().parent().unblock();
                },
                success: function(r){
                    if (r == 1) {
                        $link.parent().parent().remove();
                    }
                }
            });
            request.add({
                url:url
            });
        });
    });
</script>