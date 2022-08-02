<?php
include "../lib/Conexao.php";
$pdo = Conexao::connect();
$idcategoria = $_GET["idcategoria"];
$sql = $pdo->query("SELECT * FROM categorias WHERE idcategoria = $idcategoria");
$categorias = $sql->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Editar Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/categoria.css">
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/modal_bootstrap.min.js"></script>
    <script src="../bootstrap/js/bootstrap.js"></script>
</head>

<body>


    <section>
        <!-- MEIO -->
        <div class="container">
            <div id="conteudo">
                <h2 class="text-center">Editar Categoria</h2>
                <br>

                <form action="func_editcat.php" method="POST">
                    <?php
                    foreach ($categorias as $categoria) {
                    ?>


                        <div class="row">
                            <input type="hidden" name="idcategoria" value="<?php echo $categoria->idcategoria ?>">
                            <div class="col-8 offset-2">
                                <div id="nome"><label for="nome" class="form-label">Nome</label>
                                    <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $categoria->nome ?>">
                                </div>
                            </div>
                            <p>

                            <div class="col-12 text-center">

                                <td><a type="button" data-toggle="modal" data-target="#EpicModal" class="btn btn-success btc">Editar</a></td>
                                <a href="../Listagem/listagemcategoria.php" class="btn btn-secondary btv"> Voltar</a>

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
                    Tem certeza que deseja editar essa Categoria?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Não</button>
                    <a href="javascript:document.querySelector('form').submit()" class="btn btn-success">Sim</a>
                </div>
            </div>
        </div>
    </div>


    <script src="../js/jquery-3.6.0.min.js"></script>
</body>
</html>