<?php

session_start();

include_once("conexao_banco.php");

$nome_fornecedor = $_POST['nome_fornecedor'];
$cnpj_fornecedor = $_POST['cnpj_fornecedor'];
$endereco_fornecedor = $_POST['endereco_fornecedor'];
$contato_fornecedor = $_POST['contato_fornecedor'];
$idUsuario = $_SESSION['idUsuario'];


if (!empty($nome_fornecedor) && !empty($cnpj_fornecedor) && !empty($endereco_fornecedor) && !empty($contato_fornecedor) && isset($_SESSION['idUsuario'])) {
    if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador' || $_SESSION['sessaoUsuario'] = 'Gerente') {
        $sql = "INSERT INTO `fornecedor`(`NOME_FORNECEDOR`, `CNPJ_FORNECEDOR`, `DATA_CADASTRO`, `ENDERECO_FORNECEDOR`, `CONTATO_FORNECEDOR`, `USUARIOS_ID_USUARIO`) VALUES ('$nome_fornecedor','$cnpj_fornecedor',now(),'$endereco_fornecedor','$contato_fornecedor','$idUsuario')";
        $cadastrar = mysqli_query($conexao_banco, $sql);
        if ($cadastrar) {
            $_SESSION['fornecedor_cadastrado'] = "";
        } else {
            $_SESSION['fornecedor_erro'] = "";
        }
    } else {
        echo "<div class = 'alert alert-warning fade show' role= 'alert'><h5>Você não possui permissão para cadastrar um fornecedor !</h5></div>";
    }
} else {
    echo "<div class = 'alert alert-warning fade show' role= 'alert'><h5>Dados Incorretos !</h5></div>";
}
