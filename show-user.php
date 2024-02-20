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

$sql = "SELECT id, nome, email, data_do_cadastro FROM users";

try {
    $stmt = $conn->query($sql);

    if (!$stmt) {

        die("Erro ao executar a consulta: " . $conn->errorInfo()[2]);
    }
} catch (PDOException $e) {

    echo "Erro ao excutar a consultar: " . $e->getMessage();
}

?>

<div class="container" style="margin-top: 80px;">
    <div class="row">
        <div class="card">
            <div class="card-body">
                <?php
                // Loop para exibir os dados em cartões
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <div class="col-12">
                        <div class="row g-3 needs-validation" novalidate>
                            <div class="col-md-1">
                                <label for="validationCustom01" class="form-label"><strong>Id</strong></label>
                                <p class="card-title"><?php echo $row["id"]; ?></p>
                            </div>
                            <div class="col-md-3">
                                <label for="validationCustom01" class="form-label"><strong>Nome do cliente</strong></label>
                                <p class="card-title"><?php echo $row["nome"]; ?></p>
                            </div>
                            <div class="col-md-4">
                                <label for="validationCustom02" class="form-label"><strong>Email</strong></label>
                                <p class="card-text"><?php echo $row["email"]; ?></p>
                            </div>

                            <div class="col-md-2">
                                <label for="validationCustomUsername" class="form-label"><strong>Data do cadastro</strong></label>
                                <p class="card-text"><?php echo $row["data_do_cadastro"]; ?></p>
                            </div>
                            <div class="col-md-1">
                                <label for="validationCustomUsername" class="form-label"><strong>Editar</strong></label>
                                <a href="edit-user.php?id=<?php echo $row['id']; ?>" class="btn btn-secondary" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Editar</a>
                            </div>

                            <div class="col-md-1">
                                <label for="validationCustomUsername" class="form-label"><strong>Excluir</strong></label>
                                <a href="delete-user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" style="--bs-btn-padding-y: .25rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Excluir</a>
                            </div>

                            <div class="col-md-3">
                            </div>

                        </div>
                    </div>
                    <hr class="row" style="margin-top: 10px;">

                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>