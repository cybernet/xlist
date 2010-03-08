<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();


if ($CURUSER["view_torrents"] == "no")
   {
       err_msg(ERROR,NOT_AUTH_VIEW_NEWS);
       stdfoot();
       exit;
}

else
   {
$uid = $CURUSER['uid'];
  $r = mysql_query("SELECT * from users where id=$uid");
  $c = mysql_result($r,0,"seedbonus");
if($c > 499) {  
standardheader("Change Custom Title");

          if (isset($_POST["title"])) $custom=mysql_escape_string($_POST["title"]);
             else $custom = "";
           if (isset($_GET["returnto"]))
              $url = $_GET["returnto"];

           $userid = max(0, $_GET["uid"]);
           $user = mysql_escape_string($_POST["username"]);


    if ("$custom" == "")
        {
           mysql_query("UPDATE users SET custom_title=NULL WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
    else
        {
           mysql_query("UPDATE users SET custom_title='".htmlspecialchars($custom)."' WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
        
        
        $p=(500);
        
        @mysql_query("UPDATE users SET seedbonus=seedbonus-$p WHERE id=$CURUSER[uid]");
        }
   }  
           redirect($url);
   
 
?>
