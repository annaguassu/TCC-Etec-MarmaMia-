<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_fornecedor'])) {  //se não está definido o id do usuario na sessao
        header("location:entrar_fornecedor.php");
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
        <title>MarmaMia - Alterar Senha</title>
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
                        $id_fornecedor=$_SESSION['id_fornecedor'];

                        include_once('../conexao.php');

                        // realizando a pesquisa com o id recebido
                        $query = mysqli_query($conexao,"select * from fornecedores where id_fornecedor='$id_fornecedor'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        $dados=mysqli_fetch_array($query);
                    ?>

                    <form method="post">

                        <h1>Alterar Senha</h1>

                        <fieldset class="form-group">

                            <legend>Dados para Login</legend>

                            <div class="field">
                                <label>E-mail:</label>
                                <input type="email" name="email" size="66" maxlength="40" value="<?php echo $dados["email"]; ?>" readonly>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Nova Senha:</label>
                                    <input type="password" name="novasenha" maxlength="32" required>
                                </div>
                                <div class="field">
                                    <label>Confirmar a Senha:</label>
                                    <input type="password" name="confnovasenha" maxlength="32" required>
                                </div>
                            </div>

                            <div class="field">
                                <label>Senha Atual:</label>
                                <input type="password" name="senha" size="66" maxlength="40" required>
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Confirmar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='../Fornecedor/configuracoes.php';" value="Cancelar"><br>
                        </div>

                    </form>

                    <?php
                        if(isset($_POST['submit']))
                        {
                            $novasenha=$_POST['novasenha'];
                            $confnovasenha=$_POST['confnovasenha'];

                            $novasenhacrip = md5($novasenha);
                            $confnovasenhacrip = md5($confnovasenha);

                            $senha=$_POST['senha'];
                            $senhaconf = md5($senha);

                            $senhabd=$dados['senha'];

                            if (md5($novasenhacrip) == md5($senhabd) && md5($confnovasenhacrip) == md5($senhabd))
                            {
                                ?>
                                <br>
                                <div class="msg_erro">
                                    Essa já é sua senha!
                                </div>
                                <?php
                            }
                            else 
                            {
                                if (md5($novasenhacrip) == md5($confnovasenhacrip))
                                {
                                    if (md5($senhabd) == md5($senhaconf))
                                    {
                                        header("location:alterar_senhaF2.php?novasenhacrip=$novasenhacrip");
                                    }
                                    else
                                    {
                                        ?>
                                        <br>
                                        <div class="msg_erro">
                                            Senha Atual não confere!
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <br>
                                    <div class="msg_erro">
                                        Novas Senhas não conferem!
                                    </div>
                                    <?php
                                }

                            }
                        }

                        mysqli_close($conexao);
                    ?>
                    
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