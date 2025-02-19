<?php
require_once('database.php');

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Товар не найден!";
    exit();
}

$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4"><?php echo $product['name']; ?></h1>
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo $product['image_url']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="col-md-6">
            <h3>Цена: <?php echo number_format($product['price'], 2); ?> руб.</h3>
            <p>Категория: <?php echo $product['category']; ?></p>
            <p>Год производства: <?php echo $product['year']; ?></p>
            <a href="catalog.php" class="btn btn-dark">Вернуться к каталогу</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>