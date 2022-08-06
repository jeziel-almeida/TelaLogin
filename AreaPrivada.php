<?php
    session_start();
    if(!isset($_SESSION['id_usuario'])) {
        header("location: index.php");
        exit;
    }

    $nome = $_SESSION['nome'];

?>

<h3 style="font-family: 'Segoe UI';">Bem vindo a sua área especial <?php echo $nome ?>.</h3>

<a href="logout.php">Sair</a>