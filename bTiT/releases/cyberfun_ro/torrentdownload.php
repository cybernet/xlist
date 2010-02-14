<?php
require_once("include/functions.php");
require_once("include/config.php");

dbconn();

//--------------//
//$minratio=0.5;  //  Minimum ratio allowed to download files
//--------------//

global $CURUSER, $minratio;
if (!$CURUSER || $CURUSER["view_torrents"]=="no" || $CURUSER["can_download"]=="no" || $CURUSER["disabled"]=="yes")
{
    standardheader('Download',($GLOBALS["usepopup"]?false:true));
    err_msg(ERROR,NOT_AUTH_DOWNLOAD);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}

(isset($_GET["id"]) ? $id=mysql_real_escape_string($_GET["id"]) : $id="");

if($id=="")
{
    standardheader('Download',($GLOBALS["usepopup"]?false:true));
    err_msg(ERROR,BAD_ID);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}
   
$res = mysql_query("SELECT n.filename, n.size, n.uploader, u.username, ul.prefixcolor, ul.suffixcolor FROM namemap n LEFT JOIN users u ON u.id=n.uploader LEFT JOIN users_level ul ON u.id_level=ul.id WHERE info_hash='$id'");
if(mysql_num_rows($res)==1)
    $row=mysql_fetch_assoc($res);
else
{
    standardheader('Download',($GLOBALS["usepopup"]?false:true));
    err_msg(ERROR,BAD_ID);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
} 
    
standardheader("Download torrent ".$row["filename"],($GLOBALS["usepopup"]?false:true));

$res = mysql_query("SELECT IF(downloaded=0,'oo',uploaded/downloaded) ratio FROM users WHERE id=".$CURUSER["uid"]);
$user = mysql_fetch_assoc($res); 

$uploader="<a href=userdetails.php?id=".$row["uploader"].">".stripslashes($row["prefixcolor"]).$row["username"].stripslashes($row["suffixcolor"])."</a>";
(is_numeric($user["ratio"])?$ratio=number_format($user["ratio"], 3):$ratio=$user["ratio"]);

block_begin("Download Torrent ".$row["filename"]);

print("<table class='blocklist' border='0' width='100%' cellspacing='2' cellpadding='0'>");
print("<tr><td align=center class=blocklist colspan='2'><br />");
print("<table class='lista' border='0' width='50%' cellspacing='2' cellpadding='0'>");
print("<tr><td align='center' class='lista' colspan='2'>".$CURUSER["username"]." </td></tr>");
if($ratio>=$minratio || $ratio=="oo"  || $CURUSER["mod_access"]=="yes")
{
    print("<td align='center' class='lista' colspan='2'>Your torrent file is ready for download</td></tr>");
}
else
{
    print("<td align='center' class='lista' colspan='2'>Your ratio is under $minratio so you can't download this torrent</td></tr>");
}
print("<tr><td align='center' class='lista'>Your RATIO:</td><td align='center' class='lista'>$ratio</td></tr></table><br />");
print("<tr><td class=blocklist align=center>");
print("Size:</td>");
print("<td class=blocklist align=center>");
print(makesize($row["size"])." (".number_format($row["size"])." bytes)</td></tr>");
print("<td class=blocklist align=center>");
print("Uploaded By:</td>");
print("<td class=blocklist align=center>");
print($uploader."</td></tr>");
if($ratio>=$minratio || $ratio=="oo" || $CURUSER["mod_access"]=="yes")
{
    $rand=mt_rand(100000, 999999);
    @mysql_query("UPDATE users SET random2=$rand WHERE id=".$CURUSER["uid"]);
    print("<tr><td class='blocklist' align='center' colspan='2'><a href='download.php?id=$id&amp;f=".urlencode($row["filename"]).".torrent&amp;key=$rand'><img src='images/download.gif' border='0' alt='Download ".$row["filename"]."'>&nbsp;&nbsp;Download Now</a></td></tr>");
}
else
{
    print("<td class='blocklist' align='center' colspan='2'>Your ratio is under $minratio so you can't download this torrent!</td></tr>");
}
print("</table>");

block_end();
stdfoot(($GLOBALS["usepopup"]?false:true));

?>