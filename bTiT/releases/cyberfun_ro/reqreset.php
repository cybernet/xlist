<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
//!miskotes TORRENT REQUEST

require_once("include/functions.php");

dbconn();

standardheader("Reset Request");

block_begin("Reset");

$requestid = $_GET["requestid"];


$res = mysql_query("SELECT userid, filledby FROM requests WHERE id =$requestid") or sqlerr();
 $arr = mysql_fetch_assoc($res);


if (($CURUSER[uid] == $arr[userid]) || ($CURUSER[uid] == $arr[filledby]))
{

 @mysql_query("UPDATE requests SET filled='', filledby=0 WHERE id =$requestid") or sqlerr();
 
 print("Request " . $arr[request] . " successfuly reseted.");
}
else
 print("Sorry, cannot reset a request when you are not the owner");

block_end();

stdfoot();
?>