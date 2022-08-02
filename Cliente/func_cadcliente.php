<?php
include "../lib/Conexao.php";
include_once 'func_verificar-cpf.php';

session_start();

$pdo = Conexao::connect();
$erros = [];

foreach ($_POST as $indice => $valor) {
    if (!$valor || empty($valor)) {
        $erros[] = "O campo $indice não pode estar vazio!";
    }

    if ($indice == 'cpf' && !validarCPF($valor)) {
        $erros[] = 'O CPF fornecido é inválido!';
    }

    $$indice = $valor;
}

if (isset($erros) && count($erros) > 0) {
    $_SESSION["sucesso"] = false;
    $_SESSION['erros'] = $erros;
} else {
    $sql = $pdo->prepare("INSERT INTO clientes VALUES(0,:nome,:cpf, :telefone, :bairro, :rua, :numero)"); //prepared statements
    $sql->bindParam(':nome', $nome);
    $sql->bindParam(':cpf', $cpf);
    $sql->bindParam(':telefone', $telefone);
    $sql->bindParam(':bairro', $bairro);
    $sql->bindParam(':rua', $rua);
    $sql->bindParam(':numero', $numero);
    $sql->execute();
    $_SESSION["sucesso"] = true;
}
?>

<meta http-equiv="refresh" content="0; url=../Cadastros/cadcliente.php">