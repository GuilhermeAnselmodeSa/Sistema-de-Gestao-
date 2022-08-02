<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();


foreach ($_POST as $indice => $valor) {
    $$indice = $valor;
}

$sql = "UPDATE produtos SET codigo=:codigo, marca=:marca, tipo=:tipo, preco_custo=:preco_custo,
preco_venda=:preco_venda, unidade_medida=:unidade_medida, quantidade_fardo=:quantidade_fardo, quantidade_estoque=:quantidade_estoque, fkcategoria=:fkcategoria WHERE codigo=:codigo";
$update = $pdo->prepare($sql);
$update->bindParam(":codigo", $codigo);
$update->bindParam(":codigo", $codigo);
$update->bindParam(":marca", $marca);
$update->bindParam(":tipo", $tipo);
$update->bindParam(":preco_custo", $preco_custo);
$update->bindParam(":preco_venda", $preco_venda);
$update->bindParam(":unidade_medida", $unidade_medida);
$update->bindParam(":quantidade_fardo", $quantidade_fardo);
$update->bindParam(":quantidade_estoque", $quantidade_estoque);
$update->bindParam(":fkcategoria", $fkcategoria);
$update->execute();
?>


<meta http-equiv="refresh" content="0; url=../Listagem/listagemproduto.php">