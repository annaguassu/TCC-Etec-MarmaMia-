<?php

    session_start();
    unset($_SESSION['id_cliente']); //destruindo a sessao
    header("location:../Cliente/entrar_cliente.php");//encaminhado para index
    
?>