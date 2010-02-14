<?php
require_once("include/config.php");
require_once("include/functions.php");

dbconn();

$query	= mysql_query("SELECT * FROM config WHERE id=1");
$config = mysql_fetch_array($query);
$expire_date = $config['lot_expire_date'];
$enabled = $config['lot_status'];
$limit_buy = $config['limit_buy'];

$minupload = $config['lot_amount']; //Minimum Upload Required to Buy Ticket!
$expire = strtotime ($expire_date);


standardheader("Tickets Page");
if ($CURUSER['id_level'] < 3 /* or $CURUSER['id_level'] > 6*/){
	print(NOT_USER_CLASS);
	die();
}

if (strtotime(date("d-m-Y H:i")) >= $expire || $enabled != 'yes')
{
print (CANNOT_SELL);
die();
}

$res = mysql_query("SELECT downloaded, uploaded FROM users WHERE id = ".$CURUSER['uid']."") or die(mysql_error());
$result = mysql_fetch_assoc($res);
$purchaseable = floor($result["uploaded"]/$minupload);
if ($_REQUEST['number'] > $purchaseable || $_REQUEST['number'] < 1)
{
print("<table class=frame width=737 cellspacing=0 cellpadding=5><tr><td><table class=main width=100% cellspacing=0 cellpadding=5><tr><td class=colhead align=left>ERROR</td></tr><tr><td>The max number of tickets you can purchase is ".$purchaseable."<br></td></tr></table></td></tr></table>");
stdfoot();
die;
}

$num_tickets = mysql_query("SELECT user FROM tickets WHERE user='$CURUSER[uid]'");
$user_tickets = mysql_num_rows($num_tickets);
//$res = $_REQUEST['number'] + $user_tickets;
if ($_REQUEST['number'] + $user_tickets > $limit_buy)
{
block_begin(ERROR);
print("<table class=frame width=737 cellspacing=0 cellpadding=5><tr><td><table class=main width=100% cellspacing=0 cellpadding=5><tr><td class=colhead align=left>ERROR</td></tr><tr><td>The max number of tickets allowed to buy is ".$limit_buy."<br></td></tr></table></td></tr></table>");
block_end();
stdfoot();
die;
} 

$upload = $result["uploaded"] - ($minupload * $_REQUEST['number']);
mysql_query("UPDATE users SET uploaded=".$upload." WHERE id=".$CURUSER['uid']."") or die(mysql_error());
$tickets = $_REQUEST['number'];
for ($i = 0; $i < $tickets; $i++){
	$random = rand(1234, 4321);
	$rand_check = mysql_query("SELECT * FROM tickets WHERE id=".$random."");
	if(mysql_num_rows($rand_check) > 0){
		$random = rand(4322, 9876);
		$rand_check = mysql_query("SELECT * FROM tickets WHERE id=".$random."");
		if(mysql_num_rows($rand_check) > 0){
			$random = rand(0, 1233);
		}
		else{
			print ("Sorry, if you see this. You are not lucky. PLease try again. If you see this for second time. PLease contact a staff member");
		}
	}

mysql_query("INSERT INTO tickets(id, user) VALUES(".$random.", ".$CURUSER['uid'].")");
}
$me = mysql_num_rows(mysql_query("SELECT * FROM tickets WHERE user=".$CURUSER['uid'].""));
block_begin(PURCHASE_SUCCES);
?>

<table align="center" class="lista" border=1 width=600 cellspacing=0 cellpadding=5>
<tr><td class=header width=600 align=center><?php print YOUR_TICKETS; ?></td></tr>
<tr><td class=lista align=center>
<?php print ("".PURCH_MSG1."".$_REQUEST["number"]."".PURCH_MSG2.""); ?><br>
<?php print ("".PURCH_MSG3."".$me.""); ?>!<br>
<?php print ("".PURCH_MSG4."".makesize($upload).""); ?>!<br>
<?php print ("".PURCH_MSG5.""); ?>
</td></tr></table>

<?php
block_end();
header("Refresh: 5; URL=tickets.php");
stdfoot();
?>