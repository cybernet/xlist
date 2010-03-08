<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/

require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/paypal.php");


dbconn(true);
// Additional admin check by miskotes
// Fixed for PB Edition by FatePower and Thanx to GEWA for the help
$query=mysql_query("SELECT id_level FROM users_level WHERE mod_access='yes'");
$where="WHERE (";
while($level=mysql_fetch_array($query)) {
$where.="id_level=".$level["id_level"]." OR ";
}
$where=substr($where,0,strlen($where)-4).") ";
$aid = 0 + $_GET["user"];
$ranid=mysql_fetch_array(mysql_query("SELECT id, random FROM users $where AND id=".$aid));
$arandom 	= 	$_GET["code"];

if (!$aid || empty($aid) || $aid==0 || !$arandom || empty($arandom) || $arandom==0)
{
       standardheader('Access Denied');
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);  
	   stdfoot();
       exit;
}

if ($arandom!=$ranid["random"] || $aid!=$ranid["id"])
{
       standardheader('Access Denied');
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
	   stdfoot();
       exit;
}
// EOF

standardheader('Administrator Control Panel');

if (!$CURUSER || $CURUSER["mod_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
else
    {
    define("IN_ACP",true);
    //
    // Read a listing of uploaded category images for use in the edit menu link code...
    //
    $dir = @opendir('images/categories/');

    while($file = @readdir($dir))
    {
      if( !@is_dir('images/categories/' . $file) )
      {
        $img_size = @getimagesize('images/categories/' . $file);

        if( $img_size[0] && $img_size[1] )
        {
          $images[] = $file;
        }
      }
    }
    @closedir($dir);

    ?>

    <script language="javascript" type="text/javascript">
    <!--
    function update_cat(newimage)
    {
      if (newimage!="")
         document.cat_image.src = "images/categories/" + newimage;
      else
         document.cat_image.src = "";
    }
    //-->
    </script>

    <?php
    if (isset($_GET["do"])) $do=$_GET["do"];
      else $do = "";
    if (isset($_GET["action"]))
       $action=$_GET["action"];
//New ACP Code Bellow
//Fixed for 1.4.X, PB Edition By FatePower and GeWa.
block_begin(ADMIN_CPANEL);
//Owner
if ($CURUSER["owner_access"]=="yes"){
print("\n<table align=center width=100%><tr><td class=header align=center colspan=2 >Owner menu</td></tr>");
print("\n<tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=config&action=read>".ACP_TRACKER_SETTINGS."</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=read>".ACP_CATEGORIES."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=read>".ACP_USER_GROUP."</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=language&action=read>".ACP_LANGUAGES."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=read>".ACP_STYLES."</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=blocks&action=read>".ACP_BLOCKS."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil>Mysql Database<br />Stats/Utils</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=pruneu>Prune Users</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=logdel\">Delete Sitelog</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read>".ACP_FORUM."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"ratio.php\">Ratio Editor</a></td>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read\">".MNU_DONATE."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"backup-database.php\">Backup BD</a></td>");
print("\n<td class=button align=center width=50%><a href=\"adduser.php\">ADD User</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=getphp\">Edit PHP File</a></td>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lottery\">".LOT_SETTINGS."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"pd-block_cheapmail.php\">".BAN_CHEAPMAIL."</a></td>");
print("\n<td class=button align=center width=50%><a href=\"unconfirmed.php\">".UNCONFIRMED_ACCOUNTS."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"addstats.php\">Add/Remove Stats</a></td>");
print("\n<td class=button align=center width=50%>Empty</td>");
print("\n</tr></table>");
}

//Admin
if ($CURUSER["admin_access"]=="yes"){
print("\n<table align=center width=100%><tr><td class=header align=center colspan=2>Admin menu</td></tr>");
print("\n<tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banip&action=read>".ACP_BAN_IP."</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=prunet>Prune Torrents</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=logview>View Sitelog</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=masspm&action=write>Mass PM</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=warnedu\">".ACP_WARNEDU."</a></td>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=prevwarnedu\">".ACP_PREVWARNEDU."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=disabledu\">".ACP_DISABLEDU."</a></td>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=emailtousers\">Email to Users</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=read\">".ACP_BAN_MAILS."</a></td>");
print("\n<td class=button align=center width=50%><a href=\"duplicate.php\">Duplicate Ips</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"hittest.php\">H&R Stats</a></td>");
print("\n<td class=button align=center width=50%><a href=\"cheat.php\">Possible Cheats</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"msgspy.php\">Messages Spy</a></td>");
print("\n<td class=button align=center width=50%><a href=\"freeleechcontrol.php?&do=read\">FreeLeech Control</a></td>");
print("\n</tr></table>");
}

//Mod
if ($CURUSER["mod_access"]=="yes"){
print("\n<table align=center width=100%><tr><td class=header align=center colspan=2>Mod menu</td></tr>");
print("\n<tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read>".ACP_POLLS."</a></td>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=badwords&action=read>".ACP_CENSURED."</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=searchdiff>Search Diff.</a></td>");
print("\n<td class=button align=center width=50%><a href=\"traceroute.php\">Traceroute</a></td>");
print("\n</tr><tr>");
print("\n<td class=button align=center width=50%><a href=\"searchusers2.php\">Search Users</a></td>");
print("\n<td class=button align=center width=50%>Empty</td>");
print("\n</tr></table>");
}

      if  ($do=="prunet")
         {
             include("include/prune_torrents.php");
         }
    elseif  ($do=="getphp")
         {
             include("getphp.php");
         } 
	elseif  ($do=="pruneu")
         {
             include("include/prune_users.php");
         }
     elseif  ($do=="masspm")
        {
            include("include/masspm.php");
        }
     elseif ($do=="logview")
        {
            include("include/sitelog.php");
        }
     elseif ($do=="logdel")
        {
		$sqlab = "DELETE FROM `logs`"; $res = mysql_query($sqlab) or die(mysql_error());
		block_begin("Delete Sitelog");
		print("\n<table class=\"lista\" width=\"100%\" align=\"center\"><tr>");
		print("\n<td class=\"header\" align=\"center\"><b>Sitelog deleted...</b></td>");
		print("\n</tr></table>\n");
		block_end();
		print("<br />");
        }
//User Warning System Hack Start
     elseif  ($do=="warnedu")
         {
             include("warnedusers.php");
         }
     elseif  ($do=="prevwarnedu")
         {
             include("prev_warnedusers.php");
         }
     elseif  ($do=="disabledu")
         {
             include("disabledusers.php");
         }
//User Warning System Hack Stop
     elseif ($do=="searchdiff")
        {
            include("include/searchdiff.php");
        }
     elseif  ($do=="lottery")
         {
             include("lottery.php");
         }
	 elseif ($do=="emailtousers")
        {
            include("include/emailtousers.php");
        }   
     elseif ($do=="config" && $action=="read")
        {
            block_begin(TRACKER_SETTINGS);
            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=config&action=write" name="config" method="post">
            <table class="lista" width="100%" align="center">
            <tr><td class="header" align="center" colspan=2><?php echo DB_SETTINGS; ?> (<span style="color:red"><?php echo DONT_NEED_CHANGE; ?></span>)</td></tr>
            <tr><td class="header">Host address (usually localhost):</td><td class="lista"><input type="text" name="dbhost" value="<?php echo $dbhost;?>" size="40" /></td></tr>
            <tr><td class="header">Database Name :</td><td class="lista"><input type="text" name="dbname" value="<?php echo $database;?>" size="40" /></td></tr>
            <tr><td class="header">Database User :</td><td class="lista"><input type="text" name="dbuser" value="<?php echo $dbuser;?>" size="40" /></td></tr>
            <tr><td class="header">Database Password :</td><td class="lista"><input type="password" name="dbpwd" value="<?php echo $dbpass;?>" size="40" /></td></tr>
            <tr><td class="header" align="center" colspan=2>Tracker's general settings</td></tr>
            <tr><td class="header">Tracker's Name:</td><td class="lista"><input type="text" name="trackername" value="<?php echo $SITENAME;?>" size="40" /></td></tr>
            <tr><td class="header">Base Tracker's URL (without last /):</td><td class="lista"><input type="text" name="trackerurl" value="<?php echo $BASEURL;?>" size="40" /></td></tr>
			<tr><td class="header">Torrents download URL Name (without http:// and last /):</td><td class="lista"><input type="text" name="torrenturlname" value="<?php echo $TORRENT_URL_NAME;?>" size="40" /></td></tr>
			<tr><td class="header">Cut Torrent name's after X numbs of chars (Recommended to choose between 20 or 50 Char):</td><td class="lista"><input type="text" name="cutname" value="<?php echo $CUTNAME;?>" size="10" /></td></tr>
            <tr><td class="header">Tracker's Announce URLS (one url per row):</td><td class="lista"><textarea name="tracker_announceurl" rows="5" cols="40"><?php echo implode($TRACKER_ANNOUNCEURLS,"\n");?></textarea></td></tr>
            <tr><td class="header">Tracker's email:</td><td class="lista"><input type="text" name="trackeremail" value="<?php echo $SITEEMAIL;?>" size="40" /></td></tr>
            <tr><td class="header">Torrent's DIR:</td><td class="lista"><input type="text" name="torrentdir" value="<?php echo $TORRENTSDIR;?>" size="40" /></td></tr>
            <tr><td class="header">Allow External:</td><td class="lista"> true <input type="radio" name="exttorrents" value="true" <?php if ($EXTERNAL_TORRENTS==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="exttorrents" value="false" <?php if ($EXTERNAL_TORRENTS==false) echo "checked" ?> /></td></tr>
			<!-- Side Menu fixed by fatepower, start -->
			<tr><td class="header">Use Javascript Side Menu (Not Recomended if u have menu_block enable):</td><td class="lista"> true <input type="radio" name="sidemenu" value="true" <?php if ($GLOBALS["use_side_menu"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="sidemenu" value="false" <?php if ($GLOBALS["use_side_menu"]==false) echo "checked" ?> /></td></tr>
			<!-- Side Menu fixed by fatepower, ends -->
			<!-- Send Email to Inactive useres, valuse true/false by fatepower, start -->
			<tr><td class="header">Send Email To Inactive Users:</td><td class="lista"> true <input type="radio" name="inactiveemail" value="true" <?php if ($GLOBALS["INACTIVE_EMAIL"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="inactiveemail" value="false" <?php if ($GLOBALS["INACTIVE_EMAIL"]==false) echo "checked" ?> /></td></tr>
			<!-- Send Email to Inactive useres, valuse true/false by fatepower, ends -->
			<tr><td class="header">Send Email To Inactive Users after selected numbs of days:</td><td class="lista"><input type="text" name="inactivedays" value="<?php echo $INACTIVE_DAYS;?>" size="10" /></td></tr>
            <tr><td class="header">Enabled GZIP:</td><td class="lista"> true <input type="radio" name="gzip_enabled" value="true" <?php if ($GZIP_ENABLED==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="gzip_enabled" value="false" <?php if ($GZIP_ENABLED==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Show Debug infos on page's bottom:</td><td class="lista"> true <input type="radio" name="show_debug" value="true" <?php if ($PRINT_DEBUG==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="show_debug" value="false" <?php if ($PRINT_DEBUG==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Disable DHT (private flag in torrent)<br />will be set only on  new uploaded torrents:</td><td class="lista"> true <input type="radio" name="dht" value="true" <?php if ($DHT_PRIVATE==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="dht" value="false" <?php if ($DHT_PRIVATE==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Enable Live Stats (warning to high server load!):</td><td class="lista"> true <input type="radio" name="livestat" value="true" <?php if ($LIVESTATS==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="livestat" value="false" <?php if ($LIVESTATS==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Enable Site Log (log change on torrents/users):</td><td class="lista"> true <input type="radio" name="logactive" value="true" <?php if ($LOG_ACTIVE==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="logactive" value="false" <?php if ($LOG_ACTIVE==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Enable Basic History (torrents/users):</td><td class="lista"> true <input type="radio" name="loghistory" value="true" <?php if ($LOG_HISTORY==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="loghistory" value="false" <?php if ($LOG_HISTORY==false) echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo PRIVATE_TRACKER; ?></td><td class="lista"><?php echo YES; ?><input type="radio" name="p_tracker" value="true" <?php if ($PRIVATE_TRACKER==true) echo "checked" ?> />&nbsp;&nbsp;<?php echo NO; ?><input type="radio" name="p_tracker" value="false" <?php if ($PRIVATE_TRACKER==false) echo "checked" ?> /></td></tr>
            <tr><td class="header" align="center" colspan="2"><span style="color:red"><?php echo PRIVATE_TRACKER_INFO; ?></span></td></tr>
            <tr><td class="header">Private Announce:</td><td class="lista"> true <input type="radio" name="p_announce" value="true" <?php if ($PRIVATE_ANNOUNCE==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="p_announce" value="false" <?php if ($PRIVATE_ANNOUNCE==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Private Scrape:</td><td class="lista"> true <input type="radio" name="p_scrape" value="true" <?php if ($PRIVATE_SCRAPE==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="p_scrape" value="false" <?php if ($PRIVATE_SCRAPE==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Show Uploaders nick:</td><td class="lista"> true <input type="radio" name="show_uploader" value="true" <?php if ($SHOW_UPLOADER==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="show_uploader" value="false" <?php if ($SHOW_UPLOADER==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Use Popup for Torrents details/peers:</td><td class="lista"> true <input type="radio" name="usepopup" value="true" <?php if ($GLOBALS["usepopup"]) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="usepopup" value="false" <?php if (!$GLOBALS["usepopup"]) echo "checked" ?> /></td></tr>
            <tr><td class="header">Default Language:</td><td class=lista>
            <?php
            $lres=language_list();
            print("\n<select name=default_langue>");
            foreach($lres as $langue)
              {
                $option="<option ";
                if ($langue["id"]==$DEFAULT_LANGUAGE)
                   $option.="selected=selected ";
                $option.="value=".$langue["id"].">".$langue["language"]."</option>";
                print($option);
              }
            print("</select>\n");
            ?>
            </td></tr>
            <tr><td class="header">Character Encoding:</td><td class=lista>
            <select name=charset>
            <option <?php print($GLOBALS["charset"]=="ISO-8859-1"?"selected":""); ?>>ISO-8859-1
            <option <?php print($GLOBALS["charset"]=="ISO-8859-2"?"selected":""); ?>>ISO-8859-2
            <option <?php print($GLOBALS["charset"]=="ISO-8859-3"?"selected":""); ?>>ISO-8859-3
            <option <?php print($GLOBALS["charset"]=="ISO-8859-4"?"selected":""); ?>>ISO-8859-4
            <option <?php print($GLOBALS["charset"]=="ISO-8859-5"?"selected":""); ?>>ISO-8859-5
            <option <?php print($GLOBALS["charset"]=="ISO-8859-6"?"selected":""); ?>>ISO-8859-6
            <option <?php print($GLOBALS["charset"]=="ISO-8859-6-e"?"selected":""); ?>>ISO-8859-6-e
            <option <?php print($GLOBALS["charset"]=="ISO-8859-6-i"?"selected":""); ?>>ISO-8859-6-i
            <option <?php print($GLOBALS["charset"]=="ISO-8859-7"?"selected":""); ?>>ISO-8859-7
            <option <?php print($GLOBALS["charset"]=="ISO-8859-8"?"selected":""); ?>>ISO-8859-8
            <option <?php print($GLOBALS["charset"]=="ISO-8859-8-e"?"selected":""); ?>>ISO-8859-8-e
            <option <?php print($GLOBALS["charset"]=="ISO-8859-8-i"?"selected":""); ?>>ISO-8859-8-i
            <option <?php print($GLOBALS["charset"]=="ISO-8859-9"?"selected":""); ?>>ISO-8859-9
            <option <?php print($GLOBALS["charset"]=="ISO-8859-10"?"selected":""); ?>>ISO-8859-10
            <option <?php print($GLOBALS["charset"]=="ISO-8859-13"?"selected":""); ?>>ISO-8859-13
            <option <?php print($GLOBALS["charset"]=="ISO-8859-14"?"selected":""); ?>>ISO-8859-14
            <option <?php print($GLOBALS["charset"]=="ISO-8859-15"?"selected":""); ?>>ISO-8859-15
            <option <?php print($GLOBALS["charset"]=="UTF-8"?"selected":""); ?>>UTF-8
            <option <?php print($GLOBALS["charset"]=="ISO-2022-JP"?"selected":""); ?>>ISO-2022-JP
            <option <?php print($GLOBALS["charset"]=="EUC-JP"?"selected":""); ?>>EUC-JP
            <option <?php print($GLOBALS["charset"]=="Shift_JIS"?"selected":""); ?>>Shift_JIS
            <option <?php print($GLOBALS["charset"]=="GB2312"?"selected":""); ?>>GB2312
            <option <?php print($GLOBALS["charset"]=="Big5"?"selected":""); ?>>Big5
            <option <?php print($GLOBALS["charset"]=="EUC-KR"?"selected":""); ?>>EUC-KR
            <option <?php print($GLOBALS["charset"]=="windows-1250"?"selected":""); ?>>windows-1250
            <option <?php print($GLOBALS["charset"]=="windows-1251"?"selected":""); ?>>windows-1251
            <option <?php print($GLOBALS["charset"]=="windows-1252"?"selected":""); ?>>windows-1252
            <option <?php print($GLOBALS["charset"]=="windows-1253"?"selected":""); ?>>windows-1253
            <option <?php print($GLOBALS["charset"]=="windows-1254"?"selected":""); ?>>windows-1254
            <option <?php print($GLOBALS["charset"]=="windows-1255"?"selected":""); ?>>windows-1255
            <option <?php print($GLOBALS["charset"]=="windows-1256"?"selected":""); ?>>windows-1256
            <option <?php print($GLOBALS["charset"]=="windows-1257"?"selected":""); ?>>windows-1257
            <option <?php print($GLOBALS["charset"]=="windows-1258"?"selected":""); ?>>windows-1258
            <option <?php print($GLOBALS["charset"]=="KOI8-R"?"selected":""); ?>>KOI8-R
            <option <?php print($GLOBALS["charset"]=="KOI8-U"?"selected":""); ?>>KOI8-U
            <option <?php print($GLOBALS["charset"]=="cp866"?"selected":""); ?>>cp866
            <option <?php print($GLOBALS["charset"]=="cp874"?"selected":""); ?>>cp874
            <option <?php print($GLOBALS["charset"]=="TIS-620"?"selected":""); ?>>TIS-620
            <option <?php print($GLOBALS["charset"]=="VISCII"?"selected":""); ?>>VISCII
            <option <?php print($GLOBALS["charset"]=="VPS"?"selected":""); ?>>VPS
            <option <?php print($GLOBALS["charset"]=="TCVN-5712"?"selected":""); ?>>TCVN-5712
            </select>
            <tr><td class="header">Default Style:</td><td class=lista>
            <?php
            $sres=style_list();
            print("\n<select name=default_style>");
            foreach($sres as $style)
              {
                $option="<option ";
                if ($style["id"]==$DEFAULT_STYLE)
                   $option.="selected=selected ";
                $option.="value=".$style["id"].">".$style["style"]."</option>";
                print($option);
              }
            print("</select>\n");
            ?>
            </td></tr>
            <tr><td class="header">Max Users (numeric, 0 = no limits):</td><td class="lista"><input type="text" name="maxusers" value="<?php echo 0+$MAX_USERS;?>" size="40" /></td></tr>
            <tr><td class="header">Open Registrations:</td><td class="lista"> <?php echo YES; ?> <input type="radio" name="reg" value="true" <?php if ($GLOBALS["reg"]==true) echo "checked" ?> />&nbsp;&nbsp; <?php echo NO; ?> <input type="radio" name="reg" value="false" <?php if ($GLOBALS["reg"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Torrents per page:</td><td class="lista"><input type="text" name="ntorrents" value="<?php echo (0+$ntorrents==0?"15":$ntorrents);?>" size="40" /></td></tr>
            <tr><td class="header" align="center" colspan="2">Tracker's specific settings</td></tr>
            <tr><td class="header">Sanity interval (numeric seconds, 0 = disabled)<br />Good value, if enabled, is 1800 (30 minutes):</td><td class="lista"><input type="text" name="sinterval" value="<?php echo 0+$clean_interval;?>" size="40" /></td></tr>
            <tr><td class="header">Update External interval (numeric seconds, 0 = disabled)<br />Depending of how many external torrents:</td><td class="lista"><input type="text" name="uinterval" value="<?php echo 0+$update_interval;?>" size="40" /></td></tr>
            <tr><td class="header">Maximum reannounce interval (numeric seconds):</td><td class="lista"><input type="text" name="rinterval" value="<?php echo $GLOBALS["report_interval"];?>" size="40" /></td></tr>
            <tr><td class="header">Minimum reannounce interval (numeric seconds):</td><td class="lista"><input type="text" name="mininterval" value="<?php echo $GLOBALS["min_interval"];?>" size="40" /></td></tr>
            <tr><td class="header">Max N. of peers for request (numeric):</td><td class="lista"><input type="text" name="maxpeers" value="<?php echo $GLOBALS["maxpeers"];?>" size="40" /></td></tr>
            <tr><td class="header">Dynamic Torrents (not recommended):</td><td class="lista"> true <input type="radio" name="dynamic" value="true" <?php if ($GLOBALS["dynamic_torrents"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="dynamic" value="false" <?php if ($GLOBALS["dynamic_torrents"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">NAT checking :</td><td class="lista"> true <input type="radio" name="nat" value="true" <?php if ($GLOBALS["NAT"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="nat" value="false" <?php if ($GLOBALS["NAT"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Persistent connections (Database, not recommended):</td><td class="lista"> true <input type="radio" name="persist" value="true" <?php if ($GLOBALS["persist"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="persist" value="false" <?php if ($GLOBALS["persist"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Allow users to override ip :</td><td class="lista"> true <input type="radio" name="override" value="true" <?php if ($GLOBALS["ip_override"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="override" value="false" <?php if ($GLOBALS["ip_override"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Calculate Speed and Dow.ded bytes :</td><td class="lista"> true <input type="radio" name="countbyte" value="true" <?php if ($GLOBALS["countbytes"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="countbyte" value="false" <?php if ($GLOBALS["countbytes"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Table caches :</td><td class="lista"> true <input type="radio" name="caching" value="true" <?php if ($GLOBALS["peercaching"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="caching" value="false" <?php if ($GLOBALS["peercaching"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Max num. of seeds with same PID :</td><td class="lista"><input type="text" name="maxseeds" value="<?php echo $GLOBALS["maxseeds"];?>" size="40" /></td></tr>
            <tr><td class="header">Max num. of leechers with same PID :</td><td class="lista"><input type="text" name="maxleech" value="<?php echo $GLOBALS["maxleech"];?>" size="40" /></td></tr>
            <tr><td class="header">Validation Mode:</td><td class="lista">
            <select name="validation" size="1">
            <option value="none"<?php if($VALIDATION=="none") echo " selected"?>>none</option>
            <option value="user"<?php if($VALIDATION=="user") echo " selected"?>>user</option>
            <option value="admin"<?php if($VALIDATION=="admin") echo " selected"?>>admin</option>
            </select></td></tr>
            <tr><td class="header">Secure Registration (use ImageCode, GD+Freetype libraries needed):</td><td class="lista"> true <input type="radio" name="imagecode" value="true" <?php if ($USE_IMAGECODE==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="imagecode" value="false" <?php if ($USE_IMAGECODE==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Enable invalid login check:<br><font size=1 color=green>(checks number invalid login attempts)</font></td><td class="lista"><label for="inv_login_true"> True <input type="radio" name="inv_login" id="inv_login_true" value="true" <?php if ($GLOBALS["inv_login"]==true) echo "checked" ?> /></label>&nbsp;&nbsp;<label for="inv_login_false"> False <input type="radio" name="inv_login" id="inv_login_false" value="false" <?php if ($GLOBALS["inv_login"]==false) echo "checked" ?> /></label></td></tr>
            <tr><td class="header">Allowed login attempts:<br><font size=1 color=green>(set the max. number of invalid logins to <?php echo $GLOBALS["login_attempts"];?> attempts)</font></td><td class="lista"><input type="text" name="login_attempts" value="<?echo $GLOBALS["login_attempts"];?>" size="20" /></td></tr>
            <tr><td class="header">Forum link (can be: forum link or internal/empty or none):</td><td class="lista"><input type="text" name="f_link" value="<?php echo $GLOBALS["FORUMLINK"];?>" size="40" /></td></tr>
            <tr><td class="header" align="center" colspan="2">Index/Blocks page settings</td></tr>
            <tr><td class="header">Clock type:</td><td class="lista">&nbsp;&nbsp;Analog&nbsp;<input type="radio" name="clocktype" value="true" <?php if ($GLOBALS["clocktype"]==true) echo "checked" ?> />&nbsp;&nbsp;Digital&nbsp;<input type="radio" name="clocktype" value="false" <?php if ($GLOBALS["clocktype"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Limit for Latest News block:</td><td class="lista"><input type="text" name="newslimit" value="<?php echo $GLOBALS["block_newslimit"];?>" size="3" maxlength="3" /></td></tr>
            <tr><td class="header">Limit for Forum block:</td><td class="lista"><input type="text" name="forumlimit" value="<?php echo $GLOBALS["block_forumlimit"];?>" size="3" maxlength="3" /></td></tr>
            <tr><td class="header">Limit for Latest Torrents block:</td><td class="lista"><input type="text" name="last10limit" value="<?php echo $GLOBALS["block_last10limit"];?>" size="3" maxlength="3" /></td></tr>
            <tr><td class="header">Limit for Most Popular Torrents block:</td><td class="lista"><input type="text" name="mostpoplimit" value="<?php echo $GLOBALS["block_mostpoplimit"];?>" size="3" maxlength="3" /></td></tr>
<!-- User Warning System Hack Start -->
            <tr><td class="header" align="center" colspan=2>User Warning System Settings</td></tr>
            <tr><td class="header">Accounts get disabled after:<br><font size=1 color=green>(number of warns an account get's disabled after)</font></td><td class="lista"><input type="text" name="warned" value="<?php echo $GLOBALS["warntimes"];?>" /></td></tr>
            <tr><td class="header">Accounts get auto deleted after:<br><font size=1 color=green>(number of days a disabled account get's deleted after)</font></td><td class="lista"><input type="text" name="disabled" value="<?php echo $GLOBALS["acctdisable"];?>" /></td></tr>
            <tr><td class="header">Auto delete accounts after disable:<br><font size=1 color=green>(is set to <u>Off</u> disabled accounts will not be auto deleted)</font></td><td class="lista"> true <input type="radio" name="delete_disabled" value="true" <?php if ($GLOBALS["autodeldisabled"]==true) echo "checked" ?> />&nbsp;&nbsp; false <input type="radio" name="delete_disabled" value="false" <?php if ($GLOBALS["autodeldisabled"]==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Disabled per page:<br><font size=1 color=green>(number of disabled accounts listed per page in admincp)</font></td><td class="lista"><input type="text" name="disableppage" value="<?php echo $GLOBALS["disableppage"];?>" /></td></tr>
            <tr><td class="header">Warnings per page:<br><font size=1 color=green>(number of warns listed per page in admincp)</font></td><td class="lista"><input type="text" name="warnsppage" value="<?php echo $GLOBALS["warnsppage"];?>" /></td></tr>
<!-- User Warning System Hack Stop -->
			<tr><td class="header" align="center" colspan=2>NFO upload settings</td></tr>
			<tr><td class="header">Allow NFO uploads:</td><td class="lista">true&nbsp;<input type="radio" name="nfo" value="true" <?php if ($GLOBALS["nfo"]==true) echo "checked" ?> />&nbsp;&nbsp;false&nbsp;<input type="radio" name="nfo" value="false" <?php if ($GLOBALS["nfo"]==false) echo "checked" ?> /></td></tr>
			<!-- Requests Section by miskotes Hack Start -->
            <tr><td class="header" align="center" colspan="2">Requests Section</td></tr>
            <tr><td class="header">Requests Section Active:</td><td class="lista">true&nbsp;<input type="radio" name="requestson" value="true" <?php if ($REQUESTSON==true) echo "checked" ?> />&nbsp;&nbsp; false&nbsp;<input type="radio" name="requestson" value="false" <?php if ($REQUESTSON==false) echo "checked" ?> /></td></tr>
            <tr><td class="header">Maximum number of Requests per User:</td><td class="lista"><input type="text" name="maxreqallowed" value="<?php echo (0+$max_req_allowed);?>" size="40" maxlength="3"/></td></tr>
			<!-- Requests Section by miskotes Hack Stop -->
			<!-- Dox Hack Start -->
 		    <tr><td class="header" align="center" colspan=2>DOX settings</td></tr>
  		    <tr><td class="header">DOX path:</td><td class="lista"><input type="text" name="doxpath" value="<?php echo $DOXPATH;?>" size="40" /></td></tr>
 		    <tr><td class="header">DOX enabled:</td><td class="lista"> <?php echo YES; ?> <input type="radio" name="dox" value="true" <?php if ($GLOBALS["dox"]==true) echo "checked" ?> />&nbsp;&nbsp; <?php echo NO; ?> <input type="radio" name="dox" value="false" <?php if ($GLOBALS["dox"]==false) echo "checked" ?> /></td></tr>
 		    <tr><td class="header">File size limit (Bytes):</td><td class="lista"><input type="text" name="limit_dox" value="<?php echo $GLOBALS["limit_dox"];?>" size="40" /></td></tr>
 		    <tr><td class="header">Files per page in DOX:</td><td class="lista"><input type="text" name="DoxLimitPerPage" value="<?php echo $GLOBALS["DoxLimitPerPage"];?>" size="5" /></td></tr>
 		    <tr><td class="header">Delete files older than (Weeks):</td><td class="lista"><input type="text" name="dox_del" value="<?php echo $GLOBALS["dox_del"];?>" size="5" /></td></tr>
			<!-- Dox Hack End -->
            <tr><td class="header" align="center" colspan="2"><?php echo GAMES; ?></td></tr>
            <tr><td class="header" align="left"><?php echo PROFIT; ?></td><td class="lista"><input type="text" name="profit" value="<?php echo (0+$profit);?>" size="40" maxlength="6"/></td></tr>
            <tr><td class="header" align="left"><?php echo REQUIRED_RATIO; ?></td><td class="lista"><input type="text" name="required_ratio" value="<?php echo 0+$required_ratio;?>" size="40" maxlength="6"/></td></tr>
            <tr><td class="header" align="center" colspan="2"><?php echo INVITATIONS; ?></td></tr>
            <tr><td class="header" align="left"><?php echo ACTIVE_INVITES; ?></td><td class="lista"> true<input type="radio" name="inviteson" value="true" <?php if ($INVITESON==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="inviteson" value="false" <?php if ($INVITESON==false) echo "checked" ?> /></td></tr>
            <tr><td class="header" align="left"><?php echo VALID_INV_MODE; ?></td><td class="lista">true<input type="radio" name="valid_inv" value="true" <?php if ($VALID_INV==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="valid_inv" value="false" <?php if ($VALID_INV==false) echo "checked" ?> /></td></tr>
            <tr><td class="header" align="left"><?php echo INVITE_TIMEOUT; ?></td><td class="lista"><input type="text" name="invtimeout" value="<?php echo 0+$invite_timeout;?>" size="40" /></td></tr>
			<!-- Hack Settings Start by fatepower -->
			<tr><td class="header" align="center" colspan="2">SOME HACK SETTINGS</td></tr>
			<tr><td class="header" align="left">Enable Episodes:</td><td class="lista"> true<input type="radio" name="enableepisodes" value="true" <?php if ($GLOBALS["enable_episodes"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enableepisodes" value="false" <?php if ($GLOBALS["enable_episodes"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Nforce:</td><td class="lista"> true<input type="radio" name="enablenforce" value="true" <?php if ($GLOBALS["enable_nforce"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablenforce" value="false" <?php if ($GLOBALS["enable_nforce"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Expected:</td><td class="lista"> true<input type="radio" name="enableexpected" value="true" <?php if ($GLOBALS["enable_expected"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enableexpected" value="false" <?php if ($GLOBALS["enable_expected"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Games:</td><td class="lista"> true<input type="radio" name="enablegames" value="true" <?php if ($GLOBALS["enable_games"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablegames" value="false" <?php if ($GLOBALS["enable_games"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Helpdesk:</td><td class="lista"> true<input type="radio" name="enablehelpdesk" value="true" <?php if ($GLOBALS["enable_helpdesk"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablehelpdesk" value="false" <?php if ($GLOBALS["enable_helpdesk"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Auto Warn:</td><td class="lista"> true<input type="radio" name="enableawarn" value="true" <?php if ($GLOBALS["enable_awarn"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enableawarn" value="false" <?php if ($GLOBALS["enable_awarn"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Seed Bonus:</td><td class="lista"> true<input type="radio" name="enablebonus" value="true" <?php if ($GLOBALS["enable_bonus"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablebonus" value="false" <?php if ($GLOBALS["enable_bonus"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable BrowserCheck:</td><td class="lista"> true<input type="radio" name="enablebrowsercheck" value="true" <?php if ($GLOBALS["enable_browsercheck"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablebrowsercheck" value="false" <?php if ($GLOBALS["enable_browsercheck"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Cut torrents name:</td><td class="lista"> true<input type="radio" name="enablecutname" value="true" <?php if ($GLOBALS["enable_cutname"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablecutname" value="false" <?php if ($GLOBALS["enable_cutname"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable CRK-Protection 2.0 By Cobracrk:</td><td class="lista"> true<input type="radio" name="enablecrk" value="true" <?php if ($GLOBALS["enable_crk"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablecrk" value="false" <?php if ($GLOBALS["enable_crk"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable ANTI Hit & Run:</td><td class="lista"> true<input type="radio" name="enablehr" value="true" <?php if ($GLOBALS["enable_hr"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="enablehr" value="false" <?php if ($GLOBALS["enable_hr"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Show Recommended:</td><td class="lista"> true<input type="radio" name="recom" value="true" <?php if ($GLOBALS["show_recommended"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="recom" value="false" <?php if ($GLOBALS["show_recommended"]==false) echo "checked" ?> /></td></tr>	
			<tr><td class="header" align="left">Enable Torrent Download Name:</td><td class="lista"> true<input type="radio" name="downloadname" value="true" <?php if ($GLOBALS["enable_downloadname"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="downloadname" value="false" <?php if ($GLOBALS["enable_downloadname"]==false) echo "checked" ?> /></td></tr>
			<tr><td class="header" align="left">Enable Torrent Download Check:</td><td class="lista"> true<input type="radio" name="downloadcheck" value="true" <?php if ($GLOBALS["torrent_download_check"]==true) echo "checked" ?> />&nbsp;&nbsp;false<input type="radio" name="downloadcheck" value="false" <?php if ($GLOBALS["torrent_download_check"]==false) echo "checked" ?> /></td></tr>	
            <tr><td class="header" align="left">Min Ratio to download:<br><font size=1 color=green>(Set this option if Enable Torrent Download Check is setted to True/Enable)</font></td><td class="lista"><input type="text" name="minratio" value="<?php echo $GLOBALS["minratio"];?>" /></td></tr>			
			<!-- Hack Settings Ends by fatepower -->			
			<?php
            print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"invia\" value=\"".FRM_CANCEL."\" /></td></tr>");
            print("</table></form>");
            block_end();
            print("<br />");

        }
     elseif ($do=="config" && $action=="write")
            {
            if (isset($_POST["write"]) && $_POST["write"]==FRM_CONFIRM)
               {
                 @chmod("include/config.php",0777);
                 // if I get an error chmod, I'll try to put change into the file
                 $fd = fopen("include/config.php", "w") or die(CANT_WRITE_CONFIG);
                 $foutput ="<?php\n/* Tracker Configuration\n *\n *  This file provides configuration informatino for\n *  the tracker. The user-editable variables are at the top. It is\n *  recommended that you do not change the database settings\n *  unless you know what you are doing.\n */\n\n";
                 $foutput.= "//Maximum reannounce interval.\n";
                 $foutput.= "\$GLOBALS[\"report_interval\"] = " . $_POST["rinterval"] . ";\n";
                 $foutput.= "//Minimum reannounce interval. Optional.\n";
                 $foutput.= "\$GLOBALS[\"min_interval\"] = " . $_POST["mininterval"] . ";\n";
                 $foutput.= "//Number of peers to send in one request.\n";
                 $foutput.= "\$GLOBALS[\"maxpeers\"] = " . $_POST["maxpeers"] . ";\n";
                 $foutput.= "//If set to true, then the tracker will accept any and all\n";
                 $foutput.= "//torrents given to it. Not recommended, but available if you need it.\n";
                 $foutput.= "\$GLOBALS[\"dynamic_torrents\"] = " . $_POST["dynamic"] . ";\n";
                 $foutput.= "// If set to true, NAT checking will be performed.\n";
                 $foutput.= "// This may cause trouble with some providers, so it's\n";
                 $foutput.= "// off by default.\n";
                 $foutput.= "\$GLOBALS[\"NAT\"] = " . $_POST["nat"] . ";\n";
                 $foutput.= "// Persistent connections: true or false.\n";
                 $foutput.= "// Check with your webmaster to see if you're allowed to use these.\n";
                 $foutput.= "// not recommended, only if you get very higher loads, but use at you own risk.\n";
                 $foutput.= "\$GLOBALS[\"persist\"] = " . $_POST["persist"] . ";\n";
                 $foutput.= "// Allow users to override ip= ?\n";
                 $foutput.= "// Enable this if you know people have a legit reason to use\n";
                 $foutput.= "// this function. Leave disabled otherwise.\n";
                 $foutput.= "\$GLOBALS[\"ip_override\"] = " . $_POST["override"] . ";\n";
                 $foutput.= "// For heavily loaded trackers, set this to false. It will stop count the number\n";
                 $foutput.= "// of downloaded bytes and the speed of the torrent, but will significantly reduce\n";
                 $foutput.= "// the load.\n";
                 $foutput.= "\$GLOBALS[\"countbytes\"] = " . $_POST["countbyte"] . ";\n";
                 $foutput.= "// Table caches!\n";
                 $foutput.= "// Lowers the load on all systems, but takes up more disk space.\n";
                 $foutput.= "// You win some, you lose some. But since the load is the big problem,\n";
                 $foutput.= "// grab this.\n";
                 $foutput.= "//\n";
                 $foutput.= "// Warning! Enable this BEFORE making torrents, or else run makecache.php\n";
                 $foutput.= "// immediately, or else you'll be in deep trouble. The tables will lose\n";
                 $foutput.= "// sync and the database will be in a somewhat \"stale\" state.\n";
                 $foutput.= "\$GLOBALS[\"peercaching\"] = " . $_POST["caching"] . ";\n";
                 $foutput.= "//Max num. of seeders with same PID.\n";
                 $foutput.= "\$GLOBALS[\"maxseeds\"] = " . $_POST["maxseeds"] . ";\n";
                 $foutput.= "//Max num. of leechers with same PID.\n";
                 $foutput.= "\$GLOBALS[\"maxleech\"] = " . $_POST["maxleech"] . ";\n";
                 $foutput.= "\n/////////// End of User Configuration ///////////\n";
                 $foutput.= "\$dbhost = \"". $_POST["dbhost"] ."\";\n";
                 $foutput.= "\$dbuser = \"". $_POST["dbuser"] ."\";\n";
                 $foutput.= "\$dbpass = \"". $_POST["dbpwd"] ."\";\n";
                 $foutput.= "\$database = \"" .$_POST["dbname"] . "\";\n";
                 $foutput.= "//Tracker's name\n";
                 $foutput.= "\$SITENAME=\"".$_POST["trackername"]."\";\n";
                 $foutput.= "//Tracker's Base URL\n";
                 $foutput.= "\$BASEURL=\"".$_POST["trackerurl"]."\";\n";
				 $foutput.= "//Torrents download URL Name\n";
                 $foutput.= "\$TORRENT_URL_NAME=\"".$_POST["torrenturlname"]."\";\n";
				 $foutput.= "//Cut Torrent name's after X numbs of chars\n";
                 $foutput.= "\$CUTNAME=\"".$_POST["cutname"]."\";\n";
                 $foutput.= "// tracker's announce urls, can be more than one\n";
                 $foutput.= "\$TRACKER_ANNOUNCEURLS=array();\n";
                 $tannounceurls=array();
                 $tannounceurls=explode("\n",$_POST["tracker_announceurl"]);
                 foreach($tannounceurls as $taurl)
                      {
                      $taurl=str_replace(array("\n","\r\n","\r"),"",$taurl);
                      if ($taurl!="")
                        $foutput.= "\$TRACKER_ANNOUNCEURLS[]=\"".trim($taurl)."\";\n";
                      }
                 $foutput.= "//Tracker's email (owner email)\n";
                 $foutput.= "\$SITEEMAIL=\"".$_POST["trackeremail"]."\";\n";
                 $foutput.= "//Torrent's DIR\n";
                 $foutput.= "\$TORRENTSDIR=\"".$_POST["torrentdir"]."\";\n";
                 $foutput.= "//validation type (must be none, user or admin\n";
                 $foutput.= "//none=validate immediatly, user=validate by email, admin=manually validate\n";
                 $foutput.= "\$VALIDATION=\"".$_POST["validation"]."\";\n";
                 $foutput.= "//Use or not the image code for new users' registration\n";
                 $foutput.= "\$USE_IMAGECODE=".$_POST["imagecode"].";\n";
                 $foutput.= "//Check the number of invalid login attempts\n";
                 $foutput.= "\$GLOBALS[\"inv_login\"] = " . $_POST["inv_login"] . ";\n";
                 $foutput.= "//Set the maximum number of invalid login attempts\n";
                 $foutput.= "\$GLOBALS[\"login_attempts\"]=\"".$_POST["login_attempts"]."\";\n";
                 $foutput.= "// interval for sanity check (good = 10 minutes)\n";
                 $foutput.= "\$clean_interval=\"".$_POST["sinterval"]."\";\n";
                 $foutput.= "// interval for updating external torrents (depending of how many external torrents)\n";
                 $foutput.= "\$update_interval=\"".$_POST["uinterval"]."\";\n";
                 $foutput.= "// forum link or internal (empty = internal) or none\n";
                 $foutput.= "\$FORUMLINK=\"".$_POST["f_link"]."\";\n";
                 $foutput.= "// If you want to allow users to upload external torrents values true/false\n";
                 $foutput.= "\$EXTERNAL_TORRENTS=".$_POST["exttorrents"].";\n";
				 //Side Menu fixed by fatepower, start
				 $foutput.= "//If you want to allow users to use side menu, values true/false\n";
                 $foutput.= "\$GLOBALS[\"use_side_menu\"]=".$_POST["sidemenu"].";\n";
				 //Side Menu fixed by fatepower, ends
				 //Send Email To Inactive Users by fatepower, start
				 $foutput.= "//Send Email To Inactive Users, values true/false\n";
                 $foutput.= "\$GLOBALS[\"INACTIVE_EMAIL\"]=".$_POST["inactiveemail"].";\n";
				 //Send Email To Inactive Users by fatepower, ends
				 $foutput.= "//Send Email To Inactive Users after selected numbs of days\n";
                 $foutput.= "\$INACTIVE_DAYS=\"".$_POST["inactivedays"]."\";\n";
                 $foutput.= "// Enable/disable GZIP compression, can save a lot of bandwidth\n";
                 $foutput.= "\$GZIP_ENABLED=".$_POST["gzip_enabled"].";\n";
                 $foutput.= "// Show/Hide bottom page information on script's generation time and gzip\n";
                 $foutput.= "\$PRINT_DEBUG=".$_POST["show_debug"].";\n";
                 $foutput.= "// Enable/disable DHT network, add private flag to \"info\" in torrent\n";
                 $foutput.= "\$DHT_PRIVATE=".$_POST["dht"].";\n";
                 $foutput.= "// Enable/disable Live Stats (up/down updated every announce) WARNING CAN DO HIGH SERVER LOAD!\n";
                 $foutput.= "\$LIVESTATS=".$_POST["livestat"].";\n";
                 $foutput.= "// Enable/disable Site log\n";
                 $foutput.= "\$LOG_ACTIVE=".$_POST["logactive"].";\n";
                 $foutput.= "//Enable Basic History (torrents/users)\n";
                 $foutput.= "\$LOG_HISTORY=".$_POST["loghistory"].";\n";
                 $foutput.= "// Default language (used for guest)\n";
                 $foutput.= "\$DEFAULT_LANGUAGE=".$_POST["default_langue"].";\n";
                 $foutput.= "// Default charset (used for guest)\n";
                 $foutput.= "\$GLOBALS[\"charset\"]=\"".$_POST["charset"]."\";\n";
                 $foutput.= "// Default style  (used for guest)\n";
                 $foutput.= "\$DEFAULT_STYLE=".$_POST["default_style"].";\n";
                 $foutput.= "// Maximum number of users (0 = no limits)\n";
                 $foutput.= "\$GLOBALS[\"reg\"] = " . $_POST["reg"] . ";\n";
                 $foutput.= "\$MAX_USERS=".$_POST["maxusers"].";\n";
                 $foutput.= "//torrents per page\n";
                 $foutput.= "\$ntorrents =\"".$_POST["ntorrents"]."\";\n";
                 $foutput.= "//private tracker (true/false), if set to true don't allow register user\n";
                 $foutput.= "\$PRIVATE_TRACKER =".$_POST["p_tracker"].";\n";
                 $foutput.= "//private announce (true/false), if set to true don't allow non register user to download\n";
                 $foutput.= "\$PRIVATE_ANNOUNCE =".$_POST["p_announce"].";\n";
                 $foutput.= "//private scrape (true/false), if set to true don't allow non register user to scrape (for stats)\n";
                 $foutput.= "\$PRIVATE_SCRAPE =".$_POST["p_scrape"].";\n";
                 $foutput.= "//Show uploaders nick on torrent listing\n";
                 $foutput.= "\$SHOW_UPLOADER = ".$_POST["show_uploader"].";\n";
                 $foutput.= "\$GLOBALS[\"block_newslimit\"] = \"". $_POST["newslimit"]."\";\n";
                 $foutput.= "\$GLOBALS[\"block_forumlimit\"] = \"". $_POST["forumlimit"]."\";\n";
                 $foutput.= "\$GLOBALS[\"block_last10limit\"] = \"". $_POST["last10limit"]."\";\n";
                 $foutput.= "\$GLOBALS[\"block_mostpoplimit\"] = \"". $_POST["mostpoplimit"]."\";\n";
                 $foutput.= "\$GLOBALS[\"clocktype\"] = " . $_POST["clocktype"] . ";\n";
                 $foutput.= "\$GLOBALS[\"usepopup\"] = " . $_POST["usepopup"] . ";\n";
                 $foutput.= "\$INVITESON=".$_POST["inviteson"].";\n";
                 $foutput.= "//Valid invite mode (true/false), if set to true need confirm by the inviter\n";
                 $foutput.= "\$VALID_INV =".$_POST["valid_inv"].";\n";
                 $foutput.= "// interval for delete the invites out ( on days )\n";
                 $foutput.= "\$invite_timeout=\"".$_POST["invtimeout"]."\";\n";
//User Warning System Hack Start - 00:45 08.08.2006
                 $foutput.= "//user warning system hack\n";
                 $foutput.= "//the number of warnings an account get's disabled at\n";
                 $foutput.= "\$warntimes =\"".$_POST["warned"]."\";\n";
                 $foutput.= "//turn on or off auto deletion of disabled accounts\n";
                 $foutput.= "\$autodeldisabled=".$_POST["delete_disabled"].";\n";
                 $foutput.= "//the number of days a disabled account get's deleted after\n";
                 $foutput.= "\$acctdisable =\"".$_POST["disabled"]."\";\n";
                 $foutput.= "//number of disabled accounts per page listed in admincp\n";
                 $foutput.= "\$disableppage =\"".$_POST["disableppage"]."\";\n";
                 $foutput.= "//number of warns per page listed in admincp\n";
                 $foutput.= "\$warnsppage =\"".$_POST["warnsppage"]."\";\n";
//User Warning System Hack Stop
//NFO Hack Start
				 $foutput.= "//Allow NFO uploads\n";
				 $foutput.= "\$GLOBALS[\"nfo\"] = " . $_POST["nfo"] . ";\n";
//NFO HACK END
//Requests Section by miskotes Hack Start
                 $foutput.= "//turn on or off the requests page\n";
                 $foutput.= "\$REQUESTSON=".$_POST["requestson"].";\n";
                 $foutput.= "\$max_req_allowed =\"".$_POST["maxreqallowed"]."\";\n";
//Requests Section by miskotes Hack Stop
//DOX Hack Start
     			 $foutput.= "\$GLOBALS[\"dox\"] = " . $_POST["dox"] . ";\n";
    		     $foutput.= "\$DOXPATH = \"" . $_POST["doxpath"] ."\";\n";
    		     $foutput.= "\$GLOBALS[\"limit_dox\"] = \"" . $_POST["limit_dox"] ."\";\n";
   			     $foutput.= "\$GLOBALS[\"DoxLimitPerPage\"] = \"" . $_POST["DoxLimitPerPage"] ."\";\n";
     			 $foutput.= "\$GLOBALS[\"dox_del\"] = \"" . $_POST["dox_del"] ."\";\n";
//Dox Hack End
//Blackjack Start
                 $foutput.= "//profit for blackjack players\n";
                 $foutput.= "\$profit =\"".$_POST["profit"]."\";\n";
                 $foutput.= "//required ratio for blackack players\n";
                 $foutput.= "\$required_ratio=\"".$_POST["required_ratio"]."\";\n";
//Blackjack Ends
				 // Hack Settings Start By fatepower
				 $foutput.= "//If u want to enable episodes, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_episodes\"]=".$_POST["enableepisodes"].";\n";
				 $foutput.= "//If u want to enable nforce, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_nforce\"]=".$_POST["enablenforce"].";\n";
				 $foutput.= "//If u want to enable expected, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_expected\"]=".$_POST["enableexpected"].";\n";
				 $foutput.= "//If u want to enable games, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_games\"]=".$_POST["enablegames"].";\n";
				 $foutput.= "//If u want to enable helpdesk, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_helpdesk\"]=".$_POST["enablehelpdesk"].";\n";
				 $foutput.= "//If u want to enable auto warn, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_awarn\"]=".$_POST["enableawarn"].";\n";
				 $foutput.= "//If u want to enable seed bonus, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_bonus\"]=".$_POST["enablebonus"].";\n";
				 $foutput.= "//If u want to enable browser check, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_browsercheck\"]=".$_POST["enablebrowsercheck"].";\n";
				 $foutput.= "//If u want to enable cut torrents name, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_cutname\"]=".$_POST["enablecutname"].";\n";
				 $foutput.= "//If u want to enable CRK-Protection 2.0, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_crk\"]=".$_POST["enablecrk"].";\n";
				 $foutput.= "//If u want to enable ANTI Hit & Run, values true/false\n";
                 $foutput.= "\$GLOBALS[\"enable_hr\"]=".$_POST["enablehr"].";\n";
				 $foutput.= "\$GLOBALS[\"show_recommended\"] = " . $_POST["recom"] . ";\n";
				 $foutput.= "\$GLOBALS[\"enable_downloadname\"]=".$_POST["downloadname"].";\n";
				 $foutput.= "\$GLOBALS[\"torrent_download_check\"]=".$_POST["downloadcheck"].";\n";
				 $foutput.= "\$GLOBALS[\"minratio\"]=".$_POST["minratio"].";\n";
				 // Hack Settings Ends By fatepower
                 $foutput.= "\n?>";
                 fwrite($fd,$foutput) or die(CANT_SAVE_CONFIG);
                 fclose($fd);
                 @chmod("include/config.php",0744);
                 mysql_query("UPDATE users SET language=$_POST[default_langue], style=$_POST[default_style] WHERE id_level=1");
                 print(CONFIG_SAVED);
                 redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]);
                 exit;
              }
            }
     elseif ($do=="category" && $action=="read")
            {
            $cat=genrelist();
            block_begin(CAT_SETTINGS);
            print("&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=add\"><img alt=".CAT_INSERT_NEW." border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".CAT_SORT_INDEX."</td>\n");
            print("<td class=\"header\" align=\"center\">".NAME."</td>\n");
            print("<td class=\"header\" align=\"center\">".PICTURE."</td>\n");
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            foreach($cat as $category) {

            if($category["sub"] != 0)
            {
				$cate = sub_cat($category["sub"])." &raquo; ".$category["name"];
                //$cate = sub_cat($category["sub"])." » ".$category["name"];
            } else {
                $cate = $category["name"];
            }
                         print("<tr>\n");
                         print("<td class=\"lista\">".$category["sort_index"]."</td>\n");
                         print("<td class=\"lista\">".StripSlashes($cate)."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".image_or_link(($category["image"]==""?"&nbsp;":"images/categories/".$category["image"]),"","")."</td>\n");
                         print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=edit&id=".$category["id"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
                         print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=delete&id=".$category["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");

            }
     elseif ($do=="category" && $action=="delete")
            {
                $id=intval($_GET["id"]);
                mysql_query("DELETE FROM categories WHERE id=$id") or die(mysql_error());
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=read");
            }
     elseif ($do=="category" && $action=="add")
            {
            block_begin(CAT_ADD_CAT);
            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=category&action=write_add" name="catadd" method="post" enctype="multipart/form-data">
            <table class="lista" width="100%" align="center">
            <tr>
            <td><?php echo NAME; ?></td><td><input type="text" name="name" size="40" maxlength="30" /></td>
            </tr>
            <tr>
            <td><?php echo SUB_CATEGORY; ?></td><td><?php sub_categories(); ?></td>
            </tr>
            <tr>
            <td><?php echo CAT_SORT_INDEX; ?></td><td><input type="text" name="sort" size="40" /></td>
            </tr>
            <tr>
            <td><?php echo CAT_IMAGE; ?>:</td>
            <td>
            <select name="image" onchange="update_cat(this.options[selectedIndex].value);">
            <option value=""><?php echo NONE; ?></option>
            <?php

            for( $i = 0; $i < count($images); $i++ )
            {
              print("<option value=\"" . $images[$i] . "\">" . $images[$i] . "</option>\n");
            }

            ?>
            </select> &nbsp;
            <?php
        if(!isset($image)) $image = "";
            print("<img name='cat_image' src='images/categories/" . $image . "'>");
            ?>
            </td>
            </tr>
            <tr>
            <td><?php echo UPLOAD_IMAGE; ?></td><td><input type="file" name="upimage" size="40" /></td></tr>
            <tr>
            <td><input type="submit" name="confirm" value=<?php echo FRM_CONFIRM ?> /></td>
            <td><input type="submit" name="confirm" value=<?php echo FRM_CANCEL ?> /></td>
            </tr>
            </table>
            </form>

            <?php
            block_end();
            print("<br />");
            }
     elseif ($do=="category" && $action=="write_add")
            {
                if ($_POST["confirm"]==FRM_CONFIRM)
                {
                   $name = mysql_escape_string($_POST["name"]);
                   $sub = mysql_escape_string($_POST["sub_category"]);
                   $sort=intval($_POST["sort"]);
                   if ($_FILES["upimage"]["name"]!=""&&str_replace(".php","",$_FILES["upimage"]["name"])==$_FILES["upimage"]["name"])
                   {
                        $img=$_FILES["upimage"]["name"];
                        move_uploaded_file($_FILES["upimage"]["tmp_name"],"images/categories/".$_FILES["upimage"]["name"]);
                   } else {
                       $img=$_POST["image"];
                   }
                   mysql_query("INSERT INTO categories SET name='$name', sub='$sub', sort_index='$sort', image='$img'") or die(mysql_error());
                }
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=read");
            }
     elseif ($do=="category" && $action=="edit")
            {
                $id=intval($_GET["id"]);
                $rcat=mysql_query("SELECT * FROM categories WHERE id=$id") or die(mysql_error());
                $rescat=mysql_fetch_array($rcat);
                if ($rescat)
                   {
                   block_begin(EDIT_CAT);
                   ?>
                   <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=category&action=write_edit&id=<?php echo $id;?>" name="catedit" method="post" enctype="multipart/form-data">
                   <table class="lista" width="100%" align="center">
                   <tr>
                   <td><?php echo NAME; ?></td><td><input type="text" name="name" value="<?php echo unesc($rescat["name"]); ?>" size="40" maxlength="30" /></td>
                   </tr>
                   <tr>
                   <td><?php echo SUB_CATEGORY; ?></td><td><?php sub_categories($rescat["sub"]); ?></td>
                   </tr>
                   <tr>
                   <td><?php echo CAT_SORT_INDEX; ?></td><td><input type="text" name="sort" value="<?php echo $rescat["sort_index"]; ?>" size="40" /></td>
                   </tr>
                   <tr>
                   <td><?php echo CAT_IMAGE; ?>:</td>
                   <td>
                   <select name="image" onchange="update_cat(this.options[selectedIndex].value);">
                   <option value=""><?php echo NONE; ?></option>
                   <?php

                   for( $i = 0; $i < count($images); $i++ )
                   {
                     if( $images[$i] == $rescat['image'] )
                     {
                       $selected = " selected=\"selected\"";
                       $image = $images[$i];
                     }
                     else
                     {
                       $selected = "";
                     }

                     print("<option value=\"" . $images[$i] . "\"" . $selected . ">" . $images[$i] . "</option>\n");
                   }

                   ?>
                   </select> &nbsp;&nbsp;
                   <?php
                   $image = "spacer.gif";
                   print("<img name='cat_image' src='images/categories/" . $image . "'>");
                   ?>
                   </td>
                   </tr>
                   <tr>
                   <td><?php echo UPLOAD_IMAGE; ?></td><td><input type="file" name="upimage" size="40" /></td>
                   </tr>
                   <tr>
                   <td><input type="submit" name="confirm" value=<?php echo FRM_CONFIRM ?> /></td>
                   <td><input type="submit" name="confirm" value=<?php echo FRM_CANCEL ?> /></td>
                   </tr>
                   </table>
                   </form>

                   <?php
                   block_end();
                   print("<br />");
                   }
                else
                  redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=read");

            }
     elseif ($do=="category" && $action=="write_edit")
            {
                if ($_POST["confirm"]==FRM_CONFIRM)
                   {
                   $id=intval($_GET["id"]);
                   $name=mysql_escape_string($_POST["name"]);
                   $sub = mysql_escape_string($_POST["sub_category"]);
                   $sort=intval($_POST["sort"]);
                   if ($_FILES["upimage"]["name"]!=""&&str_replace(".php","",$_FILES["upimage"]["name"])==$_FILES["upimage"]["name"])
                      {

                        $img=$_FILES["upimage"]["name"];
                        //die("aaa".$image);
                        move_uploaded_file($_FILES["upimage"]["tmp_name"],"images/categories/".$_FILES["upimage"]["name"]);
                      }
                   else
                       $img=$_POST["image"];

                   mysql_query("UPDATE categories SET name='$name', sub='$sub', sort_index='$sort', image='$img' WHERE id=$id") or die(mysql_error());
                }
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=category&action=read");
            }
     elseif ($do=="level" && $action=="read")
            {
            block_begin(USER_GROUPS);
            print("&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=add\"><img alt=".INSERT_USER_GROUP." border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".GROUP."</td>\n");
            print("<td class=\"header\" align=\"center\">".MNU_TORRENT."<br />".VIEW_EDIT_DEL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MEMBERS."<br />".VIEW_EDIT_DEL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MNU_NEWS."<br />".VIEW_EDIT_DEL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MNU_FORUM."<br />".VIEW_EDIT_DEL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MNU_UPLOAD."</td>\n");
            print("<td class=\"header\" align=\"center\">".DOWNLOAD."</td>\n");
            print("<td class=\"header\" align=\"center\">".MOD_CPANEL."</td>\n");
			print("<td class=\"header\" align=\"center\">".ADMIN_CPANEL."</td>\n");
			print("<td class=\"header\" align=\"center\">".OWNER_CPANEL."</td>\n");
            print("<td class=\"header\" align=\"center\">".WT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            $rlevel=mysql_query("SELECT * from users_level ORDER BY id_level");
            while ($level=mysql_fetch_array($rlevel)) {
                         print("<tr>\n");
                         print("<td class=\"lista\" align=\"center\"><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=edit&id=".$level["id"].">".unesc($level["prefixcolor"]).unesc($level["level"]).unesc($level["suffixcolor"])."<a></td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["view_torrents"]."/".$level["edit_torrents"]."/".$level["delete_torrents"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["view_users"]."/".$level["edit_users"]."/".$level["delete_users"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["view_news"]."/".$level["edit_news"]."/".$level["delete_news"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["view_forum"]."/".$level["edit_forum"]."/".$level["delete_forum"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["can_upload"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["can_download"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["mod_access"]."</td>\n");
						 print("<td class=\"lista\" align=\"center\">".$level["admin_access"]."</td>\n");
						 print("<td class=\"lista\" align=\"center\">".$level["owner_access"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$level["WT"]."</td>\n");
                         if ($level["can_be_deleted"]=="no")
                            print("<td class=\"lista\">&nbsp;</td>\n");
                         else
                             print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=delete&id=".$level["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");
            }
     elseif ($do=="level" && $action=="edit")
        {
            $id=intval($_GET["id"]);
            $rlevel=mysql_query("SELECT * FROM users_level WHERE id=$id");
            if (!$rlevel)
               die(ERROR.CANT_FIND_GROUP);
            $level=mysql_fetch_array($rlevel);
            block_begin(USER_GROUPS);
            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=level&action=write&id=<?php echo $level["id"]; ?>" name="level" method="post">
            <table class="lista" width="100%" align="center">
            <tr><td class="header"><?php echo GROUP_NAME;?>:</td><td class="lista"><input type="text" name="gname" value="<?php echo unesc($level["level"]);?>" size="40" /></td></tr>
            <tr><td class="header"><?php echo GROUP_PCOLOR;?>&lt;span style='color:red'&gt;):</td><td class="lista"><input type="text" name="pcolor" value="<?php echo StripSlashes($level["prefixcolor"]);?>" size="40" maxlength="40" /></td></tr>
            <tr><td class="header"><?php echo GROUP_SCOLOR;?>&lt;/span&gt;):</td><td class="lista"><input type="text" name="scolor" value="<?php echo StripSlashes($level["suffixcolor"]);?>" size="40" maxlength="40" /></td></tr>
            <tr><td class="header"><?php echo GROUP_WT;?>&nbsp;(hours):</td><td class="lista"><input type="text" name="waiting" value="<?php echo $level["WT"];?>" size="40" maxlength="40" /></td></tr>
            <tr><td class="header"><?php echo GROUP_VIEW_TORR;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="vtorrent" value="yes" <?php if ($level["view_torrents"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="vtorrent" value="no" <?php if ($level["view_torrents"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_EDIT_TORR;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="etorrent" value="yes" <?php if ($level["edit_torrents"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="etorrent" value="no" <?php if ($level["edit_torrents"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_DELETE_TORR;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="dtorrent" value="yes" <?php if ($level["delete_torrents"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="dtorrent" value="no" <?php if ($level["delete_torrents"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_VIEW_USERS;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="vuser" value="yes" <?php if ($level["view_users"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="vuser" value="no" <?php if ($level["view_users"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_EDIT_USERS;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="euser" value="yes" <?php if ($level["edit_users"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="euser" value="no" <?php if ($level["edit_users"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_DELETE_USERS;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="duser" value="yes" <?php if ($level["delete_users"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="duser" value="no" <?php if ($level["delete_users"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_VIEW_NEWS;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="vnews" value="yes" <?php if ($level["view_news"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="vnews" value="no" <?php if ($level["view_news"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_EDIT_NEWS;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="enews" value="yes" <?php if ($level["edit_news"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="enews" value="no" <?php if ($level["edit_news"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_DELETE_NEWS;?>:</td><td class="lista"> <?php echo YES;?> <input type="radio" name="dnews" value="yes" <?php if ($level["delete_news"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="dnews" value="no" <?php if ($level["delete_news"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_VIEW_FORUM;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="vforum" value="yes" <?php if ($level["view_forum"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="vforum" value="no" <?php if ($level["view_forum"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_EDIT_FORUM;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="eforum" value="yes" <?php if ($level["edit_forum"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="eforum" value="no" <?php if ($level["edit_forum"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_DELETE_FORUM;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="dforum" value="yes" <?php if ($level["delete_forum"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="dforum" value="no" <?php if ($level["delete_forum"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_UPLOAD;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="upload" value="yes" <?php if ($level["can_upload"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="upload" value="no" <?php if ($level["can_upload"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_DOWNLOAD;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="down" value="yes" <?php if ($level["can_download"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="down" value="no" <?php if ($level["can_download"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_MOD_CP;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="modcp" value="yes" <?php if ($level["mod_access"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="modcp" value="no" <?php if ($level["mod_access"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_GO_CP;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="admincp" value="yes" <?php if ($level["admin_access"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="admincp" value="no" <?php if ($level["admin_access"]=="no") echo "checked" ?> /></td></tr>
            <tr><td class="header"><?php echo GROUP_OWNER_CP;?>:</td><td class="lista">  <?php echo YES;?> <input type="radio" name="ownercp" value="yes" <?php if ($level["owner_access"]=="yes") echo "checked" ?> />&nbsp;&nbsp; <?php echo NO;?> <input type="radio" name="ownercp" value="no" <?php if ($level["owner_access"]=="no") echo "checked" ?> /></td></tr>
            <?php
            print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" /></td></tr>");
            print("</table></form>");
            block_end();
            print("<br />");
        }
     elseif ($do=="level" && $action=="add")
        {
          block_begin(GROUP_ADD_NEW);
        ?>
          <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=level&action=writenew" name="level" method="post">
          <table class="lista" width="100%" align="center">
          <tr><td class="header"><?php echo GROUP_NAME;?>:</td><td class="lista"><input type="text" name="gname" value="" size="40" /></td></tr>
          <tr><td class="header"><?php echo GROUP_BASE_LEVEL;?></td><td class="lista"><select name="baselevel" size="1">
        <?php
          $rlevel=mysql_query("SELECT DISTINCT id_level,predef_level FROM users_level ORDER BY id_level");

          while($level=mysql_fetch_array($rlevel))
              {
              print("\n<option value=".$level["id_level"].">".$level["predef_level"]."</option>");
              }
          print("\n</select></td></tr>");
          print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" /></td></tr>");
          print("</table></form>");
          block_end();
          print("<br />");
        }
     elseif ($do=="level" && $action=="writenew")
        {
            if ($_POST["write"]==FRM_CONFIRM)
               {
                 $id=intval($_POST["baselevel"]);
                 $rlevel=mysql_query("SELECT * FROM users_level WHERE id=$id") or die(mysql_error());
                 $level=mysql_fetch_array($rlevel);
                 if (!$level)
                    die(GROUP_ERR_BASE_SEL);
                 $update=array();
                 $update[]="level='".mysql_escape_string($_POST["gname"])."'";
                 $update[]="id_level='".$id."'";
                 $update[]="predef_level='".$level["predef_level"]."'";
                 $update[]="view_torrents='".$level["view_torrents"]."'";
                 $update[]="edit_torrents='".$level["edit_torrents"]."'";
                 $update[]="delete_torrents='".$level["delete_torrents"]."'";
                 $update[]="view_users='".$level["view_users"]."'";
                 $update[]="edit_users='".$level["edit_users"]."'";
                 $update[]="delete_users='".$level["delete_users"]."'";
                 $update[]="view_news='".$level["view_news"]."'";
                 $update[]="edit_news='".$level["edit_news"]."'";
                 $update[]="delete_news='".$level["delete_news"]."'";
                 $update[]="view_forum='".$level["view_forum"]."'";
                 $update[]="edit_forum='".$level["edit_forum"]."'";
                 $update[]="delete_forum='".$level["delete_forum"]."'";
                 $update[]="can_upload='".$level["can_upload"]."'";
                 $update[]="can_download='".$level["can_download"]."'";
                 $update[]="mod_access='".$level["mod_access"]."'";
				 $update[]="admin_access='".$level["admin_access"]."'";
				 $update[]="owner_access='".$level["owner_access"]."'";
                 $update[]="WT='".$level["WT"]."'";
                 $update[]="prefixcolor=".sqlesc($level["prefixcolor"]);
                 $update[]="suffixcolor=".sqlesc($level["suffixcolor"]);
                 $strupdate=implode(",",$update);
                 $id=intval($_GET["id"]);
                 mysql_query("INSERT INTO users_level SET $strupdate") or die(mysql_error());
            }
        redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=read");
        }
     elseif ($do=="level" && $action=="delete")
        {
            $id=intval($_GET["id"]);
            // controle if this level can be cancelled
            $rcanc=mysql_query("SELECT can_be_deleted FROM users_level WHERE id=$id");
            if (!$rcanc)
               die(BAD_ID);
            $rcancanc=mysql_fetch_array($rcanc);
            if (!$rcancanc)
               die(BAD_ID);

            if ($rcancanc["can_be_deleted"]=="yes")
               {
               mysql_query("DELETE FROM users_level WHERE id=$id") or die(mysql_error());
               redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=read");
               }
            else
                err_msg(ERROR,CANT_DELETE_GROUP);
        }
     elseif ($do=="level" && $action=="write")
        {
            if ($_POST["write"]==FRM_CONFIRM)
               {
                 $update=array();
                 $update[]="level='".mysql_escape_string($_POST["gname"])."'";
                 $update[]="view_torrents='".$_POST["vtorrent"]."'";
                 $update[]="edit_torrents='".$_POST["etorrent"]."'";
                 $update[]="delete_torrents='".$_POST["dtorrent"]."'";
                 $update[]="view_users='".$_POST["vuser"]."'";
                 $update[]="edit_users='".$_POST["euser"]."'";
                 $update[]="delete_users='".$_POST["duser"]."'";
                 $update[]="view_news='".$_POST["vnews"]."'";
                 $update[]="edit_news='".$_POST["enews"]."'";
                 $update[]="delete_news='".$_POST["dnews"]."'";
                 $update[]="view_forum='".$_POST["vforum"]."'";
                 $update[]="edit_forum='".$_POST["eforum"]."'";
                 $update[]="delete_forum='".$_POST["dforum"]."'";
                 $update[]="can_upload='".$_POST["upload"]."'";
                 $update[]="can_download='".$_POST["down"]."'";
                 $update[]="mod_access='".$_POST["modcp"]."'";
				 $update[]="admin_access='".$_POST["admincp"]."'";
				 $update[]="owner_access='".$_POST["ownercp"]."'";
                 $update[]="WT='".$_POST["waiting"]."'";
                 $update[]="prefixcolor=".sqlesc($_POST["pcolor"]);
                 $update[]="suffixcolor=".sqlesc($_POST["scolor"]);
                 $strupdate=implode(",",$update);
                 $id=intval($_GET["id"]);
                 mysql_query("UPDATE users_level SET $strupdate WHERE id=$id") or die(mysql_error());
            }
        redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=level&action=read");
        }
     elseif ($do=="language" && $action=="read")
            {
            $cat=language_list();
            block_begin(LANGUAGE_SETTINGS);
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".USER_LANGUE."</td>\n");
            print("<td class=\"header\" align=\"center\">".URL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MEMBERS."</td>\n");

            print("</tr>\n");
            foreach($cat as $category) {
                         $res = mysql_query("SELECT * FROM users WHERE language = " . $category["id"]);
                         $total_users = 0+@mysql_num_rows($res);
                         print("<tr>\n");
                         print("<td class=\"lista\" align=\"center\">".unesc($category["language"])."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["language_url"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$total_users."</td>\n");
                         // print("<td class=\"lista\" align=\"center\">&nbsp;</td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");
            }


    elseif ($do=="polls" && $action=="read")
            {
            block_begin(POLLS_SETTINGS);
        print("&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=add\"><img alt=".INSERT_NEW_POLL." border=0 src=\"images/new.gif\"></a>\n");
            print("\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".POLLID."</td>\n");
            print("<td class=\"header\" align=\"center\">".QUESTION."</td>\n");
            print("<td class=\"header\" align=\"center\">".VOTES."</td>\n");
            print("<td class=\"header\" align=\"center\">".ACTIVATED."</td>\n");
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            $res = mysql_query("SELECT * FROM polls ORDER BY pid");
            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=polls&action=updatestatus" name="poll" method="post">
            <?php
            while($result=mysql_fetch_array($res)){
            print("<tr>\n");
            ?>
            <td class="lista" align="center"><?php echo $result["pid"];?></td>
            <td class="lista" align="center"><?php echo unesc($result["poll_question"]);?></td>
            <td class="lista" align="center"><?php echo $result["votes"];?></td>
            <td class="lista" align="center"><input type="radio" name="status" value="<?php echo $result["pid"]; ?>" <?php if ($result["status"]=="true") echo "checked"; ?>>

            <?php
            print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=edit&pid=".$result["pid"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
            print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=delete&pid=".$result["pid"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
            print("</tr>\n");
            }
            ?>
            </table>
            <?php
            print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td></tr>");
            print("</form>");
            block_end();
            print("<br />");
            }


     elseif ($do=="polls" && $action=="updatestatus"){
        $activepoll=$_POST["status"];
        mysql_query("UPDATE polls SET status='true' WHERE pid='$activepoll'");
        mysql_query("UPDATE polls SET status='false' WHERE pid!='$activepoll'");
        redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
     }

     elseif ($do=="polls" && $action=="add")
            {
                 block_begin(ADD_NEW_POLL);
                 ?>
                 <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=polls&action=writenew" name="poll" method="post">
                 <table class="lista" width="100%" align="center">
             <tr>
             <td class="header"><?php echo QUESTION;?></td>
             <td class="header"><input type="text" name="question" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer1" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer2" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer3" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer4" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer5" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer6" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer7" value="" size="40" /></td>
             </tr>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="answer8" value="" size="40" /></td>
             </tr>
                 <?php
                 print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" /></td></tr>");
                 print("</table></form>");
                 block_end();
                 print("<br />");

            }

     elseif ($do=="polls" && $action=="edit")
            {
             $pid=intval($_GET["pid"]);
             $res =mysql_query("SELECT * FROM polls WHERE pid='$pid'") or die(mysql_error());
             if (!$res) die(ERROR.CANT_FIND_POLL);
                 $result=mysql_fetch_array($res);
             $question=unesc($result["poll_question"]);
                 block_begin("Poll: $question");
             $poll_answers = (unserialize($result["choices"]));
                 ?>
                 <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=polls&action=write&pid=<?php echo $result["pid"]; ?>" name="poll" method="post">
                 <table class="lista" width="100%" align="center">
             <tr>
             <td class="header"><?php echo QUESTION;?></td>
             <td class="header"><input type="text" name="question" value="<?php echo $question;?>" size="40" /></td>
             </tr>
             <?php
             $count=0;
               reset($poll_answers);
               foreach ($poll_answers as $entry){
                    $id     = $entry[0];
                    $choice = $entry[1];
                    $votes  = $entry[2];
                $clean=preg_replace('/\s+/', '', $choice);
             ?>
             <tr>
               <td class="lista"><?php echo OPTION;?></td>
             <td class="lista"><input type="text" name="<?php echo $clean;?>" value="<?php echo $choice;?>" size="40" /></td>
             </tr>
                 <?php
             $count++;
             }
             if($count<8){
             ?>
                <tr>
                <td class="lista"><?php echo OPTION;?></td>
                <td class="lista"><input type="text" name="newanswer" size="40" /></td>
                </tr>
             <?php
             }
                 print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" /></td></tr>");
                 print("</table></form>");
                 block_end();
                 print("<br />");
            }

     elseif ($do=="polls" && $action=="delete")
            {
        $pid=intval($_GET["pid"]);
        mysql_query("DELETE FROM polls WHERE pid=$pid") or die(mysql_error());
        mysql_query("DELETE FROM poll_voters WHERE pid=$pid") or die(mysql_error());
        redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
            }

     elseif ($do=="polls" && $action=="write")
            {
            if ($_POST["write"]==FRM_CANCEL) redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
            if ($_POST["write"]==FRM_CONFIRM){
                $pid=intval($_GET["pid"]);
                $total_votes = 0;
                $res =mysql_query("SELECT * FROM polls WHERE pid='$pid'") or die(mysql_error());
                if (!$res) die(ERROR.CANT_FIND_POLL);
                        $result=mysql_fetch_array($res);
                    $poll_answers = (unserialize($result["choices"]));
                    $question=unesc($result["poll_question"]);
                    reset($poll_answers);
                    $new_poll_array=array();
                        foreach ($poll_answers as $entry){
                                $id     = $entry[0];
                                $choice = $entry[1];
                                $votes  = $entry[2];
                            $clean=preg_replace('/\s+/', '', $choice);
                            if($_POST["$clean"]!=$choice){
                                 $choice=($_POST["$clean"]);
                                 $votes=0;
                            }
                            if($choice!=""){
                                $new_poll_array[] = array( $id, $choice, $votes);
                            }
                            $total_votes += $votes;
                        }
                        if(isset($_POST["newanswer"]) && $_POST["newanswer"]!=""){
                            $id++;
                            $votes=0;
                            $choice=$_POST["newanswer"];
                            $new_poll_array[] = array( $id, $choice, $votes);
                        }
                        $question=mysql_escape_string($_POST["question"]);
                        $votings= (serialize($new_poll_array));
                        mysql_query("UPDATE polls SET choices='$votings', votes='$total_votes', poll_question='$question' WHERE pid='$pid'");
                        redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
            }
            }


    elseif ($do=="polls" && $action=="writenew")
            {
            if ($_POST["write"]==FRM_CANCEL) redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
            if ($_POST["write"]==FRM_CONFIRM){
                    $new_poll_array=array();
                    $id=0;
                    $votes=0;
                    if($_POST["answer1"]!=""){
                        $choice= ($_POST["answer1"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer2"]!=""){
                        $choice= ($_POST["answer2"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer3"]!=""){
                        $choice= ($_POST["answer3"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer4"]!=""){
                        $choice= ($_POST["answer4"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer5"]!=""){
                        $choice= ($_POST["answer5"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer6"]!=""){
                        $choice= ($_POST["answer6"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer7"]!=""){
                        $choice= ($_POST["answer7"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    if($_POST["answer8"]!=""){
                        $choice= ($_POST["answer8"]);
                        $new_poll_array[] = array( $id, $choice, $votes);
                        $id++;
                    }
                    $question=mysql_escape_string($_POST["question"]);
                    $votings= AddSlashes(serialize($new_poll_array));
                    $startdate= time();
                    $starter=$CURUSER["uid"];
                    mysql_query("INSERT INTO polls SET startdate='$startdate', choices='$votings', starter_id='$starter', poll_question='$question'") or die(mysql_error());
                    redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=polls&action=read");
            }
            }


     elseif ($do=="blocks" && $action=="read")
            {
            block_begin(BLOCKS_SETTINGS);
            $position="";
            print("\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".BLOCK."</td>\n");
            print("<td class=\"header\" align=\"center\">".POSITION."</td>\n");
            print("<td class=\"header\" align=\"center\">".SORTID."</td>\n");
            print("<td class=\"header\" align=\"center\">".ACTIVE."</td>\n");
            print("</tr>\n");
            $res = mysql_query("SELECT * FROM blocks ORDER BY position, status, sortid");
            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=blocks&action=write" method="post" enctype="multipart/form-data">
            <?php
            while($result=mysql_fetch_array($res)){
            if($result["position"]=='l') $position=LEFT;
            if($result["position"]=='r') $position=RIGHT;
            if($result["position"]=='c') $position=CENTER;
            if($result["position"]=='t') $position=TOP;
            print("<tr>\n");
            ?>
            <td class="lista" align="center"><?php echo $result["content"];?>-block</td>
            <!--<td class="lista" align="right"><?php echo $position;?></td>-->
            <td class="lista" align="center"><select name="<?php echo $result["content"];?>position" size="1">
            <option value="l"<?php if($result["position"]=='l') echo " selected"?>>left</option>
                <option value="r"<?php if($result["position"]=='r') echo " selected"?>>right</option>
            <option value="c"<?php if($result["position"]=='c') echo " selected"?>>center</option>
            <option value="t"<?php if($result["position"]=='t') echo " selected"?>>top</option>
            </select></td>
                <td class="lista" align="center"><input type="text" name="<?php echo $result["content"];?>sortid" value="<?php echo $result["sortid"];?>" size="4" /></td>
            <td class="lista" align="center"><select name="<?php echo $result["content"];?>status" size="1">
            <option value="0"<?php if($result["status"]==0) echo " selected"?>>disabled</option>
                <option value="1"<?php if($result["status"]==1) echo " selected"?>>enabled</option>
            </select></td>
            <?php
            print("</tr>\n");
            }
            ?>
            </table>
            <tr>
            <td align="right"><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> /></td>
            </tr>
            </form>
            <?php

            block_end();
            print("<br />");
            }
     elseif ($do=="blocks" && $action=="write")
            {
                if ($_POST["write"]==FRM_CONFIRM)
                   {
                    $res = mysql_query("SELECT * FROM blocks");
                    while($result=mysql_fetch_array($res)){
                        $var1= $_POST["".$result["content"]."sortid"];
                        $var2= $_POST["".$result["content"]."status"];
                        $var3= $result["blockid"];
                        $var4= $_POST["".$result["content"]."position"];
                        mysql_query("UPDATE blocks SET sortid='$var1', status='$var2', position='$var4' WHERE blockid='$var3'") or die(mysql_error());
                    }
                   }
                   redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=blocks&action=read");
            }

     elseif ($do=="badwords" && $action=="read")
            {
              $f=@fopen("badwords.txt","r");
              $badwords=@fread($f,filesize("badwords.txt"));
              @fclose($f);
              block_begin(EDIT_CENSURED);
              ?>
              <form action="admincp.php?<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=badwords&action=write" method="post" enctype="multipart/form-data">
              <table class="lista" width="100%" align="center">
              <tr>
              <td align=center><?php echo CENS_ONE_PER_LINE;?></td>
              </tr>
              <tr>
              <td align=center><textarea name="badwords" rows="20" cols="60"><?php echo $badwords; ?></textarea></td>
              </tr>
              <tr>
              <td align=center><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> />&nbsp&nbsp<input type="submit" name="write" value=<?php echo FRM_CANCEL ?> /></td>
              </tr>
              </table>
              </form>
              <?php
              block_end();
              print("<br />");
            }
     elseif ($do=="badwords" && $action=="write")
            {
                if ($_POST["write"]==FRM_CONFIRM)
                   {
                   if (isset($_POST["badwords"]))
                      {
                      $f=fopen("badwords.txt","w+");
                      @fwrite($f,$_POST["badwords"]);
                      fclose($f);
                      }
                   }
                   redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]);
            }

// Begin Donar Hack
// Fixed By Fatepower for BTITFM 1.4.X, PB Edition

     elseif ($do=="donator" && $action=="read")
            {
			$cat=donator_list();
            block_begin("Donator List");
            print("<br />&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=add\"><img alt=".INSERT_NEW_DONATOR." border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".MEMBERS."</td>\n");
            print("<td class=\"header\" align=\"center\">".DONATION."</td>\n");
            print("<td class=\"header\" align=\"center\">".YTD_DONATION."</td>\n");
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            foreach($cat as $category) {
                         $res = mysql_query("SELECT * FROM users WHERE donator = " . $category["id"]);
                         print("<tr>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["donator"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["donation"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["ytd_donation"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=edit&id=".$category["id"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
                         print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=delete&id=".$category["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         print("<td class=\"lista\" align=\"center\">&nbsp;</td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");
            block_begin(DONATION_SETTINGS);

            ?>
			<!-- user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."& -->
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=paypal&action=write" name="paypal" method="post">
            <table class="lista" width="100%" align="center">
            <tr><td class="header">Donation Needed:</td><td align="left" class="lista"><input type="text" name="d_needed" value="<?php echo $GLOBALS["d_needed"];?>" size="5" maxlength="5" /></td></tr>
            <tr><td class="header">Donation Received:</td><td align="left" class="lista"><input type="text" name="d_received" value="<?php echo $GLOBALS["d_received"];?>" size="5" maxlength="5" /></td></tr>
			<?php
            print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"invia\" value=\"".FRM_CANCEL."\" /></td></tr>");
            print("</table></form>");
            block_end();
            print("<br />");
            }
     elseif ($do=="donator" && $action=="edit")
            {
                $id=intval($_GET["id"]);
                $rdonator=mysql_query("SELECT * FROM donator WHERE id=$id") or die(mysql_error());
                $resdonator=mysql_fetch_array($rdonator);
                if ($resdonator)
                   {
                   block_begin(EDIT_DONATOR);
                   ?>
					<!-- user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."& -->
                   <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=donator&action=write&id=<?php echo $id; ?> name="donatoredit" method="post" enctype="multipart/form-data">
                   <table class="lista" width="100%" align="center">
                   <tr>
                   <td><?php echo DONATOR_NAME;?></td><td><input type="text" name="donator" value="<?php echo $resdonator["donator"]; ?>" size="10" maxlength="10" /></td>
                   </tr>
                   <tr>
                   <td><?php echo PAYPAL_DONATION;?></td><td><input type="text" name="donation" value="<?php echo $resdonator["donation"]; ?>" size="10" maxlength="10" /></td>
                   </tr>
                   <tr>
                   <td><?php echo PAYPAL_YTD_DONATION;?></td><td><input type="text" name="ytd_donation" value="<?php echo $resdonator["ytd_donation"]; ?>" size="10" maxlength="10" /></td>
                   </tr>
                   <tr>
                   <td><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> /></td>
                   <td><input type="submit" name="write" value=<?php echo FRM_CANCEL ?> /></td>
                   </tr>
                   </table>
                   </form>
                   <?php
                   block_end();
                   print("<br />");
                   }
                else
                  redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read");

            }
     elseif ($do=="donator" && $action=="write")
            {
            if ($_POST["write"]==FRM_CONFIRM)
               {
                   if ($_GET["what"]=="new")
                      {
                       mysql_query("INSERT INTO donator SET donator='".$_POST["donator"]."',donation='".$_POST["donation"]."',ytd_donation='".$_POST["ytd_donation"]."'") or die(mysql_error());
                       print(donator_ADDED);
                      }
                   else
                       {
                       $id=intval($_GET["id"]);
                       mysql_query("UPDATE donator SET donator='".$_POST["donator"]."',donation='".$_POST["donation"]."',ytd_donation='".$_POST["ytd_donation"]."' WHERE id=$id") or die(mysql_error());
                       print(DONATOR_MODIFIED);
                       }
                 redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read");
                 exit;
              }
            else
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read");
            }
     elseif ($do=="donator" && $action=="add")
            {
              block_begin(DONATOR_ADD);
              ?>
			  <!-- Uncomment cuz uf testing user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."& -->
			  <?php
			  //Fixed here by fatepower
			  print("<form method=post action=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=write&what=new name=donatoredit enctype=multipart/form-data>");
              ?>
              <table class="lista" width="100%" align="center">
              <tr>
              <td><?php echo DONATOR_NAME;?></td><td><input type="text" name="donator" size="20" maxlength="20" /></td>
              </tr>
              <tr>
              <td><?php echo PAYPAL_DONATION;?></td><td><input type="text" name="donation" size="10" maxlength="10" /></td>
              </tr>
			  <tr>
              <td><?php echo PAYPAL_YTD_DONATION;?></td><td><input type="text" name="ytd_donation" size="10" maxlength="10" /></td>
              </tr>
              <tr>
              <td><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> /></td>
              <td><input type="submit" name="write" value=<?php echo FRM_CANCEL ?> /></td>
              </tr>
              </table>
              </form>
              <?php
              block_end();
              print("<br />");

            }
     elseif ($do=="donator" && $action=="delete")
            {
                $id=intval($_GET["id"]);
                if ($id!=$DEFAULT_donator)
                   {
                   mysql_query("UPDATE users SET donator=$DEFAULT_donator WHERE donator=$id");
                   mysql_query("DELETE FROM donator WHERE id=$id") or die(mysql_error());
                   }
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read");
            }
  elseif ($do=="paypal" && $action=="read")
     {
            block_begin("PayPal Setting's");

            ?>
            <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=paypal&action=write" name="paypal" method="post">
            <table class="lista" width="100%" align="center">
            <tr><td class="header">Donation Needed:</td><td align="left" class="lista"><input type="text" name="d_needed" value="<?php echo $GLOBALS["d_needed"];?>" size="5" maxlength="5" /></td></tr>
            <tr><td class="header">Donation Received:</td><td align="left" class="lista"><input type="text" name="d_received" value="<?php echo $GLOBALS["d_received"];?>" size="5" maxlength="5" /></td></tr>
            <?php
            print("\n<tr><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"invia\" value=\"".FRM_CANCEL."\" /></td></tr>");
            print("</table></form>");
            block_end();
            print("<br />");

        }
     elseif ($do=="paypal" && $action=="write")
            {
            if ($_POST["write"]==FRM_CONFIRM)
               {
                 @chmod("include/paypal.php",0777);
                 // if I get an error chmod, I'll try to put change into the file
                 $fd = fopen("include/paypal.php", "w") or die(CANT_WRITE_PAYPAL);
				 $foutput ="<?php\n/* PayPal Configuration\n */\n\n";
				 $foutput.= "\$GLOBALS[\"d_needed\"] = \"". $_POST["d_needed"]."\";\n";
				 $foutput.= "\$GLOBALS[\"d_received\"] = \"". $_POST["d_received"]."\";\n";
  		 		 $foutput.= "\n?>";
                 fwrite($fd,$foutput) or die(CANT_SAVE_PAYPAL);
                 fclose($fd);
                 @chmod("include/paypal.php",0744);
                 print(CONFIG_SAVED);
                 redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=donator&action=read");
                 exit;
              }
            }

// End Donar Hack

     elseif ($do=="language" && $action=="delete")
            {
                $id=intval($_GET["id"]);
                if ($id!=$DEFAULT_LANGUAGE)
                   {
             $rlang=mysql_query("SELECT * FROM language WHERE id=$id") or die(mysql_error());
                     $reslang=mysql_fetch_array($rlang);
             $lang=$reslang["language_url"];
             if(unlink("$lang")){
                    mysql_query("UPDATE users SET language=$DEFAULT_LANGUAGE WHERE language=$id");
                    mysql_query("DELETE FROM language WHERE id=$id") or die(mysql_error());
                }
             else err_msg(ERROR,DELFAILED);
                   }
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=language&action=read");
            }
     elseif ($do=="style" && $action=="read")
            {
            $cat=style_list();
            block_begin(STYLE_SETTINGS);
            print("<br />&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=add\"><img alt=".INSERT_NEW_STYLE." border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".STYLE_NAME."</td>\n");
            print("<td class=\"header\" align=\"center\">".STYLE_URL."</td>\n");
            print("<td class=\"header\" align=\"center\">".MEMBERS."</td>\n");
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            foreach($cat as $category) {
                         $res = mysql_query("SELECT * FROM users WHERE style = " . $category["id"]);
                         $total_users = 0+@mysql_num_rows($res);
                         print("<tr>\n");
                         print("<td class=\"lista\" align=\"center\">".unesc($category["style"])."</td>\n");
                         print("<td class=\"lista\">".$category["style_url"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$total_users."</td>\n");
                         print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=edit&id=".$category["id"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
                         if ($category["id"]!=$DEFAULT_STYLE)
                            print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=delete&id=".$category["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         else
                             print("<td class=\"lista\" align=\"center\">&nbsp;</td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");
            }
     elseif ($do=="style" && $action=="edit")
            {
                $id=intval($_GET["id"]);
                $rstyle=mysql_query("SELECT * FROM style WHERE id=$id") or die(mysql_error());
                $resstyle=mysql_fetch_array($rstyle);
                if ($resstyle)
                   {
                   block_begin(EDIT_STYLE);
                   ?>
                   <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=style&action=write&id=<?php echo $id; ?> name="styleedit" method="post" enctype="multipart/form-data">
                   <table class="lista" width="100%" align="center">
                   <tr>
                   <td><?php echo STYLE_NAME;?></td><td><input type="text" name="style" value="<?php echo unesc($resstyle["style"]); ?>" size="40" maxlength="20" /></td>
                   </tr>
                   <tr>
                   <td><?php echo STYLE_URL;?></td><td><input type="text" name="style_url" value="<?php echo $resstyle["style_url"]; ?>" size="40" maxlength="100" /></td>
                   </tr>
                   <tr>
                   <td><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> /></td>
                   <td><input type="submit" name="write" value=<?php echo FRM_CANCEL ?> /></td>
                   </tr>
                   </table>
                   </form>
                   <?php
                   block_end();
                   print("<br />");
                   }
                else
                  redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=read");

            }
     elseif ($do=="style" && $action=="write")
            {
            if ($_POST["write"]==FRM_CONFIRM)
               {
                   if ($_GET["what"]=="new")
                      {
                       mysql_query("INSERT INTO style SET style='".mysql_escape_string($_POST["style"])."',style_url='".$_POST["style_url"]."'") or die(mysql_error());
                       print(STYLE_ADDED);
                      }
                   else
                       {
                       $id=intval($_GET["id"]);
                       mysql_query("UPDATE style SET style='".mysql_escape_string($_POST["style"])."',style_url='".$_POST["style_url"]."' WHERE id=$id") or die(mysql_error());
                       print(STYLE_MODIFIED);
                       }
                 redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=read");
                 exit;
              }
            else
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=read");
            }
     elseif ($do=="style" && $action=="add")
            {
              block_begin(STYLE_ADD);
              ?>
              <form action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=style&action=write&what=new" name="styleedit" method="post" enctype="multipart/form-data">
              <table class="lista" width="100%" align="center">
              <tr>
              <td><?php echo STYLE_NAME;?></td><td><input type="text" name="style" size="40" maxlength="20" /></td>
              </tr>
              <tr>
              <td><?php echo STYLE_URL;?></td><td><input type="text" name="style_url" size="40" maxlength="100" /></td>
              </tr>
              <tr>
              <td><input type="submit" name="write" value=<?php echo FRM_CONFIRM ?> /></td>
              <td><input type="submit" name="write" value=<?php echo FRM_CANCEL ?> /></td>
              </tr>
              </table>
              </form>
              <?php
              block_end();
              print("<br />");
            }
     elseif ($do=="style" && $action=="delete")
            {
                $id=intval($_GET["id"]);
                if ($id!=$DEFAULT_STYLE)
                   {
                   mysql_query("UPDATE users SET style=$DEFAULT_STYLE WHERE style=$id");
                   mysql_query("DELETE FROM style WHERE id=$id") or die(mysql_error());
                   }
                redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=style&action=read");
            }
     elseif ($do=="dbutil")
            {
            $ad_display="";
            include("include/dbutil.php");
            echo "<br />\n";

            }
     elseif ($do=="forum" && $action=="read")
            {
// Forum cat begin
            $resforums=mysql_query("SELECT forums.*,fcat.sort as csort,fcat.name as cat,uread.level as readlevel,uwrite.level as writelevel, ucreate.level as createlevel FROM forums inner join forums_cat as fcat on fcat.id=cat inner join users_level  as uread on uread.id_level=minclassread inner join users_level as uwrite on uwrite.id_level=minclasswrite inner join users_level as ucreate on ucreate.id_level=minclasscreate WHERE ucreate.can_be_deleted='no' AND uread.can_be_deleted='no' AND uwrite.can_be_deleted='no' ORDER BY fcat.sort ,forums.sort ASC");
            $resforumscat=mysql_query("SELECT forums_cat.*, uview.level as viewlevel FROM forums_cat inner join users_level as uview on uview.id_level=minclassview WHERE uview.can_be_deleted='no' ORDER BY forums_cat.sort ASC");
			block_begin(FORUM_CATS);
            print("<br />&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=editcat&what=new\"><img alt=Insert New Catagory border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".CAT_NAME."/Description</td>\n");
            print("<td class=\"header\" align=\"center\">".CAT_MIN_VIEW."</td>\n");
            print("<td class=\"header\" align=\"center\">".SORT_ORDER."</td>\n");
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            while($result=mysql_fetch_array($resforumscat)) {
                         print("<tr>\n");
                         print("<td class=\"lista\"><b>".unesc($result["name"])."</b><br />".unesc($result["description"])."</td>\n");
                         print("<td class=\"lista\">".$result["viewlevel"]."</td>\n");
                         print("<td class=\"lista\">".$result["sort"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=editcat&id=".$result["id"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
                         print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=deletecat&id=".$result["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
			block_end();
// Forum cat end
//            $resforums=mysql_query("SELECT forums.*,uread.level as readlevel,uwrite.level as writelevel, ucreate.level as createlevel FROM forums inner join users_level  as uread on uread.id_level=minclassread inner join users_level as uwrite on uwrite.id_level=minclasswrite inner join users_level as ucreate on ucreate.id_level=minclasscreate WHERE ucreate.can_be_deleted='no' AND uread.can_be_deleted='no' AND uwrite.can_be_deleted='no' ORDER BY forums.id");
            block_begin(FORUM_SETTINGS);
            print("<br />&nbsp;&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=edit&what=new\"><img alt=".INSERT_NEW_FORUM." border=0 src=\"images/new.gif\"></a>\n");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_NAME."/Description</td>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_N_TOPICS."</td>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_N_POSTS."</td>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_READ."</td>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_WRITE."</td>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_CREATE."</td>\n");
// Forum cat start
			print("<td class=\"header\" align=\"center\">".SORT_ORDER."</td>\n");
			print("<td class=\"header\" align=\"center\">".CAT_NAME2."</td>\n");
// Forum cat end
            print("<td class=\"header\" align=\"center\">".EDIT."</td>\n");
            print("<td class=\"header\" align=\"center\">".DELETE."</td>\n");
            print("</tr>\n");
            while($result=mysql_fetch_array($resforums)) {
                         print("<tr>\n");
                         print("<td class=\"lista\"><b>".unesc($result["name"])."</b><br />".unesc($result["description"])."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$result["topiccount"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$result["postcount"]."</td>\n");
                         print("<td class=\"lista\">".$result["readlevel"]."</td>\n");
                         print("<td class=\"lista\">".$result["writelevel"]."</td>\n");
                         print("<td class=\"lista\">".$result["createlevel"]."</td>\n");
// Forum cat start
                         print("<td class=\"lista\">".$result["sort"]."</td>\n");
			 			 print("<td class=\"lista\">".$result["cat"]."</td>\n");
// Forum cat end
                         print("<td class=\"lista\" align=\"center\"><a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=edit&id=".$result["id"]."\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>\n");
                         print("<td class=\"lista\" align=\"center\"><a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=delete&id=".$result["id"]."\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
            block_end();
            print("<br />");
            }
// Forum cat begin
     elseif ($do=="forum" && $action=="editcat")
            {
            if (isset($_GET["what"])) $what=$_GET["what"];
        else $what="";
            if ($what!="new")
               {
           $id=intval($_GET["id"]);
               $resforumscat=mysql_query("SELECT * FROM forums_cat WHERE id=".$id);
               }
            if (isset($resforumscat) && $resforumscat)
               $result=mysql_fetch_array($resforumscat);
            elseif ($what!="new")
                err_msg(ERROR,BAD_ID);

            block_begin("Catagory Settings");
            $rlevel=mysql_query("SELECT DISTINCT id_level, predef_level, level FROM users_level ORDER BY id_level");
            $alevel=array();
            while($reslevel=mysql_fetch_array($rlevel))
                $alevel[]=$reslevel;
// Forum cat start
//            $rcat=mysql_query("SELECT DISTINCT id, name FROM forums_cat ORDER BY id");
//            $acat=array();
//            while($rescat=mysql_fetch_array($rcat))
//                $acat[]=$rescat;
// Forum cat end

        if (!isset($id)) $id = "";

            print("<form name=editcat action=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=saveeditcat&id=$id&what=$what method=post>\n");
            print("<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".NAME."</td>\n");
            print("<td class=\"lista\" align=\"center\"><input type=\"text\" name=\"name\" value=\"".($what == "new" ? "" : unesc($result["name"]))."\" size=\"40\" maxlength=\"60\" /></td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".DESCRIPTION."</td>\n");
            print("<td class=\"lista\" align=\"center\"><textarea name=\"description\" rows=\"3\" cols=\"40\" maxlength=\"200\">".($what == "new" ? "" : unesc($result["description"]))."</textarea></td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".CAT_MIN_VIEW."</td>\n");
            print("<td class=\"lista\" align=\"center\"><select name=viewlevel>\n");
            foreach($alevel as $level)
                {
                print("<option value=".$level["id_level"].($result["minclassview"] == $level["id_level"] ? " selected>" : ">").$level["level"]."</option>\n");
                }
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".SORT_ORDER."</td>\n");
            print("<td class=\"lista\" align=\"center\"><input type=\"text\" name=\"sort\" value=\"".($what == "new" ? "" : unesc($result["sort"]))."\" size=\"2\" maxlength=\"5\" /></td>\n");
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"lista\" align=\"center\">&nbsp;</td>\n<td class=\"lista\" align=\"center\"><input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" />\n");
            print("&nbsp;&nbsp;<input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td>\n");
            print("</tr>\n");
            print("</table>\n");
            print("</form>\n");
            block_end();
            print("<br />");
            }
     elseif ($do=="forum" && $action=="saveeditcat")
            {
            $what=$_GET["what"];
            $minclassview=intval($_POST["viewlevel"]);
            $description=sqlesc($_POST["description"]);
            $name=sqlesc($_POST["name"]);
			$sort=sqlesc($_POST["sort"]);
            if ($what!="new")
               {
               $id=intval($_GET["id"]);
               mysql_query("UPDATE forums_cat SET sort=$sort,name=$name,description=$description,minclassview=$minclassview WHERE id=$id") or die(mysql_error());
               }
            else
                {
               mysql_query("INSERT INTO forums_cat SET sort=$sort,name=$name,description=$description,minclassview=$minclassview") or die(mysql_error());
                }
            redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
            }
     elseif ($do=="forum" && $action=="deletecat")
            {
            $id=intval($_GET["id"]);
            $res = mysql_query("SELECT * FROM forums WHERE forums.cat=$id") or die(mysql_error());
            $row = mysql_fetch_row($res);
				if ($row != 0){
				err_msg(ERROR,CAT_DEL_ERROR);
                exit();
			}
            $resforumcat=mysql_query("SELECT * FROM forums_cat WHERE id=$id");
            if ($_GET["confirm"]==1)
               {
               mysql_query("DELETE FROM forums_cat WHERE id=$id") or die(mysql_error());
               redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
               exit();
               }
            if ($resforumcat)
               {
                   $result=mysql_fetch_array($resforumcat);
                   redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=deletecat&id=$id&confirm=1");
               }
            }
// Forum cat end
     elseif ($do=="forum" && $action=="edit")
            {
            if (isset($_GET["what"])) $what=$_GET["what"];
        else $what="";
            if ($what!="new")
               {
           $id=intval($_GET["id"]);
               $resforums=mysql_query("SELECT * FROM forums WHERE id=".$id);
               }
            if (isset($resforums) && $resforums)
               $result=mysql_fetch_array($resforums);
            elseif ($what!="new")
                err_msg(ERROR,BAD_ID);

            block_begin(FORUM_SETTINGS);
            $rlevel=mysql_query("SELECT DISTINCT id_level, predef_level, level FROM users_level ORDER BY id_level");
            $alevel=array();
            while($reslevel=mysql_fetch_array($rlevel))
                $alevel[]=$reslevel;
// Forum cat start
            $rcat=mysql_query("SELECT DISTINCT id, name FROM forums_cat ORDER BY id");
            $acat=array();
            while($rescat=mysql_fetch_array($rcat))
                $acat[]=$rescat;
// Forum cat end

        if (!isset($id)) $id = "";

            print("<form name=editforum action=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=saveedit&id=$id&what=$what method=post>\n");
            print("<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".NAME."</td>\n");
            print("<td class=\"lista\" align=\"center\"><input type=\"text\" name=\"name\" value=\"".($what == "new" ? "" : unesc($result["name"]))."\" size=\"40\" maxlength=\"60\" /></td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".DESCRIPTION."</td>\n");
            print("<td class=\"lista\" align=\"center\"><textarea name=\"description\" rows=\"3\" cols=\"40\" maxlength=\"200\">".($what == "new" ? "" : unesc($result["description"]))."</textarea></td>\n");
            print("</tr>\n<tr>\n");
// Forum cat begin
            print("<td class=\"header\" align=\"center\">".SORT_ORDER."</td>\n");
            print("<td class=\"lista\" align=\"center\"><input type=\"text\" name=\"sort\" value=\"".($what == "new" ? "" : unesc($result["sort"]))."\" size=\"2\" maxlength=\"5\" /></td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".CAT_NAME2."</td>\n");
            print("<td class=\"lista\" align=\"center\"><select name=catagory>\n");
            foreach($acat as $cat)
                {
			print("<option value=".$cat["id"].($result["cat"] == $cat["id"] ? " selected>" : ">").$cat["name"]."</option>\n");
                }
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
// Forum cat end
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_READ."</td>\n");
            print("<td class=\"lista\" align=\"center\"><select name=readlevel>\n");
            foreach($alevel as $level)
                {
                print("<option value=".$level["id_level"].($result["minclassread"] == $level["id_level"] ? " selected>" : ">").$level["level"]."</option>\n");
                }
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_WRITE."</td>\n");
            print("<td class=\"lista\" align=\"center\"><select name=writelevel>\n");
            foreach($alevel as $level)
                {
                print("<option value=".$level["id_level"].($result["minclasswrite"] == $level["id_level"] ? " selected>" : ">").$level["level"]."</option>\n");
                }
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\" align=\"center\">".FORUM_MIN_CREATE."</td>\n");
// Forum cat start
//			print("<td class=\"header\" align=\"center\">".SORT_ORDER."</td>\n");
//			print("<td class=\"header\" align=\"center\">".CAT_NAME2."</td>\n");
// Forum cat end
            print("<td class=\"lista\" align=\"center\"><select name=createlevel>\n");
            foreach($alevel as $level)
                {
                print("<option value=".$level["id_level"].($result["minclasscreate"] == $level["id_level"] ? " selected>" : ">").$level["level"]."</option>\n");
                }
            print("</select>\n</td>\n");
            print("</tr>\n<tr>\n");
            print("<td class=\"lista\" align=\"center\">&nbsp;</td>\n<td class=\"lista\" align=\"center\"><input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" />\n");
            print("&nbsp;&nbsp;<input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td>\n");
            print("</tr>\n");
            print("</table>\n");
            print("</form>\n");
            block_end();
            print("<br />");
            }
     elseif ($do=="forum" && $action=="saveedit")
            {
            $what=$_GET["what"];
// Forum cat begin
			$catagory=intval($_POST["catagory"]);
                        $sort=sqlesc($_POST["sort"]);
// Forum cat end
            $minclassread=intval($_POST["readlevel"]);
            $minclasswrite=intval($_POST["writelevel"]);
            $minclasscreate=intval($_POST["createlevel"]);
            $description=sqlesc($_POST["description"]);
            $name=sqlesc($_POST["name"]);
            if ($what!="new")
               {
               $id=intval($_GET["id"]);
//query changed forum cat
               mysql_query("UPDATE forums SET sort=$sort,name=$name,description=$description,cat=$catagory,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate WHERE id=$id") or die(mysql_error());
//               mysql_query("UPDATE forums SET name=$name,description=$description,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate WHERE id=$id") or die(mysql_error());
               }
            else
                {
//query changed forum cat
               mysql_query("INSERT INTO forums SET sort=$sort,name=$name,description=$description,cat=$catagory,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate") or die(mysql_error());
//               mysql_query("INSERT INTO forums SET name=$name,description=$description,minclassread=$minclassread,minclasswrite=$minclasswrite,minclasscreate=$minclasscreate") or die(mysql_error());
                }
            redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
            }
     elseif ($do=="forum" && $action=="delete")
            {
            $id=intval($_GET["id"]);
            // control if there are posts/topics
            $resforum=mysql_query("SELECT * FROM forums WHERE id=$id");
            if ($_GET["confirm"]==1)
               {
               mysql_query("DELETE FROM topics WHERE forumid=$id") or die(mysql_error());
               mysql_query("DELETE FROM forums WHERE id=$id") or die(mysql_error());
               redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=read");
               exit();
               }
            if ($resforum)
               {
                   $result=mysql_fetch_array($resforum);
                   if ($result["topiccount"]>0 || $result["postcount"]>0)
                   $msg=FORUM_PRUNE_1;
                   $msg.=FORUM_PRUNE_2." <a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=forum&action=delete&id=$id&confirm=1>".CLICK_HERE."</a>";
                   $msg.=",<br />".FORUM_PRUNE_3;
                   err_msg($msg,WARNING);
               }
            }
     elseif ($do=="banip" && $action=="read")
            {
            block_begin(ACP_BAN_IP);
            $getbanned = mysql_query("SELECT * FROM bannedip ORDER BY added DESC") or die(mysql_error());
            $rowsbanned = @mysql_num_rows($getbanned);
            print("<form action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banip&action=write\" name=\"ban\" method=\"post\">");
            print("<center>".BAN_NOTE."</center>");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr><td class=header>".ADDED."</td><td class=header align=left>".FIRST_IP."</td>".
            "<td class=header align=left>".LAST_IP."</td><td class=header align=left>".BY."</td>".
            "<td class=header align=left>".COMMENTS."</td><td class=header>".REMOVE."</td></tr>\n");
            if ($rowsbanned>0)
            {
               while ($arr=mysql_fetch_assoc($getbanned))
               {
               $r2 = mysql_query("SELECT username FROM users WHERE id=$arr[addedby]") or die(mysql_error());
               $a2 = mysql_fetch_assoc($r2);
               $arr["first"] = long2ip($arr["first"]);
               $arr["last"] = long2ip($arr["last"]);
               print("<tr><td class=lista>".get_date_time($arr['added'])."</td><td  class=lista align=left>$arr[first]</td>".
                 "<td align=left class=lista>$arr[last]</td><td align=left class=lista><a href=userdetails.php?id=$arr[addedby]>$a2[username]".
                 "</a></td><td align=left class=lista>$arr[comment]</td><td class=lista><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banip&action=delete&ip=$arr[id]>".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td></tr>\n");
               }
               print("</table>\n");
            }
            else
                print("<tr><td colspan=6 align=center>".NO_BANNED_IPS."</td></tr></table>");
            print("<br /><br />\n<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\">".FIRST_IP." :</td><td class=\"lista\"><input type=\"text\" name=\"firstip\" size=\"15\" /></td>");
            print("<td class=\"header\">".LAST_IP." :</td><td class=\"lista\"><input type=\"text\" name=\"lastip\" size=\"15\" /></td>");
            print("</tr>\n<tr>\n");
            print("<td class=\"header\">".COMMENTS." :</td><td class=\"lista\" colspan=3><input type=\"text\" name=\"comment\" size=\"60\" /></td>");
            print("</tr>\n");
            print("<tr><td align=\"center\" class=\"header\" colspan=4>");
            print("<input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" />");
            print("&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" />");
            print("</td></tr>\n");
            print("</table>\n</form>\n");
            block_end();
            }
     elseif ($do=="banip" && $action=="write")
            {
            if ($_POST['firstip']=="" || $_POST['lastip']=="")
                err_msg(ERROR,NO_IP_WRITE);
              else
                    {
                      //ban the ip for real
                      $firstip = $_POST["firstip"];
                      $lastip = $_POST["lastip"];
                      $comment = $_POST["comment"];
                      $firstip = sprintf("%u", ip2long($firstip));
                      $lastip = sprintf("%u", ip2long($lastip));
                      if ($firstip == -1 || $lastip == -1)
                           err_msg(ERROR,IP_ERROR);
                      else{
                               $comment = sqlesc($comment);
                               $added = sqlesc(time());
                               echo "INSERT INTO bannedip (added, addedby, first, last, comment) VALUES($added, $CURUSER[uid], $firstip, $lastip, $comment)";
                               mysql_query("INSERT INTO bannedip (added, addedby, first, last, comment) VALUES($added, $CURUSER[uid], $firstip, $lastip, $comment)") or die(mysql_error());
                              redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banip&action=read");
                      }
                }
            }
     elseif ($do=="banip" && $action=="delete")
            {

            if ($_GET['ip']=="")
                err_msg(ERROR,INVALID_ID);
            //delete the ip from db
            $id = max(0,$_GET['ip']);
            mysql_query("DELETE FROM bannedip WHERE id=".$id) or die(mysql_error());
            redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banip&action=read");
            }
    elseif ($do=="banemail" && $action=="read")
	{
		block_begin(ACP_BAN_MAILS);
		$getbanned = mysql_query("SELECT * FROM bannedmail ORDER BY added DESC") or die(mysql_error());
		$rowsbanned = @mysql_num_rows($getbanned);
		print("<table class=\"lista\" width=\"100%\" align=\"center\">");
		print("<tr><td class=\"lista\" align=\"center\" colspan=\"5\">".BAN_MAILS_INFO."<br><br></td></tr>");
		print("<tr><td class=header>".ADDED."</td>".
		"<td class=header align=left>".EMAIL."</td><td class=header align=left>".BY."</td>".
		"<td class=header align=left>".COMMENTS."</td><td class=header>".REMOVE."</td></tr>\n");
		if ($rowsbanned>0)
		{
			while ($bmail = mysql_fetch_array($getbanned))
			{
				if ($bmail["addedby"]>0)
				{
					$res = mysql_query("SELECT username FROM users WHERE id='".$bmail["addedby"]."'") or die(mysql_error());
					$quick = mysql_fetch_array($res);
					$addby = "<a href=userdetails.php?id=".$bmail["addedby"].">".$quick["username"]."</a>";
				}
				else
					$addby = SYSTEM;
				
				print("<tr><td class=lista>".get_date_time($bmail["added"]).
				"<td align=left class=lista>".$bmail["email"]."</td><td align=left class=lista>".$addby.
				"</td><td align=left class=lista>".$bmail["comment"]."</td><td class=lista align=\"center\"><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=delete&inc=".$bmail["inc"].">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td></tr>\n");
			}
		}
		else
			print("<tr><td class=\"lista\" align=\"center\" colspan=\"5\">".NO_BAN_MAILS."</td></tr>");
		print("<tr><td class=\"lista\" colspan=\"5\"><br></td></tr>\n");
		print("<form action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=wizzz\" name=\"wizzz\" method=\"post\">");
		print("<tr><td class=\"header\" align=\"center\" colspan=\"5\">".ADD." ".BY." ".USER_LEVEL."</td></tr>");
		print("<tr><td class=\"header\" align=\"left\">". USER_LEVEL ."</td><td class=\"lista\" align=\"left\" colspan=\"4\">");
		print("<select name=\"level\"><option value=\"0\">(".CHOOSE.")</option>");
		$res=mysql_query("SELECT id,level FROM users_level ORDER BY id_level");
		while($row=mysql_fetch_array($res))
		{
			$select="<option value='".$row["id"]."'>".$row["level"]."</option>";
			print $select;
		}
		print("</select></td></tr>");
		print("<tr><td class=\"header\" align=\"center\" colspan=\"5\"><input type=\"submit\" name=\"wizzz\" value=\"".OK."\" /></td></tr></form>");
		print("<tr><td class=\"lista\" colspan=\"5\"><br></td></tr>\n");
		print("<form action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=write\" name=\"ban\" method=\"post\">");
		print("<tr><td class=\"header\" align=\"center\" colspan=\"5\">".ADD."</td></tr>");
		print("<tr><td class=\"header\">".EMAIL."</td><td class=\"lista\" colspan=\"4\"><input type=\"text\" name=\"mail\" size=\"40\" /></td></tr>");
		print("<tr><td class=\"header\">".COMMENTS."</td><td class=\"lista\" colspan=\"4\"><input type=\"text\" name=\"comment\" size=\"60\" /></td></tr>");
		print("<tr><td class=\"header\" align=\"center\" colspan=\"5\">");
		print("<input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" />&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"write\" value=\"".FRM_CANCEL."\" />");
		print("</td></tr>\n");
		print("</table>\n</form>\n");
		block_end();
		print("<br>");
	}
	elseif ($do=="banemail" && $action=="write")
	{
		if ($_POST['mail']=="" || $_POST["comment"]=="")
		{
			err_msg(ERROR,ERR_MISSING_DATA);
			block_end();
			stdfoot();
			exit();
		}
		$mail = $_POST["mail"];
		$comment = sqlesc($_POST["comment"]);
		$added = sqlesc(time());
		
		@mysql_query("INSERT INTO bannedmail (added, addedby, email, comment) VALUES($added, $CURUSER[uid], '$mail', $comment)") or die(mysql_error());
		
		redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=read");
	}
	elseif ($do=="banemail" && $action=="wizzz")
	{
		$wizzz=$_POST["level"];
		block_begin(ACP_BAN_MAILS);
		print("<table class=\"lista\" width=\"100%\" align=\"center\">");
		$counter=0;
		$list = mysql_query("SELECT id, username, email FROM users WHERE id>0 AND id_level='$wizzz' ORDER BY id ASC");
		
		while ($banned=mysql_fetch_array($list))
		{
			if ($banned["email"]!="")
			{
				$res = mysql_query("SELECT inc FROM bannedmail WHERE email LIKE '%".$banned["email"]."%'");
				$exists = mysql_fetch_array($res);
				
				if ($exists)
					print("<tr><td class=\"lista\" align=\"center\"><font color=Lime><b>".$banned["email"]."</b></font> ".WAS_BANNED_ALLREADY."</td></tr>");
				else
				{ 
					$counter++;
					$added = sqlesc(time());
					print("<tr><td class=\"lista\" align=\"center\"><font color=Red><b>".$banned["email"]."</b></font> ".BANNED."</td></tr>");
					@mysql_query("INSERT INTO bannedmail (added, addedby, email, comment) VALUES($added, '0', '$banned[email]', '".USER." <a href=$BASEURL/userdetails.php?id=".$banned["id"].">(".$banned["username"].")</a>')");
				}
			}
		}
		print("<tr><td class=\"lista\" align=\"center\"><br><br> ".FOUND." <b>".$counter."</b> ".NEW_BANNED_MAILS."<br><br></td></tr>");
		print("</table>");
		block_end();
		print("<br>");
	}
	elseif ($do=="banemail" && $action=="delete")
	{
		if ($_GET['inc']=="")
			err_msg(ERROR,BAD_ID);
		//delete the email from db
		mysql_query("DELETE FROM bannedmail WHERE inc='".$_GET['inc']."' LIMIT 1") or die(mysql_error());
		redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=banemail&action=read");
	}
     elseif ($do=="sanity" && $action=="now")
          {
            require_once(dirname(__FILE__)."/include/sanity.php");

            $now = time();

            $res = mysql_query("SELECT last_time FROM tasks WHERE task='sanity'");
            $row = mysql_fetch_row($res);
            if (!$row)
                mysql_query("INSERT INTO tasks (task, last_time) VALUES ('sanity',$now)");
            else
            {
              $ts = $row[0];
              mysql_query("UPDATE tasks SET last_time=$now WHERE task='sanity' AND last_time = $ts");
            }
            do_sanity();
            redirect("admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]);
          }
     else {
          block_begin(WELCOME_ADMINCP);
          $res=mysql_query("SELECT * FROM tasks");
          print("<div  style=\"padding-left: 20px\"><center><br /><br />".ADMINCP_NOTES."</center><br /><br />\nSome statistic/system info:<br />");
          if ($res)
             {
              while ($result=mysql_fetch_array($res))
                    {
                    if ($result["task"]=="sanity")
                       print(LAST_SANITY.get_date_time($result["last_time"])." (".NEXT.": ".get_date_time($result["last_time"]+intval($GLOBALS["clean_interval"])).")&nbsp;<a href=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=sanity&action=now\">Do it now!</a><br />");
                    elseif ($result["task"]=="update")
                       print(LAST_EXTERNAL.get_date_time($result["last_time"])." (".NEXT.": ".get_date_time($result["last_time"]+intval($GLOBALS["update_interval"])).")<br />");
                 }
             }
          // check torrents' folder
          if (file_exists($TORRENTSDIR))
            {
            if (is_writable($TORRENTSDIR))
                  print("<br />\nTorrent's folder $TORRENTSDIR <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
            else
                  print("<br />\nTorrent's folder $TORRENTSDIR is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span><br />\n");
            }
          else
            print("<br />\nTorrent's folder $TORRENTSDIR <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

          // check config.php
          if (file_exists("include/config.php"))
            {
            if (is_writable("include/config.php"))
                      print("config.php <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
            else
                  print("config.php is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
            }
          else // never go here, if not exist got error before...
            print("<br />\nconfig.php file <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

/* language upload turned off...
          // check language folder
          if (file_exists("language"))
            {
              if (is_writable("language"))
                    print("Language's folder <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
              else
                    print("Language's folder is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
            }
          else
            print("<br />\nLanguage's folder <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");
*/
            // check dox folder by pipsta
          if (file_exists("$DOXPATH"))
            {
              if (is_writable("$DOXPATH"))
                    print("Dox folder <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
              else
                    print("Dox folder is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
            }
          else
            print("Dox folder <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

          // check users online storage file
          if (file_exists("addons/guest.dat"))
            {
              if (is_writable("addons/guest.dat"))
                    print("Users Online file (addons/guest.dat) <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
              else
                    print("Users Online file (addons/guest.dat) is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
             }
          else
            print("<br />\nUsers Online file (addons/guest.dat) <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

          // check censored worlds file
          if (file_exists("badwords.txt"))
            {
            if (is_writable("badwords.txt"))
                  print("Censored worls file (badwords.txt) <span style=\"color:#00FF00; font-weight: bold;\">is writable</span><br />\n");
            else
                  print("Censored worls file (badwords.txt) is <span style=\"color:#FF0000; font-weight: bold;\">NOT writable</span> (cannot writing tracker's configuration change)<br />\n");
             }
          else
            print("<br />\nCensored worls file (badwords.txt) <span style=\"color:#FF0000; font-weight: bold;\">NOT FOUND!</span><br />\n");

          print("<br />\n<table border=\"0\">\n");
          print("<tr><td>Server's OS:</td><td>".php_uname()."</td></tr>");
          print("<tr><td>PHP version:</td><td>".phpversion()."</td></tr>");
          $sqlver=mysql_fetch_row(mysql_query("SELECT VERSION()"));
          print("\n<tr><td>MYSQL version:</td><td>$sqlver[0]</td></tr>");
          $sqlver=mysql_stat();
          $sqlver=explode('  ',$sqlver);
          print("\n<tr><td valign=\"top\" rowspan=\"".(count($sqlver)+1)."\">MYSQL stats  : </td>\n");
          for ($i=0;$i<count($sqlver);$i++)
                print(($i==0?"":"<tr>")."<td>$sqlver[$i]</td></tr>\n");
          print("\n</table><br />\n</div>");
          block_end();
          print("<br />");
          include("blocks/serverload_block.php");
         }
     block_end(); //admincp
     }

stdfoot();
//exit();
?>