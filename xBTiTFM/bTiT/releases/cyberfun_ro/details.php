<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");
require_once("imdb.class.php");


dbconn();

//Fix Code added 06-07-2007
global $CURUSER;
if (!$CURUSER || $CURUSER["view_torrents"] == "no")
{
standardheader("Access Denied");
block_begin("Access Denied");
err_msg(ERROR,"You do not have permission to access this page");
block_end();
stdfoot();
exit();
}
else
{

standardheader('Torrent Details',($GLOBALS["usepopup"]?false:true));
?>
<script language=javascript>
function windowunder(link)
{
  window.opener.document.location=link;
  window.close();
}
</script>
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/slimbox.js"></script>
<script type="text/javascript" src="js/mootools.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/videobox.js"></script>
<link rel="stylesheet" href="css/slimbox.css" type="text/css" media="screen" />
<?php
block_begin(TORRENT_DETAIL);

$id = AddSlashes((isset($_GET["id"])?$_GET["id"]:false));
if (!isset($id) || !$id)
    die(ERROR_ID.": $id");

if (isset($_GET["act"]))
   {
       print("<center>".TORRENT_UPDATE."</center>");
       require_once("./include/getscrape.php");
       scrape(urldecode($_GET["surl"]),$id);
       redirect("details.php?id=$id");
       exit();
   }

if (isset($_GET["vote"]) && $_GET["vote"] == VOTE)
   {
if (isset($_GET["rating"]) && $_GET["rating"] == 0)
{
   err_msg(ERROR,ERR_NO_VOTE);
     block_end();
     stdfoot(($GLOBALS["usepopup"]?false:true),false);
     exit();
}
else {
   @mysql_query("INSERT INTO ratings SET infohash='$id',userid=$CURUSER[uid],rating=".intval($_GET["rating"]).",added='".time()."'");
   redirect("details.php?id=$id");
}
   exit();
}

$res = mysql_query("SELECT namemap.genre, namemap.scene, namemap.info_hash, namemap.infosite, namemap.screen, namemap.video, namemap.dd, namemap.imdb, nfo, namemap.filename, namemap.url, UNIX_TIMESTAMP(namemap.data) as data, namemap.size, namemap.comment, namemap.requested, namemap.nuked, namemap.nuke_reason, namemap.uploader, categories.name as cat_name, summary.seeds, summary.leechers, summary.finished, summary.speed, namemap.external, namemap.announce_url,UNIX_TIMESTAMP(namemap.lastupdate) as lastupdate, namemap.anonymous, users.username FROM namemap LEFT JOIN categories ON categories.id=namemap.category LEFT JOIN summary ON summary.info_hash=namemap.info_hash LEFT JOIN users ON users.id=namemap.uploader WHERE namemap.info_hash ='" . $id . "'")
    or die(mysql_error());
$row = mysql_fetch_array($res);

if (!$row)
   die("Bad ID!");

$spacer = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

print("<div align=center><table class=\"lista\" border=\"0\" cellspacing=\"5\" cellpadding=\"5\">\n");
//print("<tr><td align=\"right\" class=\"header\"> ".FILE_NAME.":</td><td class=\"lista\" align=\"center\">" . $row["filename"]. "</td></tr>\n");
print("<tr><td align=\"right\" class=\"header\"> ".FILE_NAME);

if ($CURUSER["uid"] > 1 && ($CURUSER["uid"] == $row["uploader"] || $CURUSER["edit_torrents"] == "yes" || $CURUSER["delete_torrents"] == "yes"))
    print("<br />&nbsp;&nbsp;");

// edit and delete picture/link
if ($CURUSER["uid"] > 1 && ($CURUSER["uid"] == $row["uploader"] || $CURUSER["edit_torrents"] == "yes")) {
      if ($GLOBALS["usepopup"])
        print("<a href=\"javascript: windowunder('edit.php?info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("torrents.php")."')\">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a>&nbsp;&nbsp;");
      else
        print("<a href=edit.php?info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/edit.gif","",EDIT)."</a>&nbsp;&nbsp;");
}

if ($CURUSER["uid"] > 1 && ($CURUSER["uid"] == $row["uploader"] || $CURUSER["delete_torrents"] == "yes")) {
      if ($GLOBALS["usepopup"])
        print("<a href=\"javascript: windowunder('delete.php?info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("torrents.php")."')\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a>&nbsp;&nbsp;");
      else
        print("<a href=delete.php?info_hash=".$row["info_hash"]."&amp;returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/delete.gif","",DELETE)."</a>");
}

print("</td><td class=\"lista\" align=\"center\">" . $row["filename"]."</td></tr>\n");
if ($GLOBALS["torrent_download_check"] == "true")
{
print("<tr><td align=\"right\" class=\"header\"> ".TORRENT.":</td><td class=\"lista\" align=\"center\"><a class \"index\" <a href=\"torrentdownload.php?id=".$row["info_hash"]."\">" . $row["filename"] . "</a><br><small><a href=report.php?torrent=".$row["info_hash"]."><font color=Red>Report this torrent</font></a> <a href=wishlist.php?do=add&torrent_id=".$row["info_hash"]."><font color=Green>Add to wishlist</font></a></td></tr>\n");
} else {
print("<tr><td align=\"right\" class=\"header\"> ".TORRENT.":</td><td class=\"lista\" align=\"center\"><a class \"index\" <a href=\"download.php?id=".$row["info_hash"]."&f=" . rawurlencode($row["filename"]) . ".torrent\">" . $row["filename"] . "</a><br><small><a href=report.php?torrent=".$row["info_hash"]."><font color=Red>Report this torrent</font></a> <a href=wishlist.php?do=add&torrent_id=".$row["info_hash"]."><font color=Green>Add to wishlist</font></a></td></tr>\n");
}
print("<tr><td align=\"right\" class=\"header\"> ".INFO_HASH.":</td><td class=\"lista\" align=\"center\">" . $row["info_hash"]. "</td></tr>\n");
//Extra option hack start
if (!empty($row["infosite"]))
{
print("<tr><td align=\"right\" class=\"header\"> ".INFOSITE.":</td><td class=\"lista\" align=\"center\"><a target=\"blank\" href=\"".$row["infosite"]."\">".$row["infosite"]."</a></td></tr>\n");
}
if (!empty($row["screen"]))
{
$split=split("<br>", $row["screen"]);
foreach($split as $idx => $img)
{
if ($idx > -1 && !empty($img))
{
$idx++;
$imgs.=("<tr><td valign=\"middle\" align=\"right\" class=\"header\">".SCREEN." $idx:</td><td class=\"lista\" align=\"center\"><a href=\"$img\" rel=\"lightbox[roadtrip]\"><img width=80 border=0 src=\"$img\"></img></a></td></tr>\n");
}
}
print $imgs;
}
/****
if (!empty($row["screen"]))
{
print("<tr><td align=\"right\" class=\"header\"> ".SCREEN.":</td><td class=\"lista\" align=\"center\"><a href=\"".$row["screen"]."\" rel=\"lightbox[roadtrip]\"><img width=80 border=0 src=\"".$row["screen"]."\"></img></a></td></tr>\n");
}
if (!empty($row["screen2"]))
{
print("<tr><td align=\"right\" class=\"header\"> ".SCREEN.":</td><td class=\"lista\" align=\"center\"><a href=\"".$row["screen2"]."\" rel=\"lightbox[roadtrip]\"><img width=80 border=0 src=\"".$row["screen2"]."\"></img></a></td></tr>\n");
}
***/
/****
if (!empty($row["video"]))
{
print("<tr><td align=\"right\" class=\"header\"> ".VIDEO.":</td><td class=\"lista\" align=\"center\"><a href=\"".$row["video"]."\" rel=\"vidbox\"><center>Click Here to View the Video</center></a></td></tr>\n");
}
****/

if (!empty($row["video"]))
{
if (preg_match("/.*v=(.*)/i",$row["video"],$id) || preg_match("/.*\/v\/(.*)/i",$row["video"],$id))
{
$src="<img border=\"0\" src=\"http://img.youtube.com/vi/$id[1]/default.jpg\">";
}
elseif (preg_match("/.*\/video\/([1-9]*)/i",$row["video"],$id))
{
$src="<img border=\"0\" src=\"http://dyn.ifilm.com/resize/image/stills/films/resize/istd/$id[1].jpg?width=130\">";
}
else
{
$src="Click Here to View the Video";
}
print("<tr><td align=\"right\" class=\"header\"> ".VIDEO.":</td><td class=\"lista\" align=\"center\"><a href=\"".$row["video"]."\" rel=\"vidbox\">$src</a></td></tr>\n");
}

if (!empty($row["dd"]))
if (($CURUSER["id_level"]) > "5")
{
print("<tr><td align=\"right\" class=\"header\"> ".DD.":</td><td class=\"lista\" align=\"center\"><a href=\"".$row["dd"]."\">".DD."</a></td></tr>\n");
}
//Extra option hack ends
if (!empty($row["nfo"])){
print("<tr><td align=right class=\"header\"> NFO:</td><td align=left class=\"lista\" ><a href=viewnfo.php?info_hash=" . $row["info_hash"]. "><b>View NFO</b></a></td></tr>\n");
}
if (!empty($row["comment"]))
   print("<tr><td align=\"right\" class=\"header\"> ".DESCRIPTION.":</td><td align=\"center\" class=\"lista\">" . format_comment($row["comment"]) . "</td></tr>\n");

//auto imdb mod by cyberdoc
               if (($row["imdb"] != "")AND(strpos($row["imdb"], imdb))AND(strpos($row["imdb"], title)))
                  {
               $thenumbers = ltrim(strrchr($row["imdb"],'tt'),'tt');
               $thenumbers = ereg_replace("[^A-Za-z0-9]", "", $thenumbers);
               $movie = new imdb ($thenumbers);
               $movieid = $thenumbers;
               $movie->setid ($movieid);
               $country = $movie->country ();
               $director = $movie->director();
               $write = $movie->writing();
               $produce = $movie->producer();
               $cast = $movie->cast();
               $plot = $movie->plot ();
               $compose = $movie->composer();
               $gen = $movie->genres();
              
                if (($photo_url = $movie->photo_localurl() ) != FALSE) {
                $smallth = '<img src="'.$photo_url.'">';
                }

               $autodata = "<strong><font color=\"navy\">#######################################################################</font><br />\n";
               $autodata .= "<font color=\"darkred\" size=\"3\">IMDb Information:</font><br />\n";
               $autodata .= "<font color=\"navy\">#######################################################################</font></strong><br />\n";
$autodata .= "<img src=".$movie->photo_localurl()."><br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Title: </font></strong>" . "".$movie->title ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Also known as: </font></strong>";

      foreach ( $movie->alsoknow() as $ak){
               $autodata .= "".$ak["title"]."" . "".$ak["year"].""  . "".$ak["country"]."" . " (" . "".$ak["comment"]."" . ")" . ", ";
      }
               $autodata .= "<br />\n<strong><font color=\"DarkRed\"> Year: </font></strong>" . "".$movie->year ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Runtime: </font></strong>" . "".$movie->runtime ()."" . " mins<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Votes: </font></strong>" . "".$movie->votes ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Rating: </font></strong>" . "".$movie->rating ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Language: </font></strong>" . "".$movie->language ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Country: </font></strong>";
                      
      for ($i = 0; $i + 1 < count ($country); $i++) {
               $autodata .="$country[$i], ";
      }
               $autodata .= "$country[$i]";
               $autodata .= "<br />\n<strong><font color=\"DarkRed\"> All Genres: </font></strong>";
               for ($i = 0; $i + 1 < count($gen); $i++) {
               $autodata .= "$gen[$i], ";
  }
               $autodata .= "$gen[$i]";
               $autodata .= "<br />\n<strong><font color=\"DarkRed\"> Tagline: </font></strong>" . "".$movie->tagline ()."<br />\n";
               $autodata .= "<strong><font color=\"DarkRed\"> Director: </font></strong>";

     for ($i = 0; $i < count ($director); $i++) {
               $autodata .= "<a target=\"_blank\" href=\"http://us.imdb.com/Name?" . "".$director[$i]["imdb"]."" ."\">" . "".$director[$i]["name"]."" . "</a> ";
      }
        
               $autodata .= "<br />\n<strong><font color=\"DarkRed\"> Writing By: </font></strong>";
     for ($i = 0; $i < count ($write); $i++) {
               $autodata .= "<a target=\"_blank\" href=\"http://us.imdb.com/Name?" . "".$write[$i]["imdb"]."" ."\">" . "".$write[$i]["name"]."" . "</a> ";
      }
        
              $autodata .= "<br />\n<strong><font color=\"DarkRed\"> Produced By: </font></strong>";
     for ($i = 0; $i < count ($produce); $i++) {
              $autodata .= "<a target=\"_blank\" href=\"http://us.imdb.com/Name?" . "".$produce[$i]["imdb"]."" ." \">" . "".$produce[$i]["name"]."" . "</a> ";
      }
              
              $autodata .= "<br />\n<strong><font color=\"DarkRed\"> Music: </font></strong>";              
    for ($i = 0; $i < count($compose); $i++) {
              $autodata .= "<a target=\"_blank\" href=\"http://us.imdb.com/Name?" . "".$compose[$i]["imdb"]."" ." \">" . "".$compose[$i]["name"]."" . "</a> ";     
      }

              $autodata .= "<br /><br />\n\n<strong><font color=\"navy\">#######################################################################</font><br />\n";
              $autodata .= "<font color=\"darkred\" size=\"3\"> Description:</font><br />\n";
              $autodata .= "<font color=\"navy\">#######################################################################</font></strong>";
      for ($i = 0; $i < count ($plot); $i++) {
              $autodata .= "<br />\n<font color=\"DarkRed\">•</font> ";
              $autodata .= "$plot[$i]";
      }      
    
              $autodata .= "<br /><br />\n\n<strong><font color=\"navy\">#######################################################################</font><br />\n";
              $autodata .= "<font color=\"darkred\" size=\"3\"> Cast:</font><br />\n";
              $autodata .= "<font color=\"navy\">#######################################################################</font></strong><br />\n";

     for ($i = 0; $i < count ($cast); $i++) {
              if ($i > 9) {
                break;
              }
              $autodata .= "<font color=\"DarkRed\">•</font> " . "<a target=\"_blank\" href=\"http://us.imdb.com/Name?" . "".$cast[$i]["imdb"]."" ."\">" . "".$cast[$i]["name"]."" . "</a> " . " as <strong><font color=\"DarkRed\">" . "".$cast[$i]["role"]."" . " </font></strong><br />\n";
              
               }
   print("<tr><td align=left class=\"header\">".IMDB."</td><td align=left class=\"lista\">".$autodata."</td></tr>\n");
               
                 }

//end auto imdb by cyberdoc
   
if (isset($row["cat_name"]))
   print("<tr><td align=\"right\" class=\"header\"> ".CATEGORY_FULL.":</td><td class=\"lista\" align=\"center\">" . unesc($row["cat_name"]). "</td></tr>\n");
else
    print("<tr><td align=\"right\" class=\"header\"> ".CATEGORY_FULL.":</td><td class=\"lista\" align=\"center\">(nessuno)</td></tr>\n");
print("<tr><td align=\"right\" class=\"header\">".SCENE_RELEASE.":</td><td class=\"lista\" >".$row["scene"]."</td></tr>\n");
if(!empty($row['genre']))
print("<tr><td align=\"right\" class=\"header\">".GENRE.":</td><td class=\"lista\" >".$row["genre"]."</td></tr>\n");
//Requested/Nuked Torrent Hack Start - 13:36 08.08.2006
if ($row["requested"] == "true")
$req="".YES."";
else
$req="".NO."";

if ($row["nuked"] == "true")
$nuke="".YES."";
else
$nuke="".NO."";

   print("<tr><td align=right class=\"header\">".TORRENT_REQUESTED.":</td><td align=left class=\"lista\" >".$req."</td></tr>\n");

   print("<tr><td align=right class=\"header\">".TORRENT_NUKED.":</td><td align=left class=\"lista\" >".$nuke."</td></tr>\n");

if ($row["nuked"] == "true")
   print("<tr><td align=right class=\"header\">".TORRENT_NUKED_REASON.":</td><td align=left class=\"lista\" >".$row["nuke_reason"]."</td></tr>\n");
//Requested/Nuked Torrent Hack Stop
// rating
print("<tr><td align=\"right\" class=\"header\"> ".RATING.":</td><td class=\"lista\" align=\"center\">\n");

$vres = mysql_query("SELECT sum(rating) as totrate, count(*) as votes FROM ratings WHERE infohash = '$id'");
$vrow = @mysql_fetch_array($vres);
if ($vrow && $vrow["votes"] >= 1)
   {
   $totrate = round($vrow["totrate"] / $vrow["votes"], 1);
   if ($totrate == 5)
      $totrate = "<img src=\"$STYLEPATH/5.gif\" title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 4.4 && $totrate < 5)
      $totrate = "<img src=$STYLEPATH/4.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 3.9 && $totrate < 4.5)
      $totrate = "<img src=$STYLEPATH/4.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 3.4 && $totrate < 4)
      $totrate = "<img src=$STYLEPATH/3.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 2.9 && $totrate < 3.5)
      $totrate = "<img src=$STYLEPATH/3.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 2.4 && $totrate < 3)
      $totrate = "<img src=$STYLEPATH/2.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 1.9 && $totrate < 2.5)
      $totrate = "<img src=$STYLEPATH/2.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   elseif ($totrate > 1.4 && $totrate < 2)
      $totrate = "<img src=$STYLEPATH/1.5.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   else
      $totrate = "<img src=$STYLEPATH/1.gif title=\"$vrow[votes] ".VOTES_RATING.": $totrate/5.0)\" />";
   }
else
    $totrate = NA;

if ($row["username"] != $CURUSER["username"] && $CURUSER["uid"] > 1)
   {
   $ratings = array(5 => FIVE_STAR,4 => FOUR_STAR,3 => THREE_STAR,2 => TWO_STAR,1 => ONE_STAR);
   $xres = mysql_query("SELECT rating, added FROM ratings WHERE infohash = '$id' AND userid = " . $CURUSER["uid"]);
   $xrow = @mysql_fetch_array($xres);
   if ($xrow)
       $s = $totrate. " (".YOU_RATE." \"" . $ratings[$xrow["rating"]] . "\")";
   else {
       $s = "<form method=\"get\" action=\"details.php\" name=\"vote\">\n";
       $s .= "<input type=\"hidden\" name=\"id\" value=\"$id\" />\n";
       $s .= "<select name=\"rating\">\n";
       $s .= "<option value=\"0\">(".ADD_RATING.")</option>\n";
       foreach ($ratings as $k => $v) {
           $s .= "<option value=\"$k\">$v</option>\n";
       }
       $s .= "</select>\n";
       $s .= "<input type=\"submit\" name=\"vote\" value=\"".VOTE."\" />";
       $s .= "</form>\n";
       }
}
else
    {
    $s = $totrate;
}
print $s;
print("</td></tr>\n");
print("<tr><td align=right class=\"header\"> ".SIZE.":</td><td class=\"lista\" align=\"center\">" . makesize($row["size"]). "</td></tr>\n");
// files in torrent - by Lupin 20/10/05

?>
<script type="text/javascript" language="JavaScript">
function ShowHide(id,id1) {
    obj = document.getElementsByTagName("div");
    if (obj[id].style.display == 'block'){
     obj[id].style.display = 'none';
     obj[id1].style.display = 'block';
    }
    else {
     obj[id].style.display = 'block';
     obj[id1].style.display = 'none';
    }
}

</script>
<?php

require_once(dirname(__FILE__)."/include/BDecode.php");
if (file_exists($row["url"]))
  {
    print("
    <tr>
    <td align=\"right\" class=\"header\" valign=\"top\">
    <a name=\"#expand\" href=\"#expand\" onclick=\"javascript:ShowHide('files','msgfile');\">Show/Hide Files: </td>
    <td align=\"left\" class=\"lista\">
    <div name=\"files\" style=\"display:none\" id=\"files\">
        <table class=\"lista\">
        <tr>
        <td align=\"center\" class=\"header\">".FILE_NAME."</td>
        <td align=\"center\" class=\"header\">".SIZE."</td>
        </tr>");
    $ffile = fopen($row["url"],"rb");
    $content = fread($ffile,filesize($row["url"]));
    fclose($ffile);
    $content = BDecode($content);
    $numfiles = 0;
    if (isset($content["info"]) && $content["info"])
      {
        $thefile = $content["info"];
        if (isset($thefile["length"]))
          {
          $numfiles++;
          print("\n<tr>\n<td align=\"left\" class=\"lista\">".htmlspecialchars($thefile["name"])."</td>\n<td align=\"right\" class=\"lista\">".makesize($thefile["length"])."</td></tr>\n");
          }
        elseif (isset($thefile["files"]))
         {
           foreach($thefile["files"] as $singlefile)
             {
               print("\n<tr>\n<td align=\"left\" class=\"lista\">".htmlspecialchars(implode("/",$singlefile["path"]))."</td>\n<td align=\"right\" class=\"lista\">".makesize($singlefile["length"])."</td></tr>\n");
               $numfiles++;
             }
         }
       else
         {
           print("\n<tr>\n<td colspan=\"2\">no data...</td></tr>\n");   // can't be but...
         }
     }
    print("</table></div>
    <div name=\"msgfile\" style=\"display:block\" id=\"msgfile\" align=\"center\">$numfiles".($numfiles==1?" file":" files")."</div>
    </td></tr>\n");
  }
// end files in torrents
include("include/offset.php");
print("<tr><td align=\"right\" class=\"header\"> ".ADDED.":</td><td class=\"lista\" align=\"center\">" . date("d/m/Y",$row["data"]-$offset). "</td></tr>\n");

if ($row["anonymous"] == "true")
{
   if ($CURUSER["edit_torrents"] == "yes")
       $uploader = "<a href=userdetails.php?id=".$row['uploader'].">".TORRENT_ANONYMOUS."</a>";
   else
      $uploader = TORRENT_ANONYMOUS;
   }
else
    $uploader = "<a href=userdetails.php?id=".$row['uploader'].">".$row["username"]."</a>";

print("<tr><td align=\"right\" class=\"header\"> ".UPLOADER.":</td><td class=\"lista\" >$uploader" . Warn_disabled($row['uploader']) . "</td></tr>\n");

if ($row["speed"] < 0) {
  $speed = "N/D";
}
else if ($row["speed"] > 2097152) {
  $speed = round($row["speed"] / 1048576, 2) . " MB/sec";
}
else {
  $speed = round($row["speed"] / 1024, 2) . " KB/sec";
}

print("<tr><td align=\"right\" class=\"header\"> ".SPEED.":</td><td class=\"lista\" align=\"center\">" . $speed . "</td></tr>\n");
//Reqseed Start
if ($row["seeds"] == 0 && $row["external"] == "no")
{
	print("<tr><td align=right class=\"header\">Request Reseed:</td><td class=\"lista\"  align=\"left\" ><a href=reseed.php?id=" . $row["info_hash"]. ">".image_or_link("images/reseedbutton.png","","Req Seed")."</a></td></tr>\n");
}
//print("<tr><td align=right class=\"header\">Req Seed:</td><td class=\"lista\" ><a href=reseed.php?id=" . $row["info_hash"]. ">".image_or_link("images/seed.png","","Req Seed")."</a></td></tr>\n");
//Reqseed Ends
//Update 06-12-07
if ($row["external"] == "no") {
// snatchers start
print("<tr><td align=right class=\"header\"> ".SNATCHERS.":</td><td class=\"lista\">");
  $sres = mysql_query("SELECT * FROM history WHERE infohash = '$id'");
  $line = 0;
  while ($srow = mysql_fetch_array($sres)) {
$res = mysql_query("SELECT prefixcolor, suffixcolor, users.id, username,level FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id='".$srow["uid"]."'") or die(mysql_error());
$result = mysql_fetch_array($res);
print("<a href=userdetails.php?id=$result[id]>".unesc($result["prefixcolor"]).unesc($result["username"]).unesc($result["suffixcolor"])."</a>, ");
$line++;
if ($line>6){
print ("<br>");
$line = 0;
}
}
print("</td></tr>\n");
//snatchers end
print("<tr><td align=\"right\" class=\"header\"> ".DOWNLOADED.":</td><td class=\"lista\" align=\"center\"><a href=torrent_history.php?id=".$row["info_hash"].">" . $row["finished"] . "</a> " . X_TIMES. "</td></tr>\n");
print("<tr><td align=\"right\" class=\"header\"> ".PEERS.":</td><td class=\"lista\" align=\"center\"> ".SEEDERS.": <a href=peers.php?id=".$row["info_hash"].">" . $row["seeds"] . "</a>, ".LEECHERS.": <a href=peers.php?id=".$row["info_hash"].">" . $row["leechers"] ."</a> = <a href=peers.php?id=".$row["info_hash"].">" . ($row["leechers"]+$row["seeds"]) . "</a> ".PEERS."</td></tr>\n");
}
else {
print("<tr><td align=\"right\" class=\"header\"> ".DOWNLOADED.":</td><td class=\"lista\" align=\"center\">" . $row["finished"] . " " . X_TIMES. "</td></tr>\n");
print("<tr><td align=\"right\" class=\"header\"> ".PEERS.":</td><td class=\"lista\" align=\"center\"> ".SEEDERS.": " . $row["seeds"] . ", ".LEECHERS.": " . $row["leechers"] ." = " . ($row["leechers"]+$row["seeds"]) . " ".PEERS."</td></tr>\n");
}
if ($row["leechers"] + $row["seeds"] == 0) {
print("<tr><td align=right class=\"header\"> Statistic: </td><td class=\"lista\" >Not available!</td></tr>");
}
else {
print("<tr><td align=right class=\"header\"> Statistic: </td><td class=\"lista\" ><img src=stat.php?id=".$row["info_hash"]."></td></tr>");
}
if ($row["external"] == "yes")
   {
       print("<tr><td valign=\"middle\" align=\"right\" class=\"header\"><a href=details.php?act=update&id=".$row["info_hash"]."&surl=".urlencode($row["announce_url"]).">".UPDATE."</a></td><td class=\"lista\" align=\"center\"><b>EXTERNAL</b><br />".$row["announce_url"]."</td></tr>\n");
       print("<tr><td valign=\"middle\" align=\"right\" class=\"header\">".LAST_UPDATE."</td><td class=\"lista\" align=\"center\">".get_date_time($row["lastupdate"])."</td></tr>\n");
   }
//Thanks Hack by Larkspeed
print("<tr><td align=right class=\"header\">Thanks:</td><td class=\"lista\" >");
$user = $CURUSER["uid"];
$uploaderres = mysql_query("SELECT uploader FROM namemap AS uploader WHERE info_hash = '$id'");
$uploaderrow = mysql_fetch_array($uploaderres);
$sres = mysql_query("SELECT * FROM thanks WHERE infohash = '$id' AND userid = '$user'");
$srow = mysql_fetch_array($sres);
if ($srow["userid"] == 0 && $uploaderrow["uploader"] != $user)
{
 print("<form action=\"thanks.php\" method=\"post\">");
 print("<input type=\"submit\" name=\"submit\" value=\"Say Thanks!\">");
 print("<input type=\"hidden\" name=\"infohash\" value=\"$id\">");
 print("</form>");
}
$sres = mysql_query("SELECT * FROM thanks WHERE infohash = '$id'");
while ($srow = mysql_fetch_array($sres))
{
$res = mysql_query("SELECT prefixcolor, suffixcolor, users.id, username, level FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id='".$srow["userid"]."'") or die(mysql_error());
$result = mysql_fetch_array($res);
print("<a href=userdetails.php?id=$result[id]>".unesc($result["prefixcolor"]).unesc($result["username"]).unesc($result["suffixcolor"])."</a>, ");
}
print("</td></tr>\n");
// End
print("</table>\n");
print("<a name=\"comments\" /></a>");
// comments...
$subres = mysql_query("SELECT avatar, comments.id, text, UNIX_TIMESTAMP(added) as data, user, users.id as uid, editedby, editedat, users.custom_title, users.id_level, UNIX_TIMESTAMP(lastconnect) AS lastconnect FROM comments LEFT JOIN users ON comments.user=users.username WHERE info_hash = '" . $id . "' ORDER BY added ASC");
if (!$subres || mysql_num_rows($subres) == 0) {
   if($CURUSER["uid"] > 1)
       $s = "<br /><br />\n<table width=\"95%\" class=\"lista\">\n<tr>\n<td align=\"center\">\n<a href=comment.php?id=" . $id . "&usern=".urlencode($CURUSER["username"]).">".NEW_COMMENT."</a>\n</td>\n</tr>\n";
   else
       $s = "<br /><br />\n<table width=\"95%\" class=\"lista\">\n";
       $s .= "<tr>\n<td class=\"lista\" align=\"center\">".NO_COMMENTS."</td>\n</tr>\n";
       $s .= "</table>\n";
}
else {
     print("<br /><br />");
     if($CURUSER["uid"] > 1)
       $s = "<br /><br />\n<table width=\"95%\" class=\"lista\"><tr><td colspan=\"3\" align=\"center\"><a href=comment.php?id=" . $id . "&usern=".urlencode($CURUSER["username"]).">".NEW_COMMENT."</a></td></tr>\n";
     else
         $s = "<br /><br />\n<table width=95% class=lista>\n";
     while ($subrow = mysql_fetch_array($subres)) {
//Custom Title System Hack Start
$level = mysql_query("SELECT level FROM users_level WHERE id='$subrow[id_level]'");
$lvl = mysql_fetch_assoc($level);

if (!$subrow[uid])
        $title = "orphaned";
elseif (!"$subrow[custom_title]")
        $title = "".$lvl['level']."";
else
        $title = unesc($subrow["custom_title"]);
//Custom Title System Hack Stop
/****
include("include/offset.php");
       $s .= "<tr><td class=\"header\"><a href=userdetails.php?id=".$subrow["uid"].">" . $subrow["user"] . "</a>" . Warn_disabled($subrow['uid']) . " (".$title.")</td><td class=\"header\">" . date("d/m/Y H.i.s",$subrow["data"]-$offset) . "</td>\n";
       // only users able to delete torrents can delete comments...
       if ($CURUSER["mod_access"] == "yes")
         $s .= "<td class=\"header\" align=\"right\"><a onclick=\"return confirm('". str_replace("'","\'",DELETE_CONFIRM)."')\" href=\"comment.php?id=$id&cid=" . $subrow["id"] . "&action=delete\">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n";
       $s .="</tr>\n";
       $s .= "<tr><td class=lista width=15% align=center><img width=150 border=0 src=".($subrow["avatar"])."></td><td valign=\"top\" colspan=\"3\" class=\"lista\">" . format_comment($subrow["text"]) . "</td></tr>\n";
        }
        $s .= "</table>\n";
}
print($s);
****/
//Start Comments Edit/Quote/Delete fixed for PB Edition 1.5.X by fatepower
include("include/offset.php");
       $s .= "<tr><td class=\"header\"><a href=userdetails.php?id=".$subrow["uid"].">" . $subrow["user"] . "</a>" . Warn_disabled($subrow['uid']) . " (".$title.")</td><td class=\"header\">" . date("d/m/Y H.i.s",$subrow["data"]-$offset) . "</td>\n";
 // Edit and delete comments... 
        if ($CURUSER["mod_access"] == "yes" || $CURUSER["edit_forum"] == "yes" || $CURUSER["delete_torrents"] == "yes") {
	   	$s .= "<td class=\"header\" align=\"right\"><a onclick=\"return confirm\" href=\"edit_comment.php?do=comments&action=quote&id=".$subrow["id"]."\">".image_or_link($STYLEPATH."/f_quote.png","","[".QUOTE."]")."</a>&nbsp;<a href=\"edit_comment.php?do=comments&action=edit&id=".$subrow["id"]."\">".image_or_link($STYLEPATH."/f_edit.png","","[".EDIT."]")."</a>&nbsp;<a onclick=\"return confirm('". str_replace("'","\'",DELETE_CONFIRM)."')\" href=\"comment.php?id=$id&cid=" . $subrow["id"] . "&action=delete\">".image_or_link($STYLEPATH."/f_delete.png","","[".DELETE."]")."</a></td>\n";
        } 
		elseif ($subrow["user"] == $CURUSER["username"]) {
		$s .= "<td class=\"header\" align=\"right\"><a onclick=\"return confirm\" href=\"edit_comment.php?do=comments&action=quote&id=".$subrow["id"]."\">".image_or_link($STYLEPATH."/f_quote.png","","[".QUOTE."]")."</a>&nbsp;<a href=\"edit_comment.php?do=comments&action=edit&id=".$subrow["id"]."\">".image_or_link($STYLEPATH."/f_edit.png","","[".EDIT."]")."</a></td>\n";		
		}
		elseif ($CURUSER["view_torrents"] == "yes") {
		$s .= "<td class=\"header\" align=\"right\"><a onclick=\"return confirm\" href=\"edit_comment.php?do=comments&action=quote&id=".$subrow["id"]."\">".image_or_link($STYLEPATH."/f_quote.png","","[".QUOTE."]")."</a></td>\n";
		}
       $s .= "</tr>\n";
       $s .= "<tr><td class=lista width=15% align=center><img width=150 border=0 src=".($subrow["avatar"])."></td><td valign=\"top\" colspan=\"3\" class=\"lista\">" . format_comment($subrow["text"]) . "</td></tr>\n";
// insert Last Edited
// Online User		   
$last = $subrow['lastconnect'];
$online = time();
      $online -= 60 * 15;
if($last > $online)
{
      $online = "User is online <img src=images/online.gif border=0>";
}
else
      $online = "User is offline <img src=images/offline.gif border=0>";
// End Online Users
      if (is_valid_id($subrow['editedby']))
      {
        $res2 = mysql_query("SELECT username FROM users WHERE id=$subrow[editedby]");
        if (mysql_num_rows($res2) == 1)
        {
          $userrow = mysql_fetch_assoc($res2);
          //$s .= "<td colspan=2 valign=bottom width=100% height=15 class=lista border=\"0\" align=right>".$online."&nbsp;&nbsp;<font size=1 class=small>".LAST_EDITED_BY." <a href=userdetails.php?id=$subrow[editedby]><b>$userrow[username]</b></a> at " . $subrow["editedat"] . "</font>&nbsp;&nbsp;<a class=\"postlink\" href=\"#Top\">".image_or_link("./images/top.gif","","TOP")."</a></td></tr>\n";
		     $s .= "<tr align=right><td width=90% colspan=\"3\" valign=bottom class=lista align=right border=0>".$online."&nbsp;&nbsp;<font size=1 class=small>".LAST_EDITED_BY." <a href=userdetails.php?id=$subrow[editedby]><b>$userrow[username]</b></a> at " . $subrow["editedat"] . "</font>&nbsp;&nbsp;<a class=\"postlink\" href=\"#Top\">".image_or_link("./images/top.gif","","TOP")."</a></td></tr>\n";
	   }
      }
		else $s .= "<tr align=right><td width=90% colspan=\"3\" valign=bottom class=lista align=right border=0>".$online."&nbsp;&nbsp;<font size=1px class=small>" . date("d/m/Y H.i.s",$subrow["data"]-$offset) . "</font>&nbsp;&nbsp;<a class=\"postlink\" href=\"#Top\">".image_or_link("./images/top.gif","","TOP")."</a></td></tr>\n";
// End Insert
		}
        $s .= "</table>\n";
}
print($s);
//End Comments Edit/Quote/Delete fixed for PB Edition 1.5.X by fatepower

if ($GLOBALS["usepopup"])
    print("</div><br /><br /><center><a href=\"javascript: window.close();\">".CLOSE."</a>");
else
    print("</div><br /><br /><center><a href=\"javascript: history.go(-1);\">".BACK."</a>");
print("</center>\n");

block_end();
stdfoot(($GLOBALS["usepopup"]?false:true),false);
}
?>
