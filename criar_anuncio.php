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

$mensagem = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = trim($_POST['nome']);
    $especie = trim($_POST['especie']);
    $idade = trim($_POST['idade']);
    $raca = trim($_POST['raca']);
    $regiao = trim($_POST['regiao']);
    $descricao = trim($_POST['descricao']);
    $user_id = $_SESSION['id'];

    // Upload da foto
    $foto = 'default.png';
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $ext = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
        $allowed = ['jpg','jpeg','png','gif'];
        if(in_array($ext, $allowed)){
            $foto = 'animal_' . time() . '.' . $ext;
            move_uploaded_file($_FILES['foto']['tmp_name'], 'uploads/'.$foto);
        }
    }

    $stmt = $conn->prepare("INSERT INTO animais (nome, especie, idade, raca, regiao, descricao, foto, user_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssi",$nome,$especie,$idade,$raca,$regiao,$descricao,$foto,$user_id);
    if($stmt->execute()){
        $mensagem = "Anúncio publicado com sucesso!";
    } else {
        $mensagem = "Erro: ".$stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<title>Criar Anúncio</title>
<link rel="stylesheet" href="estilo.css">
</head>
<body>

<?php include 'sidebar.php'; ?>

<div class="main">
<h1>Criar Anúncio</h1>
<div class="subtitulo">Preencha os dados do animal</div>
<hr>

<?php if($mensagem) echo "<p style='color:green;'>$mensagem</p>"; ?>

<div class="caixa-login">
<form method="POST" enctype="multipart/form-data">
<label>Nome</label>
<input type="text" name="nome" required>

<label>Espécie</label>
<input type="text" name="especie" required>

<label>Idade</label>
<input type="text" name="idade" required>

<label>Raça</label>
<input type="text" name="raca" required>

<label>Região</label>
<input type="text" name="regiao" required>

<label>Descrição</label>
<textarea name="descricao" required></textarea>

<label>Foto</label>
<input type="file" name="foto" accept="image/*">

<button type="submit" class="btn">Publicar Anúncio</button>
</form>
</div>
</div>
</body>
</html>

