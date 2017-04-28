-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 28 2017 г., 20:06
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
('Admin', '44', 1487842668),
('Admin', '9', 1487842668),
('Guest', '3', NULL),
('Guest', '4', 1487840022),
('User', '1', 1487840045),
('User', '23', 1493321512),
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
('codeswork_index', 2, NULL, NULL, NULL, 1493321290, 1493321290),
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
('site_about', 2, NULL, NULL, NULL, 1493321234, 1493321234),
('site_index', 2, NULL, NULL, NULL, 1487810771, 1487810771),
('site_logout', 2, NULL, NULL, NULL, 1487837762, 1487837762),
('tabel_index', 2, NULL, NULL, NULL, 1489330570, 1489330570),
('timesheet_index', 2, NULL, NULL, NULL, 1493322093, 1493322093),
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
('Admin', 'codeswork_index'),
('User', 'CodeworkIndex'),
('Admin', 'create_employee'),
('User', 'departmentstructure_index'),
('User', 'departmentstructure_update'),
('Admin', 'employee_create'),
('User', 'employee_index'),
('Admin', 'employee_update'),
('User', 'Guest'),
('User', 'orders_create'),
('User', 'orders_index'),
('User', 'project_create'),
('User', 'project_index'),
('User', 'projectcategory_index'),
('User', 'sector_index'),
('User', 'site_about'),
('Guest', 'site_index'),
('User', 'site_logout'),
('User', 'tabel_index'),
('User', 'timesheet_index'),
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
