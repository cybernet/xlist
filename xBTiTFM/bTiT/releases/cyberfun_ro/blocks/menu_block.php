<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

global $CURUSER, $PRIVATE_TRACKER;

   block_begin(BLOCK_MENU);

   print("<tr><td class=blocklist align=center><a href=./>".MNU_INDEX."</a></td></tr>\n");
   if ($GLOBALS["enable_nforce"] == true)
   {
   print("<tr><td class=blocklist align=center><a href=./nforce.php>".NFORCE."</a></td></tr>\n");
   }
	if ($GLOBALS["dox"] == true && $CURUSER["uid"] > 1) 
	{
	print("<tr><td class=blocklist align=center><a href=./dox.php>"."DOX"."</a></td></tr>\n");
	}
   if ($CURUSER["view_torrents"] == "yes")
      {
      print("<tr><td class=blocklist align=center><a href=torrents.php>".MNU_TORRENT."</a></td></tr>\n");
      print("<tr><td class=blocklist align=center><a href=extra-stats.php>".MNU_STATS."</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=blackjack.php>Blackjack</a></td></tr>\n");
	  }
   if ($GLOBALS["enable_expected"] == true && $CURUSER["view_torrents"] == "yes")
      {
	  print("<tr><td class=blocklist align=center><a href=viewexpected.php>".EXPECTED."</a></td></tr>\n");
      }
   if ($GLOBALS["enable_bonus"] == true && $CURUSER["view_torrents"] == "yes")
      {
	  print("<tr><td class=blocklist align=center><a href=seedbonus.php>Seed Bonus</a></td></tr>\n");
	  }
   if ($CURUSER["view_torrents"] == "yes")
      {
      print("<tr><td class=blocklist align=center><a href=viewrequests.php>".REQUESTS."</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=tickets.php>Lottery</a></td></tr>\n");
      print("<tr><td class=blocklist align=center><a href=donate.php>".MNU_DONATE."</a></td></tr>\n");
	  }
   if ($GLOBALS["enable_helpdesk"] == true && $CURUSER["view_torrents"] == "yes")
	  {
	  print("<tr><td class=blocklist align=center><a href=helpdesk.php>Helpdesk</a></td></tr>\n");
	  }
   if ($CURUSER["view_torrents"] == "yes")
      {
	  print("<tr><td class=blocklist align=center><a href=rules.php>Rules</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=faq.php>FAQ</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=linktous.php>Link To Us</a></td></tr>\n");
	  }
   if ($GLOBALS["enable_episodes"] == true && $CURUSER["view_torrents"] == "yes")
	  {
	  print("<tr><td class=blocklist align=center><a href=shows.php>".MNU_EPISODES."</a></td></tr>\n");
	  }
   if ($CURUSER["can_upload"] == "yes")
      print("<tr><td class=blocklist align=center><a href=upload.php>".MNU_UPLOAD."</a></td>\n");
   if ($CURUSER["view_users"] == "yes")
	  {
      print("<tr><td class=blocklist align=center><a href=users.php>".MNU_MEMBERS."</a></td></tr>\n");
      print("<tr><td class=blocklist align=center><a href=userlevels.php>".USER_LEVEL."</a></td></tr>\n");
   	  }
   if ($CURUSER["view_news"] == "yes")
	  {
      print("<tr><td class=blocklist align=center><a href=viewnews.php>".MNU_NEWS."</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=staff.php>Staff</a></td></tr>\n");
	  print("<tr><td class=blocklist align=center><a href=msn.php>MSN Inviter</a></td></tr>\n");
	  }
if ($GLOBALS["enable_games"] == true && $CURUSER["view_news"] == "yes")
   {
	  print("<tr><td class=blocklist align=center><a href=snake.php>Snake</a></td></tr>\n");
   }
   if ($CURUSER["view_forum"] == "yes")
      {
        if ($GLOBALS["FORUMLINK"] == "" || $GLOBALS["FORUMLINK"] == "internal")
           print("<td class=blocklist align=center><a href=forum.php>".MNU_FORUM."</a></td>\n");
        else
            print("<td class=blocklist align=center><a href=$GLOBALS[FORUMLINK] target=_blank>".MNU_FORUM."</a></td>\n");
      }
   if ($CURUSER["uid"] == 1 && $PRIVATE_TRACKER == false || !$CURUSER)
      print("<tr><td class=blocklist align=center><a href=account.php>".Register."</a></td></tr>\n");
   if ($CURUSER["uid"] == 1 || !$CURUSER)
      print("<tr><td class=blocklist align=center><a href=login.php>".LOGIN."</a></td></tr>\n");
   else
       print("<tr><td class=blocklist align=center><a href=logout.php>".LOGOUT."</a></td></tr>\n");
   block_end();
?>
