<?php

session_start();

include 'config.php'; // Conexão com o banco de dados
include 'theme.php';
include 'erro.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para obter a senha criptografada do usuário com base no e-mail fornecido
    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Verifica se a senha fornecida corresponde à senha criptografada armazenada no banco de dados
        if (password_verify($password, $row['password'])) {
            // Autenticação bem-sucedida, criar sessão
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $row['email'];
            header("Location: dashboard.php"); // Redirecionar para a página protegida
            exit;
        } else {
            $error = "Usuário ou senha inválidos";
        }
    } else {
        $error = "Usuário ou senha inválidos";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>

<body>

<div class="formulario d-flex justify-content-center" style="margin-top: 200px;">
    <div class="card" style="width: 20rem;">

        <div class="card-body">

            <h2>Login</h2>
            <?php if (isset($error)) echo "<div>$error</div>"; ?>
            <form method="post" action="">
                <label for="username">Usuário:</label>
                <input type="email" id="username" name="email" required><br><br>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Login">
            </form>

        </div>

    </div>
</div>


</body>

</html>