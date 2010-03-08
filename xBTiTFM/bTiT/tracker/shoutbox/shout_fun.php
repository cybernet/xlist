<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
define("IMPORT_ERROR","Import not allowed!! Please toggle premission to true in admin panel first!");
define("SHOUTMINI","SBmini");
define("SHOUTACP","SBAdmin");
define("SHOUTDIS","Warning Shoutbox is currently disabled!");
define("SHOUTDIS_PUBLIC","Shoutbox is currently disabled, please try again later");
define("SHOUT","Shout it!");
define("NO_MSG","Sorry ".$CURUSER['username']." No shout was found!");
define("NO_USER","You didnt set a username");
define("NO_DEL","You cant Delete another members shout!");
define("NO_EDIT","You cant Edit another members shout!");
define("SHOUTBOX_NOPREM","You dont have permission to view the shoutbox!");
define("NO_ACC","Access Denied");
define("SHOUT_MAIN","Please use main shout to post");
define("NO_DOUBLE_SHOUT","Sorry ".$CURUSER['username']." no double shouts allowed!");
define("SHOUT_LIMIT","Sorry, shout larger then allowed shout length");
require("./shoutbox/config.php");

//Demo Setting, not needed for a production site is why this here and not in the config!
$SBX["demo"] = "f";
define("SB_VER","Ver 1");

if(isset($_GET["act"]))
$action=$_GET["act"];
else
$action="shout";
if(isset($_GET["do"]))
$do=$_GET["do"];
else
$do="ask";
//Must be a number!
if(isset($_GET["id"]) && is_numeric($_GET["id"]))
$id=$_GET["id"];
else
$id=0;
//Must be a number!
if(isset($_GET["page"]) && is_numeric($_GET["page"]))
$page=$_GET["page"];
else
$page=1;
function install_upgrade(){
global $SBX, $CURUSER;
          $query = "SELECT * FROM shoutbox WHERE msgid>0 limit 1" ;
          $result = mysql_query($query);
          $install=mysql_fetch_array($result);
             if($install['msgid'] < 1){
$inst_upg_msg="<b>Welcome to ASB ".$CURUSER['username']."</b><br>
               i have detected that this is your first time using this SB<br>if you wish to import your chat.php file please goto SBadmin and toggle the setting for import to true then select the import link from the mini navbar.<br>Please enjoy this hack and post requests/bug fixes to the release forum<br>PS this message will disappear after your first shout or import<img src=\"./images/smilies/wink.gif\"><br>Vibes";
return $inst_upg_msg;
}
elseif($SBX['upgrade'] == "t"){
$inst_upg_msg="You have successfully upgraded ASB to ".SB_VER."<br>Please now reactivate your shoutbox, Vibes <img src=\"./images/smilies/tongue.gif\">";
return $inst_upg_msg;
}
else
return false;
}
if($CURUSER['admin_access'] == "yes")
$inst_upg_msg=install_upgrade();

function make_html($curfile,$poster,$country,$flag,$level,$uploaded,$downloaded,$postdate,$ratio,$flag,$avatar,$modtoolbar,$shout_msg)
{
global $BASEURL;
if(!file_exists("./shoutbox/html/$curfile.html"))
$curfile="default";
         $file=fopen("./shoutbox/html/$curfile.html","r");
         $model=fread($file,filesize("./shoutbox/html/$curfile.html"));
         fclose($file);
$model=eregi_replace("\{POSTER}",$poster, $model);
$model=eregi_replace("\{COUNTRY}",$country, $model);
$model=eregi_replace("\{FLAG}",$flag, $model);
$model=eregi_replace("\{LEVEL}",$level, $model);
$model=eregi_replace("\{UPLOADED}",$uploaded, $model);
$model=eregi_replace("\{DOWNLOADED}",$downloaded, $model);
$model=eregi_replace("\{POSTDATE}",$postdate, $model);
$model=eregi_replace("\{RATIO}",$ratio, $model);
$model=eregi_replace("\{FLAG}",$flag, $model);
$model=eregi_replace("\{AVATAR}",$avatar, $model);
$model=eregi_replace("\{MODTOOLBAR}",$modtoolbar, $model);
$model=eregi_replace("\{SHOUT_MSG}",$shout_msg, $model);
return $model;
}

function shout_header($SB_NOTICE=false){
  global $CURUSER, $SBX, $inst_upg_msg;
       $content="<a name=\"top\"><table width=\"100%\"><tr><td class=\"header\"><center><a href=\"".$SBX['sbmini_url']."\">".SHOUTMINI."</a> - <a href=\"shoutbox.php?act=shout\">".SHOUTBOX."</a> - <a href=\"shoutbox.php?act=history\">".HISTORY."</a>";
  //can User access ACP
  if($CURUSER["admin_access"] == "yes"){
     $content.=" - <a href=\"shoutbox.php?act=admin\">".SHOUTACP."</a>";
  //install detected?
  If($SBX['import'] == "t")
     $content.=" - <a href=\"shoutbox.php?act=admin&do=import\">import chat.php</a>";
}
//For Demo
  if($SBX["demo"] == "t" && $CURUSER["admin_access"] == "no"){
    $content.=" - <a href=\"shoutbox.php?act=admin\">".SHOUTACP." demo</a>";
}
//End links
       $content.="</td></tr>";
//Display notice if use is a admin and SB is disabled
  if($SBX['deactivated'] == "t" && $CURUSER["admin_access"] == "yes"){
       $content.="<tr><td style='background:white;' align=\"center\"><font color=\"red\"><b>".SHOUTDIS."</b></font></td></tr>";
  }

if($inst_upg_msg){
$content.="<tr><td style='background:white; border:2pt groove #58A5EB; color:black;' align=\"center\">$inst_upg_msg</td></tr>";
}
//Did we hit an error/notice?
if($SB_NOTICE){
$content.="<tr><td style='background:white; border:2pt groove red; padding:6pt; color:red;' align=\"center\"><b>$SB_NOTICE</b></td></tr>";
}

$content.="<tr><td class=\"lista\">";
//Return the SBheader
   return $content;
}

function shout_foot(){
       $content="</td></tr></table>";
   return $content;
}

function shout_form($message="",$edit=false){
global $SBX, $CURUSER, $id,$SB_NOTICE;
if(!$edit)
$url="shoutbox.php?act=shout";
else{
$url="shoutbox.php?act=edit&id=$id";
$hidden="<input type=\"hidden\" value=\"hidden\" name=\"hidden\">";
}
if((!$CURUSER || $CURUSER['uid'] == 1 && $SBX['guest_post'] == "t") || $CURUSER['uid'] > 1){
$return="<form name=\"shout\" action=\"$url\" method=\"post\">$hidden";
if($CURUSER['uid'] == 1)
$return.="<b>".USER_NAME."</b>&nbsp;&nbsp;&nbsp;<input type=\"text\" name=\"username\" value=\"".htmlspecialchars($_POST['username'])."\">";
$return.="<table width=\"100%\">
<tr><td>".textbbcode("shout","message",$message,false)."
</td></tr>
<tr>
<td class=\"lista\" align=\"center\">
<input type='submit' name='submit' value='".SHOUT."'>
</td>
</tr>
</table>
</form>";
}
else{
$SB_NOTICE=ERR_MUST_BE_LOGGED_SHOUT;
}
return $return;
}

function check($a,$b){
global $checked;
if("$a"=="$b")
$checked=" checked=\"checked\"";
else
$checked="";
}

//no longer used
function msg($SB_NOTICE){
global $CURUSER;
$return="<br><table align=\"center\" width=\"80%\"><tr>
         <td align=\"center\" style='padding:8px; color:#FF2D2D; border:2pt groove #58A5EB; background-image: url(./shoutbox/error_back.png);'><img src=\"./shoutbox/error.png\" border=\"0\">&nbsp;<font size=\"+1\"><b>".SORRY." ".$CURUSER['username']."</b></font><br>$SB_NOTICE<br><center><a href=javascript:history.go(-1)>".BACK."</a></center></td></table>";
return $return;
}

function check_config(){
if (is_writable("./shoutbox/config.php"))
return;
  else
return "<tr><td align=\"center\" style='background:white;' colspan=2><font color=\"red\"><b>config is NOT writable, please chmod</b></td></tr>\n";
}

function last_shout_check($message,$username){
                $query = "SELECT message FROM shoutbox WHERE user='$username' ORDER BY msgid DESC LIMIT 1";
                $result = mysql_query($query);
                 
                $row = mysql_fetch_array($result);
if ($row["message"] != $message)
return true;
else
return false;
}
?>
