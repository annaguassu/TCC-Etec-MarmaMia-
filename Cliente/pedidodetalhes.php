<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:entrar_cliente.php");
        die();
    }
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
        <title>MarmaMia - Detalhes do Pedido</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../Cliente/historicopedidos.php">
                        <span></span>
                        Histórico de Pedidos
                    </a>
                </header>

                <div id="form">

                    <h1>Detalhes do Pedido</h1>

                    <?php
                        include_once('../conexao.php');

                        $id_pedido=$_GET['id_pedido'];

                        $query = mysqli_query($conexao,"select * from pedidos_itens where id_pedido=$id_pedido");

                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        echo "<br><h3>Produtos</h3><br>";

                        while($dados=mysqli_fetch_array($query)) 
                        {
                            echo "<b>Código do Produto:</b> ".$dados['id_produto'].'<br>';
                            echo "<b>Produto:</b> ".$dados['nome'].'<br>';
                            echo "<b>Quantidade:</b> ".$dados['quantidade'].'<br>';
                            echo "<b>Preço:</b> R$".number_format($dados['preco'], 2, ',', '.').'<br>';
                            echo "<b>Subtotal:</b> R$".number_format($dados['subtotal'], 2, ',', '.').'<br><br>';

                            $id_fornecedor=$dados['id_fornecedor'];
                        }

                        echo "<br><h3>Estabelecimento</h3><br>";

                        $query2 = mysqli_query($conexao,"select * from fornecedores where id_fornecedor=$id_fornecedor");

                        if (!$query2) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        $dados2=mysqli_fetch_array($query2);

                        echo "<b>Nome Fantasia: </b>".$dados2['nome_fantasia']."<br>";
                        echo "<b>CNPJ: </b>".$dados2['cnpj']."<br>";	
                        echo "<b>Telefone: </b>".$dados2['telefone']."<br>";
        
                        echo "<b>Endereço: </b>".$dados2['logradouro'].", ".$dados2['numero'].", ".$dados2['complemento'].", "
                        .$dados2['bairro'].", ".$dados2['cidade'].", ".$dados2['cep'].", ".$dados2['estado']."."."<br><br>";

                        echo "<br><h3>Pagamento</h3><br>";
                        
                        $query3 = mysqli_query($conexao,"select * from pedidos where id_pedido=$id_pedido");

                        if (!$query3) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        $dados3=mysqli_fetch_array($query3);

                        echo "<b>Total:</b> R$".number_format($dados3['total'], 2, ',', '.').'<br><br>';

                    ?>

                    <hr><br>
                    <div id="botoes">
                        <a href="../Cliente/historicopedidos.php">Histórico de Pedidos</a>
                    </div>

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