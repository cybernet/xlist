<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5.X Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");

dbconn();
standardheader("Add/Remove Stats");

$s=array(KB => '1024', MB => '1048576', GB => '1073741824', TB => '1099411627776' );
$opt=array("KB","MB","GB","TB");
$opt2=array("Uploaded","Downloaded");
(isset($_GET['nick'])) ? $nickname = $_GET['nick'] : $nickname = '';

if (!$CURUSER || $CURUSER["owner_access"]!="yes"){
err_msg(ERROR, ERR_NOT_AUTH);
stdfoot();
exit;
}
else

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if ($_POST["username"] == "" || $_POST["unit"] == "" || $_POST["amount"] == "" || is_numeric($_POST["amount"])==false || $_POST["reason"] == ""){
err_msg(ERROR, ERR_MISSING_DATA);
stdfoot();
exit;
}

$username=mysql_escape_string($_POST["username"]);
$unit=$_POST["unit"];
$amount=$_POST["amount"];
$reason=mysql_escape_string($_POST["reason"]);
$upordown=$_POST["upordown"];

if ($upordown=="up") $change="upload";
else $change="download";

$userunknown=mysql_fetch_array(mysql_query("SELECT id FROM users WHERE username='".$username."' "));
if (!$userunknown) {
err_msg(ERROR, "Username does not exist");
stdfoot();
exit;
}

else {
@mysql_query("UPDATE users SET ".$change."ed = ".$change."ed + ($amount * $s[$unit]) WHERE username = '$username'") or sqlerr(__FILE__, __LINE__);

If ($amount<0){
$sub=ucwords($change)." Stats Removed";
$msg="I have removed ".abs($amount)."$unit from your $change stats for the following reason: $reason";}
else{
$sub=ucwords($change)." Stats Added";
$msg="I have added $amount$unit to your $change stats for the following reason: $reason";}

@mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES (".$CURUSER['uid'].", ".$userunknown['id'].",UNIX_TIMESTAMP(), '$sub', '$msg')");

If ($amount<0)
       $note="Removed ".abs($amount)."$unit from $username's $change stats";
else
       $note="Added $amount$unit to $username's $change stats";

write_log($note,"modify");

       block_begin("Add/Remove Stats");
       print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
       print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
       print("<br /><font color=\"#FF0000\"><b>".$note."<br /><br /></td>\n");
       print("</tr></table></div><br />\n");
       block_end();
       exit();
}
}
block_begin("Add/Remove Stats");
?>
<center>
<form method=post action=addstats.php>
<table width="60%" border="0" class="lista">
<tr>
  <td align=left class="header"><? echo USER_NAME ?>: </td>
  <td align="left" class="lista"><input type="text" size="30" maxlength="40" name="username" value="<?php echo $nickname; ?>"/></td>
</tr>
<tr>
  <td align=left class="header">Amount: </td>
  <td align="left" class="lista"><input type="text" size="10" maxlength="20" name="amount" />&nbsp;
  <select name="unit">
<?php
for ($i=0; $i<count($opt); $i++) {
    $option="<option ";
    if ($opt[$i]=="GB") $option.="selected ";
    $option.="value=".$opt[$i].">".$opt[$i]."</option>";
    print($option);
}
?>
</select>&nbsp;
<select name="upordown">
<option value="up" selected>Up</option>
<option value="down">Down</option>
</select>
</td>
</tr>
<tr>
  <td align=left class="header">Reason: </td>
  <td align="left" class="lista"><input type="text" size="30" maxlength="200" name="reason" /></td>
</tr>
<tr>
   <td align=center class="header"></td>
   <td align=left class="lista" align="center"><input type="submit" name="conferma" value=<? echo FRM_CONFIRM ?> />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="annulla" value=<? echo FRM_CANCEL ?> /></td>
</table>
</form>
</center>
<?php
block_end();
stdfoot();
?>