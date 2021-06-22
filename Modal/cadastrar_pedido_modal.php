<?php

include_once "conexao_banco.php";


$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING);
$descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);

if ((!empty($titulo)) and (!empty($descricao))) {

    $sql = "INSERT INTO `lista_pedidos`(`TITULO`, `DATA_CADASTRO`, `PEDIDO`) VALUES ('$titulo',now(),'$descricao');";

    $inserir = mysqli_query($conexao_banco, $sql);

    printf('<h5 class="alert alert-success" style="text-align: center;">Pedido <strong>Cadastrado</strong></h5>');
} else {
    printf('<h5 class="alert alert-danger" style="text-align: center;">ERRO, Entre em contato com o administrador</h5>');
}
