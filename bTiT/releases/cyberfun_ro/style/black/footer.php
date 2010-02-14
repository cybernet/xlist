</td>
<?php
if(mysql_query("SELECT * FROM blocks WHERE position='r'"))
right_menu();

block_begin("Disclaimer",'1','justify',array('width'=>'500px','font'=>'10px Verdana,Tahoma', 'padding'=>'1px'));
global $SITENAME;
echo "None of the files shown here are actually hosted on this server ($SITENAME). The links are provided solely by this site's ($SITENAME) users. The administrator of this site ($SITENAME) cannot be held responsible for what its users post, or any other actions of its users. You may not use this site ($SITENAME) to distribute or download any material when you do not have the legal rights to do so. It is your own responsibility to adhere to these terms. By registering on and/or using this website ($SITENAME), it is assumed that you, as the user, has read, understood, and agreed to all the terms and conditions set forth by the site owner.";  
block_end();
?>
</tr>
</table>
<div align="center"><b>BLACK STYLE. Made by <a href="http://warez-bg.org" target="_blank">divx</a></b><br><? print_version() ?></div>
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