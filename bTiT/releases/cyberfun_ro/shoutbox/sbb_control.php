<?php
putenv("TZ=Europe/Stockholm");

if(!defined("VAR_SHOUT"))
die("No direct access!");
global $CURUSER,$SBX,$inst_upg_msg;
dbconn();
include("./shoutbox/shout_fun.php");

if($SBX['deactivated'] == "t" && $CURUSER["admin_access"] == "no"){
    $SB_NOTICE=SHOUTDIS_PUBLIC;
}
elseif(((!$CURUSER || $CURUSER['uid'] == 1) && $SBX['guest_view'] == "t") || $CURUSER['uid'] >= 2){

if(isset($_POST['sub_shout'])){
       $message=$_POST['mess'];
          if($CURUSER['uid'] >= 2){
               if($message != ""){
                     $uid=$CURUSER['uid'];
                     $username=$CURUSER['username'];
                      if(last_shout_check($message,$username)){
                           $query = "INSERT INTO shoutbox (msgid, user, message, date, userid) VALUES (NULL, '$username', '".addslashes($message)."', UNIX_TIMESTAMP(), '$uid')";
                           mysql_query($query);
                        }
                         else
                          $SB_NOTICE=NO_DOUBLE_SHOUT;
                }
              else 
               $SB_NOTICE=NO_MSG;
         }
}
$content.="<style>
div.chat
{
align: center;
overflow: auto;
width: 100%;
height: 120px;
padding: 0px;
}

</style>";

$content.="<script language=javascript>
function SmileIT(smile){
    document.forms['shout'].elements['mess'].value = document.forms['shout'].elements['mess'].value+\" \"+smile+\" \";
    document.forms['shout'].elements['mess'].focus();
}
function PopMoreSmiles(form,name) {
         link='moresmiles.php?form='+form+'&text='+name
         newWin=window.open(link,'moresmile','height=500,width=400,resizable=yes,scrollbars=yes');
         if (window.focus) {newWin.focus()}
}
</script>";
function smile() {

$return="<div align=\"center\">
  <table cellpadding=\"1\" cellspacing=\"1\">
  <tr>";


  global $smilies, $count;
  reset($smilies);

  while ((list($code, $url) = each($smilies)) && $count<20)
        {
        $return.="\n<td><a href=\"javascript: SmileIT('".str_replace("'","\'",$code)."')\"><img border=0 src=images/smilies/".$url."></a></td>";
        $count++;
        }

  $return.="</tr>
  </table>
</div>";
return $return;
}

$query = "SELECT shoutbox. * FROM shoutbox ORDER BY shoutbox.msgid DESC LIMIT 10";
$content.="<div align=left class=\"chat\"><table width=100%>";
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {
$message=$row['message'];
if($SBX['allow_img'] == "f"){
    $message = preg_replace("/\[img\](http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\[\/img\]/", " [b]".$SBX['img_ban_message']."[/b] ", $message);
    $message = preg_replace("/\[IMG\](http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\[\/IMG\]/", " [b]".$SBX['img_ban_message']."[/b] ", $message);
    $message = preg_replace("/\[img=(http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\]/", " [b]".$SBX['img_ban_message']."[/b] ", $message);
    $message = preg_replace("/\[IMG=(http:\/\/[^\s'\"<>]+(\.gif|\.jpg|\.png))\]/", " [b]".$SBX['img_ban_message']."[/b] ", $message);
}
if($row["userid"]>0)
$user_guest="<a href=\"userdetails.php?id=".$row["userid"]."\">".$row['user']."</a>";
else
$user_guest=$row["user"];
include("include/offset.php");
$content.="<tr><td class=header align=left>$user_guest&nbsp;&nbsp;".date("d/m/y H:i",$row['date']-$offset)."<tr><td class=lista align=left>".format_comment($message)."</td></tr>";
}
$smiles=smile();
$content.="</table></div>";
if($SBX['guest_post'] == "t" && $CURUSER['uid'] == 1)
$SB_NOTICE=SHOUT_MAIN;
elseif($SBX['guest_post'] == "f" && $CURUSER['uid'] == 1)
{
$SB_NOTICE=ERR_MUST_BE_LOGGED_SHOUT;
}
else{
$content.="<div class=\"miniform\" align=\"center\">
<form method=\"post\" name=\"shout\">$smiles
<input type=\"hidden\" name=\"user\" value=\"".$CURUSER["username"]."\" /><br />
<input name=\"mess\" size=\"70\" maxlength=\"".$SBX['shout_limit']."\" />
<br />
<a href=\"javascript: PopMoreSmiles('shout','mess')\">Emoticons</a> &nbsp; &nbsp; &nbsp;<input name=\"sub_shout\" type=\"submit\" value=\"".FRM_CONFIRM."\">";
}
}
if(($CURUSER['uid'] == 1 && $SBX['guest_view'] == "t") || $CURUSER['uid'] >= 2){
block_begin(SHOUTBOX);
$precontent=shout_header($SB_NOTICE);
$postcontent=shout_foot();
$content=$precontent . $content . $postcontent;
print($content);
block_end();
}
?>