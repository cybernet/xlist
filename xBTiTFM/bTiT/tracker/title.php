<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();


if (!$CURUSER || $CURUSER["edit_users"]!="yes")
   {
 require_once "include/functions.php";
 require_once "include/config.php";
 standardheader("Get a freakin life and stop trying to hack the tracker !");

 block_begin(ERROR);

       err_msg("Error", "Piss off !!! Staff only !");
print ("<br>");
block_end();
 stdfoot(false);

   }
else
   {

standardheader("Change Custom Title");

          if (isset($_POST["title"])) $custom=mysql_escape_string($_POST["title"]);
             else $custom = "";
           if (isset($_GET["returnto"]))
              $url=$_GET["returnto"];

           $userid = max(0,$_GET["uid"]);
           $user = mysql_escape_string($_POST["username"]);


    if ("$custom"=="")
        {
           mysql_query("UPDATE users SET custom_title=NULL WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
    else
        {
           mysql_query("UPDATE users SET custom_title='".htmlspecialchars($custom)."' WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
           redirect($url);
   }

?>