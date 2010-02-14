</td>
<?php
right_menu();
    echo "</td>\n"
        ."<td width=\"10\" valign=\"top\" align=\"right\" background=\"style/diablo/images/right.jpg\"><img src=\"style/diablo/images/right.jpg\" width=\"10\" height=\"1\" border=\"0\"></td>\n"
	    ."</tr>\n"
	    ."</table>\n\n\n";?>
</tr>
<?
echo"<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/ftmm.jpg\">"
  . "  <tr> "
  . "    <td width=\"248\" height=\"168\" valign=\"top\"><table width=\"248\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/fl.jpg\">"
  . "        <tr> "
  . "          <td width=\"40\" height=\"40\">&nbsp;</td>"
  . "          <td width=\"113\">&nbsp;</td>"
  . "          <td width=\"65\">&nbsp;</td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td height=\"94\">&nbsp;</td>"
  . "          <td valign=\"top\">"
?>
<center><font face="verdana" size="1" color="#999999"><?
//
// *************************************************************************************************************************************
//			PLEASE DO NOT REMOVE THE POWERED BY LINE, SHOW SOME SUPPORT! WE WILL NOT SUPPORT ANYONE WHO HAS THIS LINE EDITED OR REMOVED!
// *************************************************************************************************************************************
GLOBAL $time_start, $gzip, $PRINT_DEBUG,$tracker_version;
  $time_end = get_microtime();
  print("<p align=center>");
  if ($PRINT_DEBUG)
        print(" Script Execution time: ".number_format(($time_end-$time_start),4)." sec. <br />");
print("BtiTracker ($tracker_version) by <a href=\"http://www.btiteam.org\">Btiteam</a><br />");
print ("<a href=\"http://besttracker.info\" target=\"_blank\">Theme by Hack346</a></CENTER></p>");
//
// *************************************************************************************************************************************
//			PLEASE DO NOT REMOVE THE POWERED BY LINE, SHOW SOME SUPPORT! WE WILL NOT SUPPORT ANYONE WHO HAS THIS LINE EDITED OR REMOVED!
// *************************************************************************************************************************************

?></font></center>
</td>
<?
  echo"        <td>&nbsp;</td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td height=\"36\">&nbsp;</td>"
  . "          <td>&nbsp;</td>"
  . "          <td>&nbsp;</td>"
  . "        </tr>"
  . "      </table></td>"
  . "    <td width=\"100%\" align=\"center\" valign=\"top\"><img src=\"style/diablo/images/fm.jpg\" width=\"336\" height=\"168\"></td>"
  . "    <td width=\"248\" valign=\"top\"><table width=\"248\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" background=\"style/diablo/images/fr.jpg\">"
  . "        <tr> "
  . "          <td width=\"67\" height=\"38\">&nbsp;</td>"
  . "          <td width=\"126\">&nbsp;</td>"
  . "          <td width=\"55\">&nbsp;</td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td height=\"94\">&nbsp;</td>"
  . "          <td valign=\"top\">"
?>
<font color="#999999"><div class="scroller"><? echo file_get_contents("style/diablo/footer.txt");?></div></td>
</td>
<?
  echo"        <td>&nbsp;</td>"
  . "        </tr>"
  . "        <tr>"
  . "          <td height=\"36\">&nbsp;</td>"
  . "          <td>&nbsp;</td>"
  . "          <td>&nbsp;</td>"
  . "        </tr>"
  . "      </table></td>"
  . "  </tr>"
  . "</table>"
 ."";
?>
<?php

echo "<!-- NEW LOWER-FOOTER SECTION -->\n";
echo "      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
echo "        <tr>\n";
echo "          <td width=\"15\" height=\"240\"><img src=\"style/diablo/images/fbl.jpg\" alt=\"\" width=\"15\" height=\"240\" /></td>\n";
echo "          <td style=\"background-image: url(style/diablo/images/fbm.jpg)\">\n";
echo "<div style=\"font-size: xx-small;\" align=\"center\">\n";?>
<?php include "style/diablo/images/ads2.html" ?>
<?php
echo "</div>";
echo "          <td width=\"15\"><img src=\"style/diablo/images/fbr.jpg\" alt=\"\" width=\"15\" height=\"240\" /></td>\n";
echo "        </tr>\n";
echo "      </table>\n";
?>
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