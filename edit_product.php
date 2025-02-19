<?php
session_start();
require_once('database.php');

// Проверка, авторизован ли администратор
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

// Получение данных товара
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

// Обработка формы редактирования
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $image_url = $_POST['image_url'];
    $available = isset($_POST['available']) ? 1 : 0;

    // Обновление данных в базе данных
    $stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, year=?, image_url=?, available=? WHERE id=?");
    $stmt->bind_param('ssdisii', $name, $category, $price, $year, $image_url, $available, $id);

    if ($stmt->execute()) {
        $message = "Товар успешно обновлен.";
    } else {
        $message = "Ошибка при обновлении товара: " . $stmt->error;
    }

    $stmt->close();
    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Редактирование товара</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Редактирование товара</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post" action="edit_product.php?id=<?php echo $product['id']; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select class="form-select" id="category" name="category" required>
                <option value="инвентарь" <?php echo $product['category'] == 'инвентарь' ? 'selected' : ''; ?>>Инвентарь</option>
                <option value="одежда" <?php echo $product['category'] == 'одежда' ? 'selected' : ''; ?>>Одежда</option>
                <option value="аксессуары" <?php echo $product['category'] == 'аксессуары' ? 'selected' : ''; ?>>Аксессуары</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Год производства</label>
            <input type="number" class="form-control" id="year" name="year" value="<?php echo $product['year']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">URL изображения</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="<?php echo $product['image_url']; ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="available" name="available" <?php echo $product['available'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="available">В наличии</label>
        </div>
        <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        <a href="admin.php" class="btn btn-secondary">Отмена</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>