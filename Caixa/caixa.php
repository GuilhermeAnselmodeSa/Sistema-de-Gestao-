<?php
include_once "../lib/Conexao.php";

session_start();

$pdo = Conexao::connect();
if (isset($_GET["idcliente"])) {
  $idcli = $_GET["idcliente"];
}

if (isset($_GET["idpedido"])) {
  $codpedido = $_GET["idpedido"];
  $sql = $pdo->query("SELECT * FROM pedido_detalhe as ped INNER JOIN produtos as prod on prod.codigo = ped.codproduto WHERE idpedido = '$codpedido'");
  $pedido_detalhe = $sql->fetchAll(PDO::FETCH_OBJ);

  $sel = ("SELECT valor FROM pedido where idpedido = '$codpedido'");
  $comando = $pdo->prepare($sel);
} else {
  $codpedido = 0;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Adega</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/comandos.js"></script>
  <link rel="stylesheet" href="../css/caixa.css">
  <title>Caixa</title>
</head>

<body>


  <!-- NAVBAR -->
  <?php include "menu.php" ?>


  <!-- MEIO -->
  <div class="container">
    <div class="row">
      <div id="conteudo" style="margin-top: 50px;">
        <div class="alertContainer" style="align-items: center;">
            <div id="liveAlertPlaceholder">
        </div>
        <div class="row">
          </div>
          <form action="../Carrinho/listar.php?idcliente=<?php echo $idcli; ?>" method="POST" id="form">

            <div class="row g-3">
              <div class="col-md-4">
                <label for="codigo" class="form-label">Código de Barras</label>
                <input type="number" class="form-control" min="1" name="codigo" id="codigo" required>
              </div>

              <div class="col-md-4">
                <label for="quantidade_estoque" class="form-label" min="1">Quantidade a vender: </label>
                <input type="number" class="form-control" min="1" name="quantidade_vendida" id="quantidade_vendida" required>
              </div>


              <div class="col-md-2">
                <button type="submit" id="adicionar" value="Adicionar" class="btn btn-success" style="margin-top:30px">Inserir</button>
              </div>
            </div>
            <br>
            <br>

            <div id="lista">

              <table id="tabela" class="table table-bordered table-light" >
                <thead>
                  <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Quantidade Vendida</th>
                    <th scope="col">Subtotal</th>
                    <th scope="col">Excluir</th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                  $total = 0;

                  if (isset($_GET["idpedido"])) {

                    foreach ($pedido_detalhe as $pedido_detalhes) { ?>
                      <tr>
                        <td><?php echo $pedido_detalhes->codproduto ?></td>
                        <td><?php echo $pedido_detalhes->fkcategoria ?></td>
                        <td><?php echo $pedido_detalhes->marca ?></td>
                        <td><?php echo $pedido_detalhes->quantidade_vendida ?></td>
                        <td><?php echo $pedido_detalhes->subtotal ?></td>
                        <td><a href='../Carrinho/Delete.php?codproduto=<?php echo $pedido_detalhes->codproduto ?>&idpedido=<?php echo $pedido_detalhes->idpedido ?>&quantidade_vendida=<?php echo $pedido_detalhes->quantidade_vendida ?>' type="button" data-toggle="modal" data-target="#EpicModal" class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                            </svg>
                          </a></td>
                        <?php $total += $pedido_detalhes->subtotal; ?>
                      </tr>
                  <?php }
                  } else {
                    echo "";
                  } ?>
                </tbody>
              </table>

            </div>
            <br>
            <div class="row" style="margin-top: 40px">
              <div class="col-4">
                <span class="total">Total R$: <b class="total"><?php echo number_format($total, 2); ?></b></span>
              </div>

              <div class="col-5">
              <a href="../GerarPDF/index.php?idpedido=<?php echo $codpedido; ?>" class="btn btn-secondary" id="pdf">Gerar Cupom</a>
              </div>

              <div class="col-3">
                <a href="precaixa.php" class="btn btn-primary" id="fechar">Fechar Compra</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Alert -->
<script src="../js/alert.js"></script>

<script>
  <?php
  if (isset($_SESSION["falha"])) {
    if ($_SESSION["falha"]) {
  ?>
      alerta('Erro ao inserir produto!', 'danger');
      setTimeout(() => {
        $(".alert").hide("slow")
      }, 2000);
      <?php
    }
    unset($_SESSION["falha"]);
  }

  ?>
</script>

</body>
<script src="../bootstrap/js/bootstrap.js"></script>
</html>