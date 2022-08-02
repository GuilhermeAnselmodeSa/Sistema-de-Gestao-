<?php
session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/tel_cliente.css" rel="stylesheet">

    <script src="../bootstrap/js/bootstrap.js"></script>
    <script src="../js/jquery-3.6.0.min.js"></script>
    <script src="../js/jquery.mask.js"></script>
</head>

<body>

    <!-- NAVBAR -->
    <?php include "menu.php" ?>

    <section>
        <!-- MEIO -->
        <div class="container">
            <div class="row">
                <div id="conteudo">

                    <div id="liveAlertPlaceholder">
                    </div>

                    <h3>Cadastro dos Clientes</h3>
                    <p>

                        <!-- Formulario -->
                    <form action="../Cliente/func_cadcliente.php" method="POST" id="formulario">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="nome"><label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="nome" required>
                                </div>
                            </div>
                            <p>
                            <div class="col-6">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" required>
                            </div>
                            <div class="col-md-6">
                                <label for="text" class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="telefone" required placeholder="Com o DDD" required>
                            </div>
                            <p>

                            <div class="col-12">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" class="form-control" name="rua" id="rua" required>
                            </div>
                            <p>

                            <div class="col-8">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" name="bairro" id="bairro" required>
                            </div>


                            <div class="col-4">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" name="numero" id="numero" required>
                            </div>
                            <p>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success" id="liveAlertBtn">Cadastrar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

<!-- Alert  -->
<script src="../js/alert.js"></script>

<script>
    <?php
    if (isset($_SESSION["sucesso"])) {
        if ($_SESSION["sucesso"]) {
    ?>
            alerta('Cliente cadastrado com sucesso!', 'success');
            setTimeout(() => {
                $(".alert").hide("slow")
            }, 2000);
            <?php
        } else {
            if (isset($_SESSION['erros']) && count($_SESSION['erros'])) {
                $exibir = join('<br>', $_SESSION['erros']);
            ?>
                alerta('<?= $exibir ?>', 'danger');
            <?php } else { ?>
                alerta('Erro ao cadastrar!', 'danger');
            <?php } ?>
            setTimeout(() => {
                $(".alert").hide("slow")
            }, 2000);
    <?php
        }
        unset($_SESSION["sucesso"], $_SESSION['erros']);
    }

    ?>
</script>

<script type="text/javascript">
        $(document).ready(function() {
            $("#telefone").mask("(00) 00000-0000");
            $('#cpf').mask('000.000.000-00');
        });
    </script>  

</html>