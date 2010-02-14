<?
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/config.php");
require_once ("include/functions.php");

dbconn();

$modcomment = sqlesc($HTTP_POST_VARS["modcomment"]);
$id = $_GET["id"];

$query = "UPDATE users SET modcomment=".$modcomment." WHERE id='".$id."'" or mysql_error();
mysql_query($query);

$returnto = $_POST["returnto"];
header("Location: $BASEURL/$returnto");
?>