<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Acesso negado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $conn = new mysqli('localhost', 'root', '', 'dashboard');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("UPDATE notices SET title = ?, message = ? WHERE id = ?");
    $stmt->bind_param("ssi", $title, $message, $id);

    if ($stmt->execute()) {
        echo "Aviso atualizado com sucesso!";
    } else {
        echo "Erro ao atualizar aviso: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
