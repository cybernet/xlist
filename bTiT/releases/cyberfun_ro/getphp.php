<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn(true);

if (!$CURUSER || $CURUSER["admin_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
else
    {

	block_begin('PHP Editor');
	?>
<html>
<head>
</head>
<center>
<form action="phpeditor.php?$bestand" method="get">
<?php echo PHP_FILE;?>: <input type="text" name="bestand" />&nbsp;<input type="submit" value="<?php echo PHP_OPEN;?>" /> </form>
</center>
</html>
<?php
$bestand = $_GET['bestand'];
	block_end();
	}
?> 