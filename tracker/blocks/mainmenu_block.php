

    <table class=lista width=100%>

    <tr>

<?php



   global $CURUSER;



if (!$CURUSER)

   {

       // anonymous=guest

   print("<td class=header align=center>".WELCOME." ".GUEST."\n");

   print("<a href=login.php>(".LOGIN.")</a></td>");

   }

elseif ($CURUSER["uid"]==1)

       // anonymous=guest

    {

   print("<td class=header align=center>".WELCOME." " . $CURUSER["username"] ." \n");

   print("<a href=login.php>(".LOGIN.")</a></td>\n");

    }

else

    {

//donor by monosgeri

$donor_stats = mysql_query("SELECT donor FROM users WHERE id = ".$CURUSER[uid]."");

$donor_stat = mysql_fetch_array($donor_stats);

if ($donor_stat[donor] == "no")

$donor = "";

else

$donor = "&nbsp;<img src=\"images/star.gif\" style=\"border-style: none\">";

//donor by monosgeri

    print("<td class=header align=center>".WELCOME_BACK." ".$CURUSER["username"]."" . Warn_disabled($CURUSER['uid']) . "".$donor." \n");

    print("<a href=logout.php>(".LOGOUT.")</a></td>\n");

    }



print("<td class=header align=center><a href=./>".MNU_INDEX."</a></td>\n");

if ($GLOBALS["dox"]==true && $CURUSER["uid"]>1) 

	{

  print("<td class=header align=center><a href=./dox.php>"."DOX"."</a></td>\n");

   }

if ($CURUSER["view_torrents"]=="yes")

    {

    print("<td class=header align=center><a href=torrents.php>".MNU_TORRENT."</a></td>\n");

	print("<td class=header align=center><a href=viewrequests.php>".REQUESTS."</a></td>\n");
    }
if ($GLOBALS["enable_expected"] == true && $CURUSER["view_torrents"]=="yes")
    {
	print("<td class=header align=center><a href=viewexpected.php>".EXPECTED."</a></td>\n");
	}
if ($GLOBALS["enable_bonus"] == true && $CURUSER["view_torrents"]=="yes")
    {	
	print("<td class=header align=center><a href=seedbonus.php>".SEED_BONUS."</a></td>\n");
	}
if ($CURUSER["view_torrents"]=="yes")

    {	

    print("<td class=header align=center><a href=extra-stats.php>".MNU_STATS."</a></td>\n");

   }

if ($CURUSER["can_upload"]=="yes")

   print("<td class=header align=center><a href=upload.php>".MNU_UPLOAD."</a></td>\n");

if ($GLOBALS["enable_games"]==true && $CURUSER["view_torrents"]=="yes")
   {
   print("<td class=header align=center><a href=games.php>Games</a></td>\n");
   }
if ($GLOBALS["enable_episodes"] == true && $CURUSER["view_torrents"]=="yes")
	{
   print("<td class=header align=center><a href=shows.php>".MNU_EPISODES."</a></td>\n");
	}
if ($CURUSER["view_users"]=="yes")

   print("<td class=header align=center><a href=users.php>".MNU_MEMBERS."</a></td>\n");

if ($CURUSER["view_news"]=="yes")

    {

   print("<td class=header align=center><a href=viewnews.php>".MNU_NEWS."</a></td>\n");

   print("<td class=header align=center><a href=donate.php>".MNU_DONATE."</a></td>\n");
    }
if ($GLOBALS["enable_helpdesk"]==true && $CURUSER["view_news"]=="yes")
   {
   print("<td class=header align=center><a href=helpdesk.php>".CF_HELPDESK."</a></td>\n");
   }
if ($CURUSER["view_news"]=="yes")

   {
   print("<td class=header align=center><a href=staff.php>Staff</a></td>\n");

   }

if ($CURUSER["view_forum"]=="yes")

   {

   if ($GLOBALS["FORUMLINK"]=="" || $GLOBALS["FORUMLINK"]=="internal")

      print("<td class=header align=center><a href=forum.php>".MNU_FORUM."</a></td>\n");

   else

       print("<td class=header align=center><a href=$GLOBALS[FORUMLINK] target=_blank>".MNU_FORUM."</a></td>\n");

    }



?>

   </tr>

   </table>

