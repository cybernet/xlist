<?php

if (isset($_POST["username"]) && isset($_POST["email"]))
{
  
  $THIS_BASEPATH=str_replace(array('admin','\\'),array('','/'),dirname(__FILE__));
  require("$THIS_BASEPATH/include/functions.php");
  include(load_language("lang_main.php"));
  include(load_language("lang_usercp.php"));
  include(load_language("lang_admin.php"));
  dbconn();

  /* begin just in case someone is trying to fuck us inserting new users without been authorized */

  if (!$CURUSER || ($CURUSER["admin_access"]!="yes" && $CURUSER["edit_users"]!="yes"))
     {
         err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
         stdfoot();
         die();
  }

  $aid = max(0, $_POST["user"]);
  $arandom = max(0,$_POST["code"]);

  if (!$aid || empty($aid) || $aid==0 || !$arandom || empty($arandom) || $arandom==0)
  {
         err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
         stdfoot();
         die();
  }

  $mqry=do_sqlquery("select u.id, ul.admin_access from {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul on ul.id=u.id_level WHERE u.id=$aid AND random=$arandom AND (admin_access='yes' OR edit_users='yes') AND username=".sqlesc($CURUSER["username"]),true);

  if (mysql_num_rows($mqry)<1)
  {
         err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
         stdfoot();
         die();
  }
  /* end just in case someone is trying to fuck us inserting new users without been authorized */
     

  $out='';
  $username=mysql_escape_string($_POST['username']);
  $pwd=mysql_escape_string($_POST["pwd"]);
  $email=mysql_escape_string($_POST["email"]);
  $idlangue=intval($_POST["language"]);
  $idstyle=intval($_POST["style"]);
  $idlevel=intval($_POST["level"]);

  // duplicate username ???
  $res=do_sqlquery("SELECT username FROM {$TABLE_PREFIX}users WHERE username='$username'",true);
  if (mysql_num_rows($res)>0)
     {
     echo $language["ERR_USER_ALREADY_EXISTS"].'|1';
     die();
  }

  // username with space
  if (strpos(mysql_escape_string($username), " ")==true)
     {
     echo $language["ERR_NO_SPACE"].'|1';
     die();
  }

  $bannedchar=array("\\", "/", ":", "*", "?", "\"", "@", "$", "'", "`", ",", ";", ".", "<", ">", "!", "£", "%", "^", "&", "(", ")", "+", "=", "#", "~");
  if (straipos(mysql_escape_string($username), $bannedchar)==true)
     {
     echo $language["ERR_SPECIAL_CHAR"].'|1';
     die();
  }

  if(strlen(mysql_real_escape_string($pwd))<4)
     {
     echo $language["ERR_PASS_LENGTH"].'|2';
     die();
  }

  $res=do_sqlquery("SELECT email FROM {$TABLE_PREFIX}users WHERE email='$email'",true);
  if (mysql_num_rows($res)>0)
     {
     echo $language['ERR_EMAIL_ALREADY_EXISTS'].'|3';
     die();
  }



  $floor = 100000;
  $ceiling = 999999;
  srand((double)microtime()*1000000);
  $random = rand($floor, $ceiling);

  // finally insert new user
  $pid=md5(uniqid(rand(),true));
  do_sqlquery("INSERT INTO {$TABLE_PREFIX}users (username, password, random, id_level, email, style, language, joined, lastconnect, pid) VALUES ('$username', '" . md5($pwd) . "', $random, $idlevel, '$email', $idstyle, $idlangue, NOW(), NOW(),'$pid')",true);

  $newuid=mysql_insert_id();

  if (!isset($db_prefix))
     $db_prefix="smf_";

  // Continue to create smf members if they disable smf mode
  // $test=do_sqlquery("SELECT COUNT(*) FROM {$db_prefix}members");
  $test=do_sqlquery("SHOW TABLES LIKE '{$db_prefix}members'");

  if ($FORUMLINK=="smf" || mysql_num_rows($test))
  {
      $smfpass=smf_passgen($username, $pwd);
      $flevel=$idlevel+10;

      do_sqlquery("INSERT INTO {$db_prefix}members (memberName, dateRegistered, ID_GROUP, realName, passwd, emailAddress, memberIP, memberIP2, is_activated, passwordSalt) VALUES ('$username', UNIX_TIMESTAMP(), $flevel, '$username', '$smfpass[0]', '$email', '".getip()."', '".getip()."', 1, '$smfpass[1]')");
      $fid=mysql_insert_id();
      do_sqlquery("UPDATE `{$db_prefix}settings` SET `value` = $fid WHERE `variable` = 'latestMember'");
      do_sqlquery("UPDATE `{$db_prefix}settings` SET `value` = '$username' WHERE `variable` = 'latestRealName'");
      do_sqlquery("UPDATE `{$db_prefix}settings` SET `value` = UNIX_TIMESTAMP() WHERE `variable` = 'memberlist_updated'");
      do_sqlquery("UPDATE {$TABLE_PREFIX}users SET smf_fid=$fid WHERE id=$newuid");
  }

  // xbt
  if ($XBTT_USE)
     {
     $resin=do_sqlquery("INSERT INTO xbt_users (uid, torrent_pass) VALUES ($newuid,'$pid')");
     }


  // sending email to user if required
  if ($_POST["emailsend"]=='1')
    {
    if (send_mail($email,"Welcome to " . $btit_settings['name'],sprintf($language["NEW_USER_EMAIL_TEXT"],$username,$btit_settings['name'],$username, $pwd))===true)
       $out='OK|0';
    else
        $out='OK|4';
  }
  else
      $out='OK|0';


}
else
  $out= "no direct access!";

echo $out;
die;
?>