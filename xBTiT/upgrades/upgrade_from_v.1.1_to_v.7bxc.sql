ALTER TABLE `{$db_prefix}files` ADD `gold` ENUM( '0', '1', '2' ) NOT NULL DEFAULT '0';
CREATE TABLE IF NOT EXISTS `{$db_prefix}gold` (
  `id` int(11) NOT NULL auto_increment,
  `level` int(11) NOT NULL default '4',
  `gold_picture` varchar(255) NOT NULL default 'gold.gif',
  `silver_picture` varchar(255) NOT NULL default 'silver.gif',
  `active` enum('-1','0','1') NOT NULL default '1',
  `date` date NOT NULL default '0000-00-00',
  `gold_description` text NOT NULL,
  `silver_description` text NOT NULL,
  `classic_description` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;
INSERT INTO `{$db_prefix}gold` (`id`, `level`, `gold_picture`, `silver_picture`, `active`, `date`, `gold_description`, `silver_description`, `classic_description`) VALUES
(1, 3, 'gold.gif', 'silver.gif', '1', '0000-00-00', 'Gold torrent description', 'Silver torrent description', 'Classic torrent description');
ALTER TABLE `{$db_prefix}files` ADD `moder` ENUM('um', 'bad', 'ok') NOT NULL DEFAULT 'um';
ALTER TABLE `{$db_prefix}users_level` ADD `trusted` enum('yes', 'no') NOT NULL default 'no';
ALTER TABLE `{$db_prefix}users_level` ADD `moderate_trusted` enum('yes', 'no') NOT NULL default 'no';
CREATE TABLE IF NOT EXISTS `{$db_prefix}moderate_reasons` (
      `id` int(11) NOT NULL auto_increment,
      `title` varchar(255) NOT NULL default '',
      `description` text NOT NULL,
      `active` enum('-1','0','1') NOT NULL default '1',
      `ordering` bigint(20) NOT NULL default '0',
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
CREATE TABLE IF NOT EXISTS `{$db_prefix}warn_reasons` (
      `id` int(11) NOT NULL auto_increment,
      `active` enum('-1','0','1') NOT NULL default '1',
      `title` varchar(255) NOT NULL default '',
      `text` text NOT NULL,
      `level` int(11) NOT NULL default '12',
      PRIMARY KEY  (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
