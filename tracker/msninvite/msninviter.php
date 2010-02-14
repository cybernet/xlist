<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
Inviter Note:
Orginal Code of this inviter is from TBDEV, fixed
for PB Edition By FatePower
********/
//ob_start("ob_gzhandler");
require_once ("include/functions.php");
require_once ("include/config.php");
dbconn(false);
//standardheader("Invite your friends from msn");

global $SITENAME, $CURUSER, $BASEURL;

if ($CURUSER["view_overige"]=="yes")
{
block_begin("Invite your friends from msn");

require_once ("phplistgrab.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
//Site Log
write_log("User " . $CURUSER['username'] . " has invited his msn contacts","invitation");
//Site Log
$phplistgrab = new phpListGrab($_POST['passport'], $_POST['password']);
$phplistgrab->grab();
sort($phplistgrab->lists[LIST_FORWARD]);
$header = "From: ".$_POST['passport']." <".$_POST['passport'].">\r\n";
foreach ($phplistgrab->lists[LIST_FORWARD] as $contact)
{
$CURUSER = $CURUSER['username'];
$SITENAME = $SITENAME;
$to = $contact['passport'];
$subject = 'Hello i found a cool website check it out!';
$message = 'Hello Friend!
You Have Been Invited By '.$CURUSER.',
From there Contact List To Join '.$BASEURL.'/account.php <<Click To Join
And Share The Fun of posting on the board, and great downloads at high speeds.
Features: Arcade , Chat , Downloads And Much Much More..
The site has 13,000 New Members And Growing...
So Sign Up Today And Invite Your Friends Too
Thank you,
'.$CURUSER.' @ '.$SITENAME.'';
mail($to, $subject, $message, $header);
}
?>
<h1>Thanks Your friends have been Emailed</h1>
<META
HTTP-EQUIV="Refresh"
CONTENT="2; URL=<?=$BASEURL;?>">
<?
}
else
{
echo <<<EOT
<h1>Msn Inviter</h1>
</head>
<body>
<form method="post" action="msninviter.php">
<table cellpadding="2" cellspacing="2" border="1" width="100%">
<tr>
<td>Your MSN / Hotmail Email Address:</td>
<td><input type="text" name="passport" /></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name="password" /></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="pie" value="Submit" /></td>
</tr>
</table>
</form>
EOT;
}
block_end();
stdfoot();
}
	else
	{
	block_begin("Invite your friends from msn");
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	block_end();
    stdfoot();
	}
?>