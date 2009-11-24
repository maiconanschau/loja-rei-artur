<?php
function __autoload($className) {
    $classFile = realpath(dirname(__FILE__)."/../protected/extensions").DIRECTORY_SEPARATOR;
    $classFile .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
}

// Carrega as configurações de conexão com o banco
$config = require_once('../protected/config/main.php');
$dbOptions = $config['components']['db'];
$dbOptions['host'] = explode(';',str_replace(array(':','='),';',$dbOptions['connectionString']));
$dbOptions['dbname'] = $dbOptions['host'][4];
$dbOptions['host'] = $dbOptions['host'][2];

// Conecta com o Zend Framework
$db = new Zend_Db_Adapter_Pdo_Mysql($dbOptions);

// Pega as vars da URL
$idPedido = isset($_GET['pedido']) ? $_GET['pedido'] : 0;

$select = new Zend_Db_Select($db);

$pedido = $select->from('Pedido')->where('idPedido = ?',$idPedido)->query()->fetchObject();
if (empty($pedido)) {
    echo "<strong>Pedido inválido.</strong>";
    die();
}

$itens = $select->reset()->from(array('pi'=>'PedidoItem'))->joinLeft(array('p'=>'Produto'),'pi.idProduto = p.idProduto')->where('pi.idPedido = ?',$idPedido)->query()->fetchAll();
if (empty($itens)) {
    echo "<strong>Erro ao carregar itens.</strong>";
    die();
}

$totalPedido = $pedido->valorEntrega;

foreach ($itens as $v) {
    $totalPedido += $v['quantidadePedidoItem'] * $v['valorPedidoItem'];
}

if (!empty($pedido->idCupom)) {
    $cupom = $select->reset()->from('Cupom')->where('idCupom = ?',$pedido->idCupom)->query()->fetchObject();

    if (!empty($cupom)) {
        if ($cupom->tipoCupom == 1) {
            $valorCupom = $cupom->valorCupom;
        } elseif ($cupom->tipoCupom == 2) {
            $valorCupom = $totalPedido*($cupom->valorCupom/100);
        }
    }
} else {
    $valorCupom = 0;
}

$totalPedido -= $valorCupom;

$cliente = $select->reset()->from('Cliente')->where('idCliente = ?',$pedido->idCliente)->query()->fetchObject();

if ($cliente->tipoCliente == 1) {
    $clienteFisico = $select->reset()->from('ClienteFisico')->where('idCliente = ?',$pedido->idCliente)->query()->fetchObject();
    $nomeCliente = $clienteFisico->nomeCliente;
} else {
    $clienteFisico = $select->reset()->from('ClienteJuridico')->where('idCliente = ?',$pedido->idCliente)->query()->fetchObject();
    $nomeCliente = $clienteFisico->razaoSocialCliente;
}

require('boleto_real.php');