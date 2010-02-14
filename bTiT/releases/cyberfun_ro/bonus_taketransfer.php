<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/

////////////////////////////////////////////
////    Bónusz pont utalás By virus ///////
//////////////////////////////////////////

require("include/functions.php");
require("include/config.php");


  dbconn();

  standardheader('Bonus Transfering');

if ($HTTP_SERVER_VARS["REQUEST_METHOD"] != "POST")
  stderr("Error", "Method");


$resuser=mysql_query("SELECT * FROM users WHERE id=".$CURUSER["uid"]);
$rowuser=mysql_fetch_array($resuser);

$username = $_POST["username"];

if (!$username)
stderr ("Error","You didn't enter a name!");

$bonuszpont = $_POST["bonuszpont"];

if ($bonuszpont < 1 || (!$CURUSER))
stderr ("Error","Not a positive value");

$mb = 1024*1024;
$gb = 1024*1024*1024;
$tb = 1024*1024*1024*1024;

if ($_POST["unit"] == 'mb') $bonuszpont = $bonuszpont*$mb;
elseif ($_POST["unit"] == 'gb') $bonuszpont = $bonuszpont*$gb;
elseif ($_POST["unit"] == 'tb') $bonuszpont = $bonuszpont*$tb;

if ($rowuser['seedbonus'] < $bonuszpont)
stderr ("Error","You can't give away sh*t when you don't have any!");

$query = mysql_query("SELECT id,seedbonus FROM users WHERE username = '$username'") or sqlerr(__FILE__, __LINE__);
$res = mysql_fetch_assoc($query);
$kapo = $res["id"];
$kuldo = $rowuser["id"];


if (!$kapo)
stderr ("Error","Woops, can't find anyone with the name $kapo");
mysql_query("UPDATE users SET seedbonus = seedbonus + $bonuszpont WHERE id = '$kapo'") or sqlerr(__FILE__, __LINE__);
mysql_query("UPDATE users SET seedbonus = seedbonus - $bonuszpont WHERE id = '$kuldo'") or sqlerr(__FILE__, __LINE__);

if ($_POST["anonym"] != 'anonym') {
///subject
$targy = sqlesc("Bonus points received");
///// message text here
$msg = sqlesc("User " . $CURUSER['username']. " left something for you: $bonuszpont bonus point.");
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES(3, $kapo, NOW(), 'Bonus points received', $msg)") or sqlerr(__FILE__, __LINE__);  }
else {
$rendszer = 3; //// Here you can write you own system/user id, default is 2
$targy = sqlesc("Bonus points received");
$msg = sqlesc("An anonymous user left this for you: $bonuszpont bonus point.");
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES($rendszer, $kapo, NOW(), 'Bonus points received', $msg)") or sqlerr(__FILE__, __LINE__);  }
//// Here you can write you own system/user id, default is 2
header("Refresh: 0; url=bonus_transfered.php");

?>