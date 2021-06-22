<?php
session_start();
if (isset($_SESSION['sessaoUsuario'])) {
} else {
	header("Location: ../View/login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<title>R&A - Caixa</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/tela_vendas.css">
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://kit.fontawesome.com/b23ac4bed7.js" crossorigin="anonymous"></script>


</head>

<body>

	<!-- Cabeçalho -->


	<!-- Formulário de Cadastro -->

	<div class="container-fluid">
		<div class="row">
			<?php include_once('menuLateral/menu_lateral.php'); ?>
			<main id="main" class="container-fluid">
				<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
					<h1 class="h2">Caixa</h1>
					<div class="btn-toolbar mb-2 mb-md-0">
						<div class="dropleft">
							<button class="btn btn-danger dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<?php print $_SESSION['nomeUsuario']; ?> &nbsp; <i class="fas fa-sign-out-alt"></i>
							</button>
							<?php
							if (isset($_SESSION['sessaoUsuario']) && $_SESSION['sessaoUsuario'] == 'Administrador') {
								echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
								echo '<a class="dropdown-item" href="cadastrar_usuario.php">Cadastrar Usuários</a>';
								echo '<a class="dropdown-item" href="backup.php">Backup</a>';
								echo '<a class="dropdown-item" href="#">Alterar Senha</a>';
								echo '<div class="dropdown-divider"></div>';
								echo '<a class="dropdown-item" href="logout.php">Sair</a>';
								echo '</div>';
								echo '</div>';
							} else {
								echo '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
								echo '<a class="dropdown-item" href="#">Alterar Senha</a>';
								echo '<a class="dropdown-item" href="logout.php">Sair</a>';
								echo '</div>';
								echo '</div>';
							}
							?>



						</div>
					</div>

					<div id="validacao">

						<?php

						if (isset($_SESSION['venda_cadastrada'])) {
							echo "<div class = 'alert alert-success fade show' role= 'alert'><h5>Venda <strong>Cadastrada</strong> !</h5></div>";
							unset($_SESSION['venda_cadastrada']);
						} else if (isset($_SESSION['venda_editada'])) {
							echo "<div class = 'alert alert-warning fade show' role= 'alert'><h5>Venda <strong>Editada</strong> !</h5></div>";
							unset($_SESSION['venda_editada']);
						} else if (isset($_SESSION['editar_negado'])) {
							print $_SESSION['editar_negado'];
							unset($_SESSION['editar_negado']);
						} else if (isset($_SESSION['venda_excluida'])) {
							echo "<div class = 'alert alert-danger fade show' role= 'alert'><h5>Venda <strong>Excluida</strong> !</h5></div>";
							unset($_SESSION['venda_excluida']);
						} else if (isset($_SESSION['excluir_negado'])) {
							print $_SESSION['excluir_negado'];
							unset($_SESSION['excluir_negado']);
						}
						?>
					</div>

					<form action="../Modal/inserir_produto.php" method="post" id="formulario_form">

						<div class="row">
							<div class="col-3">
								<label><strong>Nome Produto</strong></label>
								<input type="text" class="form-control" name="nome_produto" >
							</div>
							<div class="col-1">
								<label><strong>Pesquisar</strong></label>
								<button class="btn btn-secondary " data-toggle="modal" data-target="#pesquisar_produtos" style="width: 100%;">&nbsp;<i class="fas fa-search"></i></button>
							</div>
							<div class="col-4">
								<label><strong>Custo</strong></label>
								<input type="text" class="form-control" name="preco_custo" >
							</div>

							<div class="col-4">
								<label><strong>Preço de Venda</strong></label>
								<input type="text" class="form-control" name="preco_produto" >
							</div>

						</div>
						<br>
						<div class="row">
							<div class="col-6">
								<label><strong>Quantidade</strong></label>
								<select class="form-control" name="quantidade">
									<option>1</option>
									<option>2</option>
									<option>3</option>
									<option>4</option>
									<option>5</option>
								</select>
							</div>

							<div class="col-4">
								<strong><label>Forma de Pagamento</label></strong>
								<select class="form-control" name="forma_pagamento">
									<option>Dinheiro</option>
									<option>Cartão de Crédito</option>
								</select>
							</div>

							<div class="col-2">
								<button type="submit" name="cadastrar" id="cadastrar" class="btn btn-info">Cadastrar &nbsp;<i class="fas fa-plus"></i></button>
							</div>
						</div>
					</form>
					<br>

					<!-- Listar Produtos vendidos -->

					<div id="container_listar">
						<h3 class="text-center">Vendas Realizadas</h3>
						<br>
						<table class="table table-hover table-borderless">
							<thead>
								<th scope="col">#</th>
								<th scope="col">Nome Produto</th>
								<th scope="col">Custo</th>
								<th scope="col">Preço</th>
								<th scope="col">Quantidade</th>
								<th scope="col">Forma de Pagamento</th>
								<th scope="col">Editar</th>
								<th scope="col">Excluir</th>
							</thead>

							<?php
							include '..\Modal\conexao_banco.php';
							$sql = "SELECT ID_PRODUTO, NOME_PRODUTO, PRECO_CUSTO, PRECO_PRODUTO, QUANTIDADE, FORMA_PAGAMENTO from ESTOQUE where DATA = date(now()) order by ID_PRODUTO DESC";
							$busca = mysqli_query($conexao_banco, $sql);



							while ($linha = mysqli_fetch_array($busca)) {



								$ID_PRODUTO = $linha['ID_PRODUTO'];
								$NOME_PRODUTO = $linha['NOME_PRODUTO'];
								$PRECO_CUSTO = $linha['PRECO_CUSTO'];
								$PRECO_PRODUTO = $linha['PRECO_PRODUTO'];
								$QUANTIDADE = $linha['QUANTIDADE'];
								$FORMA_PAGAMENTO = $linha['FORMA_PAGAMENTO'];
							?>

								<tr>
									<td><?php echo $ID_PRODUTO ?></td>
									<td><?php echo $NOME_PRODUTO ?></td>
									<td><?php echo $PRECO_CUSTO = number_format($PRECO_CUSTO, 2, ',', '.'); ?></td>
									<td><?php echo $PRECO_PRODUTO = number_format($PRECO_PRODUTO, 2, ',', '.'); ?></td>
									<td><?php echo $QUANTIDADE ?></td>
									<td><?php echo $FORMA_PAGAMENTO ?></td>
									<td><a class="btn btn-warning" data-toggle="modal" data-target="#modal_editar" data-whatever_id="<?php echo $ID_PRODUTO ?>" data-whatever_nome="<?php echo $NOME_PRODUTO ?>" data-whatever_custo="<?php echo $PRECO_CUSTO ?>" data-whatever_preco="<?php echo $PRECO_PRODUTO ?>" data-whatever_quantidade="<?php echo $QUANTIDADE ?>" data-whatever_pagamento="<?php echo $FORMA_PAGAMENTO ?>" style="color: #fff" href="" role="button"><i class="fas fa-pen-square"></i>
										</a>
									</td>
									<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_excluir" data-whatever_id_excluir="<?php echo $ID_PRODUTO ?>" style="color: #fff" href="" role="button"><i class="far fa-trash-alt"></i></td>
								</tr>
							<?php
							}

							?>

						</table>
					</div>
				</div>
			</main>
		</div>
	</div>









	<!-- Modal_Excluir -->

	<div class="modal fade" id="modal_excluir">
		<div class="modal-dialog modal-dialog-centered ">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #dc3545">
					<h4 class="modal-title" style="color: #fff">Excluir</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="../Modal/excluir_produto.php">
						<input type="hidden" name="id_produto" id="id_produto_excluir">
						<h5>Tem certeza ?</h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="color: black">Não</button>
					<button type="submit" class="btn btn-danger" style="color: #fff">Sim</button>
				</div>
				</form>
			</div>
		</div>
	</div>





	<!-- Modal_Editar -->

	<div class="modal fade" id="modal_editar">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #ffc107">
					<h4 class="modal-title">Editar Produto</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="POST" action="../Modal/editar_produto.php">
						<div class="form">
							<div class="row">
								<div class="col col-6">
									<input type="hidden" name="id_produto" id="recipient_id">
									<label><strong>Nome Produto</strong></label>
									<input type="text" class="form-control" id="recipient_nome" name="nome_produto" required>
								</div>
								<div class="col">
									<label><strong>Custo</strong></label>
									<input type="text" class="form-control" id="recipient_custo" name="preco_custo" required>
								</div>
								<div class="col">
									<label><strong>Preço de Venda</strong></label>
									<input type="text" class="form-control" id="recipient_preco" name="preco_produto" required>
								</div>
							</div>
							<div class="row">
								<div class="col" style="padding-top: 20px">
									<label><strong>Quantidade</strong></label>
									<select class="form-control" id="recipient_quantidade" name="quantidade">
										<option>1</option>
										<option>2</option>
										<option>3</option>
										<option>4</option>
										<option>5</option>
									</select>
								</div>

								<div class="col form-group" style="padding-top: 20px">
									<label><strong>Forma de Pagamento</strong></label>
									<select class="form-control" id="recipient_pagamento" name="forma_pagamento">
										<option>Dinheiro</option>
										<option>Cartão de Crédito</option>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-outline-secondary" data-dismiss="modal" style="color: black">Cancelar</button>
							<button type="submit" class="btn btn-warning" style="color: black">Confirmar</button>
						</div>
					</form>
				</div>

			</div>
		</div>
	</div>

	<!-- Pesquisar produtos -->
	<div class="modal fade " id="pesquisar_produtos" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="TituloModalCentralizado">Pesquisar Produtos</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
				<h6>Aqui é para listar todos os produtos que estão no estoque para ser vendido</h6>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
					<!-- <button type="button" class="btn btn-info">Escolher</button> -->
				</div>
			</div>
		</div>
	</div>





	<!-- Rodapé -->

	<footer style="height: 100px"></footer>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

	<!-- Script_Editar -->

	<script type="text/javascript">
		$('#modal_editar').on('show.bs.modal', function(event) {

			var button = $(event.relatedTarget) // Botão que acionou o modal
			var recipient_id = button.data('whatever_id') // Extrair informações de dados * atributos
			var recipient_nome = button.data('whatever_nome')
			var recipient_custo = button.data('whatever_custo')
			var recipient_preco = button.data('whatever_preco')
			var recipient_quantidade = button.data('whatever_quantidade')
			var recipient_pagamento = button.data('whatever_pagamento')

			var modal = $(this)
			modal.find('.modal-title').text('Editar')
			modal.find('#recipient_id').val(recipient_id)
			modal.find('#recipient_nome').val(recipient_nome)
			modal.find('#recipient_custo').val(recipient_custo)
			modal.find('#recipient_preco').val(recipient_preco)
			modal.find('#recipient_quantidade').val(recipient_quantidade)
			modal.find('#recipient_pagamento').val(recipient_pagamento)
		})
	</script>

	<!-- Script Excluir -->

	<script type="text/javascript">
		$('#modal_excluir').on('show.bs.modal', function(event) {

			var button = $(event.relatedTarget) // Botão que acionou o modal
			var recipient_id_excluir = button.data(
				'whatever_id_excluir') // Extrair informações de dados * atributos

			var modal = $(this)
			modal.find('#id_produto_excluir').val(recipient_id_excluir)

		})
	</script>

	<script>
		$(document).ready(function() {
			$("#validacao").mouseout(function() {
				$(".alert").fadeOut("slow");
			});
		});
	</script>

</body>

</html>