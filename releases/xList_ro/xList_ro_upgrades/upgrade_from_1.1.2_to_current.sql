ALTER TABLE `{$db_prefix}files` ADD `free_expire_date` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `{$db_prefix}files` ADD `free` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no';
