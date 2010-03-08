<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

standardheader("Expect Details");

$id = $_GET["id"];
$res = mysql_query("SELECT * FROM expected WHERE id = $id") or sqlerr();
$num = mysql_fetch_array($res);

$s = $num["expect"];

block_begin("Expected: $s");

print("<center><table width=550 border=0 cellspacing=0 cellpadding=3>\n");

$url = "expectedit.php?id=$id";
 if (isset($_GET["returnto"])) {
         $addthis = "&amp;returnto=" . urlencode($_GET["returnto"]);
         $url .= $addthis;
         $keepget .= $addthis;
 }
 $editlink = "a href=\"$url\"";
print("<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
print("<br><tr><td align=left class=header><B>" . Name . ": </B></td><td class=lista width=70% align=left>$num[expect]");
if ($CURUSER["uid"] == $num["userid"] || $CURUSER["can_upload"] == "yes")
{
print("&nbsp;&nbsp;&nbsp;<".$editlink."><b>[" . EDIT . "]</b></a></td></tr>");
}
else
{
}

print("</td></tr>");

if ($num["descr"])
print("<tr><td align=left class=header><B>" . DESCRIPTION . ": </B></td><td class=lista width=70% align=left>".format_comment(unesc($num[descr]))."</td></tr>");
print("<tr><td align=left class=header><B>" . ADDED  . ": </B></td><td class=lista width=70% align=left>$num[added]</td></tr>");
print("<tr><td align=left class=header><B>" . EXPECTED  . ": </B></td><td class=lista width=70% align=left>$num[date]</td></tr>");

$cres = mysql_query("SELECT username FROM users WHERE id=$num[userid]");
   if (mysql_num_rows($cres) == 1)
   {
     $carr = mysql_fetch_assoc($cres);
     $username = "$carr[username]";
   }
print("<tr><td align=left class=header><B>" . UPLOADER . ":</B></td><td class=lista align=left><a href=userdetails.php?id=$num[userid]><b>$username</b></td></tr>");

if ($CURUSER["can_upload"] == "yes")
{
		print("<tr><td class=lista align=center width=100% colspan='2'><form method=get action=expected.php#add><input type=submit value=\"".ADD_EXPECTED."\"></form></td></tr>");
		print("</table>");
}

block_end();
stdfoot();
die;

?>
