ALTER TABLE `{$db_prefix}users` ADD `announce` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'yes';
CREATE TABLE `{$db_prefix}announcement` (
`id` int(10) unsigned NOT NULL auto_increment,
`userid` int(11) NOT NULL default '0',
`added` datetime NOT NULL default '0000-00-00 00:00:00',
`body` text NOT NULL,
`title` varchar(255) NOT NULL default '',
PRIMARY KEY (`id`),
KEY `added` (`added`)
) TYPE=MyISAM;
-- end of rev 222
ALTER TABLE `{$db_prefix}users_level` ADD `STYLE` INT( 11 ) NOT NULL DEFAULT '1';
INSERT INTO `{$db_prefix}settings` SET `key`='style', `value`='false';
-- end of rev 223
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
-- end of rev 224
