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

 //game code
  //retrieve infomation
  $money = makesize($rowuser[uploaded]);
if ($money> 0){
  //Calculate credits left
  $credits = $money/10;
  $smallwin = 1*1024*1024;
  $mediumwin = 5*1024*1024;
  $largewin  = 15*1024*1024;
  $lostmb = 10*1024*1024;

  //gen high low num
  $highlownum = rand(1,9);

  //gen wheel num
  $wheel1 = rand(1,3);
  $wheel2 = rand(1,3);
  $wheel3 = rand(1,3);

  //Set money information to pass on
  if ($wheel1 == 1 && $wheel2 == 1 && $wheel3 == 1){
   $playmoney = $money+$smallwin;
   mysql_query("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + $smallwin WHERE id=$CURUSER[uid]");
}

   if ($wheel1 == 2 && $wheel2 == 2 && $wheel3 == 2){
   $playmoney = $money+$mediumwin;
   mysql_query("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + $mediumwin WHERE id=$CURUSER[uid]");
}

   if ($wheel1 == 3 && $wheel2 == 3 && $wheel3 == 3){
   $playmoney = $money+$largewin;
   mysql_query("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded + $largewin WHERE id=$CURUSER[uid]");
}
   if (($wheel1 != 1 && $wheel2 != 1 && $wheel3 != 1) || ($wheel1 != 2 && $wheel2 != 2 && $wheel3 != 2) || ($wheel1 != 3 && $wheel2 != 3 && $wheel3 != 3));{
   $playmoney = $money-$lostmb;
   mysql_query("UPDATE {$TABLE_PREFIX}users SET uploaded = uploaded - $lostmb WHERE id=$CURUSER[uid]");
}

  //Set marquee message depending on wheel results
  if ($wheel1 == 1 && $wheel2 == 1 && $wheel3 == 1)
   $marquee = "<font color= red size=3><b>WIN - WIN - WIN -  you won:&nbsp;</b></font>" .makesize($smallwin);
 
   elseif ($wheel1 == 2 && $wheel2 == 2 && $wheel3 == 2)
   $marquee = "<font color= red size=3><b>WIN - WIN - WIN - winnings:&nbsp;</b></font>" .makesize($mediumwin);

   elseif ($wheel1 == 3 && $wheel2 == 3 && $wheel3 == 3)
   $marquee = "<font color= red size=3><b>WIN - WIN - WIN -  winnings:&nbsp;</b></font>" .makesize($largewin);
   else
   $marquee = "<font color= red size=3><b>You did not win! - Lost:&nbsp;</b></font>" .makesize($lostmb);
   
   
?>
  <table style="width: 379; height: 436; border: none; background-image: url(images/slots/justbg.gif);">
   <tr style="height: 90;">
    <td>

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
 if($wheel1 == 3 && $wheel2 == 3 && $wheel3 == 3)
  echo "<form method=\"post\" action=\"high2.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"1\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 69; height: 32; margin-left: 30; border:0px; background:#513DFE;\"><img src=\"images/slots/highlive.gif\"></button></form>";
  else
  echo "<img src=\"/images/slots/high.gif\" style=\"width: 69; height: 32; border:0px; margin-top:10; margin-left: 32; margin-bottom:3;\"><br>";
?>
<?php
 if($wheel1 == 3 && $wheel2 == 3 && $wheel3 == 3)
  echo "<form method=\"post\" action=\"play.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"1\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 69; height: 32; margin-left: 30; border:0px; background:#513DFE;\"><img src=\"images/slots/stoplive.gif\"></button></form>";
  else echo "<img src=\"/images/slots/stop.gif\" style=\"width: 69; height: 32; border:0px; margin-left: 32; margin-bottom:3;\"><br>";
?>     
<?php
 if($wheel1 == 3 && $wheel2 == 3 && $wheel3 == 3)
  echo "<form method=\"post\" action=\"low2.php\" style=\"border:0px;\"><input type=\"hidden\" name=\"level\" value=\"1\"><input type=\"hidden\" name=\"prevhighlow\" value=\"$highlownum\"><input type=\"hidden\" name=\"money\" value=\"$money\"><button type=\"submit\" style=\"width: 69; height: 32; margin-left: 30; border:0px; background:#513DFE;\"><img src=\"images/slots/lowlive.gif\"></button></form>";
  else
  echo "<img src=\"/images/slots/low.gif\" style=\"width: 69; height: 32; border:0px; margin-left: 32;\"><br><br>";
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
     <img src="images/slots/wheel<?php echo "$wheel1"; ?>.gif" style="margin-left: 15;">
    </td>
    <td>
     <img src="images/slots/wheel<?php echo "$wheel2"; ?>.gif">
    </td>
    <td width="143">
     <img src="images/slots/wheel<?php echo "$wheel3"; ?>.gif" style="margin-right: 15;">
    </td>
   </tr>
   <tr>
    <td colspan="3">
<!--marquee-->
     <marquee style="margin-left: 30; margin-right: 30; color: 000000; font-weight: bold;"><p style="margin-top: 8;"><?php echo "$marquee"; ?></p></marquee>
    </td>
   </tr>
   <tr>
    <td colspan="2" align="right">

    <td>
     <?php
 
            
       echo "<form method=\"post\" action=\"play.php\"><input type=\"hidden\" name=\"money\" value=\"$playmoney\"><button type=\"submit\" style=\"width: 96; height: 41; border:0px; background:#0BE6F7;\"><center><img src=\"images/slots/playlive.gif\" style=\"width: 96; height: 41;\"></button></center></form>";
       }else{
       print("<body bgcolor=#000000 text=white link=red alink=yellow vlink=orangered><center><br><br><img src=images/slots/gameover.gif><br><br><a href=index.php?page=slots target=_top><u>Click here</a></h2></body>");
       }

     ?>
    </td>
   </tr>
  </table>
 </body>
</html>
