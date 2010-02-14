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

standardheader("Support");

          if (isset($_POST["support"])) $support=mysql_escape_string($_POST["support"]);
             else $support = "";
           if (isset($_GET["returnto"]))
              $url=$_GET["returnto"];

           $userid = max(0,$_GET["uid"]);
           $user = mysql_escape_string($_POST["username"]);


    if ("$support"=="")
        {
           mysql_query("UPDATE users SET support=NULL WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
    else
        {
           mysql_query("UPDATE users SET support='".htmlspecialchars($support)."' WHERE id='".$userid."' AND username='".$user."'") or sqlerr(__FILE__, __LINE__);
        }
           redirect($url);
   }

?>