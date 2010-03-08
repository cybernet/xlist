<?php
require_once("include/functions.php");
require_once("include/config.php");


dbconn();

if (!$CURUSER || $CURUSER["can_upload"]=="no")
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
$expecttitle = $_POST["expecttitle"];
$descr = $_POST["description"];
$date = $_POST["date"];
$cat = 0+$_POST["category"];

if (!$expecttitle)
  {
      standardheader("Expected");

      block_begin(EXPECTED);
      err_msg(ERROR,NO_NAME);
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$cat = 0+$_POST["category"];
      if ($cat==0)
  {
      standardheader("Expected");

      block_begin(EXPECTED);
      err_msg(ERROR,WRITE_CATEGORY);
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$descr = $_POST["description"];
if (!$descr)
  {
      standardheader("Expected");

      block_begin(EXPECTED);
      err_msg(ERROR,NO_DESCR);
      print ("<br>");
      block_end();
      stdfoot(false);
      exit;
}

$expect = sqlesc($expecttitle);
$descr = sqlesc($descr);
$date = sqlesc($date);
$cat = sqlesc($cat);
mysql_query("INSERT INTO expected (userid, cat, expect, descr, added, date) VALUES($CURUSER[uid], $cat, $expect, $descr, NOW(), $date)") or sqlerr(__FILE__,__LINE__);

write_log("$expect " . EXP_ADD_SUCCES . "");

header("Refresh: 0; url=viewexpected.php");
}

?>