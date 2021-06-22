<?php
session_start();
if (isset($_SESSION['sessaoUsuario'])) {
} else {
    header("Location: ../View/login.php");
}
?>
<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>R&A - Cadastrar Usuários</title>
    <link rel="stylesheet" href="css/cadastrar_usuarios.css">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b23ac4bed7.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
</head>

<body>

    <div class="container-fluid">

        <div class="row">
            <?php include_once('menuLateral/menu_lateral.php') ?>
            <main class="container-fluid" style="margin-left: 90px;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">

                    <h1 class="h2">Cadastrar Usuários</h1>
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

                    <form id="form_dados" action="" method="post">
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" type="text" name="nome" id="nomeCompleto" placeholder="Nome Completo" required autocomplete="off">
                            </div>
                            <div class="col-6">
                                <select class="form-control" type='text' name="cargo" id="cargo" required autocomplete="off">
                                    <option>Administrador</option>
                                    <option>Gerente</option>
                                    <option>Funcionário</option>
                                </select>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <form class='form-control'>
                                <div class="col-6">
                                    <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Usuário" required autocomplete="off">
                                </div>
                                <div class="col-4">
                                    <input class="form-control" type="password" name="senha" id="senha" placeholder="Senha - Deve ter de 8 a 20 caracteres." required autocomplete="off">
                                </div>
                                <div class="col-2">
                                    <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-info">Cadastrar &nbsp;<i class="fas fa-plus"></i></button>
                                </div>
                            </form>
                        </div>
                    </form>

                    <br>
                    <p id="resultado"></p>

                    <?php

                    include_once "../Modal/conexao_banco.php";


                    $sql = "SELECT * FROM USUARIOS ORDER BY ID_USUARIO DESC";

                    $listar_usuarios = mysqli_query($conexao_banco, $sql) or die(mysqli_error($conexao_banco));

                    ?>
                    <table class="table table-hover table-borderless ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome Completo</th>
                                <th>Usuário</th>
                                <th>Cargo</th>
                                <th>Data de Cadastro</th>
                                <th>Editar</th>
                                <th>Excluir</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (($listar_usuarios) and ($listar_usuarios->num_rows != 0)) {
                                while ($row_usuario = mysqli_fetch_assoc($listar_usuarios)) {
                            ?>
                                    <tr>
                                        <td><?php echo $row_usuario['ID_USUARIO']; ?></td>
                                        <td><?php echo $row_usuario['NOME_COMPLETO']; ?></td>
                                        <td><?php echo $row_usuario['NOME_USUARIO']; ?></td>
                                        <td><?php echo $row_usuario['CARGO']; ?></td>
                                        <td><?php echo date("d/m/Y", strtotime($row_usuario['DATA_CADASTRO'])); ?></td>
                                        <td><a class="btn btn-warning" data-toggle="modal" data-target="#editarUsuario" data-whatever_id="<?php echo $row_usuario['ID_USUARIO']; ?>" data-whatever_nome_completo="<?php echo $row_usuario['NOME_COMPLETO']; ?>" data-whatever_nome_usuario="<?php echo $row_usuario['NOME_USUARIO']; ?>" data-whatever_cargo="<?php echo $row_usuario['CARGO']; ?>" style="color: #fff" href="" role="button"><i class="fas fa-pen-square"></i>
                                            </a></td>
                                        <td><a class="btn btn-danger" data-toggle="modal" data-target="#excluirUsuario" data-whatever_id_excluir="<?php echo $row_usuario['ID_USUARIO']; ?>" style="color: #fff" href="" role="button"><i class="far fa-trash-alt"></i>
                                            </a></td>
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
        <!-- <button class="btn btn-danger"></button> -->
    </div>

    <!-- Modal editar usuario -->
    <div class="modal fade" id="editarUsuario" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #ffc107">
                    <h5 class="modal-title" id="TituloModalCentralizado">Editar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post">

                        <div class="row">
                            <div class="col col-6">
                                <input type="hidden" name="idUsuario" id="id_usuario">
                                <label><strong>Nome Completo</strong></label>
                                <input type="text" class="form-control" id="nome_completo" required>
                            </div>
                            <div class="col col-6">
                                <label><strong>Usuario</strong></label>
                                <input type="text" class="form-control" id="nome_usuario" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label><strong>Cargo</strong></label>
                                <select class="form-control" type='text' id="cargo_usuario" required autocomplete="off">
                                    <option>Administrador</option>
                                    <option>Gerente</option>
                                    <option>Funcionario</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="color: black">Cancelar</button>
                            <button type="submit" class="btn btn-warning" id="confirmar" style="color: black">Confirmar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="excluirUsuario" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #DC3545">
                    <h5 class="modal-title" id="TituloModalCentralizado">Excluir Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <input type="hidden" id="id_usuario_excluir">
                        <h5>Tem certeza ?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="color: black">Não</button>
                    <button type="submit" class="btn btn-danger" id="confirma_excluir" style="color: #fff">Sim</button>
                </div>
                </form>
            </div>
        </div>
    </div>




    <script src="../Controller/Controller_cadastrar_usuario.js"></script>
    <script src="../Controller/Controller_editar_usuario.js"></script>
    <script src="../Controller/Controller_excluir_usuario.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

    <script type="text/javascript">
        $('#editarUsuario').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget) // Botão que acionou o modal
            var id_usuario = button.data('whatever_id')
            var nome_completo = button.data('whatever_nome_completo')
            var nome_usuario = button.data('whatever_nome_usuario')
            var cargo = button.data('whatever_cargo')

            var modal = $(this)
            modal.find('#id_usuario').val(id_usuario)
            modal.find('#nome_completo').val(nome_completo)
            modal.find('#nome_usuario').val(nome_usuario)
            modal.find('#cargo_usuario').val(cargo)

        })
    </script>

    <script type="text/javascript">
        $('#excluirUsuario').on('show.bs.modal', function(event) {

            var button = $(event.relatedTarget) // Botão que acionou o modal
            var id_excluir = button.data('whatever_id_excluir') // Extrair informações de dados * atributos

            var modal = $(this)
            modal.find('#id_usuario_excluir').val(id_excluir);

        })
    </script>

</body>


</html>