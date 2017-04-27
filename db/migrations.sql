ALTER TABLE `employee` ADD `username` VARCHAR( 30 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'имя пользователя' AFTER `id` ;
ALTER TABLE `employee` ADD `password` VARCHAR( 50 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT 'хеш пароля' AFTER `username` ;
ALTER TABLE `employee` ADD UNIQUE (
`username`
);