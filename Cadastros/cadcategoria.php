<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cadastro de Categoria</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/categoria.css">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
</head>

<body>

  <!-- NAVBAR -->
  <?php include "menu.php" ?>

  <!-- MEIO -->
  <section>
    <div class="container">
      <div id="conteudo">
        <div id="liveAlertPlaceholder">
        </div>
        <h2 class="text-center">Cadastro de Categoria</h2>
        <br>

        <!-- Formulario -->
        <form action="../Categoria/func_cadcat.php" method="POST">
          <div class="row ">
            <div class="col-8 offset-2">
              <label for="nome" class="form-label">Nome</label>
              <input type="text" class="form-control" name="nome" id="nome" required>
              <br>
            </div>

            <div class="col-12 text-center" >
              <button type="submit" class="btn btn-success btc" id="liveAlertBtn">Cadastrar</button>
              <a href="cadproduto.php" class="btn btn-secondary btv "><i class="fas fa-arrow-circle-left"></i> Cadastro de Produtos</a>
            </div>
          </div>
        </form>
      </div>
    </div>

  </section>

  <!-- Alert -->
  <script src="../js/alert.js"></script>

  <script>
    <?php
    if (isset($_SESSION["sucesso"])) {
      if ($_SESSION["sucesso"]) {
    ?>
        alerta('Categoria cadastrada com sucesso!', 'success');
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

  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>

</body>

</html>