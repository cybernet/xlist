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
