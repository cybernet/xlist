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

  standardheader('Bonus Transfered');

block_begin("Bonus Points Transfered");

 
echo("<center><br><b>Your seedbonus transfer was successful! </b></br></center>");
echo("<br>");
block_end();
stdfoot();
?>