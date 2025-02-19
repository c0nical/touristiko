<?php
require_once('database.php');

// Получение параметров сортировки и фильтрации
$order = $_GET['order'] ?? 'created_at';
$category = $_GET['category'] ?? '';
$whereClause = $category ? "AND category='$category'" : '';

// Получение данных из базы данных
$sql = "SELECT * FROM products WHERE available=1 $whereClause ORDER BY $order DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html >
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
<body>
<div class="container" style="margin-top: 10rem;">
    <h1 class="my-4">Каталог товаров</h1>

    <!-- Форма сортировки и фильтрации -->
    <form class="row mb-4">
        <div class="col-md-3">
            <select name="order" class="form-select">
                <option value="created_at">Новизне</option>
                <option value="year">Году производства</option>
                <option value="name">Наименованию</option>
                <option value="price">Цене</option>
            </select>
        </div>
        <div class="col-md-3">
            <select name="category" class="form-select">
                <option value="">Все категории</option>
                <option value="инвентарь">Инвентарь</option>
                <option value="одежда">Одежда</option>
                <option value="аксессуары">Аксессуары</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100 mt-3 mt-md-0">Применить</button>
        </div>
    </form>

    <!-- Карточки товаров -->
    <div class="container mt-4">
        <div class="row">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo $row['image_url']; ?>" class="card-img-top" alt="<?php echo $row['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['name']; ?></h5>
                            <p class="card-text"><?php echo number_format($row['price'], 2); ?> руб.</p>
                        </div>
                        <div class="card-footer">
                            <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-dark w-100 mt-3 mt-md-0" style="margin:0;">Подробнее</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
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