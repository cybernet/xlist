<?php
require_once("include/functions.php");
dbconn();
if ($CURUSER["id_level"]<8)
{
err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
stdfoot();
exit;
}
if (isset($_POST[markreport])){
$res = mysql_query ("SELECT id FROM reports WHERE dealtwith=0 AND id IN (" . implode(", ", $_POST[markreport]) . ")");
while ($arr = mysql_fetch_assoc($res))
mysql_query ("UPDATE reports SET dealtwith=1, dealtby = $CURUSER[uid] WHERE id = $arr[id]") or sqlerr();
}
if (isset($_POST[delreport])){
$res = mysql_query ("DELETE FROM reports WHERE id IN (" . implode(", ", $_POST[delreport]) . ")");
}
header("Refresh: 0; url=reports.php");
?>