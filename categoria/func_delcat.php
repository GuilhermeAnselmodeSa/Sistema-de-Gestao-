<?php
include "../lib/Conexao.php";

$pdo = Conexao::connect();

$idcategoria = $_GET["idcategoria"];

$del = $pdo->prepare("DELETE FROM categorias Where idcategoria = :idcategoria");
$del->bindParam(':idcategoria', $idcategoria);
$del->execute();
?>

<meta http-equiv="refresh" content="0; url=../Listagem/listagemcategoria.php">