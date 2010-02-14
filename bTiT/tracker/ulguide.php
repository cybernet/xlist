<?php

require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/blocks.php");

dbconn();
standardheader("Uploaders Guide");

block_begin(UPLOADERS_GUIDE);
?>
<table class=lista width=100% border=1 cellspacing=0 cellpadding=10><tr>
<td align=left>
<p>This is a guide explaining how to upload torrents using the BitTorrent client Azureus.</p>
<ol>
<li>Download <b>Azureus</b> from here: '<a href=http://azureus.sourceforge.net/ target=_blank><img src="images/azureus.png" border=0/></a>'.</li>
<li>Go to the preferences (Azureus->Preferences).</li>
<li>In the "Server" page change the "Incoming TCP listen port" to a non Peer-to-Peer port (6879 will work).</li>
If you have a firewall make sure this port range is open in both directions.
<li>Time to create a torrent to upload (File->Create a Torrent).</li>
<li>In the "Announce URL" put "<b><?= $BASEURL ?></b>/announce.php" then click "Next".</li>
<li>Click the "Browse" button and find the file you want to share then click "Next".</li>
<li>Check to see if the right file is selected and click "Finish".</li>
<li>Voila, the torrent will be created where the file is.</li>
<li>Login to the site '<b><?= $SITENAME ?></b>' and go to the "Upload" section.</li>
<li>In the "Torrent file" area click the "Browse" button and find the torrent file then click "Open".</li>
<li>In the "Torrent name" area type the name of the file if the name on the torrent is not descriptive.</li>
<li>In the "Description" area type a thorough description of the file. Make sure the description is complete and includes all relevant information. DO NOT POST SERIALS/CRACKS. </li>
<li>In the "Type" area choose the type of file by clicking on the pull down menu. Make sure the file is under the correct type.</li>
<li>Check over the following steps and if everything is correct click the "Do it!" button.</li>
<li>Time to seed the torrent: download the torrent off the site, click "Open"(File->Open->.torrent File), and find the downloaded torrent. You will not be able to seed the torrent created by the client because of the PID that needs to be embedded in the torrent.</li>
</ol>
<p>It will take a couple minutes for your torrent to appear in the "Torrents" section. If you have any trouble following these instructions be sure to check the "FAQ" section for additional tips with different clients and so forth! If you still can not seem to upload torrents ask in the forum.</p>
</td></tr></table>
<object width="560" height="340"><param name="movie" value="http://www.youtube.com/v/YrUfu8C27jE&hl=en&fs=1&rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/YrUfu8C27jE&hl=en&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="560" height="340"></embed></object>
<h2 align=center>Rules</h2>
<table class=lista width=100% border=1 cellspacing=0 cellpadding=10><tr>
<td align=left>
<p>Torrents violating these rules may be deleted without notice.</p>
<br>
Read the whole/full rules page by clicking <a href="rules.php">here</a>!
<ol>
<li>You must have legal rights to the file you are uploading.</li>
<li>All uploads must include a detailed description.</li>
<li><font color=#C30000>NO NASTY FILES!!!</font></li>
<li>All files must be in a legitiment format so they are functional.</li>
<li>Pre-release stuff should be labeled with an *ALPHA* or *BETA* tag.</li>
<li>Make sure not to include any serial numbers, CD keys or similar in the description (you do <b>not</b> need to edit the NFO!)..
<li>Make sure your torrents are well-seeded for at least 24 hours.</li>
<li>Do not include the release date in the torrent name.</li>
</ol>
<p>If you have something interesting that somehow violate these rules, ask a mod and we might make an exception.</p>
</td></tr></table>
<? 

print("</div><br /><br /><center><a href=\"javascript: history.go(-1);\">".BACK."</a>");
print("</center>\n");
block_end();
  stdfoot();
?>
