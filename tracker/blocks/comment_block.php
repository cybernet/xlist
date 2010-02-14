<?php

global $CURUSER;
if (!$CURUSER || $CURUSER == "1")
{
	//do nothing
}
else
{
	block_begin("Latest 5 Torrent Comments");

		// HACK NEW TORRENT COMMENT
		if(!isset($_COOKIE['lasttorrentcomment']))
		{
			$data = time();
			$expire = time() + 3600 * 24 * 7; // 7 jours
			setcookie('lasttorrentcomment', $data, $expire);
			$LastTorrentComment = 0;
		}
		else
		{
			$LastTorrentComment = abs(intval($_COOKIE['lasttorrentcomment']));
		}
		// FIN HACK NEW TORRENT COMMENT

		$mq=mysql_query("SELECT added,text,user,info_hash FROM comments ORDER BY added DESC LIMIT 5");

		print("<table class=\"lista\" width=\"100%\" align=\"center\" cellpadding=\"4\" cellspacing=\"4\">");

			while ($rq=mysql_fetch_assoc($mq))
			{
				// HACK NEW TORRENT COMMENT
				if ($LastTorrentComment <= strtotime($rq["added"])) 
				{
					$is_new5 = image_or_link("images/new.gif","","");
				}
				else
				{
					$is_new5='';
				}
				// FIN HACK NEW TORRENT COMMENT

				print("<tr><td class=\"lista\">");

					if (empty($rq["text"]))
					{
						print("Message vide ?!?");
					}
					else
					{
						print(image_or_link("images/multipage.gif","","")."&nbsp;");

						$ren = mysql_query("SELECT namemap.info_hash, namemap.filename, namemap.url FROM namemap WHERE info_hash='".$rq["info_hash"] ."'");
						$row = mysql_fetch_array($ren);

						$user = mysql_query("SELECT users.id, users.username FROM users WHERE username='".$rq["user"] ."'");
						$name = mysql_fetch_array($user);

						print("<b><a href=\"details.php?id=".$rq["info_hash"]."#comments\">"."New comment"."</a></b>&nbsp;".$is_new5."<br />");
						print("<span style=\"font-style: italic;\">On Torrent <a href=details.php?id=".$rq["info_hash"].">".$row["filename"]."</a> By,<a href=userdetails.php?id=".$name["id"].">".$name["username"]."</a> On ".date("d/m/Y H:i:s", strtotime($rq["added"]))."</span></td>");
					}

				}

		print("</tr></table>");
	block_end();
}

?>
