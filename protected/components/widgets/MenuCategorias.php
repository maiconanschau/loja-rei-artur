<?php
class MenuCategorias extends CWidget {
    public $file = 'menuCategorias';
    public function run() {
        $categorias = CategoriaProduto::model()->findAll(array('order'=>'nomeCategoria'));
        $this->render($this->file,array(
                'categorias'=>$categorias
            ));
    }
}