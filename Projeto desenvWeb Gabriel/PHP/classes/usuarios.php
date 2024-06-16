<?php

    Class Usuarios {

        private $pdo;
        public $msg="";

        public function logar($email, $senha){

            global $pdo;
            global $msg;

            $sql = $pdo->prepare("SELECT idusuarios FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindvalue(":e",$email);
            $sql->bindvalue(":s",md5($senha));
            $sql->execute();

            if ($sql->rowCount() > 0) {
                // converte  resultado da consulta em um array;
                $dados = $sql->fetch();

                //Start uma sessão
                session_start();
                $_SESSION['id'] = $dados['id'];
                return true;
            } else {
                $msg = "Usuário não encontrado!";
                return false;
            }

            
        }

        public function conectar($host,$nomeBD,$user,$senha) {

            global $pdo;
            global $msg;

            try {
                $pdo = new PDO("mysql:host=$host;dbname=$nomeBD",$user,$senha);
                $msg = "Connected successfully";

            } catch (PDOException $erro) {
                $msg = "Connection failed: " . $erro->getMessage();

            }
        }

        public function cadastrar($nome, $telefone, $email, $senha) {
           global $pdo;

           $sql = $pdo->prepare("SELECT idusuarios FROM usuarios WHERE email = :e");
           $sql->bindvalue(":e",$email);
           $sql->execute();

           if ($sql->rowCount() > 0) {
               return false;
           } else {
               $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
               $sql->bindValue(":n", $nome);
               $sql->bindValue(":t", $telefone);
               $sql->bindValue(":e", $email);
               $sql->bindValue(":s", md5($senha));
               $sql->execute();
               return true;
           }
        }

    }
?>
