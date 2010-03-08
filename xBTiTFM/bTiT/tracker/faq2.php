<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader("FAQ");

    block_begin(FAQ);
	?>
<il align="left" width="90%">
<table border=0 width=95% align=center><tr><td align=left width=90%>
<ol>
<br><br>

	<li><a href=#1>How does BitTorrent work?</a>
	</li><li><a href=#2>Required software (recommended BitTorrent clients)</a>
	</li><li><a href=#3>Help! My download is stuck at 99%!</a>
	</li><li><a href=#4>About firewalls and routers</a>
	</li><li><a href=#5>What kind of stuff can I upload?</a>
	</li><li><a href=#6>Why did a torrent suddenly disappear?</a>
	</li><li><a href=#7>The page freezes when I try to upload an external torrent</a>
	</li><li><a href=#8>I did not recieve my validation mail what now?</a>
	</li><li><a href=#9>Error: Invalid Client Port, please read the FAQ</a> 
	</li><li><a href=#10>What if my question isnt answered here?</a>
	</li></ol>
<br>
<br>

<li id=1><b>How does BitTorrent work?</b><br>
	The .torrent files are basically text files with general information about the shared file (size, name, etc) inside of them.<br>
The server saves this information about the shared files. Then, a user
downloads the torrent and opens it with a client. The client gets the
server address from inside the torrent, connects to it and asks who it
should connect to get the file. The server responds with a list of 50
random ips from the peer list (or less, depending in how many clients
are connected). This process gets repeated several times, every few
minutes, until the client disconnects.<br>
And because of the way BitTorrent works, the faster you upload, the faster you download.<br>
<br>
For a more in depth technical explanation of this process, please visit <a href=http://bitconjurer.org/BitTorrent/documentation.html target=_blank>the Official BitTorrent site</a>.<br><br>

	</li><li id=2><b>Required software (recommended BitTorrent clients)</b><br>
	To download the files, you need a BitTorrent client.<br>
	Here is a little list of some of them.<br>
	<ul>
  <li><a href=http://bitconjurer.org/BitTorrent/download.html target=_blank>The Original BitTorrent Client</a>, by Bram Cohen<br>
    </li><li><a href=http://bittornado.com/ target=_blank>TheShad0w's Experimental BitTorrent Client</a><br>
    </li><li><a href=http://pingpong-abc.sourceforge.net/ target=_blank>ABC [Yet Another Bittorrent Client]</a>, by Choopan Rattanapoka and Dustin Pate<br>
    </li><li><a href=http://www.bitlord.com/ target=_blank>Bitlord BitTorrent Client</a><br>
    </li><li><a href=http://azureus.sourceforge.net/ target=_blank>Azureus BitTorrent Client</a><br>
	</li></ul><br>
	Or you could use <a href=http://google.com/ target=_blank>Google</a> to find one that suits you.<br>Just stay away from BitTorrent++,
	TorrentStorm, Nova Torrent and BitComet. They don't follow the BT protocol correctly.
<br><br>

	</li><li id=3><b>Help! My download is stuck at 99%!</b><br>
The more pieces you have, the harder it becomes to find people who have
the pieces you need. That's why downloads sometimes slow down or even
stop completely. Just be patient and you will get the remaining pieces.
<br><br>
	</li><li id=4><b>About firewalls and routers</b><br> To
be able to download and upload using BitTorrent properly, you need to
open the TCP ports 6881 to 6999 to be able to connect to the swarm, and
port 6666 and 90 (both tcp) to be able to connect to the tracker. For
information on how to do this, please consult your firewall/router
maker's site. <br><br>
	</li><li id=5><b>What kind of stuff can I upload?</b><br>
	<ul>
  <li>No spam (make quick money/ online poker/ pyramid schemes, etc, etc.)
  </li><li>No racist or religous stuff.
  </li><li>No passworded archives (unless the password iis included in the comments)
  </li><li>No trojans, virii, or hacking related stuff.
  </li><li>No bad stuffs.
  </li><li>No unamed or unknown hacks/cracks/programs
	</li></ul><br><br>
	</li><li id=6><b>Why did a torrent suddenly disappear?</b><br>
	The main reasons for this are:
	<ol>
  <li>The torrent may have been out-of-sync with the site rules.
  </li><li>The torrent was not seeded. Torrents expire after 5 days without a seed.
  </li><li>The tracker used was offline for a sustained ammount of time.
  </li><li>A torrent of the same item was still active.</li></ol>
	
	<br><br>
	</li><li id=7><b>The page freezes when I try to upload an external torrent</b><br>
This will happen when this site tried to contact the tracker being used for the torrent and it cannot do so, eventually it will timeout and the torrent will have been uploaded successfully, however it will appear dead. The torrent will be automatically checked at a later time and if the tracker is alive will be updated else it will eventually be deleted.
	<br><br>
	</li><li id=8><b>I did not recieve my validation mail what now?</b><br>
If you did not recieve your validation mail this is most likely caused by your email provider labeling the mail from this site as spam and blocking it. Check your spam folder to be sure it is not there or alternativly contact the site admin by posting in the forum help section so he can check into it.
	<br><br>
    </li><li id=9><b>Error: Invalid Client Port, please read the FAQ</b><br>
Many ISP's monitor, throttle or even block certain ports.
This is thier attempt to prevent the use of P2P Software
In an attempt to prevent people complaining that they cannot
connect on a certain port this tracker blocks all default
P2P software ports.
If you are recieving this error then please change your
download port in your torrent client.
You will then be able to download as normal.
<br><br>
Blocked ports are as follows:
<br><br>
  </li><li>Direct Connect   411 - 413
  </li><li>Kazaa            1214
  </li><li>eDonkey          4662
  </li><li>Gnutella         6346 - 6347
  </li><li>BitTorrent       6881 - 6889
	</li></ul><br><br>
	</li><li id=10><b>What if my question isnt answered here?</b><br>
If you cant find the answer to your question in this short FAQ dont
worry, these are some other sites where you might find what you are looking for.<br>
<br>
<a href='http://btfaq.com/' target='_blank'>http://btfaq.com/</a><br />
<a href='http://wiki.etree.org/index.php?page=BitTorrent' target='_blank'>http://wiki.etree.org/index.php?page=BitTorrent</a><br />
<a href='http://www.dessent.net/btfaq/' target='_blank'>http://www.dessent.net/btfaq/</a><br />
<a href='http://www.bthq.tk/' target='_blank'>http://www.bthq.tk/</a><br />
<br />
Or if all else fails you can ask a question at our <a href='http://larktorrent.dyndns.org/forum' target='_self'>Forums</a></div>
<br>
<br>
</li></ol></td></table>
<?php
    block_end();

stdfoot();

?>