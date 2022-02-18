<?php 

    //Dados do banco de dados
    define("DB_HOST", "localhost:3306");
    define("DB_NAME", "MarmaMia");
    define("DB_USER", "root");
    define("DB_PASS", "");

    //Conexao com Banco de Dados
    return new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USER, DB_PASS);

?>
