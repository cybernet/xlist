<?php
/*
+------------------------------------------------
|   TBDev.net BitTorrent Tracker PHP
|   =============================================
|   by CoLdFuSiOn
|   (c) 2003 - 2009 TBDev.Net
|   http://www.tbdev.net
|   =============================================
|   svn: http://sourceforge.net/projects/tbdevnet/
|   Licence Info: GPL
+------------------------------------------------
|   $Date$
|   $Revision$
|   $Author$
|   $URL$
+------------------------------------------------
*/
ob_start("ob_gzhandler");

require_once "include/bittorrent.php";
require_once "include/user_functions.php";

dbconn(true);

loggedinorreturn();

    $lang = array_merge( load_language('global'), load_language('index') );
    //$lang = ;
    
    $HTMLOUT = '';
/*
$a = @mysql_fetch_assoc(@mysql_query("SELECT id,username FROM users WHERE status='confirmed' ORDER BY id DESC LIMIT 1")) or die(mysql_error());
if ($CURUSER)
  $latestuser = "<a href='userdetails.php?id=" . $a["id"] . "'>" . $a["username"] . "</a>";
else
  $latestuser = $a['username'];
*/

    $registered = number_format(get_row_count("users"));
    //$unverified = number_format(get_row_count("users", "WHERE status='pending'"));
    $torrents = number_format(get_row_count("torrents"));
    //$dead = number_format(get_row_count("torrents", "WHERE visible='no'"));

    $r = mysql_query("SELECT value_u FROM avps WHERE arg='seeders'") or sqlerr(__FILE__, __LINE__);
    $a = mysql_fetch_row($r);
    $seeders = 0 + $a[0];
    $r = mysql_query("SELECT value_u FROM avps WHERE arg='leechers'") or sqlerr(__FILE__, __LINE__);
    $a = mysql_fetch_row($r);
    $leechers = 0 + $a[0];
    if ($leechers == 0)
      $ratio = 0;
    else
      $ratio = round($seeders / $leechers * 100);
    $peers = number_format($seeders + $leechers);
    $seeders = number_format($seeders);
    $leechers = number_format($leechers);


    //stdhead();
    //$HTMLOUT .= "<div class='roundedCorners'><font class='small''>Welcome to our newest member, <b>$latestuser</b>!</font></div>\n";

    $adminbutton = '';
    
    if (get_user_class() >= UC_ADMINISTRATOR)
          $adminbutton = "&nbsp;<span style='float:right;'><a href='admin.php?action=news'>News page</a></span>\n";
          
    $HTMLOUT .= "<div style='text-align:left;width:80%;border:1px solid pink;padding:5px;'>
    <div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['news_title']}</span>{$adminbutton}</div><br />";
      
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
          $button = "<div style='float:right;'><a href='admin.php?action=news&amp;mode=edit&amp;newsid={$array['id']}'>{$lang['news_edit']}</a>&nbsp;<a href='admin.php?action=news&amp;mode=delete&amp;newsid={$array['id']}'>{$lang['news_delete']}</a></div>";
        }
        
        $HTMLOUT .= "<div style='background:lightgrey;height:20px;'><span style='font-weight:bold;font-size:10pt;'>{$array['headline']}</span></div>\n";
        
        $HTMLOUT .= "<span style='color:grey;font-weight:bold;text-decoration:underline;'>".get_date( $array['added'],'DATE') . "</span>{$button}\n";
        
        $HTMLOUT .= "<div style='margin-top:10px;padding:5px;'>".format_comment($array['body'])."</div><hr />\n";
        
      
      }
     
    }

    $HTMLOUT .= "</div><br />\n";

// === TbDev 09 Shoutbox 
   if ($CURUSER['show_shout'] === "yes") {
   $commandbutton = '';
   $refreshbutton = '';
   $smilebutton = '';
   if ($CURUSER['class'] >= UC_ADMINISTRATOR){
   $commandbutton = "<span style='float:right;'><a href=\"javascript:popUp('shoutbox_commands.php')\">{$lang['index_shoutbox_commands']}</a></span>\n";}
   $refreshbutton = "<span style='float:right;'><a href='shoutbox.php' target='sbox'>{$lang['index_shoutbox_refresh']}</a></span>\n";
   $smilebutton = "<span style='float:right;'><a href=\"javascript:PopMoreSmiles('shbox','shbox_text')\">{$lang['index_shoutbox_smilies']}</a></span>\n";
   $HTMLOUT .= "<form action='shoutbox.php' method='get' target='sbox' name='shbox' onsubmit='mysubmit()' />
   <div style='text-align:left;width:80%;border:1px solid blue;padding:5px;'><div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['index_shout']}</span></div><br />
   <b>{$lang['index_shoutbox']}</b> [ <a href='shoutbox.php?show_shout=1&show=no'><b>{$lang['index_shoutbox_close']}</b></a> ]
   <iframe src='shoutbox.php' width='100%' height='200' frameborder='0' name='sbox' marginwidth='0' marginheight='0'></iframe>
   <br/>
   <br/>
   <div align='center'>
   <b>{$lang['index_shoutbox_shout']}</b>
   <script type=\"text/javascript\" src=\"scripts/shout.js\"></script> 
   <input type='text' maxlength='180' name='shbox_text' size='100' />
   <input class='button' type='submit' value='{$lang['index_shoutbox_send']}' />
   <input type='hidden' name='sent' value='yes' />
   <br />
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
	 <div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:8pt;'>{$refreshbutton}</span></div>
   <div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:8pt;'>{$smilebutton}</span></div>
   <div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:8pt;'>{$commandbutton}</span></div>
   </div>
   <br /> 
	 </div>
   <br />\n";
   }
   if ($CURUSER['show_shout'] === "no") {
   $HTMLOUT .="<div style='text-align:left;width:80%;border:1px solid blue;padding:5px;'><div style='background:lightgrey;height:25px;'><b>{$lang['index_shoutbox']} </b>[ <a href='{$TBDEV['baseurl']}/shoutbox.php?show_shout=1&show=yes'><b>{$lang['index_shoutbox_open']} ]</b></a></div></div><br />";
   }
   //==end 09 shoutbox

    $HTMLOUT .= "<div style='text-align:left;width:80%;border:1px solid pink;padding:5px;'>
    <div style='background:lightgrey;height:25px;'><span style='font-weight:bold;font-size:12pt;'>{$lang['stats_title']}</span></div><br />
    
      <table align='center' class='main' border='1' cellspacing='0' cellpadding='5'>
      <tr>
      <td class='rowhead'>{$lang['stats_regusers']}</td><td align='right'>{$registered}</td>
      </tr>
      <!-- <tr><td class='rowhead'>{$lang['stats_unverified']}</td><td align=right>{unverified}</td></tr> -->
      <tr>
      <td class='rowhead'>{$lang['stats_torrents']}</td><td align='right'>{$torrents}</td>
      </tr>";
      
    if (isset($peers)) 
    { 
      $HTMLOUT .= "<tr><td class='rowhead'>{$lang['stats_peers']}</td><td align='right'>{$peers}</td></tr>
      <tr><td class='rowhead'>{$lang['stats_seed']}</td><td align='right'>{$seeders}</td></tr>
      <tr><td class='rowhead'>{$lang['stats_leech']}</td><td align='right'>{$leechers}</td></tr>
      <tr><td class='rowhead'>{$lang['stats_sl_ratio']}</td><td align='right'>{$ratio}</td></tr>";
    } 
    
      $HTMLOUT .= "</table>
      </div>";

/*
<h2>Server load</h2>
<table width='100%' border='1' cellspacing='0' cellpadding='1'0><tr><td align=center>
<table class=main border='0' width=402><tr><td style='padding: 0px; background-image: url("<?php echo $TBDEV['pic_base_url']?>loadbarbg.gif"); background-repeat: repeat-x'>
<?php $percent = min(100, round(exec('ps ax | grep -c apache') / 256 * 100));
if ($percent <= 70) $pic = "loadbargreen.gif";
elseif ($percent <= 90) $pic = "loadbaryellow.gif";
else $pic = "loadbarred.gif";
$width = $percent * 4;
print("<img height='1'5 width=$width src=\"{$TBDEV['pic_base_url']}{$pic}\" alt='$percent%'>"); ?>
</td></tr></table>
</td></tr></table>
*/

    $HTMLOUT .= sprintf("<p><font class='small'>{$lang['foot_disclaimer']}</font></p>", $TBDEV['site_name']);
    
    $HTMLOUT .= "";

///////////////////////////// FINAL OUTPUT //////////////////////

    print stdhead('Home') . $HTMLOUT . stdfoot();
?>
