<?php

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

// Gets user id - if no user id sets it to 'error'

if (isset($_GET["uid"]))
$userid = max(0,$_GET["uid"]);
else
$userid="error";

// sql to get username for header and block

$warnsql = mysql_query("SELECT username FROM users WHERE id='".$userid."'") or sqlerr();

// check to see if username exists - if not then display error message

if (!mysql_num_rows($warnsql)){
    standardheader("Invalid warning list");
    block_begin("Invalid warning list");
    err_msg(ERROR, "Invalid User");
    Exit();
}

// sets up header and block with correct username

$warnname = mysql_fetch_array($warnsql);
standardheader($warnname['username']."'s warning list");
block_begin($warnname['username']."'s warning list");

// query to pull warning data

$showsql = mysql_query("SELECT warnings.*, username FROM warnings LEFT JOIN users ON warnings.addedby=users.id WHERE userid=$userid") or sqlerr();

//check to see if user is owner of account or if user has admin_access

if (!$CURUSER || $CURUSER["admin_access"]=="yes" || $CURUSER["edit_users"]=="yes" || $CURUSER["uid"]=="$userid"){
print("<table border=0 width=100% cellspacing=2 cellpadding=0>");
print("<tr><td class=header align=center>".WARNED_ID."</td><td class=header align=center>".WARNED_DATE_ADDED."</td><td class=header align=center>".WARNED_EXPIRATION."</td><td class=header align=center>".WARNED_DURATION."</td><td class=header align=center>".WARNED_REASON."</td><td class=header align=center>".WARNED_BY."</td><td class=header align=center>".WARNED_ACTIVE."</td></tr>");

// check if user has any warnings

if (!mysql_num_rows($showsql))
print("<tr><td class=lista align=center colspan=7>".WARNED_USER_NOTWARNED."</td></tr>");
else{

// print warnings

while ($arr = mysql_fetch_array($showsql)){
if ($arr["warnedfor"] == 0)
$duration = "".WARNED_UNLIMITED."";
elseif ($arr['warnedfor'] == 1)
$duration = "".$arr['warnedfor']."".WARNED_WEEK."";
else
$duration = "".$arr['warnedfor']."".WARNED_WEEKS."";

if ($arr["active"]=="no")
$active = "<font color=green><b>".NO."</b></font>";
else
$active = "<font color=red><b>".YES."</b></font>";

print("<tr><td class=lista align=center>".$arr['id']."</td><td class=lista align=center>".$arr['added']."</td><td class=lista align=center>".$arr['expires']."</td><td class=lista align=center>".$duration."</td><td class=lista align=center>".unesc($arr['reason'])."</td><td class=lista align=center><a href=userdetails.php?id=".$arr['addedby'].">".$arr['username']."</a></td><td class=lista align=center>".$active."</td></tr>");
}}

print("<tr><td class=header align=center colspan=7><a href=\"javascript: history.go(-1);\">".BACK."</a></td></tr>");
print("</table>");
}

// not authorised to view

else{
    err_msg(ERROR, ERR_NOT_AUTH);
}

block_end();
print ("<br>");
stdfoot(false);
?>
