<?php

include_once('conexao_banco.php');

$sql = "SELECT SUM(PRECO_PRODUTO) AS 'RESULTADO' FROM ESTOQUE WHERE DATA = DATE(NOW());";

$executa_sql = mysqli_query($conexao_banco, $sql);

if ($executa_sql != '') {

    while ($resultado_busca = mysqli_fetch_assoc($executa_sql)) {
      $resultado_busca = str_replace('.', ',', $resultado_busca);
      echo 'R$: ' . $resultado_busca['RESULTADO'];
    }
  } else {
    echo "Nada encontrado...";
  }
  