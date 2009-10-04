<?php
if (!defined("IN_BTIT"))
      die("non direct access!");


$i=0;
$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]."?page=peers&amp;id=$_GET[id]");
$addparam = "";
$id = AddSlashes($_GET["id"]);
if (!isset($id) || !$id)
    die("Error ID");

/*
$res = do_sqlquery("SELECT size FROM {$TABLE_PREFIX}files WHERE info_hash='$id'") or die(mysql_error());
*/


    ################################################################################################
    # Speed stats in peers with filename

$res = do_sqlquery("SELECT filename, size FROM {$TABLE_PREFIX}files WHERE info_hash='$id'") or die(mysql_error());

    # End       
    ################################################################################################
if ($res) {
   $row=mysql_fetch_array($res);
   if ($row) {
      $tsize=0+$row["size"];


    ################################################################################################
    # Speed stats in peers with filename
       
      $peers["filename"] = $row["filename"];
      $peers["size"] = makesize($row["size"]);      
        
    # End       
    ################################################################################################
    

	
      }
}
else
    die("Error ID");

if ($XBTT_USE)
   $res = mysql_query("SELECT x.uid,x.completed, x.downloaded, x.uploaded, x.left as bytes, IF(x.left=0,'seeder','leecher') as status, x.mtime as lastupdate, u.username, u.flag, c.flagpic, c.name FROM xbt_files_users x LEFT JOIN xbt_files ON x.fid=xbt_files.fid LEFT JOIN {$TABLE_PREFIX}files f ON f.bin_hash=xbt_files.info_hash LEFT JOIN {$TABLE_PREFIX}users u ON u.id=x.uid LEFT JOIN {$TABLE_PREFIX}countries c ON u.flag=c.id WHERE f.info_hash='$id' AND active=1 ORDER BY status DESC, lastupdate DESC") or die(mysql_error());
else
    $res = do_sqlquery("SELECT * FROM {$TABLE_PREFIX}peers p LEFT JOIN {$TABLE_PREFIX}countries c ON p.dns=c.domain WHERE infohash='$id' ORDER BY bytes ASC, status DESC") or die(mysql_error());

require(load_language("lang_peers.php"));

$peerstpl=new bTemplate();
$peerstpl->set("language",$language);
$peerstpl->set("peers_script","index.php");

while ($row = mysql_fetch_array($res))
{
  // for user name instead of peer
 if ($XBTT_USE)
    $resu=do_sqlquery("SELECT u.username,u.id,c.flagpic,c.name FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag WHERE u.id='".$row["uid"]."'");
 elseif ($PRIVATE_ANNOUNCE)
    $resu=do_sqlquery("SELECT u.username,u.id,c.flagpic,c.name FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag WHERE u.pid='".$row["pid"]."'");
 else
    $resu=do_sqlquery("SELECT u.username,u.id,c.flagpic,c.name FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}countries c ON c.id=u.flag WHERE u.cip='".$row["ip"]."'");

 if ($resu)
    {
    $rowuser=mysql_fetch_row($resu);
    if ($rowuser && $rowuser[1]>1)
      {
      if ($GLOBALS["usepopup"]){
       $peers[$i]["USERNAME"]="<a href=\"javascript: windowunder('index.php?page=userdetails&amp;id=$rowuser[1]')\">".unesc($rowuser[0])."</a>";
       $peers[$i]["PM"]="<a href=\"javascript: windowunder('index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=$CURUSER[uid]&amp;what=new&amp;to=".urlencode(unesc($rowuser[0]))."')\">".image_or_link("$STYLEPATH/images/pm.png","","PM")."</a>";
  }    else {
        $peers[$i]["USERNAME"]="<a href=\"index.php?page=userdetails&amp;id=$rowuser[1]\">".unesc($rowuser[0])."</a>";
        $peers[$i]["PM"]="<a href=\"index.php?page=usercp&amp;do=pm&amp;action=edit&amp;uid=$CURUSER[uid]&amp;what=new&amp;to=".urlencode(unesc($rowuser[0]))."\">".image_or_link("$STYLEPATH/images/pm.png","","PM")."</a>";
       }
      }
    else
      {
       $peers[$i]["USERNAME"]=$language["GUEST"];
       $peers[$i]["PM"]="";
    }
  }
  if ($row["flagpic"]!="" && $row["flagpic"]!="unknown.gif")
    $peers[$i]["FLAG"]="<img src=\"images/flag/".$row["flagpic"]."\" alt=\"".unesc($row["name"])."\" />";
  elseif ($rowuser[2]!="" && !empty($rowuser[2]))
    $peers[$i]["FLAG"]="<img src=\"images/flag/".$rowuser[2]."\" alt=\"".unesc($rowuser[3])."\" />";
  else
    $peers[$i]["FLAG"]="<img src=\"images/flag/unknown.gif\" alt=\"".UNKNOWN."\" />";

if (!$XBTT_USE)
  $peers[$i]["PORT"]=$row["port"];
  $stat=floor((($tsize - $row["bytes"]) / $tsize) *100);
  $progress="<table width=\"100\" cellspacing=\"0\" cellpadding=\"0\"><tr><td class=\"progress\" align=\"left\">";
  $progress.="<img height=\"10\" width=\"".number_format($stat,0)."\" src=\"$STYLEURL/images/progress.jpg\" alt=\"\" /></td></tr></table>";
$peers[$i]["PROGRESS"]=$stat."%<br />" . $progress;

$peers[$i]["STATUS"]=$row["status"];
$peers[$i]["CLIENT"]=htmlspecialchars(getagent(unesc($row["client"]),unesc($row["peer_id"])));
  $dled=makesize($row["downloaded"]);
  $upld=makesize($row["uploaded"]);
$peers[$i]["DOWNLOADED"]=$dled;


    ################################################################################################
    # Speed stats in peers with filename

            if ($row['status']=='seeder') $transferrateDL="<i>seeder</i>";             
              else if ($row['download_difference'] > '0' && $row['announce_interval'] > '0')
                $transferrateDL=round(round($row['download_difference']/$row['announce_interval'])/1000, 2)." KB/sec";
                else $transferrateDL="0 KB/sec";
              
if ($transferrateDL >= 6.50) $color="green";
else if ($transferrateDL >= 3.00) $color="orange";
else if ($transferrateDL >= 0.01) $color="red";
else if($row['status']=='seeder') $color="#00D900";
else $color="";
              $peers[$i]["DLSPEED"]="<font color=$color>$transferrateDL</font>";


$peers[$i]["UPLOADED"]=$upld;


            if ($row['upload_difference'] > '0' && $row['announce_interval'] > '0')
              $transferrateUP=round(round($row['upload_difference']/$row['announce_interval'])/1000, 2)." KB/sec";
              else $transferrateUP="0 KB/sec";
              
if ($transferrateUP >= 6.50) $color="green";
else if ($transferrateUP >= 3.00) $color="orange";
else if ($transferrateUP >= 0.01) $color="red";
else $color="";
              $peers[$i]["UPSPEED"]="<font color=$color>$transferrateUP</font>";

    # End       
    ################################################################################################


	

//Peer Ratio
  if (intval($row["downloaded"])>0) {
     $ratio=number_format($row["uploaded"]/$row["downloaded"],2);}
  else {$ratio='&#8734;';}
  $peers[$i]["RATIO"]=$ratio;
//End Peer Ratio

  $peers[$i]["SEEN"]=get_elapsed_time($row["lastupdate"])." ago";
$i++;
}

if (mysql_num_rows($res)==0)
  $peerstpl->set("NOPEERS",TRUE,TRUE);
else
    $peerstpl->set("NOPEERS",FALSE,TRUE);


if ($GLOBALS["usepopup"])
    $peerstpl->set("BACK2","<br /><br /><center><a href=\"javascript:window.close()\"><tag:language.CLOSE /></a></center>");
else
   $peerstpl->set("BACK2", "<br /><br /><center><a href=\"javascript: history.go(-1);\"><tag:language.BACK /></a></center>");
$peerstpl->set("XBTT",$XBTT_USE,TRUE);
$peerstpl->set("XBTT2",$XBTT_USE,TRUE);
$peerstpl->set("peers",$peers);

?>
