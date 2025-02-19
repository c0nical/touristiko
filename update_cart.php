<?php
session_start();

// Получение обновленных количеств из запроса
$quantities = $_POST['quantities'];

// Обновление количества товаров в корзине
foreach ($quantities as $product_id => $quantity) {
    if ($quantity <= 0) {
        unset($_SESSION['cart'][$product_id]);
    } else {
        $_SESSION['cart'][$product_id] = $quantity;
    }
}

// Переход на страницу корзины
header("Location: cart.php");
exit();
?>