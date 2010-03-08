<?php
// SeedBonus Mod by CobraCRK   -   original ideea by TvRecall...
//cobracrk@yahoo.com
//www.extremeshare.org
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

$id=$_GET['id'];

if($id=="down"){

$uid=$CURUSER["uid"];
$d=mysql_query("SELECT downloaded FROM users WHERE id=$uid");
$r=mysql_query("SELECT seedbonus FROM users WHERE id=$uid");
$v=mysql_result($d,0,"downloaded");
$u=mysql_result($r,0,"seedbonus");
if($u<180 || $v<10737000000)
{
standardheader('ERROR');
  err_msg(ERROR,"You don't have enough points or downloaded");
       stdfoot();
       exit;
}else {
@mysql_query("UPDATE users SET downloaded=downloaded-10737000000,seedbonus=seedbonus-180 WHERE id=$uid");
header("Location: seedbonus.php");
}

die(" ");
}

if($id=="invite"){

$uid=$CURUSER["uid"];
$r=mysql_query("SELECT seedbonus FROM users WHERE id=$uid");
$u=mysql_result($r,0,"seedbonus");
if($u<150) {
standardheader('ERROR');
  err_msg(ERROR,"You don't have enough points");
       stdfoot();
       exit;
}else {
@mysql_query("UPDATE users SET invites=invites+1,seedbonus=seedbonus-150 WHERE id=$uid");
header("Location: seedbonus.php");
}

die(" ");
}
if(is_null($id)||!is_numeric($id)||$CURUSER["view_torrents"]=="no"){
standardheader('Not allowed');
  err_msg(ERROR,"What tha hell do you want?");
       stdfoot();
       exit;
}
$r=mysql_query("SELECT * FROM bonus WHERE id='$id'");
$p=mysql_result($r,0,"points");
$t=mysql_result($r,0,"traffic");

$uid=$CURUSER["uid"];
$r=mysql_query("SELECT seedbonus FROM users WHERE id=$uid");
$u=mysql_result($r,0,"seedbonus");
if($u<$p) {
standardheader('ERROR');
  err_msg(ERROR,"You don't have enough points");
       stdfoot();
       exit;
}else {
@mysql_query("UPDATE users SET uploaded=uploaded+$t,seedbonus=seedbonus-$p WHERE id=$uid");
header("Location: seedbonus.php");
}