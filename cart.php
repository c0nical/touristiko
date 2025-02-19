<?php
session_start();
require_once('database.php');

// Получение информации о товарах из базы данных
$product_ids = array_keys($_SESSION['cart']);
if (empty($product_ids)) {
    $products = [];
} else {
    $ids = implode(',', $product_ids);
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = $conn->query($sql);
    $products = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Корзина</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Корзина</h1>

    <?php if (empty($products)): ?>
        <p>Ваша корзина пуста.</p>
    <?php else: ?>
        <form action="update_cart.php" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Товар</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Действие</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo $product['price']; ?></td>
                            <td>
                                <input type="number" name="quantities[<?php echo $product['id']; ?>]" value="<?php echo $_SESSION['cart'][$product['id']]; ?>" min="1">
                            </td>
                            <td><?php echo $product['price'] * $_SESSION['cart'][$product['id']]; ?></td>
                            <td>
                                <a href="remove_from_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-danger">Удалить</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Обновить корзину</button>
        </form>
        <a href="checkout.php" class="btn btn-success">Оформить заказ</a>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>