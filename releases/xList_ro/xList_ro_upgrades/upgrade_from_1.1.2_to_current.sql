ALTER TABLE `{$db_prefix}files` ADD `free_expire_date` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `{$db_prefix}files` ADD `free` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no';
ALTER TABLE `{$db_prefix}files` ADD `vip_torrent` ENUM( '0', '1' ) NOT NULL DEFAULT '0';
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_set', '6');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_get', '4');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_get_one', '5');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_tekst', 'Vip Torrent Only !!');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_one', 'true');
