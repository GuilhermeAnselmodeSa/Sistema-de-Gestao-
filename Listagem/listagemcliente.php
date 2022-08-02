<?php
$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);
?>

<?php
include_once '../lib/Conexao.php';
$pdo = Conexao::connect();
$sql = $pdo->query("SELECT * FROM clientes WHERE nome LIKE '$busca%' OR cpf LIKE '$busca%' "); 
$clientes = $sql->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <title>Listagem CLientes</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/listagemcli.css">
  <script src="../bootstrap/js/bootstrap.js"></script>
  <script src="../bootstrap/js/modal_bootstrap.min.js"></script>
</head>

<body>

  <!-- NAVBAR -->
  <?php include "menu.php" ?>

  <section>

    <!-- MEIO -->
    <div class="table-responsive-lg col-lg-10" id="limite-tabela">
      <div class="p-5 text-white bg-dark rounded-3">

        <form method="get">
          <div class="row my-3">
            <div class="col-md-4">
              <input type="text" name="busca" id="busca" class="form-control" placeholder="Pesquisar Nome" value="<?= $busca ?>">
            </div>

            <div class="col d-flex align-items-end">
              <button type="submit" class="btn btn-outline-primary" style="margin-bottom: 50px !important;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                </svg></a></td>
              </button>

              <button type="reset" id="limpar" class="btn btn-outline-primary" style="margin-bottom: 50px !important;">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z" />
                  <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z" />
                </svg>
              </button>

            </div>
          </div>
        </form>

        <!-- Listando informações -->
        <table class="table table-responsive table-dark table-hover table-bordered text-center">

          <thead class="table-dark table-bordered">
            <tr>
              <td scope="col">#</td>
              <td scope="col">Nome</td>
              <td scope="col">CPF</td> 
              <td scope="col">Telefone</td>
              <td scope="col">Bairro</td>
              <td scope="col">Rua</td>
              <td scope="col">Numero</td>
              <td scope="col">Editar</td>
              <td scope="col">Excluir</td>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($clientes as $cliente) {
            ?>
              <tr>
                <td><?php echo $cliente->idcliente ?></td>
                <td><?php echo $cliente->nome ?></td>
                <td><?php echo $cliente->cpf ?></td>
                <td><?php echo $cliente->telefone ?></td>
                <td><?php echo $cliente->bairro ?></td>
                <td><?php echo $cliente->rua ?></td>
                <td><?php echo $cliente->numero ?></td>
                <td><a href="../Cliente/pag_editar.php?idcliente=<?php echo $cliente->idcliente ?>" class=" btn btn-outline-success">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                      <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                      <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg></a></td>

                <td><a type="button" data-toggle="modal" data-target="#EpicModal<?php echo $cliente->idcliente?>" class="btn btn-outline-danger">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                    </svg>

                  </a></td>

                <div class="modal fade" id="EpicModal<?php echo $cliente->idcliente ?>" tabindex="-1" aria-labelledby="EpicModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-dark" id="EpicModalLabel">AVISO</h5>
                      </div>

                      <div class="modal-body text-dark">
                        Tem certeza que deseja excluir o Cliente?
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                        <a href="../Cliente/delcliente.php?idcliente=<?php echo $cliente->idcliente ?>" class="btn btn-success">Sim</a>
                      </div>
                    </div>
                  </div>
                </div>
              </tr>

            <?php
            }
            ?>
          </tbody>

        </table>


      </div>
    </div>
  </section>
</body>

</html>