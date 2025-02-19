<?php
session_start();
require_once('database.php');

// Проверка, авторизован ли администратор
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Удаление товара из базы данных
$stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
$stmt->bind_param('i', $id);

if ($stmt->execute()) {
    $message = "Товар успешно удален.";
} else {
    $message = "Ошибка при удалении товара: " . $stmt->error;
}

$stmt->close();

header("Location: admin.php");
exit();
?>