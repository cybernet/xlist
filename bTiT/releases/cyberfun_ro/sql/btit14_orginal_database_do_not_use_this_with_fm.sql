-- phpMyAdmin SQL Dump
-- version 2.9.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: 26 Gen, 2007 at 06:00 PM
-- Versione MySQL: 5.0.27
-- Versione PHP: 5.2.0
--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bannedip`
--

CREATE TABLE `bannedip` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` int(11) NOT NULL default '0',
  `addedby` int(10) unsigned NOT NULL default '0',
  `comment` varchar(255) NOT NULL default '',
  `first` bigint(11) unsigned default NULL,
  `last` bigint(11) unsigned default NULL,
  PRIMARY KEY  (`id`),
  KEY `first_last` (`first`,`last`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `bannedip`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `blocks`
--

CREATE TABLE `blocks` (
  `blockid` int(11) unsigned NOT NULL auto_increment,
  `content` varchar(255) NOT NULL default '',
  `position` char(1) NOT NULL default '',
  `sortid` int(11) unsigned NOT NULL default '0',
  `status` tinyint(3) unsigned default NULL,
  PRIMARY KEY  (`blockid`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `blocks`
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

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(30) NOT NULL default '',
  `sub` int(10) NOT NULL default '0',
  `sort_index` int(10) unsigned NOT NULL default '0',
  `image` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `categories`
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

-- --------------------------------------------------------

--
-- Struttura della tabella `comments`
--

CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `text` text NOT NULL,
  `ori_text` text NOT NULL,
  `user` varchar(20) NOT NULL default '',
  `info_hash` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `info_hash` (`info_hash`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `comments`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `countries`
--

CREATE TABLE `countries` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `flagpic` varchar(50) default NULL,
  `domain` char(3) default NULL,
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `countries`
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
-- Struttura della tabella `forums`
--

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
  PRIMARY KEY  (`id`),
  KEY `sort` (`sort`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `forums`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `history`
--

CREATE TABLE `history` (
  `uid` int(10) default NULL,
  `infohash` varchar(40) NOT NULL default '',
  `date` int(10) default NULL,
  `uploaded` bigint(20) NOT NULL default '0',
  `downloaded` bigint(20) NOT NULL default '0',
  `active` enum('yes','no') NOT NULL default 'no',
  `agent` varchar(30) NOT NULL default '',
  UNIQUE KEY `uid` (`uid`,`infohash`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `history`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `language`
--

CREATE TABLE `language` (
  `id` int(10) NOT NULL auto_increment,
  `language` varchar(20) NOT NULL default '',
  `language_url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `language`
--

INSERT INTO `language` VALUES (1, 'English', 'language/english.php');

-- --------------------------------------------------------

--
-- Struttura della tabella `logs`
--

CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `added` int(10) default NULL,
  `txt` text,
  `type` varchar(10) NOT NULL default 'add',
  `user` varchar(40) default NULL,
  PRIMARY KEY  (`id`),
  KEY `added` (`added`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `logs`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender` int(10) unsigned NOT NULL default '0',
  `receiver` int(10) unsigned NOT NULL default '0',
  `added` int(10) default NULL,
  `subject` varchar(30) NOT NULL default '',
  `msg` text,
  `readed` enum('yes','no') NOT NULL default 'no',
  PRIMARY KEY  (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `messages`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `namemap`
--

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
  `lastsuccess` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`info_hash`),
  KEY `filename` (`filename`),
  KEY `category` (`category`),
  KEY `uploader` (`uploader`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `namemap`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL auto_increment,
  `news` blob NOT NULL,
  `user_id` int(10) NOT NULL default '0',
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `title` varchar(40) NOT NULL default '',
  UNIQUE KEY `id` (`id`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `news`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `peers`
--

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
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `peers`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `poll_voters`
--

CREATE TABLE `poll_voters` (
  `vid` int(10) NOT NULL auto_increment,
  `ip` varchar(16) NOT NULL default '',
  `votedate` int(10) NOT NULL default '0',
  `pid` mediumint(8) NOT NULL default '0',
  `memberid` varchar(32) default NULL,
  PRIMARY KEY  (`vid`),
  KEY `pid` (`pid`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `poll_voters`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `polls`
--

CREATE TABLE `polls` (
  `pid` mediumint(8) NOT NULL auto_increment,
  `startdate` int(10) default NULL,
  `choices` text,
  `starter_id` mediumint(8) NOT NULL default '0',
  `votes` smallint(5) NOT NULL default '0',
  `poll_question` varchar(255) default NULL,
  `status` enum('true','false') NOT NULL default 'false',
  PRIMARY KEY  (`pid`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `polls`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

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
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `posts`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `ratings`
--

CREATE TABLE `ratings` (
  `infohash` char(40) NOT NULL default '',
  `userid` int(10) unsigned NOT NULL default '1',
  `rating` tinyint(3) unsigned NOT NULL default '0',
  `added` int(10) unsigned NOT NULL default '0',
  KEY `infohash` (`infohash`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `ratings`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `readposts`
--

CREATE TABLE `readposts` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `userid` int(10) unsigned NOT NULL default '0',
  `topicid` int(10) unsigned NOT NULL default '0',
  `lastpostread` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `topicid` (`topicid`),
  KEY `userid` (`userid`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `readposts`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `style`
--

CREATE TABLE `style` (
  `id` int(10) NOT NULL auto_increment,
  `style` varchar(20) NOT NULL default '',
  `style_url` varchar(100) NOT NULL default '',
  PRIMARY KEY  (`id`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `style`
--

INSERT INTO `style` VALUES (1, 'BtitTracker', './style/base');
INSERT INTO `style` VALUES (2, 'Green', './style/green');
INSERT INTO `style` VALUES (3, 'Dark', './style/dark');
INSERT INTO `style` VALUES (4, 'KillBill', './style/killbill');

-- --------------------------------------------------------

--
-- Struttura della tabella `summary`
--

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
-- Dump dei dati per la tabella `summary`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `tasks`
--

CREATE TABLE `tasks` (
  `task` varchar(20) NOT NULL default '',
  `last_time` int(10) NOT NULL default '0',
  PRIMARY KEY  (`task`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `tasks`
--

INSERT INTO `tasks` VALUES ('sanity', 1166012633);
INSERT INTO `tasks` VALUES ('update', 1166012633);

-- --------------------------------------------------------

--
-- Struttura della tabella `timestamps`
--

CREATE TABLE `timestamps` (
  `info_hash` char(40) NOT NULL default '',
  `sequence` int(10) unsigned NOT NULL auto_increment,
  `bytes` bigint(20) unsigned NOT NULL default '0',
  `delta` smallint(5) unsigned NOT NULL default '0',
  PRIMARY KEY  (`sequence`),
  KEY `sorting` (`info_hash`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `timestamps`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `timezone`
--

CREATE TABLE `timezone` (
  `difference` varchar(4) NOT NULL default '0',
  `timezone` text NOT NULL,
  PRIMARY KEY  (`difference`)
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `timezone`
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
-- Struttura della tabella `topics`
--

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
) TYPE=MyISAM;

--
-- Dump dei dati per la tabella `topics`
--


-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(40) NOT NULL default '',
  `password` varchar(40) NOT NULL default '',
  `id_level` int(10) NOT NULL default '1',
  `random` int(10) default '0',
  `email` varchar(30) NOT NULL default '',
  `language` tinyint(4) NOT NULL default '1',
  `style` tinyint(4) NOT NULL default '1',
  `joined` datetime NOT NULL default '0000-00-00 00:00:00',
  `lastconnect` datetime NOT NULL default '0000-00-00 00:00:00',
  `lip` bigint(11) default '0',
  `downloaded` bigint(20) default '0',
  `uploaded` bigint(20) default '0',
  `avatar` varchar(100) default NULL,
  `pid` varchar(32) NOT NULL default '',
  `flag` tinyint(1) unsigned NOT NULL default '0',
  `topicsperpage` tinyint(3) unsigned NOT NULL default '15',
  `postsperpage` tinyint(3) unsigned NOT NULL default '15',
  `torrentsperpage` tinyint(3) unsigned NOT NULL default '15',
  `cip` varchar(15) default NULL,
  `time_offset` varchar(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `id_level` (`id_level`),
  KEY `pid` (`pid`),
  KEY `cip` (`cip`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` VALUES (1, 'Guest', '', 1, 0, 'none', 1, 1, '0000-00-00 00:00:00', '2005-12-22 11:23:36', 0, 0, 0, NULL, '', 0, 10, 10, 10, NULL, '0');
INSERT INTO `users` VALUES (2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 8, 437747, 'admin@localhost', 1, 1, '2005-06-03 11:17:37', '2006-12-13 15:25:15', 1409937172, 0, 0, '', 'db5830162cd732c59efba163abc76507', 0, 10, 10, 10, '127.0.0.1', '0');

-- --------------------------------------------------------

--
-- Struttura della tabella `users_level`
--

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
  `predef_level` enum('guest','validating','member','uploader','vip','moderator','admin','owner') NOT NULL default 'guest',
  `can_be_deleted` enum('yes','no') NOT NULL default 'yes',
  `admin_access` enum('yes','no') NOT NULL default 'no',
  `prefixcolor` varchar(40) NOT NULL default '',
  `suffixcolor` varchar(40) NOT NULL default '',
  `WT` int(11) NOT NULL default '0',
  UNIQUE KEY `base` (`id`),
  KEY `id_level` (`id_level`)
) TYPE=MyISAM ;

--
-- Dump dei dati per la tabella `users_level`
--

INSERT INTO `users_level` VALUES (1, 1, 'guest', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'guest', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (2, 2, 'validating', 'yes', 'no', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'no', 'no', 'yes', 'no', 'no', 'validating', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (3, 3, 'Members', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'no', 'no', 'member', 'no', 'no', '<span style=\\''color:#000000\\''>', '</span>', 0);
INSERT INTO `users_level` VALUES (4, 4, 'Uploader', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'yes', 'no', 'no', 'uploader', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (5, 5, 'V.I.P.', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'yes', 'no', 'no', 'vip', 'no', 'no', '', '', 0);
INSERT INTO `users_level` VALUES (6, 6, 'Moderator', 'yes', 'yes', 'no', 'yes', 'no', 'no', 'yes', 'yes', 'no', 'yes', 'yes', 'yes', 'yes', 'no', 'moderator', 'no', 'no', '<span style=\\''color: #428D67\\''>', '</span>', 0);
INSERT INTO `users_level` VALUES (7, 7, 'Administrator', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'admin', 'no', 'no', '<span style=\\''color:#FF8000\\''>', '</span>', 0);
INSERT INTO `users_level` VALUES (8, 8, 'Owner', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'owner', 'no', 'yes', '', '', 0);

