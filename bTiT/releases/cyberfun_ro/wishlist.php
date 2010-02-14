<?php
require_once("include/functions.php");
dbconn();

if ($CURUSER["id_level"]==1){
checkver("torrents.php"); // redirects to torrents.php if guest
exit();
}

$do = $_GET["do"];
$torrent_id = $_GET["torrent_id"];

// Add torrent to wishlist

if ($do=="add"){
if (!isset($torrent_id)){
checkver("torrents.php"); // redirects to torrents.php if torrent_id not set
exit();
}
standardheader("Add to wishlist");
block_begin("Added to wishlist");
$hmm=mysql_query("SELECT * FROM wishlist WHERE torrent_id = '$torrent_id' AND user_id = ".$CURUSER['uid']);
if (mysql_num_rows($hmm)){
    err_msg("Error!","Torrent Already Exists!");
    print_version();
    print("</body>\n</html>\n");
    die;
}
$sql = "SELECT * FROM namemap WHERE info_hash = '$torrent_id'";
$qry = mysql_query($sql);
$res = mysql_fetch_array($qry);
$chk = mysql_num_rows($qry);
if (!$chk){
checkver("torrents.php"); // redirects to torrents.php if torrent_id not in database
exit();
}
mysql_query("INSERT INTO wishlist (user_id, torrent_id, torrent_name, added) VALUES ('".$CURUSER["uid"]."', '".$_GET["torrent_id"]."', '".$res["filename"]."', NOW())");
print ("<center><br>Torrent <b>$torrent_name</b> added to you wishlist.<br><br>Click <a href=wishlist.php>HERE</a> to view your wishlist.<br>Click <a href=details.php?id=$torrent_id&returnto=torrents.php>HERE</a> to return to the torrent.</center>");
}

// Delete torrent from wishlist

elseif ($do=="del"){
foreach($_POST["msg"] as $selected=>$msg){
@mysql_query("DELETE FROM wishlist WHERE id=\"$msg\"");
}
checkver("wishlist.php");
exit();
}

// Main wishlist page

else{
standardheader('Wishlist');
block_begin("Wishlist");
print("<script type=\"text/javascript\">
<!--
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
if(!document.forms[FormName])
return;
var objCheckBoxes = document.forms[FormName].elements[FieldName];
if(!objCheckBoxes)
return;
var countCheckBoxes = objCheckBoxes.length;
if(!countCheckBoxes)
objCheckBoxes.checked = CheckValue;
else
// set the check value for all check boxes
for(var i = 0; i < countCheckBoxes; i++)
objCheckBoxes[i].checked = CheckValue;
}
-->
</script>
");
$qry=mysql_query("SELECT * FROM wishlist WHERE user_id = ".$CURUSER['uid']);
$coun=mysql_num_rows($qry);
print("\n<form action=\"wishlist.php?do=del\" name=\"delwish\" method=\"post\">");
?>
<form name=delwish action=wishlist.php?do=del method=post>
<TABLE width=100% class="lista" align="center">
<TD align="center" class="header" width=5%><? echo CATEGORY; ?></TD>
<TD align="center" class="header"><? echo FILE; ?></TD>
<TD align="center" class="header" width=5%><? echo DOWN; ?></TD>
<TD align="center" class="header" width=10%><? echo SIZE; ?></TD>
<TD align="center" class="header" width=5%><? echo SHORT_S; ?></TD>
<TD align="center" class="header" width=5%><? echo SHORT_L; ?></TD>
<TD align="center" class="header" width=5%><? echo SHORT_C; ?></TD>
<TD align="center" class="header" width=10%><? echo SPEED; ?></TD>
<TD align="center" class="header" width=15%>Added</TD>
<?
if (!$coun)
print("<td class=header width=5%></td>");
else
print("<td class=header align=center width=5%><input type=checkbox name=all onclick=SetAllCheckBoxes('delwish','msg[]',this.checked)></td></tr>");
while ($res=mysql_fetch_array($qry)) {
$tor=mysql_query("SELECT namemap.info_hash, namemap.filename, namemap.size, namemap.external, categories.image as cimage, categories.id as catid, categories.name as cname, summary.seeds as seeds, summary.leechers as leechers, format( summary.finished, 0  ) as finished, summary.speed as speed FROM namemap LEFT JOIN summary on namemap.info_hash=summary.info_hash LEFT JOIN categories ON namemap.category=categories.id WHERE namemap.info_hash = '".$res['torrent_id']."'");
//$tor=mysql_query("SELECT namemap.info_hash, filename, size, seeds, leechers, finished, speed, external, image, categories.id as catid, categories.name as cname FROM namemap LEFT JOIN summary on namemap.info_hash=summary.info_hash LEFT JOIN categories ON namemap.category=categories.id WHERE namemap.info_hash = '".$res['torrent_id']."'");
$ret=mysql_fetch_array($tor);
$num=mysql_num_rows($tor);
if (!$num){ // torrent doesnt exist in database anymore
$category="n/a";
$filename=$res['torrent_name'];
$download="n/a";
$size="n/a";
$seeds="<td class=lista align=center>n/a</td>";
$leechers="<td class=lista align=center>n/a</td>";
$completes="n/a";
$speed="n/a";
}
else{ // torrent exists in database
$category="<a href=torrents.php?category=".$ret['catid'].">".image_or_link(($ret['cimage']==""?"":"images/categories/" . $ret["cimage"]),"",$ret["cname"])."</td>";
//$category="<a href=torrents.php?category=".$ret['catid'].">".image_or_link(($ret['image']==""?"":"images/categories/" . $ret["image"]),"",$ret["cname"])."</td>";
$filename="<a href=details.php?id=".$ret['info_hash']."&returnto=wishlist.php>".$ret['filename']."</a>";
$download="<a href=download.php?id=".$ret["info_hash"]."&f=" . rawurlencode(html_entity_decode($ret["filename"])) . ".torrent>".image_or_link("images/download.gif","","torrent")."</a>";
$size=makesize($ret['size']);
$seeds="<td align=\"center\" class=\"".linkcolor($ret["seeds"])."\"><a href=\"peers.php?id=".$ret["info_hash"]."&returnto=wishlist.php\" title=\"".PEERS_DETAILS."\">" .$ret["seeds"] . "</a></td>";
$leechers="<td align=\"center\" class=\"".linkcolor($ret["leechers"])."\"><a href=\"peers.php?id=".$ret["info_hash"]."&returnto=wishlist.php\" title=\"".PEERS_DETAILS."\">" .$ret["leechers"] . "</a></td>";
$completes="<a href=torrent_history.php?id=".$ret['info_hash'].">".$ret['finished']."</a>";
if ($ret["speed"] < 0 || $ret["external"]=="yes")
$speed = "n/a";
else if ($ret["speed"] > 2097152)
$speed = round($data["speed"]/1048576,2) . " MB/sec";
else
$speed = round($ret["speed"] / 1024, 2) . " KB/sec";
}
print("<tr>\n");
print("<td class=lista align=center>$category</td>");
print("<td class=lista align=left>$filename</td>");
print("<td class=lista align=center>$download</td>");
print("<td class=lista align=center>$size</td>");
print($seeds);
print($leechers);
print("<td class=lista align=center>$completes</td>");
print("<td class=lista align=center>$speed</td>");
print("<td class=lista align=center>".$res['added']."</td>");
print("<td class=lista align=center><input type=checkbox name=msg[] value=".$res["id"]."></td></tr>");
}
if (!$coun)
print("\n<tr>\n<td class=lista align=center colspan=10>Nothing in your wishlist</td></tr>");
else
print("\n<tr>\n<td class=lista align=right colspan=10><input type=submit name=action value=Delete></td></tr>");
print("\n</table>\n</form>");
}
block_end();
stdfoot();

function checkver($redir){
    if (function_exists('btit_redirect'))
    btit_redirect($redir);
    else
    redirect($redir);
}
?>