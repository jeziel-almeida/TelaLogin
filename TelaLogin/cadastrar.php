<?php
require_once 'classes/usuarios.php';
$u = new Usuario();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="./css/style.css">

</head>

<body>

    <main class="main-login">

        <section class="left-login">
            <h1>Cadastre-se<br>E entre para o nosso time</h1>
            <img src="./svg/authentication-animate.svg" alt="authentication-animate" class="left-login-image">
            <a href="https://storyset.com/people" class="image-credit">People illustrations by Storyset</a>
        </section>

        <section class="right-login">
            <form method="post" class="card-login card-cadastro">
                <h1>Cadastrar</h1>
                <div class="textfield">
                    <label for="nome">Nome completo</label>
                    <input type="text" name="nome" placeholder="Nome completo">
                </div>
                <div class="textfield">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" placeholder="Telefone">
                </div>
                <div class="textfield">
                    <label for="email">Email</label>
                    <input type="email" name="email" placeholder="Email">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <div class="textfield">
                    <label for="confSenha">Confirmar senha</label>
                    <input type="password" name="confSenha" placeholder="Confirmar senha">
                </div>
                <button class="btn-login" type="submit">Cadastrar</button>
                <p>Já possui uma conta? <a href="index.php" class="cadastro-link"><strong>Entre</strong></a></p>
            </form>
        </section>

    </main>


    <?php

    //* Verificar se o usuário clicou no botão cadastrar
    if (isset($_POST['nome'])) {
        $nome = addslashes($_POST['nome']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        $confSenha = addslashes($_POST['confSenha']);

        if (!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha)) {

            $u->conectar("localhost", "projeto_login", "root", "");
            if ($u->msgErro == "") {

                if ($senha == $confSenha) {
                    if ($u->cadastrar($nome, $telefone, $email, $senha)) {
                        ?>
                        <!-- <div class="msg-sucesso">
                            Cadastrado com sucesso! <a href="index.php"> Acesse para entrar</a>
                        </div> -->
                        <script>
                            alert("Cadastrado com sucesso!");
                        </script>
                        <?php
                    } else {
                        ?>
                        <script>
                            alert("Email já cadastrado!");
                        </script>
                        <?php
                    }
                } else {
                    ?>
                    <script>
                        alert("As senhas não conferem!");
                    </script>
                    <?php
                }
            } else {
                ?>
                <script>
                    alert("Erro: <?php echo $u->msgErro; ?>");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("Preencha todos os campos!");
            </script>
            <?php
        }
    }


    ?>

</body>
</html>