<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Refúgio Animal - Início</title>
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
    <h1>Refúgio Animal</h1>
    <div class="subtitulo">Início</div>
    <hr>

    <p>Bem-vindo ao Refúgio Animal, a plataforma onde podes divulgar, adotar ou ajudar animais.
       Funciona como um "OLX animal" — rápido, simples e gratuito!</p>

    <div class="caixa">
        <h2>O que podes fazer?</h2>
        <ul>
            <li>Publicar anúncios de animais para adoção ou acolhimento</li>
            <li>Procurar animais perto da tua zona</li>
            <li>Entrar em contacto com tutores e associações</li>
            <li>Ajudar animais encontrados ou desaparecidos</li>
        </ul>
    </div>
</div>

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

</body>
</html>