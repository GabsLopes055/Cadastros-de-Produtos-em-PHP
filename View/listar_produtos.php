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
    <script type="text/javascript" src="../Controller/jquery.js"></script>

    <title>R&A - Pesquisar Produtos</title>

</head>

<body>

    <div class="container-fluid">
        <div class="row">


            <?php include_once('menuLateral/menu_lateral.php') ?>


            <main class="container-fluid" style="margin-left: 90px;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Pesquisar Produtos</h1>
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
                        <div class="col">
                            <input class="form-control" name="pesquisar" id="pesquisar" type="text" placeholder="Digite o nome ou o número da nota fiscal do produto" style="width: 100%;" autocomplete="off">
                        </div>
                    </div>
                    <div class="row">
                        <span id="conteudo" style="padding: 10px; width: 100%"></span>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        $(function() {
            $("#pesquisar").keyup(function() {

                var pesquisar = $(this).val();

                if (pesquisar != '') {
                    var dados = {
                        palavra: pesquisar
                    }
                    $.post('../Modal/listar_produtos_model.php', dados, function(retorna) {
                        $("#conteudo").html(retorna)
                    })
                }
            })
        })
    </script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

</body>

</html>