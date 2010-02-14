CREATE TABLE `iplog` (
  `ipid` int(11) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `uid` varchar(5) NOT NULL default '',
  `uipid` char(1) NOT NULL default '',
  PRIMARY KEY  (`ipid`),
  UNIQUE KEY `date` (`date`)
);

ALTER TABLE namemap ADD `sticky` enum('yes','no') NOT NULL default 'no';