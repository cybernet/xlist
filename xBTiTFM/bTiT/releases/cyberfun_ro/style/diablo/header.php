<?php
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");
echo " <table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
echo "  <tr> ";
echo "   <td width=\"100%\" height=\"240\" valign=\"top\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/htmm.jpg\">";
echo "       <tr> ";
echo "         <td width=\"63\" height=\"240\" valign=\"top\"><img src=\"style/diablo/images/htl.jpg\" width=\"101\" height=\"240\"></td>";
echo "         <td width=\"100%\" align=\"center\" valign=\"top\"> <object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"626\" height=\"240\">";
echo "             <param name=\"movie\" value=\"style/diablo/images/htm.swf\">";
echo "             <param name=\"quality\" value=\"high\">";
echo "             <embed src=\"style/diablo/images/htm.swf\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"626\" height=\"240\"></embed></object></td>";
echo "         <td width=\"105\" valign=\"top\"><img src=\"style/diablo/images/htr.jpg\" width=\"105\" height=\"240\"></td>";
echo "       </tr>";
echo "     </table></td>";
echo " </tr>";
echo " <tr> ";
echo "   <td height=\"72\" valign=\"top\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/hbmm.jpg\">";
echo "        <tr> ";
echo "         <td width=\"193\" height=\"72\" valign=\"top\"><object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0\" width=\"387\" height=\"72\">";
echo "             <param name=\"movie\" value=\"style/diablo/images/hbl.swf?link1=" . urlencode('index.php') . "&amp;link1text=" . urlencode('HOME') . "&amp;link2=" . urlencode('forum.php') . "&amp;link2text=" . urlencode('FORUM') . "&amp;link3=" . urlencode('torrents.php') . "&amp;link3text=" . urlencode('DOWNLOAD') . "&amp;link4=" . urlencode('upload.php') . "&amp;link4text=" . urlencode('UPLOAD') . "\">";
echo "             <param name=\"quality\" value=\"high\">";
echo "             <embed src=\"style/diablo/images/hbl.swf?link1=" . urlencode('index.php') . "&amp;link1text=" . urlencode('HOME') . "&amp;link2=" . urlencode('forum.php') . "&amp;link2text=" . urlencode('FORUM') . "&amp;link3=" . urlencode('torrents.php') . "&amp;link3text=" . urlencode('DOWNLOAD') . "&amp;link4=" . urlencode('upload.php') . "&amp;link4text=" . urlencode('UPLOAD') . "\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" width=\"387\" height=\"72\"></embed></object></td>";
echo "         <td width=\"100%\" align=\"center\" valign=\"top\"><img src=\"style/diablo/images/hbm.jpg\" width=\"48\" height=\"72\"></td>";
echo "         <td width=\"397\" valign=\"top\"><table width=\"396\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/hbr.jpg\">";
echo "               <tr> ";
echo "               <td width=\"37\" height=\"15\"></td>";
echo "               <td width=\"294\"></td>";
echo "               <td width=\"65\"></td>";
echo "             </tr>";
echo "             <tr>";
echo "               <td height=\"19\"></td>";
echo "               <td align=\"right\" valign=\"top\">";
echo "                 <font color=\"#666666\">"?>
<b><? echo file_get_contents("style/diablo/header.txt");?></b></font>
<?
echo "               <td></td>";
echo "             </tr>";
echo "             <tr>";
echo "               <td height=\"38\"></td>";
echo "               <td>&nbsp;</td>";
echo "               <td></td>";
echo "             </tr>";
echo "           </table></td>";
echo "       </tr>";
echo "     </table></td>";
echo " </tr>";
echo "</table>";
?>
</td>
</tr>
<tr><td height="100" colspan="2">
<?
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"10\" valign=\"top\" background=\"style/diablo/images/left.jpg\"><img src=\"style/diablo/images/left.jpg\" width=\"10\" height=\"1\" border=\"0\"></td>\n"
		."<td valign=\"top\">\n";
?>
<?php
main_menu();
?>
<?
    echo "</td>\n"
        ."<td width=\"10\" valign=\"top\" align=\"right\" background=\"style/diablo/images/right.jpg\"><img src=\"style/diablo/images/right.jpg\" width=\"10\" height=\"1\" border=\"0\"></td>\n"
	    ."</tr>\n"
	    ."</table>\n\n\n";
?>
</td></tr>
<table width="100%" height="100%"  border="0">
<tr>
<?
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"10\" valign=\"top\" background=\"style/diablo/images/left.jpg\"><img src=\"style/diablo/images/left.jpg\" width=\"10\" height=\"1\" border=\"0\"></td>\n"
		."<td valign=\"top\">\n";
?>
<?php

side_menu();

?>
<td valign=top>

