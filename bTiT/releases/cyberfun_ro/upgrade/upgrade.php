<?php
include("../include/config.php");
require_once("../include/functions.php");
global $dbhost, $database, $dbuser, $dbpass;

print("<head><title>BTIT FM PB Edition 1.5.X Upgrade</title>");
print("<link rel=\"stylesheet\" type=\"text/css\" href=\"../style/base/torrent.css\" /></head>");

if (isset($_GET["do"])) $do=$_GET["do"];
else $do = "";
if (isset($_GET["action"]))
$action=$_GET["action"];

if ($do=="152") {
$url="1.5.2/1.5.2_to_1.5.4.sql";
//Dump function
function parse_mysql_dump($url,$dbhost,$database,$dbuser,$dbpass){
	$link = mysql_connect($dbhost, $dbuser, $dbpass);
		if (!$link) {
		   die('Not connected : ' . mysql_error());
		}
		
		// make foo the current db
		$db_selected = mysql_select_db($database, $link);
		if (!$db_selected) {
		   die ('Can\'t use foo : ' . mysql_error());
		}
   $file_content = file($url);
   foreach($file_content as $sql_line){
     if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
	 echo $sql_line . '<br>';
       mysql_query($sql_line);
     }
   }
   	 echo "<br><b>Upgrade is now complete!</b>";
  }
  parse_mysql_dump($url,$dbhost,$database,$dbuser,$dbpass);
}
else if ($do=="153") {
$url="1.5.3/1.5.3_to_1.5.4.sql";
//Dump function
function parse_mysql_dump($url,$dbhost,$database,$dbuser,$dbpass){
	$link = mysql_connect($dbhost, $dbuser, $dbpass);
		if (!$link) {
		   die('Not connected : ' . mysql_error());
		}
		
		// make foo the current db
		$db_selected = mysql_select_db($database, $link);
		if (!$db_selected) {
		   die ('Can\'t use foo : ' . mysql_error());
		}
   $file_content = file($url);
   foreach($file_content as $sql_line){
     if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
	 echo $sql_line . '<br>';
       mysql_query($sql_line);
     }
   }
   	 echo "<br><b>Upgrade is now complete!</b><br><br>";
	 echo "Just one more step to do. . .<br>Go to folder root/upgrade/1.5.3<br>You shall upload the included license.controller.php into the folder /include/client/<br>Then everything is ok";
	 
  }
  parse_mysql_dump($url,$dbhost,$database,$dbuser,$dbpass);
}
else {
print("<table class=lista align=center width=60% colspan=2>
<tr><td class=header align=center colspan=2><h3>Wellcome to BTITFM PB Edition Upgrader</h3></td></tr>
<td class=lista align=center colspan=2><font color=red><b>Please select what version you will upgrade from.</b></font></td></tr>
<form action=\"upgrade.php?&do=152\" name=\"upgrade1\" method=\"post\">
<tr><td class=header align=center colspan=2>Upgrade Options:</td></tr>
<tr><td class=header align=left>Upgrade from 1.5.2 to 1.5.4:</td><td class=lista align=left><input type=submit name=152 size=45 value=Submit></td></tr>
</form>
<form action=\"upgrade.php?&do=153\" name=\"upgrade1\" method=\"post\">
<tr><td class=header align=left>Upgrade from 1.5.3 to 1.5.4:</td><td class=lista align=left><input type=submit name=153 size=45 value=Submit></td></tr>
</table>");
}



?>