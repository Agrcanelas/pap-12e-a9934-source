<?php
session_start();

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

if(isset($_FILES['foto'])) {
    $file = $_FILES['foto'];
    $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $allowed)) {
        $newName = 'user_' . $_SESSION['id'] . '.' . $ext;
        $destination = 'uploads/' . $newName;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            // Atualiza na base de dados
            $stmt = $conn->prepare("UPDATE utilizadores SET foto = ? WHERE id = ?");
            $stmt->bind_param("si", $newName, $_SESSION['id']);
            $stmt->execute();
            $stmt->close();

            // Atualiza sessão
            $_SESSION['foto'] = $newName;

            header("Location: perfil.php");
            exit;
        } else {
            echo "Erro ao enviar a foto.";
        }
    } else {
        echo "Formato não permitido. Apenas jpg, png e gif.";
    }
}

$conn->close();
