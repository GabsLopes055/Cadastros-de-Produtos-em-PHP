<button class="btn btn-danger dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php print $_SESSION['nomeUsuario']; ?> &nbsp; <i class="fas fa-sign-out-alt"></i>
</button>
<?php
if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {
    echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
    echo '<a class="dropdown-item" href="cadastrar_usuario.php">Cadastrar Usuários</a>';
    echo '<a class="dropdown-item" href="backup.php">Backup</a>';
    echo '<a class="dropdown-item" data-toggle="modal" data-target="#alterar_senha" href="#">Alterar Senha</a>';
    echo '<div class="dropdown-divider"></div>';
    echo '<a class="dropdown-item" href="logout.php">Sair</a>';
    echo '</div>';
    echo '</div>';
} else {
    echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
    echo '<a class="dropdown-item" data-toggle="modal" data-target="#alterar_senha" href="#">Alterar Senha</a>';
    echo '<a class="dropdown-item" href="logout.php">Sair</a>';
    echo '</div>';
    echo '</div>';
}
?>

<div class="modal fade" id="alterar_senha" tabindex="-1" role="dialog" aria-labelledby="Alterar Senha" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterar_senha">Alterar Senha</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input class="form-control" type="password" name="senha_antiga" id="senha_antiga" placeholder="Informe a senha antiga">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <input class="form-control" type="password" name="senha_nova" id="senha_nova" placeholder="Escolha uma nova senha">
                    </div>

                    <div class="col-6">
                        <input class="form-control" type="password" name="confirmar_senha_nova" id="confirmar_senha_nova" placeholder="Repita a nova senha">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-info">Alterar Senha</button>
            </div>
        </div>
    </div>
</div>

















<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> -->