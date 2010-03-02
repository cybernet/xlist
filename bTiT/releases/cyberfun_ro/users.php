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

standardheader('Members');

if ($CURUSER["view_users"] == "no")
   {
       err_msg(ERROR,NOT_AUTHORIZED." ".MEMBERS."!");
       stdfoot();
       exit;
}
else
    {
     block_begin(MEMBERS_LIST);
     print_users();
     block_end();
     }
stdfoot();

?>
