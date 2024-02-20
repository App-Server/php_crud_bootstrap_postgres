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


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {

    } else {

        echo "Erro ao excluir tarefa: " . $stmt->errorInfo()[2];
    }
}

?>

<div class="container d-flex justify-content-center" style="margin-top: 250px;">

    <div class="d-grid gap-2 col-12 mx-auto">
        <div class="alert alert-success d-flex justify-content-center" role="alert">
            <h4 class="alert-heading">Exluido com sucesso!</h4>
        </div>
        <div class="class d-flex justify-content-center">
            <a href="/show-user.php"><button class="btn btn-primary" type="button">Voltar a lista de usuarios</button></a>
        </div>
    </div>

</div>