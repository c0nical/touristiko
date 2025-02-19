<?php
session_start();
require_once('database.php');

// Проверка, авторизован ли администратор
// Предполагается, что есть проверка авторизации админа, например, через сессии
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

// Обработка формы добавления товара
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $year = $_POST['year'];
    $image_url = $_POST['image_url'];
    $available = isset($_POST['available']) ? 1 : 0;

    // Вставка данных в базу данных
    $stmt = $conn->prepare("INSERT INTO products (name, category, price, year, image_url, available) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdisi', $name, $category, $price, $year, $image_url, $available);

    if ($stmt->execute()) {
        $message = "Товар успешно добавлен.";
    } else {
        $message = "Ошибка при добавлении товара: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="assets/aos/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link href="assets/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
<!-- Header -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="assets/img/logowhite.png" alt="Логотип" width="auto" height="80">
            <span style="font-size: 3rem;">ТУРИСТИ.КО</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav" style="margin-right: 2rem;">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="catalog.php">Каталог</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Контакты</a>
                </li>
                <li class="nav-item">
                    <a href="checkauth.php"><i class="bi bi-person-circle" style="font-size: 1.5rem; color: #fff;"></i></a>
                </li>
                <li class="nav-item">
                    <a href="cart.php"><i class="bi bi-basket2-fill" style="font-size: 1.5rem; color: #fff;"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container" style="margin-top: 10rem;">
    <h1 class="my-4">Админ панель</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?php echo $message; ?></div>
    <?php endif; ?>

    <form method="post" action="admin.php">
        <div class="mb-3">
            <label for="name" class="form-label">Название товара</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Категория</label>
            <select class="form-select" id="category" name="category" required>
                <option value="инвентарь">Инвентарь</option>
                <option value="одежда">Одежда</option>
                <option value="аксессуары">Аксессуары</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Цена</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Год производства</label>
            <input type="number" class="form-control" id="year" name="year" required>
        </div>
        <div class="mb-3">
            <label for="image_url" class="form-label">URL изображения</label>
            <input type="text" class="form-control" id="image_url" name="image_url" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="available" name="available">
            <label class="form-check-label" for="available">В наличии</label>
        </div>
        <button type="submit" class="btn btn-primary">Добавить товар</button>
    </form>

    <hr>

    <h2>Список товаров</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Цена</th>
                <th>Год</th>
                <th>Изображение</th>
                <th>В наличии</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Получение списка товаров
            $sql = "SELECT * FROM products";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['year']; ?></td>
                    <td><img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" style="width: 50px;"></td>
                    <td><?php echo $row['available'] ? 'Да' : 'Нет'; ?></td>
                    <td>
                        <a href="edit_product.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Редактировать</a>
                        <a href="delete_product.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Удалить</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<div class="footer">
    <div class="fotcol1">
        <div class="logo2"> 
            <span><img src="assets/img/logowhitenontr.png" alt="logo" style="height: auto;"></span>
            <P style="font-size: 3rem; font-weight: lighter;">ТУРИСТИ.КО</P>
        </div>
        <P style="font-size: 1rem; opacity: 0.5;">© 2020 Все права защищены.</P>
        <P style="font-size: 1rem; opacity: 0.5">Пользовательское соглашение</P>
        <P style="font-size: 1rem; opacity: 0.5">Политика конфиденциальности</P>
    </div>
    <div class="fotcol2">
        <div class="socialnets">
            <a href="#"><img src="assets/img/TG.png"></a>
            <a href="#"><img src="assets/img/VK.png"></a>
        </div>
        <div class="menu">
            <ul style="flex-direction: column; gap: 1rem; font-weight:100;">
                <li><a href="#">Главная</a></li>
                <li><a href="#">О нас</a></li>
                <li><a href="#">Контакты</a></li>
                <li><a href="#">Личный кабинет</a></li>
                <li><a href="#">Корзина</a></li>
            </ul>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.min.js"></script>
<script src="assets/aos/aos.js"></script>
<script>
    // Инициализация AOS после загрузки библиотеки
    AOS.init();
</script>
</body>
</html>