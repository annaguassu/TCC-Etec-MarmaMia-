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
        <title>MarmaMia - Alterar Status</title>
    </head>

    <body>
        <div id="container">

            <div id="form-fornecedor-cliente">

                <header>
                    <a href="../index.html"><img src="../Imagens/logo.png" alt="Logomarca"></a>
                    <a href="pedidosrecebidos.php?status=">
                        <span></span>
                        Pedidos Recebidos
                    </a>
                </header>

                <div id="form">
                    <h1>Alterar Status</h1>

                    <?php
                        include_once('../conexao.php');

                        $id_fornecedor=$_SESSION['id_fornecedor'];
                        $id_pedido=$_GET['id_pedido'];

                        $query = mysqli_query($conexao,"select * from pedidos where id_pedido=$id_pedido");

                        if (!$query) 
                        {
                            die('Query Inválida: ' . @mysqli_error($conexao));  
                        }

                        $dados=mysqli_fetch_array($query);
                        
                        mysqli_close($conexao);
                    ?>

                    <form action="alterar_status2.php" method="post">

                        <fieldset class="form-group">

                            <h3>Pedido</h3><br>

                            <input type="hidden" name="id_pedido" value="<?php echo $dados["id_pedido"]; ?>" readonly>

                            <b>Código do Pedido:</b> <?php echo $dados['id_pedido'] ?><br>
                            <b>Realizado em:</b> <?php echo $dados['created'] ?><br>
                            <b>Total:</b> R$<?php echo number_format($dados['total'], 2, ',', '.') ?><br><br>

                            <div class="field">
                                <label>Status:</label>
                                <select name="novostatus" required>
                                    <option value="<?php echo $dados['status']; ?>" selected="selected"> <?php echo $dados['status']; ?> </option>
                                    <option value="" disabled>Selecione o Status</option>
                                    <option value="Recebido">Recebido</option>
                                    <option value="Em andamento">Em andamento</option>
                                    <option value="Finalizado">Finalizado</option>
                                    <option value="Entregue">Entregue</option>
                                </select>
                            </div>

                        </fieldset>

                        <div id="botoes">
                            <button style="margin: 0 3px;" type="submit" name="submit" class="btn btn-primary">Confirmar</button>
                            <input style="margin: 0 3px;" type='button' class="btn btn-primary" onclick="window.location='pedidosrecebidos.php?status=';" value="Cancelar">
                        </div>

                    </form>

                </div>

            <div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    </body>

</html>