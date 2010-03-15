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

CREATE TABLE `stats` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `regusers` int(10) unsigned NOT NULL default '0',
  `unconusers` int(10) unsigned NOT NULL default '0',
  `torrents` int(10) unsigned NOT NULL default '0',
  `seeders` int(10) unsigned NOT NULL default '0',
  `leechers` int(10) unsigned NOT NULL default '0',
  `torrentstoday` int(10) unsigned NOT NULL default '0',
  `donors` int(10) unsigned NOT NULL default '0',
  `unconnectables` int(10) unsigned NOT NULL default '0',
  `forumtopics` int(10) unsigned NOT NULL default '0',
  `forumposts` int(10) unsigned NOT NULL default '0',
  `numactive` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `stats` (`id`) VALUES ('1');
ALTER TABLE torrents ADD `poster` varchar(255) character set utf8 collate utf8_bin NOT NULL default 'pic/noposter.jpg';


CREATE TABLE `snatched` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `torrentid` int(10) unsigned NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `port` smallint(5) unsigned NOT NULL default '0',
  `connectable` enum('yes','no') NOT NULL default 'no',
  `agent` varchar(60) NOT NULL default '',
  `peer_id` varchar(20) NOT NULL default '',
  `uploaded` bigint(20) unsigned NOT NULL default '0',
  `upspeed` bigint(20) NOT NULL default '0',
  `downloaded` bigint(20) unsigned NOT NULL default '0',
  `downspeed` bigint(20) NOT NULL default '0',
  `to_go` bigint(20) unsigned NOT NULL default '0',
  `seeder` enum('yes','no') NOT NULL default 'no',
  `seedtime` int(11) unsigned NOT NULL default '0',
  `leechtime` int(11) unsigned NOT NULL default '0',
  `start_date` int(11) NOT NULL,
  `last_action` int(11) NOT NULL,
  `complete_date` int(11) NOT NULL,
  `timesann` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `tr_usr` (`torrentid`,`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
