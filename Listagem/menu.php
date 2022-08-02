<link rel="stylesheet" href="../css/menu.css">

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">
            <img src="../img/logo.png" alt="" width="85" height="42" id="imglogo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="../Caixa/precaixa.php">Caixa</a>
                </li>
                <li class="nav-item dropdown dpcadastro">
                    <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Cadastros
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="../Cadastros/cadcliente.php">Clientes</a></li>
                        <li><a class="dropdown-item" href="../Cadastros/cadproduto.php">Produtos</a></li>
                        <li><a class="dropdown-item" href="../Cadastros/cadcategoria.php">Categorias</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Listagem
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark dropdown-menu-macos mx-0 border-0 shadow" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="listagemcliente.php">Clientes</a></li>
                        <li><a class="dropdown-item" href="listagemproduto.php">Produtos</a></li>
                        <li><a class="dropdown-item" href="listagemcategoria.php">Categoria</a></li>
                        <li><a class="dropdown-item" href="listagempedidos.php">Pedidos</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
