<?php
session_start();

$is_admin = isset($_SESSION['username']) ? true : false;

$conn = new mysqli('localhost', 'root', '', 'dashboard');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM notices ORDER BY created_at DESC");

$notices = array();
while ($row = $result->fetch_assoc()) {
    $row['is_admin'] = $is_admin;
    $notices[] = $row;
}

$conn->close();

echo json_encode($notices);
?>
