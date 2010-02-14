<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
include('include/functions.php');
include('include/config.php');
dbconn();
//didnt really wanna output this yet but we need STYLEPATH as we use it before main output
standardheader("Shoutbox");

//contact core
include("shout_fun.php");

//IS Shoutbox disabled?? if so let admin enter anyway
if($SBX['deactivated'] == "t" && $CURUSER["admin_access"] == "no"){
    $SB_NOTICE=SHOUTDIS_PUBLIC;
}
else{
    //Shoutbox admin
    if($action == "admin"){
        if($CURUSER["admin_access"] == "yes")
           include_once("admin.php");
    elseif($SBX['demo'] == "t"){
        include_once("fakeadmin.php");
        }
     else
   $SB_NOTICE=NOT_ADMIN_CP_ACCESS;
    }
       elseif($action == "edit"){
         if($CURUSER['uid'] > 1)
           include_once("edit_shout.php");
         else{
            $SB_NOTICE=NO_EDIT;
             }
   }
    //display main shoutbox or history
    elseif($action == "shout" || $action == "history"){
        if(((!$CURUSER || $CURUSER['uid'] == 1) && $SBX['guest_view'] == "t") || $CURUSER['uid'] >= 2)
            include_once("$action.php");
        //Guests not allowed to view shoutbox
        else{
            $SB_NOTICE=SHOUTBOX_NOPERM;
            }
    }
else{
    $SB_NOTICE=ACTION." '$action' ".ERR_NOT_FOUND;
}
}
//OUTPUT PAGE
block_begin("$header");
$precontent=shout_header($SB_NOTICE);
$postcontent=shout_foot();

$content=$precontent . $content . $postcontent;
print($content);
//not really needed but still nice to tidy up
unset($action,$do,$id,$page,$SBX);
block_end();
stdfoot();
?>