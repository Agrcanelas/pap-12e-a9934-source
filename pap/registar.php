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
    if(isset($_POST['acao']) && $_POST['acao'] === 'registar') {

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

    } elseif(isset($_POST['acao']) && $_POST['acao'] === 'login') {

        $email = $_POST['email'];
        $pass = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, nome, password FROM utilizadores WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows === 1){
            $user = $result->fetch_assoc();

            if(password_verify($pass, $user['password'])){
                $_SESSION['id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                header("Location: index.php");
                exit();
            } else {
                $mensagem = "Password incorreta!";
            }
        } else {
            $mensagem = "Utilizador não encontrado!";
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refúgio Animal - Registar / Login</title>
<link rel="stylesheet" href="estilo.css">

<style>
/* Estilo extra apenas para colocar os formulários lado a lado */
.formularios-container {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 30px;
}

.form-box {
    width: 360px;
    background: white;
    padding: 25px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.2);
}
.form-box h2 {
    text-align: center;
    color: #2e7d32;
}
</style>

</head>
<body>

<div class="formularios-container">

  <!-- REGISTO -->
  <div class="form-box">
    <h2>Registar</h2>

    <?php if(isset($mensagem)) { echo '<p style="color:red; text-align:center;">'.$mensagem.'</p>'; } ?>

    <form method="POST">
      <label>Nome</label>
      <input type="text" name="nome" required>

      <label>Email</label>
      <input type="email" name="email" required>

      <label>Palavra-passe</label>
      <input type="password" name="password" required>

      <input type="hidden" name="acao" value="registar">
      <button type="submit" class="btn">Registar</button>
    </form>
  </div>

  <!-- LOGIN -->
  <div class="form-box">
    <h2>Login</h2>

    <form method="POST">
      <label>Email</label>
      <input type="email" name="email" required>

      <label>Palavra-passe</label>
      <input type="password" name="password" required>

      <input type="hidden" name="acao" value="login">
      <button type="submit" class="btn">Entrar</button>
    </form>
  </div>

</div>

</body>
</html>