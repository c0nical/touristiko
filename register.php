<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Проверка наличия данных перед их обработкой
    if (isset($_POST['login'], $_POST['pass'], $_POST['email'], $_POST['firstname'], $_POST['secondname'])) {
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $email = $_POST['email'];
        $firstname = $_POST['firstname'];
        $secondname = $_POST['secondname'];

        $id = rand(1,999);
        // Вставка данных в базу данных
        $sql = "INSERT INTO `users` (login, pass, email, firstname, secondname, id) VALUES ('$login', '$pass', '$email','$firstname','$secondname','$id')";
        $conn->query($sql);

        // Перенаправление на страницу vhod.html
        header("Location: login.html");
        exit; // Убедитесь, что скрипт останавливается после перенаправления
    }
}
?>