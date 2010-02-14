<?php
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
standardheader("Hit&Runers");
if (!$CURUSER || $CURUSER["admin_access"]=="no")
   {
	require_once "include/functions.php";
	require_once "include/config.php";
	block_begin(ERROR);
	err_msg("Error", "Get a freakin' life and stop trying to hack the tracker !<br>Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot(false);
   }
else
   {
 block_begin("Hit&Runers");
$hittestres=mysql_query("SELECT COUNT(*) FROM history WHERE hit=2 ORDER BY hit=2 DESC");
    $hitnum=mysql_fetch_row($hittestres);
    $num=$hitnum[0];
    $perpage=(max(0,$CURUSER["postsperpage"])>0?$CURUSER["postsperpage"]:20);
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num, "hittest.php?&");

echo "<br>";
echo "<center>Trackern har bestraffat alla som står i denna listan med att ta 3GB från deras Upload och skickat ett pm till dem.</center>";
echo $pagertop;
echo "<table align=center width=85%>";
?>
<TR>
<td width=15% class=block align=center><?echo USER_NAME;?></td>
<td class=block align=center>Torrent</td>
<td class=block align=center>Upload</td>
<td class=block align=center>Download</td>
<td class=block align=center>Ratio</td>
<td class=block align=center>Seedtid</td>
</TR>
<?
$res = mysql_query("SELECT pid, infohash FROM peers");

   if (mysql_num_rows($res) > 0)
   {
       while ($arr = mysql_fetch_assoc($res))
       {
	   $x=$arr['pid'];
	   $t=$arr['infohash'];
	   $pl=mysql_query("SELECT id FROM users WHERE pid='$x'");
	   $ccc=mysql_result($pl,0,"id");
	  	}
   }
$r=mysql_query("SELECT * FROM history WHERE hit=2 ORDER BY hit=2 DESC $limit");
while($x = mysql_fetch_array($r)){
$t=mysql_query("SELECT username FROM users WHERE id=$x[uid]");
$t2=mysql_query("SELECT * FROM history WHERE uid=$x[uid] and hit='2' AND infohash='$x[infohash]'");
$t3=mysql_query("SELECT filename FROM namemap WHERE info_hash='$x[infohash]'");
$xa=mysql_result($t,0,"username");
$tor=mysql_result($t2,0,"infohash");
$tor2=mysql_result($t3,0,"filename");
$up=mysql_result($t2,0,"uploaded");
$up2=number_format(round($up / 1048576,2),2);
$down=mysql_result($t2,0,"downloaded");
$down2=number_format(round($down / 1048576,2),2);
$seed=mysql_result($t2,0,"seed");
$seed2=number_format(round($seed / 3600,1),1);
$ratio= number_format(round($up / $down,2),2);
echo "<tr>";
echo "<td width=15% class=lista align=left><a href=userdetails.php?id=$x[uid]>$xa</a></td>";
echo "<td class=lista align=left><a href=details.php?id=$tor>$tor2</a></td>";
echo "<td class=lista align=center>$up2 MB</td>";
echo "<td class=lista align=center>$down2 MB</td>";
echo "<td class=lista align=center>$ratio</td>";
echo "<td class=lista align=center>$seed2 h</td>";
echo "</tr>";
{
}
}
print("<br></table");
print $pagerbottom;
block_end();
stdfoot();
 }
  ?>