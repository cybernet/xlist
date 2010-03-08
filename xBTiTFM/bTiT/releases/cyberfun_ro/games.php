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
print("<table border=1 cellspacing=0 cellpadding=0 align=center><tr>"); 

print("<td width=502 valign=top>"); 

print("<table width=502 border=1>"); 
?>
<style type="text/css">
<!--
.style3 {font-size: 12px}
-->
</style>




<center>
<p>Games<br>
<span class="style3">Please Choose A Game From The Right</span> </p>
</center>
<tr><td 

<br>
<tr><td>
</form> <iframe src="" name="games" width="570" height="570" scrolling="no"></iframe></td></tr>
<marquee onmouseover=this.stop() onmouseout=this.start() scrollAmount=2.0 direction=across width='100%' height='75'> 
</table></td> 

<?php 

//print("</table></td>"); 
print("<td width=150 valign=top><table border=1>"); 

print("<tr><td class=colhead width=150 height=18>$CURUSER[username]'s Avatar</td></tr>"); 
if ($CURUSER[avatar]) 
print("<tr><td><img width=125 src=" . htmlspecialchars($CURUSER["avatar"]) . "></td></tr>"); 
else 
print("<tr><td><img width=125 src=pic/default_avatar.gif></td></tr>"); 
print("<tr><td class=colhead width=150 height=18>Games</td></tr>"); 

print("<tr><td align=left>&nbsp;&nbsp;<a href=chess.php>Play Chess</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=mustafa.php>Play Mustafa</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=snake.php>Play Snake</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=hangman.php>Play Hangman</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/commando.swf target=games>Play commando</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/sonic.swf target=games>Play sonic</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/battlefield2.swf target=games>Play battlefield2</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/dirtbike.swf target=games>Play dirtbike</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/kittencannon.swf target=games>Play kittencannon</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/supermariobros.swf target=games>Play supermariobros</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/miniputt.swf target=games>Play MiniPutt</td></tr>"); 
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/basejumping.swf target=games>Play Base Jumping</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/gridlock.swf target=games>Play Gridlock</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/flashpoker.swf target=games>Play Poker</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/3dworm.swf target=games>Play 3D Worm</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://gamesloth.us/hosted/classicbreakout.swf target=games>Play Breakout</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://www.onemorelevel.com/games3/archer.swf target=games>Play Archer</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://209.200.250.151/manual/topgun6.swf target=games>Play Top Gun</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://www.onemorelevel.com/games/Pacman.swf target=games>Play PacMan</td></tr>");
print("<tr><td align=left>&nbsp;&nbsp;<a href=http://www.onemorelevel.com/games/snakes5.dcr target=games>Play Snake 3D</td></tr>");

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