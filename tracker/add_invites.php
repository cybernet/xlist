<?php
// casco
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
if (!$CURUSER || $CURUSER["admin_access"] != "yes")
   {
       exit;
   }
standardheader("Send invites");
block_begin(Send_invites);
if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST")
{
	if ($HTTP_POST_VARS["username"] == "" || $HTTP_POST_VARS["invites"] == "")
	{
	err_msg("Error", "Missing form data.");
	}
$username = sqlesc($HTTP_POST_VARS["username"]);
$invites = sqlesc($HTTP_POST_VARS["invites"]);
mysql_query("UPDATE users SET invites=invites+$invites WHERE username=$username") or sqlerr(__FILE__, __LINE__);
//------
$url = "index.php";
redirect($url);
}
$invitesfor = $_GET["invitesfor"];
$invitesuser = $_GET["invitesuser"];
?>
<table border=0 width=95% align=center><tr><td align=left>
<form method=post action=add_invites.php>
<table border=1 cellspacing=0 cellpadding=5 align=center>
<tr><td class=rowhead>User name</td><td><input type=text name=username size=40 value="<? echo $invitesfor; ?>"></td></tr>
<tr><td class=rowhead>Invites</td><td><input type=text name=invites size=40 value="<? echo $invitesuser; ?>"></td></tr>
<tr><td colspan=2 align=center><input type=submit value="Send Invites" class=btn></td></tr>
</table>
</form>
</table>
<?php
block_end();
stdfoot();
?>
