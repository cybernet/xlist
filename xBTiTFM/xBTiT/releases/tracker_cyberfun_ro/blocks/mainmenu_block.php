<?php
// CyBerFuN
   global $CURUSER;

?>
<table cellpadding="4" cellspacing="1" width="100%" border="0" align="center" style="border-bottom:0px solid;">
  <tr>
<?php


if (!$CURUSER)
   {

       // anonymous=guest
   print("<td class=\"lista\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME"]." ".$language["GUEST"]."\n");
   print("<a href=\"login.php\">(".$language["LOGIN"].")</a></td>");
/*
   print("<script type=\"text/javascript\">
<!--
window.location = \"http://xlist.ro/\"
//-->
</script>");
*/
   }
elseif ($CURUSER["uid"]==1)
       // anonymous=guest
    {
   print("<td class=\"lista\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME"]." " . $CURUSER["username"] . warn($CURUSER) . " \n");
   print("<a href=\"index.php?page=login\">(".$language["LOGIN"].")</a></td>\n");
/*
print("<script type=\"text/javascript\">
<!--
window.location = \"http://xlist.ro/\"
//-->
</script>");
*/
    }
else
    {
    print("<td class=\"lista\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME_BACK"]." " . $CURUSER["username"] . warn($CURUSER) . " \n");
    print("<a href=\"logout.php\">(".$language["LOGOUT"].")</a></td></tr></table>\n");
/*
print("<script type=\"text/javascript\">
<!--
window.location = \"http://xlist.ro/\"
//-->
</script>");
*/
    }
?>
<table cellpadding="1" cellspacing="1" width="100%">
  <tr>
<?php
print("<td class=\"header\" align=\"center\"><a href=\"index.php\">".$language["MNU_INDEX"]."</a></td>\n");

if ($CURUSER["view_torrents"]=="yes")
    {
    print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=torrents\">".$language["MNU_TORRENT"]."</a></td>\n");
    print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=extra-stats\">".$language["MNU_STATS"]."</a></td>\n");
   }
if ($CURUSER["can_upload"]=="yes")
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=upload\">".$language["MNU_UPLOAD"]."</a></td>\n");
global $CACHE_DURATION;
$row = do_sqlquery("SELECT `activated` FROM `{$TABLE_PREFIX}modules` WHERE `name`='irc'", true, $CACHE_DURATION);
$res = mysql_fetch_assoc($row);
if ($res["activated"] == 'yes' && ($CURUSER["view_users"]=="yes"))
// link in the menu fixed by cybernet / http://tracker.cyberfun.ro/
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=modules&amp;module=irc\">".$language["MNU_IRC"]."</a></td>\n");
/*
if ($CURUSER["view_users"]=="yes")
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=users\">".$language["MNU_MEMBERS"]."</a></td>\n");
if ($CURUSER["view_news"]=="yes")
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=viewnews\">".$language["MNU_NEWS"]."</a></td>\n");
*/
if ($CURUSER["view_users"]=="yes")
{
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=staff\">".$language["STAFF"]."</a></td>\n");
}

if ($CURUSER["view_forum"]=="yes")
   {
   if ($GLOBALS["FORUMLINK"]=="" || $GLOBALS["FORUMLINK"]=="internal" || $GLOBALS["FORUMLINK"]=="smf")
      print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=forum\">".$language["MNU_FORUM"]."</a></td>\n");
   elseif ($GLOBALS["FORUMLINK"]=="smf")
       print("<td class=\"header\" align=\"center\"><a href=\"".$GLOBALS["FORUMLINK"]."\">".$language["MNU_FORUM"]."</a></td>\n");
   else
       print("<td class=\"header\" align=\"center\"><a href=\"".$GLOBALS["FORUMLINK"]."\">".$language["MNU_FORUM"]."</a></td>\n");
    }
 
?>
  </tr>
   </table>
     
