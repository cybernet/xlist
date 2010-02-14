<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
//!miskotes TORRENT REQUEST

require_once("include/functions.php");

dbconn();

standardheader("Edit Request");

$id2 = $_GET["id"];
$res = mysql_query("SELECT * FROM requests WHERE id=$id2");
$row = mysql_fetch_array($res);

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["edit_torrents"]== "yes")

{

if (!$row)
       die();

block_begin("Edit Request: ".$row["request"]."");

$where = "WHERE userid = ".$CURUSER["id"]."";
$res2 = mysql_query("SELECT * FROM requests $where") or sqlerr();
$num2 = mysql_num_rows($res2);

print("<form name=\"edit\" method=post action=takereqedit.php><a name=edit id=edit></a>");
print("<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
print("<br><tr><td align=left class=header><b>". TORRENT_FILE ."</b></td> <td class=lista align=left><input type=text size=60 name=requesttitle value=\"" . htmlspecialchars($row["request"]) . "\"></td></tr>");

print("<tr><td align=center class=lista><b>Category :</b></td><td align=left class=lista>\n");

$s = "<select name=\"category\">\n";

       $cats = genrelist();
       foreach ($cats as $subrow) {
 $s .= "<option value=\"" . $subrow["id"] . "\"";
 if ($subrow["id"] == $row["cat"])
         $s .= " selected=\"selected\"";
 $s .= ">" . htmlspecialchars($subrow["name"]) . "</option>\n";
       }

       $s .= "</select>\n";
       print("$s</td></tr>\n");

		print("<tr><td align=left class=header>".DESCRIPTION."</td><td align=left class=lista>");
		print(textbbcode("edit","description",unesc($row["descr"])));
		print("</td></tr>");
print("<input type=\"hidden\" name=\"id\" value=\"$id2\">\n");
print("<tr><td colspan=2 align=center class=lista><input type=submit value=\"Submit\">\n");
print("</form>\n");
print("</table>\n");

block_end();
stdfoot();
}

else

      {
      block_begin("You're not the owner!");
      err_msg(ERROR,"Or you are not authorized or this is a bug, report it pls...<br>Posjetite: ");
      print ("<br>");
      block_end();
      stdfoot();
      exit;
      }

?>