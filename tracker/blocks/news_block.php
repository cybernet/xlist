<?php
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/blocks.php");
if (!isset($CURUSER)) global $CURUSER;
if (!$CURUSER || $CURUSER["view_news"]=="no")
   {
       //err_msg(ERROR,NOT_AUTH_VIEW_NEWS."!");
       //stdfoot();
       //exit;
       // modified 1.2
       // do nothing - the exit terminate the script, not really good
}
else{
     block_begin(LAST_NEWS);
     print_news($GLOBALS['block_newslimit']);
     block_end();
}
?>
