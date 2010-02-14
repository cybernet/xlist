<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");

dbconn();
standardheader("Report Torrent/User");
$takeuser = $_POST["user"];
$taketorrent = $_POST["torrent"];
$takereason = mysql_real_escape_string($_POST["reason"]);
$user = $_GET["user"];
$torrent = $_GET["torrent"];
$reporter = $CURUSER['uid'];
block_begin("Make A Report");       
if ((isset($takeuser)) && (isset($takereason)))
{
$res = mysql_query("SELECT id FROM reports WHERE addedby = '$reporter' AND votedfor = '$takeuser' AND type = 'user'");// or sqlerr();
if (mysql_num_rows($res) == 0)
{
mysql_query("INSERT into reports (addedby,votedfor,type,reason) VALUES ('$reporter','$takeuser','user', '$takereason')");// or sqlerr();
$res2 = mysql_query("SELECT username FROM users WHERE id = '$takeuser'");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[username];
print("<table width=95% class='lista' align='center'><br>");
print("<tr><TD align='center' class='lista'><a href=userdetails.php?id=$takeuser&returnto=reports.php>$name</a><p></p>Successfully Reported.<br>A member of staff will look into the problem as soon as possible.</td><tr>");
print("</table><td></td>");
block_end();
stdfoot();
die();
}
else
{
$res2 = mysql_query("SELECT username FROM users WHERE id = '$takeuser'");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[username];
print("<table width=95% class='lista' align='center'><br>");
print("<tr><td align='center' class='lista'>You have already reported <a href=userdetails.php?id=$takeuser&returnto=reports.php>$name</a></td><tr>");
print("</table><td></td>");
block_end();
stdfoot();
die();
}        
}
if ((isset($taketorrent)) && (isset($takereason)))
{
$res = mysql_query("SELECT id FROM reports WHERE addedby = '$reporter' AND votedfor = '$taketorrent' AND type = 'torrent'");
if (mysql_num_rows($res) == 0){
mysql_query("INSERT into reports (addedby,votedfor,type,reason) VALUES ('$reporter','$taketorrent','torrent', '$takereason')");
$res2 = mysql_query("SELECT filename FROM namemap WHERE info_hash = '$taketorrent'");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[filename];
print("<table width=95% class='lista' align='center'><br>");
print("<tr><TD align='center' class='lista'><a href=details.php?id=$taketorrent&returnto=reports.php>$name</a><p></p>Successfully Reported.<br>A member of staff will look into the problem as soon as possible.</td><tr>");
print("</table><td></td>");
block_end();
stdfoot();
die();
}
else
{
$res2 = mysql_query("SELECT filename FROM namemap WHERE info_hash = '$taketorrent'");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[filename];
print("<table width=95% class='lista' align='center'><br>");
print("<tr><td align='center' class='lista'>You have already reported <a href=details.php?id=$taketorrent&returnto=reports.php>$name</a></td><tr>");
print("</table><td></td>");
block_end();
stdfoot();
die();
}
}
if (isset($user))
{
$res = mysql_query("SELECT username, id_level FROM users WHERE id='$user'");// or sqlerr();
if (mysql_num_rows($res) == 0)
{
print("<table width=95% class='lista' align='center'><br>");    
print("<TD align='center' class='lista'>Invalid UserID.");
print("</table><td></td>");
block_end();
stdfoot();
die();
}
$arr = mysql_fetch_assoc($res);
if ($arr["id_level"] > 7)
{
print("<table width=95% class='lista' align='center'><br>");    
print("<TD align='center' class='lista'>Staff can't be reported.");
print("</table><td></td>");
block_end();
stdfoot();
die();
}
else
{
print("<table width=95% class='lista' align='center'><br>");        
print("<tr><TD align='center' class='lista'>Are you sure you would like to report user <a href=userdetails.php?$arr[id]><b>$arr[username]</b></a>?<br>Please note, this is <b>not</b> to be used to report leechers, we have scripts in place to deal with them<br><br><b>Reason</b><form method=post action=report_this_.php><input type=hidden name=user value=$user><input type=text size=100 name=reason><p></p><input type=submit class=btn value=Confirm></form></td><tr>");  
}
}
if (isset($torrent))
{
$res = mysql_query("SELECT filename FROM namemap WHERE info_hash='$torrent'");
if (mysql_num_rows($res) == 0)
{
print("<table width=95% class='lista' align='center'><br>");    
print("<TD align='center' class='lista'>Invalid TorrentID $torrent");
print("</table><td></td>");  
block_end();
stdfoot();
die();
}
$arr = mysql_fetch_array($res);
print("<table width=95% class='lista' align='center'><br>");
print("<tr><TD align='center' class='lista'>Are you sure you would like to report torrent <a href=details.php?id=$torrent><b>$arr[filename]</b></a>?<br><br><b>Reason</b><form method=post action=report_this_.php><input type=hidden name=torrent value=$torrent><input type=text size=100 name=reason><p></p><input type=submit class=btn value=Confirm></form></td><tr>");
}
print("</table><td></td>");
block_end();
stdfoot();
?>