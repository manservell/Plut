-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2017 г., 16:04
-- Версия сервера: 5.5.50-log
-- Версия PHP: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Pluton`
--

-- --------------------------------------------------------

--
-- Структура таблицы `codes_work`
--

CREATE TABLE IF NOT EXISTS `codes_work` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(15) NOT NULL COMMENT 'Код работ',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `type_id` int(10) unsigned NOT NULL COMMENT 'Вид работ (из таблицы видов работ)',
  `note` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Примечание'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `codes_work`
--

INSERT INTO `codes_work` (`id`, `code`, `name`, `type_id`, `note`) VALUES
(1, '10', 'Разработка новой техники на перспективу', 1, 1),
(2, '15', 'Поддержка продаж', 2, 1),
(3, '20', 'Разработка документации для внешних согласований', 3, 1),
(4, '25', 'Разработка КД для производства', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `department_structure`
--

CREATE TABLE IF NOT EXISTS `department_structure` (
  `id` int(10) unsigned NOT NULL,
  `structure_category` varchar(55) NOT NULL COMMENT 'Категории по структуре отдела'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Категории по структуре отдела';

--
-- Дамп данных таблицы `department_structure`
--

INSERT INTO `department_structure` (`id`, `structure_category`) VALUES
(1, 'Руководитель КО'),
(2, 'Начальник сектора'),
(3, 'Сотрудник'),
(4, 'Заместитель начальника КО');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) unsigned NOT NULL,
  `first_name` varchar(55) NOT NULL COMMENT 'Имя',
  `middle_name` varchar(55) NOT NULL COMMENT 'Отчество',
  `last_name` varchar(55) NOT NULL COMMENT 'Фамилия',
  `department_id` int(10) unsigned NOT NULL COMMENT 'Категория по структуре отдела',
  `sector_id` int(10) unsigned NOT NULL COMMENT 'Сектор',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус'
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `middle_name`, `last_name`, `department_id`, `sector_id`, `status`) VALUES
(3, 'Дмитрий', 'Анатольевич', 'Марченко', 1, 1, 1),
(7, 'Виктор', 'Давидович', 'Оденбах', 4, 1, 1),
(8, 'Владимир', 'Владимирович', 'Лабуткин', 4, 1, 1),
(14, 'Андрей', 'Викторович', 'Крутько', 2, 2, 1),
(15, 'Виктор', 'Иванович', 'Романчук', 3, 2, 1),
(16, 'Валентина', 'Николаевна', 'Панфилова', 3, 2, 1),
(17, 'Денис', 'Александрович', 'Савинов', 3, 2, 1),
(18, 'Андрей', 'Александрович', 'Бондаренко', 3, 2, 1),
(19, 'Александр', 'Викторович', 'Шрамко', 3, 2, 1),
(20, 'Валентина', 'Михайловна', 'Чирва', 3, 2, 1),
(21, 'Людмила', 'Леонидовна', 'Сербиновская', 3, 2, 1),
(22, 'Ольга', 'Сергеевна', 'Стаенная', 3, 2, 1),
(23, 'Евгений', 'Александрович', 'Бурцев', 2, 3, 1),
(24, 'Сергей', 'Николаевич', 'Щедрицкий', 3, 3, 1),
(25, 'Александр', 'Павлович', 'Завгородний', 3, 3, 1),
(26, 'Светлана', 'Витальевна', 'Павленко', 3, 3, 1),
(27, 'Людмила', 'Григорьевна', 'Касьян', 3, 3, 1),
(28, 'Юлия', 'Николаевна', 'Гулько', 3, 3, 1),
(29, 'Ирина', 'Дмитриевна', 'Кравчина', 3, 3, 1),
(30, 'Олег', 'Георгиевич', 'Товарчий', 3, 3, 1),
(31, 'Линда', 'Сергеевна', 'Колодяжная', 2, 4, 1),
(32, 'Надежда', 'Николаевна', 'Касьян', 3, 4, 1),
(33, 'Ирина', 'Николаевна', 'Черникова', 3, 4, 1),
(34, 'Наталья', 'Николаевна', 'Постовит', 2, 5, 1),
(35, 'Татьяна', 'Григорьевна', 'Палько', 3, 5, 1),
(36, 'Виктория', 'Александровна', 'Янушкевич', 3, 5, 1),
(37, 'Инна', 'Валентиновна', 'Толочная', 3, 5, 1),
(38, 'Наталья', 'Павловна', 'Павкина', 3, 5, 1),
(39, 'Инна', 'Николаевна', 'Хруслова', 3, 5, 1),
(40, 'Татьяна', 'Владимировна', 'Товарчий', 3, 5, 1),
(41, 'Юлия', 'Александровна', 'Чирва', 3, 5, 1),
(42, 'Алексей', 'Валентинович', 'Бедовский', 2, 6, 1),
(43, 'Александр', 'Леонидович', 'Воронин', 3, 6, 1),
(44, 'Алексей', 'Константинович', 'Резниченко', 3, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `number` varchar(15) NOT NULL COMMENT 'Номер заказа',
  `project_id` int(10) unsigned NOT NULL COMMENT 'Номер проекта',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `responsible_id` int(10) unsigned NOT NULL COMMENT 'Ответственный',
  `budget_hours` int(5) unsigned NOT NULL COMMENT 'Бюджет часов',
  `planned_end_date` date NOT NULL COMMENT 'Запланированная дата выполнения',
  `actual_end_date` date DEFAULT NULL COMMENT 'Фактическая дата выполнения',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `number`, `project_id`, `name`, `responsible_id`, `budget_hours`, `planned_end_date`, `actual_end_date`, `status`) VALUES
(8, '1910-1', 1, 'Отсек вторичных цепей КРУ-35 кВ (комплект 4 ячейки)', 19, 200, '2017-03-26', NULL, 0),
(9, '1911', 2, 'РУ-825 (комплект 10 ячеек)', 15, 350, '2017-02-24', '2017-02-10', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL,
  `number` varchar(15) NOT NULL COMMENT 'Номер пректа',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `customer` varchar(155) NOT NULL COMMENT 'Заказчик',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус',
  `responsible_id` int(10) unsigned NOT NULL COMMENT 'Ответственный',
  `budget_hours` int(5) unsigned NOT NULL COMMENT 'Бюджет часов',
  `planned_end_date` date NOT NULL COMMENT 'Запланированная дата выполнения',
  `actual_end_date` date DEFAULT NULL COMMENT 'Фактическая дата выполнения'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `number`, `name`, `customer`, `status`, `responsible_id`, `budget_hours`, `planned_end_date`, `actual_end_date`) VALUES
(1, '001', 'Тяговая подстанция', 'Стокгольм', 0, 43, 200, '2017-01-27', '2017-01-31'),
(2, '002', 'Оборудование постоянного тока', 'Баку', 1, 3, 300, '2017-01-31', '2017-02-16'),
(3, '003', 'Реверсивный выпрямитель', 'IPH центр', 1, 23, 100, '2017-01-20', '2017-01-18'),
(4, '004', 'Тяговая подстанция', 'Баку', 1, 22, 34, '2017-01-28', '2017-01-29'),
(5, '005', 'Ретрофит', 'Киев метрополитен', 2, 16, 46, '2017-02-09', '2017-02-26'),
(6, '006', 'Оборудование постоянного тока', 'Харьков-метро проект', 2, 3, 234, '2017-02-12', '2017-02-25'),
(7, '007', 'Тяговая подстанция', 'Львовская ж/д', 0, 33, 543, '2017-02-23', '2017-02-26');

-- --------------------------------------------------------

--
-- Структура таблицы `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `id` int(11) unsigned NOT NULL,
  `responsible_for` varchar(55) NOT NULL COMMENT 'Категории по проектам'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `project_category`
--

INSERT INTO `project_category` (`id`, `responsible_for`) VALUES
(1, 'Ответственный за проект'),
(2, 'Ответственный за заказ');

-- --------------------------------------------------------

--
-- Структура таблицы `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `id` int(10) unsigned NOT NULL,
  `sector` varchar(55) NOT NULL COMMENT 'Сектор'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sector`
--

INSERT INTO `sector` (`id`, `sector`) VALUES
(1, 'Руководство'),
(2, 'Тягового оборудования'),
(3, 'Низковольтных комплектных устройств'),
(4, 'Электронных устройств и телемеханики'),
(5, 'Отправочной документации'),
(6, 'Оборудования среднего напряжения');

-- --------------------------------------------------------

--
-- Структура таблицы `work_types`
--

CREATE TABLE IF NOT EXISTS `work_types` (
  `id` int(10) unsigned NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'Виды работ'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='Таблица видов работ';

--
-- Дамп данных таблицы `work_types`
--

INSERT INTO `work_types` (`id`, `type`) VALUES
(1, 'Основные'),
(2, 'Вспомогалельные'),
(3, 'Непроизводительное время');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `codes_work`
--
ALTER TABLE `codes_work`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Индексы таблицы `department_structure`
--
ALTER TABLE `department_structure`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Индексы таблицы `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

--
-- Индексы таблицы `project_category`
--
ALTER TABLE `project_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `work_types`
--
ALTER TABLE `work_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `codes_work`
--
ALTER TABLE `codes_work`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `department_structure`
--
ALTER TABLE `department_structure`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT для таблицы `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `project_category`
--
ALTER TABLE `project_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `work_types`
--
ALTER TABLE `work_types`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
