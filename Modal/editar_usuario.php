<?php
session_start();
include("conexao_banco.php");

$id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_SANITIZE_STRING);
$nome_completo = filter_input(INPUT_POST, 'nome_completo', FILTER_SANITIZE_STRING);
$nome_usuario = filter_input(INPUT_POST, 'nome_usuario', FILTER_SANITIZE_STRING);
$cargo_usuario = filter_input(INPUT_POST, 'cargo_usuario', FILTER_SANITIZE_STRING);


if (!empty($id_usuario) && !empty($nome_completo) && !empty($nome_usuario) && !empty($cargo_usuario)) {


    $sql_verificar_usuario = "SELECT USUARIO FROM usuario WHERE USUARIO = '$nome_usuario'";

    $verificar = mysqli_query($conexao_banco, $sql_verificar_usuario);

    if (($verificar) and ($verificar->num_rows != 0)) {

        printf('<h5 class="alert alert-warning" style="text-align: center;">Nome para usuário já cadastrado</h5>');
    } else {
        if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {


            $sql = "UPDATE `usuario` SET `NOME_COMPLETO`='$nome_completo',`USUARIO`='$nome_usuario',`CARGO`='$cargo_usuario',`DATA_CADASTRO`= now() WHERE ID_USUARIO = '$id_usuario'";


            $update = mysqli_query($conexao_banco, $sql);
            printf('<h5 class="alert alert-warning" style="text-align: center;">Usuário <strong>Editado</strong>!</h5>');
        }
    }
} else {
    printf('<h5 class="alert alert-danger" style="text-align: center;">ERROR</h5>');
};
