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
<?php
session_start();
// Подключение к базе данных

// Проверка, был ли передан идентификатор пользователя из vhod.php
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login']; // Получение имени из сессии

    // Проверка и получение других данных из сессии
    if (isset($_SESSION['pass'])) {
        $pass = $_SESSION['pass'];
    }
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
    }
    if (isset($_SESSION['firstname'])) {
        $firstname = $_SESSION['firstname'];
    }
    if (isset($_SESSION['secondname'])) {
        $secondname = $_SESSION['secondname'];
    }
    if (isset($_SESSION['id'])) {
      $id = $_SESSION['id'];
  }
} else {
    // Если идентификатор пользователя не был передан, перенаправление на страницу входа
    header("Location: login.html");
    exit();
}
?>
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
                    <a href="login.html"><i class="bi bi-person-circle" style="font-size: 1.5rem; color: #fff;"></i></a>
                </li>
                <li class="nav-item">
                    <a href="#"><i class="bi bi-basket2-fill" style="font-size: 1.5rem; color: #fff;"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Cabinet -->
<div class="block1">
    <div class="head1">
        Кабинет
    </div>
    <div class="green">
        <div class="textimg" style="position: relative; right: 10rem;">
            <div class="image">
                <img src="assets/img/avatar.png" style="box-shadow: 0 0 0 0;">
            </div>
            <div class="text">
                <div class="headtext">
                    Здравствуйте, <?php echo $firstname;?>!
                </div> 
                <div class="texttext">
                    <ul style="list-style-type: none; padding: 0; text-decoration: none;">
                        <li><a href="#">Имя: <?php echo $firstname;?></a></li>
                        <li><a href="#">Фамилия: <?php echo $secondname;?></a></li>
                        <li><a href="#">Почта: <?php echo $email;?></a></li>
                        <li><a href="#">Логин: <?php echo $login;?></a></li>
                        <li><a href="#">Личный ID: <?php echo $id;?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="btn" style="display:flex;">
            <button class="butts" style="color: #fff;" onclick="location.href='logout.php'">Выход</button>
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