<?php
class BuscaMenu extends CWidget {
    public function run() {
        CTXSession::open();

        if (isset($_SESSION['Produto']['busca']['termos'])) {
            $termos = $_SESSION['Produto']['busca']['termos'];
        } else {
            $termos = array();
        }

        foreach ($termos as $k=>$v) {
            if (empty($v)) unset($termos[$k]);
        }

        if (Yii::app()->user->id == 'admin') {
            return;
        }

        $modelCategorias = CategoriaProduto::model()->findAll(array('condition'=>'visivelCategoria = 1','order'=>'nomeCategoria'));
        $categorias = array('Toda a loja');
        foreach ($modelCategorias as $k=>$v) {
            $categorias[$v->idCategoria] = $v->nomeCategoria;
        }

        $this->render('buscaMenu',array('model'=>$model,'categorias'=>$categorias,'termos'=>$termos));
    }
}