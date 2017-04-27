-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 14 2017 г., 22:05
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `pluton`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('Admin', '2', NULL),
('Admin', '9', 1487842668),
('Guest', '3', NULL),
('Guest', '4', 1487840022),
('User', '1', 1487840045),
('User', '5', NULL),
('User', '6', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('Admin', 1, NULL, NULL, NULL, 1487779674, 1487779674),
('codeswork_create', 2, NULL, NULL, NULL, 1487914578, 1487914578),
('CodeworkIndex', 2, NULL, NULL, NULL, 1487808864, 1487808864),
('create_employee', 2, NULL, NULL, NULL, 1487779651, 1487780184),
('departmentstructure_index', 2, NULL, NULL, NULL, 1487881779, 1487881779),
('departmentstructure_update', 2, NULL, NULL, NULL, 1487881814, 1487881814),
('employee_create', 2, NULL, NULL, NULL, 1487840148, 1487840148),
('employee_index', 2, NULL, NULL, NULL, 1487834586, 1487834586),
('employee_update', 2, NULL, NULL, NULL, 1487835410, 1487835410),
('Guest', 1, NULL, NULL, NULL, 1487809101, 1487809101),
('orders_create', 2, NULL, NULL, NULL, 1487914628, 1487914628),
('orders_index', 2, NULL, NULL, NULL, 1487873510, 1487873510),
('project_create', 2, NULL, NULL, NULL, 1487914666, 1487914666),
('project_index', 2, NULL, NULL, NULL, 1487873555, 1487873555),
('projectcategory_index', 2, NULL, NULL, NULL, 1487914839, 1487914839),
('sector_index', 2, NULL, NULL, NULL, 1487914796, 1487914796),
('site_index', 2, NULL, NULL, NULL, 1487810771, 1487810771),
('site_logout', 2, NULL, NULL, NULL, 1487837762, 1487837762),
('tabel_index', 2, NULL, NULL, NULL, 1489330570, 1489330570),
('User', 1, NULL, NULL, NULL, 1487780199, 1487780199),
('workdays_create', 2, NULL, NULL, NULL, 1489330730, 1489330730),
('workdays_index', 2, NULL, NULL, NULL, 1489330675, 1489330675),
('worktypes_index', 2, NULL, NULL, NULL, 1487914889, 1487914889);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('User', 'codeswork_create'),
('User', 'CodeworkIndex'),
('Admin', 'create_employee'),
('User', 'create_employee'),
('User', 'departmentstructure_index'),
('User', 'departmentstructure_update'),
('Admin', 'employee_create'),
('Admin', 'employee_index'),
('Admin', 'employee_update'),
('User', 'Guest'),
('User', 'orders_create'),
('User', 'orders_index'),
('User', 'project_create'),
('User', 'project_index'),
('User', 'projectcategory_index'),
('User', 'sector_index'),
('Guest', 'site_index'),
('User', 'site_logout'),
('User', 'tabel_index'),
('Admin', 'User'),
('User', 'workdays_create'),
('User', 'workdays_index'),
('User', 'worktypes_index');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `codes_work`
--

CREATE TABLE IF NOT EXISTS `codes_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(15) NOT NULL COMMENT 'Код работ',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `type_id` int(10) unsigned NOT NULL COMMENT 'Вид работ (из таблицы видов работ)',
  `note` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Примечание',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `codes_work`
--

INSERT INTO `codes_work` (`id`, `code`, `name`, `type_id`, `note`) VALUES
(1, '10', 'Разработка новой техники на перспективу', 1, 1),
(2, '15', 'Поддержка продаж', 2, 1),
(3, '20', 'Разработка документации для внешних согласований', 3, 1),
(4, '25', 'Разработка КД для производства', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `department_structure`
--

CREATE TABLE IF NOT EXISTS `department_structure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `structure_category` varchar(55) NOT NULL COMMENT 'Категории по структуре отдела',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Категории по структуре отдела' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `department_structure`
--

INSERT INTO `department_structure` (`id`, `structure_category`) VALUES
(1, 'Руководитель КО'),
(2, 'Начальник сектора'),
(3, 'Сотрудник');

-- --------------------------------------------------------

--
-- Структура таблицы `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT 'имя пользователя',
  `password` varchar(50) NOT NULL COMMENT 'хеш пароля',
  `first_name` varchar(55) NOT NULL COMMENT 'Имя',
  `middle_name` varchar(55) NOT NULL COMMENT 'Отчество',
  `last_name` varchar(55) NOT NULL COMMENT 'Фамилия',
  `department_id` int(10) unsigned NOT NULL COMMENT 'Категория по структуре отдела',
  `sector_id` int(10) unsigned NOT NULL COMMENT 'Сектор',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `employee`
--

INSERT INTO `employee` (`id`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `department_id`, `sector_id`, `status`) VALUES
(1, 'user1', 'c3284d0f94606de1fd2af172aba15bf3', 'Алексей', 'Валентинович', 'Бедовский', 2, 6, 1),
(2, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 'Алексей', 'Константинович', 'Резниченко', 3, 6, 1),
(3, 'user2', 'c3284d0f94606de1fd2af172aba15bf3', 'Дмитрий', 'Анатольевич', 'Марченко', 1, 1, 1),
(4, 'user3', 'c3284d0f94606de1fd2af172aba15bf3', 'Андрей', 'Викторович', 'Крутько', 2, 2, 1),
(5, 'user4', 'c3284d0f94606de1fd2af172aba15bf3', 'Евгений', 'Александрович', 'Бурцев', 2, 3, 1),
(6, 'user5', '1eb04185280560d6e6a70eae59459558', 'Василий', 'Иванович', 'Пупкин', 3, 3, 1),
(9, 'karasmg', '45ecb98e1416ebd6e5efe4496a5025c1', 'Максим', 'Григорьевич', 'Карась', 1, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1487776114),
('m140506_102106_rbac_init', 1487776308);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(15) NOT NULL COMMENT 'Номер заказа',
  `project_id` int(10) unsigned NOT NULL COMMENT 'Номер проекта',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `responsible_id` int(10) unsigned NOT NULL COMMENT 'Ответственный',
  `budget_hours` int(5) unsigned NOT NULL COMMENT 'Бюджет часов',
  `planned_end_date` date NOT NULL COMMENT 'Запланированная дата выполнения',
  `actual_end_date` date DEFAULT NULL COMMENT 'Фактическая дата выполнения',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `number`, `project_id`, `name`, `responsible_id`, `budget_hours`, `planned_end_date`, `actual_end_date`, `status`) VALUES
(5, '1912-3', 3, 'РУ-825ОШ-Д-П', 4, 87, '2017-02-17', '2017-02-19', 2),
(6, '1920-1', 1, 'РУ-825 (комплект 10 ячеек)', 5, 500, '2017-02-26', '2017-02-28', 1),
(7, '1910-1', 5, 'Отсек вторичных цепей КРУ-35 кВ. (комплект 4 ячейки)', 5, 325, '2017-05-20', NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(15) NOT NULL COMMENT 'Номер пректа',
  `name` varchar(155) NOT NULL COMMENT 'Наименование',
  `customer` varchar(155) NOT NULL COMMENT 'Заказчик',
  `status` int(1) unsigned NOT NULL DEFAULT '1' COMMENT 'Статус',
  `responsible_id` int(10) unsigned NOT NULL COMMENT 'Ответственный',
  `budget_hours` int(5) unsigned NOT NULL COMMENT 'Бюджет часов',
  `planned_end_date` date NOT NULL COMMENT 'Запланированная дата выполнения',
  `actual_end_date` date DEFAULT NULL COMMENT 'Фактическая дата выполнения',
  PRIMARY KEY (`id`),
  UNIQUE KEY `number` (`number`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `project`
--

INSERT INTO `project` (`id`, `number`, `name`, `customer`, `status`, `responsible_id`, `budget_hours`, `planned_end_date`, `actual_end_date`) VALUES
(1, '001', 'Тяговая подстанция', 'Стокгольм', 0, 1, 200, '2017-01-27', '2017-01-31'),
(2, '002', 'Оборудование постоянного тока', 'Баку', 1, 3, 300, '2017-01-31', '2017-02-16'),
(3, '003', 'Реверсивный выпрямитель', 'IPH центр', 1, 2, 100, '2017-01-20', '2017-01-18'),
(4, '004', 'Тяговая подстанция', 'Баку', 1, 1, 34, '2017-01-28', '2017-01-29'),
(5, '005', 'Ретрофит', 'Киев метрополитен', 2, 2, 46, '2017-02-09', '2017-02-26'),
(6, '006', 'Оборудование постоянного тока', 'Харьков-метро проект', 2, 3, 234, '2017-02-12', '2017-02-25'),
(7, '007', 'Тяговая подстанция', 'Львовская ж/д', 2, 2, 543, '2017-02-23', '2017-02-26');

-- --------------------------------------------------------

--
-- Структура таблицы `project_category`
--

CREATE TABLE IF NOT EXISTS `project_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `responsible_for` varchar(55) NOT NULL COMMENT 'Категории по проектам',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sector` varchar(55) NOT NULL COMMENT 'Сектор',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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
-- Структура таблицы `tabel`
--

CREATE TABLE IF NOT EXISTS `tabel` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'индекс',
  `project_id` int(11) unsigned NOT NULL COMMENT 'связь с проектами',
  `order_id` int(11) unsigned NOT NULL COMMENT 'связь с заказами',
  `wt_id` int(11) unsigned NOT NULL COMMENT 'связь с типами работ',
  `employee_id` int(11) unsigned NOT NULL COMMENT 'связь с сотрудниками',
  `t_date` date NOT NULL COMMENT 'дата',
  `t_hours` int(2) unsigned NOT NULL DEFAULT '0' COMMENT 'отработанные часы',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `tabel`
--

INSERT INTO `tabel` (`id`, `project_id`, `order_id`, `wt_id`, `employee_id`, `t_date`, `t_hours`) VALUES
(1, 1, 5, 1, 2, '2017-02-22', 8),
(2, 1, 5, 1, 2, '2017-02-23', 8),
(3, 1, 5, 1, 2, '2017-02-24', 8),
(4, 1, 5, 1, 2, '2017-02-25', 0),
(5, 1, 5, 1, 2, '2017-02-26', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `work_days`
--

CREATE TABLE IF NOT EXISTS `work_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `date` date NOT NULL COMMENT 'Дата',
  `hours` int(2) unsigned DEFAULT NULL COMMENT 'Кол-во рабочих часов',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Дамп данных таблицы `work_days`
--

INSERT INTO `work_days` (`id`, `date`, `hours`) VALUES
(1, '2017-02-15', 12),
(2, '2017-02-16', 16),
(3, '2017-02-17', 8),
(4, '2017-02-18', 8),
(5, '2017-02-19', 0),
(6, '2017-02-20', 0),
(7, '2017-02-21', 8),
(8, '2017-02-22', 8),
(9, '2017-02-23', 8),
(10, '2017-02-24', 8),
(11, '2017-02-25', 8),
(12, '2017-02-26', 0),
(13, '2017-02-27', 0),
(14, '2017-02-28', 8),
(15, '2017-03-01', 8),
(16, '2017-03-02', 8),
(17, '2017-03-03', 8),
(18, '2017-03-04', 8),
(19, '2017-03-05', 4),
(20, '2017-03-06', 0),
(21, '2017-03-07', 8),
(22, '2017-03-08', 8),
(23, '2017-03-09', 8),
(24, '2017-03-10', 10),
(25, '2017-03-11', 8),
(26, '2017-03-12', 0),
(27, '2017-03-13', 0),
(28, '2017-03-14', 8),
(29, '2017-03-15', 8),
(30, '2017-03-16', 8),
(31, '2017-03-17', 8),
(32, '2017-03-18', 8),
(33, '2017-03-19', 0),
(34, '2017-03-20', 0),
(35, '2017-03-21', 12),
(36, '2017-03-22', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `work_types`
--

CREATE TABLE IF NOT EXISTS `work_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL COMMENT 'Виды работ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица видов работ' AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `work_types`
--

INSERT INTO `work_types` (`id`, `type`) VALUES
(1, 'Основные'),
(2, 'Вспомогалельные'),
(3, 'Непроизводительное время');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
