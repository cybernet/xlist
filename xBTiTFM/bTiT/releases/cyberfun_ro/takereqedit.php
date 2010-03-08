<?

//!miskotes TORRENT REQUEST

require_once("include/functions.php");

dbconn(true);
		
$id2 = $_POST["id"];
$res = mysql_query("SELECT * FROM requests WHERE id=$id2");
$row = mysql_fetch_array($res);

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["id_level"] >= "7")
{
	$id = $_POST["id"];
	$requesttitle = $_POST["requesttitle"];
	$descr = $_POST["description"];
	$cat = $_POST["category"];
	
	if ($requesttitle=="" || $cat==0 || $descr=="")
	{
		standardheader('Edition');
		block_begin(ERROR);
		err_msg(ERROR,ERR_MISSING_DATA);
		print("<br>");
		block_end();
		stdfoot();
		exit();
	}
	
	$request = sqlesc($requesttitle);
	$descr = sqlesc($descr);
	$cat = sqlesc($cat);
	
	mysql_query("UPDATE requests SET cat=$cat, request=$request, descr=$descr where id=$id");
	
	$id = mysql_insert_id();
	
	header("Refresh: 0; url=viewrequests.php");
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