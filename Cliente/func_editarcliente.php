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

    $sql = "UPDATE clientes SET nome=:nome, cpf=:cpf, telefone=:telefone, bairro=:bairro,
rua=:rua, numero=:numero WHERE idcliente=:idcliente";
    $update = $pdo->prepare($sql);
    $update->bindParam(":idcliente", $idcliente);
    $update->bindParam(":nome", $nome);
    $update->bindParam(":cpf", $cpf);
    $update->bindParam(":telefone", $telefone);
    $update->bindParam(":bairro", $bairro);
    $update->bindParam(":rua", $rua);
    $update->bindParam(":numero", $numero);
    $update->execute();
    $_SESSION["sucesso"] = true;
}
?>

<meta http-equiv="refresh" content="0; url=pag_editar.php?idcliente=<?php echo $idcliente?>">
