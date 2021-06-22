<?php

session_start();

include_once '..\Modal\conexao_banco.php';

$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM USUARIOS WHERE NOME_USUARIO = '$usuario'";

$sql_valida_usuario = mysqli_query($conexao_banco, $sql);

$resultado = mysqli_fetch_assoc($sql_valida_usuario);


// $senha = substr(md5($senha), 0, -2);

$senha = md5($senha);

if ($senha == $resultado['SENHA'] && isset($resultado)) {
    $_SESSION['sessaoUsuario'] = $resultado['CARGO'];
    $_SESSION['nomeUsuario'] = $resultado['NOME_USUARIO'];
    $_SESSION['idUsuario'] = $resultado['ID_USUARIO'];
    header("Location: ../View/dashboard.php");
} else {
    header("Location: ../View/login.php");
        $_SESSION['erro_login'] = "<div class='alert alert-danger' style='text-align: center';>Usuário ou senha inválidos</div>";
}

