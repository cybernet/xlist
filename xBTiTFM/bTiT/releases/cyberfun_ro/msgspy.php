<?php
// Message spy by TeeSee64

require_once("include/functions.php");
require_once("include/config.php");


dbconn(true);

standardheader("msgspy");


if (!$CURUSER || $CURUSER["admin_access"] != "yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}


block_begin("Messages Spy");



$res2 = mysql_query("SELECT COUNT(*) FROM messages ORDER BY id DESC");
        $row = mysql_fetch_array($res2);
        $count = $row[0];
//$perpage = 15;
$perpage = (max(0, $CURUSER["postsperpage"]) > 0 ? $CURUSER["postsperpage"] : 20);
//list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] ."?msgspy=msgspy&" );
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, "msgspy.php?&" );
echo $pagertop;

$res = mysql_query("SELECT * FROM messages ORDER BY id DESC $limit") or sqlerr(__FILE__, __LINE__);
  print("<table width=90% class=lista align=center border=1 cellspacing=0 cellpadding=3>\n");
  ///////////////////////////////////////
?>
<form method="post" action="<?$SITEURL?>take-deletepm.php">
<?php
///////////////////////////////////////
  print("<tr><td class=header align=left>Sender</td><td class=header align=left>Receiver</td><td class=header align=left>Text</td><td class=header align=left>Date</td><td class=header>Delete</td></tr>\n");
  while ($arr = mysql_fetch_assoc($res))
  {
    $res2 = mysql_query("SELECT username FROM users WHERE id=" . $arr["receiver"]) or sqlerr();
    $arr2 = mysql_fetch_assoc($res2);
    $receiver = "<a href=userdetails.php?id=" . $arr["receiver"] . "><b>" . $arr2["username"] . "</b></a>";
    $res3 = mysql_query("SELECT username FROM users WHERE id=" . $arr["sender"]) or sqlerr();
    $arr3 = mysql_fetch_assoc($res3);
    $sender = "<a href=userdetails.php?id=" . $arr["sender"] . "><b>" . $arr3["username"] . "</b></a>";
             if( $arr["sender"] == 2 )
             $sender = "<font color=red><b>Admin</b></font>";
			 if( $arr["sender"] == 0 )
             $sender = "<font color=red><b>System</b></font>";
    $msg = format_comment($arr["msg"]);
  $added = format_comment(date("d/m/Y", $arr["added"]));
  print("<tr><td align=left class=blocklist>$sender</td><td align=left class=blocklist>$receiver</td><td align=left class=lista>$msg</td><td align=left class=lista>$added</td>");
  
/////////////////////////////////////////////////////////////////////////////////
  if ($_GET[check] == "yes") {
    echo("</td><TD class=blocklist><INPUT type=\"checkbox\" checked name=\"delmp[]\" value=\"" . $arr['id'] . "\"></TD>\n</TR>\n");
   }
   else {
    echo("</td><TD class=lista><INPUT type=\"checkbox\" name=\"delmp[]\" value=\"" . $arr['id'] . "\"></TD>\n</TR>\n");
   }

  /////////////////////////////////////////////////////////////////////////////////
}
print("<BR></table>");
print("<br><table width=90% align=center border=0 cellspacing=0 cellpadding=0>");
print("<tr>");
print("<td align=right>");
print("<input type=\"submit\" value=\"Delete!\" />");
print("</td></tr></table></form>");
/****
print("<table width=90% align=center border=0 cellspacing=0 cellpadding=0>");
print("<tr>");
print("<td>");
print("<BR><div align=right>");
print("<a href=msgspy.php?&page=$_GET[page]action=$_GET[action]&box=$_GET[box]&check=yes>Select All</A>");
print("</div>");
print("</td></tr></table>");
****/
echo $pagerbottom;

block_end();
stdfoot();
?>
