<?
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
//!miskotes TORRENT REQUEST

require "include/functions.php";


dbconn();

//loggedinorreturn();

standardheader("Request Details");
$id = $_GET["id"];
$res = mysql_query("SELECT * FROM requests WHERE id = $id") or sqlerr();
$num = mysql_fetch_array($res);

$s = $num["request"];

block_begin("Request: $s");

print("<center><table width=550 border=0 cellspacing=0 cellpadding=3>\n");

//Edit request by RippeR change by miskotes
$url = "reqedit.php?id=$id";
 if (isset($_GET["returnto"])) {
         $addthis = "&amp;returnto=" . urlencode($_GET["returnto"]);
         $url .= $addthis;
         $keepget .= $addthis;
 }
 $editlink = "a href=\"$url\"";
print("<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
print("<br><tr><td align=left class=header><B>" . REQUEST . ": </B></td><td class=lista width=70% align=left>$num[request]");
if ($CURUSER["uid"] == $num["userid"] || $CURUSER["edit_torrents"]== "yes")
{
print("&nbsp;&nbsp;&nbsp;<".$editlink."><b>[edit]</b></a></td></tr>");
}
else
{
}

print("</td></tr>");

if ($num["descr"])
print("<tr><td align=left class=header><B>" . INFO . ": </B></td><td class=lista width=70% align=left>".format_comment(unesc($num[descr]))."</td></tr>");
print("<tr><td align=left class=header><B>" . ADDED  . ": </B></td><td class=lista width=70% align=left>$num[added]</td></tr>");

$cres = mysql_query("SELECT username FROM users WHERE id=$num[userid]");
   if (mysql_num_rows($cres) == 1)
   {
     $carr = mysql_fetch_assoc($cres);
     $username = "$carr[username]";
   }
print("<tr><td align=left class=header><B>Added By:</B></td><td class=lista align=left><a href=userdetails.php?id=$num[userid]><b>$username</b></td></tr>");


if ($num["filled"] == NULL)
{
print("<tr><td align=left class=header><B>" . VOTE_FOR_THIS . " </B></td><td class=lista width=50% align=left><a href=addrequest.php?id=$id><b>" . Vote . "</b></a></td></tr>");

if ($CURUSER["can_upload"]=="yes")
{
			print("<tr><td class=header align=left width=30%><b>How To Fill the Request?</b> </td><td class=lista align=left width=70%>Type <b>potpun</b> full torrent URL, i.e. http://www.mysite.com/torrents-details.php?id=134... (you can only copy/paste from another window) or modify existing URL of torrent ID...</td></tr>");
			print("<tr><td class=lista align=center width=100% colspan='2'><form method=get action=reqfilled.php>");
			print("<input type=text size=80 name=filledurl value=\"TYPE-DIRECT-TORRENT-URL-HERE\"><br><input type=submit value=\"".SEND."\">");
			print("<input type=hidden value=$id name=requestid>");
			print("</form>");
			print("<hr><form method=get action=requests.php#add><input type=submit value=\"".ADD_REQUESTS."\"></form></td></tr>");
		}
}
		else
			print("<tr><td class=lista align=center width=100% colspan='2'><form method=get action=requests.php#add><input type=submit value=\"".ADD_REQUESTS."\"></form></td></tr>");
		print("</table>");
block_end();
stdfoot();
die;

?>