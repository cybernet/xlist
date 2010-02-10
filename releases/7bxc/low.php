<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////
require_once ("include/functions.php");
dbconn(false);

if ($CURUSER["id_level"] < "2")
show_error_msg("Error","Sorry you do not have the rights to access this page!",1);
if ($XBTT_USE)
   {
    $udownloaded="u.downloaded+IFNULL(x.downloaded,0)";
    $uuploaded="u.uploaded+IFNULL(x.uploaded,0)";
    $utables="{$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id";
   }
else
    {
    $udownloaded="u.downloaded";
    $uuploaded="u.uploaded";
    $utables="{$TABLE_PREFIX}users u";
}

$resuser=do_sqlquery("SELECT $udownloaded as downloaded,$uuploaded as uploaded FROM $utables WHERE u.id=".$CURUSER["uid"]);
$rowuser= mysql_fetch_array($resuser);
// get user's style
$resheet=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}style where id=".$CURUSER["style"]."");
if (!$resheet)
   {

   $STYLEPATH="$THIS_BASEPATH/style/xbtit_default";
   $STYLEURL="$BASEURL/style/xbtit_default";
}
else
    {
        $resstyle=mysql_fetch_array($resheet);
        $STYLEPATH="$THIS_BASEPATH/".$resstyle["style_url"];
        $STYLEURL="$BASEURL/".$resstyle["style_url"];
}

$style_css=load_css("main.css");

?>

<html>
 <head>
 <link rel="stylesheet" type="text/css" href="<?=$STYLEURL?>/main.css" /> 
 </head>
 
 <body class=\"slots\">
<?php 
 //retrive post information
 $money = makesize($rowuser[uploaded]);
if ($money> 0){
 $level = $_POST['level'];
 $prevhighlow = $_POST['prevhighlow'];
 $smallwinhigh = 5*1024*1024;
 $mediumwinhigh = 10*1024*1024;
 $largewinhigh  = 25*1024*1024;
 $superlargewinhigh = 50*1024*1024;
 $jackpot = 100*1024*1024;

 //gen high low num
 $highlownum = rand(1,9);

 //set the high low level
 $nextlevel = $level+1;

 if ($level == 1){
  $highlowmoney = $smallwinhigh;
  mysql_query("UPDATE users SET uploaded = uploaded + $smallwinhigh WHERE id=$CURUSER[id]");
}
   if ($level == 2){
   $highlowmoney = $mediumwinhigh;
   mysql_query("UPDATE users SET uploaded = uploaded + $mediumwinhigh WHERE id=$CURUSER[id]");
}
    elseif ($level == 3){
    $highlowmoney = $largewinhigh;
    mysql_query("UPDATE users SET uploaded = uploaded + $largewinhigh WHERE id=$CURUSER[id]");
}
     if ($level == 4){
     $highlowmoney = $superlargewinhigh;
     mysql_query("UPDATE users SET uploaded = uploaded + $superlargewinhigh WHERE id=$CURUSER[id]");
}
      if ($level == 5){
      $highlowmoney = $jackpot;
      mysql_query("UPDATE users SET uploaded = uploaded + $jackpot WHERE id=$CURUSER[id]");
}
 
  //calculate total amount of mopney user gets if they click stop
  $newmoney = $money+$highlowmoney;

?>
  <table style="width: 379; height: 436; border: none; background-image: url(images/slots/justbg.gif);">
   <tr style="height: 90;">
    <td>
<!--virtual slots logo-->
     
    </td>
    <td colspan="2">
<!--Bank-->
     <p style="margin-left: 95px; font-weight: bold;"><?php echo "&nbsp;&nbsp;$money"; ?></p>
    </td>
   </tr>
   <tr style="height: 100;">
    <td width="87">
<!--high low function-->
<?php
 if($highlownum <= $prevhighlow && $level <= 4)
  echo "<form method=\"post\" action=\"high.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"$nextlevel\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 69; height: 32; border:0px; background:#513DFE; margin-left: 30;\"><img src=\"images/slots/highlive.gif\" style=\"width: 69; height: 32; border:0px;\"></button></form>";
  else
  echo "<img src=\"images/slots/high.gif\" style=\"margin-left: 30; margin-top: 10;\"><br>";
?>
<?php
 if($highlownum <= $prevhighlow)
  echo "<form method=\"post\" action=\"play.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"$nextlevel\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$newmoney\"><button type=\"submit\" style=\"width: 69; height: 32; border:0px; background:#513DFE; margin-left: 30;\"><img src=\"images/slots/stoplive.gif\" style=\"width: 69; height: 32; border:0px;\"></button></form>";
  else echo "<img src=\"images/slots/stop.gif\" style=\"margin-left: 28;\"><br>";
?>     
<?php
 if($highlownum <= $prevhighlow && $level <= 4)
  echo "<form method=\"post\" action=\"low.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"$nextlevel\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 69; height: 32; border:0px; background:#513DFE; margin-left: 30;\"><img src=\"images/slots/lowlive.gif\"></button></form>";
  else
  echo "<img src=\"images/slots/low.gif\" style=\"margin-left: 30;\"><br>";
?>
    </td>
    <td>
<!--high low number-->
     &nbsp;<img src="images/slots/<?php echo "$highlownum"; ?>.gif" style="margin-top: 10;">
    </td>
    <td>
     
    </td>
   </tr>
   <tr align="center" height="111">
<!--fruit pics-->
    <td width="143">
     <img src="images/slots/wheel3.gif" style="margin-left: 15;">
    </td>
    <td>
     <img src="images/slots/wheel3.gif">
    </td>
    <td width="143">
     <img src="images/slots/wheel3.gif" style="margin-right: 15;">
    </td>
   </tr>
   <tr>
    <td colspan="3">
<!--marquee-->
     <marquee style="margin-left: 30; margin-right: 30; color: 000000; font-weight: bold;"><p style="margin-top: 2;">Click high or low to continue with the high low game or click stop to add current high low winnings to the bank and return to normal slots</p></marquee>
    </td>
   </tr>
   <tr>
    <td colspan="2" align="right">
<!--main buttons-->
    
    </td>
    <td>
<?php
 if ($highlownum > $prevhighlow)
  echo "<form method=\"post\" action=\"play.php\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 96; height: 41; border:0px; background:#0BE6F7;\"><img src=\"images/slots/playlive.gif\" style=\"width: 96; height: 41;\"></button></form>";
  else
  echo "<img src=\"images/slots/play.gif\">";
}
else{
       print("<body bgcolor=#000000 text=white link=red alink=yellow vlink=orangered><center><br><br><img src=images/slots/gameover.gif><br><br><a href=index.php?page=slots target=_top><u>Click here</a></h2></body>");
       }
?>

    </td>
   </tr>
  </table>
 </body>
</html>
