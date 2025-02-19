<?php
session_start();

// Очистка всех данных сессии
session_unset();

// Уничтожение сессии
session_destroy();

// Перенаправление на страницу входа или на другую страницу
header("Location: login.html");
exit();
?>