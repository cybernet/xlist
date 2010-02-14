<?php

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

if (!$CURUSER || $CURUSER["owner_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

standardheader("");

block_begin(SEEDBONUS_EDITOR);

if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST")
{
if ($HTTP_POST_VARS["username"] == "" || $HTTP_POST_VARS["seedbonus"] == "")
{
err_msg("Error", "Missing form data.");
}
$username = sqlesc($HTTP_POST_VARS["username"]);
$seedbonus = sqlesc($HTTP_POST_VARS["seedbonus"]);


mysql_query("UPDATE users SET seedbonus=$seedbonus WHERE username=$username") or sqlerr(__FILE__, __LINE__);

}
$seeduser = $_GET["seeduser"];
$seedbonus = $_GET["seedbonus"];

?>

<table border=0 width=95% align=center><tr><td align=left width=70%>
<br>

<form method=post action=seedbonusedit.php>
<table border=1 cellspacing=0 cellpadding=5 align=center>
<tr><td class=rowhead>User name</td><td><input type=text name=username size=40 value="<? echo $seeduser;?>"></td></tr>
<tr><td class=rowhead>Seedbonus</td><td><input type=seedbonus name=seedbonus size=40 value="<? echo $seedbonus;?>"></td></tr>

<tr><td colspan=2 align=center><input type=submit value="Confirm" class=btn></td></tr>
</table>
<table align=center width=100%><br>
<td align=center width=100%><a href=users.php>Back</a></table>
</form>
</table>
<?

   block_end();

stdfoot();

?>