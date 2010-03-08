<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
//!miskotes TORRENT REQUEST

require "include/functions.php";


dbconn();

standardheader("Requests Page");

begin_frame("" . MAKE_REQUEST . "");


print("<br>\n");

$where = "WHERE userid = " . $CURUSER["uid"] . "";
$res2 = mysql_query("SELECT * FROM requests $where") or sqlerr();
$num2 = mysql_num_rows($res2);

?>



<table border=0 width=100% cellspacing=0 cellpadding=3>
<tr><td class=colhead align=center><? print("" . SEARCH . " " . TORRENT . ""); ?></td></tr>
<tr><td align=left><form method="get" action=torrents.php>
<input type="text" name="<? print("search\n"); ?>" size="40" value="<?= htmlspecialchars($searchstr) ?>" />
in
<select name="category">
<option value="0">(Select)</option>
<?php


$cats = genrelist();
$catdropdown = "";
foreach ($cats as $cat) {
   $catdropdown .= "<option value=\"" . $cat["id"] . "\"";
   if ($cat["id"] == $_GET["cat"])
       $catdropdown .= " selected=\"selected\"";
   $catdropdown .= ">" . htmlspecialchars($cat["name"]) . "</option>\n";
}

$deadchkbox = "<input type=\"checkbox\" name=\"active\" value=\"0\"";
if ($_GET["active"])
   $deadchkbox .= " checked=\"checked\"";
$deadchkbox .= " /> " . INC_DEAD . "\n";

?>
<?= $catdropdown ?>
</select>
<?= $deadchkbox ?>
<input type="submit" value="<? print("" . SEARCH . "\n"); ?>"  />
</form>
</td></tr></table><BR><HR><BR>

<? print("<br>\n");

		print("<table class=lista align='center' width='550' cellspacing=2><form name=request method=post action=takerequest.php><a name=add id=add></a>");
		print("<tr><td class=header align=center width=100% colspan=\"2\">" . ADD_REQUESTS . "</td></tr>");
		print("<tr><td class=header align=left width=30%>". TORRENT_FILE ."</td><td class=lista align=left width=70%><input type=text size=40 name=requesttitle></td></tr>");
		print("<tr><td class=header align=left width=30%>".CATEGORY."</td><td class=lista align=left width=70%>");
?>

<select name="category">
<option value="0">(Select)</option>
<?

$res2 = mysql_query("SELECT id, name FROM categories  order by name");
$num = mysql_num_rows($res2);
$catdropdown2 = "";
for ($i = 0; $i < $num; ++$i)
   {
 $cats2 = mysql_fetch_assoc($res2);  
     $catdropdown2 .= "<option value=\"" . $cats2["id"] . "\"";
     $catdropdown2 .= ">" . htmlspecialchars($cats2["name"]) . "</option>\n";
   }

?>
<?= $catdropdown2 ?>
</select>

<? print("<br>\n");

		print("<tr><td class=header align=left width=30%>".DESCRIPTION."</td><td class=lista align=left width=70%>");
		print(textbbcode("request","description"));
		print("</td></tr>");
		print("<tr><td class=lista align=center width=100% colspan=\"2\"><input type=submit value='" . FRM_CONFIRM . "'></td></tr>");
print("</form>\n");
print("</table></CENTER>\n");

block_end();
stdfoot();
?>