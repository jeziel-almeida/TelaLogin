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
    <title>Entre</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <main class="main-login">

        <section class="left-login">
            <h1>Faça login<br>E entre na sua conta</h1>
            <img src="./svg/astronaut-animate.svg" alt="authentication-animate" class="left-login-image">
            <a href="https://storyset.com/people" class="image-credit">People illustrations by Storyset</a>
        </section>

        <section class="right-login">
            <form method="post" class="card-login">
                <h1>LOG IN</h1>
                <div class="textfield">
                    <label for="usuario">Usuário</label>
                    <input type="email" name="email" placeholder="Usuário">
                </div>
                <div class="textfield">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button class="btn-login" type="submit">Log in</button>
                <p>Ainda não é inscrito? <a href="cadastrar.php" class="cadastro-link"><strong>Cadastre-se</strong></a></p>
            </form>
        </section>
        
    </main>

    <?php

    if(isset($_POST['email'])) {
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha)) {

            $u->conectar("localhost", "projeto_login", "root", "");
            if($u->msgErro == "") {

            
                if($u->logar($email, $senha)) {
                
                    header("location: AreaPrivada.php");

                } else {
                    ?>
                    <script>
                        alert("Email e/ou senha estão incorretos");
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