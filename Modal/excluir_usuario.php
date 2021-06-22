<?php
session_start();
include("conexao_banco.php");

$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_STRING);



if (!empty($id_usuario) && isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {

    $sql_verificar_usuario = "DELETE FROM `usuarios` WHERE ID_USUARIO = $id_usuario";
    $excluir = mysqli_query($conexao_banco, $sql_verificar_usuario);

    printf('<h5 class="alert alert-danger" style="text-align: center;">Usuário <strong>Excluído</strong>!</h5>');
} else {
    printf('<h5 class="alert alert-danger" style="text-align: center;">ERROR</h5>');
};
