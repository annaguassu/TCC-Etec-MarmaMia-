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
        <title>MarmaMia - Adicionar Opção</title>
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

                    <h1>Adicionar Opção</h1>

                    <form method="post" action="add_opcao2.php">

                        <fieldset class="form-group">

                            <div class="field">
                                <label>Nome:</label>
                                <input type="text" name="nome" required>
                            </div>

                            <div class="field">
                                <label>Descrição:</label>
                                <input type="text" name="descricao" maxlength="100" required>
                            </div>

                            <div class="field-group">

                                <div class="field">
                                    <label>Tipo</label>
                                    <select name="tipo" required>
                                        <option value="" selected="selected" disabled>Selecione</option>
                                        <option value="Marmita">Marmita</option>
                                        <option value="Prato Pronto">Prato Pronto</option>
                                        <option value="Sobremesa">Sobremesa</option>
                                        <option value="Bebida">Bebida</option>
                                        <option value="Adicional">Adicional</option>
                                    </select>
                                </div>

                                <div class="field">
                                    <label>Preço:</label>
                                    <input type="text" name="preco" required>
                                </div>
                                
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Adicionar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='cardapio.php';" value="Cancelar">
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