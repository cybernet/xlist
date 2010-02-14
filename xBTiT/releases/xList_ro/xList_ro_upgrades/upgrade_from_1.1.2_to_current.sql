ALTER TABLE `{$db_prefix}files` ADD `free_expire_date` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE `{$db_prefix}files` ADD `free` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'no';
ALTER TABLE `{$db_prefix}files` ADD `vip_torrent` ENUM( '0', '1' ) NOT NULL DEFAULT '0';
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_set', '6');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_get', '4');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_get_one', '5');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_tekst', 'Vip Torrent Only !!');
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES ('vip_one', 'true');
-- v1.1.2
CREATE TABLE `{$db_prefix}bannedclient` (
  `id` int(10) NOT NULL auto_increment,
  `peer_id` varchar(16) NOT NULL,
  `peer_id_ascii` varchar(8) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `reason` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `peer_id` (`peer_id`),
  KEY `peer_id_ascii` (`peer_id_ascii`),
  KEY `user_agent` (`user_agent`)
) ENGINE=MyISAM;
INSERT INTO `{$db_prefix}users_level` 
      ( `id_level` , `level` , `view_torrents` , `edit_torrents` ,
      `delete_torrents` , `view_users` , `edit_users` , `delete_users` , 
      `view_news` , `edit_news` , `delete_news` , `can_upload` , `can_download` , 
      `view_forum` , `edit_forum` , `delete_forum` , `predef_level` , `can_be_deleted` ,
      `admin_access` , `prefixcolor` , `suffixcolor` , `WT`  ) 
       VALUES(
       '3', 'Parked', 'no', 'no', 'no', 'no', 'no', 'no', 'yes',
       'no', 'no', 'no', 'no', 'no', 'no', 'no', 'member', 'yes', 'no', '<span style=\'color:#663300\'>', '</span>', '0');
ALTER TABLE `{$db_prefix}users` ADD `parked` INT( 9 ) NOT NULL DEFAULT '0';
ALTER TABLE `{$db_prefix}style` ADD `google_ad_slot` VARCHAR( 32 ) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '5995179394'

