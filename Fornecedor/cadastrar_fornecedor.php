<?php
    require_once '../Classes/fornecedores.php';
    $u = new Fornecedor;
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
        <title>MarmaMia - Seja um Fornecedor</title>
    </head>

    <body>
        <div>
    
            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="../index.html">
                        <span></span>
                        MarmaMia
                    </a>
                </header>

                <div id="form">

                    <form method="POST" enctype="multipart/form-data">

                        <h1>Seja um Fornecedor - Cadastro</h1>

                        <fieldset class="form-group">

                            <legend>Dados do Proprietário</legend>

                            <div class="field">
                                <label>Nome do Proprietário:</label>
                                <input type="text" name="nome" maxlength="30" required>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CPF:</label>
                                    <input type="text" name="cpf" maxlength="18" required>
                                </div>
                                <div class="field">
                                    <label>Telefone:</label>
                                    <input type="text" name="telefone" maxlength="16" required>
                                </div>
                            </div>  

                        </fieldset>

                        <fieldset class="form-group">

                            <legend>Dados do Estabelecimento</legend>

                            <div class="field">
                                <label>Nome Fantasia:</label>
                                <input type="text" name="nome_fantasia" maxlength="30" required>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>CNPJ:</label>
                                    <input type="text" name="cnpj" maxlength="18" required>
                                </div>
                                <div class="field">
                                    <label>Estado:</label>
                                    <select name="estado" required>
                                        <option value="" selected="selected" disabled>Selecione o Estado</option>
                                        <option value="São Paulo">São Paulo</option>
                                    </select>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Logradouro:</label>
                                    <input type="text" name="logradouro" size="50" maxlength="30" required>
                                </div>
                                <div class="field">
                                    <label>Número:</label>
                                    <input type="text" name="numero" size="1" maxlength="4" required>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Complemento:</label>
                                    <input type="text" name="complemento" maxlength="30" required>
                                </div>
                                <div class="field">
                                    <label>Bairro:</label>
                                    <input type="text" name="bairro" maxlength="30" required>
                                </div>
                            </div>

                            <div class="field-group">
                                <div class="field">
                                    <label>Cidade e Estado:</label>
                                    <select name="cidade" required>
                                        <option value="" selected="selected" disabled>Selecione a Cidade</option>
                                        <option value="Dobrada">Dobrada/SP</option>
                                        <option value="Matão">Matão/SP</option>
                                        <option value="Santa Ernestina">Santa Ernestina/SP</option>
                                        <option value="Taquaritinga">Taquaritinga/SP</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label>CEP:</label>
                                    <input type="text" name="cep" maxlength="10" required>
                                </div>
                            </div>

                            <div class="field">
                                <label>Logo do Estabelecimento:</label>
                                <input style="color: black;" type="file" name="arquivo" id="arquivo" required>
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
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='../index.html';" value="Cancelar"><br><br>
                        </div>

                    </form>

                    <?php
                        //verificar se clicou no botao
                        if(isset($_POST['nome']))
                        {
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
                                die("<br>Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
                                exit; // Para a execução do script
                            }

                            // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
                            // Faz a verificação da extensão do arquivo
                            $extensao = explode('.', $_FILES['arquivo']['name']);
                            $extensao = end($extensao);
                            $extensao = strtolower($extensao);

                            if (array_search($extensao, $_UP['extensoes']) === false) {
                                echo "<br>Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif";
                                exit;
                            }

                            // Faz a verificação do tamanho do arquivo
                            if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
                                echo "<br>O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
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

                            $nome = addslashes($_POST['nome']); //addslashes evita codigos maliciosos.
                            $cpf = addslashes($_POST['cpf']);
                            $telefone = addslashes($_POST['telefone']);
                            $nome_fantasia = addslashes($_POST['nome_fantasia']);
                            $cnpj = addslashes($_POST['cnpj']);
                            $logradouro = addslashes($_POST['logradouro']);
                            $numero = addslashes($_POST['numero']);
                            $complemento = addslashes($_POST['complemento']);
                            $bairro = addslashes($_POST['bairro']);
                            $cidade = addslashes($_POST['cidade']);
                            $cep = addslashes($_POST['cep']);
                            $estado = addslashes($_POST['estado']);
                            $email = addslashes($_POST['email']);
                            $senha = addslashes($_POST['senha']);
                            $confirmarSenha = addslashes( $_POST['confsenha']);

                            //verificando se todos os campos nao estao vazios
                            if(!empty($nome) && !empty($cpf) && !empty($telefone) && !empty($nome_fantasia) && !empty($cnpj) && !empty($logradouro) && !empty($numero) && !empty($complemento) 
                            && !empty($bairro) && !empty($cidade) && !empty($cep) && !empty($estado) && !empty($nome_final) && !empty($email) && !empty($senha) && !empty($confirmarSenha))
                            {
                                $u->conectar("MarmaMia","localhost:3306","root","");
                                if ($u->msgErro=="") //conectado normalmente;
                                {
                                    if ($senha == $confirmarSenha)
                                    {
                                        if ($u->cadastrar($nome, $cpf, $telefone, $nome_fantasia, $cnpj, $logradouro, $numero,
                                        $complemento, $bairro, $cidade, $cep, $estado, $nome_final, $email, $senha))
                                        {
                                            header("location:cadastrar_fornecedor2.php"); //encaminhado para proxima area apos verificar
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