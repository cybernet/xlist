<?php
/********
Copyright � 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright � 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader('Peer Details',($GLOBALS["usepopup"]?false:true));
?>
<script language=javascript>
function windowunder(link)
{
  window.opener.document.location=link;
  window.close();
}
</script>
<?php
$id = AddSlashes($_GET["id"]);
if (!isset($id) || !$id)
    die("Error ID");


$res = mysql_query("SELECT * FROM namemap WHERE info_hash='$id'") or die(mysql_error());
if ($res) {
   $row=mysql_fetch_array($res);
   if ($row) {
      $tsize=0+$row["size"];
      }
}
else
    die("Error ID");
$res = mysql_query("SELECT * FROM peers LEFT JOIN countries ON peers.dns=countries.domain WHERE infohash='$id' ORDER BY bytes ASC, status DESC") or die(mysql_error());

block_begin(PEER_LIST);

$spacer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print("<table width=100% class=\"lista\" border=\"0\">\n");
print("<tr><td align=center class=\"header\" colspan=2>".USER_NAME."</td>");
print("<td align=center class=\"header\">".PEER_COUNTRY."</td>");
print("<td align=center class=\"header\">".PEER_PORT."</td>");
print("<td align=center class=\"header\">".PEER_PROGRESS."</td>");
print("<td align=center class=\"header\">".PEER_STATUS."</td>");
print("<td align=center class=\"header\">".PEER_CLIENT."</td>\n");
print("<td align=center class=\"header\">".DOWNLOADED."</td>\n");
print("<td align=center class=\"header\">".UPLOADED."</td>\n");
print("<td align=center class=\"header\">".RATIO."</td>\n");
print("<td align=center class=\"header\">".SEEN."</td></tr>\n");

// Ban clients Start
$clientarr=array();

while ($row = mysql_fetch_array($res))
{
    // Ban clients by Petr1fied
    if($CURUSER["admin_access"]=="yes")
    {
        $gotclient=htmlspecialchars(getagent(unesc($row["client"]), unesc($row["peer_id"])));
        if(!array_key_exists($gotclient,$clientarr))
        {
            $clientarr[$gotclient]["user_agent"]=((substr($row["client"], 0, 7)=="Azureus") ? substr($row["client"], 0,  (((stripos($row["client"], ";")==true) ? stripos($row["client"], ";") : strlen($row["client"])))) : $row["client"]);
            $clientarr[$gotclient]["peer_id"]=substr($row["peer_id"], 0, 16);
            $clientarr[$gotclient]["peer_id_ascii"]=hex2bin(substr($row["peer_id"], 0, 16));
            $clientarr[$gotclient]["times_seen"]=1;
        }
        else
            $clientarr[$gotclient]["times_seen"]=$clientarr[$gotclient]["times_seen"]+1;
    }
 
  // for user name instead of peer
// Ban clients Ends
//Old Code
/*****
while ($row = mysql_fetch_array($res))
{
  // for user name instead of peer
*****/
 if ($PRIVATE_ANNOUNCE)
    $resu=mysql_query("SELECT users.username,users.id,countries.flagpic,countries.name FROM users LEFT JOIN countries ON countries.id=users.flag WHERE users.pid='".$row["pid"]."'");
 else
    $resu=mysql_query("SELECT users.username,users.id,countries.flagpic,countries.name FROM users LEFT JOIN countries ON countries.id=users.flag WHERE users.cip='".$row["ip"]."'");
 if ($resu)
    {
    $rowuser=mysql_fetch_row($resu);
    if ($rowuser && $rowuser[1]>1)
      {
      if ($GLOBALS["usepopup"])
        print("<tr><td align=center class=\"lista\">".
           "<a href=\"javascript: windowunder('userdetails.php?id=$rowuser[1]')\">".unesc($rowuser[0])."</a></td>".
           "<td align=center class=\"lista\"><a href=\"javascript: windowunder('usercp.php?do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($rowuser[0]))."')\">".image_or_link("$STYLEPATH/pm.png","","PM")."</a></td>");
      else
        print("<tr><td align=center class=\"lista\">".
           "<a href=\"userdetails.php?id=$rowuser[1]\">".unesc($rowuser[0])."</a></td>".
           "<td align=center class=\"lista\"><a href=\"usercp.php?do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($rowuser[0]))."\">".image_or_link("$STYLEPATH/pm.png","","PM")."</a></td>");
      }
    else
        print("<tr><td align=left class=\"lista\" colspan=2>".GUEST."</td>");
    }
  if ($row["flagpic"]!="" && $row["flagpic"]!="unknown.gif")
    print("<td align=center class=\"lista\"><img src=\"images/flag/".$row["flagpic"]."\" alt=\"".unesc($row["name"])."\" /></td>");
  elseif ($rowuser[2]!="" && !empty($rowuser[2]))
    print("<td align=center class=\"lista\"><img src=\"images/flag/".$rowuser[2]."\" alt=\"".unesc($rowuser[3])."\" /></td>");
  else
    print("<td align=center class=\"lista\"><img src=\"images/flag/unknown.gif\" alt=\"".UNKNOWN."\" /></td>");

  print("<td align=center class=\"lista\">".$row["port"]."</td>");
  $stat=floor((($tsize - $row["bytes"]) / $tsize) *100);
  $progress="<table width=100 cellspacing=0 cellpadding=0><tr><td class=\"progress\" align=left>";
  $progress.="<img height=10 height=10 width=".number_format($stat,0)." src=\"$STYLEPATH/progress.jpg\"></td></tr></table>";
  print("<td valign=top align=center class=\"lista\">".$stat."%<br />" . $progress . "</td>\n");
  print("<td align=center class=\"lista\">".$row["status"]."</td>");
  print("<td align=center class=\"lista\">".htmlspecialchars(getagent(unesc($row["client"]),unesc($row["peer_id"])))."</td>");
  $dled=makesize($row["downloaded"]);
  $upld=makesize($row["uploaded"]);
  print("<td align=center class=\"lista\">".$dled."</td>");
  print("<td align=center class=\"lista\">".$upld."</td>");
//Peer Ratio
  if (intval($row["downloaded"])>0) {
     $ratio=number_format($row["uploaded"]/$row["downloaded"],2);}
  else {$ratio="oo";}
  print("<td align=center class=\"lista\">".$ratio."</td>");
//End Peer Ratio

  print("<td align=center class=\"lista\">".get_elapsed_time($row["lastupdate"])." ago</td></tr>");

}

// Ban Clients Start

if (mysql_num_rows($res)==0)
  print("<tr><td align=center colspan=11 class=\"lista\">".NO_PEERS."</td></tr>");

print("</table>");

// Ban Clients by Petr1fied
if($CURUSER["admin_access"]=="yes")
{
    block_begin("Ban Clients");
    print("<br /><table align='center'><tr>");
    print("<td class='header' align='center'>Client</td>");
    print("<td class='header' align='center'>User Agent</td>");
    print("<td class='header' align='center'>peer_id</td>");
    print("<td class='header' align='center'>peer_id ascii</td>");
    print("<td class='header' align='center'>Times seen</td>");
    print("<td class='header' align='center'>Ban Client</td></tr>");

    foreach($clientarr as $n => $v)
    {
        print("<tr><td class='lista' align='center'>$n</td>");
        print("<td class='lista' align='center'>".$v["user_agent"]."</td>");
        print("<td class='lista' align='center'>".$v["peer_id"]."</td>");
        print("<td class='lista' align='center'>".$v["peer_id_ascii"]."</td>");
        print("<td class='lista' align='center'>".$v["times_seen"]."</td>");
        print("<td class='lista' align='center'><a title='Ban $n' href='ban_client.php?agent=".urlencode($v["user_agent"])."&peer_id=".urlencode($v["peer_id"])."&returnto=".urlencode("peers.php?id=".$id)."'><img src='images/smilies/thumbsdown.gif' border='0' alt='Ban $n'></a></td></tr>");
    }
    print("<tr><td class='block' colspan='6'>&nbsp;</td></tr>");
    print("</table><br />");
    block_end();
   
    $sqlquery ="SELECT * ";
    $sqlquery.="FROM bannedclient ";
    $sqlquery.="ORDER BY client_name ASC";

    $res=mysql_query($sqlquery);

    if(mysql_num_rows($res)>0)
    {
        block_begin("Remove Banned Clients");
        ?>
        <br /><table align='center'>
          <tr>
            <td class='header'>Client</td>
            <td class='header'>User Agent</td>
            <td class='header'>peer_id</td>
            <td class='header'>peer_id ascii</td>
            <td class='header'>Ban Reason</td>
            <td class='header'>Remove Ban</td>
          </tr>
          <?php
        while($row=mysql_fetch_assoc($res))
        {
            print("<tr><td class='lista' align='left'>".$row["client_name"]."</td>");
            print("<td class='lista' align='left'>".$row["user_agent"]."</td>");
            print("<td class='lista' align='left'>".$row["peer_id"]."</td>");
            print("<td class='lista' align='left'>".$row["peer_id_ascii"]."</td>");
            print("<td class='lista' align='left'>".stripslashes($row["reason"])."</td>");
            print("<td class='lista' align='center'><a href='client_clearban.php?id=".$row["id"]."&returnto=".urlencode("peers.php?id=".$id)."'><img border='0' src='images/smilies/thumbsup.gif'></a></td></tr>");
        }
        print("<tr><td class='block' colspan='6'>&nbsp;</td></tr>");
        print("</table><br />");
        block_end();   
    }
}

if ($GLOBALS["usepopup"])

// Ban Clients Ends

//Old Code
/*****
if (mysql_num_rows($res)==0)
  print("<tr><td align=center colspan=11 class=\"lista\">".NO_PEERS."</td></tr>");

print("</table>");

if ($GLOBALS["usepopup"])
*****/

    print("<br /><br /><center><a href=\"javascript:window.close()\">".CLOSE."</a></center>");
else
    print("</div><br /><br /><center><a href=\"javascript: history.go(-1);\">".BACK."</a>");

block_end();

stdfoot(($GLOBALS["usepopup"]?false:true),false);
?>