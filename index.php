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
<div class="hero" data-aos="fade-down">
    <img src="assets/img/bghero.png" alt="Background Image">
    <div class="content">
        <img src="assets/img/logocolor.png" alt="Logo" class="logo" data-aos="zoom-in">
        <h1 data-aos="fade-down">Touristi.ko</h1>
        <h2>Магазин туристических принадлежностей</h2>
        <p>Лучшие инструменты для ваших путешествий.</p>
        <div class="btn-group" >
            <button type="button" class="btn btn-outline-light">Товары</button>
            <button type="button" class="btn btn-outline-light">О нас</button>
        </div>
    </div>
</div>
<!-- Новинки -->
<!-- Карточки товаров -->
<div class="block1" data-aos="fade-up">
    <div class="head1">
        Новинки
    </div>
    <div class="green" style="padding: 0 2rem 0 2rem">
        <div class="container my-5">
            <div class="row g-4">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="card h-80">
                            <img src="<?php echo $row['image_url']; ?>" style="height:200px;" class="card-img-top" alt="<?php echo $row['name']; ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo $row['name']; ?></h5>
                                <p class="card-text"><?php echo number_format($row['price'], 2); ?> ₽</p>
                                <button class="butts">Купить</button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
        </div>
        <button class="butts" style="display:flex; justify-content:center; margin-top: 3rem;" onclick ="window.location.href='catalog.php'" >Больше товаров</button>
    </div>
    </div>
<!-- О нас -->
<div class="block1" data-aos="fade-up">
    <div class="head1">
        О нас
    </div>
    <div class="green">
        <div class="textimg" style="position: relative; right: 10rem;" data-aos="fade-right">
            <div class="image">
                <img src="assets/img/about1.jpg">
            </div>
            <div class="text">
                <div class="headtext">
                Топ продаж   
                </div> 
                <div class="texttext">
                Мы собрали самые популярные товары среди наших покупателей. Здесь вы найдёте всё необходимое для комфортного отдыха на природе.
                </div>
            </div>
        </div>
        <div class="textimg" style="position: relative; right: -10rem" data-aos="fade-left">
            <div class="text">
                <div class="headtext">
                Новинки сезона   
                </div> 
                <div class="texttext">
                У нас появились новые модели палаток, спальных мешков и рюкзаков. Попробуйте новинки этого сезона!
                </div>
            
            </div>
            <div class="image">
                <img src="assets/img/about2.jpg">
            </div>
        </div>
        <div class="textimg" style="position: relative; right: 10rem;" data-aos="fade-right">
            <div class="image">
                <img src="assets/img/about3.jpg">
            </div>
            <div class="text">
                <div class="headtext">
                Акции и скидки   
                </div> 
                <div class="texttext">
                Только сейчас у вас есть возможность приобрести качественные туристические принадлежности по выгодной цене. Успевайте сделать заказ!
                </div>
            </div>
        </div>
    </div>
    <button class="butts" style="display:flex; justify-content:center; margin-top: 3rem;" onclick ="window.location.href='catalog.php'" >Перейти к странице товаров</button>
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