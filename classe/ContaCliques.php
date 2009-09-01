<?php
include_once("ManipulateData.php");

$contar = new ManipulateData();
$codigo = $_GET["id"];
$contar->setTable("produto");
$contar->setFields("quantidade_clique = quantidade_clique + 1");
$contar->setFieldId("idProduto");
$contar->setValueId("$codigo");

$contar->update();

/*$redirect = new classe_produto();
$url = $redirect->getUrlProduto($codigo);

header("Location: $url");


 sei lah ... pesquisando*/
?>