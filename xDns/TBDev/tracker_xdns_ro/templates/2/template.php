<?php

/*
**Template Mod By AronTh for TBDEV.NET source code 2009, theme made by AronTh
**Special Thanks to CoLdFuSiOn for providing the source code and KiD for the motivation to me(AronTh) to make themes for TbDev.net
*/

function stdhead($title = "", $msgalert = true) {
    global $CURUSER, $TBDEV, $lang;

    if (!$TBDEV['site_online'])
      die("Site is down for maintenance, please check back again later... thanks<br />");

    //header("Content-Type: text/html; charset=iso-8859-1");
    //header("Pragma: No-cache");
    if ($title == "")
        $title = $TBDEV['site_name'] .(isset($_GET['tbv'])?" (".TBVERSION.")":'');
    else
        $title = $TBDEV['site_name'].(isset($_GET['tbv'])?" (".TBVERSION.")":''). " :: " . htmlspecialchars($title);
  
    if ($TBDEV['msg_alert'] && $msgalert && $CURUSER)
    {
      $res = mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " && unread='yes'") or sqlerr(__FILE__,__LINE__);
      $arr = mysql_fetch_row($res);
      $unread = $arr[0];
    }

    $htmlout = "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\"
		\"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
		
		<html xmlns='http://www.w3.org/1999/xhtml'>
		<head>

			<meta name='generator' content='TBDev.net' />
			<meta http-equiv='Content-Language' content='en-us' />
			<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
			<meta name='MSSmartTagsPreventParsing' content='TRUE' />
			
			<title>{$title}</title>
			<link rel='stylesheet' href='templates/2/2.css' type='text/css' />
		</head>
    
    <body>

      <table width='100%' cellspacing='0' cellpadding='0' style='background: transparent'>
      <tr>

      <td class='clear'>
      <div id='logostrip'>
      <img src='{$TBDEV['pic_base_url']}logo.jpg' alt='' />

      <a href='donate.php'><img src='{$TBDEV['pic_base_url']}x-click-but04.gif' border='0' alt='{$lang['gl_donate']}' title='{$lang['gl_donate']}' style='margin-top: 5px' /></a>
      </div>
      </td>

      </tr></table>

      <table class='mainouter' width='100%' border='1' cellspacing='0' cellpadding='10'>
<!-- STATUSBAR -->";

    $htmlout .= StatusBar();

    $htmlout .= "<!-- MENU -->
      <tr><td class='outer'>
      <div id='submenu'>";

    if ($CURUSER) 
    { 
      $htmlout .= "<div class='tb-top-left-link'>
      <a href='index.php'>{$lang['gl_home']}</a>
      <a href='browse.php'>{$lang['gl_browse']}</a>
      <a href='search.php'>{$lang['gl_search']}</a>
      <a href='upload.php'>{$lang['gl_upload']}</a>
      <a href='chat.php'>{$lang['gl_chat']}</a>
      <a href='forums.php'>{$lang['gl_forums']}</a>
      <!--<a href='misc/dox.php'>DOX</a>-->
      <a href='topten.php'>{$lang['gl_top_10']}</a>
      <a href='rules.php'>{$lang['gl_rules']}</a>
      <a href='faq.php'>{$lang['gl_faq']}</a>
      <a href='links.php'>{$lang['gl_links']}</a>
      <a href='staff.php'>{$lang['gl_staff']}</a>
      </div>
      <div class='tb-top-right-link'>";

      if( $CURUSER['class'] >= UC_MODERATOR )
      {
        $htmlout .= "<a href='admin.php'>{$lang['gl_admin']}</a>";
      }

    $htmlout .= "<a href='my.php'>{$lang['gl_profile']}</a>
      <a href='logout.php'>{$lang['gl_logout']}</a>
      </div>";
    } 
    else
    {
      $htmlout .= "<div class='tb-top-left-link'>
      <a href='login.php'>{$lang['gl_login']}</a>
      <a href='signup.php'>{$lang['gl_signup']}</a>
      <a href='recover.php'>{$lang['gl_recover']}</a>
      </div>";
    }

    $htmlout .= "</div>
    </td>
    </tr>
    <tr><td align='center' class='outer' style='padding-top: 20px; padding-bottom: 20px'>";


    if ($TBDEV['msg_alert'] && isset($unread) && !empty($unread))
    {
      $htmlout .= "<p><table border='0' cellspacing='0' cellpadding='10' bgcolor='red'>
                  <tr><td style='padding: 10px; background: red'>\n
                  <b><a href='messages.php'><font color='white'>".sprintf($lang['gl_msg_alert'], $unread) . ($unread > 1 ? "s" : "") . "!</font></a></b>
                  </td></tr></table></p>\n";
    }

    return $htmlout;
    
} // stdhead

function stdfoot() {
  global $TBDEV;
  
    return "<p align='center'>
    <a rel='license' href='http://creativecommons.org/licenses/by-nc-nd/2.0/uk/'><img alt='Creative Commons License' style='border-width:0' src='http://i.creativecommons.org/l/by-nc-nd/2.0/uk/88x31.png' /></a><br />
    <a href='http://www.tbdev.net'><img src='{$TBDEV['pic_base_url']}tbdev_btn_red.png' border='0' alt='Powered By TBDev &copy;2009' title='Powered By TBDev &copy;2009' /></a></p>
<script type=\"text/javascript\">
var gaJsHost = ((\"https:\" == document.location.protocol) ? \"https://ssl.\" : \"http://www.\");
document.write(unescape(\"%3Cscript src='\" + gaJsHost + \"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E\"));
</script>
<script type=\"text/javascript\">
try {
var pageTracker = _gat._getTracker(\"UA-13256113-1\");
pageTracker._trackPageview();
} catch(err) {}</script>\n
<!-- Piwik -->
<script type=\"text/javascript\">
var pkBaseURL = ((\"https:\" == document.location.protocol) ? \"https://stats.xdns.ro/\" : \"http://stats.xdns.ro/\");
document.write(unescape(\"%3Cscript src='\" + pkBaseURL + \"piwik.js' type='text/javascript'%3E%3C/script%3E\"));
</script><script type=\"text/javascript\">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + \"piwik.php\", 4);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src=\"http://stats.xdns.ro/piwik.php?idsite=4\" style=\"border:0\" alt=\"\"/></p></noscript>
<!-- End Piwik Tag -->\n
    </td></tr></table>\n
    </body></html>\n";
}

function stdmsg($heading, $text)
{
    $htmlout = "<table class='main' width='750' border='0' cellpadding='0' cellspacing='0'>
    <tr><td class='embedded'>\n";
    
    if ($heading)
      $htmlout .= "<h2>$heading</h2>\n";
    
    $htmlout .= "<table width='100%' border='1' cellspacing='0' cellpadding='10'><tr><td class='text'>\n";
    $htmlout .= "{$text}</td></tr></table></td></tr></table>\n";
  
    return $htmlout;
}

function StatusBar() {

	global $CURUSER, $TBDEV, $lang;
	
	if (!$CURUSER)
		return "<tr><td colspan='2'>Yeah Yeah!</td></tr>";


	$upped = mksize($CURUSER['uploaded']);
	
	$downed = mksize($CURUSER['downloaded']);
	
	$ratio = $CURUSER['downloaded'] > 0 ? $CURUSER['uploaded']/$CURUSER['downloaded'] : 0;
	
	$ratio = number_format($ratio, 2);

	$IsDonor = '';
	if ($CURUSER['donor'] == "yes")
	
	$IsDonor = "<img src='pic/star.gif' alt='donor' title='donor' />";


	$warn = '';
	if ($CURUSER['warned'] == "yes")
	
	$warn = "<img src='pic/warned.gif' alt='warned' title='warned' />";
	
	$res1 = @mysql_query("SELECT COUNT(*) FROM messages WHERE receiver=" . $CURUSER["id"] . " AND unread='yes'") or sqlerr(__LINE__,__FILE__);
	
	$arr1 = mysql_fetch_row($res1);
	
	$unread = $arr1[0];
	
	$inbox = ($unread == 1 ? "$unread&nbsp;{$lang['gl_msg_singular']}" : "$unread&nbsp;{$lang['gl_msg_plural']}");

	
	$res2 = @mysql_query("SELECT seeder, COUNT(*) AS pCount FROM peers WHERE userid=".$CURUSER['id']." GROUP BY seeder") or sqlerr(__LINE__,__FILE__);
	
	$seedleech = array('yes' => '0', 'no' => '0');
	
	while( $row = mysql_fetch_assoc($res2) ) {
		if($row['seeder'] == 'yes')
			$seedleech['yes'] = $row['pCount'];
		else
			$seedleech['no'] = $row['pCount'];
		
	}
	
/////////////// REP SYSTEM /////////////
//$CURUSER['reputation'] = 49;

	$member_reputation = get_reputation($CURUSER, 1);
////////////// REP SYSTEM END //////////

	$StatusBar = '';
		$StatusBar = "<tr>".

		"<td colspan='2' style='padding: 2px;'>".

		"<div id='statusbar'>".
		"<div style='float:left;color:black;'>{$lang['gl_msg_welcome']}, <a href='userdetails.php?id={$CURUSER['id']}'>{$CURUSER['username']}</a>".
		  
		"$IsDonor$warn&nbsp; [<a href='logout.php'>{$lang['gl_logout']}</a>]&nbsp;$member_reputation
		<br />{$lang['gl_ratio']}:$ratio".
		"&nbsp;&nbsp;{$lang['gl_uploaded']}:$upped".
		"&nbsp;&nbsp;{$lang['gl_downloaded']}:$downed".
		
		"&nbsp;&nbsp;{$lang['gl_act_torrents']}:&nbsp;<img alt='{$lang['gl_seed_torrents']}' title='{$lang['gl_seed_torrents']}' src='pic/arrowup.gif' />&nbsp;{$seedleech['yes']}".
		
		"&nbsp;&nbsp;<img alt='{$lang['gl_leech_torrents']}' title='{$lang['gl_leech_torrents']}' src='pic/arrowdown.gif' />&nbsp;{$seedleech['no']}</div>".
    
		"<div><p style='text-align:right;'>".date(DATE_RFC822)."<br />".

    "<a href='messages.php'>$inbox</a></p></div>".
    "</div></td></tr>";
	
	return $StatusBar;

}

?>
