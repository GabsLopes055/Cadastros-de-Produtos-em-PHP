<?php

session_start();

include 'conexao_banco.php';


$id_produto = filter_input(INPUT_POST, 'id_produto', FILTER_SANITIZE_STRING);


$sql_excluir = "DELETE FROM ESTOQUE WHERE ID_PRODUTO = $id_produto;";

if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Funcionario') {

	$_SESSION['excluir_negado'] = "<div class = 'alert alert-danger fade show' role= 'alert'><h5>Você não possui permissão para excluir esta venda !</h5></div>";
	header("Location: ../view/tela_vendas.php");

} else {
	$excluir = mysqli_query($conexao_banco, $sql_excluir);
	header("Location: ../view/tela_vendas.php");
	$_SESSION['venda_excluida'] = '';
}





