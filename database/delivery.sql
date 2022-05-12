-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 12 2022 г., 16:16
-- Версия сервера: 10.1.38-MariaDB
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `delivery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `distance_for_sending`
--

CREATE TABLE `distance_for_sending` (
  `id` int(11) NOT NULL,
  `distance_from` float NOT NULL,
  `distance_up_to` float NOT NULL,
  `coefficient` float DEFAULT NULL,
  `dop_param` varchar(250) DEFAULT NULL,
  `id_transport_company` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  `standart_coefficient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `distance_for_sending`
--

INSERT INTO `distance_for_sending` (`id`, `distance_from`, `distance_up_to`, `coefficient`, `dop_param`, `id_transport_company`, `price`, `standart_coefficient`) VALUES
(1, 10, 15, 0.2, 'доп. параметры будут позже', NULL, 90, 1),
(2, 20, 50, 0.3, 'доп. параметры будут позже', NULL, 50, 1),
(3, 50, 100, 0.7, 'доп. параметры будут позже2', NULL, 80, 1),
(4, 100, 150, 1.1, 'доп. параметры будут позже2', NULL, 159, 1),
(5, 0, 10, 0, 'доп. параметры будут позже2', NULL, 20, 1),
(6, 15, 20, 0.45, 'доп. параметры будут позже', NULL, 190, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `package_weight`
--

CREATE TABLE `package_weight` (
  `id` int(11) NOT NULL,
  `weight_from` float NOT NULL,
  `weight_upto` float NOT NULL,
  `price` float NOT NULL,
  `coefficient` float DEFAULT NULL,
  `id_transport_company` int(11) DEFAULT NULL,
  `standart_coefficient` int(11) DEFAULT NULL,
  `dop_param` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `package_weight`
--

INSERT INTO `package_weight` (`id`, `weight_from`, `weight_upto`, `price`, `coefficient`, `id_transport_company`, `standart_coefficient`, `dop_param`) VALUES
(1, 0, 0.1, 40, 0.1, NULL, 1, 'Доп. параметры'),
(2, 0.1, 0.3, 60, 0.2, NULL, 1, 'Доп. параметры.будет позже'),
(3, 0.3, 0.51, 75, 0.3, NULL, 1, 'очень хрупкий груз'),
(4, 0.51, 1, 110, 0.42, NULL, 1, 'Доп. параметры.будет позже'),
(5, 1, 2.2, 160, 0.45, NULL, 1, 'Доп. параметры.будет позже');

-- --------------------------------------------------------

--
-- Структура таблицы `transport_company`
--

CREATE TABLE `transport_company` (
  `id` int(11) NOT NULL,
  `name_company` varchar(250) NOT NULL,
  `total_number_cars` int(11) NOT NULL,
  `average_number_car` int(11) NOT NULL,
  `current_orders_fast_delivery` int(11) NOT NULL,
  `current_order_regular_delivery` int(11) NOT NULL,
  `dop_info_company` varchar(250) DEFAULT NULL,
  `dop_number_fast_delivery_in_day` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `transport_company`
--

INSERT INTO `transport_company` (`id`, `name_company`, `total_number_cars`, `average_number_car`, `current_orders_fast_delivery`, `current_order_regular_delivery`, `dop_info_company`, `dop_number_fast_delivery_in_day`) VALUES
(1, 'Компания А', 13, 7, 39, 167, 'компания не загружена', 21),
(2, 'Компания B', 23, 8, 93, 162, 'компания не загружена', 40),
(3, 'Компания C', 14, 6, 46, 113, 'компания не загружена', 14),
(4, 'Компания D', 5, 6, 46, 90, 'компания загружена', 13);

-- --------------------------------------------------------

--
-- Структура таблицы `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name_wrehouse` varchar(250) NOT NULL,
  `quarter` int(11) NOT NULL,
  `position_relative_o` float NOT NULL,
  `position_relative_a` float DEFAULT NULL,
  `position_relative_b` float DEFAULT NULL,
  `warehouse_address` varchar(250) DEFAULT NULL,
  `warehouse_dopinfo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `warehouses`
--

INSERT INTO `warehouses` (`id`, `name_wrehouse`, `quarter`, `position_relative_o`, `position_relative_a`, `position_relative_b`, `warehouse_address`, `warehouse_dopinfo`) VALUES
(1, 'Склад на таганке', 1, 14, 6, 0, 'Расположен на таганской улице', 'склад заполнен на 54%'),
(2, 'Склад на Кажуховской', 2, 3, 0, 8, 'Расположен на кожуховской улице', 'склад заполнен на 10%'),
(3, 'склад на бульваре рокоссовского', 3, 11, 0, 14, 'около метро', 'склад заполнен на 19%'),
(4, 'склад на партизанской', 4, 56, 48, 0, 'улица партизанская', 'склад заполнен на 84%'),
(5, 'склад на ильиче', 2, 11, 0, 4, 'Расположен на улице ильича', 'склад заполнен на 69%'),
(6, 'Склад на открытом шоссе', 2, 14, 0, 4, 'Открытое шоссе д34', 'склад заполнен на 84%');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `distance_for_sending`
--
ALTER TABLE `distance_for_sending`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transport_company` (`id_transport_company`);

--
-- Индексы таблицы `package_weight`
--
ALTER TABLE `package_weight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transport_company` (`id_transport_company`);

--
-- Индексы таблицы `transport_company`
--
ALTER TABLE `transport_company`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `distance_for_sending`
--
ALTER TABLE `distance_for_sending`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `package_weight`
--
ALTER TABLE `package_weight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `transport_company`
--
ALTER TABLE `transport_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `distance_for_sending`
--
ALTER TABLE `distance_for_sending`
  ADD CONSTRAINT `distance_for_sending_ibfk_1` FOREIGN KEY (`id_transport_company`) REFERENCES `transport_company` (`id`);

--
-- Ограничения внешнего ключа таблицы `package_weight`
--
ALTER TABLE `package_weight`
  ADD CONSTRAINT `package_weight_ibfk_1` FOREIGN KEY (`id_transport_company`) REFERENCES `transport_company` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
