-- phpMyAdmin SQL Dump
-- version 3.3.0-rc3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2010 at 04:34 PM
-- Server version: 5.1.37
-- PHP Version: 5.2.10-2ubuntu6.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `btitfm_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `addedrequests`
--

CREATE TABLE IF NOT EXISTS `addedrequests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `requestid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pollid` (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `addedrequests`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannedclient`
--

CREATE TABLE IF NOT EXISTS `bannedclient` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `peer_id` varchar(16) COLLATE latin1_general_ci NOT NULL,
  `peer_id_ascii` varchar(8) COLLATE latin1_general_ci NOT NULL,
  `user_agent` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `client_name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `reason` varchar(255) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `peer_id` (`peer_id`),
  KEY `peer_id_ascii` (`peer_id_ascii`),
  KEY `user_agent` (`user_agent`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bannedclient`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannedip`
--

CREATE TABLE IF NOT EXISTS `bannedip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` int(11) NOT NULL DEFAULT '0',
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `first` bigint(11) unsigned DEFAULT NULL,
  `last` bigint(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_last` (`first`,`last`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `bannedip`
--


-- --------------------------------------------------------

--
-- Table structure for table `bannedmail`
--

CREATE TABLE IF NOT EXISTS `bannedmail` (
  `inc` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` int(11) NOT NULL DEFAULT '0',
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `email` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`inc`),
  FULLTEXT KEY `comment` (`comment`,`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bannedmail`
--


-- --------------------------------------------------------

--
-- Table structure for table `blackjack`
--

CREATE TABLE IF NOT EXISTS `blackjack` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `points` int(11) NOT NULL DEFAULT '0',
  `status` enum('playing','waiting') COLLATE latin1_general_ci NOT NULL DEFAULT 'playing',
  `cards` text COLLATE latin1_general_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `bet` int(10) NOT NULL DEFAULT '0',
  `aces` int(11) NOT NULL DEFAULT '0',
  `blackjack` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `blackjack`
--


-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE IF NOT EXISTS `blocks` (
  `blockid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `position` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sortid` int(11) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(3) unsigned DEFAULT NULL,
  PRIMARY KEY (`blockid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=70 ;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`blockid`, `content`, `position`, `sortid`, `status`) VALUES
(1, 'menu', 'l', 1, 1),
(2, 'clock', 'l', 3, 1),
(3, 'forum', 'r', 4, 1),
(4, 'lastmember', 'r', 3, 1),
(6, 'trackerinfo', 'l', 2, 1),
(7, 'user', 'r', 3, 1),
(8, 'online', 'r', 2, 1),
(9, 'shoutbox', 'c', 1, 1),
(10, 'toptorrents', 'c', 5, 1),
(11, 'lasttorrents', 'c', 4, 1),
(12, 'news', 'c', 3, 1),
(13, 'mainmenu', 't', 2, 1),
(14, 'maintrackertoolbar', 't', 2, 1),
(15, 'mainusertoolbar', 't', 3, 1),
(16, 'serverload', 'c', 8, 0),
(17, 'poll', 'r', 4, 1),
(18, 'seedwanted', 'c', 2, 1),
(19, 'paypal', 'r', 1, 1),
(69, 'invite', 'l', 7, 0),
(20, 'games', 'r', 99, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bonus`
--

CREATE TABLE IF NOT EXISTS `bonus` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `points` decimal(4,1) NOT NULL DEFAULT '0.0',
  `traffic` bigint(20) unsigned NOT NULL DEFAULT '0',
  `gb` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bonus`
--

INSERT INTO `bonus` (`id`, `name`, `points`, `traffic`, `gb`) VALUES
(3, '1', 30.0, 1073741824, 1),
(4, '2', 50.0, 2147483648, 2),
(5, '3', 100.0, 5368709120, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `points` int(11) NOT NULL DEFAULT '0',
  `pic` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=53 ;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `points`, `pic`) VALUES
(1, 2, '2p.bmp'),
(2, 3, '3p.bmp'),
(3, 4, '4p.bmp'),
(4, 5, '5p.bmp'),
(5, 6, '6p.bmp'),
(6, 7, '7p.bmp'),
(7, 8, '8p.bmp'),
(8, 9, '9p.bmp'),
(9, 10, '10p.bmp'),
(10, 10, 'vp.bmp'),
(11, 10, 'dp.bmp'),
(12, 10, 'kp.bmp'),
(13, 11, 'tp.bmp'),
(14, 2, '2b.bmp'),
(15, 3, '3b.bmp'),
(16, 4, '4b.bmp'),
(17, 5, '5b.bmp'),
(18, 6, '6b.bmp'),
(19, 7, '7b.bmp'),
(20, 8, '8b.bmp'),
(21, 9, '9b.bmp'),
(22, 10, '10b.bmp'),
(23, 10, 'vb.bmp'),
(24, 10, 'db.bmp'),
(25, 10, 'kb.bmp'),
(26, 11, 'tb.bmp'),
(27, 2, '2k.bmp'),
(28, 3, '3k.bmp'),
(29, 4, '4k.bmp'),
(30, 5, '5k.bmp'),
(31, 6, '6k.bmp'),
(32, 7, '7k.bmp'),
(33, 8, '8k.bmp'),
(34, 9, '9k.bmp'),
(35, 10, '10k.bmp'),
(36, 10, 'vk.bmp'),
(37, 10, 'dk.bmp'),
(38, 10, 'kk.bmp'),
(39, 11, 'tk.bmp'),
(40, 2, '2c.bmp'),
(41, 3, '3c.bmp'),
(42, 4, '4c.bmp'),
(43, 5, '5c.bmp'),
(44, 6, '6c.bmp'),
(45, 7, '7c.bmp'),
(46, 8, '8c.bmp'),
(47, 9, '9c.bmp'),
(48, 10, '10c.bmp'),
(49, 10, 'vc.bmp'),
(50, 10, 'dc.bmp'),
(51, 10, 'kc.bmp'),
(52, 11, 'tc.bmp');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sub` int(10) NOT NULL DEFAULT '0',
  `sort_index` int(10) unsigned NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `sub`, `sort_index`, `image`) VALUES
(7, 'Apps Win', 0, 1010, 'win.png'),
(6, 'Books', 0, 110, 'ebooks.png'),
(5, 'Anime', 0, 90, 'anime.png'),
(4, 'Other', 0, 1000, 'other.png'),
(3, 'Games', 0, 40, 'games.png'),
(2, 'Music', 0, 20, 'music.png'),
(1, 'Movies', 0, 10, 'movies.png'),
(8, 'Apps Linux', 0, 1020, 'linux.png'),
(9, 'Apps Mac', 0, 1030, 'mac.png'),
(11, 'DVD-R', 1, 0, 'movies.png'),
(12, 'Mvcd', 1, 23333, 'film.jpg'),
(13, 'Porn', 0, 0, 'pr0n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cheapmail`
--

CREATE TABLE IF NOT EXISTS `cheapmail` (
  `domain` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `added` int(10) NOT NULL DEFAULT '0',
  `added_by` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'Unknown',
  KEY `domain` (`domain`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci COMMENT='listing of cheapmail domains for banning at account creation';

--
-- Dumping data for table `cheapmail`
--

INSERT INTO `cheapmail` (`domain`, `added`, `added_by`) VALUES
('@hotmail.com', 1177518142, 'admin'),
('hotmail.', 1177518122, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `text` text COLLATE latin1_general_ci NOT NULL,
  `ori_text` text COLLATE latin1_general_ci NOT NULL,
  `user` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `userid` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `editedby` int(10) unsigned NOT NULL DEFAULT '0',
  `editedat` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `info_hash` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `info_hash` (`info_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL DEFAULT '0',
  `lot_expire_date` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lot_number_winners` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lot_number_to_win` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lot_amount` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `lot_status` enum('yes','no','closed') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `limit_buy` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `lot_expire_date`, `lot_number_winners`, `lot_number_to_win`, `lot_amount`, `lot_status`, `limit_buy`) VALUES
(0, '', '', '', '', '', ''),
(1, '00-00-0000 00:00', '5', '', '', 'yes', '');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `flagpic` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `domain` char(3) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=245 ;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `flagpic`, `domain`) VALUES
(1, 'Sweden', 'se.png', 'SE'),
(2, 'United States of America', 'us.png', 'US'),
(3, 'American Samoa', 'as.png', 'AS'),
(4, 'Finland', 'fi.png', 'FI'),
(5, 'Canada', 'ca.png', 'CA'),
(6, 'France', 'fr.png', 'FR'),
(7, 'Germany', 'de.png', 'DE'),
(8, 'China', 'cn.png', 'CN'),
(9, 'Italy', 'it.png', 'IT'),
(10, 'Denmark', 'dk.png', 'DK'),
(11, 'Norway', 'no.png', 'NO'),
(12, 'United Kingdom', 'gb.png', 'GB'),
(13, 'Ireland', 'ie.png', 'IE'),
(14, 'Poland', 'pl.png', 'PL'),
(15, 'Netherlands', 'nl.png', 'NL'),
(16, 'Belgium', 'be.png', 'BE'),
(17, 'Japan', 'jp.png', 'JP'),
(18, 'Brazil', 'br.png', 'BR'),
(19, 'Argentina', 'ar.png', 'AR'),
(20, 'Australia', 'au.png', 'AU'),
(21, 'New Zealand', 'nz.png', 'NZ'),
(22, 'United Arab Emirates', 'ae.png', 'AE'),
(23, 'Spain', 'es.png', 'ES'),
(24, 'Portugal', 'pt.png', 'PT'),
(25, 'Mexico', 'mx.png', 'MX'),
(26, 'Singapore', 'sg.png', 'SG'),
(27, 'Anguilla', 'ai.png', 'AI'),
(28, 'Armenia', 'am.png', 'AM'),
(29, 'South Africa', 'za.png', 'ZA'),
(30, 'South Korea', 'kr.png', 'KR'),
(31, 'Jamaica', 'jm.png', 'JM'),
(32, 'Luxembourg', 'lu.png', 'LU'),
(33, 'Hong Kong', 'hk.png', 'HK'),
(34, 'Belize', 'bz.png', 'BZ'),
(35, 'Algeria', 'dz.png', 'DZ'),
(36, 'Angola', 'ao.png', 'AO'),
(37, 'Austria', 'at.png', 'AT'),
(38, 'Aruba', 'aw.png', 'AW'),
(39, 'Samoa', 'ws.png', 'WS'),
(40, 'Malaysia', 'my.png', 'MY'),
(41, 'Dominican Republic', 'do.png', 'DO'),
(42, 'Greece', 'gr.png', 'GR'),
(43, 'Guatemala', 'gt.png', 'GT'),
(44, 'Israel', 'il.png', 'IL'),
(45, 'Pakistan', 'pk.png', 'PK'),
(46, 'Czech Republic', 'cz.png', 'CZ'),
(47, 'Serbia and Montenegro', 'cs.png', 'CS'),
(48, 'Seychelles', 'sc.png', 'SC'),
(49, 'Taiwan', 'tw.png', 'TW'),
(50, 'Puerto Rico', 'pr.png', 'PR'),
(51, 'Chile', 'cl.png', 'CL'),
(52, 'Cuba', 'cu.png', 'CU'),
(53, 'Congo', 'cg.png', 'CG'),
(54, 'Afghanistan', 'af.png', 'AF'),
(55, 'Turkey', 'tr.png', 'TR'),
(56, 'Uzbekistan', 'uz.png', 'UZ'),
(57, 'Switzerland', 'ch.png', 'CH'),
(58, 'Kiribati', 'ki.gif', 'KI'),
(59, 'Philippines', 'ph.png', 'PH'),
(60, 'Burkina Faso', 'bf.png', 'BF'),
(61, 'Nigeria', 'ng.png', 'NG'),
(62, 'Iceland', 'is.png', 'IS'),
(63, 'Nauru', 'nr.png', 'NR'),
(64, 'Slovenia', 'si.png', 'SI'),
(65, 'Albania', 'al.png', 'AL'),
(66, 'Turkmenistan', 'tm.png', 'TM'),
(67, 'Bosnia and Herzegovina', 'ba.png', 'BA'),
(68, 'Andorra', 'ad.png', 'AD'),
(69, 'Lithuania', 'lt.png', 'LT'),
(70, 'India', 'in.png', 'IN'),
(71, 'Netherlands Antilles', 'an.png', 'AN'),
(72, 'Ukraine', 'ua.png', 'UA'),
(73, 'Venezuela', 've.png', 'VE'),
(74, 'Hungary', 'hu.png', 'HU'),
(75, 'Romania', 'ro.png', 'RO'),
(76, 'Vanuatu', 'vu.png', 'VU'),
(77, 'Viet Nam', 'vn.png', 'VN'),
(78, 'Trinidad & Tobago', 'tt.png', 'TT'),
(79, 'Honduras', 'hn.png', 'HN'),
(80, 'Kyrgyzstan', 'kg.png', 'KG'),
(81, 'Ecuador', 'ec.png', 'EC'),
(82, 'Bahamas', 'bs.png', 'BS'),
(83, 'Peru', 'pe.png', 'PE'),
(84, 'Cambodia', 'kh.png', 'KH'),
(85, 'Barbados', 'bb.png', 'BB'),
(86, 'Bangladesh', 'bd.png', 'BD'),
(87, 'Laos', 'la.png', 'LA'),
(88, 'Uruguay', 'uy.png', 'UY'),
(89, 'Antigua Barbuda', 'ag.png', 'AG'),
(90, 'Paraguay', 'py.png', 'PY'),
(91, 'Antarctica', 'aq.png', 'AQ'),
(92, 'Russian Federation', 'ru.png', 'RU'),
(93, 'Thailand', 'th.png', 'TH'),
(94, 'Senegal', 'sn.png', 'SN'),
(95, 'Togo', 'tg.png', 'TG'),
(96, 'North Korea', 'kp.png', 'KP'),
(97, 'Croatia', 'hr.png', 'HR'),
(98, 'Estonia', 'ee.png', 'EE'),
(99, 'Colombia', 'co.png', 'CO'),
(100, 'unknown', 'unknown.gif', 'AA'),
(101, 'Organization', 'org.png', 'ORG'),
(102, 'Aland Islands', 'ax.png', 'AX'),
(103, 'Azerbaijan', 'az.png', 'AZ'),
(104, 'Bulgaria', 'bg.png', 'BG'),
(105, 'Bahrain', 'bh.png', 'BH'),
(106, 'Burundi', 'bi.png', 'BI'),
(107, 'Benin', 'bj.png', 'BJ'),
(108, 'Bermuda', 'bm.png', 'BM'),
(109, 'Brunei Darussalam', 'bn.png', 'BN'),
(110, 'Bolivia', 'bo.png', 'BO'),
(111, 'Bhutan', 'bt.png', 'BT'),
(112, 'Bouvet Island', 'bv.png', 'BV'),
(113, 'Botswana', 'bw.png', 'BW'),
(114, 'Belarus', 'by.png', 'BY'),
(115, 'Cocos (Keeling) Islands', 'cc.png', 'CC'),
(116, 'Congo, the Democratic Republic of the', 'cd.png', 'CD'),
(117, 'Central African Republic', 'cf.png', 'CF'),
(118, 'Ivory Coast', 'ci.png', 'CI'),
(119, 'Cook Islands', 'ck.png', 'CK'),
(120, 'Cameroon', 'cm.png', 'CM'),
(121, 'Costa Rica', 'cr.png', 'CR'),
(122, 'Cape Verde', 'cv.png', 'CV'),
(123, 'Christmas Island', 'cx.png', 'CX'),
(124, 'Cyprus', 'cy.png', 'CY'),
(125, 'Djibouti', 'dj.png', 'DJ'),
(126, 'Dominica', 'dm.png', 'DM'),
(127, 'Egypt', 'eg.png', 'EG'),
(128, 'Western Sahara', 'eh.png', 'EH'),
(129, 'Eritrea', 'er.png', 'ER'),
(130, 'Ethiopia', 'et.png', 'ET'),
(131, 'Fiji', 'fj.png', 'FJ'),
(132, 'Falkland Islands (Malvinas)', 'fk.png', 'FK'),
(133, 'Micronesia, Federated States of', 'fm.png', 'FM'),
(134, 'Faroe Islands', 'fo.png', 'FO'),
(135, 'Gabon', 'ga.png', 'GA'),
(136, 'Grenada', 'gd.png', 'GD'),
(137, 'Georgia', 'ge.png', 'GE'),
(138, 'French Guiana', 'gf.png', 'GF'),
(139, 'Guernsey', 'gg.png', 'GG'),
(140, 'Ghana', 'gh.png', 'GH'),
(141, 'Gibraltar', 'gi.png', 'GI'),
(142, 'Greenland', 'gl.png', 'GL'),
(143, 'Gambia', 'gm.png', 'GM'),
(144, 'Guinea', 'gn.png', 'GN'),
(145, 'Guadeloupe', 'gp.png', 'GP'),
(146, 'Equatorial Guinea', 'gq.png', 'GQ'),
(147, 'South Georgia and the South Sandwich Islands', 'gs.png', 'GS'),
(148, 'Guam', 'gu.png', 'GU'),
(149, 'Guinea-Bissau', 'gw.png', 'GW'),
(150, 'Guyana', 'gy.png', 'GY'),
(151, 'Heard Island and McDonald Islands', 'hm.png', 'HM'),
(152, 'Haiti', 'ht.png', 'HT'),
(153, 'Indonesia', 'id.png', 'ID'),
(154, 'Isle of Man', 'im.png', 'IM'),
(155, 'British Indian Ocean Territory', 'io.png', 'IO'),
(156, 'Jersey', 'je.png', 'JE'),
(157, 'Jordan', 'jo.png', 'JO'),
(158, 'Kenya', 'ke.png', 'KE'),
(159, 'Comoros', 'km.png', 'KM'),
(160, 'Saint Kitts and Nevis', 'kn.png', 'KN'),
(161, 'Kuwait', 'kw.png', 'KW'),
(162, 'Cayman Islands', 'ky.png', 'KY'),
(163, 'Kazahstan', 'kz.png', 'KZ'),
(164, 'Lebanon', 'lb.png', 'LB'),
(165, 'Saint Lucia', 'lc.png', 'LC'),
(166, 'Liechtenstein', 'li.png', 'LI'),
(167, 'Sri Lanka', 'lk.png', 'LK'),
(168, 'Liberia', 'lr.png', 'LR'),
(169, 'Lesotho', 'ls.png', 'LS'),
(170, 'Latvia', 'lv.png', 'LV'),
(171, 'Libyan Arab Jamahiriya', 'ly.png', 'LY'),
(172, 'Marocco', 'ma.png', 'MA'),
(173, 'Monaco', 'mc.png', 'MC'),
(174, 'Moldova, Republic of', 'md.png', 'MD'),
(175, 'Madagascar', 'mg.png', 'MG'),
(176, 'Marshall Islands', 'mh.png', 'MH'),
(177, 'Macedonia, the former Yugoslav Republic of', 'mk.png', 'MK'),
(178, 'Mali', 'ml.png', 'ML'),
(179, 'Myanmar', 'mm.png', 'MM'),
(180, 'Mongolia', 'mn.png', 'MN'),
(181, 'Macao', 'mo.png', 'MO'),
(182, 'Northern Mariana Islands', 'mp.png', 'MP'),
(183, 'Martinique', 'mq.png', 'MQ'),
(184, 'Mauritania', 'mr.png', 'MR'),
(185, 'Montserrat', 'ms.png', 'MS'),
(186, 'Malta', 'mt.png', 'MT'),
(187, 'Mauritius', 'mu.png', 'MU'),
(188, 'Maldives', 'mv.png', 'MV'),
(189, 'Malawi', 'mw.png', 'MW'),
(190, 'Mozambique', 'mz.png', 'MZ'),
(191, 'Namibia', 'na.png', 'NA'),
(192, 'New Caledonia', 'nc.png', 'NC'),
(193, 'Niger', 'ne.png', 'NE'),
(194, 'Norfolk Island', 'nf.png', 'NF'),
(195, 'Nicaragua', 'ni.png', 'NI'),
(196, 'Nepal', 'np.png', 'NP'),
(197, 'Niue', 'nu.png', 'NU'),
(198, 'Oman', 'om.png', 'OM'),
(199, 'Panama', 'pa.png', 'PA'),
(200, 'French Polynesia', 'pf.png', 'PF'),
(201, 'Papua New Guinea', 'pg.png', 'PG'),
(202, 'Saint Pierre and Miquelon', 'pm.png', 'PM'),
(203, 'Pitcairn', 'pn.png', 'PN'),
(204, 'Palestinian Territory, Occupied', 'ps.png', 'PS'),
(205, 'Palau', 'pw.png', 'PW'),
(206, 'Qatar', 'qa.png', 'QA'),
(207, 'Reunion', 're.png', 'RE'),
(208, 'Rwanda', 'rw.png', 'RW'),
(209, 'Saudi Arabia', 'sa.png', 'SA'),
(210, 'Solomon Islands', 'sb.png', 'SB'),
(211, 'Sudan', 'sd.png', 'SD'),
(212, 'Saint Helena', 'sh.png', 'SH'),
(213, 'Svalbard and Jan Mayen', 'sj.png', 'SJ'),
(214, 'Slovakia', 'sk.png', 'SK'),
(215, 'Sierra Leone', 'sl.png', 'SL'),
(216, 'San Marino', 'sm.png', 'SM'),
(217, 'Somalia', 'so.png', 'SO'),
(218, 'Suriname', 'sr.png', 'SR'),
(219, 'Sao Tome and Principe', 'st.png', 'ST'),
(220, 'El Salvador', 'sv.png', 'SV'),
(221, 'Syrian Arab Republic', 'sy.png', 'SY'),
(222, 'Swaziland', 'sz.png', 'SZ'),
(223, 'Turks and Caicos Islands', 'tc.png', 'TC'),
(224, 'Chad', 'td.png', 'TD'),
(225, 'French Southern Territories', 'tf.png', 'TF'),
(226, 'Tajikistan', 'tj.png', 'TJ'),
(227, 'Tokelau', 'tk.png', 'TK'),
(228, 'Timor-Leste', 'tl.png', 'TL'),
(229, 'Tunisia', 'tn.png', 'TN'),
(230, 'Tonga', 'to.png', 'TO'),
(231, 'Tuvalu', 'tv.png', 'TV'),
(232, 'Tanzania, United Republic of', 'tz.png', 'TZ'),
(233, 'Uganda', 'ug.png', 'UG'),
(234, 'United States Minor Outlying Islands', 'um.png', 'UM'),
(235, 'Holy See (Vatican City State)', 'va.png', 'VA'),
(236, 'Saint Vincent and the Grenadines', 'vc.png', 'VC'),
(237, 'Virgin Islands, British', 'vg.png', 'VG'),
(238, 'Wallis and Futuna', 'wf.png', 'WF'),
(239, 'Yemen', 'ye.png', 'YE'),
(240, 'Mayotte', 'yt.png', 'YT'),
(241, 'Zambia', 'zm.png', 'ZM'),
(242, 'Zimbabwe', 'zw.png', 'ZW'),
(243, 'Iraq', 'iq.png', 'IQ'),
(244, 'Iran, Islamic Republic of', 'ir.png', 'IR');

-- --------------------------------------------------------

--
-- Table structure for table `dbbackup`
--

CREATE TABLE IF NOT EXISTS `dbbackup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `added` date DEFAULT '0000-00-00',
  `day` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dbbackup`
--


-- --------------------------------------------------------

--
-- Table structure for table `donator`
--

CREATE TABLE IF NOT EXISTS `donator` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `donator` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `donation` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `ytd_donation` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `donator`
--


-- --------------------------------------------------------

--
-- Table structure for table `dox`
--

CREATE TABLE IF NOT EXISTS `dox` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `filename` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `size` int(10) unsigned NOT NULL DEFAULT '0',
  `uppedby` int(10) unsigned NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `dox`
--


-- --------------------------------------------------------

--
-- Table structure for table `expected`
--

CREATE TABLE IF NOT EXISTS `expected` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `expect` varchar(225) COLLATE latin1_general_ci DEFAULT NULL,
  `descr` text COLLATE latin1_general_ci NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `cat` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `expected`
--


-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `description` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `minclassread` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `minclasswrite` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `postcount` int(10) unsigned NOT NULL DEFAULT '0',
  `topiccount` int(10) unsigned NOT NULL DEFAULT '0',
  `minclasscreate` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `cat` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `sort` (`sort`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `forums`
--


-- --------------------------------------------------------

--
-- Table structure for table `forums_cat`
--

CREATE TABLE IF NOT EXISTS `forums_cat` (
  `sort` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `description` varchar(200) COLLATE latin1_general_ci DEFAULT NULL,
  `minclassview` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `forums_cat`
--

INSERT INTO `forums_cat` (`sort`, `id`, `name`, `description`, `minclassview`) VALUES
(1, 1, 'General', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friendlist`
--

CREATE TABLE IF NOT EXISTS `friendlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend_name` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `friendlist`
--


-- --------------------------------------------------------

--
-- Table structure for table `helpdesk`
--

CREATE TABLE IF NOT EXISTS `helpdesk` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(60) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `msg_problem` text COLLATE latin1_general_ci,
  `added` int(10) NOT NULL DEFAULT '0',
  `solved_date` int(11) NOT NULL DEFAULT '0',
  `solved` enum('no','yes','ignored') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `added_by` int(10) NOT NULL DEFAULT '0',
  `solved_by` int(10) NOT NULL DEFAULT '0',
  `msg_answer` text COLLATE latin1_general_ci,
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `helpdesk`
--


-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `uid` int(10) DEFAULT NULL,
  `infohash` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` int(10) DEFAULT NULL,
  `uploaded` bigint(20) NOT NULL DEFAULT '0',
  `downloaded` bigint(20) NOT NULL DEFAULT '0',
  `active` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `agent` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `seed` int(9) NOT NULL DEFAULT '0',
  `hit` bigint(99) NOT NULL DEFAULT '0',
  UNIQUE KEY `uid` (`uid`,`infohash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `history`
--


-- --------------------------------------------------------

--
-- Table structure for table `invalid_logins`
--

CREATE TABLE IF NOT EXISTS `invalid_logins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` bigint(11) DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `failed` int(3) unsigned NOT NULL DEFAULT '0',
  `remaining` int(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=72 ;

--
-- Dumping data for table `invalid_logins`
--

INSERT INTO `invalid_logins` (`id`, `ip`, `userid`, `username`, `failed`, `remaining`) VALUES
(7, 3397628841, 0, '', 3, 7),
(9, 1423586930, 0, '', 1, 9),
(10, 1166796593, 0, '', 2, 8),
(13, 1356745958, 0, '', 4, 6),
(15, 203691106, 0, '', 2, 8),
(18, 1356159560, 0, '', 3, 7),
(19, 1150374194, 0, '', 1, 9),
(20, 3566352103, 0, '', 1, 9),
(22, 1247872728, 0, '', 4, 6),
(25, 1536730845, 0, '', 3, 7),
(26, 3584616125, 0, '', 1, 9),
(31, 1045987349, 0, '', 2, 8),
(42, 3191874286, 183, 'jamesar', 4, 6),
(47, 1385427330, 0, '', 3, 7),
(51, 1159125809, 0, '', 1, 9),
(53, 1452966885, 0, '', 1, 9),
(56, 1412603173, 0, '', 1, 9),
(57, 1481209149, 0, '', 4, 6),
(59, 1052906569, 0, '', 1, 9),
(60, 1374404994, 0, '', 3, 7),
(70, 1374280755, 0, '', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `invites`
--

CREATE TABLE IF NOT EXISTS `invites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inviter` int(10) unsigned NOT NULL DEFAULT '0',
  `invitee` varchar(80) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `hash` varchar(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `time_invited` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `inviter` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `invites`
--


-- --------------------------------------------------------

--
-- Table structure for table `iplog`
--

CREATE TABLE IF NOT EXISTS `iplog` (
  `ipid` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uid` varchar(5) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `uipid` char(1) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`ipid`),
  UNIQUE KEY `date` (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `iplog`
--


-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `language` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `language_url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language`, `language_url`) VALUES
(1, 'English', 'language/english.php'),
(2, 'Swedish', 'language/Swedish.php'),
(3, 'Danish', 'language/Danish.php');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` int(10) DEFAULT NULL,
  `txt` text COLLATE latin1_general_ci,
  `type` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'add',
  `user` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `added` (`added`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `lottery_winners`
--

CREATE TABLE IF NOT EXISTS `lottery_winners` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `win_user` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `windate` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `price` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `lottery_winners`
--


-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` int(10) unsigned NOT NULL DEFAULT '0',
  `receiver` int(10) unsigned NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `subject` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `msg` text COLLATE latin1_general_ci,
  `readed` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `delbysender` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `delbyreceiver` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `namemap`
--

CREATE TABLE IF NOT EXISTS `namemap` (
  `info_hash` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `filename` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `url` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `info` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `data` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `comment` text COLLATE latin1_general_ci,
  `category` int(10) unsigned NOT NULL DEFAULT '6',
  `external` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `announce_url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `uploader` int(10) NOT NULL DEFAULT '1',
  `lastupdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anonymous` enum('true','false') COLLATE latin1_general_ci NOT NULL DEFAULT 'false',
  `nfo` text COLLATE latin1_general_ci NOT NULL,
  `lastsuccess` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `requested` enum('true','false') COLLATE latin1_general_ci NOT NULL DEFAULT 'false',
  `nuked` enum('true','false') COLLATE latin1_general_ci NOT NULL DEFAULT 'false',
  `nuke_reason` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `infosite` text COLLATE latin1_general_ci,
  `screen` text COLLATE latin1_general_ci,
  `video` text COLLATE latin1_general_ci,
  `dd` text COLLATE latin1_general_ci,
  `imdb` text COLLATE latin1_general_ci,
  `scene` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `genre` varchar(20) COLLATE latin1_general_ci NOT NULL,
  `free` enum('yes','no') COLLATE latin1_general_ci DEFAULT 'no',
  `sticky` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  PRIMARY KEY (`info_hash`),
  KEY `filename` (`filename`),
  KEY `category` (`category`),
  KEY `uploader` (`uploader`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `namemap`
--


-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0',
  `note` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `peers`
--

CREATE TABLE IF NOT EXISTS `peers` (
  `infohash` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `peer_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `bytes` bigint(20) NOT NULL DEFAULT '0',
  `ip` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT 'error.x',
  `port` smallint(5) unsigned NOT NULL DEFAULT '0',
  `status` enum('leecher','seeder') COLLATE latin1_general_ci NOT NULL DEFAULT 'leecher',
  `lastupdate` int(10) unsigned NOT NULL DEFAULT '0',
  `sequence` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `natuser` enum('N','Y') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `client` varchar(60) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dns` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `uploaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `downloaded` bigint(20) unsigned NOT NULL DEFAULT '0',
  `pid` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `with_peerid` varchar(101) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `without_peerid` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `compact` varchar(6) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`infohash`,`peer_id`),
  UNIQUE KEY `sequence` (`sequence`),
  KEY `pid` (`pid`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1302 ;

--
-- Dumping data for table `peers`
--


-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `pid` mediumint(8) NOT NULL AUTO_INCREMENT,
  `startdate` int(10) DEFAULT NULL,
  `choices` text COLLATE latin1_general_ci,
  `starter_id` mediumint(8) NOT NULL DEFAULT '0',
  `votes` smallint(5) NOT NULL DEFAULT '0',
  `poll_question` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `status` enum('true','false') COLLATE latin1_general_ci NOT NULL DEFAULT 'false',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `polls`
--


-- --------------------------------------------------------

--
-- Table structure for table `poll_voters`
--

CREATE TABLE IF NOT EXISTS `poll_voters` (
  `vid` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(16) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `votedate` int(10) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `memberid` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`vid`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `poll_voters`
--


-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `added` int(10) DEFAULT NULL,
  `body` text COLLATE latin1_general_ci,
  `editedby` int(10) unsigned NOT NULL DEFAULT '0',
  `editedat` int(10) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`),
  FULLTEXT KEY `body` (`body`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `posts`
--


-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `infohash` char(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `userid` int(10) unsigned NOT NULL DEFAULT '1',
  `rating` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `added` int(10) unsigned NOT NULL DEFAULT '0',
  KEY `infohash` (`infohash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `ratings`
--


-- --------------------------------------------------------

--
-- Table structure for table `readposts`
--

CREATE TABLE IF NOT EXISTS `readposts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `topicid` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpostread` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=38 ;

--
-- Dumping data for table `readposts`
--


-- --------------------------------------------------------

--
-- Table structure for table `recommended`
--

CREATE TABLE IF NOT EXISTS `recommended` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `info_hash` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `user_name` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT 'anonymous',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `recommended`
--


-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `votedfor` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `type` enum('torrent','user') COLLATE latin1_general_ci NOT NULL DEFAULT 'torrent',
  `reason` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dealtby` int(10) unsigned NOT NULL DEFAULT '0',
  `dealtwith` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reports`
--


-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `request` varchar(225) COLLATE latin1_general_ci DEFAULT NULL,
  `descr` text COLLATE latin1_general_ci NOT NULL,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fulfilled` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `cat` int(10) unsigned NOT NULL DEFAULT '0',
  `filled` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `filledby` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `requests`
--


-- --------------------------------------------------------

--
-- Table structure for table `shoutbox`
--

CREATE TABLE IF NOT EXISTS `shoutbox` (
  `msgid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `message` text COLLATE latin1_general_ci,
  `date` int(11) NOT NULL DEFAULT '0',
  `userid` int(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`msgid`),
  KEY `msgid` (`msgid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `shoutbox`
--


-- --------------------------------------------------------

--
-- Table structure for table `style`
--

CREATE TABLE IF NOT EXISTS `style` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `style` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `style_url` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `style`
--

INSERT INTO `style` (`id`, `style`, `style_url`) VALUES
(3, 'killbill', './style/killbill'),
(1, 'Dark Style', './style/dark'),
(4, 'btit_green', './style/green'),
(2, 'Base', './style/base');

-- --------------------------------------------------------

--
-- Table structure for table `summary`
--

CREATE TABLE IF NOT EXISTS `summary` (
  `info_hash` char(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `dlbytes` bigint(20) unsigned NOT NULL DEFAULT '0',
  `seeds` int(10) unsigned NOT NULL DEFAULT '0',
  `leechers` int(10) unsigned NOT NULL DEFAULT '0',
  `finished` int(10) unsigned NOT NULL DEFAULT '0',
  `lastcycle` int(10) unsigned NOT NULL DEFAULT '0',
  `lastSpeedCycle` int(10) unsigned NOT NULL DEFAULT '0',
  `speed` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`info_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `summary`
--


-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task` varchar(20) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `last_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`task`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task`, `last_time`) VALUES
('sanity', 1179942393),
('update', 1179937304);

-- --------------------------------------------------------

--
-- Table structure for table `thanks`
--

CREATE TABLE IF NOT EXISTS `thanks` (
  `infohash` char(40) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `userid` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `thanks`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tickets`
--


-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE IF NOT EXISTS `timestamps` (
  `info_hash` char(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `sequence` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bytes` bigint(20) unsigned NOT NULL DEFAULT '0',
  `delta` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`sequence`),
  KEY `sorting` (`info_hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `timestamps`
--


-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
  `difference` varchar(4) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `timezone` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`difference`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`difference`, `timezone`) VALUES
('-12', '(GMT - 12:00 hours) Enitwetok, Kwajalien'),
('-11', '(GMT - 11:00 hours) Midway Island, Samoa'),
('-10', '(GMT - 10:00 hours) Hawaii'),
('-9', '(GMT - 9:00 hours) Alaska'),
('-8', '(GMT - 8:00 hours) Pacific Time (US &amp; Canada)'),
('-7', '(GMT - 7:00 hours) Mountain Time (US &amp; Canada)'),
('-6', '(GMT - 6:00 hours) Central Time (US &amp; Canada), Mexico City'),
('-5', '(GMT - 5:00 hours) Eastern Time (US &amp; Canada), Bogota, Lima'),
('-4', '(GMT - 4:00 hours) Atlantic Time (Canada), Caracas, La Paz'),
('-3.5', '(GMT - 3:30 hours) Newfoundland'),
('-3', '(GMT - 3:00 hours) Brazil, Buenos Aires, Falkland Is.'),
('-2', '(GMT - 2:00 hours) Mid-Atlantic, Ascention Is., St Helena'),
('-1', '(GMT - 1:00 hours) Azores, Cape Verde Islands'),
('0', '(GMT) Casablanca, Dublin, London, Lisbon, Monrovia'),
('1', '(GMT + 1:00 hours) Brussels, Copenhagen, Madrid, Paris'),
('2', '(GMT + 2:00 hours) Kaliningrad, South Africa'),
('3', '(GMT + 3:00 hours) Baghdad, Riyadh, Moscow, Nairobi'),
('3.5', '(GMT + 3:30 hours) Tehran'),
('4', '(GMT + 4:00 hours) Abu Dhabi, Baku, Muscat, Tbilisi'),
('4.5', '(GMT + 4:30 hours) Kabul'),
('5', '(GMT + 5:00 hours) Ekaterinburg, Karachi, Tashkent'),
('5.5', '(GMT + 5:30 hours) Bombay, Calcutta, Madras, New Delhi'),
('6', '(GMT + 6:00 hours) Almaty, Colomba, Dhakra'),
('7', '(GMT + 7:00 hours) Bangkok, Hanoi, Jakarta'),
('8', '(GMT + 8:00 hours) Hong Kong, Perth, Singapore, Taipei'),
('9', '(GMT + 9:00 hours) Osaka, Sapporo, Seoul, Tokyo, Yakutsk'),
('9.5', '(GMT + 9:30 hours) Adelaide, Darwin'),
('10', '(GMT + 10:00 hours) Melbourne, Papua New Guinea, Sydney'),
('11', '(GMT + 11:00 hours) Magadan, New Caledonia, Solomon Is.'),
('12', '(GMT + 12:00 hours) Auckland, Fiji, Marshall Island');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(40) COLLATE latin1_general_ci DEFAULT NULL,
  `locked` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `forumid` int(10) unsigned NOT NULL DEFAULT '0',
  `lastpost` int(10) unsigned NOT NULL DEFAULT '0',
  `sticky` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `views` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  KEY `subject` (`subject`),
  KEY `lastpost` (`lastpost`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `password` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `id_level` int(10) NOT NULL DEFAULT '1',
  `random` int(10) DEFAULT '0',
  `random2` int(10) DEFAULT '0',
  `email` varchar(30) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `language` tinyint(4) NOT NULL DEFAULT '1',
  `style` tinyint(4) NOT NULL DEFAULT '1',
  `joined` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastconnect` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lip` bigint(11) DEFAULT '0',
  `downloaded` bigint(20) DEFAULT '0',
  `uploaded` bigint(20) DEFAULT '0',
  `avatar` varchar(100) COLLATE latin1_general_ci DEFAULT 'images/no_avatar.gif',
  `signature` text COLLATE latin1_general_ci NOT NULL,
  `pid` varchar(32) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topicsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `postsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `torrentsperpage` tinyint(3) unsigned NOT NULL DEFAULT '15',
  `cip` varchar(15) COLLATE latin1_general_ci DEFAULT NULL,
  `time_offset` varchar(4) COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `modcomment` text COLLATE latin1_general_ci NOT NULL,
  `supcomment` text COLLATE latin1_general_ci NOT NULL,
  `seedbonus` decimal(5,1) NOT NULL DEFAULT '0.0',
  `custom_title` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `warns` int(10) NOT NULL DEFAULT '0',
  `disabled` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `disabledby` int(10) NOT NULL DEFAULT '0',
  `disabledon` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `disabledreason` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `warnremovedby` int(10) NOT NULL DEFAULT '0',
  `parked` int(9) NOT NULL DEFAULT '0',
  `age` int(9) NOT NULL DEFAULT '0',
  `gender` int(9) NOT NULL DEFAULT '0',
  `temp_email` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `fel` int(9) NOT NULL DEFAULT '0',
  `letoltesisebesseg` int(9) NOT NULL DEFAULT '0',
  `awarn` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `invites` int(10) NOT NULL DEFAULT '0',
  `invited_by` int(10) NOT NULL DEFAULT '0',
  `invitedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `donor` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `log` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `support` varchar(50) COLLATE latin1_general_ci DEFAULT NULL,
  `showporn` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_level` (`id_level`),
  KEY `pid` (`pid`),
  KEY `cip` (`cip`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `id_level`, `random`, `random2`, `email`, `language`, `style`, `joined`, `lastconnect`, `lip`, `downloaded`, `uploaded`, `avatar`, `signature`, `pid`, `flag`, `topicsperpage`, `postsperpage`, `torrentsperpage`, `cip`, `time_offset`, `modcomment`, `supcomment`, `seedbonus`, `custom_title`, `warns`, `disabled`, `disabledby`, `disabledon`, `disabledreason`, `warnremovedby`, `parked`, `age`, `gender`, `temp_email`, `fel`, `letoltesisebesseg`, `awarn`, `invites`, `invited_by`, `invitedate`, `donor`, `log`, `support`, `showporn`) VALUES
(1, 'Guest', '', 1, 0, 0, 'none', 1, 1, '0000-00-00 00:00:00', '2007-05-23 18:21:51', 0, 0, 0, NULL, '', '', 0, 10, 10, 10, NULL, '0', '', '', 0.0, NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes'),
(3, 'System', '', 0, 0, 0, '', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0, 0, NULL, '', '', 0, 15, 15, 15, NULL, '0', '', '', 0.0, NULL, 0, 'no', 0, '0000-00-00 00:00:00', NULL, 0, 0, 0, 0, '', 0, 0, 'no', 0, 0, '0000-00-00 00:00:00', 'no', '', NULL, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `users_level`
--

CREATE TABLE IF NOT EXISTS `users_level` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_level` int(11) NOT NULL DEFAULT '0',
  `level` varchar(50) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `view_torrents` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `edit_torrents` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `delete_torrents` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `view_users` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `edit_users` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `delete_users` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `view_news` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `edit_news` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `delete_news` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `can_upload` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `can_download` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `view_forum` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `edit_forum` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `delete_forum` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `predef_level` enum('guest','validating','member','poweruser','uploader','designer','vip','moderator','admin','owner') COLLATE latin1_general_ci NOT NULL DEFAULT 'guest',
  `can_be_deleted` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'yes',
  `mod_access` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `admin_access` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `owner_access` enum('yes','no') COLLATE latin1_general_ci NOT NULL DEFAULT 'no',
  `prefixcolor` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `suffixcolor` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `WT` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `base` (`id`),
  KEY `id_level` (`id_level`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `users_level`
--

INSERT INTO `users_level` (`id`, `id_level`, `level`, `view_torrents`, `edit_torrents`, `delete_torrents`, `view_users`, `edit_users`, `delete_users`, `view_news`, `edit_news`, `delete_news`, `can_upload`, `can_download`, `view_forum`, `edit_forum`, `delete_forum`, `predef_level`, `can_be_deleted`, `mod_access`, `admin_access`, `owner_access`, `prefixcolor`, `suffixcolor`, `WT`) VALUES
(13, 3, 'Parked', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'member', 'no', 'no', 'no', 'no', '<span style=''color:#000000''>', '</span>', 0),
(10, 10, 'Owner', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'owner', 'no', 'yes', 'yes', 'yes', '<span style=''color:red''>', '</span>', 0),
(5, 5, 'Uploader', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'uploader', 'no', 'no', 'no', 'no', '<span style=''color:blue''>', '</span>', 0),
(7, 7, 'V.I.P.', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'vip', 'no', 'no', 'no', 'no', '<span style=''color:#107e96''>', '</span>', 0),
(8, 8, 'Moderator', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'moderator', 'no', 'yes', 'no', 'no', '<span style=''color: #428D67''>', '</span>', 0),
(9, 9, 'Administrator', 'yes', 'yes', 'yes', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'admin', 'no', 'yes', 'yes', 'no', '<span style=\\''color:#FF8000\\''>', '</span>', 0),
(3, 3, 'Members', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'no', 'no', 'member', 'no', 'no', 'no', 'no', '<span style=\\''color:#000000\\''>', '</span>', 0),
(4, 4, 'Poweruser', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'poweruser', 'no', 'no', 'no', 'no', '<span style=''color:#000000''>', '</span>', 0),
(2, 2, 'validating', 'yes', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'validating', 'no', 'no', 'no', 'no', '', '', 0),
(1, 1, 'guest', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'guest', 'no', 'no', 'no', 'no', '', '', 0),
(6, 6, 'Designer', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'designer', 'no', 'no', 'no', 'no', '<span style=''color:green''>', '</span>', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warnings`
--

CREATE TABLE IF NOT EXISTS `warnings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `userid` int(10) NOT NULL DEFAULT '0',
  `warns` char(2) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `expires` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `warnedfor` int(2) NOT NULL DEFAULT '0',
  `reason` varchar(255) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `addedby` int(20) NOT NULL DEFAULT '0',
  `active` varchar(10) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `warnings`
--


-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `torrent_id` varchar(40) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `torrent_name` varchar(250) COLLATE latin1_general_ci NOT NULL DEFAULT '',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `wishlist`
--

