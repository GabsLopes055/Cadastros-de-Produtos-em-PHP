<?php

include_once "conexao_banco.php";

$numero_nota = filter_input(INPUT_POST, 'numero_nota', FILTER_SANITIZE_STRING);
sleep(1); 
$listar_notas = mysqli_query($conexao_banco, "SELECT N.NUMERO_NOTA_FISCAL, P.NOME_PRODUTO, F.NOME_FORNECEDOR, P.QUANTIDADE, N.DATA_CADASTRO, P.VALOR_UNITARIO, (P.QUANTIDADE * P.VALOR_UNITARIO) AS 'TOTAL' FROM nota_fiscal N INNER JOIN entrada_produto P ON N.ENTRADA_PRODUTO_ID_PRODUTO = P.ID_PRODUTO INNER JOIN fornecedor F ON N.FORNECEDOR_ID_FORNECEDOR = F.ID_FORNECEDOR WHERE N.NUMERO_NOTA_FISCAL = $numero_nota ORDER BY N.ID_NOTA_FISCAL DESC;");
?>

<div class="container-fluid" style="padding-top: 20px;">
    
    <table class="table table-hover table-borderless">
        <thead>
            <th scope="col">Nª da Nota</th>            
            <th scope="col" style="text-align: center">Nome do Produto</th>
            <th scope="col" style="text-align: center">Fornecedor</th>
            <th scope="col" style="text-align: center">Quantidade</th>
            <th scope="col" style="text-align: center">Data de emissão</th>
            <th scope="col" style="text-align: center">Preço Custo</th>
            <th scope="col" style="text-align: center">Total</th>
        </thead>
        <tbody>
            <?php

            if (($listar_notas) and ($listar_notas->num_rows != 0)) {
                while ($row_usuario = mysqli_fetch_assoc($listar_notas)) {
            ?>
                    <tr>
                        <td style="text-align: center"><?php echo $row_usuario['NUMERO_NOTA_FISCAL']; ?></th>
                        <td style="text-align: center"><?php echo $row_usuario['NOME_PRODUTO']; ?></th>
                        <td style="text-align: center"><?php echo $row_usuario['NOME_FORNECEDOR']; ?></th>
                        <td style="text-align: center"><?php echo $row_usuario['QUANTIDADE']; ?></th>
                        <td style="text-align: center"><?php echo date("d/m/Y", strtotime($row_usuario['DATA_CADASTRO'])); ?></td>
                        <td style="text-align: center"><?php echo str_replace('.', ',', $row_usuario['VALOR_UNITARIO']); ?></th>
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