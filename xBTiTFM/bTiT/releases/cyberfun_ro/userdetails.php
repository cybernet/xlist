<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();



standardheader('User Details');



block_begin(USER_DETAILS);



$id=intval(0+$_GET["id"]);

if (!isset($_GET["returnto"])) $_GET["returnto"] = "";

$link=rawurlencode($_GET["returnto"]);



if ($CURUSER["view_users"]!="yes")

   {

       err_msg(ERROR,NOT_AUTHORIZED." ".MEMBERS);

       block_end();

       stdfoot();

       die();

   }

if ($id>1) {

   $res=mysql_query("SELECT users.signature,users.support,users.donor,users.id,users.invited_by,users.invites,users.fel,users.letoltesisebesseg,users.age,users.gender,users.warns,users.disabled,users.disabledby,users.disabledon,users.disabledreason,users.warnremovedby,users.custom_title,users.avatar,users.email,users.cip,users.log,users.username,users.downloaded,users.uploaded,UNIX_TIMESTAMP(users.joined) as joined,UNIX_TIMESTAMP(users.lastconnect) as lastconnect,users_level.level, users.flag, countries.name, countries.flagpic, users.pid, users.time_offset FROM users INNER JOIN users_level ON users_level.id=users.id_level LEFT JOIN countries ON users.flag=countries.id WHERE users.id=$id");

   $num=mysql_num_rows($res);

   if ($num==0)

      {

       err_msg(ERROR,BAD_ID);

       block_end();

       stdfoot();

       die();

       }

   else {

        $row=mysql_fetch_array($res);

      }

}

else

      {

       err_msg(ERROR,BAD_ID);

       block_end();

       stdfoot();

       die();

       }





$utorrents = intval($CURUSER["torrentsperpage"]);



print("<table class=lista width=100%>\n");

//donor by monosgeri

$donor_stats = mysql_query("SELECT donor FROM users WHERE id = ".$id."");

$donor_stat = mysql_fetch_array($donor_stats);

if ($donor_stat[donor] == "no")

$donor = "";

else

$donor = "&nbsp;<img src=\"images/star.gif\" border=\"0\" title=\"\" />";

//donor by monosgeri

print("<tr>\n<td class=header>".USER_NAME."</td>\n<td class=lista>".unesc($row["username"])."".$donor."&nbsp;&nbsp;&nbsp; " . Warn_disabled($id) . "

<a href=usercp.php?do=pm&action=edit&uid=".$CURUSER["uid"]."&what=new&to=".urlencode(unesc($row["username"])).">".image_or_link("$STYLEPATH/pm.png","","PM")."</a>\n");

if ($CURUSER["edit_users"]=="yes")

  print("\n&nbsp;&nbsp;&nbsp<a href=account.php?act=mod&uid=$id&returnto=userdetails.php?id=$id>".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a>");

if ($CURUSER["delete_users"]=="yes")

  print("\n&nbsp;&nbsp;&nbsp<a onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=account.php?act=del&uid=$id&returnto=userdetails.php?id=$id>".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a>");

print("</td>");

if ($row["avatar"] && $row["avatar"]!="")

   print("<td class=lista align=center valign=middle rowspan=4><img width=150 border=0 src=".htmlspecialchars($row["avatar"])." /></td>");

print("</tr>");

if ($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")

{

  print("<tr>\n<td class=\"header\">".EMAIL."</td>\n<td class=\"lista\"><a href=\"mailto:".$row["email"]."\">".$row["email"]."</a></td></tr>\n");

  print("<tr>\n<td class=\"header\">".LAST_IP."</td>\n<td class=\"lista\">".($row["cip"])."&nbsp;&nbsp;&nbsp;<a href=iplog.php?id=$id><img src=images/icon_ip.gif border=0></a></td></tr>\n");

// Connectable by miketyson

 $resuser1=mysql_query("SELECT users.*, peers.port FROM users LEFT JOIN peers ON (users.cip = peers.ip) WHERE users.id=$id");

$rowuser1=mysql_fetch_array($resuser1);

if ($rowuser1["port"] > 1){

print("<tr>\n<td class=\"header\">Poort:</td>\n<td class=lista align=left>&nbsp;&nbsp;&nbsp;&nbsp;");

print ($rowuser1["port"]);}

else{

print("<tr>\n<td class=\"header\">Connectable:</td>\n<td class=lista align=left><font color=red>No active torrents!</font>");}





if ($rowuser1["port"] > 1){

$sockres = @fsockopen($rowuser1["cip"], $rowuser1["port"], $errno, $errstr, 5);

     if (!$sockres) {

	 print("<tr>\n<td class=\"header\">Connectable</td>\n<td class=lista align=left><font color=red>&nbsp;&nbsp;&nbsp;&nbsp;NO</font</td>"); 

    

     } else {

     print("<tr>\n<td class=\"header\">Connectable</td>\n<td class=lista align=left><font color=green>&nbsp;&nbsp;&nbsp;&nbsp;YES</font></td>"); 

    

     }

     @fclose($sockres);}

  

  

   // end Connectable by miketyson

  print("<tr>\n<td class=\"header\">".USER_LEVEL."</td>\n<td class=\"lista\" colspan=\"2\">$row[level]</td></tr>\n");

// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

  print("<tr>\n<td class=header>".INVITATIONS."</td>\n<td class=lista colspan=2>$row[invites]</td></tr>\n");

  if ($row["invited_by"] > 0)

  {

	$res2=mysql_query("SELECT users.id, users.username FROM users WHERE users.id=$row[invited_by]");

	if ($res2)

	{

	$invite=mysql_fetch_row($res2);	

	print("<tr>\n<td class=header>".INVITED_BY."</td>\n<td class=lista colspan=2><a href=userdetails.php?id=$invite[0]>$invite[1]</a></td></tr>\n");

	}

  }

// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

  print("<tr>\n<td class=\"header\">".FRIEND_REPORT."</td>\n<td class=\"lista\" colspan=\"2\">".($CURUSER["id"]>1?"<a href=friendlist.php?do=add&friend_id=".$id."><font color=green>".ADD_TO_FRIENDLIST."</font></a><a href=report.php?user=".$id."><font color=Red>  Report this user</font></a>":"")."</td></tr>\n");

  $colspan=" colspan=2";

}

else

{

  print("<tr>\n<td class=\"header\">".USER_LEVEL."</td>\n<td class=\"lista\">$row[level]</td></tr>\n");

  print("<tr>\n<td class=\"header\">".FRIEND_REPORT."</td>\n<td class=\"lista\">".($CURUSER["id"]>1?"<a href=friendlist.php?do=add&friend_id=".$id."><font color=green>".ADD_TO_FRIENDLIST."</font></a><a href=report.php?user=".$id.">&nbsp;&nbsp;<font color=Red>Report this user</font></a>":"")."</td></tr>\n");

  $colspan="";

}

//Custom Title System Hack Start

if (!$row["custom_title"])

        $title = "<i>".NO_CUSTOM_TITLE."</i>";

else

        $title = unesc($row["custom_title"]);

print("<tr>\n<td class=header>".CUSTOM_TITLE."</td>\n<td class=lista$colspan>".$title."</td></tr>\n");

//Custom Title System Hack Stop

//Support Title System Hack Start

if (!$row["support"])

        $support = "<i>This user is not in Staff</i>";

else

        $support = unesc($row["support"]);

print("<tr>\n<td class=header>Staff Info</td>\n<td class=lista colspan=2>".$support."</td></tr>\n");

//Support System Hack Stop

print("<tr>\n<td class=\"header\">".USER_JOINED."</td>\n<td class=lista colspan=2>".($row["joined"]==0 ? "N/A" : get_date_time($row["joined"]))."</td></tr>\n");

print("<tr>\n<td class=\"header\">".USER_LASTACCESS."</td>\n<td class=lista colspan=2>".($row["lastconnect"]==0 ? "N/A" : get_date_time($row["lastconnect"]))."</td></tr>\n");

// flag hack

print("<tr>\n<td class=\"header\">".PEER_COUNTRY."</td>\n<td class=\"lista\" colspan=\"2\">".($row["flag"]==0 ? "":unesc($row['name']))."&nbsp;&nbsp;<img src=images/flag/".(!$row["flagpic"] || $row["flagpic"]==""?"unknown.gif":$row["flagpic"])." alt=\"".($row["flag"]==0 ? "unknown":unesc($row['name']))."\" /></td></tr>\n");

/// START DOWNLOAD / UPLOADSPEED HACK by VIRUS ///



			$csp=$row["fel"];

			if($csp==0) { $csp = "0"; }



			print("<tr>\n<td class=header>Upload speed</td>\n<td class=\"lista\" colspan=\"2\">$csp kb/s</td></tr>\n");



			$le=$row["letoltesisebesseg"];

			if($le==0) { $le = "0"; }



			print("<tr>\n<td class=header>Download speed</td>\n<td class=\"lista\" colspan=\"2\">$le kb/s</td></tr>\n");

/// END DOWNLOAD / UPLOADSPEED HACK by VIRUS ///

// GENDER/AGE Hack Start

if ($row["gender"]!=0)

	print("<tr>\n<td class=header>".GENDER."</td>\n<td class=\"lista\" colspan=\"2\">".($row["gender"]==1?MALE:FEMALE)."</td></tr>\n");

if ($row["age"]!=0)

	print("<tr>\n<td class=header>".AGE."</td>\n<td class=\"lista\" colspan=\"2\">$row[age]</td></tr>\n");

// GENDER/AGE Hack End

// user's local time

if (date('I',time())==1) {

    $tzu=(date('Z',time())-3600);

} else {

    $tzu=date('Z',time());

}

$offsetu=$tzu-($row["time_offset"]*3600);

print("<tr>\n<td class=\"header\">".USER_LOCAL_TIME."</td>\n<td class=\"lista\" colspan=\"2\">".date("d/m/Y H:i:s",time()-$offsetu)."&nbsp;(GMT".($row["time_offset"]>0?" +".$row["time_offset"]:($row["time_offset"]==0?"":" ".$row["time_offset"])).")</td></tr>\n");

// end user's local time

print("<tr>\n<td class=\"header\">".DOWNLOADED."</td>\n<td class=\"lista\" colspan=\"2\">".makesize($row["downloaded"])."</td></tr>\n");

print("<tr>\n<td class=\"header\">".UPLOADED."</td>\n<td class=\"lista\" colspan=\"2\">".makesize($row["uploaded"])."</td></tr>\n");

if (intval($row["downloaded"])>0)

 {

   $sr = $row["uploaded"]/$row["downloaded"];

   if ($sr >= 4)

     $s = "images/smilies/thumbsup.gif";

   else if ($sr >= 2)

     $s = "images/smilies/grin.gif";

   else if ($sr >= 1)

     $s = "images/smilies/smile1.gif";

   else if ($sr >= 0.5)

     $s = "images/smilies/noexpression.gif";

   else if ($sr >= 0.25)

     $s = "images/smilies/sad.gif";

   else

     $s = "images/smilies/thumbsdown.gif";

  $ratio=number_format($sr,2)."&nbsp;&nbsp;<img src=$s>";

 }

else

   $ratio="oo";



print("<tr>\n<td class=\"header\">".RATIO."</td>\n<td class=\"lista\" colspan=\"2\">$ratio</td></tr>\n");

?>

<tr>

<form name=transfer method=post action=taketransfer.php>

<td class=header>Transfer Traffic:</td>

<td class=lista colspan=2><input type="hidden" name="username" value="<?php echo $row['username']; ?>">

<input type=text name=credit size=1 value=1>&nbsp;

<select name=unit>

<option value=mb>MB</option>

<option value=gb>GB</option>

<option value=tb>TB</option>

</select><input name=submit type=submit value=Transfer></td>

</form></tr>

<?php

// Only show if forum is internal

if ( $GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal' )

   {

   $sql = mysql_query("SELECT * FROM posts INNER JOIN users ON posts.userid = users.id WHERE users.id = " . $id);

   $posts = mysql_num_rows($sql);

   $memberdays = max(1, round( ( time() - $row['joined'] ) / 86400 ));

   $posts_per_day = number_format(round($posts / $memberdays,2),2);

   print("<tr>\n<td class=\"header\"><b>".FORUM." ".POSTS.":</b></td>\n<td class=\"lista\" colspan=\"2\">" . $posts . " &nbsp; [" . sprintf(POSTS_PER_DAY, $posts_per_day) . "]</td></tr>\n");

}

// Signature Hack By kSaMi

   if ($row["signature"] && $row["signature"]!="")

   print("<tr>\n<td class=header><b>Signature:</b></td>\n<td class=lista colspan=2><p style='vertical-align:bottom'>".format_comment($row["signature"])."</p></td></tr>\n");

// End

//User Warning System Hack Start - 23:01 05.06.2006

if ($CURUSER["uid"]=="$id" || $CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")

{



//gather all data required for the Warning Stats

   $get_warns_stats = mysql_query("SELECT * FROM warnings WHERE userid = ".$id." AND active = 'yes'");

   $warnings = mysql_fetch_array($get_warns_stats);

   $warningsnum = mysql_num_rows($get_warns_stats);



   $get_latest_reason = mysql_query("SELECT reason FROM warnings WHERE userid = ".$id." ORDER BY added DESC LIMIT 1");

   $warn_reason = mysql_fetch_assoc($get_latest_reason);



   $get_staff_username_stats = mysql_query("SELECT username FROM users WHERE id = '$warnings[addedby]' ");

   $warnedby = mysql_fetch_array($get_staff_username_stats);



   $get_disabled_username_stats = mysql_query("SELECT id ,username FROM users WHERE id = " . $row["disabledby"]);

   $disabledby = mysql_fetch_array($get_disabled_username_stats);



   $remover = mysql_query("SELECT username FROM users WHERE id = " . $row['warnremovedby']);

   $warnremovedby = mysql_fetch_array($remover);



//begin warning stats

  print("<tr>\n<td class=header align=center colspan=3><b><font color=red>Warning Stats</font></b></td></tr>\n");



//don't show link to warns page if user has no warns

    if ($row["warns"]==0)

  $total_warns = "".$row["warns"]."";

    else

  $total_warns = "<a href=listwarns.php?uid=".$id.">".$row["warns"]."</a>";



//show the total number of warns

  print("<tr>\n<td class=header>Total number of Warnings</td>\n<td class=lista colspan=2>".$total_warns."</td></tr>\n");



//don't show warn stats if user has no warns

  if ("$warningsnum"=="0")

  {

  if ($row['warnremovedby']=="0")

  {

  }

  else

  {



//latest warning removed by start

   print("<tr>\n<td class=header>Latest warning removed by</td>\n<td class=lista colspan=2><a href=\"userdetails.php?id=".$row['warnremovedby']."\">".$warnremovedby["username"]."</a></td></tr>\n");



//latest warning reason

   print("<tr>\n<td class=header>Latest warning reason</td><td class=lista colspan=2>".$warn_reason['reason']."</td></tr>\n");



  }

  }

  else

  {



//received warning duration

    if ($warnings["warnedfor"]==0)

  $duration = "Unlimited warn";

    elseif ($warnings["warnedfor"]==1)

  $duration = "".$warnings['warnedfor']." week warn";

    else

  $duration = "".$warnings['warnedfor']." weeks warn";

  print("<tr>\n<td class=header>Current Warning duration</td>\n<td class=lista colspan=2>".$duration."</td></tr>\n");



//received warning time-frame

    if ($warnings["warnedfor"]==0)

  $period = "This type of warning doesn't have a time frame. It's permanent";

    else

  $period = "".$warnings['added']." - ".$warnings['expires']."";

  print("<tr>\n<td class=header>Current warning period</td>\n<td class=lista colspan=2>".$period."</td></tr>\n");



//shows warn reason

  print("<tr>\n<td class=header>Current warning reason</td>\n<td class=lista colspan=2>".$warnings["reason"]."</td></tr>\n");



//shows who added the warn

  print("<tr>\n<td class=header>Current warn by</td>\n<td class=lista colspan=2><a href=\"userdetails.php?id=".$warnings['addedby']."\">".$warnedby["username"]."</a></td></tr>\n");

  }



//check to see if account is disabled

if ($row["disabled"] == "yes")

{



//print disabled account stats

  print("<tr>\n<td class=header>Account Disabled</td>\n<td class=lista colspan=2><font color=red>Yes</font></td></tr>\n");

  print("<tr>\n<td class=header>Disabled by</td>\n<td class=lista colspan=2><a href=\"userdetails.php?id=".$disabledby["id"]."\">".$disabledby["username"]."</a></td></tr>\n");

  print("<tr>\n<td class=header>Disabled on</td>\n<td class=lista colspan=2>".$row["disabledon"]."</td></tr>\n");

  print("<tr>\n<td class=header>Disable reason</td>\n<td class=lista colspan=2>".$row["disabledreason"]."</td></tr>\n");

}

else

  print("<tr>\n<td class=header>Account Disabled</td>\n<td class=lista colspan=2><font color=green>No</font></td></tr>\n");

}

else

{

}



//display the WarnLevel

$prgsf = $row["warns"];



//display percentage of warn level

$tmp=0+$warntimes;

if ($tmp>0)

{

$wcurr=(0+$row["warns"]);

$prgs=($wcurr/$tmp) * 100;

$prgsfs=floor($prgs);

}

else

$prgsfs=0;

$prgsfs.="%";



$wl1 = $warntimes/4;

$wl2 = $warntimes/3;

$wl3 = $warntimes/2;

$wl4 = $warntimes;

if ("$prgsf" == "0")

$warnlevel = "".image_or_link("images/progress-0.gif","title=".$prgsfs."")."";

if ("$prgsf" > "0" && "$prgsf" <= "$wl1")

$warnlevel = "".image_or_link("images/progress-1.gif","title=".$prgsfs."")."";

if ("$prgsf" > "$wl1" && "$prgsf" <= "$wl2")

$warnlevel = "".image_or_link("images/progress-2.gif","title=".$prgsfs."")."";

if ("$prgsf" > "$wl2" && "$prgsf" <= "$wl3")

$warnlevel = "".image_or_link("images/progress-3.gif","title=".$prgsfs."")."";

if ("$prgsf" > "$wl3" && "$prgsf" < "$wl4")

$warnlevel = "".image_or_link("images/progress-4.gif","title=".$prgsfs."")."";

if ("$prgsf" >= "$wl4")

$warnlevel = "".image_or_link("images/progress-5.gif","title=".$prgsfs."")."";

print("<tr><td class=header>Warn Level</td><td class=lista colspan=2>".$warnlevel."</td>");

//user Warning System Hack Stop

//Admin Controls Hack start
//if ($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
if ($CURUSER["admin_access"]=="yes")
{
   print("<tr>\n<td class=header align=center colspan=3><b>Admin Controls</b></td></tr>\n");

//CustomRow Start
//Log hack start
print("<tr>\n<td class=\"header\"><b>".Log.":</b></td>\n<td class=\"lista\" colspan=\"2\">" . nl2br($row["log"]) . "</td></tr>\n");
//Log hack ends
}
//if ($CURUSER["edit_users"]=="yes" && $CURUSER["owner_access"]=="yes")
if ($CURUSER["owner_access"]=="yes")
{
//Seed Bonus Editor Start
print("<tr>\n<td class=header><b>".SEEDBONUSEDITOR."</b></td>\n<td class=lista colspan=2>".SEED_CLICK." <a href=\"seedbonusedit.php?seeduser=".unesc($row["username"])."&seedbonus=".($row["seedbonus"])."&returnto=userdetails.php?id=".unesc($id)."\">".HERE."</a></td></tr>\n");
print("<tr>\n<td class=header><b>".ADDREMOVESTAT."</b></td>\n<td class=lista colspan=2><a href=addstats.php?nick=".urlencode(unesc($row["username"])).">".image_or_link("images/addstats.png","","Add Stats")."</a></td></tr>\n");
//Seed Bonus Editor Ends
}
//if ($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
if ($CURUSER["admin_access"]=="yes")
{
//Give Invites Start
print("<tr>\n<td class=header><b>Send Invites</b></td>\n<td class=lista colspan=2>To send invites click <a href=\"admininvite.php?invitesfor=".unesc($row["username"])."&invitesuser=".unesc($row["invites"])."\">here</a></td></tr>\n");
//Give Invites Ends
//support Hack Start
   if (!$row["support"])
        $support = "";
   else
        $support = $row["support"];
   print("<tr>\n<td class=header><b>Support for</b></td>\n<td class=\"lista\" colspan=1>");
   print("<form method=post action=support.php?action=changetitle&uid=".unesc($id)."&returnto=userdetails.php?id=".unesc($id).">");
   print("<input type=text name=support size=36 maxlength=50 value=\"".unesc($support)."\"><input type=hidden name=username size=4 value=\"".$row["username"]."\" readonly></td>");
   print("<td class=\"lista\" align=center><input type=\"submit\" value=\"".FRM_CONFIRM."\">&nbsp;&nbsp;<input type=\"reset\" value=\"".FRM_RESET."\">");
   print("</form>");
   print("</td></tr>\n");
//support Hack Stop
//CustomRows Ends
//Custom Title Hack Start
   if (!$row["custom_title"])
        $custom = "";
   else
        $custom = $row["custom_title"];
   print("<tr>\n<td class=header><b>".CUSTOM_TITLE."</b></td>\n<td class=lista colspan=1>");
   print("<form method=post action=title.php?action=changetitle&uid=".unesc($id)."&returnto=userdetails.php?id=".unesc($id).">");
   print("<input type=text name=title size=36 maxlength=50 value=\"".unesc($custom)."\"><input type=hidden name=username size=4 value=\"".$row["username"]."\" readonly></td>");
   print("<td class=lista align=center><input type=\"submit\" value=\"".FRM_CONFIRM."\">&nbsp;&nbsp;<input type=\"reset\" value=\"".FRM_RESET."\">");
   print("</form>");
   print("</td></tr>\n");
//Custom Title Hack Stop
//User Warning System Hack Start - 22:50 05.06.2006
if ($row["warns"] >= "1")
print("<tr>\n<td class=header>Reset Warn Level</td>\n<td class=lista colspan=2>".REPORT_CLICK." <a onclick=\"return confirm('".AddSlashes(WARN_LEVEL_RESET)."')\" href=\"warn.php?action=resetwarnlevel&uid=".unesc($id)."&returnto=userdetails.php?id=".unesc($id)."\">".HERE."</a></td>\n");
if ("$warningsnum"=="0")
{
print("<tr>\n<td class=header>Warn this user<br><font size=1 color=green>Warn period and Reason</font></td>\n<td class=lista colspan=1>");
print("<form method=post action=warn.php?action=warn&id=".unesc($id)."&returnto=userdetails.php?id=".unesc($id).">\n");
print("<select name=\"warnfor\" size=\"1\">\n");
print("<option value=\"7\" selected=\"selected\">".ONE_WEEK."</option>\n");
print("<option value=\"14\">".TWO_WEEKS."</option>\n");
print("<option value=\"21\">".THREE_WEEKS."</option>\n");
print("<option value=\"28\">".FOUR_WEEKS."</option>\n");
print("<option value=\"0\">".PERMANENTLY."</option>\n");
print("</select>&nbsp;<input type=hidden name=username size=10 value=\"".$row["username"]."\" readonly><input type=text name=reason size=14 maxlength=255></td><td class=lista align=center><input type=submit value=\"".FRM_CONFIRM."\" onclick=\"return confirm('".AddSlashes(WARN_CONFIRM)."')\">&nbsp;&nbsp;<input type=reset value=\"".FRM_RESET."\">\n");
print("</form>\n");
print("</td></tr>\n");
}
else
print("<tr>\n<td class=header>Remove Warn</td>\n<td class=lista colspan=2>".REPORT_CLICK." <a onclick=\"return confirm('".AddSlashes(WARN_REMOVE)."')\" href=\"warn.php?action=removewarn&id=".$id."&username=".$row["username"]."&remover=".$CURUSER["uid"]."&returnto=userdetails.php?id=".unesc($id)."\">".HERE."</a></td></tr>\n");
//User Warning System Hack Stop
//Account Disable Hack Start - 15:08 01.08.2006
if ($row["disabled"] == "yes")
{
   print("<form method=post action=warn.php?action=enable&returnto=userdetails.php?id=".$id.">\n");
?>   <tr><td class=header><b><?php echo DISABLE_ACCOUNT ?></b></td>
       <td class=lista><select name="disable" size="1"><option value="no"<?php if($row["disabled"] == "no") echo " selected"?>><?php echo WARN_FALSE; ?></option><option value="yes"<?php if($row["disabled"] == "yes") echo " selected"?>><?php echo WARN_TRUE; ?></option></select>
                                 <input type="hidden" name="name" value="<?php echo $row['username']; ?>">
                                 <input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                                 <td class=lista align=center><input type=submit value=<?php echo FRM_CONFIRM ?> onclick="return confirm(<?php echo "'".AddSlashes(WARN_ENABLE_ACCOUNT)."')"; ?>">&nbsp;&nbsp;<input type=reset value=<?php echo FRM_RESET ?>></td></tr>
<?php
   print("</form>\n");
}
else
{
   print("<form method=post action=warn.php?action=disable&returnto=userdetails.php?id=".$id.">\n");
?>   <tr><td class=header><b><?php echo DISABLE_ACCOUNT ?></b></td>
       <td class=lista><select name="disable" size="1"><option value="yes"<?php if($warns["disabled"] == "yes") echo " selected"?>><?php echo WARN_TRUE; ?></option><option value="no"<?php if($warns["disabled"] == "no") echo " selected"?>><?php echo WARN_FALSE; ?></option></select>
                                 &nbsp;&nbsp;<input type="text" name="reason" size="20"?>
                                 <input type="hidden" name="name" value="<?php echo $row['username']; ?>">
                                 <input type="hidden" name="id" value="<?php echo $id; ?>"></td>
                                 <td class=lista align=center><input type=submit value=<?php echo FRM_CONFIRM ?> onclick="return confirm(<?php echo "'".AddSlashes(WARN_DISABLE_ACCOUNT)."')" ?>">&nbsp;&nbsp;<input type=reset value=<?php echo FRM_RESET ?>></td></tr>
<?php
   print("</form>\n");
}
//Account Disable Hack Stop
}
else
{
}
//Admin Controls Hack stop
//Begin Admin Control Panel
//if ($CURUSER["edit_users"]=="yes" || $CURUSER["mod_access"]=="yes")
if ($CURUSER["mod_access"]=="yes")
{
   print("<tr>\n<td class=header align=center colspan=3><b>".ADMIN_CONTROLS."</b></td></tr>\n");

//Begin User comment
print("<form method=post action=mod_comment.php?id=".unesc($id).">\n");
print("<input type=hidden name=returnto value=userdetails.php?id=".unesc($id).">"); 
   $get_modcomment = mysql_query("SELECT modcomment FROM users WHERE id = ".$id." ");
   $modcomment = mysql_fetch_assoc($get_modcomment);
?>

<tr>
	<td class=header><?php echo USERCOMMENT; ?></td>
	<td align=left class=lista><textarea cols=50 rows=8 name=modcomment><?php echo $modcomment['modcomment']; ?></textarea></td>
	<td valign="bottom" align=center class=lista><input type=submit class=btn value='Submit'></td>
</tr>
<?php
print("</form>");
//end User comment

//support comment
print("<form method=post action=sup_comment.php?id=".unesc($id).">\n");
print("<input type=hidden name=returnto value=userdetails.php?id=".unesc($id).">"); 
	$get_supcomment = mysql_query("SELECT supcomment FROM users WHERE id = ".$id." ");
   	$supcomment = mysql_fetch_assoc($get_supcomment);
?>

<tr>
	<td class=header><?php echo HELPED_FOR; ?></td>
	<td align=left class=lista><textarea cols=50 rows=8 name=supcomment><?php echo $supcomment['supcomment']; ?></textarea></td>
	<td class="lista" align="center" valign="bottom"><input type=submit class=btn value='Submit'></td></tr>
<?php
print("</form>");
//end support comment
}
//End Admin Control Panel

print("</table>");

block_begin(UPLOADED." ".MNU_TORRENT);

$resuploaded = mysql_query("SELECT namemap.info_hash FROM namemap INNER JOIN summary ON namemap.info_hash=summary.info_hash WHERE uploader=$id AND namemap.anonymous = \"false\" ORDER BY data DESC");

$numtorrent=mysql_num_rows($resuploaded);

if ($numtorrent>0)

   {

   list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $numtorrent, $_SERVER["PHP_SELF"]."?id=$id&");

   print("$pagertop");

   $resuploaded = mysql_query("SELECT namemap.info_hash, namemap.filename, UNIX_TIMESTAMP(namemap.data) as added, namemap.size, summary.seeds, summary.leechers, summary.finished FROM namemap INNER JOIN summary ON namemap.info_hash=summary.info_hash WHERE uploader=$id AND namemap.anonymous = \"false\" ORDER BY data DESC $limit");

}

?>

<TABLE width=100% class="lista">

<!-- Column Headers  -->

<TR>

<TD align="center" class="header"><?php echo FILE; ?></TD>

<TD align="center" class="header"><?php echo ADDED; ?></TD>

<TD align="center" class="header"><?php echo SIZE; ?></TD>

<TD align="center" class="header"><?php echo SHORT_S; ?></TD>

<TD align="center" class="header"><?php echo SHORT_L; ?></TD>

<TD align="center" class="header"><?php echo SHORT_C; ?></TD>

</TR>

<?php

if ($resuploaded && mysql_num_rows($resuploaded)>0)

   {

   while ($rest=mysql_fetch_array($resuploaded))

         {

         print("\n<tr>\n<td class=\"lista\"><a href=details.php?id=".$rest{"info_hash"}.">".unesc($rest["filename"])."</td>");

         include("include/offset.php");

         print("\n<td class=\"lista\" align=\"center\">".date("d/m/Y",$rest["added"]-$offset)."</td>");

         print("\n<td class=\"lista\" align=\"center\">".makesize($rest["size"])."</td>");

         print("\n<td align=\"center\" class=\"".linkcolor($rest["seeds"])."\"><a href=peers.php?id=".$rest{"info_hash"}.">$rest[seeds]</td>");

         print("\n<td align=\"center\" class=\"".linkcolor($rest["leechers"])."\"><a href=peers.php?id=".$rest{"info_hash"}.">$rest[leechers]</td>");

         if ($rest["finished"]>0)

         print("\n<td align=\"center\" class=\"lista\"><a href=torrent_history.php?id=".$rest["info_hash"].">" . $rest["finished"] . "</a></td>");

         else

         print ("\n<td align=\"center\" class=\"lista\">---</td>");

         }

         print("\n</table>");

   }

else

    {

    print("<tr>\n<td class=\"lista\" align=\"center\" colspan=\"6\">".NO_TORR_UP_USER."</td>\n</tr>\n</table>");

    }

block_end(); // end uploaded torrents



// active torrents begin - hack by petr1fied - modified by Lupin 20/10/05

block_begin("Active torrents");

?>

<TABLE width=100% class="lista">

<!-- Column Headers  -->

<TR>

<TD align="center" class="header"><?php echo FILE; ?></TD>

<TD align="center" class="header"><?php echo SIZE; ?></TD>

<TD align="center" class="header"><?php echo PEER_STATUS; ?></TD>

<TD align="center" class="header"><?php echo DOWNLOADED; ?></TD>

<TD align="center" class="header"><?php echo UPLOADED; ?></TD>

<TD align="center" class="header"><?php echo RATIO; ?></TD>

<TD align="center" class="header">S</TD>

<TD align="center" class="header">L</TD>

<TD align="center" class="header">C</TD>

</TR>

<?php



if ($PRIVATE_ANNOUNCE)

    $anq=mysql_query("SELECT peers.ip FROM peers INNER JOIN namemap ON namemap.info_hash = peers.infohash INNER JOIN summary ON summary.info_hash = peers.infohash

                WHERE peers.pid='".$row["pid"]."'");

else

    $anq=mysql_query("SELECT peers.ip FROM peers INNER JOIN namemap ON namemap.info_hash = peers.infohash INNER JOIN summary ON summary.info_hash = peers.infohash

                WHERE peers.ip='".($row["cip"])."'");



if (mysql_num_rows($anq)>0)

   {

    list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), mysql_num_rows($anq), $_SERVER["PHP_SELF"]."?id=$id&",array("pagename" => "activepage"));

    if ($PRIVATE_ANNOUNCE)

        $anq=mysql_query("SELECT peers.ip, peers.infohash, namemap.filename, namemap.size, peers.status, peers.downloaded, peers.uploaded, summary.seeds, summary.leechers, summary.finished

                    FROM peers INNER JOIN namemap ON namemap.info_hash = peers.infohash INNER JOIN summary ON summary.info_hash = peers.infohash

                    WHERE peers.pid='".$row["pid"]."' ORDER BY peers.status DESC $limit");

    else

        $anq=mysql_query("SELECT peers.ip, peers.infohash, namemap.filename, namemap.size, peers.status, peers.downloaded, peers.uploaded, summary.seeds, summary.leechers, summary.finished

                    FROM peers INNER JOIN namemap ON namemap.info_hash = peers.infohash INNER JOIN summary ON summary.info_hash = peers.infohash

                    WHERE peers.ip='".($row["cip"])."' ORDER BY peers.status DESC $limit");

    print("<div align=\"center\">$pagertop</div>");

    while ($torlist = mysql_fetch_object($anq))

        {

         if ($torlist->ip !="")

           {

            print("\n<tr>\n<td class=\"lista\"><a href=details.php?id=".$torlist->infohash.">".unesc($torlist->filename)."</td>");

            print("\n<td class=\"lista\" align=\"center\">".makesize($torlist->size)."</td>");

            print("\n<td align=\"center\" class=\"lista\">".unesc($torlist->status)."</td>");

            print("\n<td align=\"center\" class=\"lista\">".makesize($torlist->downloaded)."</td>");

            print("\n<td align=\"center\" class=\"lista\">".makesize($torlist->uploaded)."</td>");

            if ($torlist->downloaded>0)

                 $peerratio=number_format($torlist->uploaded/$torlist->downloaded,2);

            else

                 $peerratio="oo";

            print("\n<td align=\"center\" class=\"lista\">".unesc($peerratio)."</td>");

            print("\n<td align=\"center\" class=\"".linkcolor($torlist->seeds)."\"><a href=peers.php?id=".$torlist->infohash.">$torlist->seeds</td>");

            print("\n<td align=\"center\" class=\"".linkcolor($torlist->leechers)."\"><a href=peers.php?id=".$torlist->infohash.">$torlist->leechers</td>");

            print("\n<td align=\"center\" class=\"lista\"><a href=torrent_history.php?id=".$torlist->infohash.">".$torlist->finished."</td>\n</tr>");

         }

        }

          print("\n</table>");

   } else print("<tr>\n<td class=lista align=center colspan=9>no Active torrents for this user</td>\n</tr>\n</table>");

block_end(); // end active torrents



// history - completed torrents by this user

block_begin("History (snatched torrents)");

?>

<TABLE width=100% class="lista">

<!-- Column Headers  -->

<TR>

<TD align="center" class="header"><?php echo FILE; ?></TD>

<TD align="center" class="header"><?php echo SIZE; ?></TD>

<TD align="center" class="header"><?php echo PEER_CLIENT; ?></TD>

<TD align="center" class="header"><?php echo PEER_STATUS; ?></TD>

<TD align="center" class="header"><?php echo DOWNLOADED; ?></TD>

<TD align="center" class="header"><?php echo UPLOADED; ?></TD>

<TD align="center" class="header"><?php echo RATIO; ?></TD>

<TD align="center" class="header">S</TD>

<TD align="center" class="header">L</TD>

<TD align="center" class="header">C</TD>

</TR>

<?php

mysql_free_result($anq);

$anq=mysql_query("SELECT history.uid FROM history INNER JOIN namemap ON history.infohash=namemap.info_hash WHERE history.uid=$id AND history.date IS NOT NULL ORDER BY date DESC");



if (mysql_num_rows($anq)>0)

   {

    list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), mysql_num_rows($anq), $_SERVER["PHP_SELF"]."?id=$id&",array("pagename" => "historypage"));

    $anq=mysql_query("SELECT namemap.filename, namemap.size, namemap.info_hash, history.active, history.agent, history.downloaded, history.uploaded, summary.seeds, summary.leechers, summary.finished

    FROM history INNER JOIN namemap ON history.infohash=namemap.info_hash INNER JOIN summary ON summary.info_hash=namemap.info_hash WHERE history.uid=$id AND history.date IS NOT NULL ORDER BY date DESC $limit");

    print("<div align=\"center\">$pagertop</div>");

    while ($torlist = mysql_fetch_object($anq))

        {

            print("\n<tr>\n<td class=\"lista\"><a href=details.php?id=".$torlist->info_hash.">".unesc($torlist->filename)."</td>");

            print("\n<td class=\"lista\" align=\"center\">".makesize($torlist->size)."</td>");

            print("\n<td class=\"lista\" align=\"center\">".htmlspecialchars($torlist->agent)."</td>");

            print("\n<td align=\"center\" class=\"lista\">".($torlist->active=='yes'?ACTIVATED:'Stopped')."</td>");

            print("\n<td align=\"center\" class=\"lista\">".makesize($torlist->downloaded)."</td>");

            print("\n<td align=\"center\" class=\"lista\">".makesize($torlist->uploaded)."</td>");

            if ($torlist->downloaded>0)

                 $peerratio=number_format($torlist->uploaded/$torlist->downloaded,2);

            else

                 $peerratio="oo";

            print("\n<td align=\"center\" class=\"lista\">".unesc($peerratio)."</td>");

            print("\n<td align=\"center\" class=\"".linkcolor($torlist->seeds)."\"><a href=peers.php?id=".$torlist->info_hash.">$torlist->seeds</td>");

            print("\n<td align=\"center\" class=\"".linkcolor($torlist->leechers)."\"><a href=peers.php?id=".$torlist->info_hash.">$torlist->leechers</td>");

            print("\n<td align=\"center\" class=\"lista\"><a href=torrent_history.php?id=".$torlist->info_hash.">".$torlist->finished."</td>\n</tr>");

        }

          print("\n</table>");

   } else print("<tr>\n<td class=\"lista\" align=\"center\" colspan=\"10\">no history for this user</td>\n</tr>\n</table>");

block_end(); // end history



print("<br /><br /><center><a href=\"javascript: history.go(-1);\">".BACK."</a></center><br />\n");

block_end();

stdfoot();



?>