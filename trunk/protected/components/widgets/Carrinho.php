<?php
class Carrinho extends CWidget {
    protected static $produtos = array();

    public static function quantProduto($idProduto,$quant) {
        CTXSession::open();

        if (isset($_SESSION['Carrinho']['produtos'][$idProduto])) {
            $_SESSION['Carrinho']['produtos'][$idProduto]['quant'] = $quant;
        }
    }

    public static function addProduto($produto,$quant) {
        CTXSession::open();
        
        if (isset($_SESSION['Carrinho']['produtos'][$produto->idProduto])) {
            $_SESSION['Carrinho']['produtos'][$produto->idProduto]['quant'] += $quant;
        } else {
            $_SESSION['Carrinho']['produtos'][$produto->idProduto]['produto'] = $produto;
            $_SESSION['Carrinho']['produtos'][$produto->idProduto]['quant'] = 1;
        }
    }

    public static function removeProduto($produto) {
        CTXSession::open();

        if (isset($_SESSION['Carrinho']['produtos'][$produto->idProduto])) {
            unset($_SESSION['Carrinho']['produtos'][$produto->idProduto]);
        }
    }

    public static function setProdutos($produtos) {
        CTXSession::open();

        $_SESSION['Carrinho']['produtos'] = $produtos;
    }

    public static function getProdutos() {
        CTXSession::open();

        return (isset($_SESSION['Carrinho']['produtos']) && is_array($_SESSION['Carrinho']['produtos'])) ? $_SESSION['Carrinho']['produtos'] : array();
    }

    public static function clearProdutos() {
        CTXSession::open();

        unset($_SESSION['Carrinho']['produtos']);
    }

    public function run() {
        CTXSession::open();

        $quantProdutos = isset($_SESSION['Carrinho']['produtos']) ? count($_SESSION['Carrinho']['produtos']) : 0;
        
        if ($quantProdutos > 0) $this->render("carrinho",array('quant'=>$quantProdutos));
    }
}