-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
-- 
-- Värd: localhost
-- Skapad: 23 maj 2007 kl 20:21
-- Serverversion: 5.0.33
-- PHP-version: 4.4.5
-- 
-- Databas: `btit`
-- 

-- --------------------------------------------------------

-- 
-- Struktur för tabell `addedrequests`
-- 

DROP TABLE IF EXISTS `addedrequests`;
CREATE TABLE `addedrequests` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `requestid` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pollid` (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `addedrequests`
-- 


-- --------------------------------------------------------

CREATE TABLE `bannedclient` (
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

-- --------------------------------------------------------

-- 
-- Struktur för tabell `bannedip`
-- 

DROP TABLE IF EXISTS `bannedip`;
CREATE TABLE `bannedip` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` int(11) NOT NULL default '0',
  `addedby` int(10) unsigned NOT NULL default '0',
  `comment` varchar(255) NOT NULL default '',
  `first` bigint(11) unsigned default NULL,
  `last` bigint(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `first_last` (`first`,`last`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `bannedip`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `bannedmail`
-- 

DROP TABLE IF EXISTS `bannedmail`;
CREATE TABLE `bannedmail` (
  `inc` int(10) unsigned NOT NULL auto_increment,
  `added` int(11) NOT NULL default '0',
  `addedby` int(10) unsigned NOT NULL default '0',
  `comment` varchar(250) NOT NULL default '',
  `email` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`inc`),
  FULLTEXT KEY `comment` (`comment`,`email`)
) TYPE=MyISAM  AUTO_INCREMENT=8 ;

-- 
-- Data i tabell `bannedmail`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `blackjack`
-- 

DROP TABLE IF EXISTS `blackjack`;
CREATE TABLE `blackjack` (
  `userid` int(11) NOT NULL default '0',
  `points` int(11) NOT NULL default '0',
  `status` enum('playing','waiting') NOT NULL default 'playing',
  `cards` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `bet` int(10) NOT NULL default '0',
  `aces` int(11) NOT NULL default '0',
  `blackjack` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`userid`)
) TYPE=MyISAM;

-- 
-- Data i tabell `blackjack`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `blocks`
-- 

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE `blocks` (
  `blockid` int(11) unsigned NOT NULL auto_increment,
  `content` varchar(255) NOT NULL default '',
  `position` char(1) NOT NULL default '',
  `sortid` int(11) unsigned NOT NULL default '0',
  `status` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`blockid`)
) TYPE=MyISAM  AUTO_INCREMENT=70 ;

-- 
-- Data i tabell `blocks`
-- 

INSERT INTO `blocks` VALUES (1, 'menu', 'l', 1, 1);
INSERT INTO `blocks` VALUES (2, 'clock', 'l', 3, 1);
INSERT INTO `blocks` VALUES (3, 'forum', 'r', 4, 1);
INSERT INTO `blocks` VALUES (4, 'lastmember', 'r', 3, 1);
INSERT INTO `blocks` VALUES (6, 'trackerinfo', 'l', 2, 1);
INSERT INTO `blocks` VALUES (7, 'user', 'r', 3, 1);
INSERT INTO `blocks` VALUES (8, 'online', 'r', 2, 1);
INSERT INTO `blocks` VALUES (9, 'shoutbox', 'c', 1, 1);
INSERT INTO `blocks` VALUES (10, 'toptorrents', 'c', 5, 1);
INSERT INTO `blocks` VALUES (11, 'lasttorrents', 'c', 4, 1);
INSERT INTO `blocks` VALUES (12, 'news', 'c', 3, 1);
INSERT INTO `blocks` VALUES (13, 'mainmenu', 't', 2, 1);
INSERT INTO `blocks` VALUES (14, 'maintrackertoolbar', 't', 2, 1);
INSERT INTO `blocks` VALUES (15, 'mainusertoolbar', 't', 3, 1);
INSERT INTO `blocks` VALUES (16, 'serverload', 'c', 8, 0);
INSERT INTO `blocks` VALUES (17, 'poll', 'r', 4, 1);
INSERT INTO `blocks` VALUES (18, 'seedwanted', 'c', 2, 1);
INSERT INTO `blocks` VALUES (19, 'paypal', 'r', 1, 1);
INSERT INTO `blocks` VALUES (69, 'invite', 'l', 7, 0);
INSERT INTO `blocks` VALUES (20, 'games', 'r', 99, 1);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `bonus`
-- 

DROP TABLE IF EXISTS `bonus`;
CREATE TABLE `bonus` (
  `id` int(5) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL default '',
  `points` decimal(4,1) NOT NULL default '0.0',
  `traffic` bigint(20) unsigned NOT NULL default '0',
  `gb` int(9) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=6 ;

-- 
-- Data i tabell `bonus`
-- 

INSERT INTO `bonus` VALUES (3, '1', '30.0', 1073741824, 1);
INSERT INTO `bonus` VALUES (4, '2', '50.0', 2147483648, 2);
INSERT INTO `bonus` VALUES (5, '3', '100.0', 5368709120, 5);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `cards`
-- 

DROP TABLE IF EXISTS `cards`;
CREATE TABLE `cards` (
  `id` int(11) NOT NULL auto_increment,
  `points` int(11) NOT NULL default '0',
  `pic` text NOT NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=53 ;

-- 
-- Data i tabell `cards`
-- 

INSERT INTO `cards` VALUES (1, 2, '2p.bmp');
INSERT INTO `cards` VALUES (2, 3, '3p.bmp');
INSERT INTO `cards` VALUES (3, 4, '4p.bmp');
INSERT INTO `cards` VALUES (4, 5, '5p.bmp');
INSERT INTO `cards` VALUES (5, 6, '6p.bmp');
INSERT INTO `cards` VALUES (6, 7, '7p.bmp');
INSERT INTO `cards` VALUES (7, 8, '8p.bmp');
INSERT INTO `cards` VALUES (8, 9, '9p.bmp');
INSERT INTO `cards` VALUES (9, 10, '10p.bmp');
INSERT INTO `cards` VALUES (10, 10, 'vp.bmp');
INSERT INTO `cards` VALUES (11, 10, 'dp.bmp');
INSERT INTO `cards` VALUES (12, 10, 'kp.bmp');
INSERT INTO `cards` VALUES (13, 11, 'tp.bmp');
INSERT INTO `cards` VALUES (14, 2, '2b.bmp');
INSERT INTO `cards` VALUES (15, 3, '3b.bmp');
INSERT INTO `cards` VALUES (16, 4, '4b.bmp');
INSERT INTO `cards` VALUES (17, 5, '5b.bmp');
INSERT INTO `cards` VALUES (18, 6, '6b.bmp');
INSERT INTO `cards` VALUES (19, 7, '7b.bmp');
INSERT INTO `cards` VALUES (20, 8, '8b.bmp');
INSERT INTO `cards` VALUES (21, 9, '9b.bmp');
INSERT INTO `cards` VALUES (22, 10, '10b.bmp');
INSERT INTO `cards` VALUES (23, 10, 'vb.bmp');
INSERT INTO `cards` VALUES (24, 10, 'db.bmp');
INSERT INTO `cards` VALUES (25, 10, 'kb.bmp');
INSERT INTO `cards` VALUES (26, 11, 'tb.bmp');
INSERT INTO `cards` VALUES (27, 2, '2k.bmp');
INSERT INTO `cards` VALUES (28, 3, '3k.bmp');
INSERT INTO `cards` VALUES (29, 4, '4k.bmp');
INSERT INTO `cards` VALUES (30, 5, '5k.bmp');
INSERT INTO `cards` VALUES (31, 6, '6k.bmp');
INSERT INTO `cards` VALUES (32, 7, '7k.bmp');
INSERT INTO `cards` VALUES (33, 8, '8k.bmp');
INSERT INTO `cards` VALUES (34, 9, '9k.bmp');
INSERT INTO `cards` VALUES (35, 10, '10k.bmp');
INSERT INTO `cards` VALUES (36, 10, 'vk.bmp');
INSERT INTO `cards` VALUES (37, 10, 'dk.bmp');
INSERT INTO `cards` VALUES (38, 10, 'kk.bmp');
INSERT INTO `cards` VALUES (39, 11, 'tk.bmp');
INSERT INTO `cards` VALUES (40, 2, '2c.bmp');
INSERT INTO `cards` VALUES (41, 3, '3c.bmp');
INSERT INTO `cards` VALUES (42, 4, '4c.bmp');
INSERT INTO `cards` VALUES (43, 5, '5c.bmp');
INSERT INTO `cards` VALUES (44, 6, '6c.bmp');
INSERT INTO `cards` VALUES (45, 7, '7c.bmp');
INSERT INTO `cards` VALUES (46, 8, '8c.bmp');
INSERT INTO `cards` VALUES (47, 9, '9c.bmp');
INSERT INTO `cards` VALUES (48, 10, '10c.bmp');
INSERT INTO `cards` VALUES (49, 10, 'vc.bmp');
INSERT INTO `cards` VALUES (50, 10, 'dc.bmp');
INSERT INTO `cards` VALUES (51, 10, 'kc.bmp');
INSERT INTO `cards` VALUES (52, 11, 'tc.bmp');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `sub` int(10) NOT NULL default '0',
  `sort_index` int(10) unsigned NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=13 ;

-- 
-- Data i tabell `categories`
-- 

INSERT INTO `categories` VALUES (7, 'Apps Win', 0, 1010, 'win.png');
INSERT INTO `categories` VALUES (6, 'Books', 0, 110, 'ebooks.png');
INSERT INTO `categories` VALUES (5, 'Anime', 0, 90, 'anime.png');
INSERT INTO `categories` VALUES (4, 'Other', 0, 1000, 'other.png');
INSERT INTO `categories` VALUES (3, 'Games', 0, 40, 'games.png');
INSERT INTO `categories` VALUES (2, 'Music', 0, 20, 'music.png');
INSERT INTO `categories` VALUES (1, 'Movies', 0, 10, 'movies.png');
INSERT INTO `categories` VALUES (8, 'Apps Linux', 0, 1020, 'linux.png');
INSERT INTO `categories` VALUES (9, 'Apps Mac', 0, 1030, 'mac.png');
INSERT INTO `categories` VALUES (11, 'DVD-R', 1, 0, 'movies.png');
INSERT INTO `categories` VALUES (12, 'Mvcd', 1, 23333, 'film.jpg');
INSERT INTO `categories` VALUES (13, 'Porn', 0, 0, 'pr0n.jpg');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `cheapmail`
-- 

DROP TABLE IF EXISTS `cheapmail`;
CREATE TABLE `cheapmail` (
  `domain` varchar(100) NOT NULL default '',
  `added` int(10) NOT NULL default '0',
  `added_by` varchar(40) NOT NULL default 'Unknown',
  KEY `domain` (`domain`)
) TYPE=MyISAM COMMENT='listing of cheapmail domains for banning at account creation';

-- 
-- Data i tabell `cheapmail`
-- 

INSERT INTO `cheapmail` VALUES ('@hotmail.com', 1177518142, 'admin');
INSERT INTO `cheapmail` VALUES ('hotmail.', 1177518122, 'admin');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `comments`
-- 

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL default '',
  `userid` varchar(100) NOT NULL,
  `editedby` int(10) unsigned NOT NULL default '0',
  `editedat` datetime NOT NULL default '0000-00-00 00:00:00',
  `info_hash` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `info_hash` (`info_hash`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `comments`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `config`
-- 

DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) NOT NULL default '0',
  `lot_expire_date` varchar(20) NOT NULL default '',
  `lot_number_winners` varchar(20) NOT NULL default '',
  `lot_number_to_win` varchar(20) NOT NULL default '',
  `lot_amount` varchar(20) NOT NULL default '',
  `lot_status` enum('yes','no','closed') NOT NULL default 'yes',
  `limit_buy` char(2) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- 
-- Data i tabell `config`
-- 

INSERT INTO `config` (`id`, `lot_expire_date`, `lot_number_winners`, `lot_number_to_win`, `lot_amount`, `lot_status`) VALUES 
(0, '', '', '', '', ''),
(1, '00-00-0000 00:00', '5', '', '', 'yes');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `countries`
-- 

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `flagpic` varchar(50) default NULL,
  `domain` char(3) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=245 ;

-- 
-- Data i tabell `countries`
-- 

INSERT INTO `countries` VALUES (1, 'Sweden', 'se.png', 'SE');
INSERT INTO `countries` VALUES (2, 'United States of America', 'us.png', 'US');
INSERT INTO `countries` VALUES (3, 'American Samoa', 'as.png', 'AS');
INSERT INTO `countries` VALUES (4, 'Finland', 'fi.png', 'FI');
INSERT INTO `countries` VALUES (5, 'Canada', 'ca.png', 'CA');
INSERT INTO `countries` VALUES (6, 'France', 'fr.png', 'FR');
INSERT INTO `countries` VALUES (7, 'Germany', 'de.png', 'DE');
INSERT INTO `countries` VALUES (8, 'China', 'cn.png', 'CN');
INSERT INTO `countries` VALUES (9, 'Italy', 'it.png', 'IT');
INSERT INTO `countries` VALUES (10, 'Denmark', 'dk.png', 'DK');
INSERT INTO `countries` VALUES (11, 'Norway', 'no.png', 'NO');
INSERT INTO `countries` VALUES (12, 'United Kingdom', 'gb.png', 'GB');
INSERT INTO `countries` VALUES (13, 'Ireland', 'ie.png', 'IE');
INSERT INTO `countries` VALUES (14, 'Poland', 'pl.png', 'PL');
INSERT INTO `countries` VALUES (15, 'Netherlands', 'nl.png', 'NL');
INSERT INTO `countries` VALUES (16, 'Belgium', 'be.png', 'BE');
INSERT INTO `countries` VALUES (17, 'Japan', 'jp.png', 'JP');
INSERT INTO `countries` VALUES (18, 'Brazil', 'br.png', 'BR');
INSERT INTO `countries` VALUES (19, 'Argentina', 'ar.png', 'AR');
INSERT INTO `countries` VALUES (20, 'Australia', 'au.png', 'AU');
INSERT INTO `countries` VALUES (21, 'New Zealand', 'nz.png', 'NZ');
INSERT INTO `countries` VALUES (22, 'United Arab Emirates', 'ae.png', 'AE');
INSERT INTO `countries` VALUES (23, 'Spain', 'es.png', 'ES');
INSERT INTO `countries` VALUES (24, 'Portugal', 'pt.png', 'PT');
INSERT INTO `countries` VALUES (25, 'Mexico', 'mx.png', 'MX');
INSERT INTO `countries` VALUES (26, 'Singapore', 'sg.png', 'SG');
INSERT INTO `countries` VALUES (27, 'Anguilla', 'ai.png', 'AI');
INSERT INTO `countries` VALUES (28, 'Armenia', 'am.png', 'AM');
INSERT INTO `countries` VALUES (29, 'South Africa', 'za.png', 'ZA');
INSERT INTO `countries` VALUES (30, 'South Korea', 'kr.png', 'KR');
INSERT INTO `countries` VALUES (31, 'Jamaica', 'jm.png', 'JM');
INSERT INTO `countries` VALUES (32, 'Luxembourg', 'lu.png', 'LU');
INSERT INTO `countries` VALUES (33, 'Hong Kong', 'hk.png', 'HK');
INSERT INTO `countries` VALUES (34, 'Belize', 'bz.png', 'BZ');
INSERT INTO `countries` VALUES (35, 'Algeria', 'dz.png', 'DZ');
INSERT INTO `countries` VALUES (36, 'Angola', 'ao.png', 'AO');
INSERT INTO `countries` VALUES (37, 'Austria', 'at.png', 'AT');
INSERT INTO `countries` VALUES (38, 'Aruba', 'aw.png', 'AW');
INSERT INTO `countries` VALUES (39, 'Samoa', 'ws.png', 'WS');
INSERT INTO `countries` VALUES (40, 'Malaysia', 'my.png', 'MY');
INSERT INTO `countries` VALUES (41, 'Dominican Republic', 'do.png', 'DO');
INSERT INTO `countries` VALUES (42, 'Greece', 'gr.png', 'GR');
INSERT INTO `countries` VALUES (43, 'Guatemala', 'gt.png', 'GT');
INSERT INTO `countries` VALUES (44, 'Israel', 'il.png', 'IL');
INSERT INTO `countries` VALUES (45, 'Pakistan', 'pk.png', 'PK');
INSERT INTO `countries` VALUES (46, 'Czech Republic', 'cz.png', 'CZ');
INSERT INTO `countries` VALUES (47, 'Serbia and Montenegro', 'cs.png', 'CS');
INSERT INTO `countries` VALUES (48, 'Seychelles', 'sc.png', 'SC');
INSERT INTO `countries` VALUES (49, 'Taiwan', 'tw.png', 'TW');
INSERT INTO `countries` VALUES (50, 'Puerto Rico', 'pr.png', 'PR');
INSERT INTO `countries` VALUES (51, 'Chile', 'cl.png', 'CL');
INSERT INTO `countries` VALUES (52, 'Cuba', 'cu.png', 'CU');
INSERT INTO `countries` VALUES (53, 'Congo', 'cg.png', 'CG');
INSERT INTO `countries` VALUES (54, 'Afghanistan', 'af.png', 'AF');
INSERT INTO `countries` VALUES (55, 'Turkey', 'tr.png', 'TR');
INSERT INTO `countries` VALUES (56, 'Uzbekistan', 'uz.png', 'UZ');
INSERT INTO `countries` VALUES (57, 'Switzerland', 'ch.png', 'CH');
INSERT INTO `countries` VALUES (58, 'Kiribati', 'ki.gif', 'KI');
INSERT INTO `countries` VALUES (59, 'Philippines', 'ph.png', 'PH');
INSERT INTO `countries` VALUES (60, 'Burkina Faso', 'bf.png', 'BF');
INSERT INTO `countries` VALUES (61, 'Nigeria', 'ng.png', 'NG');
INSERT INTO `countries` VALUES (62, 'Iceland', 'is.png', 'IS');
INSERT INTO `countries` VALUES (63, 'Nauru', 'nr.png', 'NR');
INSERT INTO `countries` VALUES (64, 'Slovenia', 'si.png', 'SI');
INSERT INTO `countries` VALUES (65, 'Albania', 'al.png', 'AL');
INSERT INTO `countries` VALUES (66, 'Turkmenistan', 'tm.png', 'TM');
INSERT INTO `countries` VALUES (67, 'Bosnia and Herzegovina', 'ba.png', 'BA');
INSERT INTO `countries` VALUES (68, 'Andorra', 'ad.png', 'AD');
INSERT INTO `countries` VALUES (69, 'Lithuania', 'lt.png', 'LT');
INSERT INTO `countries` VALUES (70, 'India', 'in.png', 'IN');
INSERT INTO `countries` VALUES (71, 'Netherlands Antilles', 'an.png', 'AN');
INSERT INTO `countries` VALUES (72, 'Ukraine', 'ua.png', 'UA');
INSERT INTO `countries` VALUES (73, 'Venezuela', 've.png', 'VE');
INSERT INTO `countries` VALUES (74, 'Hungary', 'hu.png', 'HU');
INSERT INTO `countries` VALUES (75, 'Romania', 'ro.png', 'RO');
INSERT INTO `countries` VALUES (76, 'Vanuatu', 'vu.png', 'VU');
INSERT INTO `countries` VALUES (77, 'Viet Nam', 'vn.png', 'VN');
INSERT INTO `countries` VALUES (78, 'Trinidad & Tobago', 'tt.png', 'TT');
INSERT INTO `countries` VALUES (79, 'Honduras', 'hn.png', 'HN');
INSERT INTO `countries` VALUES (80, 'Kyrgyzstan', 'kg.png', 'KG');
INSERT INTO `countries` VALUES (81, 'Ecuador', 'ec.png', 'EC');
INSERT INTO `countries` VALUES (82, 'Bahamas', 'bs.png', 'BS');
INSERT INTO `countries` VALUES (83, 'Peru', 'pe.png', 'PE');
INSERT INTO `countries` VALUES (84, 'Cambodia', 'kh.png', 'KH');
INSERT INTO `countries` VALUES (85, 'Barbados', 'bb.png', 'BB');
INSERT INTO `countries` VALUES (86, 'Bangladesh', 'bd.png', 'BD');
INSERT INTO `countries` VALUES (87, 'Laos', 'la.png', 'LA');
INSERT INTO `countries` VALUES (88, 'Uruguay', 'uy.png', 'UY');
INSERT INTO `countries` VALUES (89, 'Antigua Barbuda', 'ag.png', 'AG');
INSERT INTO `countries` VALUES (90, 'Paraguay', 'py.png', 'PY');
INSERT INTO `countries` VALUES (91, 'Antarctica', 'aq.png', 'AQ');
INSERT INTO `countries` VALUES (92, 'Russian Federation', 'ru.png', 'RU');
INSERT INTO `countries` VALUES (93, 'Thailand', 'th.png', 'TH');
INSERT INTO `countries` VALUES (94, 'Senegal', 'sn.png', 'SN');
INSERT INTO `countries` VALUES (95, 'Togo', 'tg.png', 'TG');
INSERT INTO `countries` VALUES (96, 'North Korea', 'kp.png', 'KP');
INSERT INTO `countries` VALUES (97, 'Croatia', 'hr.png', 'HR');
INSERT INTO `countries` VALUES (98, 'Estonia', 'ee.png', 'EE');
INSERT INTO `countries` VALUES (99, 'Colombia', 'co.png', 'CO');
INSERT INTO `countries` VALUES (100, 'unknown', 'unknown.gif', 'AA');
INSERT INTO `countries` VALUES (101, 'Organization', 'org.png', 'ORG');
INSERT INTO `countries` VALUES (102, 'Aland Islands', 'ax.png', 'AX');
INSERT INTO `countries` VALUES (103, 'Azerbaijan', 'az.png', 'AZ');
INSERT INTO `countries` VALUES (104, 'Bulgaria', 'bg.png', 'BG');
INSERT INTO `countries` VALUES (105, 'Bahrain', 'bh.png', 'BH');
INSERT INTO `countries` VALUES (106, 'Burundi', 'bi.png', 'BI');
INSERT INTO `countries` VALUES (107, 'Benin', 'bj.png', 'BJ');
INSERT INTO `countries` VALUES (108, 'Bermuda', 'bm.png', 'BM');
INSERT INTO `countries` VALUES (109, 'Brunei Darussalam', 'bn.png', 'BN');
INSERT INTO `countries` VALUES (110, 'Bolivia', 'bo.png', 'BO');
INSERT INTO `countries` VALUES (111, 'Bhutan', 'bt.png', 'BT');
INSERT INTO `countries` VALUES (112, 'Bouvet Island', 'bv.png', 'BV');
INSERT INTO `countries` VALUES (113, 'Botswana', 'bw.png', 'BW');
INSERT INTO `countries` VALUES (114, 'Belarus', 'by.png', 'BY');
INSERT INTO `countries` VALUES (115, 'Cocos (Keeling) Islands', 'cc.png', 'CC');
INSERT INTO `countries` VALUES (116, 'Congo, the Democratic Republic of the', 'cd.png', 'CD');
INSERT INTO `countries` VALUES (117, 'Central African Republic', 'cf.png', 'CF');
INSERT INTO `countries` VALUES (118, 'Ivory Coast', 'ci.png', 'CI');
INSERT INTO `countries` VALUES (119, 'Cook Islands', 'ck.png', 'CK');
INSERT INTO `countries` VALUES (120, 'Cameroon', 'cm.png', 'CM');
INSERT INTO `countries` VALUES (121, 'Costa Rica', 'cr.png', 'CR');
INSERT INTO `countries` VALUES (122, 'Cape Verde', 'cv.png', 'CV');
INSERT INTO `countries` VALUES (123, 'Christmas Island', 'cx.png', 'CX');
INSERT INTO `countries` VALUES (124, 'Cyprus', 'cy.png', 'CY');
INSERT INTO `countries` VALUES (125, 'Djibouti', 'dj.png', 'DJ');
INSERT INTO `countries` VALUES (126, 'Dominica', 'dm.png', 'DM');
INSERT INTO `countries` VALUES (127, 'Egypt', 'eg.png', 'EG');
INSERT INTO `countries` VALUES (128, 'Western Sahara', 'eh.png', 'EH');
INSERT INTO `countries` VALUES (129, 'Eritrea', 'er.png', 'ER');
INSERT INTO `countries` VALUES (130, 'Ethiopia', 'et.png', 'ET');
INSERT INTO `countries` VALUES (131, 'Fiji', 'fj.png', 'FJ');
INSERT INTO `countries` VALUES (132, 'Falkland Islands (Malvinas)', 'fk.png', 'FK');
INSERT INTO `countries` VALUES (133, 'Micronesia, Federated States of', 'fm.png', 'FM');
INSERT INTO `countries` VALUES (134, 'Faroe Islands', 'fo.png', 'FO');
INSERT INTO `countries` VALUES (135, 'Gabon', 'ga.png', 'GA');
INSERT INTO `countries` VALUES (136, 'Grenada', 'gd.png', 'GD');
INSERT INTO `countries` VALUES (137, 'Georgia', 'ge.png', 'GE');
INSERT INTO `countries` VALUES (138, 'French Guiana', 'gf.png', 'GF');
INSERT INTO `countries` VALUES (139, 'Guernsey', 'gg.png', 'GG');
INSERT INTO `countries` VALUES (140, 'Ghana', 'gh.png', 'GH');
INSERT INTO `countries` VALUES (141, 'Gibraltar', 'gi.png', 'GI');
INSERT INTO `countries` VALUES (142, 'Greenland', 'gl.png', 'GL');
INSERT INTO `countries` VALUES (143, 'Gambia', 'gm.png', 'GM');
INSERT INTO `countries` VALUES (144, 'Guinea', 'gn.png', 'GN');
INSERT INTO `countries` VALUES (145, 'Guadeloupe', 'gp.png', 'GP');
INSERT INTO `countries` VALUES (146, 'Equatorial Guinea', 'gq.png', 'GQ');
INSERT INTO `countries` VALUES (147, 'South Georgia and the South Sandwich Islands', 'gs.png', 'GS');
INSERT INTO `countries` VALUES (148, 'Guam', 'gu.png', 'GU');
INSERT INTO `countries` VALUES (149, 'Guinea-Bissau', 'gw.png', 'GW');
INSERT INTO `countries` VALUES (150, 'Guyana', 'gy.png', 'GY');
INSERT INTO `countries` VALUES (151, 'Heard Island and McDonald Islands', 'hm.png', 'HM');
INSERT INTO `countries` VALUES (152, 'Haiti', 'ht.png', 'HT');
INSERT INTO `countries` VALUES (153, 'Indonesia', 'id.png', 'ID');
INSERT INTO `countries` VALUES (154, 'Isle of Man', 'im.png', 'IM');
INSERT INTO `countries` VALUES (155, 'British Indian Ocean Territory', 'io.png', 'IO');
INSERT INTO `countries` VALUES (156, 'Jersey', 'je.png', 'JE');
INSERT INTO `countries` VALUES (157, 'Jordan', 'jo.png', 'JO');
INSERT INTO `countries` VALUES (158, 'Kenya', 'ke.png', 'KE');
INSERT INTO `countries` VALUES (159, 'Comoros', 'km.png', 'KM');
INSERT INTO `countries` VALUES (160, 'Saint Kitts and Nevis', 'kn.png', 'KN');
INSERT INTO `countries` VALUES (161, 'Kuwait', 'kw.png', 'KW');
INSERT INTO `countries` VALUES (162, 'Cayman Islands', 'ky.png', 'KY');
INSERT INTO `countries` VALUES (163, 'Kazahstan', 'kz.png', 'KZ');
INSERT INTO `countries` VALUES (164, 'Lebanon', 'lb.png', 'LB');
INSERT INTO `countries` VALUES (165, 'Saint Lucia', 'lc.png', 'LC');
INSERT INTO `countries` VALUES (166, 'Liechtenstein', 'li.png', 'LI');
INSERT INTO `countries` VALUES (167, 'Sri Lanka', 'lk.png', 'LK');
INSERT INTO `countries` VALUES (168, 'Liberia', 'lr.png', 'LR');
INSERT INTO `countries` VALUES (169, 'Lesotho', 'ls.png', 'LS');
INSERT INTO `countries` VALUES (170, 'Latvia', 'lv.png', 'LV');
INSERT INTO `countries` VALUES (171, 'Libyan Arab Jamahiriya', 'ly.png', 'LY');
INSERT INTO `countries` VALUES (172, 'Marocco', 'ma.png', 'MA');
INSERT INTO `countries` VALUES (173, 'Monaco', 'mc.png', 'MC');
INSERT INTO `countries` VALUES (174, 'Moldova, Republic of', 'md.png', 'MD');
INSERT INTO `countries` VALUES (175, 'Madagascar', 'mg.png', 'MG');
INSERT INTO `countries` VALUES (176, 'Marshall Islands', 'mh.png', 'MH');
INSERT INTO `countries` VALUES (177, 'Macedonia, the former Yugoslav Republic of', 'mk.png', 'MK');
INSERT INTO `countries` VALUES (178, 'Mali', 'ml.png', 'ML');
INSERT INTO `countries` VALUES (179, 'Myanmar', 'mm.png', 'MM');
INSERT INTO `countries` VALUES (180, 'Mongolia', 'mn.png', 'MN');
INSERT INTO `countries` VALUES (181, 'Macao', 'mo.png', 'MO');
INSERT INTO `countries` VALUES (182, 'Northern Mariana Islands', 'mp.png', 'MP');
INSERT INTO `countries` VALUES (183, 'Martinique', 'mq.png', 'MQ');
INSERT INTO `countries` VALUES (184, 'Mauritania', 'mr.png', 'MR');
INSERT INTO `countries` VALUES (185, 'Montserrat', 'ms.png', 'MS');
INSERT INTO `countries` VALUES (186, 'Malta', 'mt.png', 'MT');
INSERT INTO `countries` VALUES (187, 'Mauritius', 'mu.png', 'MU');
INSERT INTO `countries` VALUES (188, 'Maldives', 'mv.png', 'MV');
INSERT INTO `countries` VALUES (189, 'Malawi', 'mw.png', 'MW');
INSERT INTO `countries` VALUES (190, 'Mozambique', 'mz.png', 'MZ');
INSERT INTO `countries` VALUES (191, 'Namibia', 'na.png', 'NA');
INSERT INTO `countries` VALUES (192, 'New Caledonia', 'nc.png', 'NC');
INSERT INTO `countries` VALUES (193, 'Niger', 'ne.png', 'NE');
INSERT INTO `countries` VALUES (194, 'Norfolk Island', 'nf.png', 'NF');
INSERT INTO `countries` VALUES (195, 'Nicaragua', 'ni.png', 'NI');
INSERT INTO `countries` VALUES (196, 'Nepal', 'np.png', 'NP');
INSERT INTO `countries` VALUES (197, 'Niue', 'nu.png', 'NU');
INSERT INTO `countries` VALUES (198, 'Oman', 'om.png', 'OM');
INSERT INTO `countries` VALUES (199, 'Panama', 'pa.png', 'PA');
INSERT INTO `countries` VALUES (200, 'French Polynesia', 'pf.png', 'PF');
INSERT INTO `countries` VALUES (201, 'Papua New Guinea', 'pg.png', 'PG');
INSERT INTO `countries` VALUES (202, 'Saint Pierre and Miquelon', 'pm.png', 'PM');
INSERT INTO `countries` VALUES (203, 'Pitcairn', 'pn.png', 'PN');
INSERT INTO `countries` VALUES (204, 'Palestinian Territory, Occupied', 'ps.png', 'PS');
INSERT INTO `countries` VALUES (205, 'Palau', 'pw.png', 'PW');
INSERT INTO `countries` VALUES (206, 'Qatar', 'qa.png', 'QA');
INSERT INTO `countries` VALUES (207, 'Reunion', 're.png', 'RE');
INSERT INTO `countries` VALUES (208, 'Rwanda', 'rw.png', 'RW');
INSERT INTO `countries` VALUES (209, 'Saudi Arabia', 'sa.png', 'SA');
INSERT INTO `countries` VALUES (210, 'Solomon Islands', 'sb.png', 'SB');
INSERT INTO `countries` VALUES (211, 'Sudan', 'sd.png', 'SD');
INSERT INTO `countries` VALUES (212, 'Saint Helena', 'sh.png', 'SH');
INSERT INTO `countries` VALUES (213, 'Svalbard and Jan Mayen', 'sj.png', 'SJ');
INSERT INTO `countries` VALUES (214, 'Slovakia', 'sk.png', 'SK');
INSERT INTO `countries` VALUES (215, 'Sierra Leone', 'sl.png', 'SL');
INSERT INTO `countries` VALUES (216, 'San Marino', 'sm.png', 'SM');
INSERT INTO `countries` VALUES (217, 'Somalia', 'so.png', 'SO');
INSERT INTO `countries` VALUES (218, 'Suriname', 'sr.png', 'SR');
INSERT INTO `countries` VALUES (219, 'Sao Tome and Principe', 'st.png', 'ST');
INSERT INTO `countries` VALUES (220, 'El Salvador', 'sv.png', 'SV');
INSERT INTO `countries` VALUES (221, 'Syrian Arab Republic', 'sy.png', 'SY');
INSERT INTO `countries` VALUES (222, 'Swaziland', 'sz.png', 'SZ');
INSERT INTO `countries` VALUES (223, 'Turks and Caicos Islands', 'tc.png', 'TC');
INSERT INTO `countries` VALUES (224, 'Chad', 'td.png', 'TD');
INSERT INTO `countries` VALUES (225, 'French Southern Territories', 'tf.png', 'TF');
INSERT INTO `countries` VALUES (226, 'Tajikistan', 'tj.png', 'TJ');
INSERT INTO `countries` VALUES (227, 'Tokelau', 'tk.png', 'TK');
INSERT INTO `countries` VALUES (228, 'Timor-Leste', 'tl.png', 'TL');
INSERT INTO `countries` VALUES (229, 'Tunisia', 'tn.png', 'TN');
INSERT INTO `countries` VALUES (230, 'Tonga', 'to.png', 'TO');
INSERT INTO `countries` VALUES (231, 'Tuvalu', 'tv.png', 'TV');
INSERT INTO `countries` VALUES (232, 'Tanzania, United Republic of', 'tz.png', 'TZ');
INSERT INTO `countries` VALUES (233, 'Uganda', 'ug.png', 'UG');
INSERT INTO `countries` VALUES (234, 'United States Minor Outlying Islands', 'um.png', 'UM');
INSERT INTO `countries` VALUES (235, 'Holy See (Vatican City State)', 'va.png', 'VA');
INSERT INTO `countries` VALUES (236, 'Saint Vincent and the Grenadines', 'vc.png', 'VC');
INSERT INTO `countries` VALUES (237, 'Virgin Islands, British', 'vg.png', 'VG');
INSERT INTO `countries` VALUES (238, 'Wallis and Futuna', 'wf.png', 'WF');
INSERT INTO `countries` VALUES (239, 'Yemen', 'ye.png', 'YE');
INSERT INTO `countries` VALUES (240, 'Mayotte', 'yt.png', 'YT');
INSERT INTO `countries` VALUES (241, 'Zambia', 'zm.png', 'ZM');
INSERT INTO `countries` VALUES (242, 'Zimbabwe', 'zw.png', 'ZW');
INSERT INTO `countries` VALUES (243, 'Iraq', 'iq.png', 'IQ');
INSERT INTO `countries` VALUES (244, 'Iran, Islamic Republic of', 'ir.png', 'IR');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `dbbackup`
-- 

DROP TABLE IF EXISTS `dbbackup`;
CREATE TABLE `dbbackup` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(40) default NULL,
  `added` date default '0000-00-00',
  `day` int(10) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `dbbackup`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `donator`
-- 

DROP TABLE IF EXISTS `donator`;
CREATE TABLE `donator` (
  `id` int(10) NOT NULL auto_increment,
  `donator` varchar(40) NOT NULL default '',
  `donation` varchar(10) NOT NULL default '',
  `ytd_donation` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `donator`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `dox`
-- 

DROP TABLE IF EXISTS `dox`;
CREATE TABLE `dox` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime default '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL default '',
  `filename` varchar(255) NOT NULL default '',
  `size` int(10) unsigned NOT NULL default '0',
  `uppedby` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `hits` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `dox`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `expected`
-- 

DROP TABLE IF EXISTS `expected`;
CREATE TABLE `expected` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `expect` varchar(225) default NULL,
  `descr` text NOT NULL,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `date` varchar(255) NOT NULL default '',
  `cat` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM  AUTO_INCREMENT=11 ;

-- 
-- Data i tabell `expected`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `forums`
-- 

DROP TABLE IF EXISTS `forums`;
CREATE TABLE `forums` (
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `description` varchar(200) default NULL,
  `minclassread` tinyint(3) unsigned NOT NULL default '1',
  `minclasswrite` tinyint(3) unsigned NOT NULL default '1',
  `postcount` int(10) unsigned NOT NULL default '0',
  `topiccount` int(10) unsigned NOT NULL default '0',
  `minclasscreate` tinyint(3) unsigned NOT NULL default '1',
  `cat` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`),
  KEY `sort` (`sort`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `forums`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `forums_cat`
-- 

DROP TABLE IF EXISTS `forums_cat`;
CREATE TABLE `forums_cat` (
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(60) NOT NULL default '',
  `description` varchar(200) default NULL,
  `minclassview` tinyint(3) unsigned NOT NULL default '1',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=19 ;

-- 
-- Data i tabell `forums_cat`
-- 

INSERT INTO `forums_cat` VALUES (1, 1, 'General', '', 1);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `friendlist`
-- 

DROP TABLE IF EXISTS `friendlist`;
CREATE TABLE `friendlist` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `friend_id` int(10) unsigned NOT NULL default '0',
  `friend_name` varchar(250) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `friendlist`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `helpdesk`
-- 

DROP TABLE IF EXISTS `helpdesk`;
CREATE TABLE `helpdesk` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(60) NOT NULL default '',
  `msg_problem` text,
  `added` int(10) NOT NULL default '0',
  `solved_date` int(11) NOT NULL default '0',
  `solved` enum('no','yes','ignored') NOT NULL default 'no',
  `added_by` int(10) NOT NULL default '0',
  `solved_by` int(10) NOT NULL default '0',
  `msg_answer` text,
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `helpdesk`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `history`
-- 

DROP TABLE IF EXISTS `history`;
CREATE TABLE `history` (
  `uid` int(10) default NULL,
  `infohash` varchar(40) NOT NULL default '',
  `date` int(10) default NULL,
  `uploaded` bigint(20) NOT NULL default '0',
  `downloaded` bigint(20) NOT NULL default '0',
  `active` enum('yes','no') NOT NULL default 'no',
  `agent` varchar(30) NOT NULL default '',
  `seed` INT(9) NOT NULL default '0',
  `hit` BIGINT(99) NOT NULL default '0',
  UNIQUE KEY `uid` (`uid`,`infohash`)
) TYPE=MyISAM;

-- 
-- Data i tabell `history`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `invalid_logins`
-- 

DROP TABLE IF EXISTS `invalid_logins`;
CREATE TABLE `invalid_logins` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `ip` bigint(11) default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `username` varchar(40) NOT NULL default '',
  `failed` int(3) unsigned NOT NULL default '0',
  `remaining` int(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=72 ;

-- 
-- Data i tabell `invalid_logins`
-- 

INSERT INTO `invalid_logins` VALUES (7, 3397628841, 0, '', 3, 7);
INSERT INTO `invalid_logins` VALUES (9, 1423586930, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (10, 1166796593, 0, '', 2, 8);
INSERT INTO `invalid_logins` VALUES (13, 1356745958, 0, '', 4, 6);
INSERT INTO `invalid_logins` VALUES (15, 203691106, 0, '', 2, 8);
INSERT INTO `invalid_logins` VALUES (18, 1356159560, 0, '', 3, 7);
INSERT INTO `invalid_logins` VALUES (19, 1150374194, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (20, 3566352103, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (22, 1247872728, 0, '', 4, 6);
INSERT INTO `invalid_logins` VALUES (25, 1536730845, 0, '', 3, 7);
INSERT INTO `invalid_logins` VALUES (26, 3584616125, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (31, 1045987349, 0, '', 2, 8);
INSERT INTO `invalid_logins` VALUES (42, 3191874286, 183, 'jamesar', 4, 6);
INSERT INTO `invalid_logins` VALUES (47, 1385427330, 0, '', 3, 7);
INSERT INTO `invalid_logins` VALUES (51, 1159125809, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (53, 1452966885, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (56, 1412603173, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (57, 1481209149, 0, '', 4, 6);
INSERT INTO `invalid_logins` VALUES (59, 1052906569, 0, '', 1, 9);
INSERT INTO `invalid_logins` VALUES (60, 1374404994, 0, '', 3, 7);
INSERT INTO `invalid_logins` VALUES (70, 1374280755, 0, '', 2, 8);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `invites`
-- 

DROP TABLE IF EXISTS `invites`;
CREATE TABLE `invites` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `inviter` int(10) unsigned NOT NULL default '0',
  `invitee` varchar(80) NOT NULL default '',
  `hash` varchar(32) NOT NULL default '',
  `time_invited` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `inviter` (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=7 ;

-- 
-- Data i tabell `invites`
-- 


-- --------------------------------------------------------

CREATE TABLE `iplog` (
  `ipid` int(11) NOT NULL auto_increment,
  `ip` varchar(15) NOT NULL default '',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `uid` varchar(5) NOT NULL default '',
  `uipid` char(1) NOT NULL default '',
  PRIMARY KEY  (`ipid`),
  UNIQUE KEY `date` (`date`)
);

-- --------------------------------------------------------


-- 
-- Struktur för tabell `language`
-- 

DROP TABLE IF EXISTS `language`;
CREATE TABLE `language` (
  `id` int(10) NOT NULL auto_increment,
  `language` varchar(20) NOT NULL default '',
  `language_url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=2 ;

-- 
-- Data i tabell `language`
-- 

INSERT INTO `language` VALUES (1, 'English', 'language/english.php');
INSERT INTO `language` VALUES (2, 'Swedish', 'language/Swedish.php');
INSERT INTO `language` VALUES (3, 'Danish', 'language/Danish.php');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `logs`
-- 

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` int(10) default NULL,
  `txt` text,
  `type` varchar(10) NOT NULL default 'add',
  `user` varchar(40) default NULL,
  PRIMARY KEY  (`id`),
  KEY `added` (`added`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `logs`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `lottery_winners`
-- 

DROP TABLE IF EXISTS `lottery_winners`;
CREATE TABLE `lottery_winners` (
  `id` int(4) NOT NULL auto_increment,
  `win_user` varchar(20) NOT NULL default '',
  `windate` varchar(20) NOT NULL default '',
  `price` varchar(20) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `lottery_winners`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `messages`
-- 

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender` int(10) unsigned NOT NULL default '0',
  `receiver` int(10) unsigned NOT NULL default '0',
  `added` int(10) default NULL,
  `subject` varchar(30) NOT NULL default '',
  `msg` text,
  `readed` enum('yes','no') NOT NULL default 'no',
  `delbysender` enum('yes','no') NOT NULL default 'no',
  `delbyreceiver` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `messages`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `namemap`
-- 

DROP TABLE IF EXISTS `namemap`;
CREATE TABLE `namemap` (
  `info_hash` varchar(40) NOT NULL default '',
  `filename` varchar(250) NOT NULL default '',
  `url` varchar(250) NOT NULL default '',
  `info` varchar(250) NOT NULL default '',
  `data` datetime NOT NULL default '0000-00-00 00:00:00',
  `size` bigint(20) NOT NULL default '0',
  `comment` text,
  `category` int(10) unsigned NOT NULL default '6',
  `external` enum('yes','no') NOT NULL default 'no',
  `announce_url` varchar(100) NOT NULL default '',
  `uploader` int(10) NOT NULL default '1',
  `lastupdate` datetime NOT NULL default '0000-00-00 00:00:00',
  `anonymous` enum('true','false') NOT NULL default 'false',
  `nfo` text NOT NULL,
  `lastsuccess` datetime NOT NULL default '0000-00-00 00:00:00',
  `requested` enum('true','false') NOT NULL default 'false',
  `nuked` enum('true','false') NOT NULL default 'false',
  `nuke_reason` varchar(100) default NULL,
  `infosite` text,
  `screen` text,
  `video` text,
  `dd` text,
  `imdb` text, 
  `scene` enum('yes','no') NOT NULL default 'yes',
  `genre` VARCHAR( 20 ) NOT NULL,
  `free` enum('yes','no') default 'no',
  `sticky` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`info_hash`),
  KEY `filename` (`filename`),
  KEY `category` (`category`),
  KEY `uploader` (`uploader`)
) TYPE=MyISAM;

-- 
-- Data i tabell `namemap`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `news`
-- 

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(40) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `news`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `notes`
-- 

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
  `id` int(10) NOT NULL auto_increment,
  `userid` int(10) NOT NULL default '0',
  `note` varchar(255) NOT NULL default '',
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `notes`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `peers`
-- 

DROP TABLE IF EXISTS `peers`;
CREATE TABLE `peers` (
  `infohash` varchar(40) NOT NULL default '',
  `peer_id` varchar(40) NOT NULL default '',
  `bytes` bigint(20) NOT NULL default '0',
  `ip` varchar(50) NOT NULL default 'error.x',
  `port` smallint(5) unsigned NOT NULL default '0',
  `status` enum('leecher','seeder') NOT NULL default 'leecher',
  `lastupdate` int(10) unsigned NOT NULL default '0',
  `sequence` int(10) unsigned NOT NULL auto_increment,
  `natuser` enum('N','Y') NOT NULL default 'N',
  `client` varchar(60) NOT NULL default '',
  `dns` varchar(100) NOT NULL default '',
  `uploaded` bigint(20) unsigned NOT NULL default '0',
  `downloaded` bigint(20) unsigned NOT NULL default '0',
  `pid` varchar(32) default NULL,
  `with_peerid` varchar(101) NOT NULL default '',
  `without_peerid` varchar(40) NOT NULL default '',
  `compact` varchar(6) NOT NULL default '',
  PRIMARY KEY  (`infohash`,`peer_id`),
  UNIQUE KEY `sequence` (`sequence`),
  KEY `pid` (`pid`),
  KEY `ip` (`ip`)
) TYPE=MyISAM  AUTO_INCREMENT=1302 ;

-- 
-- Data i tabell `peers`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `poll_voters`
-- 

DROP TABLE IF EXISTS `poll_voters`;
CREATE TABLE `poll_voters` (
  `vid` int(10) NOT NULL auto_increment,
  `ip` varchar(16) NOT NULL default '',
  `votedate` int(10) NOT NULL default '0',
  `pid` mediumint(8) NOT NULL default '0',
  `memberid` varchar(32) default NULL,
  PRIMARY KEY  (`vid`),
  KEY `pid` (`pid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `poll_voters`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `polls`
-- 

DROP TABLE IF EXISTS `polls`;
CREATE TABLE `polls` (
  `pid` mediumint(8) NOT NULL auto_increment,
  `startdate` int(10) default NULL,
  `choices` text,
  `starter_id` mediumint(8) NOT NULL default '0',
  `votes` smallint(5) NOT NULL default '0',
  `poll_question` varchar(255) default NULL,
  `status` enum('true','false') NOT NULL default 'false',
  PRIMARY KEY  (`pid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `polls`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `posts`
-- 

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `topicid` int(10) unsigned NOT NULL default '0',
  `userid` int(10) unsigned NOT NULL default '0',
  `added` int(10) default NULL,
  `body` text,
  `editedby` int(10) unsigned NOT NULL default '0',
  `editedat` int(10) default '0',
  PRIMARY KEY  (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`),
  FULLTEXT KEY `body` (`body`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `posts`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `ratings`
-- 

DROP TABLE IF EXISTS `ratings`;
CREATE TABLE `ratings` (
  `infohash` char(40) NOT NULL default '',
  `userid` int(10) unsigned NOT NULL default '1',
  `rating` tinyint(3) unsigned NOT NULL default '0',
  `added` int(10) unsigned NOT NULL default '0',
  KEY `infohash` (`infohash`)
) TYPE=MyISAM;

-- 
-- Data i tabell `ratings`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `readposts`
-- 

DROP TABLE IF EXISTS `readposts`;
CREATE TABLE `readposts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `topicid` int(10) unsigned NOT NULL default '0',
  `lastpostread` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM  AUTO_INCREMENT=38 ;

-- 
-- Data i tabell `readposts`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `recommended`
-- 

CREATE TABLE `recommended` (
  `id` int(11) NOT NULL auto_increment,
  `info_hash` varchar(40) NOT NULL default '',
  `user_name` varchar(40) NOT NULL default 'anonymous',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM;

-- 
-- Data i tabell `recommended`
-- 



-- --------------------------------------------------------

-- 
-- Struktur för tabell `reports`
-- 

DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `addedby` int(10) unsigned NOT NULL default '0',
  `votedfor` varchar(50) default NULL,
  `type` enum('torrent','user') NOT NULL default 'torrent',
  `reason` varchar(255) NOT NULL default '',
  `dealtby` int(10) unsigned NOT NULL default '0',
  `dealtwith` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=5 ;

-- 
-- Data i tabell `reports`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `requests`
-- 

DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `request` varchar(225) default NULL,
  `descr` text NOT NULL,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `fulfilled` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL default '0',
  `cat` int(10) unsigned NOT NULL default '0',
  `filled` varchar(255) default NULL,
  `filledby` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `requests`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `shoutbox`
-- 

DROP TABLE IF EXISTS `shoutbox`;
CREATE TABLE `shoutbox` (
  `msgid` int(10) unsigned NOT NULL auto_increment,
  `user` varchar(50) NOT NULL default '0',
  `message` text,
  `date` int(11) NOT NULL default '0',
  `userid` int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`msgid`),
  KEY `msgid` (`msgid`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `shoutbox`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `style`
-- 

DROP TABLE IF EXISTS `style`;
CREATE TABLE `style` (
  `id` int(10) NOT NULL auto_increment,
  `style` varchar(20) NOT NULL default '',
  `style_url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM  AUTO_INCREMENT=17 ;

-- 
-- Data i tabell `style`
-- 

INSERT INTO `style` VALUES (3, 'killbill', './style/killbill');
INSERT INTO `style` VALUES (1, 'Dark Style', './style/dark');
INSERT INTO `style` VALUES (4, 'btit_green', './style/green');
INSERT INTO `style` VALUES (2, 'Base', './style/base');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `summary`
-- 

DROP TABLE IF EXISTS `summary`;
CREATE TABLE `summary` (
  `info_hash` char(40) NOT NULL default '',
  `dlbytes` bigint(20) unsigned NOT NULL default '0',
  `seeds` int(10) unsigned NOT NULL default '0',
  `leechers` int(10) unsigned NOT NULL default '0',
  `finished` int(10) unsigned NOT NULL default '0',
  `lastcycle` int(10) unsigned NOT NULL default '0',
  `lastSpeedCycle` int(10) unsigned NOT NULL default '0',
  `speed` bigint(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`info_hash`)
) TYPE=MyISAM;

-- 
-- Data i tabell `summary`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `tasks`
-- 

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE `tasks` (
  `task` varchar(20) NOT NULL default '',
  `last_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`task`)
) TYPE=MyISAM;

-- 
-- Data i tabell `tasks`
-- 

INSERT INTO `tasks` VALUES ('sanity', 1179942393);
INSERT INTO `tasks` VALUES ('update', 1179937304);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `thanks`
-- 

DROP TABLE IF EXISTS `thanks`;
CREATE TABLE `thanks` (
  `infohash` char(40) NOT NULL default '0',
  `userid` int(11) NOT NULL default '0'
) TYPE=MyISAM;

-- 
-- Data i tabell `thanks`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `tickets`
-- 

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(4) NOT NULL auto_increment,
  `user` int(11) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `tickets`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `timestamps`
-- 

DROP TABLE IF EXISTS `timestamps`;
CREATE TABLE `timestamps` (
  `info_hash` char(40) NOT NULL default '',
  `sequence` int(10) unsigned NOT NULL auto_increment,
  `bytes` bigint(20) unsigned NOT NULL default '0',
  `delta` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sequence`),
  KEY `sorting` (`info_hash`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `timestamps`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `timezone`
-- 

DROP TABLE IF EXISTS `timezone`;
CREATE TABLE `timezone` (
  `difference` varchar(4) NOT NULL default '0',
  `timezone` text NOT NULL,
  PRIMARY KEY  (`difference`)
) TYPE=MyISAM;

-- 
-- Data i tabell `timezone`
-- 

INSERT INTO `timezone` VALUES ('-12', '(GMT - 12:00 hours) Enitwetok, Kwajalien');
INSERT INTO `timezone` VALUES ('-11', '(GMT - 11:00 hours) Midway Island, Samoa');
INSERT INTO `timezone` VALUES ('-10', '(GMT - 10:00 hours) Hawaii');
INSERT INTO `timezone` VALUES ('-9', '(GMT - 9:00 hours) Alaska');
INSERT INTO `timezone` VALUES ('-8', '(GMT - 8:00 hours) Pacific Time (US &amp; Canada)');
INSERT INTO `timezone` VALUES ('-7', '(GMT - 7:00 hours) Mountain Time (US &amp; Canada)');
INSERT INTO `timezone` VALUES ('-6', '(GMT - 6:00 hours) Central Time (US &amp; Canada), Mexico City');
INSERT INTO `timezone` VALUES ('-5', '(GMT - 5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima');
INSERT INTO `timezone` VALUES ('-4', '(GMT - 4:00 hours) Atlantic Time (Canada), Caracas, La Paz');
INSERT INTO `timezone` VALUES ('-3.5', '(GMT - 3:30 hours) Newfoundland');
INSERT INTO `timezone` VALUES ('-3', '(GMT - 3:00 hours) Brazil, Buenos Aires, Falkland Is.');
INSERT INTO `timezone` VALUES ('-2', '(GMT - 2:00 hours) Mid-Atlantic, Ascention Is., St Helena');
INSERT INTO `timezone` VALUES ('-1', '(GMT - 1:00 hours) Azores, Cape Verde Islands');
INSERT INTO `timezone` VALUES ('0', '(GMT) Casablanca, Dublin, London, Lisbon, Monrovia');
INSERT INTO `timezone` VALUES ('1', '(GMT + 1:00 hours) Brussels, Copenhagen, Madrid, Paris');
INSERT INTO `timezone` VALUES ('2', '(GMT + 2:00 hours) Kaliningrad, South Africa');
INSERT INTO `timezone` VALUES ('3', '(GMT + 3:00 hours) Baghdad, Riyadh, Moscow, Nairobi');
INSERT INTO `timezone` VALUES ('3.5', '(GMT + 3:30 hours) Tehran');
INSERT INTO `timezone` VALUES ('4', '(GMT + 4:00 hours) Abu Dhabi, Baku, Muscat, Tbilisi');
INSERT INTO `timezone` VALUES ('4.5', '(GMT + 4:30 hours) Kabul');
INSERT INTO `timezone` VALUES ('5', '(GMT + 5:00 hours) Ekaterinburg, Karachi, Tashkent');
INSERT INTO `timezone` VALUES ('5.5', '(GMT + 5:30 hours) Bombay, Calcutta, Madras, New Delhi');
INSERT INTO `timezone` VALUES ('6', '(GMT + 6:00 hours) Almaty, Colomba, Dhakra');
INSERT INTO `timezone` VALUES ('7', '(GMT + 7:00 hours) Bangkok, Hanoi, Jakarta');
INSERT INTO `timezone` VALUES ('8', '(GMT + 8:00 hours) Hong Kong, Perth, Singapore, Taipei');
INSERT INTO `timezone` VALUES ('9', '(GMT + 9:00 hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk');
INSERT INTO `timezone` VALUES ('9.5', '(GMT + 9:30 hours) Adelaide, Darwin');
INSERT INTO `timezone` VALUES ('10', '(GMT + 10:00 hours) Melbourne, Papua New Guinea, Sydney');
INSERT INTO `timezone` VALUES ('11', '(GMT + 11:00 hours) Magadan, New Caledonia, Solomon Is.');
INSERT INTO `timezone` VALUES ('12', '(GMT + 12:00 hours) Auckland, Fiji, Marshall Island');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `topics`
-- 

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `subject` varchar(40) default NULL,
  `locked` enum('yes','no') NOT NULL default 'no',
  `forumid` int(10) unsigned NOT NULL default '0',
  `lastpost` int(10) unsigned NOT NULL default '0',
  `sticky` enum('yes','no') NOT NULL default 'no',
  `views` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `userid` (`userid`),
  KEY `subject` (`subject`),
  KEY `lastpost` (`lastpost`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `topics`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `users`
-- 

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(40) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `id_level` int(10) NOT NULL default '1',
  `random` int(10) default '0',
  `random2` int(10) default '0',
  `email` varchar(30) NOT NULL default '',
  `language` tinyint(4) NOT NULL default '1',
  `style` tinyint(4) NOT NULL default '1',
  `joined` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastconnect` datetime NOT NULL default '0000-00-00 00:00:00',
  `lip` bigint(11) default '0',
  `downloaded` bigint(20) default '0',
  `uploaded` bigint(20) default '0',
  `avatar` varchar(100) default 'images/no_avatar.gif',
  `signature` text NOT NULL,
  `pid` varchar(32) NOT NULL default '',
  `flag` tinyint(1) unsigned NOT NULL default '0',
  `topicsperpage` tinyint(3) unsigned NOT NULL default '15',
  `postsperpage` tinyint(3) unsigned NOT NULL default '15',
  `torrentsperpage` tinyint(3) unsigned NOT NULL default '15',
  `cip` varchar(15) default NULL,
  `time_offset` varchar(4) NOT NULL default '0',
  `modcomment` text NOT NULL,
  `supcomment` text NOT NULL,
  `seedbonus` decimal(5,1) NOT NULL default '0.0',
  `custom_title` varchar(50) default NULL,
  `warns` int(10) NOT NULL default '0',
  `disabled` varchar(10) NOT NULL default 'no',
  `disabledby` int(10) NOT NULL default '0',
  `disabledon` datetime NOT NULL default '0000-00-00 00:00:00',
  `disabledreason` varchar(255) default NULL,
  `warnremovedby` int(10) NOT NULL default '0',
  `parked` int(9) NOT NULL default '0',
  `age` int(9) NOT NULL default '0',
  `gender` int(9) NOT NULL default '0',
  `temp_email` varchar(50) NOT NULL default '',
  `fel` int(9) NOT NULL default '0',
  `letoltesisebesseg` int(9) NOT NULL default '0',
  `awarn` varchar(10) NOT NULL default 'no',
  `invites` int(10) NOT NULL default '0',
  `invited_by` int(10) NOT NULL default '0',
  `invitedate` datetime NOT NULL default '0000-00-00 00:00:00',
  `donor` varchar(10) NOT NULL default 'no',
  `log` varchar(255) NOT NULL default '',
  `support` varchar(50) default NULL,
  `showporn` ENUM( 'yes', 'no' ) NOT NULL DEFAULT 'yes',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_level` (`id_level`),
  KEY `pid` (`pid`),
  KEY `cip` (`cip`)
) TYPE=MyISAM  AUTO_INCREMENT=4 ;

-- 
-- Data i tabell `users`
-- 

INSERT INTO `users` VALUES (1, 'Guest', '', 1, 0, 0, 'none', 1, 1, '0000-00-00 00:00:00', '2007-05-23 18:21:51', 0, 0, 0, NULL, '', '', 0, 10, 10, 10, NULL, '0', '', '', '0.0', NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes');
INSERT INTO `users` VALUES (2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 10, 437747, 0, 'admin@localhost', 1, 1, '2005-06-03 11:17:37', '2007-05-23 21:16:16', 2130706433, 0, 0, 'images/no_avatar.gif', '', 'db5830162cd732c59efba163abc76507', 1, 10, 10, 10, '127.0.0.1', '1', '', '', '0.0', '', 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 100, 3000, 'no', 10, 0, '2007-05-05 19:53:26', 'no', '', '', 'yes');
INSERT INTO `users` VALUES (3, 'System', '', 0, 0, 0, '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, NULL, '', '', 0, 15, 15, 15, NULL, '0', '', '', '0.0', NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes');

-- --------------------------------------------------------

-- 
-- Struktur för tabell `users_level`
-- 

DROP TABLE IF EXISTS `users_level`;
CREATE TABLE `users_level` (
  `id` int(10) NOT NULL auto_increment,
  `id_level` int(11) NOT NULL default '0',
  `level` varchar(50) NOT NULL default '',
  `view_torrents` enum('yes','no') NOT NULL default 'yes',
  `edit_torrents` enum('yes','no') NOT NULL default 'no',
  `delete_torrents` enum('yes','no') NOT NULL default 'no',
  `view_users` enum('yes','no') NOT NULL default 'yes',
  `edit_users` enum('yes','no') NOT NULL default 'no',
  `delete_users` enum('yes','no') NOT NULL default 'no',
  `view_news` enum('yes','no') NOT NULL default 'yes',
  `edit_news` enum('yes','no') NOT NULL default 'no',
  `delete_news` enum('yes','no') NOT NULL default 'no',
  `can_upload` enum('yes','no') NOT NULL default 'no',
  `can_download` enum('yes','no') NOT NULL default 'yes',
  `view_forum` enum('yes','no') NOT NULL default 'yes',
  `edit_forum` enum('yes','no') NOT NULL default 'yes',
  `delete_forum` enum('yes','no') NOT NULL default 'no',
  `predef_level` enum('guest','validating','member','poweruser','uploader','designer','vip','moderator','admin','owner') NOT NULL default 'guest',
  `can_be_deleted` enum('yes','no') NOT NULL default 'yes',
  `mod_access` enum('yes','no') NOT NULL default 'no',
  `admin_access` enum('yes','no') NOT NULL default 'no',
  `owner_access` enum('yes','no') NOT NULL default 'no',
  `prefixcolor` varchar(40) NOT NULL default '',
  `suffixcolor` varchar(40) NOT NULL default '',
  `WT` int(11) NOT NULL default '0',
  UNIQUE KEY `base` (`id`),
  KEY `id_level` (`id_level`)
) TYPE=MyISAM  AUTO_INCREMENT=20 ;

-- 
-- Data i tabell `users_level`
-- 

INSERT INTO `users_level` VALUES (13, 3, 'Parked', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'member', 'no', 'no', 'no', 'no', '<span style=''color:#000000''>', '</span>', 0);
INSERT INTO `users_level` VALUES (10, 10, 'Owner', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'owner', 'no', 'yes', 'yes', 'yes', '<span style=''color:red''>', '</span>', 0);
INSERT INTO `users_level` VALUES (5, 5, 'Uploader', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'uploader', 'no', 'no', 'no', 'no', '<span style=''color:blue''>', '</span>', 0);
INSERT INTO `users_level` VALUES (7, 7, 'V.I.P.', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'vip', 'no', 'no', 'no', 'no', '<span style=''color:#107e96''>', '</span>', 0);
INSERT INTO `users_level` VALUES (8, 8, 'Moderator', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'moderator', 'no', 'yes', 'no', 'no', '<span style=''color: #428D67''>', '</span>', 0);
INSERT INTO `users_level` VALUES (9, 9, 'Administrator', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'admin', 'no', 'yes', 'yes', 'no', '<span style=\\''color:#FF8000\\''>', '</span>', 0);
INSERT INTO `users_level` VALUES (3, 3, 'Members', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'no', 'no', 'member', 'no', 'no', 'no', 'no', '<span style=\\''color:#000000\\''>', '</span>', 0);
INSERT INTO `users_level` VALUES (4, 4, 'Poweruser', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'poweruser', 'no', 'no', 'no', 'no', '<span style=''color:#000000''>', '</span>', 0);
INSERT INTO `users_level` VALUES (2, 2, 'validating', 'yes', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'validating', 'no', 'no', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (1, 1, 'guest', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'guest', 'no', 'no', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (6, 6, 'Designer', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'designer', 'no', 'no', 'no', 'no', '<span style=''color:green''>', '</span>', 0);

-- --------------------------------------------------------

-- 
-- Struktur för tabell `warnings`
-- 

DROP TABLE IF EXISTS `warnings`;
CREATE TABLE `warnings` (
  `id` int(10) NOT NULL auto_increment,
  `userid` int(10) NOT NULL default '0',
  `warns` char(2) NOT NULL default '',
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `expires` datetime NOT NULL default '0000-00-00 00:00:00',
  `warnedfor` int(2) NOT NULL default '0',
  `reason` varchar(255) NOT NULL default '',
  `addedby` int(20) NOT NULL default '0',
  `active` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM AUTO_INCREMENT=1 ;

-- 
-- Data i tabell `warnings`
-- 


-- --------------------------------------------------------

-- 
-- Struktur för tabell `wishlist`
-- 

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `user_id` int(10) unsigned NOT NULL default '0',
  `torrent_id` varchar(40) NOT NULL default '',
  `torrent_name` varchar(250) NOT NULL default '',
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`)
) TYPE=MyISAM  AUTO_INCREMENT=4 ;

-- 
-- Data i tabell `wishlist`
-- 

