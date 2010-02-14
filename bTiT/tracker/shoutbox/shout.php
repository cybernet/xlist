<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
else{
//are we deleting a shout?
if($id >= 1)
{
      if (isset($CURUSER) && $CURUSER['uid'] > 1)
        {
           $query = "SELECT userid FROM shoutbox WHERE msgid=$id" ;
           $result = mysql_query($query);
           $row = @mysql_fetch_array($result);
              //check user belongs to shout or can delete forum
              if ($CURUSER['uid'] == $row["userid"] || $CURUSER['delete_forum'] == "yes")
              {
                 $query = "DELETE FROM shoutbox WHERE msgid=$id" ;
                 mysql_query($query);
              }
              else{
                 //User doesnt own shout or isnt admin
                 $SB_NOTICE=NO_DEL;
              }
         }
       else{
         //user is a guest or msgid not found
         $SB_NOTICE=BAD_ID;
        }
}
//are we posting a shout?
elseif (isset($_POST['message'])){
       $message=$_POST['message'];
          if(($CURUSER['uid'] == 1 && $SBX['guest_post'] == "t") || $CURUSER['uid'] >= 2){
               if($message != ""){
                if(strlen($message) <= $SBX['shout_limit'] || $CURUSER['admin_access'] == "yes"){
                  if($CURUSER['uid'] == 1){
                     $uid=0;
                     $username=addslashes(htmlentities($_POST['username']));
                  }
                  elseif($CURUSER['uid'] > 1){
                     $uid=$CURUSER['uid'];
                     $username=$CURUSER['username'];
                  }
                    if ($username != ""){
                        if(last_shout_check($message,$username)){
                           $query = "INSERT INTO shoutbox (msgid, user, message, date, userid) VALUES (NULL, '$username', '".addslashes($message)."', UNIX_TIMESTAMP(), '$uid')";
                           mysql_query($query);
                        }
                         else
                          $SB_NOTICE=NO_DOUBLE_SHOUT;
                    }
                    else
                     $SB_NOTICE=NO_USER;
                }
              else 
               $SB_NOTICE=SHOUT_LIMIT . " - Max " . $SBX['shout_limit'] . " characters";
             }
             else
              $SB_NOTICE=NO_MSG;
         }
}

//Display shoutbox
$header=SHOUTBOX;
//get form
if(isset($SB_NOTICE))
$content=shout_form($message);
else
$content=shout_form();

$query = "SELECT shoutbox. * FROM shoutbox ORDER BY shoutbox.msgid DESC LIMIT ".$SBX['limit']."";

$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {

 $userdetails=mysql_query("SELECT users.username, users.id_level, users.joined, users.lastconnect, users.flag, users.avatar, users.uploaded, users.downloaded, country.name AS cname, country.flagpic AS cpic, levels.level, levels.prefixcolor AS pcol, levels.suffixcolor AS scol FROM users LEFT JOIN countries AS country ON users.flag = country.id LEFT JOIN users_level AS levels ON users.id_level = levels.id WHERE users.id =".$row['userid']."");
if($row['userid'] == 0)
$userres=0;
else
$userres=mysql_fetch_array($userdetails);
//is the current user for shout still a member of site? if not use detials stored in shoutbox table
$modtoolbar=".";

//Guest settings
    if($userres==0){
       $poster= stripslashes($row["user"]);
       $country=UNKNOWN;
       $flag="unknown.gif";
       $uploaded="0.00 KB";
       $downloaded="0.00 KB";
       $ratio="(SR ---)";
       $level=$SBX['guest'];
if ($CURUSER['delete_forum'] == "yes"){
              $modtoolbar="<a href=\"shoutbox.php?act=shout&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_delete.png","",DELETE)."</a>";
}
if ($CURUSER['edit_forum'] == "yes"){
              $modtoolbar.="<a href=\"shoutbox.php?act=edit&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_edit.png","",EDIT)."</a>";
}
       }
//Member settings
    else{
       $poster="<a href=\"userdetails.php?id=".$row["userid"]."\">" . unesc($userres["pcol"]) . unesc($userres["username"]) . unesc($userres["scol"]) . "</a>";
       $country=$userres["cname"];
          if (($CURUSER['uid'] == $row['userid'] || $CURUSER['delete_forum'] == "yes") && $CURUSER['uid'] > 1)
              $modtoolbar="<a href=\"shoutbox.php?act=shout&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_delete.png","",DELETE)."</a>";
          if (($CURUSER['uid'] == $row['userid'] || $CURUSER['edit_forum'] == "yes") && $CURUSER['uid'] > 1){
              $modtoolbar.="<a href=\"shoutbox.php?act=edit&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_edit.png","",EDIT)."</a>";
}
       $flag=$userres['cpic'];
       $uploaded=makesize($userres['uploaded']);
       $downloaded=makesize($userres['downloaded']);
       $ratio="(SR ".($userres['downloaded']>0?number_format($userres['uploaded']/$userres['downloaded'],2):"---").")";
       $level=$userres['level'];
       $avatar=$userres['avatar'];
}
include("include/offset.php");
$postdate=date("".$SBX['date']."",$row["date"]-$offset)."";
//format shout
$shout_msg=format_comment($row["message"]);
//debug
#$shout_msg=$shout_msg."<br>Message ID = ".$row['msgid']."";
//builds the html tables
$model=make_html($SBX['layout'],$poster,$country,$flag,$level,$uploaded,$downloaded,$postdate,$ratio,$flag,$avatar,$modtoolbar,$shout_msg);

        $content.= $model;
//echo $shout_msg;

}
}
?>