<?php
session_start();

// Bloqueia acesso sem login
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
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

    <div class="caixa">
        <h2>Dados da conta</h2>
        <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION['nome']) ?></p>
        <p><strong>ID do utilizador:</strong> <?= $_SESSION['id'] ?></p>
        <p><strong>Estado:</strong> Sessão ativa</p>
    </div>

    <div class="caixa">
        <h2>O que podes fazer agora?</h2>
        <ul>
            <li>Publicar anúncios de animais</li>
            <li>Gerir os teus anúncios</li>
            <li>Editar os teus dados pessoais</li>
            <li>Entrar em contacto com outros utilizadores</li>
        </ul>
    </div>
</div>

</body>
</html>
