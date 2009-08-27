<?php
class MenuCategorias extends CWidget {
    public $file = 'menuCategorias';
    public function run() {
        $categorias = CategoriaProduto::model()->findAll(array('order'=>'nomeCategoria','condition'=>'visivelCategoria = 1'));
        $this->render($this->file,array(
                'categorias'=>$categorias
            ));
    }
}