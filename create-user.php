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

<div class="container d-flex justify-content-center" style="margin-top: 130px;">

    <form method="POST" action="">

        <?php

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if  (empty($_POST['nome']) || 
                    empty($_POST['email']) || 
                    empty($_POST['password'])){

                    preencherCampos('Por favor, preencha todos os campos');

                } else {

                    $nome = $_POST['nome'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $senhahash = password_hash($password, PASSWORD_DEFAULT);

                    $stmt = $conn->prepare("INSERT INTO users (nome, email, password) VALUES (:nome, :email, :password)");
                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':password', $senhahash);

                    if($stmt->execute()) {

                        alertSucess('Cadastro com sucesso!');

                    } else {
                        
                        erroCadastro('Erro ao cadastrar: ' . $stmt->errorInfo()[2]);

                    }
                }

            }

            function preencherCampos($mensagem)
            {
                echo '<div class="alert alert-danger" role="alert">' . $mensagem . '</div>';
            }

            function alertSucess($mensagem)
            {
                echo '<div class="alert alert-success" role="alert">' . $mensagem . '</div>';
            }

            function erroCadastro($mensagem)
            {
                echo '<div class="alert alert-danger" role="alert">' . $mensagem . '</div>';
            }

        ?>

        <div class="card" style="width: 20rem;">

            <div class="card-body">

                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name="nome">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar Usuario</button>

            </div>

        </div>

    </form>

</div>