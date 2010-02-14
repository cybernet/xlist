<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn(true);
include './lastRSS.php';

// create lastRSS object
$rss = new lastRSS;

// setup transparent cache
$rss->cache_dir = './newscache';
$rss->cache_time = 3600; // one hour

standardheader('NFOrce');
block_begin("NFOrce Information");
global $CURUSER, $STYLEPATH;
?>
<table align="center" class=lista width=100%>
<tr><td class="lista" align="center">This section announces the latest releases on <b><a href="http://safeurl.de/http://www.nforce.nl">nforce.nl</a></b></td></tr>
</table>
<table align="center" class=lista width=78%>
<table width=100% border="1" cellspacing="0" cellpadding="10" class="lista"><tr><td align=center>
<table cellspacing="0" cellpadding="5" border="0" class=main border=1>

<!-- Begin PC-CDROM games list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<!-- Begin Latest Game ISO Releases Header -->
<tr>
<td class="header"><strong><center>Latest Game ISO Releases</center></strong></td>
</tr>
<!-- End Latest Game ISO Releases Header -->
<tr>
<td><strong><center>PC Game ISO Releases</center></strong></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_2.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End PC-CDROM games list -->

<!-- Begin PlayStation2 games list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<tr>
<td><center><strong>PlayStation 2 Releases</strong></center></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_9.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End PlayStation2 games list -->

<!-- Begin Xbox games list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<tr>
<td><center><strong>Xbox Releases</strong></center></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_11.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End Xbox games list -->

<tr>
<td>
</td>
</tr>

<!-- Begin DVD-R movies list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<!-- Begin Latest Movie Releases Header -->
<tr>
<td class="header"><strong><center>Latest Movie Releases</center></strong></td>
</tr>
<!-- End Latest Game ISO Releases Header -->
<tr>
<td><strong><center>Latest DVD-R Releases</center></strong></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_18.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End DVD-R movies list -->

<!-- Begin SVCD movies list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<tr>
<td><center><strong>Latest SVCD Releases</strong></center></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_15.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End SVCD movies list -->

<!-- Begin TV-Rip movies list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<tr>
<td><center><strong>Latest TV-Rip Releases</strong></center></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_19.xml')) {
foreach($rs['items'] as $item) {
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End TV-Rip movies list -->

<!-- Begin XXX movies list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<tr>
<td><center><strong>Latest XXX Releases</strong></center></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
$max = 0;
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_17.xml')) {
foreach($rs['items'] as $item) {
if ($max >= 10) { break; }
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
$max++;
}
}
else {
print ('Error: NForce not reachable...');
}
?></center>
<br>
</td>
</tr>
<!-- End XXX movies list -->

<tr>
<td>
</td>
</tr>

<!-- Begin PC Software list -->
<tr>
<td valign="top" class="lista">
<table cellspacing="0" cellpadding="0" border="1" width="100%">
<!-- Begin Latest Movie Releases Header -->
<tr>
<td class="header"><strong><center>Latest PC Software ISO Releases</center></strong></td>
</tr>
<!-- End Latest Game ISO Releases Header -->
<tr>
<td><center><strong>PC Software Releases</center></strong></td>
</tr>
</table>
<br>
<font size="1"><center>
<?
$max = 0;
if ($rs = $rss->get('http://www.nforce.nl/rss/rss_6.xml')) {
foreach($rs['items'] as $item) {
if ($max >= 10) { break; }
echo "<a href=\"$item[link]\">".$item['title']."</a><br>\n";
$max++;
}
}
else {
print ('Error: NForce not reachable...');
}
//End PC Software list


print("</center>");
print("<br>");
print("</td></tr></table></table>\n</div>\n");
block_end();
print("<br>");
stdfoot(false);
?>