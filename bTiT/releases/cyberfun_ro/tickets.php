<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

require_once("include/config.php");
require_once("include/functions.php");

dbconn();

$query	= mysql_query("SELECT * FROM config WHERE id=1");
$config = mysql_fetch_array($query);
$expire_date = $config['lot_expire_date'];
$number_winners = $config['lot_number_winners'];
$number_to_win = $config['lot_number_to_win'];
$enabled = $config['lot_status'];
$minupload = $config['lot_amount'];
$limit_buy = $config['limit_buy'];

standardheader(TICKETS);
$numwinners = $number_winners;
$expire = strtotime ($expire_date);

//$minupload =  $number_amount; //Minimum Upload Required to Buy Ticket!
$ratioerr = "<font color=\"red\"><b>".NEED_UPLOAD."</b></font>";

$res = mysql_query("SELECT downloaded, uploaded FROM users WHERE id=".$CURUSER['uid']." ") or die(mysql_error());
$result = mysql_fetch_assoc($res);
$purch = floor($result["uploaded"] / $minupload);
$total = mysql_num_rows(mysql_query("SELECT * FROM tickets"));
$me = mysql_num_rows(mysql_query("SELECT * FROM tickets WHERE user=".$CURUSER['uid']." "));
$pot = $total * $minupload;
$pot += $number_to_win;
$me2 = mysql_query("SELECT * FROM tickets WHERE user=".$CURUSER['uid']." ORDER BY id ASC");
while ($myrow = mysql_fetch_assoc($me2)){
	$ticketnumbers .=  $myrow['id'].", ";
}
if($purch >= $limit_buy){
	$purchaseable = $limit_buy;
}
else{
	$purchaseable = $purch;
}
if($me >= $limit_buy){
	$purchaseable = 0;
}
else{
	$purchaseable= $limit_buy-$me;
}
	
if (strtotime(date("d-m-Y H:i")) >= $expire || $enabled != 'yes'){
	$purchaseable = 0;
}
block_begin(TICKETS);

if(!$CURUSER || $CURUSER["view_news"]!="yes")
{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	block_end();
    stdfoot();
    exit();
}
?>

<table align="center" width="80%" class="lista">
<tr><td class="lista" width="80%" align="center"><a href="view_winners.php"><?php print VIEW_LAST_WINNERS; ?></a></td></tr>
<tr><td class="lista" width="80%" align="left">
<ul>
<li><?php print ("".TICK_MSG1.""); ?></li>
<li><?php print ("".TICK_MSG2."".makesize($minupload)."".TICK_MSG3.""); ?></li>
<li><?php print ("".TICK_MSG4.""); ?></li>
<li><?php print ("".TICK_MSG5.""); ?></li>
<li><?php print ("".TICK_MSG6."".$expire_date.""); ?></li>
<li><?php print ("".TICK_MSG7."".$number_winners."".TICK_MSG8."".makesize($pot/$number_winners)."".TICK_MSG9.""); ?> </li>
<li><?php print ("".TICK_MSG10.""); ?></li>
<li><?php print ("".TICK_MSG11.""); ?></li>
<li><?php print ("".TICK_MSG12."".$ticketnumbers.""); ?></li>
</ul>
<center><?php print ("".TICK_MSG13.""); ?></center>
<hr>

<table align="center" width="40%" class="frame" border="1" cellspacing="0" cellpadding="10">
	<tr>
		<td align="center">
		<table width="100%" class="tableb" class="main" border="1" cellspacing="0" cellpadding="5">
			<tr>
      			<td class="tableb"><?php print TOTAL_IN_POT; ?></td>
      			<td class="tableb"><?php print makesize($pot); ?></td>
			</tr>
			<tr>
      			<td class="tableb"><?php print TOTAL_TICKETS_SELLED; ?></td>
      			<td class="tableb" align="right"><?php print ("".$total." ".TICKETS.""); ?></td>
    		</tr>
    		<tr>
      			<td class="tableb"><?php print YOUR_TICKETS; ?></td>
      			<td class="tableb" align="right"><?php print ("".$me." ".TICKETS.""); ?></td>
    		</tr>
    		<tr>
      			<td class="tableb"><?php print PURCHASEABLE; ?></td>
      			<td class="tableb" align="right"><?php print ("".$purchaseable." ".TICKETS.""); ?></td>
    		</tr>
    	</table>
		</td>
	</tr>
</table>
<br />
<hr />
<br />
<center>
<?php

if (strtotime(date("d-m-Y H:i")) >= $expire || $enabled != 'yes'){
	print("<h1><font color=red>".COMP_CLOSED."</font></h1>");
}

if ($purchaseable > 0){
	print("<form method=post action=purchasetickets.php>".PURCHASE."<input type=text name=number>".TICKETS."<input type=submit value=Purchase></form>");
}

print("</center>");
print("</td></tr></table>");
block_end();
stdfoot();
?>
