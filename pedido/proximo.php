<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    
    if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:../Cliente/entrar_cliente.php");
        die();
    }

    if(count($_SESSION['carrinho']) == 0)
    {
        header("location:../Pedido/carrinho.php");
        die();
    }

    require_once "../Funções/product.php";
    require_once "../Funções/cart.php";
    
    $pdoConnection = require_once "connection.php";

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
        <link rel="stylesheet" href="../CSS/styleform.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Finalizar Pedido</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="carrinho.php">
                        <span></span>
                        Carrinho de Compras
                    </a>
                </header> 

                <div id="form">

                    <h1>Finalizar Pedido</h1>

                    <form action="finalizar.php" method="post">

                        <fieldset>

                            <legend>Total</legend>
                            <?php foreach($resultsCarts as $result) : ?>

                                <p><?php echo $result['quantity'].' x '.$result['name'].' = '.'R$'.number_format($result['subtotal'], 2, ',', '.')?></p>
                                
                            <?php endforeach;?>
                            <p><b>Total:</b> R$<?php echo number_format($totalCarts, 2, ',', '.')?></p>

                        </fieldset>

                        <fieldset>

                            <legend>Recebimento</legend>
                            <div class="field">
                                <label>Formas de Entrega:</label>
                                <select name="entrega" required>
                                    <option value="retirar" selected="selected">Retirar no Estabelecimento</option>
                                    <option value="entregar" disabled>Entregar (Em Breve)</option>
                                </select>
                            </div>
                            
                            <?php
                                $id_fornecedor=$result['id_fornecedor'];

                                include_once('../conexao.php');
                                
                                $query = mysqli_query($conexao,"select * from fornecedores where id_fornecedor=$id_fornecedor");

                                if (!$query) 
                                {
                                    die('Query Inválida: ' . @mysqli_error($conexao));  
                                }

                                $dados=mysqli_fetch_array($query);

                                echo "<b>Nome do Estabelecimento: </b>".$dados['nome_fantasia']."<br>";
                                echo "<b>CNPJ: </b>".$dados['cnpj']."<br>";	
                                echo "<b>Telefone: </b>".$dados['telefone']."<br>";
                                echo "<b>Endereço do Estabelecimento: </b>".$dados['logradouro'].", ".$dados['numero'].", ".$dados['complemento'].", "
                                .$dados['bairro'].", ".$dados['cidade'].", ".$dados['cep'].", ".$dados['estado'].'.'."<br>";
                            ?>

                        </fieldset>
                        
                        <fieldset>

                            <legend>Pagamento</legend>
                            <div class="field">
                                <label>Formas de Pagamento:</label>
                                <select name="pagamento" required>
                                    <option value="retirada" selected="selected">Pagar ao Retirar</option>
                                    <option value="cartaocredito" disabled>Cartão de Crédito (Em Breve)</option>
                                </select><br>
                                <p><b>Total:</b> R$<?php echo number_format($totalCarts, 2, ',', '.')?></p>
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button class="btn btn-primary" type="submit">Finalizar</button>
                            <a class="btn btn-primary" style="margin: 0 3px;" href="javascript:window.history.go(-1)">Cancelar</a><br>
                        </div>

                    </form>

                </div>
                
            <div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>
