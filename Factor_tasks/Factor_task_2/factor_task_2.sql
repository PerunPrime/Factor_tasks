-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 23 2016 г., 15:15
-- Версия сервера: 10.1.13-MariaDB
-- Версия PHP: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `factor_task_2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `Topic_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`id`, `Topic_name`) VALUES
(1, 'Новости'),
(3, 'Бухгалтерия'),
(4, 'Журналы'),
(7, 'Политика'),
(8, 'Культура'),
(9, 'Спорт'),
(10, 'Финансы'),
(11, 'Бюджетная'),
(12, 'Коммерческая'),
(13, 'Бюджетные'),
(14, 'Коммерческие'),
(15, 'Бюджетная бухгалтения'),
(16, 'Оплата труда'),
(17, 'Налоги и бухгалтерский учет'),
(18, 'Бухгалтер 911'),
(19, 'Бухгалтерская неделя');

-- --------------------------------------------------------

--
-- Структура таблицы `topics_to_topics`
--

CREATE TABLE `topics_to_topics` (
  `id` int(11) NOT NULL,
  `id_ancestor_topic` int(11) NOT NULL,
  `id_descendant_topic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics_to_topics`
--

INSERT INTO `topics_to_topics` (`id`, `id_ancestor_topic`, `id_descendant_topic`) VALUES
(1, 1, 7),
(2, 1, 8),
(3, 1, 9),
(4, 1, 10),
(5, 3, 11),
(6, 3, 12),
(7, 4, 13),
(8, 4, 14),
(9, 13, 15),
(10, 13, 16),
(11, 14, 17),
(12, 14, 18),
(13, 14, 19),
(14, 0, 1),
(15, 0, 3),
(16, 0, 4);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `topics_to_topics`
--
ALTER TABLE `topics_to_topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `topics_to_topics`
--
ALTER TABLE `topics_to_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
