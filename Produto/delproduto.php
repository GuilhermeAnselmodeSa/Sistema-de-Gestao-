<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();

$codigo = (int)$_GET["codigo"];

$delpedido = $pdo->prepare("DELETE FROM pedido_detalhe Where codproduto = :codigo");
$delpedido->bindParam(':codigo', $codigo);
$delpedido->execute();

$del = $pdo->prepare("DELETE FROM produtos Where codigo = :codigo");
$del->bindParam(':codigo', $codigo);
$del->execute();

?>

<meta http-equiv="refresh" content="0; url=../Listagem/listagemproduto.php">