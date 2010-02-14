<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
$query	= mysql_query("SELECT * FROM config WHERE id=1");
$row = mysql_fetch_array($query);

block_begin(LOT_SETTINGS);

$action = $_GET['action'];
$returnto	=	"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lottery";

if($action	==	'send'){
$val1	= 	$_POST['expire_date'];
$val2	=	$_POST['num_of_win'];
$val3	=	$_POST['min_amount']*1024*1024*1024;
$val4	=	$_POST['amount_to_pay']*1024*1024;
$val5	=	$_POST['status'];
$val6	=	$_POST['limit_buy'];
mysql_query("UPDATE config SET lot_expire_date='".$val1."', lot_number_winners='".$val2."', lot_number_to_win='".$val3."', lot_amount='".$val4."', lot_status='".$val5."', limit_buy='".$val6."' WHERE id=1 ");
	header("Location: $BASEURL/$returnto");
}
else{
print("<table width=100% align=center class=lista>");
print("<form method=post action=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=lottery&action=send name=lot_settings>");
print("<tr><td class=header width=50% align=left>".EXPIRE_DATE."<font color=green>".EXPIRE_DATE_VIEW."</font></td><td class=lista align=left><input name=expire_date type=text size=20 value=\"".$row['lot_expire_date']."\" >&nbsp;<fron size-6>(".$row['lot_expire_date']." ".IS_SET."</font></td></tr>");
print("<tr><td class=header width=50% align=left>".NUM_WINNERS."</td><td class=lista align=left><input name=num_of_win type=text size=20 value=".$row['lot_number_winners']." ></td></tr>");
print("<tr><td class=header width=50% align=left>".TICKET_COST."</td><td class=lista align=left><input name=amount_to_pay type=text size=20 value=".makesize($row['lot_amount'])." >Mb</td></tr>");
print("<tr><td class=header width=50% align=left>".MIN_WIN."</td><td class=lista align=left><input name=min_amount type=text size=20 value=".makesize($row['lot_number_to_win'])." >Gb</td></tr>");
print("<tr><td class=header width=50% align=left>".MAX_BUY."</td><td class=lista align=left><input name=limit_buy type=text size=20 value=".$row['limit_buy']."></td></tr>");
if($row['lot_status'] == 'yes'){
	print("<tr><td class=header width=50% align=left>".LOTTERY_STATUS."</td><td class=lista align=left><input type=radio name=status value=yes checked />".YES."&nbsp;&nbsp;<input type=radio name=status value=no/>".NO."</td></tr>");
}
else{
	print("<tr><td class=header width=50% align=left>".LOTTERY_STATUS."</td><td class=lista align=left><input type=radio name=status value=yes />".YES."&nbsp;&nbsp;<input type=radio name=status value=no checked />".NO."</td></tr>");
}
print("<tr><td class=header colspan=2 align=center><input name=submit type=submit value=".UPDATE.">&nbsp;&nbsp;<input name=reset type=reset value=".RESET."></td></tr>");
print("</form>");
print("<tr><td class=header colspan=2 align=center><a href=view_tickets.php>".VIEW_SELLED."</a></td></tr></table>");
}
block_end();
?>