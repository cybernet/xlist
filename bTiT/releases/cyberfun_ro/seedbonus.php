<?
// SeedBonus Mod by CobraCRK   -   original ideea by TvRecall...
//cobracrk@yahoo.com
//www.extremeshare.org

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader('Seed Bonus');

if ($CURUSER["view_torrents"]=="no")
   {
       err_msg(ERROR.NOT_AUTHORIZED." ",SORRY."...");
       stdfoot();
       exit;
}
else
    {

block_begin("Seed Bonus");
?>
<style type="text/css">
<!--
.style1 {
	color: #000000;
	font-size: x-large;
}
.style2 {font-size: x-large}
-->
</style>

<p align="center"><?php
$r=mysql_query("SELECT seedbonus FROM users WHERE id=$CURUSER[uid]");
$cc=mysql_result($r,0,"seedbonus");
echo "<center>";
echo "<img border=0 align=center src=images/bonus.png><br>";
echo "<br><h1>".BONUS_INFO1." $cc).<br>".BONUS_INFO2."</h1>";
echo "</center>";
?></p>
<p>&nbsp;</p>
<table width="474" align="center" cellpadding="2" cellspacing="0">
<tr>
    <td class=block width="26"><?php echo OPTION; ?></td>
    <td class=block width="319"><?php echo WHAT_ABOUT; ?></td>
    <td class=block width="41"><?php echo POINTS; ?></td>
    <td class=block width="62"><?php echo EXCHANGE; ?> </td>
  </tr>
  <?php
  $uid=$CURUSER['uid'];
  $d=mysql_query("SELECT downloaded FROM users WHERE id=$uid");
  $r=mysql_query("SELECT * from users where id=$uid");
  $v=mysql_result($d,0,"downloaded");
  $c=mysql_result($r,0,"seedbonus");
  $r=mysql_query("SELECT * FROM bonus");
  while($row = mysql_fetch_array($r)){  
  if($c<$row['points']) { $enb="disabled"; }
  echo "<form action=seedbonus_exchange.php?id=".$row['id']." method=post><tr>
    <td class=lista><h1><center>".$row['name']."</center></h1></td>
    <td class=lista ><b>".$row['gb']." GB Upload</b><br>".BONUS_DESC."</td>
    <td class=lista>".$row['points']."</td>
    <td class=lista><input type=submit name=submit value=\"".EXCHANGE."!\" $enb></td>
  </tr></form>";

}

$id = $CURUSER["uid"];
$res=mysql_query("SELECT users.custom_title, users.id,users.username FROM users WHERE id=$CURUSER[uid]");
$row=mysql_fetch_array($res);
if($c<150) { $anc="disabled"; }
?>
  </form><form action=seedbonus_exchange.php?id=invite method=post><tr>
    <td class=lista><center><h1>5</h1></center></td>
	<td class=lista><b>1 Invite</b><br>If you reach the points for this case, you can exchange these points on the fly into invite, we take off the points and you receive the invite.</td>
    <td class=lista>150.0</td>
    <td class=lista><input type=submit name=submit value=Exchange! <?php echo $anc; ?> ></td>
  </tr></form> 
  <?php
if($c<180 || $v<10737000000) { $anc="disabled"; }
?>
  </form><form action=seedbonus_exchange.php?id=down method=post><tr>
    <td class=lista><center><h1>6</h1></center></td>
	<td class=lista><b>Minus 10 GB Download</b><br>If you reach the points for this case, you can exchange these points on the fly into - 10 GB Download, we take off the points and you receive the - 10 GB Download.</td>
    <td class=lista>180.0</td>
    <td class=lista><input type=submit name=submit value=Exchange! <?php echo $anc; ?> ></td>
  </tr></form>
 <form name=transfer method=post action=bonus_taketransfer.php>
<?print("<tr>\n<td class=lista align=center colspan=5><b>Give Seed Bonus Points</b></td></tr>\n");?>
<tr>
<td class=lista width=100><b>To User:</b></td>
<td colspan=5 class=lista><input type=text name=username size=40></td></tr>
<tr><td class=lista width=100><b>Points:</b></td><td colspan=5 class=lista><input type=text name=bonuszpont size=40 value=1>&nbsp;
</td></tr>
<tr><td class=lista colspan=5><center><input type=checkbox name=anonym value=anonym>&nbsp;&nbsp;Send as Anonymous&nbsp;&nbsp;<input name=submit type=submit value=Comfirm>&nbsp;&nbsp;<input name=reset type=reset value=Reset></center></td>
</tr></form>
  <?php
if($c>499) {  
   print("<tr>\n<td class=lista align=center colspan=5><b>Change Custom Title (Cost: 500 points)</b></td></tr>\n");
   //Custom Title System Hack Start
if (!$row["custom_title"])
        $title = "<i>".NO_CUSTOM_TITLE."</i>";
else
        $title = unesc($row["custom_title"]);
print("<tr>\n<td class=lista>".CUSTOM_TITLE."</td>\n<td class=lista colspan=5>".$title."</td></tr>\n");
//Custom Title System Hack Stop
  


   if (!$row["custom_title"])
        $custom = "";
   else
        $custom = $row["custom_title"];
        
   print("<tr>\n<td class=lista><b>".CUSTOM_TITLE."</b></td>\n<td class=lista colspan=1>");
   print("<form method=post action=title2.php?action=changetitle&uid=".unesc($id)."&returnto=seedbonus.php?id=".unesc($id).">");
   print("<input type=text name=title size=36 maxlength=50 value=\"".unesc($custom)."\"><input type=hidden name=username size=4 value=\"".$row["username"]."\" readonly></td>");
   print("<td class=lista align=center colspan=3><input type=\"submit\" value=\"".FRM_CONFIRM."\">&nbsp;&nbsp;<input type=\"reset\" value=\"".FRM_RESET."\">");
   print("</form>");
   print("</td></tr>\n");


}
if($c<499) {  
print("<tr>\n<td class=lista align=center colspan=5><b>Change Custom Title (Cost: 500 points)</b></td></tr>\n");
print("<tr>\n<td class=lista align=center colspan=5><b>[Must have more points]</b></td></tr>\n");
}

//Custom title hack end
?>
  
</table>
<p align="center" class="style1">&nbsp;</p>
<p class="style2"><?
echo "<center><h1>".BONUS_INFO3."</h1></center>";
block_end();
}

stdfoot();
?>
</p>