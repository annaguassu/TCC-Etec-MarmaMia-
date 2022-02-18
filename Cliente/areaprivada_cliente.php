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
        <link rel="stylesheet" href="../CSS/stylearea.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Área Privada do Cliente</title>
    </head>

    <body>
        <div id="container">

            <div id="areaprivada">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../index.html">
                        <span></span>
                        MarmaMia
                    </a>
                </header>

                <h1>Área Privada do Cliente</h1>

                <?php

                    $id_cliente = $_SESSION['id_cliente'];

                    include_once('../conexao.php');

                    //Ajustando a instrução select para ordenar por produto
                    $query = mysqli_query($conexao,"select * from clientes where id_cliente='$id_cliente'");

                    if (!$query) 
                    {
                        die('Query Inválida: ' . @mysqli_error($conexao));  
                    }

                    while($dados=mysqli_fetch_array($query)) 
                    {
                        echo "<div id='usuario'>";
                            echo "<h5>Olá, ".$dados['nome'].".</h5>";
                        echo "</div>";
                    }

                    mysqli_close($conexao);

                ?>

                <div class="items-grid">
                    <li>
                        <a href="../Cliente/escolher_fornecedor.php?cidade="><img src="../Imagens/mapa.jpg" alt="Encontrar Fornecedor" style="width: 500px; height: 200px;"></a>
                        <a href="../Cliente/escolher_fornecedor.php?cidade="><span>Encontrar Fornecedor</span></a>
                    </li>
                    <li>
                        <a href="historicopedidos.php"><img src="../Imagens/cesta.jpg" alt="Histórico de Pedidos" style="width: 500px; height: 200px;"></a>
                        <a href="historicopedidos.php"><span>Histórico de Pedidos</span></a>
                    </li>
                </div>

                <div id="foot">

                    <div id="configuracao">
                        <a href="../Cliente/configuracoes.php"><img src="../Imagens/configurar.png" alt="Configurações" style="width:30px; height:30px;"></a>
                        <a href="../Cliente/configuracoes.php"><span>Configurações</span></a>
                    </div>
                    <div id="sair">
                        <a href='sair_cliente.php' class='btn btn-primary'>Sair</a>
                    </div>
                    
                </div>
                
            </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>