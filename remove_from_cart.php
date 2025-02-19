<?php
session_start();

// Получение ID товара из запроса
$product_id = $_GET['id'];

// Удаление товара из корзины
unset($_SESSION['cart'][$product_id]);

// Переход на страницу корзины
header("Location: cart.php");
exit();
?>