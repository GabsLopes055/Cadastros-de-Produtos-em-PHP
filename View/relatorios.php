<?php
session_start();
if (isset($_SESSION['sessaoUsuario'])) {
} else {
    header("Location: ../View/login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b23ac4bed7.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>R&A - Relatórios</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row">


            <?php include_once('menuLateral/menu_lateral.php') ?>


            <main class="container-fluid" style="margin-left: 90px;">

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <h1 class="h2">Relatórios de Vendas</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="dropleft">
                            <button class="btn btn-danger dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php print $_SESSION['nomeUsuario']; ?> &nbsp; <i class="fas fa-sign-out-alt"></i>
                            </button>
                            <?php
                            if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {
                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                echo '<a class="dropdown-item" href="cadastrar_usuario.php">Cadastrar Usuários</a>';
                                echo '<a class="dropdown-item" href="backup.php">Backup</a>';
                                echo '<a class="dropdown-item" href="#">Alterar Senha</a>';
                                echo '<div class="dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="logout.php">Sair</a>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                echo '<a class="dropdown-item" href="#">Alterar Senha</a>';
                                echo '<a class="dropdown-item" href="logout.php">Sair</a>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div style="text-align: center;">
                                    <h5 class="card-header" style="background-color: #DCDCDC;">
                                        Período
                                    </h5>
                                    <form name="relatorios_vendas" id="relatorios_vendas">
                                        <div class="card-body">

                                            <div>
                                                <input type="date" class="form-control" id="dataInicio" autocomplete="off" required placeholder="Data Inicial">
                                            </div>
                                            <div style="padding-top: 21px;">
                                                <input type="date" class="form-control" id="dataFim" autocomplete="off" required placeholder="Data Fim">
                                            </div>

                                            <div style="padding-top: 21px;">
                                                <button class="btn btn-info" name="pesquisaDatas" id="pesquisaDatas" style="width: 100%;" type="submit"><strong>Buscar</strong></button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="card">
                                <h5 class="card-header" style="text-align: center; background-color: #DCDCDC;">
                                    Resultado da busca
                                </h5>
                                <div class="row">
                                    <div class="col-6">

                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item"><strong>Total</strong></li>

                                            <li class="list-group-item"><strong>Lucro</strong></li>

                                            <li class="list-group-item"><strong>Custo</strong></li>

                                            <li class="list-group-item"><strong>Retirada</strong></li>

                                        </ul>

                                    </div>
                                    <div class="col-6">

                                        <ul class="list-group list-group-flush">

                                            <li class="list-group-item"><strong id="resultado">R$: </Strong></li>

                                            <li class="list-group-item"><strong id="resultado_lucro">R$: </strong></li>

                                            <li class="list-group-item"><strong id="resultado_custo">R$: </strong></li>

                                            <li class="list-group-item"><strong id="resultado_retirada"> R$: </strong></li>

                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="border-bottom" style="padding-top: 30px;">
                        <h1 class="h2 text-center">Gráficos</h1>
                    </div>

                    <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart_1" width="700" height="244"></canvas>
                    <!-- <div class="row" style="padding-top: 20px">
                    <div class="col-6">
                        <div style="border-radius: 1px">
                        </div>
                    </div>
                </div> -->
                </div>
            </main>
        </div>

    </div>

    <footer style="height: 50px">

    </footer>

    <script src="../Controller/Controller_relatorios.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>



</body>

</html>