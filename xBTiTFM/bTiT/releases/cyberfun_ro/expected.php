<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
standardheader("Expect Page");

block_begin("" . ADD_EXPECTED . "");
print("<br>\n");

$where = "WHERE userid = " . $CURUSER["uid"] . "";
$res2 = mysql_query("SELECT * FROM expected $where") or sqlerr();
$num2 = mysql_num_rows($res2);

?>
<table border=0 width=100% cellspacing=0 cellpadding=3>
<tr><td class=colhead align=center><?php echo("" . SEARCH . " " . TORRENT . ""); ?></td></tr>
<tr><td align=left><form method="get" action=torrents.php>
<input type="text" name="<?php echo("search\n"); ?>" size="40" value="<?php echo htmlspecialchars($searchstr);?>" />
in
<select name="category">
<option value="0"><?php echo ALL;?></option>
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
<?php echo $catdropdown;?>
</select>
<?php echo $deadchkbox; ?>
<input type="submit" value="<?php echo("" . SEARCH . "\n"); ?>"  />
</form>
</td></tr></table><BR><HR><BR>

<?php print("<br>\n");

		print("<table class=lista align='center' width='550' cellspacing=2><form name=request method=post action=takeexpect.php><a name=add id=add></a>");
		print("<tr><td class=header align=center width=100% colspan=\"2\">" . ADD_EXPECTED . "</td></tr>");
		print("<tr><td class=header align=left width=30%>". NAME ."</td><td class=lista align=left width=70%><input type=text size=40 name=expecttitle></td></tr>");
		print("<tr><td class=header align=left width=30%>" . DATE_EXPECTED . "</td><td class=lista align=left width=70%><input type=text size=15 name=date></td></tr>");
		print("<tr><td class=header align=left width=30%>".CATEGORY."</td><td class=lista align=left width=70%>");
?>

<select name="category">
<option value="0"><?php echo CHOOSE;?></option>
<?php

$res2 = mysql_query("SELECT id, name FROM categories ORDER BY name");
$num = mysql_num_rows($res2);
$catdropdown2 = "";
for ($i = 0; $i < $num; ++$i)
   {
 $cats2 = mysql_fetch_assoc($res2);  
     $catdropdown2 .= "<option value=\"" . $cats2["id"] . "\"";
     $catdropdown2 .= ">" . htmlspecialchars($cats2["name"]) . "</option>\n";
   }

?>
<?php echo $catdropdown2;?>
</select>

<?php print("<br>\n");
		print("<tr><td class=header align=left width=30%>".DESCRIPTION."</td><td class=lista align=left width=70%>");
		print(textbbcode("expect","description"));
		print("</td></tr>");
		print("<tr><td class=lista align=center width=100% colspan=\"2\"><input type=submit value='" . FRM_CONFIRM . "'></td></tr>");
print("</form>\n");
print("</table></CENTER>\n");

block_end();
stdfoot();
?>