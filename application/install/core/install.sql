CREATE DATABASE IF NOT EXISTS test_config DEFAULT CHARSET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `test_config` (
`id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
`path`  varchar(255) NOT NULL ,
`val`  varchar(255) NULL ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
;