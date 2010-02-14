<?php
global $CURUSER;

if (!$CURUSER || $CURUSER["view_users"]=="no")
{
	// do nothing
}
else
{
	block_begin(GAMES);
		print("<table class=\"lista\" width=\"100%\">");
		print("<tr><td class=\"blocklist\" align=\"center\"><a href=blackjack.php>".BLACKJACK."</a></td></tr>\n");
		print("</table>");
	block_end("");
}
?>