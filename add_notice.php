<?php
session_start();
if (!isset($_SESSION['username'])) {
    echo "Acesso negado!";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $message = $_POST['message'];

    $conn = new mysqli('localhost', 'root', '', 'dashboard');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO notices (title, message) VALUES (?, ?)");
    $stmt->bind_param("ss", $title, $message);

    if ($stmt->execute()) {
        echo "Aviso adicionado com sucesso!";
    } else {
        echo "Erro ao adicionar aviso: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
