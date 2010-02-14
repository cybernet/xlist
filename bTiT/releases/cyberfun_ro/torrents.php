<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]);
$addparam = "";
if(!isset($_COOKIE['lastseen'])){
 $time =  date("YmdHis");
 setcookie('lastseen', $time, time()+60*60*24*30, '/', false, 0);
}

if (isset($_GET["mark"])) $mark=$_GET["mark"];
 else $mark="";
if($mark ==old){
 $time =  date("YmdHis");
 setcookie('lastseen', $time, time()+60*60*24*30, '/', false, 0);
 header ("Location: /torrents.php");
}

dbconn();

standardheader('Torrents');

//JavaScript Torrents Browse Hack Start - 11:02 AM 3/18/2007
function print_hr($width, $image1, $image2, $image3)
{
$hr = "<tr><td class=lista align=left width=100%><table border=0 cellspacing=0 cellpadding=0 align=left width=$width><tr><td width=60 style=\"background-image: url($image1); background-repeat: no-repeat; background-position:top right; width=60px; height:4px;\"></td><td width=75% style=\"background-image:url($image2); background-repeat: repeat-x; height:4px;\"></td><td width=60 style=\"background-image: url($image3); background-repeat: no-repeat; height:4px;\"></td></tr></table></td></tr>\n";
print($hr);
}
//JavaScript Torrents Browse Hack Stop

if(!$CURUSER || $CURUSER["view_torrents"]!="yes")
{
    err_msg(ERROR.NOT_AUTHORIZED." ".MNU_TORRENT."!",SORRY."...");
    stdfoot();
    exit();
}

block_begin(MNU_TORRENT);

//Recommend Start
if ($GLOBALS["show_recommended"] == "true")
{
  echo "<table width=100%><br /><br />";
  echo "<TR><TD COLSPAN=2 align=\"center\">";
  require_once("recommended.php");
  echo "</TD></TR></table>";
}
//Recommend Ends

if(isset($_GET["search"]))
{
    $trova = htmlspecialchars(str_replace ("+"," ",$_GET["search"]));
} else {
    $trova = "";
}
?>
<script type="text/javascript">
<!--
var newwindow;
function popdetails(url)
{
  newwindow=window.open(url,'popdetails','height=500,width=500,resizable=yes,scrollbars=yes,status=yes');
  if (window.focus) {newwindow.focus()}
}
function poppeer(url)
{
  newwindow=window.open(url,'poppeers','height=400,width=700,resizable=yes,scrollbars=yes');
  if (window.focus) {newwindow.focus()}
}
// -->
</script>
<p align="center">
<form action="<?php $scriptname;?>" method="get">
  <table border="0" class="lista" align="center">
  <tr>
  <td class="block"><?php echo TORRENT_SEARCH;?></td>
  <td class="block"><?php echo CATEGORY_FULL;?></td>
  <td class="block"><?php echo TORRENT_STATUS;?></td>
  <td class="block">&nbsp;</td>
  </tr>
  <tr>
  <td align=center style="width: 340px;"><input type="text" name="search" id="searchinput" ondblclick="suggest(event.keyCode, this.value, 'torrent');" onkeyup="suggest(event.keyCode, this.value, 'torrent');" onkeypress="return noenter(event.keyCode);" autocomplete="off" style="width: 320px;" maxlength="60" value="<?php $trova;?>" />
    <div id="suggcontainer" style="display: none; padding-left:0px;" align="left">
	<div id="suggestions" style="cursor: default; position: absolute; background-color: #E0ECF7; border: 1px solid #7f9db9; border-top: 0px;"></div>
    </div>
  </td>
  <td><?php
    $category = (!isset($_GET["category"])?0:explode(";",$_GET["category"]));
    // sanitize categories id
    if (is_array($category))
        $category = array_map("intval",$category);
    else
        $category = 0;

    categories( $category[0] );

    if(isset($_GET["active"]))
    {
        $active=intval($_GET["active"]);
    } else {
        $active=1;
    }
    // all
    if($active==0)
    {
        $where = " WHERE 1=1";
        $addparam.="active=0";
    } // active only
    elseif($active==1){
        $where = " WHERE leechers+seeds > 0";
        $addparam.="active=1";
    } // dead only
    elseif($active==2){
        $where = " WHERE leechers+seeds = 0";
        $addparam.="active=2";
	} // Free Torrent added 03-08-07 by fatepower
    elseif($active==3){
        $where = " WHERE free = 1";
        $addparam.="active=3";
    }
     // No EXT
	elseif($active==4){
		$where = " WHERE external = 'no'";
		$addparam.="active=4";
	}
     // EXT
	elseif($active==5){
		$where = " WHERE external = 'yes'";
		$addparam.="active=5";
	}
  ?>
  </td>
  <td>
  <select name="active" size="1">
  <option value="0"<?php if ($active==0) echo " selected=selected " ?>><?php echo ALL; ?></option>
  <option value="1"<?php if ($active==1) echo " selected=selected " ?>><?php echo ACTIVE_ONLY; ?></option>
  <option value="2"<?php if ($active==2) echo " selected=selected " ?>><?php echo DEAD_ONLY; ?></option>
  <option value="3"<?php if ($active==3) echo " selected=selected " ?>><?php echo FREE; ?></option>
  <option value="4"<?php if ($active==4) echo " selected=selected " ?>>No External only</option>
  <option value="5"<?php if ($active==5) echo " selected=selected " ?>>External only</option>
  </select>
  </td>
  <td><input type="submit" value="<?php echo SEARCH; ?>"></td>
  </tr>
  </table>
</form>
</p>
<TABLE width="100%" >
<TR>
<?php

/* Rewrite, part 1: encode "WHERE" statement only. */

// echo "Totale torrents trovati: $count";
// selezione categoria
if ($category[0]>0) {
   $where .= " AND category IN (".implode(",",$category).")"; // . $_GET["category"];
   $addparam.="&amp;category=".implode(";",$category); // . $_GET["category"];
}
global $pagertop, $pagerbottom, $query_select;
// Search
if (isset($_GET["search"])) {
   $testocercato = trim($_GET["search"]);
   $testocercato = explode(" ",$testocercato);
   if ($_GET["search"]!="")
      $search = "search=" . implode("+",$testocercato);
    for ($k=0; $k < count($testocercato); $k++) {
        $query_select .= " namemap.filename LIKE '%" . mysql_escape_string($testocercato[$k]) . "%'";
        if ($k<count($testocercato)-1)
           $query_select .= " AND ";
    }
    $where .= " AND " . $query_select;
}

 if($CURUSER['showporn']=='no'){
$where .= " AND category != 13 ";
}

// FINE RICERCA

// conteggio dei torrents...

$res = mysql_query("SELECT COUNT(*) FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash $where")
        or die(mysql_error());

$row = mysql_fetch_row($res);
$count = $row[0];
if (!isset($search)) $search = "";

if ($count) {
   if ($addparam != "") {
      if ($search != "")
         $addparam .= "&amp;" . $search . "&amp;";
      //else
          //$addparam .= "&";
   }
   else {
      if ($search != "")
         $addparam .=  $search . "&amp;";
      else
          $addparam .= ""; //$scriptname . "?";
      }

    $torrentperpage=intval($CURUSER["torrentsperpage"]);
    if ($torrentperpage==0)
        $torrentperpage=($ntorrents==0?15:$ntorrents);

    // getting order
    if (isset($_GET["order"]))
         $order=htmlspecialchars(mysql_escape_string($_GET["order"]));
    else
        $order="data";

    if (isset($_GET["by"]))
        $by=htmlspecialchars(mysql_escape_string($_GET["by"]));
    else
        $by="DESC";
$stickyorder="namemap.sticky ASC, ";

    list($pagertop, $pagerbottom, $limit) = pager($torrentperpage, $count,  $scriptname."?" . $addparam.(strlen($addparam)>0?"&amp;":"")."order=$order&amp;by=$by&amp;");

// Do the query with the uploader nickname
if ($SHOW_UPLOADER)
    $query = "SELECT namemap.free as free, summary.info_hash as hash, summary.seeds, summary.leechers, summary.finished as finished, summary.dlbytes as dwned, namemap.filename, namemap.url, namemap.info, namemap.anonymous, summary.speed, namemap.comment, namemap.requested, namemap.nuked, namemap.nuke_reason, namemap.sticky, namemap.nfo, UNIX_TIMESTAMP( namemap.data ) as added, categories.image, categories.name as cname, namemap.category as catid, namemap.size, namemap.external, namemap.uploader as upname, users.username as uploader, prefixcolor, suffixcolor FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash LEFT JOIN categories ON categories.id = namemap.category LEFT JOIN users ON users.id = namemap.uploader LEFT JOIN users_level ON users.id_level=users_level.id $where ORDER BY $stickyorder $order $by $limit";

// Do the query without the uploader nickname
else
    $query = "SELECT namemap.free as free, summary.info_hash as hash, summary.seeds, summary.leechers, summary.finished as finished, summary.dlbytes as dwned, namemap.filename, namemap.url, namemap.info, summary.speed, namemap.comment, namemap.requested, namemap.nuked, namemap.nuke_reason, namemap.sticky, namemap.nfo, UNIX_TIMESTAMP( namemap.data ) as added, categories.image, categories.name as cname, namemap.category as catid, namemap.size, namemap.external, namemap.uploader FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash LEFT JOIN categories ON categories.id = namemap.category $where ORDER BY $stickyorder $order $by $limit";
// End the queries
   $results = mysql_query($query) or err_msg(ERROR,CANT_DO_QUERY.mysql_error()."<br>".$query);
}

$i = 0;

if ($by=="ASC")
    $mark="&nbsp;&#8593";
else
    $mark="&nbsp;&#8595";

?>
</TR>
<TR>
<TD colspan="2" align="center"> <?php echo $pagertop ?></td>
</tr>

<?php
if(isset($_COOKIE['lastseen'])){
	echo "<tr><td align=\"center\"><form method=\"get\" action=\"$scriptname\"><input type=hidden name=update value=true><input type=hidden name=mark value=\"old\"><input type=submit value=\"Mark all new as read\"/></form></td></tr>";
} ?>

<TR>
<TABLE width="100%" class="lista">
<!-- Column Headers  -->
<TR>
<?php
?>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=cname&amp;by=".($order=="cname" && $by=="ASC"?"DESC":"ASC")."\">".CATEGORY."</a>".($order=="cname"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=filename&amp;by=".($order=="filename" && $by=="ASC"?"DESC":"ASC")."\">".FILE."</a>".($order=="filename"?$mark:""); ?></TD>
<!-- <TD align="center" class="header"><?php echo COMMENT; ?></TD> -->
<TD align="center" class="header"><?php echo RATING; ?></TD>
<?php
if (intval($CURUSER["WT"])>0)
    print("<TD align=\"center\" class=\"header\">".WT."</TD>");
?>
<!-- <TD align="center" class="header"><?php echo DOWN; ?></TD> -->
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=data&amp;by=".($order=="data" && $by=="ASC"?"DESC":"ASC")."\">".ADDED."</a>".($order=="data"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=size&amp;by=".($order=="size" && $by=="DESC"?"ASC":"DESC")."\">".SIZE."</a>".($order=="size"?$mark:""); ?></TD>
<?php
if ($SHOW_UPLOADER)
    print ("<TD align=\"center\" class=\"header\">".UPLOADER."</TD>");
?>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=seeds&amp;by=".($order=="seeds" && $by=="DESC"?"ASC":"DESC")."\">".SHORT_S."</a>".($order=="seeds"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=leechers&amp;by=".($order=="leechers" && $by=="DESC"?"ASC":"DESC")."\">".SHORT_L."</a>".($order=="leechers"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=finished&amp;by=".($order=="finished" && $by=="ASC"?"DESC":"ASC")."\">".SHORT_C."</a>".($order=="finished"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=dwned&amp;by=".($order=="dwned" && $by=="ASC"?"DESC":"ASC")."\">".DOWNLOADED."</a>".($order=="dwned"?$mark:""); ?></TD>
<TD align="center" class="header"><?php echo "<a href=\"$scriptname?$addparam".(strlen($addparam)>0?"&amp;":"")."order=speed&amp;by=".($order=="speed" && $by=="ASC"?"DESC":"ASC")."\">".SPEED."</a>".($order=="speed"?$mark:"");; ?></TD>
<TD align="center" class="header"><?php echo AVERAGE; ?></TD>
<?php 
  if ($CURUSER["mod_access"]=="yes" and $GLOBALS["show_recommended"] == "true")
{ 
?>
<TD align="center" class="header">Recommend</TD>
<?php
}
?>
<!--
<TD align="center" class="header"></TD>
<TD align="center" class="header"></TD>
-->
</TR>
<TR>

<?php
if ($SHOW_UPLOADER && intval($CURUSER["WT"])>0)
    echo "<TD colspan=\"15\" class=\"lista\"></TD>";
elseif ($SHOW_UPLOADER || intval($CURUSER["WT"])>0)
    echo "<TD colspan=\"14\" class=\"lista\"></TD>";
else
    echo "<TD colspan=\"13\" class=\"lista\"></TD>";
?>
</TR>
<?php
if ($count) {
  if (!isset($values[$i % 2])) $writeout = "";
  else $writeout = $values[$i % 2];
  while ($data=mysql_fetch_array($results))
  {
if(isset($_COOKIE['lastseen'])){
 $filetime =  date("YmdHis",$data["added"]);
if ($_COOKIE['lastseen'] <= $filetime) {
  $is_new = '<img alt="old" src="images/new.png" />';
}
else {   $is_new='';
}
}
  //Torrent Nuke/Req Hack Start - 22:53 07.08.2006
  if ($data["requested"] == "true") {
    $is_req = '<img title="This release was requested." src="images/req.gif" />';
  }
  else {   $is_req='';
  }

  if ($data["nuked"] == "true") {
    $is_nuke = '<img title="'.$data[nuke_reason].'" src="images/nuked.gif" />&nbsp;';
  }
  else {   $is_nuke='';
  }
  //Torrent Nuke/Req Hack Stop
  if($data['free']=="yes") {
		$golden = '<img alt="Golden Torrent" src="images/golden.gif" />';	 
	} else { $golden=""; }
$sticky = ($data[sticky]=="yes" ? "<img src='images/sticky.gif' bored='0' alt='sticky'> <b>Sticky</b><br>" : "");
   // search for comments
   $commentres = mysql_query("SELECT COUNT(*) as comments FROM comments WHERE info_hash='" . $data["hash"] . "'");
   $commentdata = mysql_fetch_assoc($commentres);
   echo "<TR>\n";
   echo "\t<td align=\"center\" class=\"lista\"><a href=torrents.php?category=$data[catid]>".image_or_link(($data["image"]==""?"":"images/categories/" . $data["image"]),"",$data["cname"])."</td>";
   //Torrent Nuke/Req Hack Start - 12:37 PM 9/3/2006
   //if ($GLOBALS["usepopup"])
   //    echo "\t<TD align=\"left\" class=\"lista\"><A HREF=\"javascript:popdetails('details.php?id=".$data["hash"]."');\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".((strlen($data["filename"]>='20')? substr($data["filename"],0,20)."..":$data["filename"])."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."</td>";
   //else
   //    echo "\t<TD align=\"left\" class=\"lista\"><A HREF=\"details.php?id=".$data["hash"]."\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".$data["filename"]."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."</td>";
if ($GLOBALS["enable_cutname"]==true)
{
   global $CUTNAME;
   if ($GLOBALS["usepopup"])
       echo "\t<TD align=\"left\" class=\"lista\" style=\"white-space:nowrap\">".$sticky."<A HREF=\"javascript:klappe('".$data["hash"]."')\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".((strlen($data["filename"])>='$CUTNAME')? substr($data["filename"],0,$CUTNAME)."...":$data["filename"])."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
   else
       echo "\t<TD align=\"left\" class=\"lista\" style=\"white-space:nowrap\">".$sticky."<A HREF=\"javascript:klappe('".$data["hash"]."')\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".((strlen($data["filename"])>='$CUTNAME')? substr($data["filename"],0,$CUTNAME)."...":$data["filename"])."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
}
else if ($GLOBALS["enable_cutname"]==false)
{
   if ($GLOBALS["usepopup"])
       echo "\t<TD align=\"left\" class=\"lista\" style=\"white-space:nowrap\">".$sticky."<A HREF=\"javascript:klappe('".$data["hash"]."')\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".$data["filename"]."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
   else
       echo "\t<TD align=\"left\" class=\"lista\" style=\"white-space:nowrap\">".$sticky."<A HREF=\"javascript:klappe('".$data["hash"]."')\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".$data["filename"]."</A>".($data["external"]=="no"?"":" (<span style=\"color:red\">EXT</span>)")."".$golden.""."".$is_nuke."".$is_req."".$is_new."</td>";
}
   //Torrent Nuke/Req Hack Stop
//   if ($commentdata) {
//      if ($commentdata["comments"]>0)
//        {
//         if ($GLOBALS["usepopup"])
//              echo "\t<TD align=\"center\" class=\"lista\"><A HREF=\"javascript:popdetails('details.php?id=".$data["hash"]."#comments');\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">" . $commentdata["comments"] . "</A></td>";
//         else
//             echo "\t<TD align=\"center\" class=\"lista\"><A HREF=\"details.php?id=".$data["hash"]."#comments\" title=\"".VIEW_DETAILS.": ".$data["filename"]."\">".$commentdata["comments"]."</A></td>";
//        }
//     else
//         echo "\t<TD align=\"center\" class=\"lista\">--</td>";
//   }
//   else echo "\t<TD align=\"center\" class=\"lista\">--</td>";

   // Rating
   $vres = mysql_query("SELECT sum(rating) as totrate, count(*) as votes FROM ratings WHERE infohash = '" . $data["hash"] . "'");
   $vrow = @mysql_fetch_array($vres);
   if ($vrow && $vrow["votes"]>=1)
      {
      $totrate=round($vrow["totrate"]/$vrow["votes"],1);
      if ($totrate==5)
         $totrate="<img src=$STYLEPATH/5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
      elseif ($totrate>4.4 && $totrate<5)
         $totrate="<img src=$STYLEPATH/4.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
      elseif ($totrate>3.9 && $totrate<4.5)
         $totrate="<img src=$STYLEPATH/4.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
      elseif ($totrate>3.4 && $totrate<4)
         $totrate="<img src=$STYLEPATH/3.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
      elseif ($totrate>2.9 && $totrate<3.5)
         $totrate="<img src=$STYLEPATH/3.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\"  />";
      elseif ($totrate>2.4 && $totrate<3)
         $totrate="<img src=$STYLEPATH/2.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\"  />";
      elseif ($totrate>1.9 && $totrate<2.5)
         $totrate="<img src=$STYLEPATH/2.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\"  />";
      elseif ($totrate>1.4 && $totrate<2)
         $totrate="<img src=$STYLEPATH/1.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\"  />";
      else
         $totrate="<img src=$STYLEPATH/1.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\"  />";
      }
   else
       $totrate=NA;

   echo "\t<TD align=\"center\" class=\"lista\">$totrate</td>\n";
    // end rating

    //waitingtime
    // display only if the curuser have some WT restriction
    if (intval($CURUSER["WT"])>0)
        {
        $wait=0;
        $resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);
        $rowuser=mysql_fetch_array($resuser);
        $wait=0;
        if (intval($rowuser['downloaded'])>0) $ratio=number_format($rowuser['uploaded']/$rowuser['downloaded'],2);
        else $ratio=0.0;
//        $res2 =mysql_query("SELECT * FROM namemap WHERE info_hash='".$data["hash"]."'");
//        $added=mysql_fetch_array($res2);
        $vz = $data["added"];
        $timer = floor((time() - $vz) / 3600);
        if($ratio<1.0 && $rowuser['id']!=$data["uploader"]){
            $wait=$CURUSER["WT"];
        }
        $wait -=$timer;

        if ($wait<=0)$wait=0;
       if (strlen($data["hash"]) > 0)
            echo "\t<td align=\"center\" class=\"lista\">".($wait>0?$wait." h":"---")."</td>\n"; // WT
    //end waitingtime
    }
//       echo "\t<TD align=\"center\" class=\"lista\"><A HREF=download.php?id=".$data["hash"]."&amp;f=" . urlencode($data["filename"]) . ".torrent>".image_or_link("images/download.gif","","torrent")."</A></TD>\n";

   include("include/offset.php");
   echo "\t<td align=\"center\" class=\"lista\">" . date("d/m/Y",$data["added"]-$offset) . "</td>\n"; // data
   echo "\t<td align=\"center\" class=\"lista\">" . makesize($data["size"]) . "</td>\n";
//Uploaders nick details
if ($SHOW_UPLOADER && $data["anonymous"] == "true")
echo "\t<td align=\"center\" class=\"lista\">" . ANONYMOUS . "</td>\n";
elseif ($SHOW_UPLOADER && $data["anonymous"] == "false")
echo "\t<td align=\"center\" class=\"lista\"><a href=userdetails.php?id=" . $data["upname"] . ">".StripSlashes($data['prefixcolor'].$data["uploader"].$data['suffixcolor'])."</a>".Warn_disabled($data['upname'])."</td>\n";
//Uploaders nick details
   if ($data["external"]=="no")
      {
       if ($GLOBALS["usepopup"])
         {
         echo "\t<td align=\"center\" class=\"".linkcolor($data["seeds"])."\"><a href=\"javascript:poppeer('peers.php?id=".$data["hash"]."');\" title=\"".PEERS_DETAILS."\">" . $data["seeds"] . "</a></td>\n";
         echo "\t<td align=\"center\" class=\"".linkcolor($data["leechers"])."\"><a href=\"javascript:poppeer('peers.php?id=".$data["hash"]."');\" title=\"".PEERS_DETAILS."\">" .$data["leechers"] . "</a></td>\n";
         if ($data["finished"]>0)
            echo "\t<td align=\"center\" class=\"lista\"><a href=\"javascript:poppeer('torrent_history.php?id=".$data["hash"]."');\" title=\"History - ".$data["filename"]."\">" . number_format($data["finished"],0) . "</a></td>";
         else
             echo "\t<td align=\"center\" class=\"lista\">---</td>";
         }
       else
         {
         echo "\t<td align=\"center\" class=\"".linkcolor($data["seeds"])."\"><a href=\"peers.php?id=".$data["hash"]."\" title=\"".PEERS_DETAILS."\">" . $data["seeds"] . "</a></td>\n";
         echo "\t<td align=\"center\" class=\"".linkcolor($data["leechers"])."\"><a href=\"peers.php?id=".$data["hash"]."\" title=\"".PEERS_DETAILS."\">" .$data["leechers"] . "</a></td>\n";
         if ($data["finished"]>0)
            echo "\t<td align=\"center\" class=\"lista\"><a href=\"torrent_history.php?id=".$data["hash"]."\" title=\"History - ".$data["filename"]."\">" . number_format($data["finished"],0) . "</a></td>";
         else
             echo "\t<td align=\"center\" class=\"lista\">---</td>";
         }
      }
   else
       {
       // linkcolor
       echo "\t<td align=\"center\" class=\"".linkcolor($data["seeds"])."\">" . $data["seeds"] . "</td>";
       echo "\t<td align=\"center\" class=\"".linkcolor($data["leechers"])."\">" .$data["leechers"] . "</td>";
       if ($data["finished"]>0)
          echo "\t<td align=\"center\" class=\"lista\">" . number_format($data["finished"],0) . "</td>";
       else
           echo "\t<td align=\"center\" class=\"lista\">---</td>";
   }
   if ($data["dwned"]>0)
      echo "\t<td align=\"center\" class=\"lista\">" . makesize($data["dwned"]) . "</td>";
   else
       echo "\t<td align=\"center\" class=\"lista\">".NA."</td>";

   if ($data["speed"] < 0 || $data["external"]=="yes") {
      $speed = NA;
      echo "\t<TD align=\"center\" class=\"lista\">$speed</TD>\n";
   }
       else if ($data["speed"] > 2097152) {
            $speed = round($data["speed"]/1048576,2) . " MB/sec";
            echo "\t<TD align=\"center\" class=\"lista\">$speed</TD>\n";
   }
       else {
               $speed = round($data["speed"] / 1024, 2) . " KB/sec";
               echo "\t<TD align=\"center\" class=\"lista\">$speed</TD>\n";
   }
  // progress
  if ($data["external"]=="yes")
     $prgsf=NA;
  else {
       $id = $data['hash'];
       $subres = mysql_query("SELECT sum(bytes) as to_go, count(*) as numpeers FROM peers where infohash='$id'" ) or mysql_error();
       $subres2 = mysql_query("SELECT size FROM namemap WHERE info_hash ='$id'") or mysql_error();
       $torrent = mysql_fetch_array($subres2);
       $subrow = mysql_fetch_array($subres);
       $tmp=0+$subrow["numpeers"];
       if ($tmp>0) {
          $tsize=(0+$torrent["size"])*$tmp;
          $tbyte=0+$subrow["to_go"];
          $prgs=(($tsize-$tbyte)/$tsize) * 100; //100 * (1-($tbyte/$tsize));
          $prgsf=floor($prgs);
          }
       else
           $prgsf=0;
       $prgsf.="%";
  }
// Visual Seed/Leech
 // print("<td align=\"center\" class=\"lista\">".$prgsf ."</td>");
 if ($prgsf==0)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-0.gif'></td>");

 if ($prgsf==1 || $prgsf==2 || $prgsf==3 || $prgsf==4 || $prgsf==5 || $prgsf==6 || $prgsf==7 || $prgsf==8 || $prgsf==9 || $prgsf==10 || $prgsf==11 || $prgsf==12 || $prgsf==13 || $prgsf==14 || $prgsf==15 || $prgsf==16 || $prgsf==17 || $prgsf==18 || $prgsf==19  || $prgsf==20)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-1.gif'></td>");

 if ($prgsf==21 || $prgsf==22 || $prgsf==23 || $prgsf==24 || $prgsf==25 || $prgsf==26 || $prgsf==27 || $prgsf==28 || $prgsf==29 || $prgsf==30 || $prgsf==31 || $prgsf==32 || $prgsf==33 || $prgsf==34 || $prgsf==35 || $prgsf==36 || $prgsf==37 || $prgsf==38 || $prgsf==39 || $prgsf==40 || $prgsf==41 || $prgsf==42 || $prgsf==43 || $prgsf==44 || $prgsf==45)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-2.gif'></td>");

 if ($prgsf==46 || $prgsf==47 || $prgsf==48 || $prgsf==49 || $prgsf==50 || $prgsf==51 || $prgsf==52 || $prgsf==53 || $prgsf==54 || $prgsf==55 || $prgsf==56 || $prgsf==57 || $prgsf==58 || $prgsf==59 || $prgsf==60 || $prgsf==61 || $prgsf==62 || $prgsf==63 || $prgsf==64 || $prgsf==65 || $prgsf==66 || $prgsf==67 || $prgsf==68 || $prgsf==69 || $prgsf==70)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-3.gif'></td>");

 if ($prgsf==71 || $prgsf==72 || $prgsf==73 || $prgsf==74 || $prgsf==75 || $prgsf==76 || $prgsf==77 || $prgsf==78 || $prgsf==79 || $prgsf==80 || $prgsf==81 || $prgsf==82 || $prgsf==83 || $prgsf==84 || $prgsf==85 || $prgsf==86 || $prgsf==87 || $prgsf==88 || $prgsf==89 || $prgsf==90 || $prgsf==91 || $prgsf==92 || $prgsf==93 || $prgsf==94 || $prgsf==95 || $prgsf==96 || $prgsf==97 || $prgsf==98 || $prgsf==99)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-4.gif'></td>");

 if ($prgsf==100)
 print("<td align=center class=\"lista\">".$prgsf ."<br /><img border='0' src='images/progress-5.gif'></td>");

// if ($prgsf==NA)
// print("<td align=center class=\"lista\">NA</td>");
/*
  // edit and delete picture/link
  if ($CURUSER["uid"]==$data["uploader"] || $CURUSER["edit_torrents"]=="yes")
     print("<td class=\"lista\" align=\"center\"><a href=edit.php?info_hash=".$data["hash"]."&amp;returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/edit.gif","",EDIT)."</a></td>");
  else
      print("<td class=\"lista\" align=\"center\">&nbsp;</td>");

  if ($CURUSER["uid"]==$data["uploader"] || $CURUSER["delete_torrents"]=="yes")
     print("<td class=\"lista\" align=\"center\"><a href=delete.php?info_hash=".$data["hash"]."&amp;returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/delete.gif","",DELETE)."</a></td>");
  else
      print("<td class=\"lista\" align=\"center\">&nbsp;</td>");
*/

//Recommended start
  if ($CURUSER["mod_access"]=="yes" and $GLOBALS["show_recommended"] == "true")
{
      print("<td class=lista align=center><a href=recommended.php?action=add&info_hash=".$data["hash"].">".image_or_link("images/Recomend.jpg","","Recommend")."</a></td>");
}
//  else
//      print("<td class=lista align=center>&nbsp;</td>");
//Recommended Ends

   echo "</TR>\n";

//JavaScript Torrents Browse Hack Start - 11:31 AM 3/18/2007
print("\n\n<tr><td colspan=\"13\" class=lista align=center>\n");
print("<div id=\"".$data['hash']."\" style=\"display: none;\">\n");

//print begin table
print("<table border=0 cellspacing=2 cellpadding=2 width=100%>\n");

//print horizontal rule
print_hr("90%", "$STYLEPATH/line_a.gif", "$STYLEPATH/line_b.gif", "$STYLEPATH/line_c.gif");

//print options menu
print("<tr><td class=lista align=left><table align=left border=0 cellspacing=0 cellpadding=0 width=70%><tr><td class=lista align=left>\n");
print("<b>Options: </b></td>\n");

if ($GLOBALS["torrent_download_check"] == "true")
{
print("<td class=lista align=left title=\"".DOWNLOAD.":&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('torrentdownload.php?id=".$data["hash"]."','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/download.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;Download</td></tr></table></td>\n");
} else {
print("<td class=lista align=left title=\"".DOWNLOAD.":&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('download.php?id=".$data["hash"]."&f=" . urlencode($data["filename"]) . ".torrent','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/download.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;Download</td></tr></table></td>\n");
}
if ($GLOBALS["usepopup"])
print("<td class=lista align=left title=\"Details for:&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"javascript:popdetails('details.php?id=".$data["hash"]."&amp;hit=1');\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/torrent_name.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;Details</td></tr></table></td>\n");
else
print("<td class=lista align=left title=\"Details for:&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('details.php?id=".$data["hash"]."&amp;hit=1','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/torrent_name.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;Details</td></tr></table></td>\n");
if (file_exists("./wishlist.php"))
print("<td class=lista align=left title=\"Add&nbsp;to&nbsp;WishList:&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('wishlist.php?do=add&amp;torrent_id=".$data["hash"]."','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/wishlist.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;Add to WishList</td></tr></table></td>\n");
if (file_exists("./report.php"))
print("<td class=lista align=left title=\"Report:&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('report.php?torrent=".$data["hash"]."','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/report.gif); background-repeat: no-repeat; width:16px; height:17px;\" align=center></td><td>&nbsp;Report</td></tr></table></td>\n");
if (!empty($data["nfo"]))
print("<td class=lista align=left title=\"ViewNFO:&nbsp;".$data["filename"]."\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('viewnfo.php?info_hash=".$data["hash"]."','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/viewnfo.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;ViewNFO</td></tr></table></td>\n");

//print comments
   if ($commentdata)
     {
      if ($commentdata["comments"]>0)
	{
	  $res1000 = mysql_query("SELECT text, user FROM comments WHERE info_hash='".$data["hash"]."' ORDER BY added DESC LIMIT 1");
	  $arr1000 = mysql_fetch_array($res1000);
	  $user=$arr1000["user"];
	  $latestcomment=$arr1000["text"];
	  echo "\t<td class=lista align=left style=\"white-space:nowrap\"><table border=0 cellspacing=0 cellpadding=0 align=left onClick=\"window.open('details.php?id=".$data["hash"]."&amp;hit=1','_self')\" style=\"cursor:pointer; cursor:hand;\"><tr><td style=\"background-image: url(images/torrent_comments.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;".COMMENTS." (<b>".$commentdata["comments"]."</b>)</td></tr></table></A></td>\n";
	}
      else
	{
	  echo "\t<td class=lista align=left style=\"white-space:nowrap\"><table border=0 cellspacing=0 cellpadding=0 align=left><tr><td style=\"background-image: url(images/torrent_comments.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;".COMMENTS." (<b><span style=\"color:#006699\">0</span></b>)</td></tr></table></A></td>\n";
	}
     }
   else
     {
      echo "\t<td class=lista align=left style=\"white-space:nowrap\"><table border=0 cellspacing=0 cellpadding=0 align=left><tr><td style=\"background-image: url(images/torrent_comments.gif); background-repeat: no-repeat; width:17px; height:17px;\" align=center></td><td>&nbsp;".COMMENTS." (<b><span style=\"color:#006699\">0</span></b>)</td></tr></table></A></td>\n";
     }

//print end table
print("</td></tr></table></td>\n");

//print horizontal rule
print_hr("60%", "$STYLEPATH/line_a.gif", "$STYLEPATH/line_b.gif", "$STYLEPATH/line_c.gif");

//print torrent description
print("<tr>");
print("<td class=lista align=left><b>".DESCRIPTION.":</b></td>");
print("</tr>\n");
print("<tr>");
print("<td class=lista align=left><table border=0 cellspacing=0 cellpadding=0 width=60%><tr><td>".format_comment($data["comment"])."</td></tr></table></td>");
print("</tr>\n");


//print torrent image
if (!empty($data["torimg"])) {

//print horizontal rule
print_hr("60%", "$STYLEPATH/line_a.gif", "$STYLEPATH/line_b.gif", "$STYLEPATH/line_c.gif");

print("<tr>");
print("<td class=lista align=left><b>".IMAGE.":</b></td>");
print("</tr>");
$image1 = "".$data["torimg"]."";
print("<tr>");
print("<td class=lista align=left><A HREF=\"javascript:popimages('image.php?id=".$data["hash"]."&amp;image=$image1');\" title=\"".VIEW_IMAGE."\"><img src=\"torrentimg/$image1\" width=100 border=0 /></a></td>");
print("</tr>\n");
}

//print horizontal rule
print_hr("90%", "$STYLEPATH/line_a.gif", "$STYLEPATH/line_b.gif", "$STYLEPATH/line_c.gif");

print("</table>");
print("</div>");
print("</td></tr>");
//JavaScript Torrents Browse Hack Stop
   $i++;
  }
} // if count

if ($i == 0 && $SHOW_UPLOADER)
         echo "<TR><TD class=\"lista\" colspan=\"17\" align=\"center\">".NO_TORRENTS."</TD></TR>";
elseif ($i == 0 && !$SHOW_UPLOADER) echo "<TR><TD class=\"lista\" colspan=\"16\" align=\"center\">".NO_TORRENTS."</TD></TR>";

?>
</TR>
</TABLE>
<TR><TD colspan="2" align="center"> <?php echo $pagerbottom ?></TD></TR>

<?php

block_end();
stdfoot();
?>
