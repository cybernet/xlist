<?php
//Uploader Request by CobraCRK
//made for Btitracker
//www.extremeshare.org, cobracrk@yahoo.org
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

standardheader('Uploader Request');

if ($CURUSER["view_torrents"]=="no")
   {
       err_msg(ERROR,NOT_AUTH_VIEW_NEWS);
       stdfoot();
       exit;
}
else
    {

$intern=$_POST['intern'];
$extern=$_POST['extern'];
$intentioneaza=$_POST['intentioneaza'];
$sursa=$_POST['sursa'];
$altsite=$_POST['altsite'];
$facetorrent=$_POST['facetorrent'];
$facerar=$_POST['facerar'];
$facesfv=$_POST['facesfv'];
$facenfo=$_POST['facenfo'];
$motiv=$_POST['motiv'];
$stisite=$_POST['stisite'];
$regulament=$_POST['regulament'];
$oday=$_POST['oday'];
if(isset($intern) && isset($extern) && isset($intentioneaza) && isset($sursa) && isset($altsite) && isset($facetorrent) && isset($facerar) && isset($facesfv) && isset($facenfo) && isset($motiv) && isset($stisite) && isset($regulament)) {


$user=$CURUSER["username"];
$up=$CURUSER["uploaded"];
$down=$CURUSER["downloaded"];
$msg="[color=red]Name:[/color] $user\n

[color=red]Connection[/color] - internal=$intern extern=$extern\n
[color=red]Upload:[/color] $intentioneaza\n
[color=red]Source:[/color] $sursa\n
[color=red]Uploader on other site:[/color] $altsite\n
[color=red]Make torrents:[/color] $facetorrent\n
[color=red]Make SFV:[/color] $facesfv\n
[color=red]Make NFO:[/color] $facenfo\n
[color=red]Motivation for upload:[/color] $motiv\n
[color=red]Stie de site de la:[/color] $stisite\n
[color=red]Rules:[/color] $regulament\n
[color=red]1 torrent per day/1 0day per week:[/color] $oday\n";
//echo $msg;
$xx=$CURUSER["uid"];
$ms=sqlesc($msg);
$r=mysql_query("SELECT * FROM users WHERE id_level=7 OR id_level=8");
while($x = mysql_fetch_array($r)){ 
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES ($xx,$x[id],UNIX_TIMESTAMP(),'New Uploader Request - $user',$ms)") or die(mysql_error());
}

block_begin("Uploader Request");
?>
<style type="text/css">
<!--
.style3 {
	font-size: 24px;
	font-weight: bold;
}
.style4 {font-size: 24px}
-->
</style>


<p align="center" class="style4"><strong>Application Sended</strong></p>
<p align="center" class="style4"><strong>The staff will review your application!</strong></p>
<p align="center"><span class="style3">After that, you shall get a response! 
  </span>
  <?php
block_end();


}else {
       err_msg("You must fill all the fields");
       stdfoot();
       exit;

}
}
stdfoot();
//Uploader Request by CobraCRK
//made for Btitracker
//www.extremeshare.org, cobracrk@yahoo.org
?>
  </p>
</p>