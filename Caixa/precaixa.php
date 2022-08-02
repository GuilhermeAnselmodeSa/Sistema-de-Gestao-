<?php
include_once "../lib/Conexao.php";
$pdo = Conexao::connect();
$sql = "SELECT idcliente, nome FROM clientes";
$comando = $pdo->prepare($sql);
$comando->execute();
$todos = $comando->fetchAll(PDO::FETCH_ASSOC);

function inspedido()
{
  if (isset($_GET["idcliente"])) {
    $idcli = $_GET["idcliente"];
    $pdo = Conexao::connect();
    $sql = ("INSERT INTO pedido (idpedido, dataped, valor, idcliente) VALUES (0, now(), 0.0, :idcliente)");
    $comando = $pdo->prepare($sql);
    $comando->bindParam(':idcliente', $idcli);
    $comando->execute();
    header('location:caixa.php?idcliente=' . $idcli);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Pré Caixa</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/precaixa.css">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="../js/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
  <script src="../js/chosen.jquery.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
</head>

<body>

  <!-- NAVBAR -->
  <?php include "menu.php" ?>

  <!-- MEIO -->
  <section>
    <div class="container">
      <div id="conteudo">
        <div class="textos">
          <h2 class="text-center">Começar uma Compra</h2>
          <h5 for="idcliente" class="text-center">Nome que será utilizado para efeturar a compra: </h5>
        </div>
        <br>

        <!-- Formulario -->
        <form action="<?php inspedido(); ?>" method="GET">


          <div class="offset-3">


            <select class="chosen-select" data-placeholder="Balcão" name="idcliente" id="idcliente">
              <option selected value=""> </option>
              <option selected value="11"> </option>
              <?php
              foreach ($todos as $cli) {
                echo '<option value="' . $cli["idcliente"] . '">' . $cli["nome"] . '</option>';
              }
              ?>
            </select>
          </div>


          <p>
          <div class="col-12 text-center" id="opcoes">
            <button type="submit" class="btn btn-success btc" id="liveAlertBtn">Iniciar</button>
            <a href="index.php" class="btn btn-secondary btv "><i class="fas fa-arrow-circle-left"></i> Voltar</a>
          </div>

        </form>

      </div>
    </div>
  </section>

  <script>
    jQuery('.chosen-select').chosen({
      allow_single_deselect: true
    });
  </script>

</body>

</html>