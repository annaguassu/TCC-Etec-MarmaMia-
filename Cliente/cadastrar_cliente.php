<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (isset($_SESSION['id_cliente'])) {  //se não está definido o id do usuario na sessao
        header("location:areaprivada_cliente.php");
        die();
    }

    require_once '../Classes/clientes.php';
    $u = new Cliente;

    ob_start();
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
        <title>MarmaMia - Seja um Cliente</title>
    </head>

    <body>
        <div id="container">
    
            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../index.html">
                        <span></span>
                        MarmaMia
                    </a>
                </header>

                <div id="form">

                    <form method="POST">

                        <h1>Seja um Cliente - Cadastre-se</h1>

                        <fieldset class="form-group">

                            <legend>Dados do Cliente</legend>

                            <div class="field">
                                <label>Nome do Cliente:</label>
                                <input type="text" name="nome" maxlength="30" required>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CPF:</label>
                                    <input type="text" name="cpf" maxlength="14" maxlength="11" required>
                                </div>
                                <div class="field">
                                    <label>Telefone:</label>
                                    <input type="text" name="telefone" maxlength="16" required>
                                </div>
                            </div> 

                        </fieldset>

                        <fieldset class="form-group">

                            <legend>Dados para Login</legend>

                            <div class="field">
                                <label>E-mail:</label>
                                <input type="email" name="email" size="66" maxlength="40" required>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Senha:</label>
                                    <input type="password" name="senha" maxlength="32" required>
                                </div>
                                <div class="field">
                                    <label>Confirmar a Senha:</label>
                                    <input type="password" name="confsenha" maxlength="32" required>
                                </div>
                            </div>

                        </fieldset>
                        
                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" class="btn btn-primary">Cadastrar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='entrar_cliente.php';" value="Cancelar"><br><br>
                        </div>

                    </form>

                    <?php

                        //verificar se clicou no botao
                        if(isset($_POST['nome']))
                        {
                            $nome = addslashes($_POST['nome']); //addslashes evita codigos maliciosos.
                            $cpf = addslashes($_POST['cpf']);
                            $telefone = addslashes($_POST['telefone']);
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);
                            $confirmarSenha = addslashes( $_POST['confsenha']);

                            //verificando se todos os campos nao estao vazios
                            if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
                            {
                                $u->conectar("MarmaMia","localhost:3306","root","");
                                if ($u->msgErro=="") //conectado normalmente;
                                {
                                    if ($senha == $confirmarSenha)
                                    {
                                        if ($u->cadastrar($nome, $cpf, $telefone, $email, $senha))
                                        {
                                            header("location:cadastrar_cliente2.php"); //encaminhado para proxima area apos verificar
                                        }
                                        else
                                        {
                                            ?>
                                            <div class="msg_erro">
                                                Email já cadastrado, retorne e faça login.
                                            </div>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="msg_erro">
                                            Senhas não conferem!
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="msg_erro">
                                        <?php echo "Erro: ".$u->msgErro;?>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <div class="msg_erro">
                                    Preencha todos os campos!
                                </div>
                                <?php
                            }
                        }

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
<?php
    ob_end_flush();
?>