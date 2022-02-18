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
        <title>MarmaMia - Alterar Logo</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="alterar_logo.php">
                        <span></span>
                        Alterar Logo
                    </a>
                </header>


                <div id="form">
                    
                    <h1>Alterar Logo</h1>
                    <br><a href='alterar_logo.php'>Tentar Novamente</a><br>

                    <?php
                        include_once('../conexao.php');

                        // Pasta onde o arquivo vai ser salvo
                        $_UP['pasta'] = '../Imagens/';

                        // Tamanho máximo do arquivo (em Bytes)
                        $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

                        // Array com as extensões permitidas
                        $_UP['extensoes'] = array('jpg', 'png', 'gif');

                        // Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
                        $_UP['renomeia'] = false;

                        // Array com os tipos de erros de upload do PHP
                        $_UP['erros'][0] = 'Não houve erro';
                        $_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
                        $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
                        $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
                        $_UP['erros'][4] = 'Não foi feito o upload do arquivo';

                        // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
                        if ($_FILES['arquivo']['error'] != 0) {
                            die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
                            exit; // Para a execução do script
                        }

                        // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
                        // Faz a verificação da extensão do arquivo
                        $extensao = explode('.', $_FILES['arquivo']['name']);
                        $extensao = end($extensao);
                        $extensao = strtolower($extensao);

                        if (array_search($extensao, $_UP['extensoes']) === false) {
                            echo "Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
                            exit;
                        }

                        // Faz a verificação do tamanho do arquivo
                        if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
                            echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
                            exit;
                        }

                        // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
                        // Primeiro verifica se deve trocar o nome do arquivo
                        if ($_UP['renomeia'] == true) {
                            // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
                            $nome_final = md5(time()).'.jpg';
                        } else {
                            // Mantém o nome original do arquivo
                            $nome_final = $_FILES['arquivo']['name'];
                        }

                        // Depois verifica se é possível mover o arquivo para a pasta escolhida
                        if (!move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $nome_final)) {
                            // direciona para a página de erro qdo ocorre erro no move_uploaded_file
                            header('Location: erro.php'); 	
                        }

                        // recuperando 
                        $id_fornecedor=$_POST['id_fornecedor'];
                    
                        // criando a linha do  UPDATE
                        $sqlupdate = "update fornecedores set id_fornecedor='$id_fornecedor', logo_fornecedor='$nome_final' where id_fornecedor=$id_fornecedor";
                    
                        // executando instrução SQL
                        $resultado = @mysqli_query($conexao, $sqlupdate);
                        if (!$resultado) 
                        {
                            die ('<b>Query Inválida:<b>' . @mysqli_error($conexao));  
                        } 
                        else {
                            header("location:../Fornecedor/configuracoes.php");
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