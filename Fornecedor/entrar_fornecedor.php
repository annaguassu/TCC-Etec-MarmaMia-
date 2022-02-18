<?php
    require_once '../Classes/fornecedores.php';
    $u = new Fornecedor;

    session_start();
    if(isset($_SESSION['id_fornecedor'])) {
        header("location:areaprivada_fornecedor.php");
        die();
    }

    ob_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <!-- Meta tags Obrigatórias -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/styleform.css">

        <link rel="shortcut icon" href="../Imagens/favicon.ico" type="image/x-icon">
        <title>MarmaMia - Entrar</title>
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

                <div id=form>

                    <form method="POST">

                        <h1>Entrar - Fornecedor</h1>

                        <fieldset>

                            <legend>Dados do Fornecedor</legend>

                            <div class="field">
                                <label>E-mail:</label>
                                <input type="email" name="email" size="66" maxlength="40">
                            </div>

                        
                            <div class="field">
                                <label>Senha:</label>
                                <input type="password" name="senha" maxlength="32">
                                <a href="../index.html">Esqueci a Senha</a>
                            </div>

                        </fieldset>
                        
                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" class="btn btn-primary">Entrar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='../index.html';" value="Cancelar"><br>
                        </div>

                        <br><a href="../index.html#fornecedor">Quer ser um fornecedor? Saiba mais!</a>

                    </form>

                    <?php

                        if(isset($_POST['email']))
                        {
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);

                            //verificando se todos os campos nao estao vazios
                            if(!empty($email) && !empty($senha))
                            {
                                $u->conectar("MarmaMia","localhost:3306","root",""); //conectando ao banco
                                if($u->msgErro=="") // caso a mensagem esteja vazia, login ok
                                {
                                    if ($u->logar($email, $senha))
                                    {
                                        header("location:areaprivada_fornecedor.php"); //encaminhado para proxima area apos verificar usuario e senha
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="msg_erro">
                                            Email e/ou senha estão incorretos!
                                        </div>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <div class="msg_erro">
                                        <?php echo "Erro: ".$u->msgErro; ?>
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

        <!-- JavaScript (Opcional) -->
        <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>
<?php
    ob_end_flush();
?>