<?php
session_start(); // garante que a sessão está ativa
?>
<div class="sidebar">
    <h2>Refúgio Animal</h2>
    <div class="menu">
        <a href="index.php">Início</a>
        <a href="anuncios.php">Anúncios</a>
        <a href="servicos.php">Sobre o Projeto</a>
        <a href="criar_anuncio.php">Criar Anúncio</a>
        <?php if(isset($_SESSION['id'])): ?>
            <a href="perfil.php">Ver Perfil</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="registar.php">Registar / Login</a>
        <?php endif; ?>
    </div>
</div>
