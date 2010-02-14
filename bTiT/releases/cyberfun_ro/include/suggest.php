<?php
require_once("functions.php");
dbconn(false);
$type = $_GET["a"];
    if (strlen($_GET['q']) > 3) {
	$q = str_replace(" ",".",sqlesc("%".$_GET['q']."%"));
	$q2 = str_replace("."," ",sqlesc("%".$_GET['q']."%"));
	  if ($type == "user")
	    {
		$result = mysql_query("SELECT username FROM users WHERE username LIKE {$q} OR username LIKE {$q2} ORDER BY username ASC LIMIT 0,10;");
		$search = "username";
	    }
	  elseif ($type == "torrent")
	    {
		$result = mysql_query("SELECT filename FROM namemap WHERE filename LIKE {$q} OR filename LIKE {$q2} ORDER BY filename ASC LIMIT 0,10;");
		$search = "filename";
	    }
	if (!empty($result))
	  {
	    if (mysql_num_rows($result) > 0) {
		    for ($i = 0; $i < mysql_num_rows($result); $i++) {
			    $name = mysql_result($result,$i,$search);
			    $name = trim(str_replace("\t","",$name));
			    print("".$name."");
			    if ($i != mysql_num_rows($result)-1) {
				    print "\r\n";
			    }
		    }
	    }
	  }
    }
?>