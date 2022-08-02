<?php
include "../lib/Conexao.php";

session_start();

$pdo = Conexao::connect();
$erros = [];

foreach ($_POST as $indice => $valor) {
    if (!$valor || empty($valor)) {
        $erros[] = "O campo $indice não pode estar vazio!"; 
    }
    $$indice = $valor;
}

if($tipo == "Unitario"){
    $quantidade_fardo = 0;
}
else if($tipo == "Fardo"){ 
    $quantidade_fardo = $_POST["quantidade_fardo"]; 
}
if (isset($erros) && count($erros) > 0) {
    $_SESSION["sucesso"] = false;
    $_SESSION['erros'] = $erros;
} else {
    $sql = $pdo->prepare("INSERT INTO produtos VALUES(:codigo, :marca, :tipo, :preco_custo, :preco_venda, 
    :unidade_medida, :quantidade_fardo, :quantidade_estoque, :fkcategoria)");
        $sql->bindParam(':codigo', $codigo);
        $sql->bindParam(':marca', $marca);
        $sql->bindParam(':tipo', $tipo);
        $sql->bindParam(':preco_custo', $preco_custo);
        $sql->bindParam(':preco_venda', $preco_venda);
        $sql->bindParam(':unidade_medida', $unidade_medida);
        $sql->bindParam(':quantidade_fardo', $quantidade_fardo);
        $sql->bindParam(':quantidade_estoque', $quantidade_estoque);
        $sql->bindParam(':fkcategoria', $fkcategoria);
        $sql->execute();
        $_SESSION["sucesso"] = true;
}
?>

<meta http-equiv="refresh" content="0; url=../Cadastros/cadproduto.php">