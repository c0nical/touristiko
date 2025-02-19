<?php
session_start();

// Проверка, существует ли корзина, если нет - создаем
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Получение ID товара и его количества из запроса
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Добавление товара в корзину или обновление количества
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = $quantity;
}

// Переход на страницу корзины или обратно к товарам
header("Location: catalog.php"); // Перенаправление на страницу каталога или корзины
exit();
?>