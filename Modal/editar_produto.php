<?php

session_start();

include("conexao_banco.php");


$cadastrar = filter_input(INPUT_POST, 'cadastrar', FILTER_SANITIZE_STRING);

$id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_STRING);
$nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
$preco_custo = filter_input(INPUT_POST, 'preco_custo', FILTER_SANITIZE_STRING);
$preco_produto = filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_STRING);
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
$forma_pagamento = filter_input(INPUT_POST, 'forma_pagamento', FILTER_SANITIZE_STRING);

$preco_custo = str_replace(',', '.', $preco_custo);
$preco_produto = str_replace(',', '.', $preco_produto);




if ((!empty($nome_produto)) and (!empty($preco_custo)) and (!empty($preco_produto)) and (!empty($quantidade)) and (!empty($forma_pagamento))) {

    $sql_alterar = "UPDATE estoque SET DATA = now(), NOME_PRODUTO = '$nome_produto' , PRECO_CUSTO = $preco_custo, PRECO_PRODUTO = $preco_produto, QUANTIDADE  = $quantidade, FORMA_PAGAMENTO = '$forma_pagamento' WHERE ID_PRODUTO = $id_produto;";

    if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Funcionario') {

        $_SESSION['editar_negado'] = "<div class = 'alert alert-warning fade show' role= 'alert'><h5>Você não possui permissão para editar esta venda !</h5></div>";
        header("Location: ../view/tela_vendas.php");
        
    } else {

        $alterar = mysqli_query($conexao_banco, $sql_alterar);
        $_SESSION['venda_editada'] = "";
        header("Location: ../view/tela_vendas.php");

    }
} else {
    echo 'Campos incorretos';
}
