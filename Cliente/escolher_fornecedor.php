<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:../Cliente/entrar_cliente.php");
        die();
    }

    // if (isset($_SESSION['carrinho'])) {  //se está definido o carrinho na sessao
    //     unset($_SESSION['carrinho']); //destruindo a sessao
    // }
?>
<html lang="pt-br">

    <head>
       <!-- Meta tags Obrigatórias -->
       <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styleescolha.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Encontre um Fornecedor</title>
    </head>

    <body>
        <div id="container">

            <div id="escolher-fornecedor">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="areaprivada_cliente.php">
                        <span></span>
                        Página Inicial
                    </a>
                </header>

                <h1>Encontre um Fornecedor</h1>

                <form method="get" action=""> 

                    <!-- <label>Selecione uma Cidade: </label> -->
                    <select style="margin: 0 5px 0 0;" name="cidade" required>
                        <option value="" selected="selected" disabled>Selecione uma Cidade</option>
                        <option value="Dobrada">Dobrada/SP</option>
                        <option value="Matão">Matão/SP</option>
                        <option value="Santa Ernestina">Santa Ernestina/SP</option>
                        <option value="Taquaritinga">Taquaritinga/SP</option>
                    </select>
                    <button class="btn btn-primary">Selecionar</button>

                </form><br>

                <?php

                    $cidade = $_GET['cidade'];

                    include_once('../conexao.php');

                    //Ajustando a instrução select para ordenar por produto
                    $query = mysqli_query($conexao,"select * from fornecedores where cidade='$cidade' order by nome_fantasia");

                    if (!$query) 
                    {
                        die('Query Inválida: ' . @mysqli_error($conexao));  
                    }
                    
                    echo "<div class='items-grid'>";

                        while($dados=mysqli_fetch_array($query)) 
                        {

                            if (empty($dados['logo_fornecedor'])){
                                $imagem = 'SemImagem.png';
                            }else{
                                $imagem = $dados['logo_fornecedor'];
                            }
                            
                            //Protegendo os dados da URL com Base64
                            $id_fornecedor = $dados['id_fornecedor'];
                            
                            echo "<li>";
                                echo "<a href='ver_fornecedor.php?id_fornecedor=$id_fornecedor'> <img src='../Imagens/$imagem' alt='Logo do Fornecedor' width='200px' height='110px'></a>";
                                echo "<a href='ver_fornecedor.php?id_fornecedor=$id_fornecedor'> <span>".$dados['nome_fantasia']."<br>".$dados['cidade'].', '.$dados['estado']."</span></a>";
                            echo "</li>";

                        }

                    echo "</div>";
                    
                    mysqli_close($conexao);
                    
                ?>

            </div>

        </div>

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>