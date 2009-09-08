<?php
class BuscaMenu extends CWidget {
    public function run() {
        if (Yii::app()->user->id == 'admin') {
            return;
        }

        $modelCategorias = CategoriaProduto::model()->findAll(array('condition'=>'visivelCategoria = 1','order'=>'nomeCategoria'));
        $categorias = array('Toda a loja');
        foreach ($modelCategorias as $k=>$v) {
            $categorias[$v->idCategoria] = $v->nomeCategoria;
        }

        $this->render('buscaMenu',array('model'=>$model,'categorias'=>$categorias));
    }
}