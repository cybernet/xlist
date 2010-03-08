<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");

dbconn();
if (!$CURUSER || $CURUSER["mod_access"] != "yes")
  {
      err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
      stdfoot();
      exit;
}
standardheader("User/Torrent Reports");
$type = $_GET["type"];
if ($type == "user")
$where = " WHERE type = 'user'";
else if ($type == "torrent")
$where = " WHERE type = 'torrent'";
else
$where = "";
$res = mysql_query("SELECT count(id) FROM reports $where") or die(mysql_error());
$row = mysql_fetch_array($res);
$count = $row[0];
$perpage = 25;
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] . "?type=" . $_GET["type"] . "&" );
block_begin("Reports");
echo $pagertop;
print("<table width=95% class='lista' align='center'>");
print("<tr><TD align='center' class='header'>By</td><TD align='center' class='header'>Reporting</td><TD align='center' class='header'>Type</td><TD align='center' class='header'>Reason</td><TD align='center' class='header'>Dealt With</td><TD align='center' class='header'>Mark As Dealt With</td>");
if ($CURUSER["owner_access"]=="yes")
print("<TD align='center' class='header'>Delete</td>");
print("</tr>");
print("<form method=post action=takedelreport.php>");
$res = mysql_query("SELECT reports.id, reports.dealtwith,reports.dealtby, reports.addedby, reports.votedfor, reports.reason, reports.type, users.username FROM reports INNER JOIN users on reports.addedby = users.id $where ORDER BY id desc $limit");
while ($arr = mysql_fetch_assoc($res))
{
if ($arr[dealtwith])
{
$res3 = mysql_query("SELECT username FROM users WHERE id=$arr[dealtby]");
$arr3 = mysql_fetch_assoc($res3);
$dealtwith = "<font color=green><b>Yes - <a href=userdetails.php?id=$arr[dealtby]&returnto=reports.php><b>$arr3[username]</b></a></b></font>";
}
else
$dealtwith = "<font color=red><b>No</b></font>";
if ($arr[type] == "user")
{
$type = "userdetails";
$res2 = mysql_query("SELECT username FROM users WHERE id=$arr[votedfor]");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[username];
}
else if ($arr[type] == "torrent")
{
$type = "details";
$res2 = mysql_query("SELECT filename FROM namemap WHERE info_hash = '$arr[votedfor]'");
$arr2 = mysql_fetch_assoc($res2);
$name = $arr2[filename];
if ($name == "")
$name = "<b><font color=Red>[Deleted]</font></b>";
}
print("<tr><TD align='center' class='lista'><a href=userdetails.php?id=$arr[addedby]&returnto=reports.php><b>$arr[username]</b></a></td><TD align='center' class='lista'><a href=$type.php?id=$arr[votedfor]&returnto=reports.php><b>$name</b></a></td><TD align='center' class='lista'>$arr[type]</td><TD align='center' class='lista'>$arr[reason]</td><TD align='center' class='lista'>$dealtwith</td><TD align='center' class='lista'><input type=\"checkbox\" name=\"markreport[]\" value=\"" . $arr[id] . "\" /></td>");
if ($CURUSER["owner_access"]=="yes")
print("<TD align='center' class='lista'><input type=\"checkbox\" name=\"delreport[]\" value=\"" . $arr[id] . "\" /></td>");
print("</tr>");
}
$resrep=mysql_query("SELECT * FROM reports");
if (!$resrep || mysql_num_rows($resrep)==0)
print("<td class='lista'></td>");
else
print("<tr><td class='lista' colspan=5></td><TD align='center' class='lista'><input type=submit value=Confirm>");
if ($CURUSER["owner_access"]=="yes")
print("<td class='lista'></td>");
print("</tr>");
print("</table>");
print("</form>");
echo $pagerbottom;
block_end();
stdfoot();
?>
