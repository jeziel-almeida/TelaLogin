<?php

Class Usuario {

    private $pdo;
    public $msgErro = "";

    public function conectar($host, $dbname, $usuario, $senha) {
        global $pdo;
        global $msgErro;

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $usuario, $senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $telefone, $email, $senha) {
        global $pdo;
        //* Verificar se já existe o email cadastrado
        $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = ?");
        $sql->execute([$email]);
        if($sql->rowCount() > 0) {
            return false;
        } else {
            //* Cadastrar o usuário
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (?, ?, ?, ?)");
            $sql->execute([$nome, $telefone, $email, md5($senha)]);
            return true;
        }

    }

    public function logar($email, $senha) {
        global $pdo;
        //* Verificar se o email e a senha estão cadastrados
        $sql = $pdo->prepare("SELECT id_usuario, nome FROM usuarios WHERE email = ? AND senha = ?");
        $sql->execute([$email, md5($senha)]);
        if($sql->rowCount() > 0) {
            //* Logar o usuário
            $dados = $sql->fetch();
            session_start();
            $_SESSION['id_usuario'] = $dados['id_usuario'];
            $_SESSION['nome'] = $dados['nome'];
            return true;
        } else {
            return false;
        }
    }
}