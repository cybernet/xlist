<?php
block_begin("".xList_aDs."");
function google_ad_slot() {
global $CURUSER, $TABLE_PREFIX, $CACHE_DURATION;
$res = array();
$q = @mysql_fetch_assoc(do_sqlquery('SELECT google_ad_slot FROM '.$TABLE_PREFIX.'style where id='.$CURUSER["style"].';', true, $CACHE_DURATION));
return $q["google_ad_slot"];
}
?>
<center>
<script type="text/javascript"><!--
google_ad_client = "pub-2155280844524582";
/* 468x60, created 1/28/10 */
google_ad_slot = "<?php echo google_ad_slot(); ?>";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script><br /><br />
<!--/* OpenX Javascript Tag v2.8.4 */-->

<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://ads.xdns.ro/www/delivery/ajs.php':'http://ads.xdns.ro/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=10");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script>
</center>
<?php
block_end();
?>
