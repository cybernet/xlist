<?php
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/blocks.php");


dbconn(true);

standardheader("Send Invite");
block_begin("Send Invite");
/* All form fields are automatically passed to the PHP script through the array $HTTP_POST_VARS. */
$your = $HTTP_POST_VARS['your'];
$friend = $HTTP_POST_VARS['friend'];
$email = $HTTP_POST_VARS['email'];
$subject = "Your Friend Invites You to join $SITENAME";
$headers = 'From: $SITEEMAIL';
$message = <<<EOD

Hi $friend 

Your friend $your Invites you to join $SITENAME 

Please visit $BASEURL to sign up. 

Thanks, 

$SITENAME

(NOTE: This is an auto generated message do not reply directly to this mail.)

EOD;

/* PHP form validation: the script checks that the Email field contains a valid email address and the Subject field isn't empty. preg_match performs a regular expression match. It's a very powerful PHP function to validate form fields and other strings - see PHP manual for details. */
if (!preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/", $email)) {
  echo "<h4>Invalid email address</h4>";
  echo "<a href='javascript:history.back(1);'>Back</a>";
} elseif ($subject == "") {
  echo "<h4>No subject</h4>";
  echo "<a href='javascript:history.back(1);'>Back</a>";
}

/* Sends the mail and outputs the "Thank you" string if the mail is successfully sent, or the error string otherwise. */
elseif (mail($email,$subject,$message,$headers)) {
  echo "<h4>Your Invitation Has Been Sent</h4>";
} else {
  echo "<h4>Can't send email to $email</h4>";
}
block_end();
stdfoot();
?>
<script type="text/javascript">
<!--
  window.setTimeout("location.replace('index.php')",3000);
//-->
</script>