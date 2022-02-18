<?php

    Class Cliente 
    {
        private $pdo;  /*criando variavel para usar nas funçoes*/
        public $msgErro="";

        public function conectar($nome, $host, $usuario, $senha)
        {
            global $pdo;
            global $msgErro;
            
            try
            {
                $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            } catch (PDOException $e) {
                $msgErro - $e->getMessage(); /*pega a mensagem de erro do php e joga na variavel msegErro e mostra pro usuario.*/
            }
        }

        public function cadastrar($nome, $cpf, $telefone, $email, $senha)
        {
            global $pdo;
            global $msgErro;

            //verificando se existe usuario cadastrado.
            $sql = $pdo->prepare("SELECT id_cliente FROM clientes WHERE email=:e"); //pega o id do usuario buscando pelo emial preenchido no cadastro
            $sql->bindValue(":e", $email);  //substitui o :e pelo email preenchido no cadastro
            $sql->execute();
            if($sql->rowCount()>0) //verificando houve resposta na consulta
            {
                return false; // ja tem cadastro
            }
            else
            {
                //caso nao tenha
                $sql = $pdo->prepare("INSERT INTO clientes (nome, cpf, telefone, email, senha) VALUES (:n, :c, :t, :e,:s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":c", $cpf);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5($senha));
                $sql->execute();
                return true;
            }

        }

        public function logar($email, $senha)
        {
            global $pdo;
            global $msgErro;

            /*verificar se o email e senha estao cadastrados, se sim*/
            $sql= $pdo->prepare("SELECT id_cliente FROM clientes WHERE email=:e AND senha=:s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            if($sql->rowCount()>0) //verificando houve resposta na consulta
            {
                //entrar no sistema criando uma (sessao)
                $dado = $sql->fetch(); //transforma o retorno da query em array com os nomes das colunas
                session_start();  //iniciando a sessao
                $_SESSION['id_cliente'] = $dado['id_cliente']; //armazena o id do usuario na sessao.
                return true;  //logado com sucesso
            }
            else
            {
                return false; //erro ao logar.
            }
        }

    }

?>