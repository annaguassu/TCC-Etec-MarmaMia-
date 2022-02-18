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
        <title>MarmaMia - Alterar Dados</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="configuracoes.php">
                        <span></span>
                        Configurações
                    </a>
                </header>

                <div id="form">

                    <?php
                        $id_cliente=$_SESSION['id_cliente'];

                        include_once('../conexao.php');

                        // realizando a pesquisa com o id recebido
                        $query = mysqli_query($conexao,"select * from clientes where id_cliente='$id_cliente'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        $dados=mysqli_fetch_array($query);
                            
                        mysqli_close($conexao);
                    ?>

                    <form method="POST" action="alterar_dadosC2.php">

                        <h1>Configurações - Alterar Dados</h1>

                        <fieldset class="form-group">

                            <legend>Dados do Cliente</legend>

                            <div class="field">
                                <input type="hidden" name="id_cliente" value="<?php echo $dados["id_cliente"]; ?>" readonly>
                                <label>Nome do Clinte:</label>
                                <input type="text" name="nome" maxlength="30" value="<?php echo $dados["nome"]; ?>">
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CPF:</label>
                                    <input type="text" name="cpf" maxlength="14" maxlength="11" value="<?php echo $dados["cpf"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Telefone:</label>
                                    <input type="text" name="telefone" maxlength="16" value="<?php echo $dados["telefone"]; ?>">
                                </div>
                            </div>

                        </fieldset>
                        
                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" class="btn btn-primary">Confirmar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='../Cliente/configuracoes.php';" value="Cancelar">
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