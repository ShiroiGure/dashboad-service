<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard do Administrador</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard de Avisos</h1>
        <a href="logout.php">Logout</a>
        <div class="notices" id="notices"></div>
        <form id="noticeForm">
            <input type="hidden" id="noticeId">
            <input type="text" id="title" placeholder="Título" required>
            <textarea id="message" placeholder="Mensagem" required></textarea>
            <button type="submit">Adicionar Aviso</button>
        </form>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
