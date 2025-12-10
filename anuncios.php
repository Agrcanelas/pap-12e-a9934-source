<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refúgio Animal - Anúncios</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="sidebar">
    <h2>Refúgio Animal</h2>
    <div class="menu">
        <a href="index.php">Início</a>
        <a href="anuncios.php">Anúncios</a>
        <a href="servicos.php">Sobre o Projeto</a>
        <a href="registar.php">Registar / Login</a>
    </div>
</div>

<div class="main">
    <h1>Anúncios</h1>
    <div class="subtitulo">Animais disponíveis</div>
    <hr>

    <footer>
        <?php if(isset($_SESSION['id'])): ?>
            <div>
                Olá, <?= htmlspecialchars($_SESSION['nome']) ?>
                <a href="perfil.php" class="btn">Ver Perfil</a>
            </div>
        <?php else: ?>
            <div>Refúgio Animal © 2025 — Desenvolvido para a PAP</div>
        <?php endif; ?>
    </footer>
</div>

</body>
</html>

