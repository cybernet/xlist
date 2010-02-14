<?php
global $CURUSER, $PRIVATE_TRACKER;

?>
<script type="text/javascript">
function newpm() {
<!--
var answer = confirm ("You have a new PM, please click OK to go to your PM Inbox.")
if (answer)
window.location='usercp.php?uid=<? echo $CURUSER["uid"]; ?>&do=pm&action=list'
// -->
}
</script>
<?php

  if (isset($CURUSER) && $CURUSER && $CURUSER["uid"]>1)
  {
?>
<table class="lista" cellpadding="2" cellspacing="0" width="100%">
<tr>
<?php
$style=style_list();
$langue=language_list();
$resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);
$rowuser=mysql_fetch_array($resuser);
//print("<td class=lista align=center>".WELCOME_BACK." ".$CURUSER['username']." (<a href=logout.php>".LOGOUT."</a>)</td>\n");
print("<td class=lista align=center>".USER_LEVEL.": ".$CURUSER["level"]."</td>\n");
print("<td class=green align=center>&#8593&nbsp;".makesize($rowuser['uploaded']));
print("</td><td class=red align=center>&#8595&nbsp;".makesize($rowuser['downloaded']));
print("</td><td class=lista align=center>(SR ".($rowuser['downloaded']>0?number_format($rowuser['uploaded']/$rowuser['downloaded'],2):"---").")</td>\n");
   if ($GLOBALS["enable_bonus"] == true)
      {
print("</td><td class=lista align=center>(<a href=seedbonus.php> Seed bonus</a>: ".$rowuser['seedbonus'].")</td>\n");
	  }
if ($CURUSER["mod_access"]=="yes")
   print("\n<td align=center class=lista><a href=admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"].">".MNU_ADMINCP."</a></td>\n");
//Report Hack Start
if ($CURUSER["mod_access"]=="yes"){
$resrep=mysql_query("SELECT COUNT(*) FROM reports WHERE dealtwith=0");
if ($resrep && mysql_num_rows($resrep)>0)
   {
    $rep=mysql_fetch_row($resrep);
    if ($rep[0]>0){
?><script language="JavaScript">
function windowOpener() {
   msgWindow=window.open("","displayWindow","menubar=no,scrollbars=no,status=no,width=300,height=120")
   msgWindow.document.write("<html><head><title>Message window<\/title><\/head>")
   msgWindow.document.write('<body><P align=center valign=center>There is a new report<\/P><\/body><\/html>');
}
windowOpener();
</script>
<?php
       print("\n<td align=center class=lista><a href=reports.php>".CF_REPORTS."</a> (<font color=\"#FF0000\"><b>$rep[0]</b></font>)</td>\n");
    }else
       print("\n<td align=center class=lista><a href=reports.php>".CF_REPORTS."</a></td>\n");
   }
else
   print("\n<td align=center class=lista><a href=reports.php>".CF_REPORTS."</a></td>\n");
}
//Report Hack End
print("<td class=lista align=center><a href=usercp.php?uid=".$CURUSER["uid"].">".USER_CP."</a></td>\n");
print("<td class=lista align=center><a href=usercp.php?do=invites&action=read&uid=".$CURUSER["uid"].">".MNU_UCP_INVITATIONS."</a></td>\n");
print("<td class=lista align=center><a href=wishlist.php>".CF_WISHLIST."</a></td>\n");
print("<td class=lista align=center><a href=friendlist.php>".FRIENDLIST."</a></td>\n");
print("<td class=lista align=center><a href=notepad.php>".NOTE_NOTEPAD."</a></td>\n");

$resmail=mysql_query("SELECT COUNT(*) FROM messages WHERE readed='no' AND receiver=$CURUSER[uid] AND delbyreceiver='no'");
if ($resmail && mysql_num_rows($resmail)>0)
   {
    $mail=mysql_fetch_row($resmail);
    if ($mail[0]>0) {
       if (substr($_SERVER['PHP_SELF'], -10)!="usercp.php")
       print( "<script language=\"javascript\">newpm();</script>");
       print("<td class=lista align=center><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a> (<font color=\"#FF0000\"><b>$mail[0]</b></font>)</td>\n");
    } else
        print("<td class=lista align=center><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a></td>\n");
   }
else
    print("<td class=lista align=center><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a></td>\n");

print("\n<form name=jump1><td class=lista><select name=\"style\" size=\"1\" onChange=\"location=document.jump1.style.options[document.jump1.style.selectedIndex].value\" style=\"font-size:10px\">");
foreach($style as $a)
               {
               print("<option ");
               if ($a["id"]==$CURUSER["style"])
                  print("selected=selected");
               print(" value=account_change.php?style=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["style"]."</option>");
               }
print("</select></td>");

print("\n<td class=lista><select name=\"langue\" size=\"1\" onChange=\"location=document.jump1.langue.options[document.jump1.langue.selectedIndex].value\" style=\"font-size:10px\">>");
foreach($langue as $a)
               {
               print("<option ");
               if ($a["id"]==$CURUSER["language"])
                  print("selected=selected");
               print(" value=account_change.php?langue=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["language"]."</option>");
               }
print("</select></td></form>");
//print("<td class=lista align=center>".USER_LASTACCESS.": ".date("d/m/Y H:i:s",$CURUSER["lastconnect"])."</td>\n");
?>
</tr>
</table>
<?php
}
else
    {
    if (!isset($user)) $user = '';
    ?>
    <form action="login.php" name="login" method="post">
    <table class="lista" border="0" width="100%" cellpadding="2" cellspacing="0">
    <tr>
    <td class="lista" align="left">
      <table border="0" cellpadding="2" cellspacing="0">
      <tr>
      <td align="right" class="lista"><?php echo USER_NAME?>:</td>
      <td class="lista"><input type="text" size="15" name="uid" value="<?php $user ?>" maxlength="40" style="font-size:10px" /></td>
      <td align="right" class="lista"><?php echo USER_PWD?>:</td>
      <td class="lista"><input type="password" size="15" name="pwd" maxlength="40" style="font-size:10px" /></td>
      <td class="lista" align="center"><input type="submit" value="<?php echo FRM_LOGIN?>" style="font-size:10px" /></td>
      </tr>
      </table>
    </td>
		<?php
		if ($PRIVATE_TRACKER)
		{
			print("<td class=\"lista\" align=\"center\"><a href=\"recover.php\">".RECOVER_PWD."</a></td>");
		}
		else
		{
			print("<td class=\"lista\" align=\"center\"><a href=\"account.php\">".ACCOUNT_CREATE."</a></td>");
			print("<td class=\"lista\" align=\"center\"><a href=\"recover.php\">".RECOVER_PWD."</a></td>");
		}
		?>
    </tr>
    </table>
    </form>
    <?php
}
?>
