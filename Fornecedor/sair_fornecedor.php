<?php

    session_start();
    unset($_SESSION['id_fornecedor']); //destruindo a sessao
    header("location:../Fornecedor/entrar_fornecedor.php");//encaminhado para index
    
?>