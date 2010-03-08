<?

require_once ("include/config.php");
require_once ("include/functions.php");

dbconn();

$supcomment = sqlesc($HTTP_POST_VARS["supcomment"]);
$id = $_GET["id"];

$query = "UPDATE users SET supcomment=".$supcomment." WHERE id='".$id."'" or mysql_error();
mysql_query($query);

$returnto = $_POST["returnto"];
header("Location: $BASEURL/$returnto");
?>