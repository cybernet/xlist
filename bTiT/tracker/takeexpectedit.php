<?php
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn(true);
		
$id2 = $_POST["id"];
$res = mysql_query("SELECT * FROM expected WHERE id=$id2");
$row = mysql_fetch_array($res);

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["can_upload"] == "yes")
{
	$expecttitle = $_POST["expecttitle"];
	$descr = $_POST["description"];
	$date = $_POST["date"];
	$cat = $_POST["category"];
	$id = $_POST["id"];
	
	if ($expecttitle=="" || $cat==0 || $descr=="" || $date=="")
	{
		standardheader('Edit Expect');
		block_begin(ERROR);
		err_msg(ERROR,ERR_MISSING_DATA);
		print("<br>");
		block_end();
		stdfoot();
		exit();
	}
	
	$expect = sqlesc($expecttitle);
	$descr = sqlesc($descr);
	$date = sqlesc($date);
	$cat = sqlesc($cat);
	
	mysql_query("UPDATE expected SET cat=$cat, expect=$expect, descr=$descr, date=$date WHERE id=$id");
	
	$id = mysql_insert_id();
	
	header("Refresh: 0; url=viewexpected.php");
}
else
{
	standardheader('Edition');
	block_begin(ERROR);
	err_msg(ERROR,ERR_NOT_AUTH);
	print("<br>");
	block_end();
	stdfoot();
	exit();
}

?>