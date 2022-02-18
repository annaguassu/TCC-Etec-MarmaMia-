<?php 
	session_start();

	//verificando se a sessao existe e evitando acesso indevido.
	if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:../Cliente/entrar_cliente.php");
        die();
    }

	require_once "../Funções/product.php";
	require_once "../Funções/cart.php";

	$pdoConnection = require_once "connection.php";

	if(isset($_GET['acao']) && in_array($_GET['acao'], array('add', 'del', 'up'))) {
		
		if($_GET['acao'] == 'add' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
			addCart($_GET['id'], 1);			
		}

		if($_GET['acao'] == 'del' && isset($_GET['id']) && preg_match("/^[0-9]+$/", $_GET['id'])){ 
			deleteCart($_GET['id']);
		}

		if($_GET['acao'] == 'up'){ 
			if(isset($_POST['prod']) && is_array($_POST['prod'])){ 
				foreach($_POST['prod'] as $id => $qtd){
						updateCart($id, $qtd);
				}
			}
		}

		header('location: carrinho.php');
	}

	$resultsCarts = getContentCart($pdoConnection);
	$totalCarts  = getTotalCart($pdoConnection);
?>
<!doctype html>
<html lang="pt-br">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/stylecarrinho.css">

		<link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Carrinho</title>
    </head>

    <body>
        <div div="container">

			<div id="carrinho">

				<header>
					<a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
					<a href="../Cliente/escolher_fornecedor?cidade=.php">
						<span></span>
						Encontrar Fornecedor
					</a>
				</header>
			
				<div id="titulo">
					<h1>Carrinho de Compras</h1>
					<a id="lista" href="../Cliente/escolher_fornecedor?cidade=.php">Lista de Produtos</a>
				</div>

				<?php if($resultsCarts) : ?>

					<form action="carrinho.php?acao=up" method="post">

						<table class="table table-strip">
							<thead>
								<tr>
									<th>Produto</th>
									<th>Quantidade</th>
									<th>Preço</th>
									<th>Subtotal</th>
									<th>Ação</th>

								</tr>				
							</thead>

							<tbody>
								<?php foreach($resultsCarts as $result) : ?>

									<tr>

										<td><?php echo $result['name']?></td>
										<td>
											<input type="number" min="1" max="5" step="1" name="prod[<?php echo $result['id']?>]" value="<?php echo $result['quantity']?>" size="1" />							
										</td>
										<td>R$<?php echo number_format($result['price'], 2, ',', '.')?></td>
										<td>R$<?php echo number_format($result['subtotal'], 2, ',', '.')?></td>
										<td><a href="carrinho.php?acao=del&id=<?php echo $result['id']?>" class="btn btn-danger">Remover</a></td>
										
									</tr>
									
								<?php endforeach;?>
								<tr>
									<td colspan="3" class="text-right"><b>Total: </b></td>
									<td>R$<?php echo number_format($totalCarts, 2, ',', '.')?></td>
									<td></td>
								</tr>
							</tbody>
							
						</table>

						<div id="botoes">
							<div>
								<a class="btn btn-info" href="javascript:window.history.go(-1)">Continuar Comprando</a>
								<button class="btn btn-primary" type="submit">Atualizar Carrinho</button>
							</div>
							<div>
								<a id="proximo" class="btn btn-success" href="proximo.php">Finalizar</a>
							</div>
						</div>

					</form><br>

				<?php endif?>

			</div>
			
		</div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>
