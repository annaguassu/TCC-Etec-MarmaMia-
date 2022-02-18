<?php
    //verificando se a sessao existe e evitando acesso indevido.
    session_start();
    if (!isset($_SESSION['id_fornecedor'])) {  //se não está definido o id do usuario na sessao
        header("location:entrar_fornecedor.php");
        die();
    }
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
        <title>Excluir Dados</title>
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

                <div id=form>

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

                        <h1>Excluir Dados</h1>
                        
                        <fieldset class="form-group">

                            <legend>Dados do Proprietário</legend>

                            <div class="field">
                                <input type="hidden" name="id_fornecedor" value="<?php echo $dados["id_fornecedor"]; ?>" readonly>
                                <label>Nome do Proprietário:</label>
                                <input type="text" name="nome" maxlength="30" value="<?php echo $dados["nome"]; ?>" readonly>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CPF:</label>
                                    <input type="text" name="cpf" maxlength="11" value="<?php echo $dados["cpf"]; ?>" readonly>
                                </div>
                                <div class="field">
                                    <label>Telefone:</label>
                                    <input type="text" name="telefone" value="<?php echo $dados["telefone"]; ?>" readonly>
                                </div>
                            </div>  

                        </fieldset>

                        <fieldset class="form-group">

                            <legend>Dados do Estabelecimento</legend>

                            <div class="field">
                                <label>Nome Fantasia:</label>
                                <input type="text" name="nome_fantasia" maxlength="30" value="<?php echo $dados["nome_fantasia"]; ?>" readonly>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CNPJ:</label>
                                    <input type="text" name="cnpj" maxlength="14" value="<?php echo $dados["cnpj"]; ?>" readonly>
                                </div>
                                <div class="field">
                                    <label>Estado:</label>
                                    <input type="text" name="estado" maxlength="15" value="<?php echo $dados["estado"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Logradouro:</label>
                                    <input type="text" name="logradouro" size="50" maxlength="30" value="<?php echo $dados["logradouro"]; ?>" readonly>
                                </div>
                                <div class="field">
                                    <label>Número:</label>
                                    <input type="text" name="numero" size="1" maxlength="4" value="<?php echo $dados["numero"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Complemento:</label>
                                    <input type="text" name="complemento" maxlength="30" value="<?php echo $dados["complemento"]; ?>" readonly>
                                </div>
                                <div class="field">
                                    <label>Bairro:</label>
                                    <input type="text" name="bairro" maxlength="30" value="<?php echo $dados["bairro"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Cidade e Estado:</label>
                                    <input type="text" name="cidade" maxlength="20" value="<?php echo $dados["cidade"]; ?>" readonly>
                                </div>
                                <div class="field">
                                    <label>CEP:</label>
                                    <input type="text" name="cep" maxlength="10" value="<?php echo $dados["cep"]; ?>" readonly>
                                </div>
                            </div>

                            <div class="field">
                                <label>Logo do Estabelecimento:</label>
                                <input style="color: black;" type="text" name="arquivo" id="arquivo" value="<?php echo $dados["logo_fornecedor"]; ?>" readonly>
                            </div>


                        </fieldset>

                        <fieldset class="form-group">

                            <legend>Dados para Login</legend>

                            <div class="field">
                                <label>E-mail:</label>
                                <input type="email" name="email" size="66" maxlength="40" value="<?php echo $dados["email"]; ?>" readonly>
                            </div>

                            <div class="field">
                                <label>Senha para Confirmar:</label>
                                <input type="password" name="senha" maxlength="32" required>
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
                            $senha=$_POST['senha'];
                            $senhaconf = md5($senha);
                            $senhabd=$dados['senha'];

                            if (md5($senhabd) == md5($senhaconf))
                            {
                                header("location:excluir_dadosF2.php?id_fornecedor=$id_fornecedor");
                            }
                            else
                            {
                                ?>
                                <br>
                                <div class="msg_erro">
                                    Senha não confere!
                                </div>
                                <?php
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
<?php
    ob_end_flush();
?>