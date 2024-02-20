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
                empty($_POST['email'])) {

                preencherCampos('Por favor, preencha todos os campos');

            } else {        

                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];

                // Verifica se o campo de senha foi preenchido
                if (!empty($_POST['password'])) {
                    $password = $_POST['password'];
                    $senhahash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "UPDATE users SET nome=:nome, email=:email, password=:password WHERE id=:id";
                } else {
                    $sql = "UPDATE users SET nome=:nome, email=:email WHERE id=:id";
                }

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                if (!empty($_POST['password'])) {
                    $stmt->bindParam(':password', $senhahash);
                }
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {

                    editarSucess('Editando com sucesso!');
                } else {

                    echo "Erro ao atualizar a tarefa: " . $stmt->errorInfo()[2];
                }

            }
        }

        function editarSucess($mensagem)
        {
            echo '<div class="alert alert-success" role="alert">' . $mensagem . '</div>';
        }


        if (isset($_GET['id'])) {
            $id = $_REQUEST['id'];

            $sql = "SELECT * FROM users WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        ?>

        <div class="card" style="width: 20rem;">

            <div class="card-body">
                <div class="alert alert-warning" role="alert">
                    <strong>Atenção ao editar o cadastro</strong>
                </div>

                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="mb-3">
                    <label for="exampleInputText1" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="exampleInputText1" aria-describedby="textHelp" name="nome" value="<?php echo $row['nome']; ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $row['email']; ?>">
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Digite a nova senha">
                </div>

                <button type="submit" class="btn btn-primary">Editar Cadastro</button>

            </div>

        </div>

    </form>

</div>
