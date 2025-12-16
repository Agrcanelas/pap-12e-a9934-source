<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pap";
$conn = new mysqli($servername, $username, $password, $dbname);
if($conn->connect_error) die("Ligação falhou: ".$conn->connect_error);

// Buscar foto de perfil se não estiver definida
if(!isset($_SESSION['foto'])){
    $stmt = $conn->prepare("SELECT foto FROM utilizadores WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($foto);
    if($stmt->fetch()){
        $_SESSION['foto'] = $foto ?? 'default.png';
    }
    $stmt->close();
}

// Upload de nova foto
$mensagem_foto = "";
if(isset($_FILES['foto'])){
    $file = $_FILES['foto'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif'];
    if(in_array($ext, $allowed)){
        $newName = 'user_' . $_SESSION['id'] . '.' . $ext;
        $destination = 'uploads/'.$newName;
        if(move_uploaded_file($file['tmp_name'], $destination)){
            $stmt = $conn->prepare("UPDATE utilizadores SET foto = ? WHERE id = ?");
            $stmt->bind_param("si", $newName, $_SESSION['id']);
            $stmt->execute();
            $stmt->close();
            $_SESSION['foto'] = $newName;
            $mensagem_foto = "Foto atualizada com sucesso!";
        } else {
            $mensagem_foto = "Erro ao enviar a foto.";
        }
    } else {
        $mensagem_foto = "Formato inválido. Use jpg, png ou gif.";
    }
}

// Buscar anúncios do utilizador
$stmt = $conn->prepare("SELECT * FROM animais WHERE user_id = ? ORDER BY data_publicacao DESC");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();
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
    <a href="criar_anuncio.php">Criar Anúncio</a>
    <a href="perfil.php">Perfil</a>
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

    <form method="POST" enctype="multipart/form-data" style="margin-top:15px;">
        <label>Trocar Foto de Perfil</label>
        <input type="file" name="foto" accept="image/*" required>
        <button type="submit" class="btn">Atualizar Foto</button>
    </form>
    <?php if($mensagem_foto) echo "<p style='color:green;'>$mensagem_foto</p>"; ?>
</div>

<!-- Dados do utilizador -->
<div class="caixa">
    <h2>Dados da conta</h2>
    <p><strong>Nome:</strong> <?= htmlspecialchars($_SESSION['nome']) ?></p>
    <p><strong>ID do utilizador:</strong> <?= $_SESSION['id'] ?></p>
</div>

<!-- Meus Anúncios -->
<div class="caixa">
    <h2>Meus Anúncios</h2>
    <?php if($result->num_rows === 0): ?>
        <p>Ainda não publicaste nenhum anúncio.</p>
    <?php else: ?>
        <?php while($row = $result->fetch_assoc()): ?>
        <div class="caixa-anuncio">
            <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="<?= htmlspecialchars($row['nome']) ?>">
            <div class="anuncio-info">
                <h3><?= htmlspecialchars($row['nome']) ?> (<?= htmlspecialchars($row['especie']) ?>)</h3>
                <p><strong>Idade:</strong> <?= htmlspecialchars($row['idade']) ?></p>
                <p><strong>Raça:</strong> <?= htmlspecialchars($row['raca']) ?></p>
                <p><strong>Região:</strong> <?= htmlspecialchars($row['regiao']) ?></p>
                <p><?= nl2br(htmlspecialchars($row['descricao'])) ?></p>
                <!-- Aqui podes adicionar Editar/Apagar se quiser -->
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>

</div>
</body>
</html>



