<?php

include_once('conexao_banco.php');

$sql = "SELECT COUNT(*) AS 'TOTAL' FROM PRODUTOS_NOTA_FISCAL;";

$executa_sql = mysqli_query($conexao_banco, $sql);

if ($executa_sql != '') {

    while ($resultado_busca = mysqli_fetch_assoc($executa_sql)) {
      $resultado_busca = str_replace('.', ',', $resultado_busca);
      echo $resultado_busca['TOTAL'];
    }
  } else {
    echo "Nada encontrado...";
  }
  