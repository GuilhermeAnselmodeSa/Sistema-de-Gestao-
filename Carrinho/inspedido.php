<?php
function inspedido()
{
include_once "../lib/Conexao.php";
$idcli = $_POST["idcliente"];
$pdo = Conexao::connect();
$sql = ("INSERT INTO pedido (idpedido, dataped, valor, idcliente) VALUES (0, now(), 0.0, :idcliente)");
$comando = $pdo->prepare($sql);
$comando->bindParam(':idcliente', $idcli);
$comando->execute();
}

?>