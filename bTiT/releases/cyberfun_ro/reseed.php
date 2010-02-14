<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");


dbconn();

standardheader("Reseed request",true);

block_begin("Reseed Request Sent To:");

$sres = mysql_query("SELECT * FROM history WHERE infohash ='".$_GET["id"]."'");
while ($srow = mysql_fetch_array($sres)) {
$res =mysql_query("SELECT prefixcolor, suffixcolor, users.id, username,level FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id='".$srow["uid"]."'

$where") or die(mysql_error());
$result=mysql_fetch_array($res);
print("<a href=userdetails.php?id=$result[id]>".unesc($result["prefixcolor"]).unesc($result["username"]).unesc($result["suffixcolor"])."</a>, ");

$pn_msg = "Pleased seed for a torrent

$BASEURL/details.php?id=".$_GET["id"]." !\nThank You! Do not reply.";
$subject= '"Reseed Request"';
                $rec=$result["id"];
                $send="0";
             
                mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg)

VALUES ($send,$rec,UNIX_TIMESTAMP(), $subject, " . sqlesc($pn_msg) . ")") or

die(mysql_error());


global $BASEURL, $SITENAME, $SITEEMAIL;


$res = mysql_query("SELECT email FROM users WHERE id = $rec") or sqlerr();
$arr = mysql_fetch_assoc($res);
$email = $arr["email"];
$sender = $CURUSER['username'];
$txt = $pn_msg;
nl2br(htmlentities($txt));

$body = <<<EOD
You have received a new personal message from $sender.

Subject: $subject

$txt


You can use the URL below to reply (login may be required).

$BASEURL/usercp.php?uid=$rec&do=pm&action=list&what=inbox
------------------------------------------------
$SITENAME
EOD;


 ini_set("sendmail_from","");
     if (!mail($email, "New Personal Message From - $sender", $body, "From: $SITENAME <$SITEEMAIL>"))
   stderr("Error", "Your personal message has been sent\n" .
         "However, there was a problem delivering the e-mail notifcation.\n" .
         "Please let an administrator know about this error!\n");       



}
block_end();
stdfoot();
?>