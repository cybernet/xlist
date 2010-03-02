<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();


global $CURUSER;
if (!$CURUSER || $CURUSER["view_torrents"] == "no")
   {
    // do nothing
   }
else
    {

global $SYLEPATH, $BASEURL;
block_begin("Invite A Friend");
begin_table();
print("\n<table class=\"lista\" align=\"center\" width=\"100%\">");
?>
<td align="center">
<form action="sendinvite.php" method="POST">
<b>Your Name</b><br>
<input type="text" name="your" size=20>
<br>
<br><b>Friends Name</b><br>
<input type="text" name="friend" size=20>
<br>
<br><b>Friends Email</b><br>
<input type="text" name="email" size=20>
<br>
<p><input type="submit" value=" Send Invitation ">
</form>

<?php
end_table();
block_end();
}
?>
