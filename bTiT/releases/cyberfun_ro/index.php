<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/

if (file_exists("install.me"))
   {
   if (dirname($_SERVER["PHP_SELF"])=="/" || dirname($_SERVER["PHP_SELF"])=="\\")
      header("Location: http://".$_SERVER["HTTP_HOST"]."/install/");
   else
      header("Location: http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["PHP_SELF"])."/install/");
   exit;
}

require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/blocks.php");

dbconn(true);

standardheader('Index',true,0);

center_menu();

/*
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    err_msg(ERROR.NOT_AUTHORIZED." ".MNU_TORRENT."!",SORRY."...");
    stdfoot();
    exit();
}
else
{
*/
  ?>
  <script language="Javascript" type="text/javascript">

  <!--

  var newwindow;
  function popdetails(url)
  {
    newwindow=window.open(url,'popdetails','height=500,width=500,resizable=yes,scrollbars=yes,status=yes');
    if (window.focus) {newwindow.focus()}
  }

  function poppeer(url)
  {
    newwindow=window.open(url,'poppeers','height=400,width=650,resizable=yes,scrollbars=yes');
    if (window.focus) {newwindow.focus()}
  }

  // -->
  </script>

  <?php

//}

stdfoot();

?>
