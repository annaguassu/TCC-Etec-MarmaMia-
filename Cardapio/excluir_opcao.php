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
        <title>MarmaMia - Excluir Opção</title>
    </head>

    <body>
        <div id="container">

            <div id="cardapio">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../Cardapio/cardapio.php">
                        <span></span>
                        Cardápio
                    </a>
                </header>

                <div id="tabelas">

                    <h1>Excluir Opção</h1>

                    <?php
                        include_once('../conexao.php');
                        
                        // recuperando a informação da URL
                        // verifica se parâmetro está correto e dento da normalidade 
                        if(isset($_GET['id_produto']) && is_numeric($_GET['id_produto'])){
                                $id_produto = $_GET['id_produto'];
                        } else {
                            //	header('Location: index.php');
                        }
                        
                        // realizando a pesquisa com o id recebido
                        $query = mysqli_query($conexao,"select * from produtos where id_produto='$id_produto'");

                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        $dados=mysqli_fetch_array($query);
                        
                            
                        mysqli_close($conexao);
                    ?>

                    <form method="post" action="excluir_opcao2.php">

                        <fieldset class="form-group">

                            <div class="field-group">

                                <div class="field">
                                    <label>Códido do Produto:</label>
                                    <input type="text" size="1" name="id_produto" value="<?php echo $dados["id_produto"]; ?>" readonly>
                                </div>
                                
                                <div class="field"> 
                                    <label>Nome:</label>
                                    <input type="text" size="50" name="nome" value="<?php echo $dados["nome"]; ?>" readonly>
                                </div>

                            </div>

                            <div class="field">
                                <label>Descrição:</label>
                                <input type="text" name="descricao" value="<?php echo $dados["descricao"]; ?>" readonly>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Tipo</label>
                                    <input type="text" name="tipo" value="<?php echo $dados["tipo"]; ?>" readonly>
                                </div>
                                
                                <div class="field">
                                    <label>Preço:</label>
                                    <input type="text" name="preco" value="<?php echo $dados["preco"]; ?>" readonly>
                                </div>
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Confirmar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='cardapio.php';" value="Cancelar"><br>
                        </div>

                    </form>
                
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