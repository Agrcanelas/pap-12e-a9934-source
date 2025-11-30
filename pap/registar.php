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

if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO utilizadores (nome, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $pass);

    if($stmt->execute()){
        $mensagem = "Registo concluído! Agora podes fazer login.";
    } else {
        $mensagem = "Erro no registo: " . $stmt->error;
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
<title>Registar - Refúgio Animal</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="caixa-login">

    <h1>Criar Conta</h1>

    <?php if(isset($mensagem)) { ?>
        <p style="text-align:center; color:#d32f2f; margin-bottom:15px;">
            <?= $mensagem ?>
        </p>
    <?php } ?>

    <form method="POST" style="max-width:400px; margin:auto;">
        
        <label>Nome</label>
        <input type="text" name="nome" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Palavra-passe</label>
        <input type="password" name="password" required>

        <button type="submit" class="btn" style="width:100%;">Registar</button>
    </form>

    <p class="mensagem" style="margin-top:15px;">
        Já tens conta?
        <a href="login.php">Faz login aqui.</a>
    </p>

</div>

</body>
</html>
