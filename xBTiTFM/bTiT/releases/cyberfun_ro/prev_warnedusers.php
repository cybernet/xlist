<?php
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if (!$CURUSER || $CURUSER["admin_access"]=="no" || $CURUSER["edit_users"]=="no")
   {
	require_once "include/functions.php";
	require_once "include/config.php";
	block_begin(ERROR);
	err_msg("Error", "Get a freakin' life and stop trying to hack the tracker !<br>Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot();
	exit();
   }
else
   {

block_begin("".PREV_WARNED_USERS."");

//Per Page Listing Limitation Start - 00:06 24.06.2006
$numwarns = mysql_query("SELECT COUNT(*) FROM users LEFT JOIN warnings ON users.id=warnings.id WHERE warnings.active='no'");
$row = mysql_fetch_array($numwarns);
$count = $row[0]; 
$perpage = $GLOBALS["warnsppage"];
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count,  "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=prevwarnedu&".$addparams);
//Per Page Listing Limitation Stop

//$res = mysql_query("SELECT users.id, username, users.warns FROM users LEFT JOIN warnings ON users.id=warnings.userid WHERE users.warns>'0' AND active='no' ORDER BY warns DESC $limit") or sqlerr();
$res = mysql_query("SELECT id, username, warns FROM users WHERE warns>'0' ORDER BY warns DESC $limit") or sqlerr();
$num = mysql_num_rows($res);

print("<table border=0 width=100% cellspacing=2 cellpadding=0>");

//Per Page Listing Limitation Start - 00:07 24.06.2006
if ($count > $perpage)
print("<tr><td class=lista align=center colspan=10><br>".$pagertop."</td></tr>");
//Per Page Listing Limitation Stop


print("<tr><td class=header align=center>".WARNED_USERNAME."</td><td class=header align=center>".WARNED_TOTAL_WARNS."</td><td class=header align=center>".PREV_REACHED_MAX."</td></tr>");

    if ("$num"=="0")
	print("<tr><td class=lista align=center colspan=10>".PREV_NO_USERS."</td></tr>");
    else
       {
          while ($arr = mysql_fetch_array($res))
          {
            $res2 = mysql_query("SELECT active FROM warnings WHERE userid='$arr[id]'") or sqlerr();
            $arr2 = mysql_fetch_array($res2);

             if ($arr2["active"]=="yes")
              {
              }
             else
              {
		if ($arr["warns"]>=$warntimes)
		  $active = "<font color=red><b>".YES."</b></font>";
		else
		  $active = "<font color=green><b>".NO."</b></font>";
       		print("<tr><td class=lista align=center><a href=userdetails.php?id=".$arr['id'].">".$arr['username']."</a></td><td class=lista align=center><a href=listwarns.php?uid=".$arr['id'].">".$arr['warns']."</a></td><td class=lista align=center>".$active."</td></tr>");
              }
          }
       }
print("<tr><td class=header align=center colspan=3><a href=\"javascript: history.go(-1);\">".BACK."</a></td></tr>");

//Per Page Listing Limitation Start - 00:08 24.06.2006
if ($count > $perpage)
print("<tr><td class=lista align=center colspan=10><br>".$pagerbottom."</td></tr>");
//Per Page Listing Limitation Stop

print("</table>");

block_end();
print ("<br>");
//stdfoot(false);
   }
?>