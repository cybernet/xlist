
<table class="block" width="100%" id="table1">
<tr>
<td class="header" align="center"></td>
</tr>
<table class="block" width="100%" id="table2">
<tr>
<?
   global $CURUSER;

if (!$CURUSER)
   {
       // anonymous=guest
   print("<td class=header align=center>".WELCOME."Guest\n");
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
    print("<td class=header align=center>".WELCOME_BACK." " . $CURUSER["username"] ." \n");
    print("<a href=logout.php>(".LOGOUT.")</a></td>\n");
    }

print("<td class=header align=center><a href=index.php>".MNU_INDEX."</a></td>\n");


if ($CURUSER["view_torrents"]=="yes")	 
	 print("<td class=header align=center><a href=torrents.php>".MNU_TORRENT."</a></td>\n");
   print("<td class=header align=center><a href=extra-stats.php>".MNU_STATS."</a></td>\n");
if ($CURUSER["can_upload"]=="yes")
   print("<td class=header align=center><a href=upload.php>".MNU_UPLOAD."</a></td>\n");
if ($CURUSER["view_users"]=="yes")
   print("<td class=header align=center><a href=users.php>".MNU_MEMBERS."</a></td>\n");                              if ($CURUSER["view_news"]=="yes")
   print("<td class=header align=center><a href=viewnews.php>".MNU_NEWS."</a></td>\n");
 if ($CURUSER["view_forum"]=="yes")
   {
   if ($GLOBALS["FORUMLINK"]=="" || $GLOBALS["FORUMLINK"]=="internal")
      print("<td class=header align=center><a href=forum.php>".MNU_FORUM."</a></td>\n");
   else
       print("<td class=header align=center><a href=$GLOBALS[FORUMLINK] target=_blank>".MNU_FORUM."</a></td>\n");
    }
?>
</tr>
<table class="block" width="100%" id="table3">
<tr>
<td class="header" align="center"></td>
</tr>
<table class="block" width="100%" id="table4">
<tr>
<td class="lista" align="center">&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<table class="block" width="100%" id="table5">
<tr>
<td class="header" align="center"></td>
</tr>
<table class="block" width="100%" id="table6">
<tr>
<td class="header" align="center"></td>
<td class="header" align="center">&nbsp;&nbsp;</td>
<td class="header" align="center"><a herf="http://www." target="_blank">IRC</a></td>
<td class="header" align="center">&nbsp;&nbsp;</td>
<td class="header" align="center"><a href=rules.php>Rules</a></td>
<td class="header" align="center">&nbsp;&nbsp;</td>
<?
if ($CURUSER["can_download"]=="yes")
   print("<td class=header align=center><a href=links.php>".LINKS."</a></td>\n");
	 print("<td class=header align=center>&nbsp;&nbsp;</td>\n");
	 print("<td class=header align=center><a href=faq.php>".FAQ."</a></td>\n");
	 print("<td class=header align=center>&nbsp;&nbsp;</td>\n");
	 print("<td class=header align=center><a href=./staff.php>".STAFF."</a></td>\n");
	?> 

<!--<td class="header" align="center">&nbsp;&nbsp;</td>
<td class="header" align="center"><a href=""></a></td>
<td class="header" align="center">&nbsp;&nbsp;</td>
<td class="header" align="center"><a href="./Maketorrent2.1.zip">Maketorrent2.1</a></td>-->
<td class="header" align="center">&nbsp;&nbsp;</td>
<td class="header" align="center"></td>
</tr>
<table class="block" width="100%" id="table7">
<tr>
<td class="header" align="center"></td>
</tr>
  </table>
<?
