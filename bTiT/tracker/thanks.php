<?
require_once("include/functions.php");
require_once("include/config.php");
dbconn(true);

global $BASEURL;

$userid = $CURUSER["uid"];
$username = $CURUSER["username"];
$infohash = $_POST["infohash"];
if (isset($userid) && isset($infohash))
{
mysql_query("INSERT INTO thanks VALUES ('$infohash', '$userid')");
header("Location: $BASEURL/details.php?id=$infohash&thanks=1");
// @mysql_query("INSERT INTO comments (added,text,ori_text,user,info_hash) VALUES (NOW(),\"[img]$BASEURL/images/thankyou.gif[/img]\",\"[img]$BASEURL/images/thankyou.gif[/img]\",\"$username\",\"" . $infohash . "\")");
}
else {
header("Location: $BASEURL/details.php?id=$infohash");
}
?>
