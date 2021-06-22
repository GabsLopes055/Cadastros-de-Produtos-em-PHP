<?php


include_once("conexao_banco.php");

$nomeCompleto = filter_input(INPUT_POST, 'nomeCompleto', FILTER_SANITIZE_STRING);
$cargo = filter_input(INPUT_POST, 'cargo', FILTER_SANITIZE_STRING);
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);




if (!empty($nomeCompleto) && !empty($cargo) && !empty($usuario) && !empty($senha)) {
    
    $sql_verificar_usuario = "SELECT NOME_USUARIO FROM usuarios WHERE NOME_USUARIO = '$usuario'";

    $verificar = mysqli_query($conexao_banco, $sql_verificar_usuario);

    if (($verificar) and ($verificar->num_rows != 0)) {
        printf('<h5 class="alert alert-warning" style="text-align: center;">Nome para usuário já cadastrado</h5>');
    } else {
        $sql_cadastrar_usuario = "INSERT INTO usuarios(NOME_COMPLETO, NOME_USUARIO, SENHA, CARGO, DATA_CADASTRO) VALUES ('$nomeCompleto', '$usuario', md5('$senha'), '$cargo', now());";
        $cadastrar = mysqli_query($conexao_banco, $sql_cadastrar_usuario) or die(mysqli_error($conexao_banco));
        printf('<h5 class="alert alert-success" style="text-align: center;">Usuário <strong>Cadastrado</strong></h5>');
    }
} else {
    printf('<h5 class="alert alert-danger" style="text-align: center;">Preencha todos os campos</h5>');
}
