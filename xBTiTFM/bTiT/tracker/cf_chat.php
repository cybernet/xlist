<?php

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

if ($CURUSER["view_news"]=="yes")
{
standardheader("Chat");
block_begin("Chat");

print ("<center><script type=\"text/javascript\" src=\"http://www.geesee.com/sys/geeseejs.ashx?chatid=31708\"></script></center>");

}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
block_end();
stdfoot();
?>
