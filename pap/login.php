<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ligação falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, nome, password FROM utilizadores WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {

        $user = $result->fetch_assoc();

        if (password_verify($pass, $user['password'])) {

            $_SESSION['id'] = $user['id'];
            $_SESSION['nome'] = $user['nome'];

            header("Location: index.php");
            exit();

        } else {
            $mensagem = "Password incorreta!";
        }

    } else {
        $mensagem = "Conta não encontrada!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Refúgio Animal</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="caixa-login">

    <h1>Iniciar Sessão</h1>

    <?php if(isset($mensagem)) { ?>
        <p style="text-align:center; color:#d32f2f; margin-bottom:15px;">
            <?= $mensagem ?>
        </p>
    <?php } ?>

    <form method="POST" style="max-width:400px; margin:auto;">

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Palavra-passe</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn" style="width:100%;">Entrar</button>
    </form>

    <p class="mensagem" style="margin-top:15px;">
        Ainda não tens conta?
        <a href="registar.php">Cria uma aqui.</a>
    </p>

</div>

</body>
</html>
