<style>
    .nav {
        background-color: #D8DCD6;
        height: 100%;
        position: fixed;
        width: 80px;

    }

    .nav-item {
        margin-top: 30px;
        
    }

    .nav-link {
        text-decoration: none;
    }

    .nav-item :hover {
        -webkit-transform: scale(0.2);
        -ms-transform: scale(0.2);
        transform: scale(1.2);
    }
</style>
<nav>
    <ul class="nav flex-column shadow rounded">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link" id="dashboard"><img src="https://img.icons8.com/color/48/000000/dashboard--v1.png" /></a>
        </li>
        <li class="nav-item">
            <a href="tela_vendas.php" class="nav-link" id="vender"><img src="https://img.icons8.com/color/48/000000/sell-stock.png" /></a>
        </li>
        <li class="nav-item">
            <a href="cadastrar_produtos.php" class="nav-link" id="listarProdutos"><img src="https://img.icons8.com/fluent/48/000000/create-order.png" /></a>
        </li>
        <li class="nav-item">
            <a href="verifica_perfil.php" class="nav-link" id="graficos"><img src="https://img.icons8.com/fluent/48/000000/stocks-growth.png" /></a>
        </li>
        <li class="nav-item">
            <a href="listar_produtos.php" class="nav-link" id="cadastrarNotas"><img src="https://img.icons8.com/color/48/000000/add-shopping-cart--v2.png" /></a>
        </li>
        <div>
            <hr>
        </div>
        <li class="nav-item">
            <div class="dropright">
                <a class="nav-link btn" type="button" data-toggle="dropdown">
                    <img src="https://img.icons8.com/color/48/000000/data-pending.png" />
                </a>
                <?php
                if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {
                    echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" >';
                    echo '<a class="dropdown-item" href="cadastrar_pedidos.php">Criar lista de pedidos</a>';
                    echo '<div class="dropdown-divider"></div>';
                    echo '<a class="dropdown-item" href="editar_pedidos.php" style="display: block;">Editar Lista de pedidos </a>';
                    echo '</div>';
                }
                ?>

            </div>
        </li>
    </ul>
</nav>

<!-- https://img.icons8.com/color/48/000000/bar-chart--v2.png -->