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

if (isset($erros) && count($erros) > 0) {
    $_SESSION["sucesso"] = false;
    $_SESSION['erros'] = $erros;
} else {
    $sql = $pdo->prepare("INSERT INTO categorias VALUES(0,:nome)"); 
    $sql->bindParam(':nome', $nome);
    $sql->execute();
    $_SESSION["sucesso"] = true;
}
?>

<meta http-equiv="refresh" content="0; url=../Cadastros/cadcategoria.php">