<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

////////////////////////////////////////////
////    Transfer Hack By YourzZz   ////////
//////////////////////////////////////////
require("include/functions.php");
require("include/config.php");

  dbconn();

  standardheader('Transfer Traffic');

block_begin(Transfer_Traffic);

 
echo("You can transfer your uploaded MB's, GB's and TB's to another member here.");
{
$url = "index.php";
		  redirect($url);

}

?>
<center>
<form name=transfer method=post action=taketransfer.php>
<table width=500 cellpadding=5><tr>
<td width=100><b>To User:</b></td>
<td><input type=text name=username size=40><input type=checkbox name=anonym value=anonym> Anonymous</td></tr>
<tr><td width=100><b>How Much:</b></td><td><input type=text name=credit size=40 value=1>&nbsp;
<select name=unit>
<option value=mb>MB</option>
<option value=gb>GB</option>  
<option value=tb>TB</option>
</select></td></tr>
<tr><td colspan=2><center><input name=submit type=submit value=Transfer></center></td>
</tr></table></form></center>
<center>Transfer Hack made by <a href="http://www.torrentz.warezroom.net">YourzZz</a></center>

<?php
block_end();
stdfoot();
?>
