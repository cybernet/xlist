<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
standardheader("Online");
if (!$CURUSER || $CURUSER["view_news"]=="no")
  {
       err_msg(ERROR,NEED_TO_BE_AN_MEMBER);
       stdfoot();
       exit;
}
else
    {
block_begin("Members Who Have Visited In The Last 24 Hours");

$sql = "SELECT users_level.prefixcolor AS prefixcolor, users_level.suffixcolor AS suffixcolor, users.id AS id, users.username AS username FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id>1 AND lastconnect BETWEEN (NOW() - INTERVAL 1 DAY )AND (NOW()) ORDER BY username";
$qry=mysql_query($sql);
print("<tr><td align=center class=blocklist>");
$counter = 0;
while ($res=mysql_fetch_array($qry))
{
   print("<a href=userdetails.php?id=$res[id]>".unesc($res["prefixcolor"]).unesc($res["username"]).unesc($res["suffixcolor"])."</a> ");
   $counter++;
}
print("<br><br>Total Users: ".$counter);
print("</td></tr>");

block_end();

stdfoot();
}
?>