<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();
$idcliente = $_GET["idcliente"]; 
$sql = $pdo->query("SELECT * FROM clientes WHERE idcliente = $idcliente"); 
$clientes = $sql->fetchAll(PDO::FETCH_OBJ);
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Editar Cliente</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/editar_cli.css">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <script src="../bootstrap/js/modal_bootstrap.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../js/jquery.mask.js"></script>

  <script type="text/javascript">
    $(document).ready(function() {
      $("#telefone").mask("(00) 0000-0000");
      $('#cpf').mask('000.000.000-00');
    });
  </script>
</head>

<body>


  <section>
    <!-- MEIO -->
    <div class="container">
      <div class="row">
        <div id="conteudo">

          <div id="liveAlertPlaceholder">
          </div>
          <h3>Editar Cliente</h3>
          <p>

          <form action="func_editarcliente.php" method="POST">
            <?php
            foreach ($clientes as $cliente) {
            ?>


              <div class="row">
                <input type="hidden" name="idcliente" value="<?php echo $cliente->idcliente ?>">
                <div class="col-md-12">
                  <div id="nome"><label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" required value="<?php echo $cliente->nome ?>">
                  </div>
                </div>
                <p>
                <div class="col-6">
                  <label for="cpf" class="form-label">CPF</label>
                  <input type="text" class="form-control" name="cpf" id="cpf" autocomplete="off" required value="<?php echo $cliente->cpf ?>">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">Telefone</label>
                  <input type="text" class="form-control" name="telefone" id="telefone" required placeholder="Com o DDD" max="99999999999" min="11111111111" value="<?php echo $cliente->telefone ?>">
                </div>
                <p>

                <div class="col-12">
                  <label for="rua" class="form-label">Rua</label>
                  <input type="text" class="form-control" name="rua" id="rua" required value="<?php echo $cliente->rua ?>">
                </div>
                <p>

                <div class="col-8">
                  <label for="bairro" class="form-label">Bairro</label>
                  <input type="text" class="form-control" name="bairro" id="bairro" required value="<?php echo $cliente->bairro ?>">
                </div>


                <div class="col-4">
                  <label for="numero" class="form-label">Número</label>
                  <input type="text" class="form-control" name="numero" id="numero" required value="<?php echo $cliente->numero ?>">
                </div>
                <p>

                <div class="col-12">
                  <td><a type="button" data-toggle="modal" data-target="#EpicModal" class="btn btn-success">Editar</a></td>
                  <a href="../Listagem/listagemcliente.php" class="btn btn-secondary mr-5"> Voltar</a>
                </div>


              <?php
            }
              ?>

          </form>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade" id="EpicModal" tabindex="-1" aria-labelledby="EpicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-dark" id="EpicModalLabel">AVISO</h5>
        </div>

        <div class="modal-body text-dark">
          Tem certeza que deseja editar o Cliente?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
          <a href="javascript:document.querySelector('form').submit()" class="btn btn-success" id="liveAlertBtn">Sim</a>
        </div>
      </div>
    </div>
  </div>

</body>
<script src="../js/alert.js"></script>

<script>
  <?php
  if (isset($_SESSION["sucesso"])) {
    if ($_SESSION["sucesso"]) {
  ?>
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

</html>