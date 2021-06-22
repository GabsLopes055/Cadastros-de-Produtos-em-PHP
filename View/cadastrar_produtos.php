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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="cadastrar_produtos.css"> -->
    <title>R&A - Cadastrar Produtos</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="jquery/dist/jquery.mask.min.js"></script>

</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <?php include_once('menuLateral/menu_lateral.php') ?>
            <main class="container-fluid" style="margin-left: 90px;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Cadastrar Produtos</h1>
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
                                echo '<div class="dropdown-divider"></div>';
                                echo '<a class="dropdown-item" href="logout.php">Sair</a>';
                                echo '</div>';
                                echo '</div>';
                            } else {
                                echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                echo '<a class="dropdown-item" href="logout.php">Sair</a>';
                                echo '</div>';
                                echo '</div>';
                            }
                            ?>



                        </div>
                    </div>

                    <form>
                        <div class="form">

                            <div class="row">
                                <div class="col-2">
                                    <label><strong>Nª da Nota</strong></label>
                                    <input type="number" class="form-control" name="numero_nota" id="numero_nota" required>
                                </div>
                                <div class="col-4">
                                    <strong><label>Nome do Produto</label></strong>
                                    <input type="text" class="form-control" name="nome_produto" id="nome_produto" required>
                                </div>

                                <div class="col-5" id="recarregar">
                                    <strong><label>Fornecedor</label></strong>
                                    <select type="text" class="form-control" name="fornecedor" id="fornecedor" required>
                                        <option>Escolha um fornecedor</option>
                                        <?php
                                        include '..\Modal\conexao_banco.php';
                                        $sql = "SELECT NOME_FORNECEDOR FROM fornecedor";
                                        $busca = mysqli_query($conexao_banco, $sql);

                                        while ($linha = mysqli_fetch_array($busca)) {

                                            $NOME_FORNECEDOR = $linha['NOME_FORNECEDOR'];
                                        ?>
                                            <option><?php echo $NOME_FORNECEDOR ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-1">
                                    <button class="btn btn-secondary " data-toggle="modal" data-target="#modal_fornecedor" style="margin-top: 30px; width: 100%;">&nbsp;<i class="fas fa-plus"></i></button>
                                </div>
                            </div>

                            <div class="row" style="padding-top: 10px;">
                                <div class="col-6">
                                    <label><strong>Quantidade</strong></label>
                                    <input type="number" class="form-control" name="quantidade" id="quantidade" required>
                                </div>
                                <div class="col-4">
                                    <label><strong>Custo</strong></label>
                                    <input type="number " class="form-control" name="valor_unitario" id="valor_unitario" required>
                                </div>
                                <div class="col-2">
                                    <div id="botaoCadastrar">
                                        <button name="cadastrar" id="cadastrar" class="btn btn-info" style="margin-top: 30px; width: 100%;">Cadastrar &nbsp;<i class="fas fa-plus"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>



                    </form>

                    <div class="">
                        <div class="border-bottom">
                            <h1 class="h2" style="text-align: center; margin-top: 20px;"></h1>
                        </div>
                    </div>
                    <div class="row">
                        <span id="resultado" style="padding: 10px; width: 100%">
                            <?php if (isset($_SESSION['fornecedor_cadastrado'])) {
                                echo "<div class = 'alert alert-success fade show' role= 'alert'><h5 style='text-align: center;'>Fornecedor <strong>Cadastrado</strong> !</h5></div>";
                                unset($_SESSION['fornecedor_cadastrado']);
                            } else if (isset($_SESSION['fornecedor_erro'])) {
                                echo "<div class = 'alert alert-danger fade show' role= 'alert'><h5>Erro ao cadastrar !</h5></div>";
                                unset($_SESSION['fornecedor_erro']);
                            };
                            ?>
                        </span>
                    </div>
                </div>


            </main>
        </div>
    </div>

    <footer style="padding-top: 40px">

    </footer>


    <!-- Modal -->
    <div class="modal fade " id="modal_fornecedor" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Cadastrar Fornecedor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_fornecedor">
                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" id="nome_fornecedor" type="text" placeholder="Nome da Empresa">
                            </div>
                            <div class="col-6">
                                <input class="form-control" id="cnpj_fornecedor" type="text" placeholder="CNPJ">

                            </div>
                        </div>
                        <br>

                        <div class="row">
                            <div class="col-6">
                                <input class="form-control" id="endereco_fornecedor" type="text" placeholder="Endereço">
                            </div>
                            <div class="col-6">
                                <input class="form-control" id="contato_fornecedor" type="text" placeholder="Contato da Empresa">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                            <button type="button" id="cadastrar_fornecedor" class="btn btn-info">Cadastrar Fornecedor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>

    <script src="../Controller/Controller_cadastrar_fornecedores.js"></script>
    <script src="../Controller/cadastrar_produtos_controller.js"></script>

    <script>
        $('#cnpj_fornecedor').mask('00.000.000/0000-00', {
            reverse: true
        });
    </script>



</body>

</html>