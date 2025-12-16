<?php
session_start();

// Bloqueia acesso sem login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Ligação falhou: " . $conn->connect_error);
}

// Atualizar sessão com foto (caso não esteja definida)
if (!isset($_SESSION['foto'])) {
    $stmt = $conn->prepare("SELECT foto FROM utilizadores WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($foto);
    if ($stmt->fetch()) {
        $_SESSION['foto'] = $foto ?? 'default.png';
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
<title>Perfil - Refúgio Animal</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="sidebar">
    <h2>Refúgio Animal</h2>
    <div class="menu">
        <a href="index.php">Início</a>
        <a href="anuncios.php">Anúncios</a>
        <a href="servicos.php">Sobre o Projeto</a>
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="main">
    <h1>Perfil</h1>
    <div class="subtitulo">Área do utilizador</div>
    <hr>

    <!-- Foto de Perfil -->
    <div class="caixa">
        <h2>Foto de Perfil</h2>
        <img src="uploads/<?= htmlspecialchars($_SESSION['foto']) ?>" 
             alt="Foto de Perfil" 
             style="width:150px; height:150px; border-radius:50%; object-fit:cover;">
    </div>

    <!-- Formulário de upload -->
    <div class="caixa">
        <h2>Atualizar Foto de Perfil</h2>
        <form action="upload_foto.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="foto" accept="image/*" required>
            <button type="submit" class="btn">Atualizar Foto</button>
        </form>
    </div>

    <!-- Dados do utilizador -->
    <div class="caixa">
        <h2>Dados da conta</h2>
        <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION['nome']) ?></p>
        <p><strong>ID do utilizador:</strong> <?= $_SESSION['id'] ?></p>
    </div>
</div>

</body>
</html>

