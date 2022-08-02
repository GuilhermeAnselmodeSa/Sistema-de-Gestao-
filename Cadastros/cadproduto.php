<?php
include_once "../lib/Conexao.php";
session_start();
$pdo = Conexao::connect();
$sql = "SELECT * FROM categorias";
$comando = $pdo->prepare($sql);
$comando->execute();
$todos = $comando->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Produtos</title>
  <link rel="stylesheet" type="text/css" href="../css/tel_produto.css">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/comandos.js"></script>

</head>

<body>

  <!-- NAVBAR -->

  <?php include "menu.php" ?>

  <div class="container">
    <div class="row">
      <div id="conteudo">

        <!-- ALERT EXIBIÇÃO -->
        <div id="liveAlertPlaceholder"></div>

        <h3> Cadastro dos Produtos</h3>
        <br>

        <form class="row g-3" action="../Produto/func_cadproduto.php" method="POST" id="formulario">

          <div class="col-md-4">
            <label for="codigo" class="form-label">Código</label>
            <input type="number" class="form-control" name="codigo" id="codigo" min="0" required>
          </div>

          <div class="col-4">
            <label for="fkcategoria" class="form-label">Categoria</label><br>
            <select class="form-select " id="fkcategoria" name="fkcategoria" required>
              <option selected disabled value="" >Escolha uma Categoria: </option>
              <?php
              foreach ($todos as $cat) {
                echo '<option value="' . $cat["nome"] . '">' . $cat["nome"] . '</option>';
              }
              ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" name="tipo" id="tipo" onchange="validarForm()" required>
              <option selected disabled value="" >Escolha uma opção</option>
              <option value="Unitario">Unitário</option>
              <option value="Fardo">Fardo</option>
            </select>
          </div>

          <div class="col-4">
            <label for="quantidade_fardo" class="form-label">Quantidades no Fardo</label>
            <input type="text" class="form-control" name="quantidade_fardo" id="quantidade_fardo" min="0" disabled placeholder="Se escolher: fardo" required>
          </div>

          <div class="col-md-4">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" name="marca" id="marca" required>
          </div>

          <div class="col-md-4">
            <label for="quantidade_estoque" class="form-label">Quantidade em estoque</label>
            <input type="number" class="form-control" min="0" name="quantidade_estoque" id="quantidade_estoque">
          </div>

          <div class="col-md-4">
            <label for="preco_custo" id="pc_fardo" class="form-label" validarForm() >Preco de custo</label>
            <input type="number" class="form-control" name="preco_custo" id="preco_custo" min="0" step="0.01" onchange="this.value = this.value.replace(/,/g, '.')" required>
          </div>

          <div class="col-md-4">
            <label for="preco_venda" id="pv_venda" class="form-label" validarForm() >Preco de venda</label>
            <input type="number" class="form-control" name="preco_venda" id="preco_venda" min="0" step="0.01" onchange="this.value = this.value.replace(/,/g, '.')" required>
          </div>

          <div class="col-md-4">
            <label for="unidade_medida" class="form-label">Unidade de medida</label>
            <select class="form-select" name="unidade_medida" id="unidade_medida" required>
              <option selected disabled value="" >Escolha uma opção</option>
              <option value="ML">ML</option>
              <option value="L">L</option>
              <option value="G">G</option>
              <option value="KG">KG</option>
            </select>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-success" id="liveAlertBtn">Cadastrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- FUNÇÃO ALERT -->

  <script src="../js/alert.js"></script>

  <script>
    <?php
    if (isset($_SESSION["sucesso"])) {
      if ($_SESSION["sucesso"]) {
    ?>
        alerta('Produto cadastrado com sucesso!', 'success');
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

</body> 

</html>