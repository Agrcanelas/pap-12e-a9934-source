<?php
session_start();

// Limpa todas as variáveis da sessão
$_SESSION = [];

// Destroi a sessão
session_destroy();

// Redireciona para a página de login ou início
header("Location: login.php");
exit;
