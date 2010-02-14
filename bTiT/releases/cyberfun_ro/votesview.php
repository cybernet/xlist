<?

//!miskotes TORRENT REQUEST

require "include/functions.php";

dbconn(false);

$requestid = $_GET[requestid];

$res2 = mysql_query("select count(addedrequests.id) from addedrequests inner join users on addedrequests.userid = users.id inner join requests on addedrequests.requestid = requests.id WHERE addedrequests.requestid =$requestid") or die(mysql_error());
$row = mysql_fetch_array($res2);
$count = $row[0];


$perpage = 50;

 list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] ."?" );

$res = mysql_query("select users.id as userid,users.username, users.downloaded,users.uploaded, requests.id as requestid, requests.request from addedrequests inner join users on addedrequests.userid = users.id inner join requests on addedrequests.requestid = requests.id WHERE addedrequests.requestid =$requestid $limit") or sqlerr();

standardheader("Votes");

$res2 = mysql_query("select request from requests where id=$requestid");
$arr2 = mysql_fetch_assoc($res2);

block_begin("" . VOTES . ": <a href=reqdetails.php?id=$requestid>$arr2[request]</a>");
print("<p align=center>" . VOTE_FOR_THIS . " <a href=addrequest.php?id=$requestid><b>" . REQUEST . "</b></a></p>");

//echo $pagertop;

if (mysql_num_rows($res) == 0)
 print("<p align=center><b>" . NOTHING_FOUND . "</b></p>\n");
else
{
 print("<center><table width=99% class=lista align=center cellpadding=3>\n");
 print("<tr><td class=header1>" . USERNAME . "</td><td class=header1 align=left>" . UPLOADED . "</td><td class=header1 align=left>" . DOWNLOADED . "</td>".
   "<td class=header1 align=left>" . RATIO . "</td>\n");

 while ($arr = mysql_fetch_assoc($res))
 {

if ($arr["downloaded"] > 0)
{
       $ratio = number_format($arr["uploaded"] / $arr["downloaded"], 3);
       //$ratio = "<font color=" . get_ratio_color($ratio) . ">$ratio</font>";
    }
    else
       if ($arr["uploaded"] > 0)
         $ratio = "Inf.";
 else
  $ratio = "---";
$uploaded = makesize($arr["uploaded"]);
$joindate = "$arr[added] (" . get_elapsed_time(sql_timestamp_to_unix_timestamp($arr["added"])) . " ago)";
$downloaded = makesize($arr["downloaded"]);
if ($arr["enabled"] == 'no')
 $enabled = "<font color = red>No</font>";
else
 $enabled = "<font color = green>Yes</font>";

 print("<tr><td class=lista><a href=userdetails.php?id=$arr[userid]><b>$arr[username]</b></a></td><td align=left class=lista>$uploaded</td><td align=left class=lista>$downloaded</td><td align=left class=lista>$ratio</td></tr>\n");
 }
 print("</table></center><BR><BR>\n");
}

block_end();

stdfoot();

?>