<?php

session_start();

include_once "conexao_banco.php";

$numero_nota = filter_input(INPUT_POST, 'numero_nota', FILTER_SANITIZE_STRING);
$nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
$fornecedor = filter_input(INPUT_POST, 'fornecedor', FILTER_SANITIZE_STRING);
$quantidade = filter_input(INPUT_POST, 'quantidade',  FILTER_SANITIZE_STRING);
$valor_unitario = filter_input(INPUT_POST, 'valor_unitario',  FILTER_SANITIZE_STRING);
$id_usuario = $_SESSION['idUsuario'];
$valor_unitario = str_replace(',', '.', $valor_unitario);

if (!empty($fornecedor)) {

    $executar = "SELECT ID_FORNECEDOR FROM fornecedor WHERE NOME_FORNECEDOR = '$fornecedor'";

    $cod_fornecedor = mysqli_query($conexao_banco, $executar);
    $dados_fornecedor = mysqli_fetch_array($cod_fornecedor);

    if ($cod_fornecedor) {
        if ((!empty($numero_nota)) and (!empty($nome_produto)) and (!empty($fornecedor)) and (!empty($quantidade)) and (!empty($valor_unitario)) and (!empty($id_usuario))) {
            $procedure = "CALL CADASTRO_PRODUTO('$nome_produto', $quantidade, now(), $valor_unitario, $id_usuario, $numero_nota, $dados_fornecedor[0])";

            $inserir = mysqli_query($conexao_banco, $procedure);

            if ($inserir) {
                echo '<div class="alert alert-success" style="text-align: center;" role="alert"><h6>Produto <strong>Cadastrado</strong><h6></div>';
            } else {
                echo '<div class="alert alert-danger" style="text-align: center;" role="alert"><h6>Erro ao Cadastrar Produto !</h6></div>';
            }
        } else {
            echo '<div class="alert alert-danger" style="text-align: center;" role="alert"><h6>Erro ao Cadastrar Produto !</h6></div>';
        }
    }
} else {
    echo '<div class="alert alert-danger" style="text-align: center;" role="alert"><h6>Erro ao Cadastrar Produto !</h6></div>';
}
