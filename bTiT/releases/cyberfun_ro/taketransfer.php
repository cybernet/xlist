<?
////////////////////////////////////////////
////    Transfer Hack By YourzZz   ////////
//////////////////////////////////////////
require("include/functions.php");
require("include/config.php");


  dbconn();

  standardheader('Transfering');

if ($HTTP_SERVER_VARS["REQUEST_METHOD"] != "POST")
  stderr("Error", "Method");


$resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);
$rowuser=mysql_fetch_array($resuser);

$username = $_POST["username"];

if (!$username)
stderr ("Error","You didn't enter a name!");

$credit = $_POST["credit"];

if ($credit < 1 || (!$CURUSER))
stderr ("Error","Not a positive value");

$mb = 1024*1024;
$gb = 1024*1024*1024;
$tb = 1024*1024*1024*1024;

if ($_POST["unit"] == 'mb') $credit = $credit*$mb;
elseif ($_POST["unit"] == 'gb') $credit = $credit*$gb;
elseif ($_POST["unit"] == 'tb') $credit = $credit*$tb;

if ($rowuser['uploaded'] < $credit)
stderr ("Error","You can't give away sh*t when you don't have any!");

$query = mysql_query("SELECT id,uploaded FROM users WHERE username = '$username'") or sqlerr(__FILE__, __LINE__);
$res = mysql_fetch_assoc($query);
$receiver = $res["id"];
$sender = $rowuser["id"];

if (!$receiver)
stderr ("Error","Woops, can't find anyone with the name $receiver");
mysql_query("UPDATE users SET uploaded = uploaded + $credit WHERE id = '$receiver'") or sqlerr(__FILE__, __LINE__);
mysql_query("UPDATE users SET uploaded = uploaded - $credit WHERE id = '$sender'") or sqlerr(__FILE__, __LINE__);

if ($_POST["anonym"] != 'anonym') {
$msg = sqlesc("" . $CURUSER['username']. " gave you some upload.");
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($sender, $receiver, NOW(), 'Transfer', $msg)") or sqlerr(__FILE__, __LINE__);  }
else {
$msg = sqlesc("An anonymous user gave you some upload");
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES(0, $receiver, NOW(), 'Transfer', $msg)") or sqlerr(__FILE__, __LINE__);  }

header("Refresh: 0; url=index.php");

?>