<?php

include_once "conexao_banco.php";

$palavra = filter_input(INPUT_POST, 'palavra', FILTER_SANITIZE_STRING);

$pesquisar_produto = "SELECT * FROM PRODUTOS_NOTA_FISCAL WHERE NOME_PRODUTO LIKE '%$palavra%' OR ID_NOTA_FISCAL LIKE '$palavra';";


$sql_executar = mysqli_query($conexao_banco, $pesquisar_produto);


?>

<div class="container-fluid" style="padding-top: 20px;">
    <table class="table table-hover table-borderless">
        <thead>
        <th scope="col">Nª da Nota</th>
            <th scope="col" style="text-align: center">Data de emissão</th>
            <th scope="col" style="text-align: center">Nome do Produto</th>
            <th scope="col" style="text-align: center">Fornecedor</th>
            <th scope="col" style="text-align: center">Preço Custo</th>
            <th scope="col" style="text-align: center">Quantidade</th>
            <th scope="col" style="text-align: center">Total</th>
        </thead>
        <tbody>
            <?php

            if (($sql_executar) and ($sql_executar->num_rows != 0)) {
                while ($row_usuario = mysqli_fetch_assoc($sql_executar)) {
            ?>
                    <tr>
                    <td style="text-align: center"><?php echo $row_usuario['ID_NOTA_FISCAL']; ?></th>
                        <td style="text-align: center"><?php echo date("d/m/Y", strtotime($row_usuario['DATA_EMISSAO'])); ?></td>
                        <td style="text-align: center"><?php echo $row_usuario['NOME_PRODUTO']; ?></th>
                        <td style="text-align: center"><?php echo $row_usuario['FORNECEDOR']; ?></th>
                        <td style="text-align: center"><?php echo str_replace('.', ',', $row_usuario['PRECO_CUSTO']); ?></th>
                        <td style="text-align: center"><?php echo $row_usuario['QUANTIDADE']; ?></th>
                        <td style="text-align: center"><?php echo str_replace('.', ',', $row_usuario['TOTAL']); ?></th>
                    </tr>
                <?php


                }
            } else {
                ?>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <td style="text-align: center">Nada encontrado</th>
                <?php
            }

                ?>
        </tbody>
    </table>
</div>