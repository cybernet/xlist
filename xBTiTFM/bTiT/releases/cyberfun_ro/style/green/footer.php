</td>
<?php
if(mysql_query("SELECT * FROM blocks WHERE position='r'"))
right_menu();
?>
</tr>
<tr>
<td height="20%" colspan="2">
<?php

   //print("<p align=right>BtitTracker (Alpha3) by Btiteam</p>"); //mysql_stat());
?>
</td></tr>
</table>
</table>
<!-- Piwik -->
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://stats.xlist.ro/" : "http://stats.xlist.ro/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://stats.xlist.ro/piwik.php?idsite=2" style="border:0" alt=""/></p></noscript>
<!-- End Piwik Tag -->
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-6249398-36");
pageTracker._trackPageview();
} catch(err) {}</script>