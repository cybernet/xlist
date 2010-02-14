<?php
//!miskotes TORRENT REQUEST

require_once("include/functions.php");


dbconn();

standardheader("Vote");

begin_frame("" . VOTES . "");

$requestid = $_GET["id"];
$userid = $CURUSER["uid"];
$res = mysql_query("SELECT * FROM addedrequests WHERE requestid=$requestid and userid = $userid") or sqlerr();
$arr = mysql_fetch_assoc($res);
$voted = $arr;
$cf_already_voted_4_request = "".CF_ALREADY_VOTED_4_REQUEST."";
$cf_succ_voted_4_request = "".CF_SUCC_VOTED_4_REQUEST."";
$cf_back = "".BACK."";

if ($voted) {

print("<br><p>$cf_already_voted_4_request</p><p>$cf_back <a href=viewrequests.php><b>requests</b></a></p><br><br>");
}else {
mysql_query("UPDATE requests SET hits = hits + 1 WHERE id=$requestid") or sqlerr();
@mysql_query("INSERT INTO addedrequests VALUES(0, $requestid, $userid)") or sqlerr();

print("<br><p>$cf_succ_voted_4_request $requestid</p><p>$cf_back<a href=viewrequests.php><b>requests</b></a></p><br><br>");

}

end_frame();

stdfoot();
?>