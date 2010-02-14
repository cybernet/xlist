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
If u are an user here and help <?php echo $SITENAME  ?> to get new members, we are offering you<br>
free V.I.P membership. To get free membership, just put one of our banners on ur site.<br>
When u have putted the banner on your site, PM me with your site URL and i will update your account!
<br><br>
<b>Banner One</b>
<br><br>
exemple:
<br><br>
<script type='text/javascript' src='http://tracker.cyberfun.ro/ads/link2us.js'></script>
<center>Please feel free to link to <strong>CyBeR FuN Tracker</strong> Use the following HTML:<br style="clear:both" />
<input type="text" tabindex="9" size="67" value="<script type='text/javascript' src='http://tracker.cyberfun.ro/ads/link2us.js'></script>" class="inputbox autowidth" onclick="this.focus();this.select();" /><br style="clear:both" /></center>
</td>
</tr>
</table>
<?php
block_end();
stdfoot();
?>
