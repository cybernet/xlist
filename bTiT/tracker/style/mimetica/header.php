<?php
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<link href="torrent.css" rel="stylesheet" type="text/css">
<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" align="center">
<META NAME='description' CONTENT=' Free Torrent Downloads, file list, nova, big, upload, share, file, tracker, filelist, isohunt'>
<meta name='keywords' content= ' mp3, avi, bittorrent, torrent, torrents, movies, music, games, applications, apps, download, upload, share, file, tracker, filelist, isohunt, nova, pussy, free, live, cyberfun, btit, google, search'/>
<META NAME='author' CONTENT='cybernet'>
<META NAME='robots' CONTENT='FOLLOW,INDEX'>
<link rel="icon" href="./favicon.ico" type="image/x-icon" />
<META NAME='revisit-after' CONTENT='1 days'>

<META HTTP-EQUIV='Content-Language' CONTENT='EN'>
<META NAME='copyright' CONTENT=' @ WwW.CyBerFuN.ro'>
<?php
echo "<!-- theme mimetica by effectica &copy; 2005 All Rights Reserved -->\n";
echo "<table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "  <tr>\n";
echo "    <td><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "      <tr>\n";
echo "        <td class=\"head_01\"><img src=\"style/mimetica/images/bnr_01.gif\" alt=\"\" width=\"51\" height=\"187\"></td>\n";
echo "        <td class=\"head_02\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"50\" height=\"1\"></td>\n";
echo "        <td class=\"head_03\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_04\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_05\">&nbsp;</td>\n";
echo "      </tr>\n";
echo "      <tr>\n";
echo "        <td class=\"head_14\"><img src=\"style/mimetica/images/bnr_09.gif\" alt=\"\" width=\"51\" height=\"83\"></td>\n";
echo "        <td class=\"head_15\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"50\" height=\"1\"></td>\n";
echo "        <td class=\"head_16\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_17\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_18\">&nbsp;</td>\n";
echo "      </tr>\n";
echo "    </table></td>\n";
echo "    <td align=\"center\" class=\"tdsup\"><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"tabsup\">\n";
echo "      <tr>\n";
echo "        <td><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "          <tr>\n";
echo "            <td class=\"head_06\"><img src=\"style/mimetica/images/bnr_u_01_01.gif\" alt=\"\" width=\"51\" height=\"75\"></td>\n";
echo "            <td class=\"head_07\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "            <td class=\"head_08\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"102\" height=\"1\"></td>\n";
echo "            <td class=\"head_09\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"101\" height=\"1\"></td>\n";
echo "            <td class=\"head_10\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "            <td class=\"head_06\"><img src=\"style/mimetica/images/bnr_u_04_02.gif\" alt=\"\" width=\"51\" height=\"75\"></td>\n";
echo "          </tr>\n";
echo "        </table></td>\n";
echo "      </tr>\n";
echo "      <tr>\n";
echo "        <td class=\"head_logo\"><img src=\"style/mimetica/images/bnr.gif\" alt=\"\" width=\"407\" height=\"72\"></td>\n";
echo "      </tr>\n";
echo "      <tr>\n";
echo "        <td class=\"head_menu\">\n";
echo "<object type=\"application/x-shockwave-flash\" data=\"style/mimetica/images/bnr_menu.swf\" width=\"407\" height=\"123\">\n";
echo "<param name=\"movie\" value=\"style/mimetica/images/bnr_menu.swf\" />\n";
echo "</object>\n";
echo "			</td>\n";
echo "      </tr>\n";
echo "    </table></td>\n";
echo "    <td><table width=\"100%\"  border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "      <tr>\n";
echo "        <td class=\"head_05\">&nbsp;</td>\n";
echo "        <td class=\"head_11\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_12\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_13\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_01\"><img src=\"style/mimetica/images/bnr_08.gif\" alt=\"\" width=\"51\" height=\"187\"></td>\n";
echo "      </tr>\n";
echo "      <tr>\n";
echo "        <td class=\"head_18\">&nbsp;</td>\n";
echo "        <td class=\"head_19\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_20\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"51\" height=\"1\"></td>\n";
echo "        <td class=\"head_21\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\" width=\"50\" height=\"1\"></td>\n";
echo "        <td class=\"head_14\"><img src=\"style/mimetica/images/bnr_16.gif\" alt=\"\" width=\"51\" height=\"83\"></td>\n";
echo "      </tr>\n";
echo "    </table></td>\n";
echo "  </tr>\n";
echo "</table>";
?>

<tr><td height="100" colspan="2">
<?
   echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "		<tr valign=\"top\">\n";
echo "		<td width=\"29\" valign=\"top\" style=\"background-image: url(style/mimetica/images/bord_l.gif)\"><img src=\"style/mimetica/images/spacer.gif\" width=\"29\" height=\"1\" border=\"0\" alt=\"\"></td>\n";
echo "		<td   valign=\"top\">\n";
?>

<?php
main_menu();
?>
<?
    echo "		</td>\n";
echo "        <td width=\"29\" valign=\"top\" style=\"background-image: url(style/mimetica/images/bord_r.gif)\"><img src=\"style/mimetica/images/spacer.gif\" alt=\"\"  width=\"29\" height=\"1\" border=\"0\"></td>\n";
echo "	    </tr>\n";
echo "</table>\n\n\n";
?>
</td></tr>
<table width="100%" height="100%"  border="0">
<tr>
<?
   echo "<table width=\"100%\"  cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n";
echo "		<tr valign=\"top\">\n";
echo "		<td width=\"29\" valign=\"top\" style=\"background-image: url(style/mimetica/images/bord_l.gif)\"><img src=\"style/mimetica/images/spacer.gif\" width=\"29\" height=\"1\" border=\"0\" alt=\"\"></td>\n";
echo "		<td   valign=\"top\">\n";
?>
<TD vAlign="top">
<?php
side_menu();
?>
</td>
<td valign=top>
<center><a href=http://axxo.cyberfun.ro/ target=_blank>aXXo .::. Tracker</a><br /></center>
<center>
<center><a href=# target=_top>Click on Google Ads to help us -- Thank you</a><br /></center>
<center><a href=/upload.php target=_top>Upload now -- Thank you</a><br /></center>
<script type="text/javascript"><!--
google_ad_client = "pub-2155280844524582";
/* CyBeR FuN - CyBeR FuN */
google_ad_slot = "3725268195";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</center>