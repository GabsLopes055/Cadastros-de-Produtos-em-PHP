<?php



include_once('conexao_banco.php');



$dataInicio = filter_input(INPUT_POST, 'dataInicio', FILTER_SANITIZE_STRING);
$dataFim = filter_input(INPUT_POST, 'dataFim', FILTER_SANITIZE_STRING);


$sql = "SELECT SUM(PRECO_PRODUTO - PRECO_CUSTO) AS 'TOTAL' FROM ESTOQUE WHERE DATA BETWEEN '$dataInicio' AND '$dataFim'";

$sql_executar = mysqli_query($conexao_banco, $sql);

if ($sql_executar != '') {

  while ($resultado_busca = mysqli_fetch_assoc($sql_executar)) {
    $resultado_busca = str_replace('.', ',', $resultado_busca);
    echo 'R$: ' . $resultado_busca['TOTAL'];
  }
} else {
  echo "Nada encontrado...";
}
