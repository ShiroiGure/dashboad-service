<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Acesso negado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $conn = new mysqli('localhost', 'root', '', 'dashboard');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM notices WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Aviso excluído com sucesso!";
    } else {
        echo "Erro ao excluir aviso: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
