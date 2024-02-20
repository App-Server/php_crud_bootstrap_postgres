<?php
session_start();
// Verificar se o usuário está logado
if (!isset($_SESSION['loggedin'])) {
    // Se o usuário não estiver logado, redirecione para a página de login
    header('Location: login.php');
    exit;
}

include 'config.php';
include 'navbar.php';
include 'erro.php';

?>

<div class="container " style="margin-top: 80px;">

    <h1>Seja Bem-Vindo</h1>

</div>