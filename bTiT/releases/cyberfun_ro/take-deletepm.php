<?php
require_once("include/functions.php");
require_once("include/config.php");
dbconn(true);

if (!$CURUSER || $CURUSER["mod_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

if(isset($_POST["delmp"])) {
	$do="DELETE FROM messages WHERE id IN (" . implode(", ", $_POST[delmp]) . ")";
	$res=mysql_query($do);
		$numDone++;
}
standardheader("Done");
block_begin("Done");
echo "<br><B><center>Deleted<BR><BR><a href=msgspy.php>Back</a></center></b>";

block_end();
stdfoot();
?>