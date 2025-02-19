<?php
session_start();

// Пример: Установка значения переменной сессии login
$_SESSION['login'] = $_SESSION['login'];

// Проверка наличия значения переменной сессии login
if (isset($_SESSION['login'])) {
    // Пользователь авторизован, отправляем на личный кабинет
    header("Location: cabinet.php");
    exit();
} else {
    // Пользователь не авторизован, отправляем на страницу входа
    header("Location: login.html");
    exit();
}
?>