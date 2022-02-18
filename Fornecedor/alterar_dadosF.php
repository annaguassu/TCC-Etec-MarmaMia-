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
                        $id_fornecedor=$_SESSION['id_fornecedor'];

                        include_once('../conexao.php');

                        // realizando a pesquisa com o id recebido
                        $query = mysqli_query($conexao,"select * from fornecedores where id_fornecedor='$id_fornecedor'");
                    
                        if (!$query) {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }
                    
                        $dados=mysqli_fetch_array($query);
                            
                        mysqli_close($conexao);
                    ?>

                    <form method="post" action="alterar_dadosF2.php" enctype="multipart/form-data">

                        <h1>Alterar Dados</h1>

                        <fieldset class="form-group">

                            <legend>Dados do Proprietário</legend>

                            <div class="field">
                                <input type="hidden" name="id_fornecedor" value="<?php echo $dados["id_fornecedor"]; ?>" readonly>
                                <label>Nome do Proprietário:</label>
                                <input type="text" name="nome" maxlength="30" value="<?php echo $dados["nome"]; ?>">
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CPF:</label>
                                    <input type="text" name="cpf" maxlength="14" value="<?php echo $dados["cpf"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Telefone:</label>
                                    <input type="text" name="telefone" maxlength="16" value="<?php echo $dados["telefone"]; ?>">
                                </div>
                            </div>  

                        </fieldset>

                        <fieldset class="form-group">

                            <legend>Dados do Estabelecimento</legend>

                            <div class="field">
                                <label>Nome Fantasia:</label>
                                <input type="text" name="nome_fantasia" maxlength="30" value="<?php echo $dados["nome_fantasia"]; ?>">
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CNPJ:</label>
                                    <input type="text" name="cnpj" maxlength="14" value="<?php echo $dados["cnpj"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Estado:</label>
                                    <select name="estado" required>
                                        <option value="<?php echo $dados['estado']; ?>" selected="selected"> <?php echo $dados['estado']; ?></option>
                                        <option value="" disabled>Selecione o Estado</option>
                                        <option value="São Paulo">São Paulo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Logradouro:</label>
                                    <input type="text" name="logradouro" size="50" maxlength="30" value="<?php echo $dados["logradouro"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Número:</label>
                                    <input type="text" name="numero" size="1" maxlength="4" value="<?php echo $dados["numero"]; ?>">
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Complemento:</label>
                                    <input type="text" name="complemento" maxlength="30" value="<?php echo $dados["complemento"]; ?>">
                                </div>
                                <div class="field">
                                    <label>Bairro:</label>
                                    <input type="text" name="bairro" maxlength="30" value="<?php echo $dados["bairro"]; ?>">
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Cidade e Estado:</label>
                                    <select name="cidade" required>
                                        <option value="<?php echo $dados['cidade']; ?>" selected="selected"> <?php echo $dados['cidade']; ?></option>
                                        <option value="" disabled>Selecione a Cidade</option>
                                        <option value="Dobrada">Dobrada/SP</option>
                                        <option value="Matão">Matão/SP</option>
                                        <option value="Santa Ernestina">Santa Ernestina/SP</option>
                                        <option value="Taquaritinga">Taquaritinga/SP</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>CEP:</label>
                                    <input type="text" name="cep" maxlength="10" value="<?php echo $dados["cep"]; ?>">
                                </div>
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Confirmar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='../Fornecedor/configuracoes.php';" value="Cancelar">
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