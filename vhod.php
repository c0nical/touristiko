<?php
session_start();
// Подключение к базе данных
require_once('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login']; // Получение логина из формы
    $pass = $_POST['pass']; // Получение пароля из формы

    // Защита от SQL инъекций
    $login = $conn->real_escape_string($login);
    $pass = $conn->real_escape_string($pass);

    // SQL запрос для проверки логина и пароля
    $sql = "SELECT login, pass, email, firstname, secondname, id, is_admin FROM `users` WHERE login = '$login' AND pass = '$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Извлечение данных пользователя и сохранение в сессию
        $user = $result->fetch_assoc();
        $_SESSION['login'] = $user['login'];
        $_SESSION['pass'] = $user['pass'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['firstname'] = $user['firstname'];
        $_SESSION['secondname'] = $user['secondname'];
        $_SESSION['id'] = $user['id'];

        // Проверка, является ли пользователь администратором
        if ($user['is_admin'] == 1) {
            $_SESSION['admin_logged_in'] = true;
            header("Location: admin.php"); // Переход в админ панель
        } else {
            header("Location: cabinet.php"); // Переход на страницу пользователя
        }
        
        exit();
    } else {
        echo "Неправильный логин или пароль";
    }
}
?>