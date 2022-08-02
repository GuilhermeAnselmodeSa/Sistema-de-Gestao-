<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();

foreach ($_POST as $indice => $valor) {
    $$indice = $valor;
}

$sql = "UPDATE categorias SET nome=:nome WHERE idcategoria=:idcategoria";
$update = $pdo->prepare($sql);
$update->bindParam(":idcategoria", $idcategoria);
$update->bindParam(":nome", $nome);
$update->execute();

?>

<meta http-equiv="refresh" content="0; url=../Listagem/listagemcategoria.php"> 