<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader("Mass E-Mail");

if (!$CURUSER || $CURUSER["admin_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

 $subject = $HTTP_POST_VARS["subject"];
     $subject = stripslashes($subject);
     $content_1 = $HTTP_POST_VARS["content_1"];
     $content_1 = htmlentities($content_1, ENT_QUOTES);
     $content_1 = stripslashes($content_1);
     $content_1 = "<font face=\"arial\"> ". $content_1 ." </font>";

 //query email addresses from db

     $SQL = mysql_query("SELECT email FROM users WHERE id>1");

     while($row = mysql_fetch_array($SQL))
         {

//collect emails in array

         $EmailAddress2[] = $row["email"];
         }
block_begin("Mail All Registered Users");
?>
<form method=post action=massmail.php>
<table width=100%>
<tr><td ALIGN=right><b>Subject: </b></td><td><input type='text' name='subject' size='80'></td></tr>
<tr><td ALIGN=right valign=top><b>Message: </b></td><td><textarea name="content_1" rows="15" cols="60"></textarea></td></tr>
<tr><td align=center colspan=2><input type=submit value="Send Mail" class=btn></td></tr>
</table>
</form>
<?php
if($content_1 || "" and $subject || "")
{
 $res = mysql_query("SELECT email FROM users WHERE id>1") or sqlerr();
 $subject2 = $subject;
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
$headers .= "From:".$CURUSER['email']."\r\n";
$mailbody = $HTTP_POST_VARS["content_1"];
 $to = "";
 $nmax = 1000; // Max recipients per message
 $nthis = 0;
 $ntotal = 0;
 $total = mysql_num_rows($res);
 while ($arr = mysql_fetch_row($res)) {
   if ($nthis == 0)
     $to = $arr[0];
   else
     $to .= "," . $arr[0];
   ++$nthis;
   ++$ntotal;
   if ($nthis == $nmax || $ntotal == $total) {
     if (!mail("Multiple recipients <$SITEEMAIL>", "$subject", $mailbody,
      "From: $SITEEMAIL\r\nBcc: $to", "-f$SITEEMAIL"))
     $nthis = 0;
   }
}
    echo "<p align=center>Sent From: $SITEEMAIL. <br>";
    echo "Message: $mailbody <br>";
    echo "Message Sent!</p>";
}
block_end();
stdfoot();
?>