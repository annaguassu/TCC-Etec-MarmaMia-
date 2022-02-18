<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_fornecedor'])) {  //se não está definido o id do usuario na sessao
        header("location:../Fornecedor/entrar_fornecedor.php");
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
        <link rel="stylesheet" href="../CSS/stylecardapio.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Meu Cardápio</title>
    </head>

    <body>
        <div id="container">

            <div id="cardapio">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../Fornecedor/areaprivada_fornecedor.php">
                        <span></span>
                        Página Inicial
                    </a>
                </header>

                <div id="tabelas">

                    <h1>Meu Cardápio</h1>

                    <div class="a">
                        <a href="add_opcao.php"><img src="../Imagens/adicionar.png" alt="Adicionar Opção" style="width: 30px; height: 30px;"></a><br><br>
                        <a href="add_opcao.php"><span>Adicionar Opção</span></a>
                    </div><br>
                    
                    <?php
                        $id_fornecedor = $_SESSION['id_fornecedor'];

                        include_once('../conexao.php');

                        echo"";
                    
                        // ajustando a instrução select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Prato Pronto'");
            
                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        // Cria uma tabela com os campos do banco de dados
                        echo "<table border='1px' align='center' border-color='white'>";
                
                            echo "<tr>

                                <thead>
                                    <tr><td colspan=6><h3>Pratos Prontos</h3></td></tr>
                                </thead>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a href='alterar_opcao.php?id_produto=$id_produto'><img src='../Imagens/alterar.png' width='30px' heigth='30px'></a></td>";
                                echo "<td align='center'><a href='excluir_opcao.php?id_produto=$id_produto'><img src='../Imagens/excluir.png' width='30px' heigth='30px'></a></td>";
                                echo "</tr>";
                            }
                        
                            // ajustando a instrução select para ordenar por produto
                            $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Marmita'");
                
                            if (!$query) 
                            {
                                die('Query Inválida: ' . @mysqli_error($conexao));  
                            }

                            // Cria uma tabela com os campos do banco de dados
                            
                    
                            echo "<tr>

                                <thead>
                                    <tr><td colspan=6><h3>Marmitas</h3></td></tr>
                                </thead>                                
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>".'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a href='alterar_opcao.php?id_produto=$id_produto'><img src='../Imagens/alterar.png' width='30px' heigth='30px'></a></td>";
                                echo "<td align='center'><a href='excluir_opcao.php?id_produto=$id_produto'><img src='../Imagens/excluir.png' width='30px' heigth='30px'></a></td>";
                                echo "</tr>";
                            }
                        
                            // ajustando a instrução select para ordenar por produto
                            $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Sobremesa'");
                
                            if (!$query) 
                            {
                                die('Query Inválida: ' . @mysqli_error($conexao));  
                            }

                            // Cria uma tabela com os campos do banco de dados
                            
                            echo "<tr>
                            
                                <thead>
                                    <tr><td colspan=6><h3>Sobremesas</h3></td></tr>
                                </thead>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a href='alterar_opcao.php?id_produto=$id_produto'><img src='../Imagens/alterar.png' width='30px' heigth='30px'></a></td>";
                                echo "<td align='center'><a href='excluir_opcao.php?id_produto=$id_produto'><img src='../Imagens/excluir.png' width='30px' heigth='30px'></a></td>";
                                echo "</tr>";
                            }
                        
                            // ajustando a instrução select para ordenar por produto
                            $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Bebida'");
                
                            if (!$query) 
                            {
                                die('Query Inválida: ' . @mysqli_error($conexao));  
                            }

                            // Cria uma tabela com os campos do banco de dados
                            
                            echo "<tr>
                            
                                <thead>
                                    <tr><td colspan=6><h3>Bebidas</h3></td></tr>
                                </thead>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a href='alterar_opcao.php?id_produto=$id_produto'><img src='../Imagens/alterar.png' width='30px' heigth='30px'></a></td>";
                                echo "<td align='center'><a href='excluir_opcao.php?id_produto=$id_produto'><img src='../Imagens/excluir.png' width='30px' heigth='30px'></a></td>";
                                echo "</tr>";
                            }
                        
                            // ajustando a instrução select para ordenar por produto
                            $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Adicional'");
                
                            if (!$query) 
                            {
                                die('Query Inválida: ' . @mysqli_error($conexao));  
                            }

                            // Cria uma tabela com os campos do banco de dados
                    
                            echo "<tr>
                            
                                <thead>
                                    <tr><td colspan=6><h3>Adicionais</h3></td></tr>
                                </thead>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Alterar</th>
                                <th>Excluir</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a href='alterar_opcao.php?id_produto=$id_produto'><img src='../Imagens/alterar.png' width='30px' heigth='30px'></a></td>";
                                echo "<td align='center'><a href='excluir_opcao.php?id_produto=$id_produto'><img src='../Imagens/excluir.png' width='30px' heigth='30px'></a></td>";
                                echo "</tr>";
                            }

                        echo "</table>";
                        
                        mysqli_close($conexao);
                    ?><br>

                    <hr><br>
                    <div class="a">
                        <a href="../Fornecedor/areaprivada_fornecedor.php" id="voltar">Página Inicial</a>
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