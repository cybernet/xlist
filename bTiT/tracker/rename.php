<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
// *****************************************************************
//
// Filename: rename.php
// Parent:   usercp.php
// Requires: Parent PHP script
// Author:   Petr1fied
// Date:     2007-03-07
// Updated:  N/A
// Version:  1.0
//
// Usage:
// - Allows members to change their nickname as long as the new
//   nickname passes strict validation.
//
// *****************************************************************
//
// ################### HISTORY ###################
//
// 1.0 2007-03-07 - Petr1fied: Initial development.
//
// *****************************************************************

// File Start --->

require_once ("include/functions.php");

dbconn();

standardheader("Change your nickname");

if (!$CURUSER || $CURUSER["uid"]==1) {
   block_begin(PLEASE_LOGIN);
   err_msg(ERROR,ERR_MUST_LOGIN);
   block_end();
   stdfoot();
   exit();
} else {

   if ($_POST["action"]) {

      (isset($_POST["nick1"])) ? $nick1=$_POST["nick1"] : $nick1="";
      (isset($_POST["nick2"])) ? $nick2=$_POST["nick2"] : $nick2="";

      if($nick1=="" || $nick2=="") $case=1;

      // -----------------------------
      // Captcha hack
      // -----------------------------

      if ($USE_IMAGECODE && !$case)
      {
        if (extension_loaded('gd'))
          {
           $arr = gd_info();
           if ($arr['FreeType Support']==1)
            {
              $public=$_POST['public_key'];
              $private=$_POST['private_key'];

                $p=new ocr_captcha();

                if ($p->check_captcha($public,$private) != true)
                    {
                    $case=2;
                }
             }
          }
      }
      if($nick1!=$nick2 && !$case) $case=3;
      elseif ($CURUSER["username"]==$nick1 && !$case) $case=4;
      elseif (preg_replace('@[^0-9A-Za-z_\- ]@','',$nick1)!=$nick1 && !$case) $case=5;
      elseif (strpos($nick1, " ")==true && !$case) $case=6;
      elseif (strlen($nick1)<3 && !$case) $case=7;
      elseif ((strtolower($nick1)=="owner" || strtolower($nick1)=="administrator" || strtolower($nick1)=="admin" || strtolower($nick1)=="moderator" || strtolower($nick1)=="guest") && !$case) $case=8;
      $res=mysql_query("SELECT `id` FROM `users` WHERE `username`='$nick1'");
      if (mysql_num_rows($res)>0 && !$case) $case=9;

      if($case) {
         if ($case==1) $msg=ERR_MISSING_DATA;
         elseif ($case==2) $msg=ERR_IMAGE_CODE;
         elseif ($case==3) $msg=NICK_NO_MATCH;
         elseif ($case==4) $msg=ERR_SAME_NICK." <strong>$nick1</strong>";
         elseif ($case==5) $msg=ERR_SPECIAL_CHAR;
         elseif ($case==6) $msg=ERR_NO_SPACE.preg_replace('/\ /', '_', $nick1)."<br />";
         elseif ($case==7) $msg=ERR_NICK_TOO_SMALL;
         elseif ($case==8) $msg=ERR_NICK_NOT_ALLOWED;
         elseif ($case==9) $msg=ERR_USER_ALREADY_EXISTS;

         block_begin("Error");
         err_msg(ERROR,$msg);
         block_end();
         stdfoot();
         exit();
      }
      @mysql_query("UPDATE `users` SET `username`='$nick1' WHERE id=".$CURUSER["uid"]);
      write_log("changed their nickname to $nick1","modify");
      block_begin(CONGRATS);
      std_msg(CONGRATS.":",NICK_CHANGE_SUCCESS.$nick1."<br /><br /><a href='usercp.php?uid=".$CURUSER["uid"]."'>".BCK_USERCP."</a>");
      block_end();
      stdfoot();
      exit();
   }
   block_begin(CHANGE_NICK);
   ?>
   <br /> 
   <form method='post'>
   <table width='75%' class='lista' cellspacing='0' cellpadding='10' align='center'>
   <tr><td class='header' align='right' width='35%'><?php echo CURR_NICK; ?>:</td><td class='lista'><?php echo $CURUSER["username"]; ?></td></tr>
   <tr><td class='header' align='right' width='35%'><?php echo NEW_NICK; ?>:</td><td class='lista'><input type='text' name='nick1' value='' maxlength='40' size='32'></td></tr>
   <tr><td class='header' align='right' width='35%'><?php echo REPEAT_NICK; ?>:</td><td class='lista'><input type='text' name='nick2'  value='' maxlength='40' size='32'></td></tr>

   <?php
   // -----------------------------
   // Captcha hack
   // -----------------------------
   if ($USE_IMAGECODE)
     {
      if (extension_loaded('gd'))
        {
          $arr = gd_info();
          if ($arr['FreeType Support']==1)
           {
            $p=new ocr_captcha();

            print("<tr><td align='right' class='header'>".IMAGE_CODE.":</td>");
            print("<td align=left class='lista'><input type='text' name='private_key' value='' maxlength='6' size='7'>");
            print($p->display_captcha(true));
            $private=$p->generate_private();
            print("</td></tr>");
         }
        }
      }
   ?>
   <tr><td colspan='2' class='block' align='center'><input type='submit' name='action' value='<?php echo FRM_CONFIRM; ?>'></td></tr>

   </form>
   </table><br />
    
   <?php
   block_end();
}
stdfoot();

// <--- File End

?>
