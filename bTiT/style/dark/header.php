<?php
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<?php
//Side menu by fatepower, start
   if ($GLOBALS["use_side_menu"] == true)
   {
?>
<head>
<style type="text/css">
<!--
body {
	margin-left: 20px;
	margin-top: 0px;
	margin-right: 20px;
	margin-bottom: 0px;
}
-->
</style>
<style type="text/css">
<!--
A.ssmItems:link		{color:black;text-decoration:none;}
A.ssmItems:hover	{color:black;text-decoration:none;}
A.ssmItems:active	{color:black;text-decoration:none;}
A.ssmItems:visited	{color:black;text-decoration:none;}
//-->
</style>

<SCRIPT SRC="js/ssm.js" language="JavaScript1.2">

//Dynamic-FX slide in menu v6.5 (By maXimus, http://maximus.ravecore.com/)
//Updated July 8th, 03' for doctype bug
//For full source, and 100's more DHTML scripts, visit http://www.dynamicdrive.com

</SCRIPT>

<SCRIPT SRC="js/ssmItems.js" language="JavaScript1.2"></SCRIPT>
</head>
<?php
}
//Side menu by fatepower, ends
?>
<table width="100%" height="100%"  border="0">
<tr>
<td height="100" colspan="2">
    <table width=100%>
    <tr><td align=left>
    <div><center><a href=./index.php><img border=0 src="<?php echo $STYLEPATH ?>/logo.gif"></a></center></div>
    </td>
    </tr>
    </table>
</td>
</tr>
<tr><td height="100" colspan="2">
<?php
main_menu();
//User Warning System Hack Start - 11:20 01.08.2006
$resuser=mysql_query("SELECT disabled FROM users WHERE id=".$CURUSER["uid"]);
$rowuser=mysql_fetch_array($resuser);
if ($rowuser["disabled"] == "yes")
{
redirect("logout.php");
}
else
{
}
//User Warning System Hack Stop
?>
</td></tr>
<table width="100%" height="100%"  border="0">
<tr>
<?php

side_menu();

?>
<td valign=top>
<!-- Start browser check, cuz best viewed in Firefox -->
<div id="browser warning" align="center">
<?php
   if ($GLOBALS["enable_browsercheck"] == true)
   {
$browser = $_SERVER['HTTP_USER_AGENT'];

if(preg_match("/MSIE/i",$browser))//browser is IE
{
echo '<p><center><img border="0" src="images/warn.gif"/></center>';
echo '<center><font size=\"+2\" color=#FF0000><b>Warning!</b></color></font></center>';
echo '<center><br /><font color=#000000>It appears as though you are running Internet Explorer.<br>This site was <b>NOT</b> intended to be viewed with Internet Explorer and chances are it will not look right and may not even function correctly.<br> But if you still want to use Internet Explorer then use Internet Explorer 7!<br>We on $SITENAME recommend that u are using Firefox 1.5 and adove.</font></center>';
echo '<script type="text/javascript"><!--
google_ad_client = "pub-4810871880873356";
google_ad_width = 180;
google_ad_height = 60;
google_ad_format = "180x60_as_rimg";
google_cpa_choice = "CAAQ24Oy0QEaCGbgW7AaXRokKMu293M";
google_ad_channel = "1971890568";
//-->
</script>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div><br />';
}

echo '
<div id=secound align=center>
<script type="text/javascript"><!--
google_ad_client = "pub-4810871880873356";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
//2007-04-02: Panthera
google_ad_channel = "6709042305";
google_color_border = "1F1B1B";
google_color_bg = "1F1B1B";
google_color_link = "FFFFFF";
google_color_text = "FFFFFF";
google_color_url = "008000";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>';


}
else
{
echo '
<div id=third align=center>
<script type="text/javascript"><!--
google_ad_client = "pub-4810871880873356";
google_ad_width = 468;
google_ad_height = 60;
google_ad_format = "468x60_as";
google_ad_type = "text_image";
//2007-04-02: Panthera
google_ad_channel = "6709042305";
google_color_border = "1F1B1B";
google_color_bg = "1F1B1B";
google_color_link = "FFFFFF";
google_color_text = "FFFFFF";
google_color_url = "008000";
//-->
</script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>';
}
?>