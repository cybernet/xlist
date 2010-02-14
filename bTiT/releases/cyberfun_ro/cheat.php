<?php

require_once("include/functions.php");


dbconn();

standardheader("Possible Cheaters");

if (!$CURUSER || $CURUSER["admin_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

block_begin("Possible Cheaters");

print("<table class=lista align=center width=100%>");
print("<tr>");
print("<td class=header>Username</td>");
//print("<td class=header>Uploaded</td>");
//print("<td class=header>Downloaded</td>");
//print("<td class=header>Ratio</td>");
print("<td class=header>Torrent</td>");
print("<td class=header>Size</td>");
print("<td class=header>Total Uploaded</td>");
print("<td class=header>Total Downloaded</td>");
print("<td class=header>Completed</td>");
print("<td class=header>User Uploaded</td>");
print("<td class=header>User Downloaded</td>");
print("</tr>");

$test = "SELECT users.username, users.id, users.uploaded, users.downloaded, namemap.filename, namemap.size, summary.finished, history.infohash, history.uploaded AS huploaded, history.downloaded AS hdownloaded
         FROM history
         LEFT JOIN namemap ON history.infohash=namemap.info_hash
         LEFT JOIN summary ON history.infohash=summary.info_hash
         LEFT JOIN users ON history.uid=users.id
         WHERE history.uploaded > (namemap.size * summary.finished) AND summary.finished > 0
         ORDER BY username ASC";

$qry  = mysql_query($test) or die(mysql_error());

while($res  = mysql_fetch_array($qry)){
    $histup = 0;
    $histdown = 0;
    $histtest = "SELECT uploaded, downloaded FROM history WHERE infohash = '" . $res['infohash'] . "'";
    $histqry  = mysql_query($histtest) or die(mysql_error());
    while ($histres = mysql_fetch_array($histqry)){
        $histup = $histup + $histres['uploaded'];
        $histdown = $histdown + $histres['downloaded'];
    }
    print("<tr>");
    print("<td><a href=userdetails.php?id=" . $res['id'] . ">" . $res['username'] . "</a></td>");
//    print("<td>" . makesize($res['uploaded']) . "</td>");
//    print("<td>" . makesize($res['downloaded']) . "</td>");
//    print("<td>" . ($res['downloaded']>0?number_format($res['uploaded']/$res['downloaded'],2):"---") . "</td>");
    print("<td><a href=details.php?id=" . $res['infohash'] . ">" . $res['filename'] . "</a></td>");
    print("<td>" . makesize($res['size']) . "</td>");
    print("<td>" . makesize($histup) . "</td>");
    print("<td>" . makesize($histdown) . "</td>");
    print("<td><a href=torrent_history.php?id=" . $res['infohash'] . ">" . $res['finished'] . "</a></td>");
    print("<td>" . makesize($res['huploaded']) . "</td>");
    print("<td>" . makesize($res['hdownloaded']) . "</td>");
    print("</tr>");
}

print("</table>");
block_end();
stdfoot();
?>