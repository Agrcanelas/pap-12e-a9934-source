<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Ligação falhou: ".$conn->connect_error);

$result = $conn->query("SELECT * FROM animais ORDER BY data_publicacao DESC");
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Anúncios - Refúgio Animal</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<div class="sidebar">
<h2>Refúgio Animal</h2>
<div class="menu">
    <a href="index.php">Início</a>
    <a href="anuncios.php">Anúncios</a>
    <a href="meus_anuncios.php">Meus Anúncios</a>
    <?php if(isset($_SESSION['id'])): ?>
        <a href="perfil.php">Perfil</a>
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <a href="registar.php">Registar / Login</a>
    <?php endif; ?>
</div>
</div>

<div class="main">
<h1>Anúncios</h1>
<div class="subtitulo">Animais disponíveis</div>
<hr>

<?php while($row = $result->fetch_assoc()): ?>
<div class="caixa-anuncio">
    <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="<?= htmlspecialchars($row['nome']) ?>">
    <div class="anuncio-info">
        <h3><?= htmlspecialchars($row['nome']) ?> (<?= htmlspecialchars($row['especie']) ?>)</h3>
        <p><strong>Idade:</strong> <?= htmlspecialchars($row['idade']) ?></p>
        <p><strong>Raça:</strong> <?= htmlspecialchars($row['raca']) ?></p>
        <p><strong>Região:</strong> <?= htmlspecialchars($row['regiao']) ?></p>
        <p><?= nl2br(htmlspecialchars($row['descricao'])) ?></p>
    </div>
</div>
<?php endwhile; ?>

</div>
</body>
</html>


