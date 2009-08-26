<?php
class FotoProdutoController extends CController {
    public function actionExibir() {
        $id = CTXRequest::getParam('i');
        $altura = CTXRequest::getParam('a',100);
        $largura = CTXRequest::getParam('l',100);
        $forcar = CTXRequest::getParam('f','frame');

        Yii::import('admin.models.FotoProduto');
        $foto = FotoProduto::model()->findByPk($id);
        if (empty($foto)) die();

        $img = new CTXImage();
        $img->loadImage(Yii::app()->params->imagePath."/".$foto->arquivoFotoProduto);
        $img->resize(array('width'=>$largura,'height'=>$altura,'force'=>$forcar));
        $img->display();
    }
}