<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/

require_once ("include/functions.php");

require_once ("include/config.php");


dbconn();



//global $profit, $required_ratio, $CURUSER, $PM_SENDER;



$pm = $CURUSER["uid"];



standardheader(BLACKJACK);

//Id who can view blackjack.php
//if(!$CURUSER || $CURUSER["view_torrents"]!="no" || $CURUSER["level"]!="Members")
if ($CURUSER["view_torrents"]=="no")
   {
       err_msg(ERROR,NOT_AUTH_VIEW_NEWS);
       stdfoot();
       exit;
}
else
    {


function get_user_name($userid)

{

	$r = mysql_query("select username from users where id=$userid");

	$a = mysql_fetch_array($r);

	return "$a[username]";

}



$mb = $profit*1024*1024*1024; //bet size

if ($_POST["game"])

{

	$cardcountres = mysql_query("select count(id) FROM cards") or sqlerr(__FILE__, __LINE__);

	$cardcountarr = mysql_fetch_array($cardcountres);

$id = $CURUSER["uid"];

$blabla=mysql_query("SELECT downloaded, uploaded, id FROM users WHERE id=".$id."") or die(mysql_error());



$bla = mysql_fetch_array($blabla);

	$cardcount = $cardcountarr[0];

	if ($_POST["game"] == FRM_PLAY)

	{

		if($bla["uploaded"] < $mb)

		{

			err_msg(SORRY." ".$CURUSER["username"],MUST_UPLOAD." ".makesize($mb).".");

			stdfoot();

			exit();

		}



		if ($bla["downloaded"] > 0)

			$ratio = number_format($bla["uploaded"] / $bla["downloaded"], 2);

		elseif ($bla["uploaded"] > 0)

			$ratio = 999;

		else

			$ratio = 0;



		if($ratio < $required_ratio)

		{

			err_msg(SORRY." ".$CURUSER["username"],RATIO_GREAT_THAN." ".$required_ratio.".");

			stdfoot();

			exit();

		}



		$res = mysql_query("select count(*) FROM blackjack WHERE userid=$CURUSER[uid] and status='waiting'");

		$arr = mysql_fetch_array($res);



		if ($arr[0] > 0)

		{

			err_msg(SORRY,WAIT_SOMEONE_PLAYS);

			stdfoot();

			exit();

		}

		else

		{

			$res = mysql_query("select count(*) FROM blackjack WHERE userid=$CURUSER[uid] and status='playing'");

			$arr = mysql_fetch_array($res);



			if ($arr[0] > 0)

			{

				err_msg(SORRY,FINISH_OLD_GAME."<br><form method=\"post\" name=\"form\" action=\"$phpself\"><input type=\"submit\" name=\"game\" value=\"".FRM_CONTINUE."\"></form>");

				stdfoot();

				exit();

			}

		}

		$cardid = rand(1,$cardcount);

		$cardres = mysql_query("select * FROM cards WHERE id=$cardid LIMIT 1") or sqlerr(__FILE__, __LINE__);

		$cardarr = mysql_fetch_array($cardres);

		mysql_query("INSERT INTO blackjack (userid, points, cards) VALUES($CURUSER[uid], $cardarr[points], $cardid)") or sqlerr(__FILE__, __LINE__);

		block_begin(BLACKJACK);

		print("<table class=\"lista\" width=\"100%\">\n");

		print("<form name=\"blackjack\" method=\"post\" action=\"$phpself\">");

		print("<tr><td class=\"lista\" align=\"center\"><br>".image_or_link("images/cards/".$cardarr["pic"],"",$cardarr["points"])."<br><br><b>".POINTS." = $cardarr[points]</b></td></tr>");

		print("<tr><td class=\"header\" align=\"center\"><input type=\"submit\" name=\"game\" value=\"".FRM_CONTINUE."\"></td></tr>");

		print("</form>");

		print("</table>");

		block_end();

		stdfoot();

		exit();

	}

	elseif ($_POST["game"] == FRM_CONTINUE)

	{

		$playeres = mysql_query("SELECT * FROM blackjack WHERE userid=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

		$playerarr = mysql_fetch_array($playeres);

		$showcards = "";

		$cards = $playerarr["cards"];

		$usedcards = explode(" ", $cards);

		$arr = array();

		foreach($usedcards as $array_list)

			$arr[] = $array_list;

		$p = 0;

		$n = 0;

		$a = array();

		foreach($arr as $card_id)

		{

			$used_card = mysql_query("SELECT * FROM cards WHERE id='$card_id'") or sqlerr(__FILE__, __LINE__);

			$used_cards = mysql_fetch_array($used_card);

			$a[$n] = $used_cards["points"];

			$n++;

			$p = $p + $used_cards["points"];

			$showcards .= image_or_link("images/cards/".$used_cards["pic"],"",$used_cards["points"]);

			$i++;
		}

		$cardid = rand(1,$cardcount);

		while (in_array($cardid, $arr))

		{

			$cardid = rand(1,$cardcount);

		}

		$cardres = mysql_query("SELECT * FROM cards WHERE id=$cardid") or sqlerr(__FILE__, __LINE__);

		$cardarr = mysql_fetch_array($cardres);

		$a[$n] = $cardarr["points"];

		$p = 0;

		$p1 = 0;

		foreach($a as $t){
			$p = $p + $t;
		}

		if ($p > 21) {
			foreach($a as $t){
				if ($t==11) {
					$t=1;
				}
				$p1 = $p1 + $t;
			}
			$p = $p1;
		}

		$showcards .= image_or_link("images/cards/".$cardarr["pic"],"",$cardarr["points"]);

		$points = $p;

		$mysqlcards = "$playerarr[cards] $cardid";

		mysql_query("UPDATE blackjack SET points=$points, cards='$mysqlcards' WHERE userid=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

		if ($points == 21)

		{

			$waitres = mysql_query("SELECT count(*) FROM blackjack WHERE status='waiting'");

			$waitarr = mysql_fetch_array($waitres);

			if ($waitarr[0] > 0)

			{

				$r = mysql_query("SELECT * FROM blackjack WHERE status='waiting' ORDER BY date ASC LIMIT 1");

				$a = mysql_fetch_assoc($r);

				if ($a["points"] != 21)

				{

					$winorlose = YOU_WON." ".makesize($mb);

					mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

					mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

					$msg = sqlesc(YOU_LOST." ".makesize($mb)." ".TO." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." 21 ".POINTS.").");

					mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

				}

				else

					$winorlose = NOBODY_WON;



				err_msg(END_GAME, YOU_HAVE." 21 ".POINTS.", ".YOUR_OPPONENT." ".get_user_name($a["userid"]).", ".HE_HAVE." $a[points] ".POINTS.", $winorlose .",false);

				stdfoot();

				exit();

			}

			else

			{

				mysql_query("UPDATE blackjack SET status = 'waiting', date='".get_date_time()."' WHERE userid = $CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				err_msg(END_GAME, YOU_HAVE." 21 ".POINTS.", ".NO_PLAYERS,false);

				stdfoot();

				exit();

			}

		}

		elseif ($points > 21)

		{

			$waitres = mysql_query("SELECT count(*) FROM blackjack WHERE status='waiting'");

			$waitarr = mysql_fetch_array($waitres);

			if ($waitarr[0] > 0)

			{

				$r = mysql_query("SELECT * FROM blackjack WHERE status='waiting' ORDER BY date ASC LIMIT 1");

				$a = mysql_fetch_assoc($r);

				if ($a["points"] == $points)

				{

					$winorlose = NOBODY_WON;

					mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

					mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

					$msg = sqlesc(YOUR_OPPONENT." $CURUSER[username], ".NOBODY_WON.".");

					mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

				}

				elseif ($a["points"] > $points)

				{

					$winorlose = YOU_WON." ".makesize($mb);

					mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

					mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

					$msg = sqlesc(YOU_LOST." ".makesize($mb)." ".TO." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $points ".POINTS.").");

					mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

				}

				elseif ($a["points"] < $points)

				{

					$winorlose = YOU_LOST." ".makesize($mb);

					mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

					mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

					mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

					$msg = sqlesc(YOU_WON." ".makesize($mb)." ".FROM." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $points ".POINTS.").");

					mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, ".$a["userid"].", UNIX_TIMESTAMP(), 'Blackjack', ".$msg.")") or sqlerr(__FILE__, __LINE__);

				}

				err_msg(END_GAME, YOU_HAVE." $points ".POINTS.", ".YOUR_OPPONENT." ".get_user_name($a["userid"]).", ".HE_HAVE." $a[points] ".POINTS.", $winorlose.",false);

				stdfoot();

				exit();

			}

			else

			{

				mysql_query("UPDATE blackjack SET status = 'waiting', date='".get_date_time()."' WHERE userid = $CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				err_msg(END_GAME, YOU_HAVE." $points ".POINTS.", ".NO_PLAYERS,false);

				stdfoot();

				exit();



			}

		}

		else

		{

			block_begin(BLACKJACK);

			print("<table class=\"lista\" width=\"100%\">\n");

			print("<tr><td class=\"lista\" align=\"center\"><br>$showcards<br><br><b>".POINTS." = $points</b></td></tr>");

			print("<form name=\"blackjack\" method=\"post\" action=\"$phpself\">");

			print("<tr><td class=\"header\" align=\"center\"><input type=\"submit\" name=\"game\" value=\"".FRM_CONTINUE."\">&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"game\" value=\"".FRM_STOP."\"></td></tr>");

			print("</form>");

			print("</table>");

			block_end();

			stdfoot();

			exit();

		}

	}

elseif ($_POST["game"] == FRM_STOP)

   {

      $playeres = mysql_query("SELECT * FROM blackjack WHERE userid=$CURUSER[uid]") OR sqlerr(__FILE__, __LINE__);

      $playerarr = mysql_fetch_array($playeres);

      $waitres = mysql_query("SELECT count(*) FROM blackjack WHERE status='waiting' AND userid!=$CURUSER[uid]");

      $waitarr = mysql_fetch_array($waitres);

      if ($waitarr[0] > 0)

      {
         $r = mysql_query("select * FROM blackjack WHERE status='waiting' and userid!=$CURUSER[uid] ORDER BY date ASC LIMIT 1");

			$a = mysql_fetch_assoc($r);

			if ($a["points"] == $playerarr["points"])

			{

				$winorlose = NOBODY_WON;

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOUR_OPPONENT." $CURUSER[username], ".NOBODY_WON.".");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			elseif ($a["points"] < $playerarr["points"] && $a["points"] < 21)

			{

				$winorlose = YOU_WON." ".makesize($mb);

				mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOU_LOST." ".makesize($mb)." ".TO." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $playerarr[points] ".POINTS.").");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			elseif ($a["points"] > $playerarr["points"] && $a["points"] < 21)

			{

				$winorlose = YOU_LOST." ".makesize($mb);

				mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOU_WON." ".makesize($mb)." ".FROM." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $playerarr[points] ".POINTS.").");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			elseif ($a["points"] == 21)

			{

				$winorlose = YOU_LOST." ".makesize($mb);

				mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOU_WON." ".makesize($mb)." ".FROM." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $playerarr[points] ".POINTS.").");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			elseif ($a["points"] < $playerarr["points"] && $a["points"] > 21)

			{

				$winorlose = YOU_LOST." ".makesize($mb);

				mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOU_WON." ".makesize($mb)." ".FROM." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $playerarr[points] ".POINTS.").");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			elseif ($a["points"] > $playerarr["points"] && $a["points"] > 21)

			{

				$winorlose = YOU_WON." ".makesize($mb);

				mysql_query("UPDATE users SET uploaded = uploaded + $mb WHERE id=$CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("UPDATE users SET uploaded = uploaded - $mb WHERE id=$a[userid]") or sqlerr(__FILE__, __LINE__);

				mysql_query("DELETE FROM blackjack WHERE userid=$CURUSER[uid]");

				mysql_query("DELETE FROM blackjack WHERE userid=$a[userid]");

				$msg = sqlesc(YOU_LOST." ".makesize($mb)." ".TO." $CURUSER[username] (".YOU_HAVE." $a[points] ".POINTS.", $CURUSER[username] ".HAD." $playerarr[points] ".POINTS.").");

				mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($pm, $a[userid], UNIX_TIMESTAMP(), 'Blackjack', $msg)") or sqlerr(__FILE__, __LINE__);

			}

			err_msg(END_GAME, YOU_HAVE." $playerarr[points] ".POINTS.", ".YOUR_OPPONENT." ".get_user_name($a["userid"]).", ".HE_HAVE." $a[points] ".POINTS.", $winorlose.",false);

			stdfoot();

			exit();

		}

		else

		{

			mysql_query("UPDATE blackjack SET status = 'waiting', date='".get_date_time()."' WHERE userid = $CURUSER[uid]") or sqlerr(__FILE__, __LINE__);

			err_msg(END_GAME, YOU_HAVE." $playerarr[points] ".POINTS.", ".NO_PLAYERS,false);

			stdfoot();

			exit();

		}

	}

}

else

{

	block_begin(BLACKJACK);

	print("<table class=\"lista\" width=\"100%\">\n");

	print("<tr><td class=\"lista\" align=\"center\">".GAME_RULES."<br />".BET.makesize($mb)."</td></tr>");

	print("<tr><td class=\"header\" align=\"center\"><form name=\"form\" method=\"post\" action=\"$phpself\"><input type=\"submit\" name=\"game\" value=\"".FRM_PLAY."\"></td></tr>");

	print("</table>");

	block_end();
} // End if ($CURUSER["view_torrents"]=="no")
	stdfoot();

}
?>