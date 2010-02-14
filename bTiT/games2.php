<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
if ($CURUSER["view_news"]=="yes")
{
standardheader('Games');
block_begin("Games");
global $CURUSER, $STYLEPATH;
?>

<?php
print("<table class=lista border=1 cellspacing=0 cellpadding=0 align=center><tr>"); 

print("<td class=lista width=502 valign=top>"); 

print("<table class=lista width=502 border=1>"); 
?>
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>




<center>
<p>Games<br>
<span class="style3">Please Choose A Game!</span> </p>
</center>
<br>
<?php 

$resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);

$rowuser=mysql_fetch_array($resuser);

//print("</table></td>"); 
print("<td width=15% align=left><table align=left border=1>"); 

print("<tr><td class=lista align=center width=150>$CURUSER[username]'s Avatar</td></tr>"); 
if ($CURUSER[avatar]) 
print("<tr><td><center><img width=125 src=" . htmlspecialchars($CURUSER["avatar"]) . "></center></td></tr>"); 
else 
print("<tr><td><center><img width=125 align=center src=images/no_avatar.gif></center></td></tr>");
print("<tr><td align=center border=0><font color=green><small>Up:</small> ".makesize($rowuser['uploaded']));
print("<tr></td>\n<td align=center border=0><font color=red><small>Down:</small> ".makesize($rowuser['downloaded']));
print("</tr></td>");

print("</table>");
print("<table width=270 height=270 align=top>");
print("<tr><td class=\"lista\" colspan=\"0\"><a href=mustafa.php>Play Mustafa</a></tr></td>");
print("<tr><td class=\"lista\" colspan=\"0\"><a href=chess.php>Play Chess</a></tr></td>");
print("<tr><td class=\"lista\" colspan=\"0\"><a href=snake.php>Play Snake</a></tr></td>");
print("<tr><td class=\"lista\" colspan=\"0\"><a href=hangman.php>Play Hangman</a></tr></td>");
print("<tr><td class=\"lista\" colspan=\"0\"><a href=spy.php>Play Spy</a></tr></td>");
print("</table>");

print("</td></tr></table>"); 

}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}

block_end();
stdfoot();
?>