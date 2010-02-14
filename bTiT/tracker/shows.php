<?php
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
standardheader('Episodes');
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
  {
       err_msg(ERROR,NEED_TO_BE_AN_MEMBER);
       stdfoot();
       exit;
}
else
    {
block_begin("Episodes");
global $CURUSER, $STYLEPATH;

//define shows here
$showcount = 7;


$showname[1] = "Prison Break";
$showimg[1] ="images/pbreak.jpg";

$showname[2] = "Lost";
$showimg[2] ="images/lost.jpg";

$showname[3] = "One Tree Hill";
$showimg[3] ="images/oth.jpg";

$showname[4] = "Stargate Atlantis";
$showimg[4] ="images/stga.jpg";

$showname[5] = "House";
$showimg[5] ="images/house_drama.jpg";

$showname[6] = "Battlestar Galactica";
$showimg[6] ="images/battlestar.galactica.jpg";

$showname[7] = "24";
$showimg[7] ="images/24.jpg";

//end


function get_show($show,$exact="",$episode="") {

if ( !$show ) { return FALSE; }

if ( $fp = fopen("http://www.tvrage.com/quickinfo.php?show=".urlencode($show)."&ep=".urlencode($episode)."&exact=".urlencode($exact),"r") )
  {
  while ( !feof($fp))
    {
    $line = fgets($fp,1024);
    list ($sec,$val) = explode('@',$line,2);
    if ($sec == "Show Name" )
      {
      $ret[0] = $val;
      }
    elseif ( $sec == "Show URL" )
      {
      $ret[1] = $val;
      }
    elseif ( $sec == "Premiered" )
      {
      $ret[2] = $val;
      }
    elseif ($sec == "Country" )
      {
      $ret[7] = $val;
      }
    elseif ( $sec == "Status" )
      {
      $ret[8] = $val;
      }
    elseif ( $sec == "Classification" )
      {
      $ret[9] = $val;
      }

    elseif ( $sec == "Latest Episode" )
      {
      list ($ep,$title,$airdate) = explode('^',$val);
      $ret[3] = $ep.", \"".$title."\" aired on ".$airdate;
      }
    elseif ( $sec == "Next Episode" )
      {
      list ($ep,$title,$airdate) = explode('^',$val);
      $ret[4] = $ep.", \"".$title."\" airs on ".$airdate;
      }
    elseif ( $sec == "Episode Info" )
      {
      list ($ep,$title,$airdate) = explode('^',$val);
      $ret[5] = $ep.", \"".$title."\" aired on ".$airdate;
      }
    elseif ( $sec == "Episode URL" )
      {
      $ret[6] = $val;
      }
    }
  fclose($fp);
  if ( $ret[0] )
    {
    return $ret;
    }
  }
else
  {
  return FALSE;
  }
}

//search
?>
<br><br>
<div><center>
<table width=500 cellpadding=1>
<tr>
<td class=header align=center>Search</td>
<tr><td align=center>
<form action='http://www.tvrage.com/search.php' method='GET'>
Search For: <select name='sonly'><option value='0'>Shows & People</option><option value='1'>Shows</option><option value='2'>People</option></select>
<input type='text' name='search'>
<input type='submit' value='Search!'>
</form>
</td></tr>
</tr>
</table>
</center></div>
<br><br>
<?php
//end of search

for($i = 1; $i < $showcount+1; $i++) { 
$show_infos1 = get_show("$showname[$i]","1");

//view shows
print("<table border=1 width=500 cellspacing=0 cellpadding=1 align=center>\n");
print("<tr><td class=header align=center>".$show_infos1[0]."</td>\n");
print("<tr><td class=header align=center><img src=$showimg[$i]></td></tr>\n");
print("<tr><td align=center><table border=0 width=500 cellspacing=0 cellpadding=2>\n");
print("<tr><td class=header align=center>Last Episode</td>\n");
print("<td>".$show_infos1[3]."</td></tr>\n");
print("<tr><td class=header align=center>Next Episode</td>\n");
print("<td>".$show_infos1[4]."</td></tr>\n");
print("<tr><td class=header align=center>Country</td>\n");
print("<td>".$show_infos1[7]."</td></tr>\n");
print("<tr><td class=header align=center>Status</td>\n");
print("<td>".$show_infos1[8]."</td></tr>\n");
print("<tr><td class=header align=center>Show Link</td>\n");
print("<td><a  class=altlink target=_blank href=".$show_infos1[1].">Link</a></td></tr>\n");
print("<td></tr></table>\n");
print("</tr></table><br><br>\n");
} 

//end

//start rss read
define('MAGPIE_DIR', 'magpierss/');
require_once(MAGPIE_DIR. 'rss_fetch.inc');


print("<table border=1 width=500 align=center cellspacing=0 cellpadding=3>\n");
print("<tr>\n\t<td class=header align=center width=60>Time</td>\n\t<td class=header align=center width=220>Name</td>\n\t<td class=header align=center width=220>Description</td>\n</tr>\n");

$url = 'http://www.tvrage.com/myrss.php';
if ( $url ) {
	$rss = fetch_rss( $url );
	foreach ($rss->items as $item) {
		if ($item['description']=='') $chas = $item['title'];
		$href = $item['link'];
		$title = $item['title'];
		$title = str_replace(" - ","",$title);
              $description = $item['description']; 
              if ($item['description']<>'') print("<tr>\n\t<td align=center>$chas</td>\n\t<td align=center><a target =_blank href=$href>$title</a></td>\n\t");
              if ($item['description']<>'') print("<td align=center>$description</a></td>\n</tr>\n");
	}
}

print("</table><br />\n");
//end

block_end();
stdfoot();
}
?>