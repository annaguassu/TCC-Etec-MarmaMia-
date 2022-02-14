<?php

    $host = "localhost:3306";
    $user = "root";
    $pass = "";
    $banco = "marmamia";

    //Criando a linha de conexão
    $conexao = @new mysqli($host, $user, $pass, $banco);

    if ($conexao->connect_errno) {
        die('Connect Error: ' . $conexao->connect_errno);
    }

    mysqli_set_charset($conexao, "utf8");
    
?>
