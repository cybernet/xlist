<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/


////////////////////////////////////////////
////    Bónusz pont utalás By virus ///////
//////////////////////////////////////////
require("include/functions.php");
require("include/config.php");


  dbconn();

  standardheader('Bonus Transfer');

block_begin("Bonus Transfer");

 
echo("<center>You can transfer your seed bonus point to another member here..<center><br><br>");


?>
<center>
<form name=transfer method=post action=bonus_taketransfer.php>
<table width=500 cellpadding=5><tr>
<td width=100><b>To User:</b></td>
<td><input type=text name=username size=40><input type=checkbox name=anonym value=anonym> Anonymous</td></tr>
<tr><td width=100><b>How Much Points:</b></td><td><input type=text name=bonuszpont size=40 value=1>&nbsp;
</td></tr>
<tr><td colspan=2><center><input name=submit type=submit value=Transfer></center></td>
</tr></table></form></center>


<?php
block_end();
stdfoot();
?>