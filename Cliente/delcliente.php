<?php
include "../lib/Conexao.php";

$pdo = Conexao::connect();

$idcliente = $_GET["idcliente"];

$selcli = $pdo->query("SELECT idpedido FROM pedido WHERE idcliente = $idcliente"); 
$varfetch = $selcli->fetchAll(PDO::FETCH_OBJ);

foreach($varfetch as $codigo){

    $delpedido = $pdo->prepare("DELETE FROM pedido_detalhe Where idpedido = :codigo");
    $delpedido->bindParam(':codigo', $codigo->idpedido);
    $delpedido->execute();

}

$delpedido = $pdo->prepare("DELETE FROM pedido Where idcliente = :idcliente");
$delpedido->bindParam(':idcliente', $idcliente);
$delpedido->execute();


$del = $pdo->prepare("DELETE FROM clientes Where idcliente = :idcliente");
$del->bindParam(':idcliente', $idcliente);
$del->execute();

?>

<meta http-equiv="refresh" content="0; url=../Listagem/listagemcliente.php">