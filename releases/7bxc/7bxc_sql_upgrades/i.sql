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
-- end of rev 226
INSERT INTO `{$db_prefix}settings` (`key`, `value`) VALUES
('backup__add_drop_table', 'true'),
('backup__add_structure', 'true'),
('backup__add_data', 'true');
INSERT INTO `{$db_prefix}tasks` (`task`, `last_time`) VALUES ('backup', '0');
-- end of rev 227
CREATE TABLE `{$db_prefix}rules` (
  `id` int(11) NOT NULL auto_increment,
  `text` text NOT NULL,
  `active` enum('-1','0','1') NOT NULL default '1',
  `sort_index` int(11) NOT NULL default '0',
  `cat_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
CREATE TABLE `{$db_prefix}rules_group` (
  `id` int(11) NOT NULL auto_increment,
  `active` enum('-1','0','1') NOT NULL default '1',
  `title` varchar(255) NOT NULL,
  `sort_index` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
-- end of rev 228
ALTER TABLE `{$db_prefix}users_level` ADD `autorank_state` ENUM( 'Enabled', 'Disabled' ) NOT NULL DEFAULT 'Disabled',
ADD `autorank_position` SMALLINT( 3 ) NOT NULL DEFAULT '0',
ADD `autorank_min_upload` BIGINT( 20 ) NOT NULL DEFAULT '0',
ADD `autorank_minratio` DECIMAL( 5, 2 ) NOT NULL DEFAULT '0.00',
ADD `autorank_smf_group_mirror` INT( 10 ) NOT NULL DEFAULT '0';
-- end of rev 230
