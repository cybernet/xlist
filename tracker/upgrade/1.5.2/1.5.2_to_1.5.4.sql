CREATE TABLE `iplog` (
  `ipid` int(11) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `uid` varchar(5) NOT NULL default '',
  `uipid` char(1) NOT NULL default '',
  PRIMARY KEY  (`ipid`),
  UNIQUE KEY `date` (`date`)
);
CREATE TABLE `recommended` (
  `id` int(11) NOT NULL auto_increment,
  `info_hash` varchar(40) NOT NULL default '',
  `user_name` varchar(40) NOT NULL default 'anonymous',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

ALTER TABLE namemap ADD `sticky` enum('yes','no') NOT NULL default 'no';
ALTER TABLE comments ADD `userid` varchar(100) NOT NULL;
ALTER TABLE comments ADD `editedby` int(10) unsigned NOT NULL default '0';
ALTER TABLE comments ADD `editedat` datetime NOT NULL default '0000-00-00 00:00:00';
ALTER TABLE history ADD `seed` INT(9) NOT NULL default '0';
ALTER TABLE history ADD `hit` BIGINT(99) NOT NULL default '0';
ALTER TABLE namemap ADD `imdb` text;
ALTER TABLE namemap ADD `sticky` enum('yes','no') NOT NULL default 'no';
ALTER TABLE users ADD `random2` int(10) default '0';

INSERT INTO `language` VALUES (2, 'Swedish', 'language/Swedish.php');
INSERT INTO `language` VALUES (3, 'Danish', 'language/Danish.php');

INSERT INTO `users` VALUES (1, 'Guest', '', 1, 0, 0, 'none', 1, 1, '0000-00-00 00:00:00', '2007-05-23 18:21:51', 0, 0, 0, NULL, '', '', 0, 10, 10, 10, NULL, '0', '', '', '0.0', NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes');
INSERT INTO `users` VALUES (3, 'System', '', 0, 0, 0, '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, NULL, '', '', 0, 15, 15, 15, NULL, '0', '', '', '0.0', NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes');
