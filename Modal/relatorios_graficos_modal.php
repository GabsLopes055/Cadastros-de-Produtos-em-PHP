<?php

include_once('conexao_banco.php');


$dataInicio = filter_input(INPUT_POST, 'dataInicio', FILTER_SANITIZE_STRING);
$dataFim = filter_input(INPUT_POST, 'dataFim', FILTER_SANITIZE_STRING);



$sql = "SELECT (SELECT COUNT(FORMA_PAGAMENTO) FROM ESTOQUE WHERE FORMA_PAGAMENTO = 'dinheiro' AND DATA BETWEEN '$dataInicio' AND '$dataFim') AS 'DINHEIRO',(SELECT (COUNT(FORMA_PAGAMENTO)) FROM ESTOQUE WHERE FORMA_PAGAMENTO = 'Cartão de Crédito' AND DATA BETWEEN '$dataInicio' AND '$dataFim') AS 'CARTAO';";

$sql_executar = mysqli_query($conexao_banco, $sql);

if ($sql_executar != '') {

  while ($resultado_busca = mysqli_fetch_assoc($sql_executar)) {
    echo json_encode($resultado_busca);
  }
} else {
  echo "Nada encontrado...";
}
