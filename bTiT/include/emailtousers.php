<?php
global $SITENAME, $SITEEMAIL, $BASEURL;
// - baterist BTIT v1.2 emailtousers Hack v0.1b

$readyto=(isset($_POST["readyto"])?$_POST["readyto"]:"sa");
$readyto1=(isset($_POST["readyto1"])?$_POST["readyto1"]:"sa");
$kullan=(isset($_POST["kullan"])?$_POST["kullan"]:3);
$konu=(isset($_POST["konu"])?$_POST["konu"]:"Subject!");
$mailbolumu=(isset($_POST["mailbolumu"])?$_POST["mailbolumu"]:"Mail Body!");

$count=0;
block_begin("Email to Users");
?>
<center>
<TABLE width=20% class="lista">
<TR>
<TD align="center" class="header"><? echo "E-Mail to Users"; ?></TD></TR>
<TR><TD align="center" class="blocklist">
<?php
print("<form method=post action=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=emailtousers>");
?>
<!-- <form method=post action="admincp.php?user=<?php echo $CURUSER["uid"]; ?>&code=<?php echo $CURUSER["random"]; ?>&do=emailtousers"> -->
<!-- <form method=post action="admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=emailtousers"> -->
</TD></TR>
<tr>
<td>
<b>Subject </b><input name="konu" type="text" id="konu" size="60" maxlength="60" />
</td>
</tr>
<tr>
<td>
<b>Mail</b><br />
<textarea name="mailbolumu" cols="57" rows="5" id="mailbolumu"></textarea>
</td>
</tr>
<tr>
<td align="center" class="blocklist">
User Group : <!Dropdown added by miskotes>

         <?
         print("<select name=\"kullan\">");
         print("<option value=0".($level==0 ? " selected=selected " : "").">".ALL."</option>");
         $res=mysql_query("SELECT id,level FROM users_level WHERE id_level>1 ORDER BY id_level");
         while($row=mysql_fetch_array($res))
         {
             $select="<option value='".$row["id"]."'";
             if ($level==$row["id"])
                $select.="selected=\"selected\"";
             $select.=">".$row["level"]."</option>\n";
             print $select;
         }
         print("</select>");
         ?>

<!End dropdown>

</td>
</tr>
<TR><TD align="center" class="lista">
<input type="submit" name="readyto" value="Send Email"><input name="readyto1" type="submit" id="readyto1" value="Send Activation Mail"></td></tr></form></table><br>
</center>
<?php
if ($readyto=="Send Email") {
?>
<TABLE width=100% class=lista cellpadding=0 cellspacing=0>
<TR><TD align="center" height="20px" class="block"><b>Emailed Users USER GROUP : <? echo ($kullan==0?"ALL":$kullan) ?></b></TD></TR></table>
<center>
<?php
if ($kullan==0) {
$q=mysql_query("SELECT users.id as fid, username, random, email, language, downloaded, uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM users LEFT JOIN users_level ON users.id_level=users_level.id ORDER BY (uploaded / downloaded) ASC");
}
else
{
$q=mysql_query("SELECT users.id as fid, username, random, email, language, downloaded, uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM users LEFT JOIN users_level ON users.id_level=users_level.id where (users.id_level='".$kullan."') ORDER BY (uploaded / downloaded) ASC");
}
while ($user=mysql_fetch_object($q)) {
if ($user) {
echo "<b>".$user->username."</b> emailed!<br>";
mail($user->email,$konu,$mailbolumu,"From: $SITENAME <$SITEEMAIL>");
   $count++;
}
}

echo "<br><br> Found <b>".$count."</b> users and emailed!</b>";

}
if ($readyto1=="Send Activation Mail") {
if ($kullan==0) {
$q=mysql_query("SELECT users.id as fid, username, random, email, language, downloaded, uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM users LEFT JOIN users_level ON users.id_level=users_level.id ORDER BY (uploaded / downloaded) ASC");
}
else
{
$q=mysql_query("SELECT users.id as fid, username, random, email, language, downloaded, uploaded, level, UNIX_TIMESTAMP(joined) as joined, UNIX_TIMESTAMP(lastconnect) as lastconnect FROM users LEFT JOIN users_level ON users.id_level=users_level.id where (users.id_level='".$kullan."') ORDER BY (uploaded / downloaded) ASC");
}
while ($user=mysql_fetch_object($q)) {
if ($user) {
echo "<b>".$user->username."</b> emailed!<br>";
mail($user->email,"activation subject","Activation link       $BASEURL/account.php?act=confirm&confirm=".$user->random."&language=".$user->idlangue,"From: $BASEURL <$SITEEMAIL>");
   $count++;
}
}

echo "<br><br> Found <b>".$count."</b> users and emailed!</b>";

}
   block_end();

?>