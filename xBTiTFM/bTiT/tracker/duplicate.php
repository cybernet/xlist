<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");

dbconn();
error_reporting(0);
standardheader("Duplicate Ips");
if (!$CURUSER || $CURUSER["delete_users"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
block_begin("Duplicate Ips");
print("<table class='lista' align='center'><tr align=center><td class=header width=90>User</td>
<td class=header>Email</td>
<td class=header>Registered</td>
<td class=header>Last access</td>
<td class=header>Downloaded</td>
<td class=header>Uploaded</td>
<td class=header>Ratio</td>
<td class=header>IP</td></tr>\n");


$res = mysql_query("SELECT lip FROM users GROUP BY lip HAVING count(*) > 1") or sqlerr();
$num = mysql_num_rows($res);
if($num==0){
?><tr>No duplicate ips found!</tr>
</table> <?
block_end();
stdfoot();
exit;

}
while($r=mysql_fetch_assoc($res))
{
$ros = mysql_query("SELECT * FROM users WHERE lip='".$r['lip']."' ORDER BY lip") or sqlerr();
$num2 = mysql_num_rows($ros);
//echo $num2;
while($arr = mysql_fetch_assoc($ros))
{
if ($arr['joined'] == '0000-00-00 00:00:00')
$arr['joined'] = '-';
if ($arr['lastconnect'] == '0000-00-00 00:00:00')
$arr['lastconnect'] = '-';
if($arr["downloaded"] != 0)
$ratio = number_format($arr["uploaded"] / $arr["downloaded"], 3);
else
$ratio="---";

$ratio = "<font color=red>$ratio</font>";
$uploaded = makesize($arr["uploaded"]);
$downloaded = makesize($arr["downloaded"]);
$added = substr($arr['joined'],0,10);
$last_access = substr($arr['lastconnect'],0,10);
$ip=long2ip($arr[lip]);
print("<tr bgcolor=\"#$utc\"><td align=left  class=lista><b><a href='userdetails.php?id=" . $arr['id'] . "'>" . $arr['username']."</b></a></td>
<td align=center class=lista>$arr[email]</td>
<td align=center class=lista>$added</td>
<td align=center class=lista>$last_access</td>
<td align=center class=lista>$downloaded</td>
<td align=center class=lista>$uploaded</td>
<td align=center class=lista>$ratio</td>
<td align=center class=lista>$ip</td></tr>\n");

}
} ?>
</table> <?php
block_end();
stdfoot();
?>