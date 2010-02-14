<?php
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" align="center">
<META NAME='description' CONTENT=' Free Torrent Downloads, file list, nova, big'>
<meta name='keywords' content= ' mp3, avi, bittorrent, torrent, torrents, movies, music, games, applications, apps, download, upload, share, file tracker, filelist, isohunt, nova, pussy, free, live, cyberfun, btit, google, search'/>
<META NAME='author' CONTENT='cybernet'>
<META NAME='robots' CONTENT='FOLLOW,INDEX'>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<META NAME='revisit-after' CONTENT='1 days'>

<META HTTP-EQUIV='Content-Language' CONTENT='EN'>
<META NAME='copyright' CONTENT=' @ WwW.CyBerFuN.ro'>
<?
echo "<table id=\"Table_01\" width=\"100%\" height=\"290\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
echo "<tr>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/dev-zentri_Zeronix_theme_he.gif\" width=\"35\" height=\"60\" alt=\"\"></td>";
echo "	<td>";
echo "		<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"468\" height=\"60\" id=\"player\" align=\"middle\">";
echo "<param name=\"allowScriptAccess\" value=\"sameDomain\" />";
echo "<param name=\"movie\" value=\"style/Flame/images/player.swf\" />";
echo "<param name=\"quality\" value=\"high\" />";
echo "<param name=\"bgcolor\" value=\"#131313\" />";
echo "<embed src=\"style/Flame/images/player.swf\" quality=\"high\" bgcolor=\"#131313\" width=\"468\" height=\"60\" name=\"player\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>";
echo "</td>";
echo "	<td rowspan=\"3\" background=\"style/Flame/images/header_03.gif\" width=\"100%\" height=\"290\" alt=\"\"></td>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_04.gif\" width=\"317\" height=\"60\" alt=\"\"></td>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_05.gif\" width=\"35\" height=\"60\" alt=\"\"></td>";
echo "</tr>";
echo "<tr>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_06.gif\" width=\"35\" height=\"161\" alt=\"\"></td>";
echo "	<td>";
//echo "		<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"468\" height=\"161\" id=\"logo_lt\" align=\"middle\">";
//echo "<param name=\"allowScriptAccess\" value=\"sameDomain\" />";
//echo "<param name=\"movie\" value=\"style/Flame/images/logo_lt.swf\" />";
//echo "<param name=\"quality\" value=\"high\" />";
//echo "<param name=\"bgcolor\" value=\"#131313\" />";
//echo "<embed src=\"style/Flame/images/logo_lt.swf\" quality=\"high\" bgcolor=\"#131313\" width=\"468\" height=\"161\" name=\"logo_lt\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>";
echo "</td>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_08.gif\" width=\"317\" height=\"161\" alt=\"\"></td>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_09.gif\" width=\"35\" height=\"161\" alt=\"\"></td>";
echo "</tr>";
echo "<tr>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_10.gif\" width=\"35\" height=\"69\" alt=\"\"></td>";
echo "	<td>";
echo "		<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0\" width=\"468\" height=\"69\" id=\"nav\" align=\"middle\">";
echo "<param name=\"allowScriptAccess\" value=\"sameDomain\" />";
echo "<param name=\"movie\" value=\"style/Flame/images/nav.swf?link1=" . urlencode('index.php') . "&amp;link1text=" . urlencode('HOME') . "&amp;link2=" . urlencode('forum.php') . "&amp;link2text=" . urlencode('FORUM') . "&amp;link3=" . urlencode('torrents.php') . "&amp;link3text=" . urlencode('DOWNLOAD') . "&amp;link4=" . urlencode('upload.php') . "&amp;link4text=" . urlencode('UPLOAD') . "\" />";
echo "<param name=\"quality\" value=\"high\" />";
echo "<param name=\"bgcolor\" value=\"#131313\" />";
echo "<embed src=\"style/Flame/images/nav.swf?link1=" . urlencode('index.php') . "&amp;link1text=" . urlencode('HOME') . "&amp;link2=" . urlencode('forum.php') . "&amp;link2text=" . urlencode('FORUM') . "&amp;link3=" . urlencode('torrents.php') . "&amp;link3text=" . urlencode('DOWNLOAD') . "&amp;link4=" . urlencode('upload.php') . "&amp;link4text=" . urlencode('UPLOAD') . "\" quality=\"high\" bgcolor=\"#131313\" width=\"468\" height=\"69\" name=\"nav\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>";
echo "</td>";
echo "	<td>";
echo "		<object classid=\"clsid:d27cdb6e-ae6d-11cf-96b8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0\" width=\"317\" height=\"69\" id=\"ticker\" align=\"middle\">";
echo "<param name=\"allowScriptAccess\" value=\"sameDomain\" />";
echo "<param name=\"movie\" value=\"style/Flame/images/ticker.swf\" />";
echo "<param name=\"quality\" value=\"Low\" />";
echo "<param name=\"bgcolor\" value=\"161616\" />";
echo "             <param name=\"_cx\" value=\"8387\">";
echo "             <param name=\"_cy\" value=\"1826\">";
echo "             <param name=\"FlashVars\" value>";
echo "             <param name=\"Src\" value=\"style/Flame/images/ticker.swf\">";
echo "             <param name=\"WMode\" value=\"Window\">";
echo "             <param name=\"Play\" value=\"0\">";
echo "             <param name=\"Loop\" value=\"-1\">";
echo "             <param name=\"SAlign\" value>";
echo "             <param name=\"Menu\" value=\"-1\">";
echo "             <param name=\"Base\" value>";
echo "             <param name=\"Scale\" value=\"ShowAll\">";
echo "             <param name=\"DeviceFont\" value=\"0\">";
echo "             <param name=\"EmbedMovie\" value=\"-1\">";
echo "             <param name=\"SWRemote\" value>";
echo "             <param name=\"MovieData\" value>";
echo "             <param name=\"SeamlessTabbing\" value=\"1\">";
echo "             <param name=\"Profile\" value=\"0\">";
echo "             <param name=\"ProfileAddress\" value>";
echo "             <param name=\"ProfilePort\" value=\"0\">";
echo "<embed src=\"style/Flame/images/ticker.swf\" quality=\"low\" bgcolor=\"#161616\" width=\"317\" height=\"69\" name=\"ticker\" align=\"middle\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" /></object>";
echo "</td>";
echo "	<td>";
echo "		<img src=\"style/Flame/images/header_13.gif\" width=\"35\" height=\"69\" alt=\"\"></td>";
echo "</tr>";
echo "</table>";
?>
</td>
</tr>
<tr><td height="100" colspan="2">
<?
    echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
    echo "        <tr valign=\"top\">\n";
    echo "        <td style=\"width: 35px; background-image: url(style/Flame/images/border_lt.gif)\" valign=\"top\"><img src=\"style/Flame/images/spacer.gif\" width=\"35\" height=\"2\" border=\"0\" alt=\"\" /></td>\n";
    echo "        <td valign=\"top\">\n";
?>
<?php
main_menu();
    ?>

<?
    echo "        </td>\n";
    echo "        <td style=\"width: 35px; background-image: url(style/Flame/images/border_rt.gif)\" valign=\"top\"><img src=\"style/Flame/images/spacer.gif\" alt=\"\" width=\"35\" height=\"2\" /></td>\n";
    echo "        </tr>\n";
    echo "</table>\n\n\n";
?>
<table width="100%" height="100%"  border="0">
<tr>
<?
    echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
    echo "        <tr valign=\"top\">\n";
    echo "        <td style=\"width: 35px; background-image: url(style/Flame/images/border_lt.gif)\" valign=\"top\"><img src=\"style/Flame/images/spacer.gif\" width=\"35\" height=\"2\" border=\"0\" alt=\"\" /></td>\n";
    echo "        <td valign=\"top\">\n";
?>

<?php

side_menu();

?>
</td>
<TD vAlign="top">
<center><a href=http://axxo.cyberfun.ro/ target=_blank>aXXo .::. Tracker</a><br /></center>
<center>
<center><a href=# target=_top>Click on Google Ads to help us -- Thank you</a><br /></center>
<center><a href=/upload.php target=_top>Upload now -- Thank you</a><br /></center>
<script type="text/javascript"><!--
google_ad_client = "pub-2155280844524582";
/* CyBeR FuN - Flame style */
google_ad_slot = "5744012948";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>