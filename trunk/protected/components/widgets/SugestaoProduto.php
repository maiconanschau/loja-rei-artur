<?php
class SugestaoProduto extends CWidget {
    public function run() {
        $produtos = Produto::model()->findAll(array('order'=>'cliquesProduto DESC','limit'=>'10'));
        shuffle($produtos);
        $produto = array_shift($produtos);
        $fotos = $produto->fotos;
        $foto = array_shift($fotos);

        $this->render('sugestaoProduto',array('produto'=>$produto,'foto'=>$foto));
    }
}