<?php

//!miskotes TORRENT REQUEST

require_once("include/functions.php");
require_once("include/config.php");


dbconn();

       $maxallowed = $max_req_allowed;
       $res3 = mysql_query("SELECT * FROM requests WHERE userid=$CURUSER[uid]") or mysql_error();
       $arr3 = mysql_num_rows($res3);
       $numreqs = $arr3;

if ($numreqs >= $maxallowed)
  {
      standardheader("Make a Request");
      err_msg(ERROR,"Sorry, You just reached your max number of Requests: <b>$maxallowed</b>");
      print ("<br>");
      stdfoot(false);
      exit;
}

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
{
	standardheader("NOT AUTHORIZED");
	block_begin(ERROR);
	err_msg(ERROR,ERR_NOT_AUTH);
	print("<br>");
	block_end();
	stdfoot();
	exit();
}
else
{
$requesttitle = $_POST["requesttitle"];
$descr = $_POST["description"];
$cat = 0+$_POST["category"];

if (!$requesttitle)
  {
      standardheader("REQUESTS");

      block_begin("REQUESTS");
      err_msg(ERROR,"NO NAME!");
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$cat = 0+$_POST["category"];
      if ($cat==0)
  {
      standardheader("REQUESTS");

      block_begin("REQUESTS");
      err_msg(ERROR,"You must choose category!");
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$descr = $_POST["description"];
if (!$descr)
  {
      standardheader("REQUESTS");

      block_begin("REQUESTS");
      err_msg(ERROR,"NO DESCRIPTION!");
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$request = sqlesc($requesttitle);
$descr = sqlesc($descr);
$cat = sqlesc($cat);

mysql_query("INSERT INTO requests (hits, userid, cat, request, descr, added) VALUES(1,$CURUSER[uid], $cat, $request, $descr, NOW())") or sqlerr(__FILE__,__LINE__);

$id = mysql_insert_id();

@mysql_query("INSERT INTO addedrequests VALUES(0, $id, $CURUSER[uid])") or sqlerr();

write_log("$request was added to the Request section");

header("Refresh: 0; url=viewrequests.php");
}

?>