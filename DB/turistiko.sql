-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 02 2024 г., 10:23
-- Версия сервера: 10.7.5-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `turistiko`
--

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `year` int(11) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `available` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `year`, `image_url`, `available`, `created_at`) VALUES
(1, 'Куртка дерьмо', 'одежда', '7999.00', 2020, 'https://images.satu.kz/157198507_w600_h600_157198507.jpg', 1, '2024-07-02 06:06:54'),
(2, 'Куртка говно', 'одежда', '10999.00', 2021, 'https://fridaywear.ru/upload/resize_cache/webp/iblock/1f1/1f1b9b305a57f4dbc795373f4009ab7a.webp', 1, '2024-07-02 06:11:07'),
(3, 'Рюкзак понос', 'инвентарь', '10999.00', 2021, 'https://img.nozhikov.ru/images/products/1/1192/660972712/DSC04017-Edit.jpg', 1, '2024-07-02 06:12:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `login` varchar(32) NOT NULL,
  `pass` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `firstname` varchar(32) NOT NULL,
  `secondname` varchar(32) NOT NULL,
  `id` varchar(999) NOT NULL,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `pass`, `email`, `firstname`, `secondname`, `id`, `is_admin`) VALUES
('123', '123', 'aaa@taaa.taaa', 'Cs1.6', 'CSS', '', 0),
('gavno', 'gavno', 'gavno@gavno.mocha', 'gavno', 'gavno', '956', 0),
('admin', 'admin', 'admin@mail.ru', 'admin', 'admin', '71', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
