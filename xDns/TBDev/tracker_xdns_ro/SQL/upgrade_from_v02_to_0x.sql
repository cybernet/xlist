ALTER TABLE `users` ADD `uploadpos` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
ALTER TABLE `users` ADD `forumpost` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
ALTER TABLE `users` ADD `downloadpos` ENUM( 'yes', 'no' ) DEFAULT 'yes' NOT NULL;
CREATE TABLE `shoutbox` (
  `id` bigint(10) NOT NULL auto_increment,
  `userid` bigint(6) NOT NULL default '0',
  `to_user` int(10) NOT NULL default '0',
  `username` varchar(25) NOT NULL default '',
  `date` int(11) NOT NULL default '0',
  `text` text NOT NULL,
  `text_parsed` text NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `for` (`to_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
ALTER TABLE users ADD `show_shout` enum('yes','no') character set utf8 collate utf8_bin NOT NULL default 'yes';
ALTER TABLE users ADD `chatpost` enum('yes','no') character set utf8 collate utf8_bin NOT NULL default 'yes';
ALTER TABLE users ADD `shoutboxbg` enum('1','2','3') character set utf8 collate utf8_bin NOT NULL default '1';
