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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b23ac4bed7.js" crossorigin="anonymous"></script>
    <title>R&A - Editar Pedidos</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <style>

    </style>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('menuLateral/menu_lateral.php') ?>
            <main class="container-fluid" style="margin-left: 90px;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Editar Pedidos de Compra</h1>
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
                    <p id="resultado"></p>
                    <?php

                    include_once "../Modal/conexao_banco.php";


                    $sql = "SELECT * FROM lista_pedidos ORDER BY ID_LISTA";

                    $listar_usuarios = mysqli_query($conexao_banco, $sql) or die(mysqli_error($conexao_banco));

                    ?>
                    <table class="table table-hover table-borderless ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Data de cadastro</th>
                                <!-- <th>Descrição do pedido</th> -->
                                <th>Editar</th>
                                <th>Excluir</th>
                                <th>Exportar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (($listar_usuarios) and ($listar_usuarios->num_rows != 0)) {
                                while ($row_usuario = mysqli_fetch_assoc($listar_usuarios)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row_usuario['ID_LISTA']; ?></td>
                                        <td><?php echo $row_usuario['TITULO']; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($row_usuario['DATA_CADASTRO'])); ?></td>
                                        <!-- <td><?php echo $row_usuario['PEDIDO']; ?></td> -->
                                        <td><a class="btn btn-warning" data-toggle="modal" data-target="#editarUsuario" style="color: #fff" href="" role="button"><i class="fas fa-pen-square"></i>
                                            </a></td>
                                        <td><a class="btn btn-danger" data-toggle="modal" data-target="#excluirUsuario" href="" role="button"><i class="far fa-trash-alt"></i>
                                            </a></td>
                                        <td><a class="btn btn-outline-secondary" href="https://web.whatsapp.com/send?phone=556195051082&text=<?php echo $row_usuario['PEDIDO']; ?>" value="teste" target="_blank" role="button"><i class="fas fa-file-export"></i>
                                            </a></td>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>


</body>
<script src="../Controller/Controller_editar_pedidos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

<script>

</script>

</html>