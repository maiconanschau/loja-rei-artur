<?php
class AjaxController extends CController {
    public function actionApagaFotoProduto() {
        $idFoto = CTXRequest::getParam('id');
        $foto = FotoProduto::model()->findByPk($idFoto);
        if (empty($foto)) {
            echo 0;
            return;
        }

        if ($foto->delete()) {
            @unlink(Yii::app()->params->imagePath."/".$foto->arquivoFotoProduto);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function actionVisivelFotoProduto() {
        $idFoto = CTXRequest::getParam('id');
        $foto = FotoProduto::model()->findByPk($idFoto);
        if (empty($foto)) {
            echo 0;
            return;
        }

        $foto->visivelFotoProduto = $foto->visivelFotoProduto == 1 ? 0 : 1;
        
        if ($foto->save()) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function actionNovaFotoProduto() {
        $idProduto = CTXRequest::getParam('produto');
        $produto = Produto::model()->findByPk($idProduto);
        if (empty($produto)) {
            echo "Produto inválido.";
            return;
        }

        $files = CTXImage::getPost('foto');

        foreach ($files as $f) {
            $i = new CTXImage(Yii::app()->params['imagePath']);
            if ($i->loadImage($f['tmp_name'])) {
                $i->resize(array('width'=>800,'height'=>800));
                $s = $i->save();
                if (empty($s)) {
                    echo "Não foi possível salvar o arquivo '{$f['name']}'";
                    continue;
                }

                $m = new FotoProduto();
                $m->attributes = array('idProduto'=>$idProduto,'arquivoFotoProduto'=>$s,'visivelFotoProduto'=>1);
                if ($m->save()) {
                    echo "Arquivo '{$f['name']}' enviado.";
                    return;
                } else {
                    @unlink($s);
                    echo "Erro ao salvar arquivo '{$f['name']}' no banco de dados.";
                    return;
                }
            } else {
                echo "Erro ao carregar imagem.";
                return;
            }
        }
    }
}