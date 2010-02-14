<?
//Messey yeah i know :P maybe il tidy it up on next update
if(!defined("VAR_SHOUT"))
die("No direct access!");
else{
require("config.php");
$header="SBAdmin";

if ($do=="read" || $do=="saved")
        {
if($do=="saved")
$SB_NOTICE="config saved";
$content.="<form action=\"shoutbox.php?act=admin&do=write\" name=\"config\" method=\"post\">
            <table class=\"lista\" width=\"100%\" align=\"center\">".check_config()."
            <tr>
<td>Can guest post to shoutbox (guests have to put a username to post)</td><td>
true<input type=\"radio\" name=\"guest_post\" value=\"t\" ".check($SBX['guest_post'],"t")." $checked />
false<input type=\"radio\" name=\"guest_post\" value=\"f\" ".check($SBX['guest_post'],"f")." $checked /></td></tr>
<tr><td>Can guest view shoutbox</td><td>
true<input type=\"radio\" name=\"guest_view\" value=\"t\" ".check($SBX['guest_view'],"t")." $checked />
false<input type=\"radio\" name=\"guest_view\" value=\"f\" ".check($SBX['guest_view'],"f")." $checked /></td></tr>
<tr>
<td>deactivate shoutbox (only admin can get in)</td><td>
true<input type=\"radio\" name=\"deactivated\" value=\"t\" ".check($SBX['deactivated'],"t")." $checked />
false<input type=\"radio\" name=\"deactivated\" value=\"f\" ".check($SBX['deactivated'],"f")." $checked /></td></tr>
<tr>
<td>Allow [img] bbcode in SBmini</td><td>
true<input type=\"radio\" name=\"allow_img\" value=\"t\" ".check($SBX['allow_img'],"t")." $checked />
false<input type=\"radio\" name=\"allow_img\" value=\"f\" ".check($SBX['allow_img'],"f")." $checked /></td></tr>
<tr><td>Date and time format <a target=\"_blank\" href=\"http://www.php.net/date\">(?)</a></td><td>
<input type=\"text\" name=\"date\" value=\"".$SBX['date']."\"></td></tr>
<tr><td>Guests userlevel (can be anything you want)</td><td>
<input type=\"text\" name=\"guest\" value=\"".$SBX['guest']."\"></td></tr>
<tr><td>[img] ban message (in SBmini)</td><td>
<input type=\"text\" name=\"img_ban_message\" value=\"".$SBX['img_ban_message']."\"></td></tr>
<tr><td>SBmini URL</td><td>
<input type=\"text\" name=\"sbmini_url\" value=\"".$SBX['sbmini_url']."\"></td></tr>
<tr><td>Shoutbox Page limit</td><td>
<input type=\"text\" name=\"limit\" value=\"".$SBX['limit']."\"></td></tr>
<tr><td>Shout message max length</td><td>
<input type=\"text\" name=\"shout_limit\" value=\"".$SBX['shout_limit']."\"></td></tr>
<tr><td>Shout layout defaults to default if not found</td><td>
<input type=\"text\" name=\"layout\" value=\"".$SBX['layout']."\"></td></tr>
<tr>
<td>Active import chat.php (only needed for install)</td><td>
true<input type=\"radio\" name=\"import\" value=\"t\" ".check($SBX['import'],"t")." $checked />
false<input type=\"radio\" name=\"import\" value=\"f\" ".check($SBX['import'],"f")." $checked /></td></tr>

<tr><td class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"invia\" value=\"".FRM_CANCEL."\" /></td></tr></table></form>";
}
elseif ($do=="write"){
@chmod("./shoutbox/config.php",0777);
$fd = fopen("./shoutbox/config.php", "w") or die(CANT_WRITE_CONFIG);
$foutput ="<?\n";
$foutput.= "\$SBX['guest_post'] = \"" . $_POST['guest_post'] . "\";\n";
$foutput.= "\$SBX['guest_view'] = \"" . $_POST['guest_view'] ."\";\n";
$foutput.= "\$SBX['date'] = \"" . $_POST['date'] . "\";\n";
$foutput.= "\$SBX['guest'] = \"" . $_POST['guest'] . "\";\n";
$foutput.= "\$SBX['deactivated'] = \"" . $_POST['deactivated'] . "\";\n";
$foutput.= "\$SBX['allow_img'] = \"" . $_POST['allow_img'] . "\";\n";
$foutput.= "\$SBX['shout_limit'] = \"" . $_POST['shout_limit'] . "\";\n";
$foutput.= "\$SBX['img_ban_message'] = \"" . $_POST['img_ban_message'] . "\";\n";
$foutput.= "\$SBX['sbmini_url'] = \"" . $_POST['sbmini_url'] . "\";\n";
$foutput.= "\$SBX['limit'] = \"" . $_POST['limit'] ."\";\n";
$foutput.= "\$SBX['layout'] = \"" . $_POST['layout'] . "\";\n";
$foutput.= "\$SBX['import'] = \"" . $_POST['import'] . "\";\n";
$foutput.= "\$SBX['upgrade'] = \"f\";\n";
$foutput.="?>";
                 fwrite($fd,$foutput) or die(CANT_SAVE_CONFIG);
                 fclose($fd);
                 @chmod("./shoutbox/config.php",0744);
                 $SB_NOTICE="Config saved";
                 redirect("shoutbox.php?act=admin&do=saved");
}
elseif ($do=="import")
{
include("import.php");
}
elseif ($do=="master_reset"){
if(isset($_POST['Reset'])){
mysql_query("TRUNCATE `shoutbox`");
@chmod("./shoutbox/config.php",0777);
$fd = fopen("./shoutbox/config.php", "w") or die(CANT_WRITE_CONFIG);
$foutput ="<?\n";
$foutput.= "\$SBX['guest_post'] = \"f\";\n";
$foutput.= "\$SBX['guest_view'] = \"t\";\n";
$foutput.= "\$SBX['date'] = \"d/m/Y H:i:s\";\n";
$foutput.= "\$SBX['guest'] = \"SBguest\";\n";
$foutput.= "\$SBX['deactivated'] = \"t\";\n";
$foutput.= "\$SBX['allow_img'] = \"f\";\n";
$foutput.= "\$SBX['shout_limit'] = \"255\";\n";
$foutput.= "\$SBX['img_ban_message'] = \"(IMAGE INSERTED)\";\n";
$foutput.= "\$SBX['sbmini_url'] = \"index.php\";\n";
$foutput.= "\$SBX['limit'] = \"20\";\n";
$foutput.= "\$SBX['layout'] = \"default\";\n";
$foutput.= "\$SBX['import'] = \"t\";\n";
$foutput.= "\$SBX['upgrade'] = \"f\";\n";
$foutput.="?>";
                 fwrite($fd,$foutput) or die(CANT_SAVE_CONFIG);
                 fclose($fd);
                 @chmod("./shoutbox/config.php",0744);
$content="<center><b>Shoutbox Reset!</b></center>";
}
else{
$content="<center><b>Warning this will EMPTY the shoutbox (remove all shouts)<br>also set SB settings back to default values</b>
<form action=\"shoutbox.php?act=admin&do=master_reset\" name=\"master_rest\" method=\"post\"><input type=\"submit\" name=\"Reset\" value=\"Reset\"></form></center>";
}

}
else{
$content="<table width=\"100%\" align=\"center\"><tr><td class=\"header\" align=\"center\"><a href=\"shoutbox.php?act=admin&do=read\">SB settings</a></td><td class=\"header\" align=\"center\"><a href=\"shoutbox.php?act=admin&do=master_reset\">Reset shoutbox</a></td></tr></table>";
}
}
?>
