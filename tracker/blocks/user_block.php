<?php
global $CURUSER, $user, $PRIVATE_TRACKER;

         block_begin("".BLOCK_USER."");

         if (!$CURUSER || $CURUSER["id"]==1)
            {
            // guest-anonymous, login require
            ?>
            <form action="login.php" name="login" method="post">
            <table class="lista" border="0" align="center">
            <tr><td align="right" class="header"><?php echo USER_NAME?>:</td><td class="lista"><input type="text" size="10" name="uid" value="<?php $user ?>" maxlength="40" /></td></tr>
            <tr><td align="right" class="header"><?php echo USER_PWD?>:</td><td class="lista"><input type="password" size="10" name="pwd" maxlength="40" /></td></tr>
            <tr><td colspan="2"  class="header" align="center"><input type="submit" value="<?php echo FRM_LOGIN?>" /></td></tr>
            <tr>
			<?php
			if ($PRIVATE_TRACKER)
			{
				print("<td class=\"header\" align=\"center\" colspan=\"2\"><a href=\"recover.php\">".RECOVER_PWD."</a></td>");
			}
			else
			{
				print("<td class=\"header\" align=\"center\"><a href=\"account.php\">".ACCOUNT_CREATE."</a></td>");
				print("<td class=\"header\" align=\"center\"><a href=\"recover.php\">".RECOVER_PWD."</a></td>");
			}
			?>
			</tr>
            </table>
            </form>
            <?php
            }
         else
             {
             // user information
             $style=style_list();
             $langue=language_list();
             print("\n<tr><td align=center class=blocklist>".USER_NAME.":  " .unesc($CURUSER["username"])."" . Warn_disabled($CURUSER['uid']) . "</td></tr>\n");
             print("<tr><td align=center class=blocklist>".USER_LEVEL.": ".$CURUSER["level"]."</td></tr>\n");
             $resmail=mysql_query("SELECT COUNT(*) FROM messages WHERE readed='no' AND receiver=$CURUSER[uid] AND delbyreceiver='no'");
             if ($resmail && mysql_num_rows($resmail)>0)
                {
                 $mail=mysql_fetch_row($resmail);
                 if ($mail[0]>0)
                    print("<td class=blocklist align=center><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a> (<font color=\"#FF0000\"><b>$mail[0]</b></font>)</td>\n");
                 else
                     print("<td class=blocklist align=center><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a></td>\n");
                }
             else
                 print("<tr><td align=center>".NO_MAIL."</td></tr>");
//yours seedwanted torrents hack begin
 
 $sql = "SELECT summary.info_hash as hash, summary.seeds, summary.leechers, summary.finished, namemap.filename, namemap.url,   UNIX_TIMESTAMP(namemap.data) AS added, categories.image, categories.name AS cname, namemap.category AS catid, namemap.size,  namemap.uploader FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash LEFT JOIN categories ON categories.id = namemap.category WHERE summary.leechers >0 AND summary.seeds = 0 AND external='no' AND uploader=$CURUSER[uid] ORDER BY summary.leechers DESC ";
   $row = mysql_query($sql) or err_msg(ERROR,CANT_DO_QUERY.mysql_error());
   $numb = mysql_num_rows($row);
   if (mysql_num_rows($row)>0)
   {
  print("<tr><td class=blocklist align=center> <a href=seedwanted.php></font>Uploaded seedwanted torrents: <font color=\"#FF0000\"><b>$numb</b></a></td></tr>\n");
  }
  else
{
          //do nothing
				 }
				     $sql2 = "SELECT namemap.filename, namemap.size, namemap.info_hash, history.active, summary.seeds, summary.leechers, summary.finished FROM history INNER JOIN namemap ON history.infohash=namemap.info_hash INNER JOIN summary ON summary.info_hash=namemap.info_hash WHERE history.uid=$CURUSER[uid] AND history.date IS NOT NULL AND summary.leechers > 0 AND summary.seeds = 0 ";
	$row2 = mysql_query($sql2) or err_msg(ERROR,CANT_DO_QUERY.mysql_error());
	$numb2 = mysql_num_rows($row2);
	
			if (mysql_num_rows($row2)>0)
   {
  print("<tr><td class=blocklist align=center> <a href=seedwanted.php>Downloaded seedwanted torrents: <font color=\"#FF0000\"><b>$numb2</b></font></a></td></tr>\n");
  }
  else
           {
          //do nothing
		   }	
// yours seedwanted torrents hack end
             print("<tr><td align=center class=blocklist>");
             include("include/offset.php");
             print(USER_LASTACCESS.":<br />".date("d/m/Y H:i:s",$CURUSER["lastconnect"]-$offset));
             print("</td></tr>\n<tr><form name=jump><td class=blocklist align=center>");
             print(USER_STYLE.":<br>\n<select name=\"style\" size=\"1\" onChange=\"location=document.jump.style.options[document.jump.style.selectedIndex].value\">");
             foreach($style as $a)
                            {
                            print("<option ");
                            if ($a["id"]==$CURUSER["style"])
                               print("selected=selected");
                            print(" value=account_change.php?style=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["style"]."</option>");
                            }
             print("</select>");
             print("</td></tr>\n<tr><td class=blocklist align=center>");
             print(USER_LANGUE.":<br>\n<select name=\"langue\" size=\"1\" onChange=\"location=document.jump.langue.options[document.jump.langue.selectedIndex].value\">");
             foreach($langue as $a)
                            {
                            print("<option ");
                            if ($a["id"]==$CURUSER["language"])
                               print("selected=selected");
                            print(" value=account_change.php?langue=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["language"]."</option>");
                            }
             print("</select>");
             print("</td>\n</form></tr>\n");
             print("\n<tr><td align=center class=blocklist><a href=usercp.php?uid=".$CURUSER["uid"].">".USER_CP."</a></td></tr>\n");
             if ($CURUSER["mod_access"]=="yes")
                print("\n<tr><td align=center class=blocklist><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"].">".MNU_ADMINCP."</a></td></tr>\n");
             }

         block_end();
?>