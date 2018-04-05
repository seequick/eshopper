-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 05 2018 г., 07:17
-- Версия сервера: 5.5.57-log
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `fml`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `sort_order`, `status`) VALUES
(1, 'Рубашки', 1, 1),
(2, 'Сумки', 2, 1),
(3, 'Футболки', 3, 1),
(4, 'Майки', 4, 1),
(5, 'Платья', 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `code` int(11) NOT NULL,
  `price` float NOT NULL,
  `availability` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `is_new` int(11) NOT NULL DEFAULT '0',
  `is_recommended` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `code`, `price`, `availability`, `brand`, `description`, `is_new`, `is_recommended`, `status`) VALUES
(1, 'Рубашка №1', 1, 1839707, 395, 1, 'Asus', 'Описание для Рубашки №1. Новое', 1, 0, 1),
(2, 'Футболка №1', 3, 2343847, 305, 0, 'Hewlett Packard', 'Описание для Футболки №1. ', 0, 1, 1),
(3, 'Футболка №2', 3, 2028027, 270, 1, 'Asus', 'Описание для Футболки №2', 0, 1, 1),
(4, 'Футболка №3', 3, 2019487, 325, 1, 'Acer', 'Описание для Футболки №3', 0, 1, 1),
(5, 'Майка №1', 4, 1953212, 275, 1, 'Acer', 'Описание для Майки №1', 0, 0, 1),
(6, 'Сумка №1', 2, 1602042, 370, 0, 'Lenovo', 'Описание для Сумки №1. Недопустен', 0, 0, 1),
(7, 'Сумка №2', 2, 2028367, 430, 1, 'Asus', 'Описание для Сумки №2', 0, 1, 1),
(8, 'Платье №1', 5, 1129365, 780, 1, 'Samsung', 'Описание для Платья №1', 1, 1, 1),
(9, 'Платье №2', 5, 1128670, 640, 1, 'Samsung', 'Описание для Платья №2', 0, 0, 1),
(10, 'Платье №3', 5, 683364, 210, 1, 'Gazer', 'Описание для Платья №3. Новое', 0, 0, 1),
(11, 'Платье №4', 5, 355025, 175, 1, 'Dell', 'Описание для Платья №4', 0, 0, 1),
(12, 'Платье №5', 5, 1563832, 1320, 1, 'Everest', 'Описание для Платья №5', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_comment` text NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_order`
--

INSERT INTO `product_order` (`id`, `user_name`, `user_phone`, `user_comment`, `user_id`, `date`, `products`, `status`) VALUES
(1, 'fsdfsd', '1', '123123123', 4, '2015-05-14 09:54:45', '{\"1\":1,\"2\":1,\"3\":2}', 3),
(2, 'САША1', 'g3424242342', '', 4, '2015-05-18 15:34:42', '{\"44\":3,\"43\":3}', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'Александр', 'alex@mail.com', '111111', ''),
(4, 'Дратути', 'test@gmail.com', '222222', 'admin'),
(5, 'Серый', 'serg@mail.com', '111111', ''),
(6, 'dasdasdsa', 'pswdghjik', 'vaska@pipka.usa', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT для таблицы `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
