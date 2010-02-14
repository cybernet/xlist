<?php
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<BODY LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0" align="center">
<table width="100%" height="226" border="0" cellpadding="0" cellspacing="0">
  	<tr>
  		<td>
  			<img src="style/Spider-X/images/HD/logo.jpg" width="438" height="158" alt=""></td>
  		<td rowspan="5" background="style/Spider-X/images/HD/exp.jpg" width="100%" height="226" alt=""></td>
  		<td>
  			<img src="style/Spider-X/images/HD/header_03.jpg" width="106" height="158" alt=""></td>
  		<td>
  			<img src="style/Spider-X/images/HD/spider.jpg" width="172" height="158" alt=""></td>
  		<td>
  			<img src="style/Spider-X/images/HD/header_05.jpg" width="61" height="158" alt=""></td>
  	</tr>
  	<tr>
  		<td rowspan="3">
  		<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" width="438" height="44" id="nav" align="middle">
  		<param name="allowScriptAccess" value="sameDomain" />
  		<param name="movie" value="style/Spider-X/images/HD/nav.swf" />
  		<param name="quality" value="high" />
  		<param name="bgcolor" value="#1b1b1b" />
  		<embed src="style/Spider-X/images/HD/nav.swf" quality="high" bgcolor="#1b1b1b" width="438" height="44" name="nav" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
  		</object>
  		</td>
  		<td>
  			<img src="style/Spider-X/images/HD/header_07.jpg" width="106" height="12" alt=""></td>
  		<td>
  			<img src="style/Spider-X/images/HD/header_08.jpg" width="172" height="12" alt=""></td>
  		<td>
  			<img src="style/Spider-X/images/HD/header_09.jpg" width="61" height="12" alt=""></td>
  	</tr>
  	<tr>
  		<td rowspan="2">
  			<img src="style/Spider-X/images/HD/header_10.jpg" width="106" height="32" alt=""></td>
  		<td background="style/Spider-X/images/HD/news.jpg" width="172" height="24" alt=""><b><? echo file_get_contents("style/Spider-X/header.txt");?></b></td>
  		<td rowspan="2">
  			<img src="style/Spider-X/images/HD/header_12.jpg" width="61" height="32" alt=""></td>
  	</tr>
  	<tr>
  		<td>
  			<img src="style/Spider-X/images/HD/header_13.jpg" width="172" height="8" alt=""></td>
  	</tr>
  	<tr>
  		<td>
  			<img src="style/Spider-X/images/HD/header_14.jpg" width="438" height="24" alt=""></td>
  		<td colspan="3">
  			<img src="style/Spider-X/images/HD/header_15.jpg" width="339" height="24" alt=""></td>
  	</tr>
  </table>
</td>
</tr>
<tr><td height="100" colspan="2">
<?
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"30\" valign=\"top\" background=\"style/Spider-X/images/left.jpg\"><img src=\"style/Spider-X/images/left.jpg\" width=\"30\" height=\"11\" border=\"0\"></td>\n"
		."<td valign=\"top\">\n";
?>
<?php
main_menu();
?>
<?
    echo "</td>\n"
        ."<td width=\"29\" valign=\"top\" align=\"right\" background=\"style/Spider-X/images/right.jpg\"><img src=\"style/Spider-X/images/right.jpg\" width=\"30\" height=\"11\" border=\"0\"></td>\n"
	    ."</tr>\n"
	    ."</table>\n\n\n";
?>
</td></tr>
<table width="100%" height="100%"  border="0">
<tr>
<?
echo "<table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\">\n"
		."<tr valign=\"top\">\n"
        ."<td width=\"30\" valign=\"top\" background=\"style/Spider-X/images/left.jpg\"><img src=\"style/Spider-X/images/left.jpg\" width=\"30\" height=\"11\" border=\"0\"></td>\n"
		."<td valign=\"top\">\n";
?>
<?php

side_menu();

?>
<td valign=top>

