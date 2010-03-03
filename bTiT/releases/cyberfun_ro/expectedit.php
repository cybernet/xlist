<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");

dbconn();

standardheader("Edit Expect");

$id2 = $_GET["id"];
$res = mysql_query("SELECT * FROM expected WHERE id=$id2");
$row = mysql_fetch_array($res);

if ($CURUSER["uid"] == $row["userid"] || $CURUSER["can_upload"] == "yes")

{

if (!$row)
       die();

block_begin("Edit Expected: ".$row["expect"]."");

$where = "WHERE userid = ".$CURUSER["id"]."";
$res2 = mysql_query("SELECT * FROM expected $where") or sqlerr();
$num2 = mysql_num_rows($res2);

print("<form name=\"edit\" method=post action=takeexpectedit.php><a name=edit id=edit></a>");
print("<table class=lista align=center width=550 cellspacing=2 cellpadding=0>\n");
print("<tr><td align=left class=header><b>". NAME ."</b></td> <td class=lista align=left><input type=text size=60 name=expecttitle value=\"" . htmlspecialchars($row["expect"]) . "\"></td></tr>");
print("<tr><td class=header align=left width=30%>" . DATE_EXPECTED . "</td><td class=lista align=left width=70%><input type=text size=15 name=date value=\"" . htmlspecialchars($row["date"]) . "\"></td></tr>");
print("<tr><td class=header align=left><b>" . CATEGORY . "</b></td><td align=left class=lista>\n");

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
