<?
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();


global $CURUSER;
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    // do nothing
   }
else
    {

global $SYLEPATH, $BASEURL;
block_begin("".CF_INVITE_A_FRIEND."");
begin_table();
print("\n<table class=\"lista\" align=\"center\" width=\"100%\">");
?>
<td align="center">
<form action="sendinvite.php" method="POST">
<b><?php echo "".CF_INVITE_NAME."";?></b><br>
<input type="text" name="your" size=20>
<br>
<br><b><?php echo "".CF_FRIENDS_NAME."";?></b><br>
<input type="text" name="friend" size=20>
<br>
<br><b><?php echo "".CF_FRIENDS_EMAIL."";?></b><br>
<input type="text" name="email" size=20>
<br>
<p><input type="submit" value="<?php echo "".CF_SUBMIT_INVITE."";?>">
</form>

<?
end_table();
block_end();
}
?>
