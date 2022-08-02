<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();
$codigo = $_GET["codigo"];
$sql = $pdo->query("SELECT * FROM produtos WHERE codigo = $codigo");
$produtos = $sql->fetchAll(PDO::FETCH_OBJ);
$sql = "SELECT * FROM categorias";
$comando = $pdo->prepare($sql);
$comando->execute();
$todos = $comando->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Editar Produto</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="../css/editar_pro.css">
  <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">
  <script src="../js/comandos.js"></script>
</head>

<body>
  <!-- MEIO -->

  <div class="container">
    <div class="row">
      <div id="conteudo">
        <h3>Editar Produtos</h3>
        <br>
        <form class="row g-3" action="func_editarproduto.php" method="POST">

          <?php
          foreach ($produtos as $produto) {
          ?>

            <input type="hidden" name="codigo" value="<?php echo $produto->codigo ?>">

            <div class="col-md-4">
              <label for="codigo" class="form-label">Código</label>
              <input type="number" class="form-control" name="codigo" id="codigo" value="<?php echo $produto->codigo ?>">
            </div>

            <div class="col-4">
              <label for="fkcategoria" class="form-label">Categoria</label><br>
              <select class="form-select" id="fkcategoria" name="fkcategoria">
                <option selected disabled value="">Escolha uma Categoria: </option>
                <?php
                foreach ($todos as $cat) {
                  if($produto->fkcategoria == $cat["nome"]){
                    echo '<option value="' . $cat["nome"] . '" selected>' . $cat["nome"] . '</option>';
                  }else{
                    echo '<option value="' . $cat["nome"] . '">' . $cat["nome"] . '</option>';
                  }
                  
                }
                ?>
              </select>

            </div>

            <div class="col-md-4">
              <label for="tipo" class="form-label">Tipo</label>
              <select class="form-select" name="tipo" id="tipo" onchange="validarForm()">
                <option selected disabled value="">Escolha uma opção</option>
                <?php

                    if($produto->tipo == "Unitario"){
                      echo '<option value="Unitario" selected>Unitário</option>
                      <option value="Fardo">Fardo</option>
                      ';
                    }else{
                      echo '<option value="Unitario">Unitário</option>
                      <option value="Fardo" selected>Fardo</option>
                      ';
                    }

                ?>

                
              </select>
            </div>


            <div class="col-3">
              <label for="quantidade_fardo" class="form-label">Quantidade Fardo</label>
              <input type="text" class="form-control" name="quantidade_fardo" id="quantidade_fardo" disabled placeholder="Se escolher: fardo" value="<?php echo $produto->quantidade_fardo ?>">
            </div>


            <div class="col-md-5">
              <label for="marca" class="form-label">Marca</label>
              <input type="text" class="form-control" name="marca" id="marca" value="<?php echo $produto->marca ?>">
            </div>

            <div class="col-md-4">
              <label for="quantidade_estoque" class="form-label">Quantidade estoque</label>
              <input type="number" class="form-control" name="quantidade_estoque" id="quantidade_estoque" value="<?php echo $produto->quantidade_estoque ?>">
            </div>


            <div class="col-md-4">
              <label for="preco_custo" id="pc_fardo" class="form-label" validarForm()>Preco de custo</label>
              <input type="number" class="form-control" name="preco_custo" id="preco_custo" step="0.01" value="<?php echo $produto->preco_custo ?>">
            </div>


            <div class="col-md-4">
              <label for="preco_venda" id="pv_venda" class="form-label" validarForm() >Preco de venda</label>
              <input type="number" class="form-control" name="preco_venda" id="preco_venda" step="0.01" value="<?php echo $produto->preco_venda ?>">
            </div>


            <div class="col-md-4">
              <label for="unidade_medida" class="form-label">Unidade de medida</label>
              <select class="form-select" name="unidade_medida" id="unidade_medida" >
                <option selected disabled value="">Escolha uma opção</option>

                <?php
                    if($produto->unidade_medida == "ML"){
                      echo '<option value="ML" selected>ML</option>
                      <option value="L">L</option>
                      <option value="G">G</option>
                      <option value="KG">KG</option>
                      ';
                    }else if($produto->unidade_medida == "L"){
                      echo '<option value="ML">ML</option>
                      <option value="L" selected>L</option>
                      <option value="G">G</option>
                      <option value="KG">KG</option>
                      ';
                    }
                    else if($produto->unidade_medida == "G"){
                      echo '<option value="ML">ML</option>
                      <option value="L">L</option>
                      <option value="G" selected>G</option>
                      <option value="KG">KG</option>
                      ';
                    }
                    else if($produto->unidade_medida == "KG"){
                      echo '<option value="ML">ML</option>
                      <option value="L">L</option>
                      <option value="G">G</option>
                      <option value="KG" selected>KG</option>
                      ';
                    }
                ?>

                
              </select>
            </div>
            <p>

            <div class="col-12">
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EpicModal">
                Editar
              </button>

              <a href="../Listagem/listagemproduto.php" class="btn btn-secondary mr-5"><i class="fas fa-arrow-circle-left"></i> Voltar</a>

            </div>
        </form>
      <?php
          }
      ?>
      </div>
    </div>
  </div>


  <div class="modal fade" id="EpicModal" tabindex="-1" aria-labelledby="EpicModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="EpicModalLabel">AVISO</h5>
        </div>

        <div class="modal-body">
          Tem certeza que deseja editar o Produto?
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
          <a href="javascript:document.querySelector('form').submit()" class="btn btn-success">Sim</a>
          
        </div>
      </div>
    </div>
  </div>

  <script src="../bootstrap/js/modal_bootstrap.min.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="../bootstrap/js/bootstrap.js"></script>
</body>

</html>