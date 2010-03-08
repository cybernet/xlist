<?php
require_once("include/functions.php");
require_once("include/config.php");

dbconn();

standardheader("Expect Page");

global $CURUSER;
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
       err_msg(ERROR,NEED_TO_BE_AN_MEMBER);
       stdfoot();
       exit;
   }
else
    {

block_begin("" . EXPECTED . "");
if (!$CURUSER || $CURUSER["can_upload"]=="yes")
	{
		print("<div align=right><a href=expected.php>" . ADD_EXPECTED . "</a> | <a href=viewexpected.php?expectorid=$CURUSER[uid]>" . VIEW_MY_EXPECTED . "</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
		print("</div>");
	}


$categ = $_GET["category"];
$expectorid = $_GET["expectorid"];
$search = $_GET["search"];
$search = " AND expected.expect like '%$search%' ";

if ($expectorid <> NULL)
{
if (($categ <> NULL) && ($categ <> 0))
 $categ = "WHERE expected.cat = " . $categ . " AND expected.userid = " . $expectorid;
else
 $categ = "WHERE expected.userid = " . $expectorid;
}

else if ($categ == 0)
$categ = '';
else
$categ = "WHERE expected.cat = " . $categ;

$res = mysql_query("SELECT count(expected.id) FROM expected INNER JOIN categories on expected.cat = categories.id inner join users on expected.userid = users.id  $categ $search") or die(mysql_error());
$row = mysql_fetch_array($res);
$count = $row[0];

$perpage = 50;

list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] ."?" . "category=" . $_GET["category"] . "&sort=" . $_GET["sort"] . "&" );

$res = mysql_query("SELECT users.username, expected.id, expected.userid, expected.expect, expected.added, expected.date, categories.image as catimg, categories.id as catid, categories.name as cat FROM expected INNER JOIN categories on expected.cat = categories.id inner join users on expected.userid = users.id  $categ $filter $search $sort $limit") or sqlerr();
$num = mysql_num_rows($res);

print("<br><br><CENTER><form method=get action=viewexpected.php>");
print("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text size=30 name=search>");
print(" <input type=submit align=center value=" . SEARCH . " style='height: 22px'>\n");
print("</form></CENTER><br>");

//echo $pagertop;

echo "<Table border=0 width=99% align=center cellspacing=0 cellpadding=0><TR><TD width=49.5% align=left>";

print("<form method=get action=viewexpected.php>");
?>
</td><td width=100% align=right>
<select name="category">
<option value="0"><?php echo("" . ALL . "\n"); ?></option>
<?php

$cats = genrelist();
$catdropdown = "";
foreach ($cats as $cat) {
   $catdropdown .= "<option value=\"" . $cat["id"] . "\"";
   $catdropdown .= ">" . htmlspecialchars($cat["name"]) . "</option>\n";
}

?>
<?php echo $catdropdown;?>
</select>
<?php
print("<input type=submit align=center value=" . FIND_EXPECT . ">\n");
print("</form></td></tr></table>");
print("<form method=post action=takedelexpect.php>");
print("<table width=99% align=center cellspacing=1 class=lista>\n");
print("<tr><td class=header align=center>" . NAME . "</td><td class=header align=center>" . CATEGORY . "</td><td class=header align=center>" . ADDED . "</td><td class=header align=center>" . UPLOADER . "</td><td class=header align=center>" . EXPECTED . "</td>\n");

if (!$CURUSER || $CURUSER["can_upload"]=="yes")
print("<td class=header align=center>" . FRM_DELETE . "</td></tr>\n");


for ($i = 0; $i < $num; ++$i)
{

$arr = mysql_fetch_assoc($res);
$privacylevel = $arr["privacy"];

$addedby = "<td class=lista align=center><a href=userdetails.php?id=$arr[userid]><b>$arr[username]</b></a></td>";

 print("<tr><td class=lista align=center><a href=expectdetails.php?id=$arr[id]><b>$arr[expect]</b></a></td>" .
 "<td class=lista align=center>".image_or_link(($arr['catimg']==''?'':'images/categories/'.$arr[catimg]),' title='.$arr[cat].'',$arr['cat'])."</td><td class=lista align=center>" . $arr["added"] . "</td>$addedby<td class=lista align=center>" . $arr["date"] . "</td>\n");

if (!$CURUSER || $CURUSER["can_upload"]=="yes")
print("<td class=lista align=center><input type=\"checkbox\" name=\"delexpect[]\" value=\"" . $arr[id] . "\" /></td></tr>\n");
}

print("</table>\n");

if (!$CURUSER || $CURUSER["can_upload"]=="yes")
print("<table width=99%><td align=right><input type=submit value=" . GO . "></td></table>");
print("</form>");

block_end();
}
stdfoot();
die;

?>