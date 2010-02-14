<?

require_once ("include/functions.php");
require_once ("include/config.php");
dbconn();

standardheader("User IP Log");
block_begin("User IP Changes");

$id = AddSlashes($_GET["id"]);
if (!isset($id) || !$id)
    die("Error ID");

$pre = mysql_query("SELECT COUNT(*) FROM iplog WHERE uid='$id'") or sqlerr();
$row = mysql_fetch_row($pre);
$count = $row[0];

If($count==0){
Print "<center>";
Print "<table>";
Print "<td width=100 align=center class=lista><b>No IP changes Made for this user</b></td>";
}
else
{
$data = mysql_query("SELECT * FROM iplog WHERE uid='$id' ORDER BY date DESC") or die(mysql_error());
Print "<center>";
Print "<table class=lista>";


?>
<tr>
<th>IP</th>
<th>Date</th>
</tr>
<?
while($info = mysql_fetch_array( $data ))
{
Print "<tr>";
Print "<td width=100 align=center class=lista>".$info["ip"]."</td>";
Print "<td width=100 align=center class=lista>".$info["date"]."</td>";
}
}

Print "</table>";
Print "</center>"; 

block_end();
stdfoot();
die();
?>