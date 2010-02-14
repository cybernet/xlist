<?php
require_once ("include/functions.php");
require_once ("include/config.php");

global $BASEURL, $SITENAME;

dbconn();

standardheader("LinkToUs");
block_begin("Link to Us");
?>
<table width=100% border=0 cellspacing=0 cellpadding=5>
<tr>
<center><b><font size="4">Support <?php echo $SITENAME  ?> By Link To Us!</font></b></center>
<br><br>
By putting one of our Ads on your site, you are supporting <?php echo $SITENAME  ?>.
<br>
If u are an user here and help panthera to get new members, we are offering you<br>
free V.I.P membership. To get free membership, just put one of our banners on ur site.<br>
When u have putted the banner on your site, PM me with your site URL and i will update your account!
<br><br>
<b>Banner One</b>
<br><br>
<img src="images/ads/panthera_add1.gif" border="0">
<br>
<b>Code:</b>
<br>
<textarea cols="50" rows="5"><a href="<?php echo $BASEURL ?>" target="_blank"><img src="<?php echo $BASEURL ?>/images/ads/panthera_add1.gif" border="0"></a></textarea><br><br>
<b>Banner Two</b>
<br><br>
<img src="images/ads/panthera_add2.gif" border="0">
<br>
<b>Code:</b>
<br>
<textarea cols="50" rows="5"><a href="<?php echo $BASEURL ?>" target="_blank"><img src="<?php echo $BASEURL ?>/images/ads/panthera_add2.gif" border="0"></a>
</textarea><br><br>
<b>Banner Three</b>
<br><br>
<img src="images/ads/panthera_add3.gif" border="0">
<br>
<b>Code:</b>
<br>
<textarea cols="50" rows="5"><a href="<?php echo $BASEURL ?>" target="_blank"><img src="<?php echo $BASEURL ?>/images/ads/panthera_add3.gif" border="0"></a>
</textarea><br><br>
<b>Banner Four</b>
<br><br>
<img src="images/ads/panthera_add4.gif" border="0">
<br>
<b>Code:</b>
<br>
<textarea cols="50" rows="5"><a href="<?php echo $BASEURL ?>" target="_blank"><img src="<?php echo $BASEURL ?>/images/ads/panthera_add4.gif" border="0"></a>
</textarea><br><br>
<b>Banner Five</b>
<br><br>
<img src="images/ads/pantherabits123.gif" border="0">
<br>
<b>Code:</b>
<br>
<textarea cols="50" rows="5"><a href="<?php echo $BASEURL ?>" target="_blank"><img src="<?php echo $BASEURL ?>/images/ads/pantherabits123.gif" border="0"></a>
</textarea><br><br>
</td>
</tr>
</table>
<?php
block_end();
stdfoot();
?>