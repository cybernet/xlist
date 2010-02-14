<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");


dbconn();


if (isset($_GET["info_hash"])) $hash = $_GET["info_hash"];
   else $hash = "";
if (isset ($_GET["action"]))
   $action = $_GET["action"];
else $action="";
$username = $CURUSER["username"];


if (($hash != "") && ($action == "add"))
   {
     standardheader('Recommended Torrents');
     block_begin("Recommended Torrents");
     $affected = mysql_query("SELECT * FROM recommended WHERE info_hash=\"$hash\"");
     if (mysql_num_rows(mysql_query("SELECT * FROM recommended")) > 9)
        {
          echo "<center><h1>Too many torrents added!<br />Remove some before add more!</h1></center>";
          print("<br /><center><a href=torrents.php>".BACK."</a></center><br />");
          block_end();
          stdfoot();
          exit();
        }
     elseif (mysql_num_rows($affected) == 0)
        {
          mysql_query("INSERT INTO recommended (info_hash, user_name) VALUES (\"$hash\", \"$username\")") or die("Error in MySQL");
          echo "<center><h1>Successfully added</h1></center>";
          print("<br /><center><a href=torrents.php>".BACK."</a></center><br />");
          block_end();
          stdfoot();
          exit();
        }
     else
       {
          echo "<center><h1>Already added</h1></center>";
          print("<br /><center><a href=torrents.php>".BACK."</a></center><br />");
          block_end();
          stdfoot();
          exit();
       }
   }


if (($hash != "") && ($action == "remove"))
   {
     standardheader('Recommended Torrents');
     block_begin("Recommended Torrents");
     mysql_query("DELETE FROM recommended WHERE info_hash=\"$hash\"");
     echo "<center><h1>Successfully removed</h1></center>";
     print("<br /><center><a href=torrents.php>".BACK."</a></center><br />");
     block_end();
     stdfoot();
     exit();
   }

  block_begin("Our Team Recommend");

  $query = "SELECT recommended.*, summary.seeds, summary.leechers, summary.info_hash as hash, namemap.free as free, namemap.filename, namemap.anonymous, namemap.requested, namemap.nuked, namemap.nuke_reason, UNIX_TIMESTAMP( namemap.data ) as added, categories.image, categories.name as cname, namemap.category as catid, namemap.size, namemap.external, namemap.uploader, users.username as uploader FROM recommended LEFT JOIN namemap ON recommended.info_hash = namemap.info_hash LEFT JOIN categories ON categories.id = namemap.category LEFT JOIN users ON users.id = namemap.uploader LEFT JOIN summary ON summary.info_hash=namemap.info_hash ORDER by 'recommended.id' DESC";
  $res = mysql_query($query) or die(CANT_DO_QUERY.mysql_error());

?>
<script type="text/javascript">
<!--
var newwindow;
function popdetails(url)
{
  newwindow=window.open(url,'popdetails','height=600,width=900,resizable=yes,scrollbars=yes,status=yes');
  if (window.focus) {newwindow.focus()}
}
function poppeer(url)
{
  newwindow=window.open(url,'poppeers','height=600,width=800,resizable=yes,scrollbars=yes');
  if (window.focus) {newwindow.focus()}
}
// -->
</script>

<table width=100%>
<TR>
<td align="center" class="header">Cat.</td>
<td align="center" class="header">Filename</td>
<!-- <td align="center" class="header">dl.</td> -->
<td align="center" class="header">Added</td>
<td align="center" class="header">Size</td>
<td align="center" class="header">Uploader</td>
<td align="center" class="header">S</td>
<td align="center" class="header">L</td>
<td align="center" class="header">Recommended by</td>
<?php
   if ($CURUSER["mod_access"] == "yes")
    {
      echo "<td align=\"center\" class=\"header\">Remove</td>";
    }
?>
</TR>
<?php
  while($results = mysql_fetch_array($res))
   {
//Begin
if(isset($_COOKIE['lastseen'])){
 $filetime =  date("YmdHis",$results["added"]);
if ($_COOKIE['lastseen'] <= $filetime) {
  $is_new = '<img alt="old" src="images/new.png" />';
}
else {   $is_new='';
}
}
  //Torrent Nuke/Req Hack Start - 22:53 07.08.2006
  if ($results["requested"] == "true") {
    $is_req = '<img title="This release was requested." src="images/req.gif" />';
  }
  else {   $is_req='';
  }

  if ($results["nuked"] == "true") {
    $is_nuke = '<img title="'.$results[nuke_reason].'" src="images/nuked.gif" />&nbsp;';
  }
  else {   $is_nuke='';
  }
  //Torrent Nuke/Req Hack Stop
  if($results['free']=="yes") {
		$golden = '<img alt="Golden Torrent" src="images/golden.gif" />';	 
	} else { $golden=""; }
//End
      echo "<TR>";
      echo "<td align=\"center\" class=\"lista\"><a href=torrents.php?category=$results[catid]>".image_or_link(($results["image"]==""?"":"images/categories/" . $results["image"]),"",$results["cname"])."</td>";
if ($GLOBALS["enable_cutname"]==true)
{
   global $CUTNAME;

   if ($GLOBALS["usepopup"])
         echo "<TD align=\"left\" class=\"lista\"><A HREF=\"javascript:popdetails('details.php?id=".$results["info_hash"]."');\" title=\"".VIEW_DETAILS.": ".$results["filename"]."\">".((strlen($results["filename"])>='$CUTNAME')? substr($results["filename"],0,$CUTNAME)."...":$results["filename"])."</A>".($results["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
   else
         echo "<TD align=\"left\" class=\"lista\"><A HREF=\"details.php?id=".$results["info_hash"]."\" title=\"".VIEW_DETAILS.": ".$results["filename"]."\">".((strlen($results["filename"])>='$CUTNAME')? substr($results["filename"],0,$CUTNAME)."...":$results["filename"])."</A>".($results["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
}
   elseif ($GLOBALS["usepopup"])
         echo "<TD align=\"left\" class=\"lista\"><A HREF=\"javascript:popdetails('details.php?id=".$results["info_hash"]."');\" title=\"".VIEW_DETAILS.": ".$results["filename"]."\">".$results["filename"]."</A>".($results["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
   else
         echo "<TD align=\"left\" class=\"lista\"><A HREF=\"details.php?id=".$results["info_hash"]."\" title=\"".VIEW_DETAILS.": ".$results["filename"]."\">".$results["filename"]."</A>".($results["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";

 //     echo "<TD align=\"center\" class=\"lista\"><A HREF=download.php?id=".$results["info_hash"]."&f=" . urlencode($results["filename"]) . ".torrent>".image_or_link("images/download.gif","","torrent")."</A></TD>";
      echo "<td align=\"center\" class=\"lista\">" . date("d/m/Y",$results["added"]) . "</td>"; // data
      echo "<td align=\"center\" class=\"lista\">" . makesize($results["size"]) . "</td>";
   if ($SHOW_UPLOADER && $results["anonymous"] == "true")
         echo "<td align=\"center\" class=\"lista\">" . ANONYMOUS . "</td>";
   elseif ($SHOW_UPLOADER && $results["anonymous"] == "false")
         echo "<td align=\"center\" class=\"lista\">" .$results["uploader"] . "</td>";
		 
   if ($results["external"]=="no")
      {
       if ($GLOBALS["usepopup"])
         {
         echo "\t<td align=\"center\" class=\"".linkcolor($results["seeds"])."\"><a href=\"javascript:poppeer('peers.php?id=".$results["hash"]."');\" title=\"".PEERS_DETAILS."\">" . $results["seeds"] . "</a></td>\n";
         echo "\t<td align=\"center\" class=\"".linkcolor($results["leechers"])."\"><a href=\"javascript:poppeer('peers.php?id=".$results["hash"]."');\" title=\"".PEERS_DETAILS."\">" .$results["leechers"] . "</a></td>\n";
         }
       else
         {
         echo "\t<td align=\"center\" class=\"".linkcolor($results["seeds"])."\"><a href=\"peers.php?id=".$results["hash"]."\" title=\"".PEERS_DETAILS."\">" . $results["seeds"] . "</a></td>\n";
         echo "\t<td align=\"center\" class=\"".linkcolor($results["leechers"])."\"><a href=\"peers.php?id=".$results["hash"]."\" title=\"".PEERS_DETAILS."\">" .$results["leechers"] . "</a></td>\n";
         }
      }
   else
       {
       // linkcolor
       echo "\t<td align=\"center\" class=\"".linkcolor($results["seeds"])."\">" . $results["seeds"] . "</td>";
       echo "\t<td align=\"center\" class=\"".linkcolor($results["leechers"])."\">" .$results["leechers"] . "</td>";
   }
 
/****		 
       if ($GLOBALS["usepopup"])
         {
           echo "\t<td align=\"center\" class=\"".linkcolor($results["seeds"])."\"><a href=\"javascript:poppeer('peers.php?id=".$results["hash"]."');\" title=\"".PEERS_DETAILS."\">" . $results["seeds"] . "</a></td>\n";
           echo "\t<td align=\"center\" class=\"".linkcolor($results["leechers"])."\"><a href=\"javascript:poppeer('peers.php?id=".$results["hash"]."');\" title=\"".PEERS_DETAILS."\">" .$results["leechers"] . "</a></td>\n";
         }
       else
         {
           echo "\t<td align=\"center\" class=\"".linkcolor($results["seeds"])."\"><a href=\"peers.php?id=".$results["hash"]."\" title=\"".PEERS_DETAILS."\">" . $results["seeds"] . "</a></td>\n";
           echo "\t<td align=\"center\" class=\"".linkcolor($results["leechers"])."\"><a href=\"peers.php?id=".$results["hash"]."\" title=\"".PEERS_DETAILS."\">" .$results["leechers"] . "</a></td>\n";
         }
****/
      echo "<td align=\"center\" class=\"lista\">" . $results["user_name"] . "</td>";

   if ($CURUSER["mod_access"] == "yes")
      echo "<td align=\"center\" class=\"lista\"><A HREF=recommended.php?action=remove&info_hash=".$results["info_hash"].">".image_or_link("images/remove.jpg","","remove")."</A></td>";
      echo "</TR>";
   }
   echo "</table>";
   block_end();
   print("<br />");
   print("<br />");
?>