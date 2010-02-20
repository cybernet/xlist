<?php

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");


if (!$CURUSER || $CURUSER["admin_access"]!="yes")
{
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
else
{
    $admintpl->set("language", $language);
    $admintpl->set("birthday_lower_limit", $btit_settings["birthday_lower_limit"]);
    $admintpl->set("birthday_upper_limit", $btit_settings["birthday_upper_limit"]);
    $admintpl->set("birthday_bonus", $btit_settings["birthday_bonus"]);
    $admintpl->set("random", $CURUSER["random"]);
    $admintpl->set("uid", $CURUSER["uid"]);
    $admintpl->set("firstview", (($_POST["action"]=="Update")?FALSE:TRUE), TRUE);

 
    if($_POST["action"]=="Update")
    {
        (isset($_POST["minage"]) && !empty($_POST["minage"])?$minage=intval($_POST["minage"]):$minage=0);
        (isset($_POST["maxage"]) && !empty($_POST["maxage"])?$maxage=intval($_POST["maxage"]):$maxage=0);
        (isset($_POST["bonus"]) && !empty($_POST["bonus"])?$bonus=addslashes($_POST["bonus"]):$bonus=0);
                
        do_sqlquery("UPDATE `{$TABLE_PREFIX}settings` SET `value`=$minage WHERE `key`='birthday_lower_limit'");
        do_sqlquery("UPDATE `{$TABLE_PREFIX}settings` SET `value`=$maxage WHERE `key`='birthday_upper_limit'");
        do_sqlquery("UPDATE `{$TABLE_PREFIX}settings` SET `value`='$bonus' WHERE `key`='birthday_bonus'");
        
    }
}

?>