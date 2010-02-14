<?php
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
standardheader('Yours Seedwanted Torrents');


global $CURUSER, $BASEURL, $STYLEPATH;

if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    // do nothing
   }
else
    {
   block_begin("Yours uploaded seedwanted torrents:");
	   
       echo("<br>");

       ?>
       <table cellpadding="4" cellspacing="1" width="100%">
       <tr>
         <td width="65%"  colspan="2" align="center" class="header"><?php echo TORRENT_FILE; ?></td>
         <td align="center" class="header"><?php echo CATEGORY; ?></td>
         <td align="center" class="header"><?php echo ADDED; ?></td>
         <td align="center" class="header"><?php echo SIZE; ?></td>
		 <td align="center" class="header">S</td>
         <td align="center" class="header">L</td>
         <td align="center" class="header">C</td>
       </tr>
       <?php

   $sql = "SELECT summary.info_hash as hash, summary.seeds, summary.leechers, summary.finished, namemap.filename, namemap.url,  UNIX_TIMESTAMP(namemap.data) AS added, categories.image, categories.name AS cname, namemap.category AS catid, namemap.size, namemap.uploader FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash LEFT JOIN categories ON categories.id = namemap.category WHERE summary.leechers >0 AND summary.seeds = 0 AND external='no' AND uploader=$CURUSER[uid] ORDER BY summary.leechers DESC ";
    $row = mysql_query($sql) or err_msg(ERROR,CANT_DO_QUERY.mysql_error());
   
   if (mysql_num_rows($row)>0)
       {
           while ($data=mysql_fetch_array($row))
            {
		echo "<tr>\n";
        echo "\t<td  NOWRAP align=\"center\" class=\"lista\">";
        echo "<a href=download.php?id=".$data["hash"]."&f=" . rawurlencode($data["filename"]) . ".torrent><img src='images/torrent.gif' border='0' alt='".DOWNLOAD_TORRENT."' title='".DOWNLOAD_TORRENT."' /></a>"; 
		echo "</td>\n";
		echo("\n<td class=\"lista\"><a href=details.php?id=".$data["hash"].">".unesc($data["filename"])."</td>");
		echo "\t<td align=\"center\" class=\"lista\"><a href=torrents.php?category=$data[catid]>" . image_or_link( ($data["image"] == "" ? "" : "images/categories/" . $data["image"]), "", $data["cname"]) . "</td>";
		include("include/offset.php");
		echo "\t<td nowrap=\"nowrap\" class=\"lista\" align='center'>" . date("Y/m/d", $data["added"]-$offset) . "</td>";
        echo("\n<td  class=\"lista\" align=\"center\">".makesize($data["size"])."</td>");
        echo("\n<td  align=\"center\" class=\"".linkcolor($data["seeds"])."\"><a href=peers.php?id=".$data["hash"].">".$data["seeds"]."</td>");
        echo("\n<td  align=\"center\" class=\"".linkcolor($data["leechers"])."\"><a href=peers.php?id=".$data["hash"].">".$data["leechers"]."</td>");
        echo("\n<td  align=\"center\" class=\"lista\"><a href=torrent_history.php?id=".$data["hash"].">".$data["finished"]."</td>\n</tr>");
        
  }
  }
      else
       {
       echo "<tr><td class=\"lista\" colspan=8 align=center>" . NO_TORRENTS . "</td></tr>";
       }
      echo("\n</table>");
  
block_end(); 

	   
    
	
	
block_begin("Yours downloaded seedwanted torrents:");
 echo("<br>");
?>
  <table cellpadding="4" cellspacing="1" width="100%">
       <tr>
         <td width="65%" colspan="2" align="center" class="header"><?php echo TORRENT_FILE; ?></td>
         <td align="center" class="header"><?php echo CATEGORY; ?></td>
         <td align="center" class="header"><?php echo ADDED; ?></td>
         <td align="center" class="header"><?php echo SIZE; ?></td>
		 <td align="center" class="header">S</td>
         <td align="center" class="header">L</td>
         <td align="center" class="header">C</td>
       </tr>
<?php



    $sql = "SELECT namemap.filename, namemap.size, namemap.info_hash, UNIX_TIMESTAMP(namemap.data) AS added, history.active, summary.seeds, summary.leechers, summary.finished, categories.image, categories.name AS cname, namemap.category AS catid FROM history INNER JOIN namemap ON history.infohash=namemap.info_hash INNER JOIN summary ON summary.info_hash=namemap.info_hash INNER JOIN categories ON categories.id = namemap.category WHERE history.uid=$CURUSER[uid] AND history.date IS NOT NULL AND summary.leechers > 0 AND summary.seeds = 0 ";
	$row = mysql_query($sql) or err_msg(ERROR,CANT_DO_QUERY.mysql_error());
	
	if (mysql_num_rows($row)>0)
	{
    while ($data = mysql_fetch_array($row))
        {
		echo "<tr>\n";
        echo "\t<td  NOWRAP align=\"center\" class=\"lista\">";
        echo "<a href=download.php?id=".$data["info_hash"]."&f=" . rawurlencode($data["filename"]) . ".torrent><img src='images/torrent.gif' border='0' alt='".DOWNLOAD_TORRENT."' title='".DOWNLOAD_TORRENT."' /></a>"; 
		echo "</td>\n";
		echo("\n<td class=\"lista\"><a href=details.php?id=".$data["info_hash"].">".unesc($data["filename"])."</td>");
		echo "\t<td align=\"center\" class=\"lista\"><a href=torrents.php?category=$data[catid]>" . image_or_link( ($data["image"] == "" ? "" : "images/categories/" . $data["image"]), "", $data["cname"]) . "</td>";
		include("include/offset.php");
		echo "\t<td nowrap=\"nowrap\" class=\"lista\" align='center'>" . date("Y/m/d", $data["added"]-$offset) . "</td>";
        echo("\n<td  class=\"lista\" align=\"center\">".makesize($data["size"])."</td>");
        echo("\n<td  align=\"center\" class=\"".linkcolor($data["seeds"])."\"><a href=peers.php?id=".$data["info_hash"].">".$data["seeds"]."</td>");
        echo("\n<td  align=\"center\" class=\"".linkcolor($data["leechers"])."\"><a href=peers.php?id=".$data["info_hash"].">".$data["leechers"]."</td>");
        echo("\n<td  align=\"center\" class=\"lista\"><a href=torrent_history.php?id=".$data["info_hash"].">".$data["finished"]."</td>\n</tr>");
        
  }
  
      }
       else
       {
       echo "<tr><td class=\"lista\" colspan=8 align=center>" . NO_TORRENTS . "</td></tr>";
       }
      echo("\n</table>");
  
block_end(); 

echo("<br /><br /><center><a href=\"javascript: history.go(-1);\">".BACK."</a></center><br />\n");

} // end if user can view

stdfoot();
?>