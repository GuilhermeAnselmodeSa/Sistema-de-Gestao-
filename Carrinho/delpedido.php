<?php
include "../lib/Conexao.php";

$pdo = Conexao::connect();

$idpedido = $_GET["idpedido"];

$delpedido = $pdo->prepare("DELETE FROM pedido_detalhe Where idpedido = :idpedido");
$delpedido->bindParam(':idpedido', $idpedido);
$delpedido->execute();

$delpedido = $pdo->prepare("DELETE FROM pedido Where idpedido = :idpedido");
$delpedido->bindParam(':idpedido', $idpedido);
$delpedido->execute();

?>

<meta http-equiv="refresh" content="0; url=../Listagem/listagempedidos.php">