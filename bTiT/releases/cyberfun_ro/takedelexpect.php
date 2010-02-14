<?php
require_once("include/functions.php");
require_once("include/config.php");

dbconn();

standardheader("Delete");
global $CURUSER;
if (!$CURUSER || $CURUSER["can_upload"]=="no")
   {
    // do nothing
   }
else
    {

block_begin(DELETED);

if (empty($_POST["delexpect"])){
   print("<table border=0 width=100% cellspacing=2 cellpadding=0><tr><td class=lista align=center>" . MUST_SEL_EXP . "</td></tr></table>");
block_end();
stdfoot(false);
die;
}

$do="DELETE FROM expected WHERE id IN (" . implode(", ", $_POST[delexpect]) . ")";
$res=mysql_query($do);

print(" <table border=0 width=100% cellpadding=0><tr><td class=lista align=center>" . RETURN_EXPECT . "<a href=viewexpected.php><b>" . EXPECTED . "</a></table>");

block_end();
}
stdfoot();
?>