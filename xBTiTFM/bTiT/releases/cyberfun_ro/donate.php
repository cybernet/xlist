<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/paypal.php");

dbconn();
standardheader("Donate");
if ("paypal.php")
            {
              $f=@fopen("paypal2.php","r");
              $paypal_button=@fread($f,filesize("paypal2.php"));
              @fclose($f);
	}
block_begin("Make a Donation");
?> 
<table width=100% border=0 cellspacing=0 cellpadding=5>
<tr>
<!-- EDIT THE FOLLOWING TEXT TO SUIT YOUR NEEDS -->
<td colspan="2" align=center class=lista><b>Click the donate button if you wish to make a donation!</b></td></tr>

  <tr> 
    <td width="20%" align="center" valign="top" class=lista><? echo $paypal_button; ?></td>
    <td width="80%" rowspan=2 class=lista> 
      All Donations are apprecatied NO matter how big or small there are.<br>
      <Br><br>
After you have donated -- make sure to <a href=usercp.php?do=pm&action=edit&uid=2&what=new&to=Larkspeed>PM me</a> the email address you used for the payment so I can upgrade your account.<br><br>
Thank You from everyone here at <?php echo $SITENAME ?>
</td>
</tr>
<!-- END TEXT EDIT -->
  <tr> 
    <td width="20%" align="center" valign="top" class=lista>Donations Needed<br /><? echo $GLOBALS["d_needed"]; ?><br />Donations Received<br /><? echo $GLOBALS["d_received"]; ?></td>
</tr>
</table>

<?php
block_end();
block_begin("Donations Received By");
			$cat=donator_list();
            print("<table class=\"lista\" width=\"100%\" align=\"center\">\n");
            print("<tr>\n");
            print("<td class=\"header\" align=\"center\">".DONATOR_NAME."</td>\n");
            print("<td class=\"header\" align=\"center\">".DONATION."</td>\n");
            print("<td class=\"header\" align=\"center\">".YTD_DONATION."</td>\n");
            print("</tr>\n");
            foreach($cat as $category) {
                         $res = mysql_query("SELECT * FROM users WHERE donator = " . $category["id"]);
                         print("<tr>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["donator"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["donation"]."</td>\n");
                         print("<td class=\"lista\" align=\"center\">".$category["ytd_donation"]."</td>\n");
                         print("</tr>\n");
                         }
            print("</table>");
block_end();
stdfoot();
?>