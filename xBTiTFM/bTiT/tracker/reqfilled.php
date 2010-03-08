<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
//!miskotes TORRENT REQUEST

require_once("include/functions.php");

dbconn();

standardheader("Fill Request");
if ($CURUSER["can_upload"]=="no")
   {
    // do nothing
   }
else
    {
begin_frame(".REQUEST_FILLED.");
		print("<table align='center' width=550 class=lista><tr><td class=lista align=center width=100%>");

$filledurl = $_GET["filledurl"];
$requestid = $_GET["requestid"];
$filldate =  date('Y-m-d H:i:s');


$res = mysql_query("SELECT users.username, requests.userid, requests.request FROM requests inner join users on requests.userid = users.id where requests.id = $requestid") or sqlerr();
 $arr = mysql_fetch_assoc($res);

$res2 = mysql_query("SELECT username FROM users where id =" . $CURUSER[uid]) or sqlerr();
 $arr2 = mysql_fetch_assoc($res2);


$msg = "".REQUEST.": [url=$BASEURL/reqdetails.php?id=" . $requestid . "][b]" . $arr[request] . "[/b][/url], is filled by [url=$BASEURL/userdetails.php?id=" . $CURUSER[uid] . "][b]" . $arr2[username] . "[/b][/url].

Torrent can be downloaded from the following link:
[url=" . $filledurl. "][b]" . $filledurl. "[/b][/url]

Do not forget to add credits to the uploader.
If for some reason thi is not what you want, please reset this by clicking [url=$BASEURL/reqreset.php?requestid=" . $requestid . "][b]THIS!!![/b][/url].

[b]DO NOT[/b] click the link unless you are sure you want it.";
$subject= "Your torrent request<i>!!!</i>";

       mysql_query ("UPDATE requests SET filled = '$filledurl', fulfilled= '$filldate', filledby = $CURUSER[uid] WHERE id = $requestid") or sqlerr();

mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($CURUSER[uid], $arr[userid], UNIX_TIMESTAMP(), " . sqlesc($subject) . ", " . sqlesc($msg) . ")") or sqlerr(__FILE__, __LINE__);

print("<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
print("<br><BR><div align=left>".REQUEST." " . $arr[request] . " has now been successfuly filled with: <a href=$filledurl>$filledurl</a>.  User <a href=account-details.php?id=$arr[userid]><b>$arr[username]</b></a> has automaticly PMed upon upload.  <br>
<br><b>Oh, this is an accident?</b><br><br>No worries, only <a href=reqreset.php?requestid=$requestid><b>CLICK HERE</b></a> to reset this request.<br><b>NE</b> do not click unless that is what you want to do.<br><BR></div>");
print("<BR><BR>Thanks for filling out this request :)<br><br>Go back to<a href=viewrequests.php><b> REQUESTS</b></a>");
		print("</td></tr></table>");
}
block_end();
stdfoot();
?>