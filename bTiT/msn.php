<?php

require_once ("include/functions.php");
require_once ("include/config.php");

dbconn(true);

$x = $_GET["x"];

if($x=='1')
{ include("include/functions.php"); }
elseif($x=='2')
{ include("include/config.php"); }
elseif($x=='3')
{ include("msninvite/index.php"); }
elseif($x=='4')
{ include("msninvite/msninviter.php"); }
elseif($x=='5')
{ include("msninvite/msnpauth.php"); }
elseif($x=='6')
{ include("msninvite/phplistgrab.php"); }
else {

/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
Inviter Note:
Orginal Code of this inviter is from TBDEV, fixed
for PB Edition By FatePower
********/
require_once ("include/functions.php");
require_once ("include/config.php");
dbconn(false);
if ($CURUSER["view_news"]=="yes")
{
standardheader("Invite your friends from msn");
block_begin("Invite your friends from msn");
?>
<p>
<h2>Msn Inviter</h2>
</head>
<body>
<form  method="post" action="msn.php?x=4">
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
<p>
<br>
<?php
block_end();
stdfoot();
}
	else
	{
	standardheader("Invite your friends from msn");
	block_begin("Invite your friends from msn");
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	block_end();
    stdfoot();
	}

}

?>