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
</script>
</center>
<?php
block_end();
?>
