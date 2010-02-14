<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/

require_once("include/functions.php");
require_once("include/config.php");
dbconn();

standardheader("FreeLeech Control");
block_begin("FreeLeech Control");

if (!$CURUSER || $CURUSER["admin_access"]!="yes"){
err_msg(ERROR, ERR_NOT_AUTH);
block_end();
stdfoot();
exit;
}
    if (isset($_GET["do"])) {
    $do=$_GET["do"];
    } else { 
     $do = "";
			print("<br><br><div align=center><font color=red><h3><b>Fail!</b> Wrong link!</h3></font></div><br><br>");
			$url = "freeleechcontrol.php?&do=read";
	         redirect($url);
    }

      if ($do=="freeon")
         {
            mysql_query("UPDATE namemap SET free='1'") or sqlerr();
			print("<br><br><div align=center><font color=red><h3>Updated all torrents to freeleech!</h3></font></div><br><br>");
         }
      else if ($do=="freeoff")
         {
            mysql_query("UPDATE namemap SET free='0'") or sqlerr();
			print("<br><br><div align=center><font color=red><h3>Updated all torrents to <b>NONE</b> freeleech!</h3></font></div><br><br>");
         }
      else if ($do=="freeallon")
         {
            mysql_query("ALTER TABLE `namemap` CHANGE `free` `free` ENUM( 'yes', 'no' ) NULL DEFAULT 'yes'") or sqlerr();
			print("<br><br><div align=center><font color=red><h3>Set upload to automatic Free Leech successful, entry inserted into database!</h3></font></div><br><br>");
         }
      else if ($do=="freealloff")
         {
            mysql_query("ALTER TABLE `namemap` CHANGE `free` `free` ENUM( 'yes', 'no' ) NULL DEFAULT 'no'") or sqlerr();
			print("<br><br><div align=center><font color=red><h3>Set upload to <b>NONE</b> automatic Free Leech successful, entry inserted into database!</h3></font></div><br><br>");
         }

	  else if ($do=="read");
	     {
		 
		 print("<br><br><table align=center class=main width=750 border=0 cellspacing=0 cellpadding=0>");
		 print("<tr><td>");
		 print("<table align=center width=100% border=1 cellspacing=0 cellpadding=10>");
		 print("<tr><td align=left class=header>Set all torrents to FreeLeech:</td><td align=left class=lista><form  method=\"post\" action=\"freeleechcontrol.php?&do=freeon\"><input type=\"submit\" name=\"freeleech\" value=\"Submit\" /></form></td></tr>");
		 print("<tr><td align=left class=header>Set all torrents to NONE FreeLeech:</td><td align=left class=lista><form  method=\"post\" action=\"freeleechcontrol.php?&do=freeoff\"><input type=\"submit\" name=\"freeleech\" value=\"Submit\" /></form></td></tr>");
		 print("<tr><td align=left class=header>Set all torrents to automatic FreeLeech:</td><td align=left class=lista><form  method=\"post\" action=\"freeleechcontrol.php?&do=freeallon\"><input type=\"submit\" name=\"freeleech\" value=\"Submit\" /></form></td></tr>");
		 print("<tr><td align=left class=header>Set all torrents to NONE automatic FreeLeech:</td><td align=left class=lista><form  method=\"post\" action=\"freeleechcontrol.php?&do=freealloff\"><input type=\"submit\" name=\"freeleech\" value=\"Submit\" /></form></td>");
		 print("</td></tr></table></table><br><br>");
		 
		 } 

block_end();
stdfoot(); 
?>