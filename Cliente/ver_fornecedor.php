<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:../Cliente/entrar_cliente.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styleverfornecedor.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Fornecedor e Cardápio</title>
    </head>

    <body>
        <div id="container">

            <div id="verfornecedor-page">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="escolher_fornecedor.php?cidade=">
                        <span></span>
                        Encontrar Fornecedor
                    </a>
                </header>

                <div id="cardapio">

                    <h1>Fornecedor e Cardápio</h1><br>

                    <?php

                        include_once('../conexao.php');

                        //Recuperando a informação da URL
                        //Verificar se o parâmetro está correto e dento da normalidade 
                        if(isset($_GET['id_fornecedor']) && is_numeric($_GET['id_fornecedor']))
                        {
                            $id_fornecedor = $_GET['id_fornecedor'];
                        } 
                        else 
                        {
                            header('Location: index.php');
                        }

                        //Realizando a pesquisa com o id recebido
                        $query = mysqli_query($conexao,"select * from fornecedores where id_fornecedor=$id_fornecedor");

                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        $dados=mysqli_fetch_array($query);
                        
                        echo "<table id='foto'; border='1px'><tr><td width='200px';>";

                            if (empty($dados['logo_fornecedor'])){
                                $imagem = 'SemImagem.png';
                            }
                            else{
                                $imagem = $dados['logo_fornecedor'];
                            }

                            echo "<img src='../Imagens/$imagem' >";
                            echo "</td><td id='perfil'; width='400px';>";

                            echo "<b>Nome Fantasia: </b>".$dados['nome_fantasia']."<br>";
                            echo "<b>CNPJ: </b>".$dados['cnpj']."<br>";	
                            echo "<b>Telefone: </b>".$dados['telefone']."<br>";

                            echo "<b>Endereço: </b>".$dados['logradouro'].", ".$dados['numero'].", ".$dados['complemento'].", "
                            .$dados['bairro'].", ".$dados['cidade'].", ".$dados['cep'].", ".$dados['estado']."."."<br>";

                        echo "</td></tr></table><br>";
                    ?>

                    <div id="carrinho">
                        <a href="../Pedido/carrinho.php"><img src="../Imagens/carrinho.png" alt="Carrinho" style="width: 50px; height: 50px;"></a>
                        <a href="../Pedido/carrinho.php"><span style="color: blue;">Carrinho (<?php 
                        if (!isset($_SESSION['carrinho']))
                        {
                            echo "0";
                        }
                        else
                        {
                            echo count($_SESSION['carrinho']);
                        }
                        ?>)</span></a>
                    </div><br>

                    <?php
                                
                        // ajustando a instrução select para ordenar por produto
                        $query = mysqli_query($conexao,"select * from produtos where id_fornecedor='$id_fornecedor' and tipo='Prato Pronto'");

                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        // Cria uma tabela com os campos do banco de dados
                        echo "<table border='1px'; border-color='white';>";
                
                            echo "<tr>
                            
                                <thead>
                                    <tr><td colspan=6><h3>Pratos Prontos</h3></td></tr>
                                </thead>
                                <th>Código</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Preço</th>
                                <th>Selecionar</th>
                
                            </tr>";
                
                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td align='center'>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];
                
                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a style='margin: 0 3px;' type='submit' name='submit' class='btn btn-primary' href='../Pedido/carrinho.php?acao=add&id=$id_produto&id_fornecedor=$id_fornecedor'>Selecionar</a></td>";
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
                                <th>Selecionar</th>

                            </tr>";

                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td align='center'>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];

                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a style='margin: 0 3px;' type='submit' name='submit' class='btn btn-primary' href='../Pedido/carrinho.php?acao=add&id=$id_produto&id_fornecedor=$id_fornecedor'>Selecionar</a></td>";
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
                                <th>Selecionar</th>

                            </tr>";

                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td align='center'>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];

                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a style='margin: 0 3px;' type='submit' name='submit' class='btn btn-primary' href='../Pedido/carrinho.php?acao=add&id=$id_produto&id_fornecedor=$id_fornecedor'>Selecionar</a></td>";
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
                                <th>Selecionar</th>

                            </tr>";

                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td align='center'>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];

                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a style='margin: 0 3px;' type='submit' name='submit' class='btn btn-primary' href='../Pedido/carrinho.php?acao=add&id=$id_produto&id_fornecedor=$id_fornecedor'>Selecionar</a></td>";
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
                                <th>Selecionar</th>

                            </tr>";

                            //A função mysqli_fetch_array(), retorna uma matriz que corresponde a linha obtida e move o ponteiro interno dos dados adiante. 
                            //Exemplo: $dados=mysqli_fetch_array($query);
                            //O acesso ao valor do campo será realizado da seguinte forma: $dados['id'] $dados['codigo'] $dados['produto'
                            while($dados=mysqli_fetch_array($query)) 
                            {
                                echo "<tr>";
                                echo "<td>". $dados['id_produto']."</td>";
                                echo "<td align='center'>". $dados['nome']."</td>";
                                echo "<td>". $dados['descricao']."</td>";
                                echo "<td>". 'R$'.number_format($dados['preco'], 2, ',', '.')."</td>";
                                
                                //Protegendo os dados da URL com Base64
                                $id_produto = $dados['id_produto'];

                                // chama uma outra página com o código que foi escolhido nessa página.
                                echo "<td align='center'><a style='margin: 0 3px;' type='submit' name='submit' class='btn btn-primary' href='../Pedido/carrinho.php?acao=add&id=$id_produto&id_fornecedor=$id_fornecedor'>Selecionar</a></td>";
                                echo "</tr>";
                            }

                        echo "</table>";

                        mysqli_close($conexao);

                    ?><br>

                    <hr><br>
                    <a href="escolher_fornecedor.php?cidade=" id="voltar">Encontrar Fornecedor</a>

                </div>

            </div>

        </div>

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>