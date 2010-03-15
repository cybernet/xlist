<?php
/*
+------------------------------------------------
| TBDev.net BitTorrent Tracker PHP
| =============================================
| by CoLdFuSiOn
| (c) 2003 - 2009 TBDev.Net
| http://www.tbdev.net
| =============================================
| svn: http://sourceforge.net/projects/tbdevnet/
| Licence Info: GPL
+------------------------------------------------
| $Date$
| $Revision$
| $Author$
| $URL$
+------------------------------------------------
| Kidvision style
*/
ob_start("ob_gzhandler");

require_once "include/bittorrent.php";
require_once "include/user_functions.php";
get_template();

dbconn(true);

loggedinorreturn();

	$lang = array_merge( load_language('global'), load_language('index') );
	//$lang = ;
	
	$HTMLOUT = '';

$a = @mysql_fetch_assoc(@mysql_query("SELECT id,username FROM users WHERE status='confirmed' ORDER BY id DESC LIMIT 1")) or die(mysql_error());
if ($CURUSER)
 $latestuser = "<a href='userdetails.php?id=" . $a["id"] . "'>" . $a["username"] . "</a>";
else
 $latestuser = $a['username'];

	//==Stats Begin
    $cache_stats = "./cache/stats.txt";
    $cache_stats_life = 5 * 60; // 5min
    if (file_exists($cache_stats) && is_array(unserialize(file_get_contents($cache_stats))) && (time() - filemtime($cache_stats)) < $cache_stats_life)
    $row = unserialize(@file_get_contents($cache_stats));
    else {
    $stats = mysql_query("SELECT *, seeders + leechers AS peers, seeders / leechers AS ratio, unconnectables / (seeders + leechers) AS ratiounconn FROM stats WHERE id = '1' LIMIT 1") or sqlerr(__FILE__, __LINE__);
    $row = mysql_fetch_assoc($stats);
    $handle = fopen($cache_stats, "w+");
    fwrite($handle, serialize($row));
    fclose($handle);
    }

    $seeders = number_format($row['seeders']);
    $leechers = number_format($row['leechers']);
    $registered = number_format($row['regusers']);
    $unverified = number_format($row['unconusers']);
    $torrents = number_format($row['torrents']);
    $torrentstoday = number_format($row['torrentstoday']);
    $ratiounconn = $row['ratiounconn'];
    $unconnectables = $row['unconnectables'];
    $ratio = round(($row['ratio'] * 100));
    $peers = number_format($row['peers']);
    $numactive = number_format($row['numactive']);
    $donors = number_format($row['donors']);
    $forumposts = number_format($row['forumposts']);
    $forumtopics = number_format($row['forumtopics']);
    //==End


	//stdhead();

	$adminbutton = '';
	
	if (get_user_class() >= UC_ADMINISTRATOR)
 	$adminbutton = "&nbsp;&nbsp;<span style='color:#fff; font-size:10px;'><a href='admin.php?action=news'>[Add]</a></span>\n";
 	
	$HTMLOUT .= "<div class='roundedCorners' style='text-align:left;width:80%;border:1px solid black;padding:5px;'>
	<div style='background:transparent;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['news_title']}{$adminbutton}</span></div><br />
";
 	
	$res = mysql_query("SELECT * FROM news WHERE added + ( 3600 *24 *45 ) >
					".time()." ORDER BY added DESC LIMIT 10") or sqlerr(__FILE__, __LINE__);
					
	if (mysql_num_rows($res) > 0)
	{
 	require_once "include/bbcode_functions.php";

 	$button = "";
 	
 	while($array = mysql_fetch_assoc($res))
 	{
 	if (get_user_class() >= UC_ADMINISTRATOR)
 	{
 	$button = "<span style='color:#fff; font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='admin.php?action=news&amp;mode=edit&amp;newsid={$array['id']}'>[{$lang['news_edit']}]</a>&nbsp;&nbsp;<a href='admin.php?action=news&amp;mode=delete&amp;newsid={$array['id']}'>[{$lang['news_delete']}]</a></span>\n";
 	}
 	
		$HTMLOUT .= "<div id='headlineindex'>{$array['headline']}{$button}</div>
	 	<div id='newshold'>".format_comment($array['body'])."</div>

";
 	
 	}
 	
	}

	$HTMLOUT .= "</div>
\n";

// if (get_user_class() >= UC_POWER_USER) {
/* 	
// 09 poster mod - UNCOMMENT IF YOU HAVE THIS
 $query = "SELECT id, name, poster FROM torrents WHERE poster <> '' ORDER BY added DESC limit 15";
	$result = mysql_query( $query );
	$num = mysql_num_rows( $result );
	// count rows
	$HTMLOUT .="<script type='text/javascript' src='{$TBDEV['baseurl']}/scripts/scroll.js'></script>";
	$HTMLOUT .= "<div><div id='headindex'>{$lang['index_latest']}</div>
";
	$HTMLOUT .="<div style=\"overflow:hidden\">
	<div id=\"marqueecontainer\" onmouseover=\"copyspeed=pausespeed\" onmouseout=\"copyspeed=marqueespeed\"> 
	<span id=\"vmarquee\" style=\"position: absolute; width: 100%;\"><span style=\"white-space: nowrap;\">";
	$i = 20;
	while ( $row = mysql_fetch_assoc( $result ) ) {
 	$id = (int) $row['id'];
 	$name = htmlspecialchars( $row['name'] );
 	$poster = htmlspecialchars( $row['poster'] );
 	$name = str_replace( '_', ' ' , $name );
 	$name = str_replace( '.', ' ' , $name );
 	$name = substr( $name, 0, 50 );
 	if ( $i == 0 )
 	$HTMLOUT .= "</span></span><span id=\"vmarquee2\" style=\"position: absolute; width: 98%;\"></span></div></div><div style=\"overflow:hidden\">
 	<div id=\"marqueecontainer\" onmouseover=\"copyspeed=pausespeed\" onmouseout=\"copyspeed=marqueespeed\"> <span id=\"vmarquee\" style=\"position: absolute; width: 98%;\"><span style=\"white-space: nowrap;\">";
 	$HTMLOUT .= "<a href='{$TBDEV['baseurl']}/details.php?id=$id'><img src='" . htmlspecialchars( $poster ) . "' alt='$name' title='$name' width='100' height='120' border='0' /></a>";
 	$i++;
	}
	$HTMLOUT .= "</span></span><span id=\"vmarquee2\" style=\"position: absolute; width: 98%;\"></span></div></div></div>
\n";
	//== end 09 poster mod
*/
 // === TbDev 09 Shoutbox USE SHOUT UNCOMMENT THIS
/* if ($CURUSER['show_shout'] === "yes") {
 $commandbutton = '';
 $refreshbutton = '';
 $smilebutton = '';
 if ($CURUSER['class'] >= UC_ADMINISTRATOR){
 $commandbutton = "<a href=\"javascript:popUp('shoutbox_commands.php')\">{$lang['index_shoutbox_commands']}</a>\n";}
 $refreshbutton = "<a href='shoutbox.php' target='sbox'>{$lang['index_shoutbox_refresh']}</a>\n";
 $smilebutton = "<a href=\"javascript:PopMoreSmiles('shbox','shbox_text')\">{$lang['index_shoutbox_smilies']}</a>\n";
 $HTMLOUT .= "<form action='shoutbox.php' method='get' target='sbox' name='shbox' onsubmit='mysubmit()' />
 <div><div id='headindex'>{$lang['index_shout']} <span style='color:#fff; font-size:10px;'>[<a href='shoutbox.php?show_shout=1&amp;show=no'>{$lang['index_shoutbox_close']}</a>]</span></div>

 
 <iframe src='shoutbox.php' width='950px' height='200px' frameborder='0' name='sbox' marginwidth='0' marginheight='0'></iframe>
 <br/>
 <br/>
 <div align='center'>
 <script type=\"text/javascript\" src=\"scripts/shout.js\"></script> 
 <input type='text' maxlength='180' name='shbox_text' size='100' />
 <input class='button' type='submit' value='{$lang['index_shoutbox_send']}' />
 <input type='hidden' name='sent' value='yes' />
 

 <a href=\"javascript:SmileIT(':-)','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/smile1.gif' alt='Smile' title='Smile' /></a> 
 <a href=\"javascript:SmileIT(':smile:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/smile2.gif' alt='Smiling' title='Smiling' /></a> 
 <a href=\"javascript:SmileIT(':-D','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/grin.gif' alt='Grin' title='Grin' /></a> 
 <a href=\"javascript:SmileIT(':lol:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/laugh.gif' alt='Laughing' title='Laughing' /></a> 
 <a href=\"javascript:SmileIT(':w00t:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/w00t.gif' alt='W00t' title='W00t' /></a> 
 <a href=\"javascript:SmileIT(':blum:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/blum.gif' alt='Rasp' title='Rasp' /></a> 
 <a href=\"javascript:SmileIT(';-)','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/wink.gif' alt='Wink' title='Wink' /></a> 
 <a href=\"javascript:SmileIT(':devil:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/devil.gif' alt='Devil' title='Devil' /></a> 
 <a href=\"javascript:SmileIT(':yawn:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/yawn.gif' alt='Yawn' title='Yawn' /></a> 
 <a href=\"javascript:SmileIT(':-/','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/confused.gif' alt='Confused' title='Confused' /></a> 
 <a href=\"javascript:SmileIT(':o)','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/clown.gif' alt='Clown' title='Clown' /></a> 
 <a href=\"javascript:SmileIT(':innocent:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/innocent.gif' alt='Innocent' title='innocent' /></a> 
 <a href=\"javascript:SmileIT(':whistle:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/whistle.gif' alt='Whistle' title='Whistle' /></a> 
 <a href=\"javascript:SmileIT(':unsure:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/unsure.gif' alt='Unsure' title='Unsure' /></a> 
 <a href=\"javascript:SmileIT(':blush:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/blush.gif' alt='Blush' title='Blush' /></a> 
 <a href=\"javascript:SmileIT(':hmm:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/hmm.gif' alt='Hmm' title='Hmm' /></a> 
 <a href=\"javascript:SmileIT(':hmmm:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/hmmm.gif' alt='Hmmm' title='Hmmm' /></a> 
 <a href=\"javascript:SmileIT(':huh:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/huh.gif' alt='Huh' title='Huh' /></a> 
 <a href=\"javascript:SmileIT(':look:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/look.gif' alt='Look' title='Look' /></a> 
 <a href=\"javascript:SmileIT(':rolleyes:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/rolleyes.gif' alt='Roll Eyes' title='Roll Eyes' /></a> 
 <a href=\"javascript:SmileIT(':kiss:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/kiss.gif' alt='Kiss' title='Kiss' /></a> 
 <a href=\"javascript:SmileIT(':blink:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/blink.gif' alt='Blink' title='Blink' /></a> 
 <a href=\"javascript:SmileIT(':baby:','shbox','shbox_text')\"><img border='0' src='{$TBDEV['baseurl']}/pic/smilies/baby.gif' alt='Baby' title='Baby' /></a><br/>
 </div>
 <div id='shoutbox'>{$refreshbutton} {$smilebutton} {$commandbutton}</div>
 
 
 </div>
 
\n";
 }
 if ($CURUSER['show_shout'] === "no") {
 $HTMLOUT .="<div id='headindex'>{$lang['index_shoutbox']} <span style='color:#fff; font-size:10px;'>[<a href='{$TBDEV['baseurl']}/shoutbox.php?show_shout=1&amp;show=yes'>{$lang['index_shoutbox_open']}</a>]</span></div></div>

";
 }
 //==end 09 shoutbox
*/

// latest torrents [see limit on config]
	$HTMLOUT .= "<div class='roundedCorners' style='text-align:left;width:80%;border:1px solid black;padding:5px;'>
	<div style='background:transparent;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['latesttorrents_title']}</span></div><br />";

$res = mysql_query("SELECT t.id, t.name, t.category, t.seeders, t.leechers, c.name AS cat_name, c.image AS cat_img ".
 "FROM torrents AS t ".
 "LEFT JOIN categories AS c ON c.id = t.category ".
 "WHERE t.visible='yes' ".
 "ORDER BY t.added DESC LIMIT {$TBDEV['latest_torrents_limit']}") or sqlerr(__FILE__, __LINE__);
if (mysql_num_rows($res) > 0)
{
$HTMLOUT .= "<table width='100%' cellspacing='0' cellpadding='5'><tr>
<td class='colhead' align='center' width='1%'>{$lang['latesttorrents_type']}</td>
<td class='colhead' align='center'>{$lang['latesttorrents_name']}</td>
<td class='colhead' align='center' width='1%'>{$lang['latesttorrents_seeders']}</td>
<td class='colhead' align='center' width='1%'>{$lang['latesttorrents_leechers']}</td></tr>";
while($arr = mysql_fetch_assoc($res))
{
$dispname = htmlspecialchars($arr['name']);
$catname = htmlspecialchars($arr['cat_name']);
$catpic = htmlspecialchars($arr['cat_img']);

$HTMLOUT .= "<tr><td align='center' style='padding:0px;'><a href='/browse.php?cat={$arr['category']}'><img border='0' src='{$TBDEV['pic_base_url']}caticons/{$catpic}' alt='{$catname}' /></a></td>
<td align='left'><a href='/details.php?id={$arr['id']}&amp;hit=1' title='{$dispname}'><b>{$dispname}</b></a></td>
<td align='center'>{$arr['seeders']}</td>
<td align='center'>{$arr['leechers']}</td></tr>";
}
$HTMLOUT .= "</table></div><br />\n";
} else {
// if there are no torrents
$HTMLOUT .= "<div style='text-align:center;border:1px solid blue;background:lightgrey;'><span style='font-weight:bold;font-size:10pt;'>{$lang['latesttorrents_no_torrents']}</span></div></div><br />";
}
// end latest torrents
/*
//  UN COMMENT TO USE ACTIVE USERS ON INDEX
	$file = "./cache/active.txt";
$expire = 30; // 30 seconds
if (file_exists($file) && filemtime($file) > (time() - $expire)) {
$active3 = unserialize(file_get_contents($file));
} else {
$dt = sqlesc(time() - 180);
$active1 = mysql_query("SELECT id, username, class, warned, donor FROM users WHERE last_access >= $dt ORDER BY class DESC") or sqlerr(__FILE__, __LINE__);
	while ($active2 = mysql_fetch_assoc($active1)) {
 	$active3[] = $active2;
	}
	$OUTPUT = serialize($active3);
	$fp = fopen($file, "w");
	fputs($fp, $OUTPUT);
	fclose($fp);
} // end else
$activeusers = "";
if (is_array($active3))
foreach ($active3 as $arr) {
	if ($activeusers) $activeusers .= ",\n";
	$activeusers .= "<span style=\"white-space: nowrap;\">"; 
	$arr["username"] = "<font color='#" . get_user_class_color($arr['class']) . "'> " . htmlspecialchars($arr['username']) . "</font>";
	$donator = $arr["donor"] === "yes";
	$warned = $arr["warned"] === "yes";

	if ($CURUSER)
 	$activeusers .= "<a href='userdetails.php?id={$arr["id"]}'><b>{$arr["username"]}</b></a>";
	else
 	$activeusers .= "<b>{$arr["username"]}</b>";
	if ($donator)
 	$activeusers .= "<img src='{$TBDEV['pic_base_url']}star.gif' alt='Donated' />";
	if ($warned)
 	$activeusers .= "<img src='{$TBDEV['pic_base_url']}warned.gif' alt='Warned' />";
	$activeusers .= "</span>";
}

if (!$activeusers)
	$activeusers = "{$lang['index_noactive']}";
	
	$HTMLOUT .= "<div><div id='headindex'>{$lang['index_active']}</div>
";
 $HTMLOUT .="<table id='activeindex'>
		<tr>
		<td id='activeindex'>{$activeusers}</td>";
 $HTMLOUT .="</tr></table></div>

";

 	$HTMLOUT .="<div id='activeindex2'><span style='color:#4080B0'>Sysop</span> | <span style='color:#B000B0'>Administrator</span> | <span style='color:#FE2E2E'>Moderator</span> | <span style='color:#256903'>Code-Team</span> | <span style='color:#04ab27'>Graphic-Team</span> | <span style='color:#0000FF'>Uploader</span> | <span style='color:#009F00'>VIP</span> | <span style='color:#f9a200'>Power User</span> | <span style='color:#8E35EF'>User</span> | <span style='color:#b1b1b1'>Warned <img src='/pic/warned.gif' /></span></div>";
*/
	$HTMLOUT .="<div class='roundedCorners' style='text-align:left;width:80%;border:1px solid black;padding:5px;'>
   <div style='background:transparent;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['index_stats_title']}</span></div><br />
   <table width='100%' border='1' cellspacing='0' cellpadding='10'><tr><td align='center'>
   <table class='main' border='1' cellspacing='0' cellpadding='5'>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_regged']}</td><td align='right'>{$registered}/{$TBDEV['maxusers']}</td>
	 <td class='rowhead'>{$lang['index_stats_online']}</td><td align='right'>{$numactive}</td>
   </tr>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_uncon']}</td><td align='right'>{$unverified}</td>
	 <td class='rowhead'>{$lang['index_stats_donor']}</td><td align='right'>{$donors}</td>
   </tr>
   <tr>
	 <td colspan='4'> </td>
   </tr>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_topics']}</td><td align='right'>{$forumtopics}</td>
	 <td class='rowhead'>{$lang['index_stats_torrents']}</td><td align='right'>{$torrents}</td>
   </tr>
   <tr>
   <td class='rowhead'>{$lang['index_stats_posts']}</td><td align='right'>{$forumposts}</td>
	 <td class='rowhead'>{$lang['index_stats_newtor']}</td><td align='right'>{$torrentstoday}</td>
   </tr>
   <tr>
   <td colspan='4'> </td>
   </tr>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_peers']}</td><td align='right'>{$peers}</td>
	 <td class='rowhead'>{$lang['index_stats_unconpeer']}</td><td align='right'>{$unconnectables}</td>
   </tr>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_seeders']}</td><td align='right'>{$seeders}</td>
	 <td class='rowhead' align='right'><b>{$lang['index_stats_unconratio']}</b></td><td align='right'><b>".round($ratiounconn * 100)."</b></td>
   </tr>
   <tr>
	 <td class='rowhead'>{$lang['index_stats_leechers']}</td><td align='right'>{$leechers}</td>
	 <td class='rowhead'>{$lang['index_stats_slratio']}</td><td align='right'>{$ratio}</td>
   </tr></table></td></tr></table></div><br />
<div><font class='small'>Welcome to our newest member, <b>$latestuser</b>!</font></div>


\n"; 

$HTMLOUT .= "<div><div id='headindex'>{$lang['index_dis']}</div>
";
$HTMLOUT .= "<div><div id='newshold'>{$lang['foot_disclaimer']}</div>
";

///////////////////////////// FINAL OUTPUT //////////////////////

	print stdhead('Home') . $HTMLOUT . stdfoot();
// }
?>