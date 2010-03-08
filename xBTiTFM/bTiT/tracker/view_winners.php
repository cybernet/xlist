<?php

require_once("include/config.php");
require_once("include/functions.php");

dbconn();

standardheader(VIEW_WINNERS);

block_begin(VIEW_WINNERS);

if(!$CURUSER || $CURUSER["view_news"]!="yes")
{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	block_end();
    stdfoot();
    exit();
}

    $winres=mysql_query("SELECT COUNT(*) FROM lottery_winners ORDER BY id DESC");
    $winnum=mysql_fetch_row($winres);
    $num=$winnum[0];
//$perpage= 25;
    $perpage=(max(0,$CURUSER["postsperpage"])>0?$CURUSER["postsperpage"]:30);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num, "view_winners.php?&");

$query=mysql_query("SELECT * FROM lottery_winners ORDER BY id DESC $limit");

print $pagertop;
print("<table width=90% align=center class=lista>");
print("<tr><td class=header>".USERNAME."</td><td class=header>".WINDATE."</td><td class=header>".PRICE."</td></tr>");
if(mysql_num_rows($query) == 0){
	print("<tr><td class=lista colspan=3 align=center>".NO_WINNERS_YET."</td></tr>");
}
else{
	while($row=mysql_fetch_array($query)){
		print("<tr><td class=lista>".$row['win_user']."</td><td class=lista>".$row['windate']."</td><td class=lista>".makesize($row['price'])."</td></tr>");
	}
}
print("</table>");
print $pagerbottom;
block_end();
stdfoot();
?>