<?php

require_once ("include/functions.php");
require_once ("include/config.php");
require_once("include/blocks.php");


dbconn();
standardheader(MNU_LINKS);
if(!$CURUSER || $CURUSER["view_users"]!="yes")
{
    err_msg(ERROR.NOT_AUTHORIZED." ".MNU_LINKS."!",SORRY."...");
    stdfoot();
    exit();
}


    block_begin("");

?>
<tr><td class=lista align=center>
<table width=100% class=lista border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist>
<h1 align=center>&nbsp;<a href=staff.php?receiver=2>Please report dead links!</a></h1>
</td></tr></table>
<tr><td class=lista align=center>
<h2 align=center>&nbsp;</h2>
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist style="text-align:left;"><ul>
<b>How can I stay up-to-date with <?=$SITENAME?>?</b>
<br>
<br>
<li><a class=altlink href=rss_torrents.php>RSS feed (direct download)</a> - Links directly to the torrent file.</li>
<br>
<li>Users with other browsers will have to download a <b>RSS</b> reader. You can find a list <a href=http://blogspace.com/rss/readers target=_blank>here.</a> The feed URL is <?=$BASEURL?>/rss.php</li></ul>
</td></tr></table>

<h2 align=center>BitTorrent Information</h2>
<tr><td class=lista align=center>
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist style="text-align:left;"><ul>
<li><a href=http://dessent.net/btfaq/ target=_blank>Brian's BitTorrent FAQ and Guide</a> -
  Everything you need to know about BitTorrent. Required reading for all n00bs.</font>
<li><a href=http://10mbit.com/faq/bt/ target=_blank>The Ultimate BitTorrent FAQ</a> -
  Another nice BitTorrent FAQ, by Evil Timmy.
</ul></td></tr></table>

<h2 align=center>BitTorrent Software</h2>
<tr><td class=lista align=center>
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist style="text-align:left;"><ul>
<li><a href=http://pingpong-abc.sourceforge.net/ target=_blank>ABC</a> -
  "ABC is an improved client for the Bittorrent peer-to-peer file distribution solution."</li>
<li><a href=http://azureus.sourceforge.net/ target=_blank>Azureus</a> -  "Azureus is a java bittorrent client. It provides a quite full bittorrent protocol implementation using java language."</li>
<li><a href=http://bittornado.com/ target=_blank>BitTornado</a> -
  a.k.a "TheSHAD0W's Experimental BitTorrent Client".</li>
<li><a href=http://www.bitconjurer.org/BitTorrent target=_blank>BitTorrent</a> -
  Bram Cohen's official BitTorrent client.</li>
<li><a class=altlink href=http://localhost/Maketorrent2.1.zip>MakeTorrent2.1</a> -
  A tool for creating torrents.</li>
<li><a href=http://ptc.sourceforge.net/ target=_blank>Personal Torrent Collector</a> -
  BitTorrent client.</li>
<li><a href=http://www.torrentflux.com/ target=_blank>TorrentFlux</a> -
  PHP BitTorrent Client.</li>
</ul></td></tr></table>

<h2 align=center>Forum communities & Information Sites</h2>
<tr><td class=lista align=center>
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist style="text-align:left;"><ul>
<li><a href=http://www.panhteraonline.com target=_blank>Panthera Online - Community</a></li>
<li><a href=http://www.pantherabits.com target=_blank>PantheraBits - Torrent Site</a></li>
<li><a href=http://www.btiteam.org/forum/index.php target=_blank>BTIT Forum - Support For This Tracker.</a></li>
<li><a href=http://www.filesoup.com/ target=_blank>FileSoup -
  BitTorrent community.</a></li>
<li><a class=altlink href=http://www.litezone.com/>Link2U -
  BitTorrent link site.</a></li>
<li><a href=http://www.nforce.nl/ target=_blank>NFOrce -
  Game and movie release tracker / forums.</a></li>
<li><a href=http://uploadit.org/ target=_blank>Upload-It - If you need a place to host your avatar or other pictures.</a></li>
<li><a href=http://thebeehive.info/ target=_blank>The Beehive Tracker List -
  BitTorrent link site.</a></li>
<li><a href=http://www.izonews.com/ target=_blank>iSONEWS -
  Release tracker and forums.</a></li>
</ul></td></tr></table>

<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.thumbnail img{
position: relative;
z-index: 0;
}

.thumbnail:hover img{
background-color: transparent;
z-index: 50;
}

.thumb{
position: relative;
z-index: 0;
}
.thumb:hover{
background-color: transparent;
z-index: 50;
}

a.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: white;
padding: 5px;
left: -1000px;
border: 1px dashed gray;
visibility: hidden;
color: black;
text-decoration: none;
}

a.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
}

a.thumbnail:hover span img{ /*CSS for enlarged image on hover*/
visibility: visible;
top: 0;
left: 60px; /*position where enlarged image should offset horizontally */

}

</style>
<tr><td class=lista align=center>
<table width=100% border=0 cellspacing=5 cellpadding=5>
<tr><td class=blocklist>
<h2 align=center>Links edited 2005-02-07</h2>
</td></tr></table>
<?php 
block_end();



stdfoot();
die();
?>