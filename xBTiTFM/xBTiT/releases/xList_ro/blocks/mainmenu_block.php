<?php

// CyBerFuN.ro & xList.ro

// xList .::. Main Menu Block
// http://tracker.cyberfun.ro/
// http://www.cyberfun.ro/
// http://xList.ro/
// Modified By cybernet2u

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
   }
elseif ($CURUSER["uid"] == 1)
       // anonymous=guest
    {
   print("<td class=\"lista\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME"]." " . $CURUSER["username"] . warn($CURUSER) . " \n");
   print("<a href=\"index.php?page=login\">(".$language["LOGIN"].")</a></td>\n");
    }
else
    {
    print("<td class=\"lista\" align=\"center\" style=\"text-align:center;\">".$language["WELCOME_BACK"]." " . $CURUSER["username"] . warn($CURUSER) . " \n");
    print("<a href=\"logout.php\">(".$language["LOGOUT"].")</a></td></tr>\n");
      // freeleech hack

    $query = do_sqlquery("SELECT *, UNIX_TIMESTAMP(`free_expire_date`) AS `timestamp` FROM `{$TABLE_PREFIX}files` WHERE `external`='no'", true);
    $row = mysql_fetch_array($query);


 if($row["free"] == "yes")
    { $freec = "red";
     $till = ' To ';
     $post = date("l jS F Y \a\\t g:i a",$row["timestamp"]);
      }

else
   {  $freec = "blue";
      $till = '';
      $post = ' Not Today';
      }



print("<tr><td align='center'>Free Leech:<font color='$freec'>$till".ucfirst($post)."</font></td></tr></table>\n");

// end freeleech hack
    }
?>
<table cellpadding="1" cellspacing="1" width="100%">
  <tr>
<?php
if ($CURUSER["uid"] == 1)
   {
print("<td class=\"header\" align=\"center\"><a href=\"index.php\">".$language["MNU_INDEX"]."</a></td>\n");
print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=login\">".$language["LOGIN"]."</a></td>\n");
print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=signup\">".$language["ACCOUNT_CREATE"]."</a></td>\n");
print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=recover\">".$language["RECOVER_PWD"]."</a></td>\n");
   }
else {
print("<td class=\"header\" align=\"center\"><a href=\"index.php\">".$language["MNU_INDEX"]."</a></td>\n");

if ($CURUSER["view_torrents"] == "yes")
    {
    print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=torrents\">".$language["MNU_TORRENT"]."</a></td>\n");
//  print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=extra-stats\">".$language["MNU_STATS"]."</a></td>\n");
    }
if ($CURUSER["can_upload"] == "yes")
print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=upload\">".$language["MNU_UPLOAD"]."</a></td>\n");

global $CACHE_DURATION;
$row = do_sqlquery("SELECT `activated` FROM `{$TABLE_PREFIX}modules` WHERE `name`='irc'", true, $CACHE_DURATION);
$res = mysql_fetch_assoc($row);
/*
if ($res["activated"] == 'yes' && ($CURUSER["view_users"] == "yes"))
// link in the menu fixed by cybernet / http://tracker.cyberfun.ro/
// http://xlist.ro/
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=modules&amp;module=irc\">".$language["MNU_IRC"]."</a></td>\n");

if ($CURUSER["view_users"] == "yes")
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=users\">".$language["MNU_MEMBERS"]."</a></td>\n");

if ($CURUSER["view_news"] == "yes")
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=viewnews\">".$language["MNU_NEWS"]."</a></td>\n");
*/
if ($CURUSER["view_users"] == "yes")
{
   print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=staff\">".$language["STAFF"]."</a></td>\n");
}

if ($CURUSER["view_forum"] == "yes")
   {
   if ($GLOBALS["FORUMLINK"] == "" || $GLOBALS["FORUMLINK"] == "internal" || $GLOBALS["FORUMLINK"] == "smf")
      print("<td class=\"header\" align=\"center\"><a href=\"index.php?page=forum\">".$language["MNU_FORUM"]."</a></td>\n");
   elseif ($GLOBALS["FORUMLINK"] == "smf")
       print("<td class=\"header\" align=\"center\"><a href=\"".$GLOBALS["FORUMLINK"]."\">".$language["MNU_FORUM"]."</a></td>\n");
   else
       print("<td class=\"header\" align=\"center\"><a href=\"".$GLOBALS["FORUMLINK"]."\">".$language["MNU_FORUM"]."</a></td>\n");
    }
} 
?>
  </tr>
   </table>
