<?php
class FotoProdutoController extends CController {
    public function actionExibir() {
    	Yii::import('application.models.FotoProduto');
    	
        $id = CTXRequest::getParam('i');
        $altura = CTXRequest::getParam('a',100);
        $largura = CTXRequest::getParam('l',100);
        $forcar = CTXRequest::getParam('f','frame');
        $zoom = CTXRequest::getParam('zoom',0);

        $foto = FotoProduto::model()->findByPk($id);
        if (empty($foto)) die();

        $img = new CTXImage();
        $img->loadImage(Yii::app()->params->imagePath."/".$foto->arquivoFotoProduto);
        $img->resize(array('width'=>$largura,'height'=>$altura,'force'=>$forcar));

        if ($zoom) {
            $zoom = new CTXImage();
            if ($zoom->loadImage(Yii::app()->params['basePath']."/images/icons/zoom.png")) {
                $img->join($zoom, 'R', 'B');
            }
        }

        $img->display();
    }
}