<?php 
    session_start();
    include_once '../lib/Conexao.php';
    $pdo = Conexao::connect();
    foreach($_POST as $indice => $valor) {
        $$indice = $valor;
    }
    if (isset($codigo)) {
        $qtdd = $pdo -> query("SELECT quantidade_estoque FROM produtos WHERE codigo = $codigo");
        $qtdfetch = $qtdd -> fetch();
    
        if ($qtdfetch["quantidade_estoque"] >= $quantidade_vendida && $quantidade_vendida > 0) {
            if (isset($_GET["idcliente"])) {
                $idcli = $_GET["idcliente"];
                $select = $pdo->query("SELECT idpedido FROM pedido ORDER BY dataped DESC limit 1");
                $dados = $select->fetch();
                $codpedido = $dados['idpedido'];
                $insert = $pdo->prepare("CALL carrinho($codpedido, $codigo, $quantidade_vendida)");
                $insert->execute();
            }
        } else {
            $_SESSION["falha"] = true;
            // echo "Erro ao inserir";
        }
    }
        header("location: ../Caixa/caixa.php?idcliente=".$idcli."&idpedido=".$codpedido);
?>