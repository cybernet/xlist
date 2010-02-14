<?
//Messey yeah i know :P maybe il tidy it up on next update
if(!defined("VAR_SHOUT"))
die("No direct access!");
else{
require("config.php");
$header="SBAdmin Demo";

if ($do=="ask")
        {
$SB_NOTICE="Welcome to the SBadmin demo panel</b><br>this is a demo of the SBadmin panel, you cant really edit out from here as you really dont have permission to edit them but iv allowed access so you can see the Admin panel<b>";
$content.="<form action=\"shoutbox.php?act=admin&do=write\" name=\"config\" method=\"post\">
            <table class=\"lista\" width=\"100%\" align=\"center\">".check_config()."$welcome
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
<tr><td class=\"header\"><input type=\"submit\" name=\"write\" value=\"".FRM_CONFIRM."\" /></td><td align=\"center\" class=\"header\"><input type=\"submit\" name=\"invia\" value=\"".FRM_CANCEL."\" /></td></tr></table></form>";
}
else
$SB_NOTICE="YOU CANT REALLY EDIT THE SHOUT ADMIN PANEL THIS IS JUST A DEMO!!!!!!!!!!!";
}
?>