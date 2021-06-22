<?php

session_start();

include("conexao_banco.php");


$cadastrar = filter_input(INPUT_POST, 'cadastrar', FILTER_SANITIZE_STRING);

$nome_produto = filter_input(INPUT_POST, 'nome_produto', FILTER_SANITIZE_STRING);
$preco_custo = filter_input(INPUT_POST, 'preco_custo', FILTER_SANITIZE_STRING);
$preco_produto = filter_input(INPUT_POST, 'preco_produto', FILTER_SANITIZE_STRING);
$quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_STRING);
$forma_pagamento = filter_input(INPUT_POST, 'forma_pagamento', FILTER_SANITIZE_STRING);


$preco_custo = str_replace(',', '.', $preco_custo);
$preco_produto = str_replace(',', '.', $preco_produto);




if ((!empty($nome_produto)) and (!empty($preco_custo)) and (!empty($preco_produto)) and (!empty($quantidade)) and (!empty($forma_pagamento))) {

    $sql_inserir = "INSERT INTO ESTOQUE (data, nome_produto, preco_custo, preco_produto, quantidade, forma_pagamento) VALUES (now(), '$nome_produto', $preco_custo, $preco_produto, $quantidade, '$forma_pagamento')";

    $inserir = mysqli_query($conexao_banco, $sql_inserir);

    $_SESSION['venda_cadastrada'] = "";

    header("Location: http://localhost/sistema/view/tela_vendas.php");
}
