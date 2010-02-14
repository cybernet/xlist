<?

//!miskotes TORRENT REQUEST

require_once("include/functions.php");

dbconn();

standardheader("Delete");
global $CURUSER;
if (!$CURUSER || $CURUSER["edit_torrents"]=="no")
   {
    // do nothing
   }
else
    {

block_begin("Deleted");

if (empty($_POST["delreq"])){
   print("<table border=0 width=100% cellspacing=2 cellpadding=0><tr><td class=lista align=center>You must select at least one request to delete.</td></tr></table>");
block_end();
stdfoot(false);
die;
}

$do="DELETE FROM requests WHERE id IN (" . implode(", ", $_POST[delreq]) . ")";
$do2="DELETE FROM addedrequests WHERE requestid IN (" . implode(", ", $_POST[delreq]) . ")";
$res2=mysql_query($do2);
$res=mysql_query($do);

print(" <table border=0 width=100% cellpadding=0><tr><td class=lista align=center>Go back to<a href=viewrequests.php><b> REQUESTS</a></table>");

block_end();
}
stdfoot();
?>