<?
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");
?>
<div>
<table width="87%" height="100%" border="0" bgcolor="#083B6B" align="center" cellpadding="0" cellspacing="0">
<tr><td height="100%">
<table border="0" cellpadding="0" width="100%" height="100%">
<tr width="100%">
<td width="13" bgcolor="#083B6B" background="<? echo $STYLEPATH ?>/l_mid.gif" rowspan="2"><img border="0" src="<? echo $STYLEPATH ?>/l_mid.gif"  /></td>
<td width="Width" valign="top">

<div id="maintable">


<div id="header">

<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr>
<td class="banner"><img border="0" align="left" src="<? echo $STYLEPATH ?>/Reloaded_Logo.gif" valign="top"></td></tr>
<tr><td class="menu" style="text-align:center;">
<div class="chromestyle"><a href="index.php">Home</a><a href="torrents.php">Torrents</a><a href="users.php">Members</a><a href="forum.php">Forum</a><a href="dox.php">Dox</a><a href="rules.php">Rules</a><a href="sbmini.php">Shoutbox</a><a href="links.php">Links</a><a href="extra-stats.php">Top 10</a><a href="faq.php">F.A.Q.</a><a href="upload.php">Upload</a><a href="viewnews.php">News</a><a href="staff.php">Staff</a></div>
</td>
</tr></table>

<ul>
<?

print("<table width=100% border=0 cellspacing=0 cellpadding=2><tr>\n");
//print("<hr>\n");
global $CURUSER;
if ($CURUSER["uid"]==1)
       // anonymous=guest 
    {
print("<td class=nav align=center>".Welcome." " . $CURUSER["username"] ." <a href=login.php>".Login."</a></td>\n");
    }
else

{

print("<td class=nav align=center>".$CURUSER['username']." ( <a href=logout.php>".Logout."</a> )  </td>\n");
{

$style=style_list();
$langue=language_list();

$resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);

$rowuser=mysql_fetch_array($resuser);
//print("<td align=center>".Rank.": ".$CURUSER["level"]."</td>\n");
print("<td class=hdr_green align=center>&nbsp;&#8593&nbsp;".makesize($rowuser['uploaded']));
print("</td>\n<td class=hdr_red align=center>&nbsp;&#8595&nbsp;".makesize($rowuser['downloaded']));
print("</td>\n<td class=hdr_yellow align=center>&nbsp;SR&nbsp;(".($rowuser['downloaded']>0?number_format($rowuser['uploaded']/$rowuser['downloaded'],2):"---").")</td>\n");
//print("<hr>\n");
if ($CURUSER["admin_access"]=="yes")
   print("<td class=nav align=center> <a href=admincp.php>".MNU_ADMINCP."</a></td>\n");

print("<td class=nav align=center> <a href=admincp.php><a href=usercp.php?uid=".$CURUSER["uid"].">".USER_CP."</a></td>\n");

$resmail=mysql_query("SELECT COUNT(*) FROM messages WHERE readed='no' AND receiver=$CURUSER[uid]");
if ($resmail && mysql_num_rows($resmail)>0)
   {
    $mail=mysql_fetch_row($resmail);
    if ($mail[0]>0)
       print("<td class=nav align=center> | <a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a> <img src=\"./images/mail.gif\"><b>$mail[0]</b> | </td>\n");
    else
        print("<td class=nav align=center> <a href=admincp.php><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a><a href=admincp.php></td\n");
   }
else
    print("<td class=nav align=center> <a href=admincp.php><a href=usercp.php?uid=".$CURUSER["uid"]."&do=pm&action=list>".MAILBOX."</a><a href=admincp.php></td>\n");

print("<td><form name=jump1><select valign=top name=style size=1 onChange=location=document.jump1.style.options[document.jump1.style.selectedIndex].value style=font-size:10px>");
foreach($style as $a)
               {
               print("<option ");
               if ($a["id"]==$CURUSER["style"])
                  print("selected=selected");
               print(" value=account_change.php?style=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["style"]."</option>");
               }
print("</select>\n<select valign=top name=language size=1 onChange=location=document.jump1.langue.options[document.jump1.langue.selectedIndex].value style=font-size:10px>");
foreach($langue as $a)
               {
               print("<option ");
               if ($a["id"]==$CURUSER["language"])
                  print("selected=selected");
               print(" value=account_change.php?langue=".$a["id"]."&returnto=".urlencode($_SERVER['REQUEST_URI']).">".$a["language"]."</option>");
               }
print("</select></form></td></tr>\n");
}
}


    {
  $res=mysql_query("select count(*) as tot FROM namemap");
   if ($res)
      {
      $row=mysql_fetch_array($res);
      $torrents=$row["tot"];
      }
   else
       $torrents=0;

   $res=mysql_query("select count(*) as tot FROM users where id>1");
   if ($res)
      {
      $row=mysql_fetch_array($res);
      $users=$row["tot"];
      }
   else
       $users=0;

   $res=mysql_query("select sum(seeds) as seeds, sum(leechers) as leechs FROM summary");

   if ($res)
      {
      $row=mysql_fetch_array($res);
      $seeds=0+$row["seeds"];
      $leechers=0+$row["leechs"];
      }
   else {
      $seeds=0;
      $leechers=0;
      }

      if ($leechers>0)
         $percent=number_format(($seeds/$leechers)*100,0);
      else
          $percent=number_format($seeds*100,0);

   $peers=$seeds+$leechers;


   $res=mysql_query("select sum(downloaded) as dled, sum(uploaded) as upld FROM users");
   $row=mysql_fetch_array($res);
   $dled=0+$row["dled"];
   $upld=0+$row["upld"];
   $traffic=makesize($dled+$upld);

?>

<table cellpadding="2" cellspacing="0" width="100%">
<tr>
<?
//print("<td align=center>".USER_LASTACCESS.": ".date("d/m/Y H:i:s",$CURUSER["lastconnect"])."</td>\n");
?>
<td><? echo MEMBERS; ?>:</td><td><? echo $users; ?></td>
<td><? echo TORRENTS; ?>:</td><td><? echo $torrents; ?></td>
<td><? echo SEEDERS; ?>:</td><td><? echo $seeds; ?></td>
<td><? echo LEECHERS; ?>:</td><td><? echo $leechers; ?></td>
<td><? echo PEERS; ?>:</td><td><? echo $peers; ?></td>
<td><? echo SEEDERS."/".LEECHERS; ?>:</td><td><? echo $percent."%"; ?></td>
<td><? echo TRAFFIC; ?>:</td><td><? echo $traffic; ?></td>
</tr></table>

<?
print("<hr>\n");
print("<table width=\"100%\" cellspacing=\"0\" cellpading=\"0\"><tr><td class=nav align=center>\n");
     $a = @mysql_fetch_assoc(@mysql_query("SELECT id,username FROM users WHERE
     id_level<>1 AND id_level<>2 ORDER BY id DESC LIMIT 1"));
     if($a){
      if ($CURUSER["view_users"]=="yes")
      $latestuser = "<a href=userdetails.php?id=" . $a["id"] . ">" . $a["username"] . "</a>";
     else
     $latestuser = $a['username'];
     echo " <div align=center>Our Latest Member&nbsp;&nbsp;<b>$latestuser</b></div>\n";
     }
		 print("</td></tr></table>\n");
} // end if user can view
?>
</ul>
</div>
<div id="adds-box">Put your adds in here!</div>
<!-- Use the <div> below as an example. 
<div id="adds-box"><a href="http://leader.linkexchange.com/-1/X1748505/clickto_X1740332" target="_top"><img alt="Click here!" src="<? echo $STYLEPATH ?>/banner468x60.gif" border="0" height="60" width="468"></div>-->
<table width="100%" height="100%" border="0">
<tr>
<td width="Width" valign=top>

