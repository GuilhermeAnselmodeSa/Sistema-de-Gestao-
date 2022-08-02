<?php 
    include_once '../lib/Conexao.php';
    $pdo = Conexao::connect();
    foreach($_POST as $indice => $valor) {
        $$indice = $valor;
    }
    if (isset($_GET['codproduto'])) {
        $codigo = $_GET['codproduto'];
    }
    if (isset($_GET['idpedido'])) {
        $codpedido = $_GET['idpedido'];
    }
    if (isset($_GET['quantidade_vendida'])) {
        $quantidade_vendida = $_GET['quantidade_vendida'];
    }
    $delete = $pdo->prepare("CALL excluir_carrinho($codpedido, $codigo, $quantidade_vendida)");
    $delete->execute();

    header('Location: listar.php?idcliente='.$idcli);
?>