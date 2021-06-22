<!-- <?php
        session_start();
        if (isset($_SESSION['sessaoUsuario'])) {
            print $_SESSION['sessaoUsuario'];
            print $_SESSION['idUsuario'];
        } else {
            header("Location: ../View/login.php");
        }
        ?> -->
<!DOCTYPE html>
<html pt-br>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/b23ac4bed7.js" crossorigin="anonymous"></script>
    <title>R&A - Dashboard</title>
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>


<body>
    <div class="container-fluid">
        <div class="row">
            <?php include_once('menuLateral/menu_lateral.php') ?>
            <main class="container-fluid" style="margin-left: 90px;">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">       

                        <div class="dropleft">
                           <?php include_once('menuLateral/modal_alterar_senha.php'); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <div class="card rounded shadow rounded" style="border-left: 5px solid #dc3545;">
                                <div class="card-body">
                                    <h5 class="card-title">Vendas de Hoje</h5>
                                    <h4 id="vendas_hoje"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card rounded shadow rounded" style="border-left: 5px solid #17a2b8;">
                                <div class="card-body">
                                    <h5 class="card-title">Investimentos</h5>
                                    <h4 id="investimento"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card rounded shadow rounded" style="border-left: 5px solid #28a745;">
                                <div class="card-body">
                                    <h5 class="card-title">Produtos</h5>
                                    <h4 id="total_produtos"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card rounded shadow rounded" style="border-left: 5px solid #ffc107;">
                                <div class="card-body">
                                    <h5 class="card-title">Elaborar</h5>
                                    <h4>######</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <canvas class="my-4 w-100 chartjs-render-monitor" id="myChart_1" width="700" height="244"></canvas>

                    <h2 class="text-center" style="padding-top: 10px; padding-bottom: 10px">Vendas de Hoje</h2>
                    <div class="container-fluid">

                        <table class="table table-hover table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col">Nome Produto</th>
                                    <th scope="col" style="text-align: center">Custo</th>
                                    <th scope="col" style="text-align: center">Preço</th>
                                    <th scope="col" style="text-align: center">Quantidade</th>
                                    <th scope="col" style="text-align: center">Forma de Pagamento</th>
                                </tr>
                            </thead>

                            <?php
                            include_once '..\Modal\conexao_banco.php';

                            $sql = "SELECT ID_PRODUTO, NOME_PRODUTO, PRECO_CUSTO, PRECO_PRODUTO, QUANTIDADE, FORMA_PAGAMENTO from ESTOQUE where DATA = date(now()) order by ID_PRODUTO DESC";

                            $busca = mysqli_query($conexao_banco, $sql);

                            while ($linha = mysqli_fetch_array($busca)) {
                                $NOME_PRODUTO = $linha['NOME_PRODUTO'];
                                $PRECO_CUSTO = $linha['PRECO_CUSTO'];
                                $PRECO_PRODUTO = $linha['PRECO_PRODUTO'];
                                $QUANTIDADE = $linha['QUANTIDADE'];
                                $FORMA_PAGAMENTO = $linha['FORMA_PAGAMENTO'];
                            ?>

                                <tr>
                                    <td><?php echo $NOME_PRODUTO ?></td>
                                    <td style="text-align: center"><?php echo $PRECO_CUSTO = number_format($PRECO_CUSTO, 2, ',', '.'); ?></td>
                                    <td style="text-align: center"><?php echo $PRECO_PRODUTO = number_format($PRECO_PRODUTO, 2, ',', '.'); ?></td>
                                    <td style="text-align: center"><?php echo $QUANTIDADE ?></td>
                                    <td style="text-align: center"><?php echo $FORMA_PAGAMENTO ?></td>

                                </tr>
                            <?php
                            }
                            ?>

                        </table>

                    </div>

                    <h2 class="text-center" style="padding-top: 10px; padding-bottom: 10px">Produtos Cadastrados Hoje</h2>
                    <div class="container-fluid" style="padding-top: 10px;">
                        <?php $listar_notas = mysqli_query($conexao_banco, "SELECT * FROM PRODUTOS_NOTA_FISCAL WHERE DATA_EMISSAO = date(now());"); ?>
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
                                while ($row_usuario = mysqli_fetch_assoc($listar_notas)) {
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
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <footer style="height: 50px;"></footer>

    <script src="../Controller/Controller_vendas_hoje.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js " integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49 " crossorigin="anonymous "></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js " integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy " crossorigin="anonymous "></script>


    <!-- Gráficos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById('myChart_1').getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                datasets: [{
                    label: 'Vendas',
                    data: [12, 19, 8, 5, 4, 3, 12, 16, 3, 5, 2, 3],
                    backgroundColor: [
                        '#FF6347', '#FFA500', '#DAA520', '#EEE8AA', '#9ACD32', '#6B8E23', '#006400', '#228B22', '#8FBC8F', '#2E8B57', '#008B8B', '#7FFFD4',
                    ],
                    borderWidth: 4
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>


</body>

</html>