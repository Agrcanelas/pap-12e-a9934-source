<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}
?>
<div class="sidebar">
    <h2>Refúgio Animal</h2>
    <div class="menu">
        <a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'ativo' : '' ?>">Início</a>
        <a href="anuncios.php" class="<?= basename($_SERVER['PHP_SELF']) == 'anuncios.php' ? 'ativo' : '' ?>">Anúncios</a>
        <a href="servicos.php" class="<?= basename($_SERVER['PHP_SELF']) == 'servicos.php' ? 'ativo' : '' ?>">Sobre o Projeto</a>

        <?php if(isset($_SESSION['id'])): ?>
            <a href="criar_anuncio.php" class="<?= basename($_SERVER['PHP_SELF']) == 'criar_anuncio.php' ? 'ativo' : '' ?>">Criar Anúncio</a>
            <a href="perfil.php" class="<?= basename($_SERVER['PHP_SELF']) == 'perfil.php' ? 'ativo' : '' ?>">Perfil</a>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="registar.php" class="<?= basename($_SERVER['PHP_SELF']) == 'registar.php' ? 'ativo' : '' ?>">Registar / Login</a>
        <?php endif; ?>
    </div>
</div>

