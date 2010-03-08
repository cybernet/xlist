<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn(true);

standardheader('User Control Panel');

$uid=(isset($_GET["uid"]) ? intval($_GET["uid"]):1);

?>
<script type="text/javascript">
<!--

var newwindow;
function popusers(url)
{
  newwindow=window.open(url,'popusers','height=100,width=450');
  if (window.focus) {newwindow.focus()}
}


// -->
</script>
<?php

if ($CURUSER["uid"] != $uid || $CURUSER["uid"] == 1)
   {
       err_msg(ERROR,ERR_USER_NOT_USER);
       stdfoot();
       exit;
}
else
    {
    $utorrents = intval($CURUSER["torrentsperpage"]);
    if (isset($_GET["do"])) $do = $_GET["do"];
      else $do = "";
    if (isset($_GET["action"]))
       $action = $_GET["action"];
	if (isset($_GET["messages"]))
	   $messages = $_GET["messages"];

    // begin the real admin page
     block_begin($CURUSER["username"]."'s Control Panel");
     print("\n<table class=\"lista\" width=\"100%\" align=\"center\"><tr>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?uid=$uid\">".MNU_UCP_HOME."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?uid=$uid&do=pm&action=list&what=inbox\">".MNU_UCP_PM."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?uid=$uid&do=pm&action=list&what=outbox\">".MNU_UCP_OUT."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?do=pm&action=edit&uid=$uid&what=new\">".MNU_UCP_NEWPM."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?do=user&action=change&uid=$uid\">".MNU_UCP_INFO."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?do=pwd&action=change&uid=$uid\">".MNU_UCP_CHANGEPWD."</a></td>");
     print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?do=pid_c&action=change&uid=$uid\">".CHANGE_PID."</a></td>");
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
	 if ($INVITESON)
		 print("\n<td class=\"header\" align=\"center\"><a href=\"usercp.php?do=invites&action=read&uid=$uid\">".MNU_UCP_INVITATIONS."</a></td>");
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
     print("\n</tr></table>\n");

     if ($do == "pm" && $action == "list")
        {
        // MODIFIED select for deletion by gAnDo
            print("<script type=\"text/javascript\">
            <!--
            function SetAllCheckBoxes(FormName, FieldName, CheckValue)
            {
            if(!document.forms[FormName])
            return;
            var objCheckBoxes = document.forms[FormName].elements[FieldName];
            if(!objCheckBoxes)
            return;
            var countCheckBoxes = objCheckBoxes.length;
            if(!countCheckBoxes)
            objCheckBoxes.checked = CheckValue;
            else
            // set the check value for all check boxes
            for(var i = 0; i < countCheckBoxes; i++)
            objCheckBoxes[i].checked = CheckValue;
            }
            -->
            </script>
            ");

           if (isset($_GET["what"]) && $_GET["what"])
                 $what = $_GET["what"];
           else $what = "";
                   if ($what == "outbox")
                  {
                   block_begin(MNU_UCP_OUT);
                   print("\n<form action=\"usercp.php?do=pm&action=deleteall&messages=out&uid=$uid&type=out\" name=\"deleteall\" method=\"post\">");
                   print("\n<table class=lista width=100% align=center>");
                   print("\n<tr><td class=header align=center>".READED."</td><td class=header align=center>".RECEIVER."</td><td class=header align=center>".DATE."</td><td class=header align=center>".SUBJECT."</td>");
                   //$res=mysql_query("select messages.*, users.username as receivername FROM messages INNER JOIN users on users.id=messages.receiver WHERE sender=$uid ORDER BY added DESC");
                   $res = mysql_query("select messages.*, users.username as receivername FROM messages LEFT JOIN users on users.id=messages.receiver WHERE sender=$uid AND messages.delbysender='no' ORDER BY added DESC");
                   if (!$res || mysql_num_rows($res) == 0)
                     {
                      print("\n</tr><tr><td class=lista colspan=5 align=center>".NO_MESSAGES."</td></tr>");
                     }
                   else {
                       print("\n<td class=\"header\" align=\"center\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','msg[]',this.checked)\" /></td></tr>");
                        while ($result=mysql_fetch_array($res))
                              print("\n<tr><td class=lista align=center>".unesc($result["readed"])."</td>
                              <td class=lista align=center><a href=userdetails.php?id=".$result["receiver"].">".unesc($result["receivername"])."</a></td>
                              <td class=lista align=center>".get_date_time($result["added"])."</td>
                              <td class=lista align=center><a href=usercp.php?do=pm&action=read&uid=$uid&id=$result[id]&what=outbox>".format_comment(unesc($result["subject"]))."</a></td>
                              <td class=\"lista\" align=\"center\"><input type=\"checkbox\" name=\"msg[]\" value=\"".$result["id"]."\" /></td>
                              </tr>");
                        print("\n<tr>\n<td class=\"lista\" align=\"right\" colspan=\"5\"><input type=\"submit\" name=\"action\" value=\"Delete\" /></td></tr>");
                   }
                   print("\n</table></form>");
                   block_end();
                   print("<br />");
                   }
                   else
                  {
                   block_begin(MNU_UCP_IN);
                   print("\n<form action=\"usercp.php?do=pm&action=deleteall&messages=in&uid=$uid&type=in\" name=\"deleteall\" method=\"post\">");
                   print("\n<table class=lista width=100% align=center>");
                   print("\n<tr><td class=header align=center>".READED."</td><td class=header align=center>".SENDER."</td><td class=header align=center>".DATE."</td><td class=header align=center>".SUBJECT."</td>");
                   //$res=mysql_query("select messages.*, users.username as sendername FROM messages INNER JOIN users on users.id=messages.sender WHERE receiver=$uid ORDER BY added DESC");
                   $res = mysql_query("select messages.*, users.username as sendername FROM messages LEFT JOIN users on users.id=messages.sender WHERE receiver=$uid AND messages.delbyreceiver='no' ORDER BY added DESC");
                   if (!$res || mysql_num_rows($res) == 0)
                      print("\n</tr><tr><td class=lista colspan=5 align=center>".NO_MESSAGES."</td></tr>");
                   else {
                        print("\n<td class=\"header\" align=\"center\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','msg[]',this.checked)\" /></td></tr>");
                        while ($result = mysql_fetch_array($res))
                              print("\n<tr>
                              <td class=lista align=center>".unesc($result["readed"])."</td>
                              <td class=lista align=center><a href=userdetails.php?id=".$result["sender"].">".unesc($result["sendername"])."</a></td>
                              <td class=lista align=center>".get_date_time($result["added"])."</a></td>
                              <td class=lista align=center><a href=usercp.php?do=pm&action=read&uid=$uid&id=$result[id]&what=inbox>".format_comment(unesc($result["subject"]))."</a></td>
                              <td class=\"lista\" align=\"center\"><input type=\"checkbox\" name=\"msg[]\" value=\"".$result["id"]."\" /></td>
                              </tr>");
                        print("\n<tr>\n<td class=\"lista\" align=\"right\" colspan=\"5\"><input type=\"submit\" name=\"action\" value=\"Delete\" /></td></tr>");

                   }
                   //print("\n<tr><td class=lista colspan=2 align=center>".DELETE_ALL_READED."</td><td class=lista align=center colspan=3><a  onclick=\"return confirm('".AddSlashes(DELETE_CONFIRM)."')\" href=usercp.php?do=pm&action=deleteall&uid=$uid>".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td></tr>");
                   print("\n</table></form>");
                   block_end();
                   print("<br />");
                   }
        }
     elseif ($do = "pm" && $action == "read")
        {
            $id = intval($_GET["id"]);
            $what = $_GET["what"];
            if ($what == "inbox")
			   $res = mysql_query("select messages.*, messages.sender as userid, users.username as sendername FROM messages INNER JOIN users on users.id=messages.sender WHERE receiver=$uid AND messages.id=$id AND messages.delbyreceiver='no'");
            elseif ($what == "outbox")
			   $res = mysql_query("select messages.*, messages.receiver as userid, users.username as sendername FROM messages INNER JOIN users on users.id=messages.receiver WHERE sender=$uid AND messages.id=$id AND messages.delbysender='no'");
            block_begin(PRIVATE_MSG);
            if (!$res)
               err_msg(ERROR,BAD_ID);
            else
                {
                print("\n<table class=\"lista\" width=\"100%\" align=\"center\" cellpadding=\"2\">");
                $result = mysql_fetch_array($res);
                print("\n<tr><td width=30% rowspan=2 class=lista><a href=userdetails.php?id=".$result["userid"].">".unesc($result["sendername"])."</a><br />".get_date_time($result["added"])."<br />(".get_elapsed_time($result["added"])." ago)</td>");
                print("\n<td class=header>".SUBJECT.": ".format_comment(unesc($result["subject"]))."</td></tr>");
                print("\n<tr><td>".format_comment(unesc($result["msg"]))."</td></tr>");
                print("\n</table>");
                print("<br />");
                if ($what == "inbox")
                   {
                   print("\n<table class=lista width=100% align=center>");
                   print("\n<tr><td class=lista align=center><input onclick=\"location.href='usercp.php?do=pm&action=edit&what=quote&uid=$uid&id=$id'\" type=\"button\" value=\"".QUOTE."\"/></td><td class=lista align=center><input onclick=\"location.href='usercp.php?do=pm&action=edit&uid=$uid&id=$id'\" type=\"button\" value=\"".ANSWER."\"/></td><td class=lista align=center><input type=\"button\" onclick=\"location.href='usercp.php?do=pm&action=delete&messages=in&uid=$uid&id=$id'\" value=\"".DELETE."\"/></td></tr>");
                   print("\n</table>");
                   mysql_query("UPDATE messages SET readed='yes' WHERE id=$id");
                }
				elseif ($what == "outbox")
                   {
				   print("\n<table class=lista width=100% align=center>");
                   print("\n<tr><td class=lista align=center><input onclick=\"location.href='usercp.php?do=pm&action=edit&what=quote&uid=$uid&id=$id'\" type=\"button\" value=\"".QUOTE."\"/></td><td class=lista align=center><input onclick=\"location.href='usercp.php?do=pm&action=edit&uid=$uid&id=$id'\" type=\"button\" value=\"".ANSWER."\"/></td><td class=lista align=center><input type=\"button\" onclick=\"location.href='usercp.php?do=pm&action=delete&messages=out&uid=$uid&id=$id'\" value=\"".DELETE."\"/></td></tr>");
                   print("\n</table>");
				   }
             }
            print("<br />");
            block_end();
            print("<br />");

        }
     elseif ($do == "pm" && $action == "edit")
        {
            // if new pm will give id=0 and empty array
            if (isset($_GET['id']) && $_GET['id'])
                        $id = intval(0+$_GET['id']);
            else $id = 0;
            if (!isset($_GET['what'])) $_GET['what'] = '';
            if (!isset($_GET['to'])) $_GET['to'] = '';

            $res = mysql_query("select messages.*, users.username as sendername FROM messages INNER JOIN users on users.id=messages.sender WHERE receiver=$uid AND messages.id=$id");
            block_begin(PRIVATE_MSG);
            if (!$res)
               err_msg(ERROR,BAD_ID);
            else
                {
                print("\n<form method=post name=edit action=usercp.php?do=$do&action=post&uid=$uid&what=".htmlspecialchars($_GET["what"])."><table class=\"lista\" align=\"center\" cellpadding=\"2\">");
                $result = mysql_fetch_array($res);
				print("\n<tr><td class=header>".RECEIVER.":</td><td class=header><input type=\"text\" name=\"receiver\" value=\"".($_GET["what"]!="new" ? unesc($result["sendername"]):htmlspecialchars(urldecode($_GET["to"])))."\" size=\"40\" maxlength=\"40\" ".($_GET["what"]!="new" ? " readonly" : "")." />&nbsp;&nbsp;".($_GET["what"]=="new" ? "<a href=\"javascript:popusers('searchusers.php');\">".FIND_USER."</a>" : "")."</td></tr>");
//			    print("\n<tr><td class=header>".RECEIVER.":</td><td class=header><input type=\"text\" name=\"receiver\" value=\"".($_GET["what"]!="new" ? unesc($result["sendername"]):urldecode($_GET["to"]))."\" size=\"40\" maxlength=\"40\" ".($_GET["what"]!="new" ? " readonly" : "")." />&nbsp;&nbsp;".($_GET["what"]=="new" ? "<a href=\"javascript:popusers('searchusers.php');\">".FIND_USER."</a>" : "")."</td></tr>");
                print("\n<tr><td class=header>".SUBJECT.":</td><td class=header><input type=\"text\" name=\"subject\" value=\"".($_GET["what"]!="new" ? (strpos(unesc($result["subject"]), "Re:")===false?"Re:":"").unesc($result["subject"]):"")."\" size=\"40\" maxlength=\"40\" /></td></tr>");
                print("\n<tr><td colspan=2>");
                print(textbbcode("edit","msg",($_GET["what"]=="quote" ? "[quote=".htmlspecialchars($result["sendername"])."]".unesc($result["msg"])."[/quote]" : "")));
                print("\n</td></tr>");
                print("\n</table>");
                print("<br />");
                print("\n<table class=lista width=100% align=center>");
                print("\n<tr><td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" /></td>");
                print("<td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_PREVIEW."\" /></td>");
                print("<td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td></tr>");
                print("\n</table></form>");
            }
            print("<br />");
            block_end();
            print("<br />");

        }
     elseif ($do == "pm" && $action == "delete" && $messages == "in")
        {
            $id=intval($_GET["id"]);
            mysql_query("UPDATE messages SET delbyreceiver='yes' WHERE receiver=$uid AND id=$id") or die(mysql_error());
            redirect("usercp.php?uid=$uid&do=pm&action=list&what=inbox");
        }
     elseif ($do == "pm" && $action == "delete" && $messages == "out")
        {
            $id=intval($_GET["id"]);
            mysql_query("UPDATE messages SET delbysender='yes' WHERE sender=$uid AND id=$id") or die(mysql_error());
            redirect("usercp.php?uid=$uid&do=pm&action=list&what=inbox");
        }
     elseif ($do == "pm" && $action == "deleteall" && $messages == "in")
        {
        // MODIFIED DELETE ALL VERSION BY gAnDo
            if (isset($_GET["type"]))
                $what = $_GET["type"];
            else
                {
                redirect("usercp.php?uid=$uid&do=pm&action=list&what=inbox");
                exit;
                }
           foreach($_POST["msg"] as $selected=>$msg)
                  @mysql_query("UPDATE messages SET delbyreceiver='yes' WHERE id=\"$msg\"");
            //mysql_query("DELETE FROM messages WHERE receiver=$uid AND readed='yes'") or die(mysql_error());
           redirect("usercp.php?uid=$uid&do=pm&action=list&what=inbox");
        }
     elseif ($do == "pm" && $action == "deleteall" && $messages == "out")
        {
        // MODIFIED DELETE ALL VERSION BY gAnDo
            if (isset($_GET["type"]))
                $what = $_GET["type"];
            else
                {
                redirect("usercp.php?uid=$uid&do=pm&action=list&what=outbox");
                exit;
                }
           foreach($_POST["msg"] as $selected=>$msg)
                  @mysql_query("UPDATE messages SET delbysender='yes' WHERE id=\"$msg\"");
            //mysql_query("DELETE FROM messages WHERE receiver=$uid AND readed='yes'") or die(mysql_error());
           redirect("usercp.php?uid=$uid&do=pm&action=list&what=outbox");
        }
     elseif ($do == "pm" && $action == "post")
        {
            if ($_POST["confirm"] == FRM_CONFIRM)
               {
               $res = mysql_query("SELECT id FROM users WHERE username=".sqlesc($_POST["receiver"]));
               if (!$res || mysql_num_rows($res) == 0)
                  err_msg(ERROR,ERR_USER_NOT_FOUND);
               else
                   {
                   $result = mysql_fetch_array($res);
                   $subject = sqlesc($_POST["subject"]);
                   $msg = sqlesc($_POST["msg"]);
                   $rec = $result["id"];
                   $send=  $CURUSER["uid"];
// cybernet left
				   if ($rec == 1 || $rec == 0 || $rec == $send)
 	  	            err_msg(ERROR,ERR_PM_GUEST);
 	  	           else {
                   if ($subject == "''")
                      $subject = "'no subject'";
                   mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES ($send,$rec,UNIX_TIMESTAMP(),$subject,$msg)") or die(mysql_error());
                   redirect("usercp.php?uid=$uid&do=pm&action=list");
				   }
               }
			   }
            elseif ($_POST["confirm"] == FRM_PREVIEW)
                {
                block_begin(PRIVATE_MSG);
                block_begin(FRM_PREVIEW);
                print("<table width=100% align=center class=lista><tr><td class=lista align=center>" . format_comment(unesc($_POST["msg"])) . "</td></tr>\n");
                print("</table>");
                block_end();
                print("<br />");
                print("\n<form method=post name=edit action=usercp.php?do=$do&action=post&uid=$uid&what=".htmlspecialchars($_GET["what"])."><table class=\"lista\" align=\"center\" cellpadding=\"2\">");
                print("\n<tr><td class=header>".RECEIVER.":</td><td class=header><input type=\"text\" name=\"receiver\" value=\"".htmlspecialchars(unesc($_POST["receiver"]))."\" size=\"40\" maxlength=\"40\" />&nbsp;&nbsp;".($_GET["what"]=="new" ? "<a href=\"javascript:popusers('searchusers.php');\">".FIND_USER."</a>" : "")."</td></tr>");
                print("\n<tr><td class=header>".SUBJECT.":</td><td class=header><input type=\"text\" name=\"subject\" value=\"".htmlspecialchars(unesc($_POST["subject"]))."\" size=\"40\" maxlength=\"40\" /></td></tr>");
                print("\n<tr><td colspan=2>");
                print(textbbcode("edit","msg",htmlspecialchars(unesc($_POST["msg"]))));
                print("\n</td></tr>");
                print("\n</table>");
                print("<br />");
                print("\n<table class=lista width=100% align=center>");
                print("\n<tr><td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" /></td>");
                print("<td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_PREVIEW."\" /></td>");
                print("<td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td></tr>");
                print("\n</table></form>");
                block_end();
                }
               else
                   redirect("usercp.php?uid=$uid&do=pm&action=list");
        }
     elseif ($do=="pwd" && $action=="change")
        {
            block_begin(MNU_UCP_CHANGEPWD);
            print("\n<form method=\"post\" name=\"password\" action=\"usercp.php?do=pwd&action=post&uid=$uid\"><table class=\"lista\" width=\"100%\" align=\"center\">");
            print("\n<tr><td class=header>".OLD_PWD."</td><td class=lista><input type=\"password\" name=\"old_pwd\" size=\"40\" maxlength=\"40\" /></td></tr>");
            print("\n<tr><td class=header>".USER_PWD."</td><td class=lista><input type=\"password\" name=\"new_pwd\" size=\"40\" maxlength=\"40\" /></td></tr>");
            print("\n<tr><td class=header>".USER_PWD_AGAIN."</td><td class=lista><input type=\"password\" name=\"new_pwd1\" size=\"40\" maxlength=\"40\" /></td></tr>");
            print("\n</table>");
            print("<br />");
            print("\n<table class=lista width=100% align=center>");
            print("\n<tr><td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\"/></td><td class=lista align=center><input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\"/></td></tr>");
            print("\n</table></form>");
            print("<br />");
            block_end();
            print("<br />");
        }
     elseif ($do=="pwd" && $action=="post")
        {
        if ($_POST["confirm"]==FRM_CONFIRM)
           {
            if ($_POST["old_pwd"]=="")
               err_msg(ERROR,INS_OLD_PWD);
            elseif ($_POST["new_pwd"]=="")
               err_msg(ERROR,INS_NEW_PWD);
            elseif ($_POST["new_pwd"]!=$_POST["new_pwd1"])
               err_msg(ERROR,DIF_PASSWORDS);
            else
                {
                $respwd = mysql_query("SELECT * FROM users WHERE id=$uid AND password='".md5($_POST["old_pwd"])."' AND username=".sqlesc($CURUSER["username"])."");
                if (!$respwd || mysql_num_rows($respwd)==0)
                   err_msg(ERROR,ERR_RETR_DATA);
                else {
                    mysql_query("UPDATE users SET password='".md5($_POST["new_pwd"])."' WHERE id=$uid AND password='".md5($_POST["old_pwd"])."' AND username=".sqlesc($CURUSER["username"])."") or die(mysql_error());
                    print("<p align=center><b>".PWD_CHANGED."</b><br /><br />");
                    print(NOW_LOGIN."<br /><br />");
                    print("<a href=\"login.php\">Go</a><br /></p>");
                    }
                }
            }
            else
                redirect("usercp.php?uid=$uid");
        }
     elseif ($do=="user" && $action=="change")
        {
        block_begin(ACCOUNT_EDIT);
?>
        <center>
        <p>
        <form name="utente" method="post" action="usercp.php?do=user&action=post&uid=<?php echo $uid; ?>">
        <table width="60%" border="0" class="lista">
        <tr>
           <td align=left class="header"><?php echo USER_NAME ?>: </td>
           <td align="left" class="lista"><?php echo $CURUSER["username"]; ?>&nbsp;&nbsp;&nbsp;[<a href='rename.php'>Change</a>]&nbsp;[<a href='deleteme.php'>Delete me</a>]</td>
           <!--avatar-->
           <?php
           if ($CURUSER["avatar"] && $CURUSER["avatar"]!="")
               print("<td class=lista align=center valign=top rowspan=3><img width=150 border=0 src=".unesc($CURUSER["avatar"])." /></td>");
           ?>
        </tr>
        <tr>
           <td align=left class="header"><?php echo AVATAR_URL;?>: </td>
           <td align="left" class="lista"><input type="text" size="40" name="avatar" maxlength="100" value="<?php echo unesc($CURUSER["avatar"]); ?>"/><br><small><a href=avatar.php>Avatar Upload</a></td>
        </tr>
		<tr>
           <td align=left class="header">Signature:</td><?php $isignature = unesc($CURUSER["signature"]);
         print("\n\t<td align=left class=\"lista\"><textarea cols=38 rows=6 name=signature value='".$dati["signature"]."'>$isignature</textarea></td></tr>\n");
           ?>
        <tr>
           <td align=left class="header"><?php echo USER_EMAIL?>:</td>
           <td align="left" class="lista"><input type="text" size="30" name="email" maxlength="30" value="<?php echo unesc($CURUSER["email"]);?>"/></td>
        </tr>
        <?php
        // Reverify Mail Hack by Petr1fied - Start --->
        if ($VALIDATION=="user") {
        // Display a message informing users that they will have
        // to verify their e-mail address if they attempt to change it ?>
        <tr>
           <td align=left class="header"></td>
           <td align="left" class="lista" colspan=2><?php echo REVERIFY_MSG ?></td>
        </tr>
        <?php
        } // <--- Reverify Mail Hack by Petr1fied - End ?>
<!-- START DOWNLOAD / UPLOAD HACK by VIRUS -->
<?php		
$uid=$CURUSER["uid"];
		$rdu=mysql_query("SELECT * from users WHERE id = $uid"); 
 $csp=mysql_result($rdu,0,"fel"); 
 $le=mysql_result($rdu,0,"letoltesisebesseg");

		?>

        <tr>
           <td align=left class="header">Upload speed:</td>
           <td align="left" class="lista" colspan="2"><input type="text" size="30" name="csp" maxlength="100" value="<?php echo $csp;?>"/>
           kb/s</td>
        </tr>
        <tr>
           <td align=left class="header">Download speed:</td>
           <td align="left" class="lista" colspan="2"><input type="text" size="30" name="le" maxlength="100" value="<?php echo $le;?>"/>
           kb/s</td>
        </tr>
<!-- END DOWNLOAD / UPLOAD HACK by VIRUS -->
<!-- GENDER/AGE Hack Start -->
		<tr>
			<td align=left class="header"><?php echo GENDER; ?>:</td>
			<td align="left" class="lista" colspan="2">
			<label>
				<input name="gen" type="radio" value="1" <?php echo ($CURUSER["gender"]==1?"checked=\"checked\"":""); ?> /><?php echo MALE; ?>
			</label>&nbsp;&nbsp;
			<label>
				<input name="gen" type="radio" value="2" <?php echo ($CURUSER["gender"]==2?"checked=\"checked\"":""); ?> /><?php echo FEMALE; ?>
			</label>
			</td>
		</tr>
		<tr>
			<td align=left class="header"><?php echo AGE; ?>:</td>
			<td align="left" class="lista" colspan="2"><input type="text" size="3" name="age" maxlength="3" value="<?php echo $CURUSER["age"]; ?>"/></td>
		</tr>
<!-- GENDER/AGE Hack End -->
           <?php
           $lres=language_list();
           print("<tr>\n\t<td align=left class=\"header\">".USER_LANGUE.":</td>");
           print("\n\t<td align=\"left\" class=\"lista\" colspan=2><select name=language>");
           foreach($lres as $langue)
             {
               $option="\n<option ";
               if ($langue["id"]==$CURUSER["language"])
                  $option.="selected=selected ";
               $option.="value=".$langue["id"].">".unesc($langue["language"])."</option>";
               print($option);
             }
           print("</select></td>\n</tr>");

           $sres=style_list();
           print("<tr>\n\t<td align=left class=\"header\">".USER_STYLE.":</td>");
           print("\n\t<td align=\"left\" class=\"lista\" colspan=2><select name=style>");
           foreach($sres as $style)
             {
               $option="\n<option ";
               if ($style["id"]==$CURUSER["style"])
                  $option.="selected=selected ";
               $option.="value=".$style["id"].">".unesc($style["style"])."</option>";
               print($option);
             }
           print("</select></td>\n</tr>");
		?>
		   <tr>

           <td align=left class="header">XXX</td>

           <td align="left" class="lista">

			  <label>

			  <?php 
			$ttr=$CURUSER['showporn'];

			  

			  if($ttr=='yes') {

			  echo "<input name=\"showporn\" type=\"radio\" value=\"yes\" checked=\"checked\" />

			  ".YES."  </label>

			  <input name=\"showporn\" type=\"radio\" value=\"no\" />

			".NO." ";

			} else {

			   echo "<input name=\"showporn\" type=\"radio\" value=\"yes\" />

			  ".YES."  </label>

			  <input name=\"showporn\" type=\"radio\" value=\"no\" checked=\"checked\"/>

			".NO." ";

			} ?>

		   </td>

        </tr>
		<?php	
        // flag hack
        $fres=flag_list();
        print("<tr>\n\t<td align=left class=\"header\">".PEER_COUNTRY.":</td>");
        print("\n\t<td align=\"left\" class=\"lista\" colspan=2><select name=flag>\n<option value='0'>--</option>");
        foreach($fres as $flag)
          {
          $option="\n<option ";
              if ($flag["id"]==$CURUSER["flag"])
                $option.="selected=selected ";
              $option.="value=".$flag["id"].">".unesc($flag["name"])."</option>";
              print($option);
          }
        print("</select></td>\n</tr>");

           $tres=timezone_list();
           print("<tr>\n\t<td align=left class=\"header\">".TIMEZONE.":</td>");
           print("\n\t<td align=\"left\" class=\"lista\" colspan=\"2\"><select name=\"timezone\">");
           foreach($tres as $timezone)
             {
               $option="\n<option ";
               if ($timezone["difference"]==$CURUSER["time_offset"])
                  $option.="selected=selected ";
               $option.="value=".$timezone["difference"].">".unesc($timezone["timezone"])."</option>";
               print($option);
             }
           print("</select></td>\n</tr>");
           if ($FORUMLINK=="" || $FORUMLINK=="internal")
        {
        // topics per page
        ?>
    <tr>
        <td align=left class="header"><?php echo TOPICS_PER_PAGE;?>: </td>
        <td align="left" class="lista" colspan=2><input type="text" size="3" name="topicsperpage" maxlength="3" value="<?php echo $CURUSER["topicsperpage"]; ?>"/></td>
    </tr>
        <!-- posts per page -->
    <tr>
        <td align=left class="header"><?php echo POSTS_PER_PAGE;?>: </td>
        <td align="left" class="lista" colspan=2><input type="text" size="3" name="postsperpage" maxlength="3" value="<?php echo $CURUSER["postsperpage"]; ?>"/></td>
    </tr>
    <?php
        }
        // torrents per page
        ?>
    <tr>
        <td align=left class="header"><?php echo TORRENTS_PER_PAGE;?>: </td>
        <td align="left" class="lista" colspan=2><input type="text" size="3" name="torrentsperpage" maxlength="3" value="<?php echo $CURUSER["torrentsperpage"]; ?>"/></td>
    </tr>
<!-- ParkHack Start -->
<tr><td align=left class="header"><?php echo APARKED;?>: </td>
          <td align="left" class="lista" colspan=2>
		          <strong>
				  <?php $uid=$CURUSER['uid'];
				  		$r=mysql_query("SELECT parked from users where id = $uid");
				  		$p=mysql_result($r,0,"parked");
						?>
					<select name="park" id="park">
					  <?php if($p!=0) { echo"<option value=\"1\" selected=\"selected\">Yes</option>
					  					<option value=\"0\">No</option>"; 
					 } else { echo "<option value=\"1\">Yes</option>
					  					<option value=\"0\" selected=\"selected\">No</option>";
							} ?>
					</select>
					</strong>
		  
		  </td>
          </tr>
<!-- ParkHack End -->
	     <!-- Password confirmation required to update user record -->
 	  	     <tr>
 	  	         <td align=left class="header"><?=USER_PWD?>: </td>
 	  	         <td align="left" class="lista" colspan=2><input type="password" size="40" name="passconf" value=""/><?php echo MUST_ENTER_PASSWORD; ?></td>
 	  	     </tr>
 	  	 <!-- Password confirmation required to update user record -->
        <tr>
           <td align=center class="header" colspan="3">
        <?php
        print("<input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td>");
        ?>
        </tr>
        </table>
        </form>
        </center>
        </p>
        <?php
        print("<br />");
        block_end();
        print("<br />");
        }
     elseif ($do=="user" && $action=="post")
        {
        if ($_POST["confirm"]==FRM_CONFIRM)
           {
           $idlangue=intval(0+$_POST["language"]);
           $idstyle=intval(0+$_POST["style"]);
           $email=AddSlashes($_POST["email"]);
           $avatar=AddSlashes($_POST["avatar"]);
		   $signature=AddSlashes($_POST["signature"]);
           $idflag=intval(0+$_POST["flag"]);
           $timezone=intval($_POST["timezone"]);
		   
	            // Password confirmation required to update user record
 	  	            (isset($_POST["passconf"])) ? $password=md5($_POST["passconf"]) : $password="";
 	  	 
 	  	            $res=mysql_query("SELECT password FROM users WHERE id=".$CURUSER["uid"]);
 	  	            if(mysql_num_rows($res)>0)
 	  	                $user=mysql_fetch_assoc($res);
 	  	 
 	  	            if(!isset($user) || $password=="" || $user["password"]!=$password)
 	  	            {
 	  	                err_msg(ERROR,ERR_PASS_WRONG);
 	  	                block_end();
 	  	                stdfoot();
 	  	                exit();
 	  	            }
 	  	        // Password confirmation required to update user record

           if ($email=="")
              err_msg(ERROR,ERR_NO_EMAIL);
           else
               {
               // Reverify Mail Hack by Petr1fied - Start --->
               if ($VALIDATION=="user") {
                   // Send a verification e-mail to the e-mail address they want to change it to
                   if (($email!="")&&($email!=$CURUSER["email"])) {
                       $id=$CURUSER["uid"];
                       // Generate a random number between 10000 and 99999
                       $floor = 100000;
                       $ceiling = 999999;
                       srand((double)microtime()*1000000);
                       $random = rand($floor, $ceiling);

                       // Update the members record with the random number and store the email they want to change to
                       @mysql_query("UPDATE users SET random='".$random."', temp_email='".$email."' WHERE id='".$id."'");

                       // Send the verification email
                       ini_set("sendmail_from","");
                       if (mysql_errno()==0)
                       mail($email,EMAIL_VERIFY,EMAIL_VERIFY_MSG."\n\n".$BASEURL."/usercp.php?do=verify&action=changemail&newmail=$email&uid=$id&random=$random","From: $SITENAME <$SITEEMAIL>");
                       }
               }
               $set=array();

               if ($VALIDATION!="user") {
                   if ($email!="")
                   $set[]="email='$email'";
                }
                // <--- Reverify Mail Hack by Petr1fied - End
               if ($idlangue>0)
                  $set[]="language=$idlangue";
               if ($idstyle>0)
                  $set[]="style=$idstyle";
               if ($idflag>0)
                  $set[]="flag=$idflag";

               $set[]="time_offset='$timezone'";
               $set[]="avatar='$avatar'";
			   $set[]="signature='$signature'";
			   	if($_POST["showporn"]=='yes'||$_POST["showporn"]=='no'){
			   $set[]="showporn='".$_POST["showporn"]."'";
		    	}
			   $set[]="fel=".intval(0+$_POST["csp"]);
			   $set[]="letoltesisebesseg=".intval(0+$_POST["le"]);
               $set[]="topicsperpage=".intval(0+$_POST["topicsperpage"]);
               $set[]="postsperpage=".intval(0+$_POST["postsperpage"]);
               $set[]="torrentsperpage=".intval(0+$_POST["torrentsperpage"]);
// GENDER/AGE Hack Start
               $set[]="age=".intval(0+$_POST["age"]);
			   $set[]="gender=".intval(0+$_POST["gen"]);
// GENDER/AGE Hack End

               $updateset=implode(",",$set);

               // Reverify Mail Hack by Petr1fied - Start --->
               // If they've tried to change their e-mail, give them a message telling them as much
               if (($email!="")&&($VALIDATION=="user")&&($email!=$CURUSER["email"]))
                  {
                  block_begin(EMAIL_VERIFY_BLOCK);
                  print(EMAIL_VERIFY_SENT1." $email ".EMAIL_VERIFY_SENT2."<a href=$BASEURL>".MNU_INDEX."</a><br /><br /></center>");
                  block_end();
                  print("<br /><br />");
                  }
               elseif ($updateset!="")
               // <--- Reverify Mail Hack by Petr1fied - End
// ParkHack Start
			   $updateset=implode(",",$set);
				$park=$_POST['park'];
				if(!is_numeric($park)) {        err_msg(ERROR,"Wtf are ya trying to do?");
					   stdfoot();
					   exit;
				}
               if ($updateset!="")
                  {
                  mysql_query("UPDATE users SET $updateset WHERE id=$uid") or die(mysql_error());
				  if($park==0) { 
				  		
				  		$r=mysql_query("SELECT parked from users where id = $uid");
				  		$p=mysql_result($r,0,"parked");
						if ($p!=0) {
							mysql_query("UPDATE users SET id_level=$p WHERE id=$uid") or die(mysql_error()); 
							mysql_query("UPDATE users SET parked='0' WHERE id=$uid") or die(mysql_error()); 
						}
				  } else {
				  		$r=mysql_query("SELECT id_level from users where id = $uid");
						$cc=mysql_result($r,0,"id_level");
						$r=mysql_query("UPDATE users SET parked = $cc where id = $uid");
						$r=mysql_query("UPDATE users SET id_level = 13 where id = $uid");
				  }
                  print("<p align=center><b>".INF_CHANGED."</b><br /><br />");
                  print("<a href=\"usercp.php?uid=$uid\">".BCK_USERCP."</a><br /></p>");
                  }
// BackUP Lines Start
//               if ($updateset!="")
//                  {
//                  mysql_query("UPDATE users SET $updateset WHERE id=$uid") or die(mysql_error());
//                  print("<p align=center><b>".INF_CHANGED."</b><br /><br />");
//                  print("<a href=\"usercp.php?uid=$uid\">".BCK_USERCP."</a><br /></p>");
//                  }
// ParkHack End
              }
           }
           else
               redirect("usercp.php?uid=$uid");
        }

// Reverify Mail Hack by Petr1fied - Start --->
// Update the members e-mail account if the validation link checks out
// ==========================================================================================
    // If both "do=verify" and "action=changemail" are in the url
    elseif ($do=="verify" && $action=="changemail")
       {
       // Get the other values we need from the url
       $newmail=$_GET["newmail"];
       $id=$_GET["uid"];
       $random=$_GET["random"];
       $idlevel=$CURUSER["id_level"];

       // Get the members random number, current email and temp email from their record
       $getacc=mysql_fetch_assoc(mysql_query("SELECT random, email, temp_email from users WHERE id=".$id));
       $oldmail=$getacc["email"];
       $dbrandom=$getacc["random"];
       $mailcheck=$getacc["temp_email"];

       // Start a block to output the data to
       block_begin("Update email address");

       // If the random number in the url matches that in the member record
       if ($random==$dbrandom) {

           // Verify the email address in the url is the address we sent the mail to
           if ($newmail!=$mailcheck) {
             err_msg(ERROR,NOT_MAIL_IN_URL); block_end(); exit();
           }

            // Update their tracker member record with the now verified email address
            @mysql_query("UPDATE users SET email='".$newmail."', random=0 WHERE id='".$id."'");
            // Print a message stating that their email has been successfully changed
            print(REVERIFY_CONGRATS1."$oldmail".REVERIFY_CONGRATS2."$newmail".REVERIFY_CONGRATS3."<a href=$BASEURL>".MNU_INDEX."</a><br /><br /></center>");
            // If the member clicking the link is validating...
            if ($idlevel==2)
                // ...we may as well upgrade their rank to member whilst we're at it.
                @mysql_query("UPDATE users SET id_level=3 WHERE id='".$id."'");
                }
           // If the random number in the url is incorrect print an error message
           else print(REVERIFY_FAILURE."<a href=$BASEURL>".MNU_INDEX."</a><br /><br /></center>");
           // End the block and add a couple of linespaces afterwards.
           block_end();
           print("<br /><br />");
}
// <--- Reverify Mail Hack by Petr1fied - End

    elseif ($do=="pid_c" && $action=="change")
       {

           block_begin(CHANGE_PID);
           $result=mysql_query("SELECT pid FROM users WHERE id=".$CURUSER['uid']);
           $row = mysql_fetch_Assoc($result);
           $pid=$row["pid"];
           if (!$pid)
           {$pid=md5($CURUSER['uid']+$CURUSER['username']+$CURUSER['password']+$CURUSER['lastconnect']);
           $res=mysql_query("UPDATE users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'");
           }
           print("\n<form method=\"post\" name=\"pid\" action=\"usercp.php?do=pid_c&action=post&uid=$uid\"><table class=\"lista\" width=\"100%\" align=\"center\">");
           print("\n<tr><td class=header>".PID.":</td><td class=lista>".$pid."</td></tr>");
           print("\n<tr><td class=header align=center colspan=2><input type=\"submit\" name=\"confirm\" value=\"Reset PID\"/>&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\"/></td></tr>");
           print("\n</table></form>");
           print("<br />");
           block_end();
           print("<br />");
       }
    elseif ($do=="pid_c" && $action=="post")
       {
       if ($_POST["confirm"]=="Reset PID"){
          $pid=md5($CURUSER['uid']+$CURUSER['username']+$CURUSER['password']+$CURUSER['lastconnect']);
          $res=mysql_query("UPDATE users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'");
          if ($res)
             redirect("usercp.php?uid=$uid");
          else
              err_msg(ERROR,NOT_POSS_RESET_PID."<br /><a href=\"usercp.php?uid=$uid\">".HOME."</a><br />");
          }
          else {
               redirect("usercp.php?uid=$uid");
               }
        }
    // begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
	elseif ($do=="invites")
	{
		if (!$INVITESON)
		{
			err_msg(ERROR,INVITES_OFF);
			print("<br>");
			block_end();
			stdfoot();
			exit();
		}
		elseif ($action=="read")
		{
			$id = 0 + $_GET["uid"];
			
			$res = mysql_query("SELECT invites FROM users WHERE users.id = '$id'") or sqlerr();
			$inv = mysql_fetch_assoc($res);
			
			block_begin(MEMBERS_INVITED_BY." ".$CURUSER['username']);
			$rel = mysql_query("SELECT COUNT(*) FROM users WHERE users.invited_by='$id' AND users.id_level='3'") or sqlerr();
			$arro = mysql_fetch_row($rel);
			$number = $arro[0];
				
			$ret = mysql_query("SELECT id, username, email, uploaded, downloaded, id_level FROM users WHERE invited_by = '$id' AND users.id_level='3'") or sqlerr();
			$num = mysql_num_rows($ret);
			
			print("<table width=100% class='lista' align='center'>");
			if ($inv["invites"] != 0)
			{
				print("<tr><td align='center' class='lista' colspan=\"6\"><a href=\"usercp.php?do=invites&action=new&uid=$id\">".SEND_INVITE." (<font color=\"#FF0000\"><b>$inv[invites] ".REMAINING.($inv["invites"]>1?S:"")."</b></font>)</a></td></tr>");
			}
			print("<tr><td align='center' class='header' colspan=\"6\"><b>".CURRENT_INVITES_CONFIRMED."</b> ($number)</td></tr>");
			
			if(!$num)
			{
				print("<tr><td align=center class=\"lista\">".NO_INVITES_YET."</td></tr>");
			}
			else
			{
				print("<tr><td align=center class=header><b>".USER_NAME."</b></td><td align=center class=header><b>".EMAIL."</b></td><td align=center class=header><b>".UPLOADED."</b></td><td align=center class=header><b>".DOWNLOADED."</b></td><td align=center class=header><b>".RATIO."</b></td><td align=center class=header><b>".STATUS."</b></td></tr>");
				for ($i = 0; $i < $num; ++$i)
				{
					$arr = mysql_fetch_assoc($ret);
					if ($arr["downloaded"] > 0)
					{
						$ratio = number_format($arr["uploaded"] / $arr["downloaded"], 3);
					}
					else
					{
						if ($arr["uploaded"] > 0)
						{
							$ratio = "Inf.";
						}
						else
						{
							$ratio = "---";
						}
					}
					$status = "<font color=#1f7309><b>".CONFIRMED."</b></font>";	    	  
					print("<tr><td align=center class=lista><a href=userdetails.php?id=$arr[id]>$arr[username]</a></td><td align=center class=lista>$arr[email]</td><td align=center class=lista>" . makesize($arr[uploaded]) . "</td><td align=center class=lista>" . makesize($arr[downloaded]) . "</td><td align=center class=lista>$ratio</td><td align=center class=lista>$status</td></tr>");
				}
			}
			print("</table>");
			block_end();
			
			if ($VALID_INV==true)
			{
				block_begin(INVITES_NEED_CONFIRM);
				$rel = mysql_query("SELECT COUNT(*) FROM users WHERE invited_by='$id' AND id_level='2'") or sqlerr();
				$arro = mysql_fetch_row($rel);
				$number = $arro[0];
					
				$ret = mysql_query("SELECT id, username, email, uploaded, downloaded, id_level FROM users WHERE invited_by = '$id' AND id_level='2'") or sqlerr();
				$num = mysql_num_rows($ret);
				
				print("<table width=100% class='lista' align='center'>");
				print("<form method=post action=usercp.php?do=invites&action=confirm&uid=$id>");
				print("<tr><td align='center' class='header' colspan=\"4\"><b>".CURRENT_INVITES_NEED_CONFIRM."</b> ($number)</td></tr>");
				
				if(!$num)
				{
					print("<tr><td align=center class=\"lista\">".NO_NEED_CONFIRM_YET."</td></tr>");
				}
				else
				{
					print("<tr><td align=center class=header><b>".USER_NAME."</b></td><td align=center class=header><b>".EMAIL."</b></td><td align=center class=header><b>".STATUS."</b></td><td align=center class=header><b>".FRM_CONFIRM."</b></td></tr>");
					for ($i = 0; $i < $num; ++$i)
					{
						$arr = mysql_fetch_assoc($ret);
						$status = "<font color=#ca0226><b>".PENDING."</b></font>";	    	  
						print("<tr><td align=center class=lista><a href=userdetails.php?id=$arr[id]>$arr[username]</a></td><td align=center class=lista>$arr[email]</td><td align=center class=lista>$status</td>");
						print("<td align=center class=lista><input type=\"checkbox\" name=\"conusr[]\" value=\"" . $arr["id"] . "\" /></td></tr>");
					}
						print("<tr><td align=center class=lista colspan=\"4\"><input type=submit value=\"".FRM_CONFIRM."\" style='height: 20px'></td></tr>");
				}
				print("</form></table>");
				block_end();
			}
			
			block_begin(INVITES_OUT);	
				$rul = mysql_query("SELECT COUNT(*) FROM invites WHERE inviter = '$id'") or sqlerr();
				$arre = mysql_fetch_row($rul);
				$number1 = $arre[0];
				
				
				$rer = mysql_query("SELECT invitee, hash, time_invited FROM invites WHERE inviter = '$id'") or sqlerr();
				$num1 = mysql_num_rows($rer);
		
				print("<table width=100% class='lista' align='center'>");
				print("<tr><td align='center' class='header' colspan=\"3\"><b>".CURRENT_INVITES_OUT."</b> ($number1)</td></tr>");
				
				if(!$num1)
				{
					print("<tr><td align=center class=\"lista\">".NO_INVITES_OUT."</td></tr>");
				}
				else
				{
					print("<tr><td align=left class=header><b>".EMAIL."</b></td><td align=left class=header><b>".INFO_HASH."</b></td><td align=left class=header><b>".SEND_DATE."</b></td></tr>");
					for ($i = 0; $i < $num1; ++$i)
					{
						$arr1 = mysql_fetch_assoc($rer);
						print("<tr><td align=left class=lista>$arr1[invitee]</td><td align=left class=lista>$arr1[hash]</td><td align=left class=lista>$arr1[time_invited]</td></tr>");
					}
				}
				print("</table>");
			block_end();
			print("<br>");
		}
		elseif ($action=="new")
		{
			$id = 0 + $_GET["uid"];
			
			$res = mysql_query("SELECT invites FROM users WHERE users.id = '$id'") or sqlerr();
			$inv = mysql_fetch_assoc($res);
			
			$ret = mysql_query("SELECT username FROM users WHERE id = $id") or sqlerr();
			$arr = mysql_fetch_assoc($ret); 
			  
			$hash  = md5(mt_rand(1,10000));
			$invitername = $arr["username"];
			
			if ($inv["invites"] != 0)
			{
				block_begin(SEND_INVITE);
					print("<table width=100% class='lista' align='center'>");
					print("<form method=post action=usercp.php?do=invites&action=takeinvite&uid=$id>");
					print("<tr><td align=center class=lista colspan=\"2\"><b>".INVITE_SOMEONE_TO." ($inv[invites] ".INVITATION.($inv["invites"]>1?S:"")." ".REMAINING.($inv["invites"]>1?S:"").")</b></td></tr>");
					print("<tr><td align=left class=header>".EMAIL."</td><td class='lista'><input type=text size=40 name=email></td></tr>");
					print("<tr><td align=left class=header>".MESSAGE."</td><td class='lista'><textarea name=body rows=6 cols=80></textarea></td></tr>");
					print("<tr><td align=center class=lista colspan=\"2\"><input type=submit value=\"".FRM_CONFIRM."\" style='height: 20px'></td></tr>");
					print("<input type=hidden name=hash value=\"$hash\">");
					print("<input type=hidden name=invitername value=\"$invitername\">");
					print("</form></table>");
				block_end();
			}
			else
			{
				block_begin(SEND_INVITE);
					err_msg(ERROR,NO_INV);
				block_end();
			}
			print("<br>");
		}
		elseif ($action=="confirm")
		{
			$id = 0 + $_GET["uid"];
			
			if (isset($_POST[conusr]))
			{
				$res = mysql_query ("SELECT id, email FROM users WHERE id_level='2' AND id IN (" . implode(", ", $_POST[conusr]) . ")");
				while ($arr = mysql_fetch_assoc($res))
				{
					mysql_query ("UPDATE users SET id_level='3' WHERE id = $arr[id]") or sqlerr();
					$email=$arr["email"];
	
					mail($email,"$SITENAME ".ACCOUNT_CONFIRMED."",INVIT_MSGCONFIRM,"From: $SITENAME <$SITEEMAIL>");
				}
			}
			else
			{
				err_msg(ERROR,ERR_MISSING_DATA);
				print("</table>");
				stdfoot();
				exit;
			}
			redirect("usercp.php?do=invites&action=read&uid=$id");
		}
		elseif ($action=="takeinvite")
		{
			$id = 0 + $_GET["uid"];
			$hash = $_POST["hash"];
			$invitername = $_POST["invitername"];
			
			$email = unesc($_POST["email"]);
			if(!$email)
				{
				block_begin(ERR_MISSING_DATA);
				err_msg(ERROR,INSERT_EMAIL);
				block_end();
				print("<br>");
				block_end();
				stdfoot();
				exit;
				}
			
			$body = unesc($_POST["body"]);
			if(!$body)
				{
				block_begin(ERR_MISSING_DATA);
				err_msg(ERROR,INSERT_MESSAGE);
				block_end();
				print("<br>");
				block_end();
				stdfoot();
				exit;
				}
			
			// check if email addy is already in use
			$a = (@mysql_fetch_row(@mysql_query("select count(*) from users where email='$email'"))) or die(mysql_error());
			if ($a[0] != 0)
				{
				block_begin(EMAIL_INVALID);
				err_msg(ERROR,"($email)<br>".ERR_EMAIL_ALREADY_EXISTS);
				block_end();
				print("<br>");
				block_end();
				stdfoot();
				exit;
				}
				
			mail($email, "$SITENAME ".INVIT_CONFIRM."", INVIT_MSG." $invitername.\n".INVIT_MSG1."$hash\n\n\n".INVIT_MSG2." $invitername\n\n$body\n\n\n".INVIT_MSG3, "From: $SITENAME <$SITEEMAIL>");
			
			mysql_query("INSERT INTO invites (inviter, invitee, hash, time_invited) VALUES ('$id', '$email', '$hash', NOW())");
			mysql_query("UPDATE users SET invites = invites - 1 WHERE id = $id") or sqlerr(__FILE__, __LINE__);
			
			redirect("usercp.php?do=invites&action=read&uid=$id");
		}
	}
	// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
     else {
          block_begin(WELCOME_UCP);
          print("<center><br />".UCP_NOTE_1."<br />".UCP_NOTE_2."<br /><br />\n");
          print("</center>");
          block_end();
          block_begin(CURRENT_DETAILS);
// ------------------------
          $id = $CURUSER["uid"];
          $res=mysql_query("SELECT users.signature, users.donor, users.invites, users.invited_by, users.warns, users.lip,users.username,users.downloaded,users.uploaded, users.joined, users.flag, countries.name, countries.flagpic FROM users LEFT JOIN countries ON users.flag=countries.id WHERE users.id=$id") or die(mysql_error());
          $row = mysql_fetch_array($res);
		  //donor by monosgeri
          if ($row[donor] == "no")
          $donor = "";
          else
          $donor = "&nbsp;<img src=\"images/star.gif\" style=\"border-style: none\">";
          //donor by monosgeri
          print("<table class=lista width=100%>\n");
          print("<tr>\n<td class=header>".USER_NAME."</td>\n<td class=lista>".unesc($CURUSER["username"])."".$donor."" . Warn_disabled($CURUSER[uid]) . "</td>\n");
          if ($CURUSER["avatar"] && $CURUSER["avatar"]!="")
             print("<td class=lista align=center valign=middle rowspan=4><img width=150 border=0 src=".htmlspecialchars($CURUSER["avatar"])." /></td>");
          print("</tr>");
          if ($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
          {
            print("<tr>\n<td class=header>".EMAIL."</td>\n<td class=lista>".unesc($CURUSER["email"])."</td></tr>\n");
            print("<tr>\n<td class=header>".LAST_IP."</td>\n<td class=lista>".long2ip($row["lip"])."</td></tr>\n");
            print("<tr>\n<td class=header>".USER_LEVEL."</td>\n<td class=lista>".unesc($CURUSER["level"])."</td></tr>\n");
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
  print("<tr>\n<td class=header>".INVITATIONS."</td>\n<td class=lista colspan=2>$row[invites]</td></tr>\n");
  if ($row["invited_by"] > 0)
  {
	$res2=mysql_query("SELECT users.id, users.username FROM users WHERE users.id=$row[invited_by]");
	if ($res2)
	{
	$invite=mysql_fetch_row($res2);	
	print("<tr>\n<td class=header>".INVITED_BY."</td>\n<td class=lista><a href=userdetails.php?id=$invite[0]>$invite[1]</a></td></tr>\n");
	}
  }
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
            $colspan=" colspan=2";
          }
          else
          {
            print("<tr>\n<td class=header>".USER_LEVEL."</td>\n<td class=lista>".unesc($CURUSER["level"])."</td></tr>\n");
            $colspan="";
          }
          print("<tr>\n<td class=header>".USER_JOINED."</td>\n<td class=lista$colspan>".($CURUSER["joined"]==0 ? "N/A" : get_date_time($CURUSER["joined"]))."</td></tr>\n");
          print("<tr>\n<td class=header>".USER_LASTACCESS."</td>\n<td class=lista$colspan>".($CURUSER["lastconnect"]==0 ? "N/A" : get_date_time($CURUSER["lastconnect"]))."</td></tr>\n");
          print("<tr>\n<td class=header>".PEER_COUNTRY."</td>\n<td class=lista colspan=2>".($row["flag"]==0 ? "":unesc($row['name']))."&nbsp;&nbsp;<img src=images/flag/".(!$row["flagpic"] || $row["flagpic"]==""?"unknown.gif":$row["flagpic"])." alt=".($row["flag"]==0 ? "unknow":unesc($row['name']))." /></td></tr>\n");
	/// START DOWNLOAD / UPLOADSPEED HACK by VIRUS ///
										$uid=$CURUSER["uid"];
			$rdu1=mysql_query("SELECT * FROM users WHERE id = $uid");
			$csp=mysql_result($rdu1,0,"fel");
			$le=mysql_result($rdu1,0,"letoltesisebesseg");

			if($csp==0) { $csp = "0"; }

			print("<tr>\n<td class=header>Upload speed</td>\n<td class=lista colspan=2>$csp kb/s</td></tr>\n");

			if($le==0) { $le = "0"; }

			print("<tr>\n<td class=header>Download speed</td>\n<td class=lista colspan=2>$le kb/s</td></tr>\n");

			/// END DOWNLOAD / UPLOADSPEED HACK by VIRUS ///
// GENDER/AGE Hack Start
if ($CURUSER["gender"]!=0)
	print("<tr>\n<td class=\"header\">".GENDER."</td>\n<td class=\"lista\" colspan=\"2\">".($CURUSER["gender"]==1?MALE:FEMALE)."</td></tr>\n");
if ($CURUSER["age"]!=0)
	print("<tr>\n<td class=\"header\">".AGE."</td>\n<td class=\"lista\" colspan=\"2\">".$CURUSER["age"]."</td></tr>\n");
// GENDER/AGE Hack End
          print("<tr>\n<td class=header>".DOWNLOADED."</td>\n<td class=lista colspan=2>".makesize($row["downloaded"])."</td></tr>\n");
          print("<tr>\n<td class=header>".UPLOADED."</td>\n<td class=lista colspan=2>".makesize($row["uploaded"])."</td></tr>\n");
          if (intval($row["downloaded"])>0)
           {
             $sr = $row["uploaded"]/$row["downloaded"];
             if ($sr >= 4)
               $s = "images/smilies/thumbsup.gif";
             else if ($sr >= 2)
               $s = "images/smilies/grin.gif";
             else if ($sr >= 1)
               $s = "images/smilies/smile1.gif";
             else if ($sr >= 0.5)
               $s = "images/smilies/noexpression.gif";
             else if ($sr >= 0.25)
               $s = "images/smilies/sad.gif";
             else
               $s = "images/smilies/thumbsdown.gif";
            $ratio=number_format($sr,2)."&nbsp;&nbsp;<img src=$s>";
           }
          else
             $ratio="oo";

          print("<tr>\n<td class=header>".RATIO."</td>\n<td class=lista colspan=2>$ratio</td></tr>\n");
          // Only show if forum is internal
          if ( $GLOBALS["FORUMLINK"] == '' || $GLOBALS["FORUMLINK"] == 'internal' )
             {
             $sql = mysql_query("SELECT * FROM posts INNER JOIN users ON posts.userid = users.id WHERE users.id = " . $CURUSER["uid"]);
             $posts = mysql_num_rows($sql);
             $memberdays = max(1, round( ( time() - $row['joined'] ) / 86400 ));
             $posts_per_day = number_format(round($posts / $memberdays,2),2);
             print("<tr>\n<td class=header><b>".FORUM." ".POSTS.":</b></td>\n<td class=lista colspan=2>" . $posts . " &nbsp; [" . sprintf(POSTS_PER_DAY, $posts_per_day) . "]</td></tr>\n");
			// Signature Hack by kSaMi
   			if ($row["signature"] && $row["signature"]!="")
  		    print("<tr>\n<td class=header><b>Signature:</b></td>\n<td class=lista colspan=2><p style='vertical-align:bottom'>".format_comment($row["signature"])."</p></td></tr>\n");
  		    // End
          }
         	 print("<tr>\n<td class=\"header\">TorrentBar:</td>\n<td class=\"lista\" colspan=\"2\"><img src=\"$BASEURL/torrentbar.php?/$id.png\" /><br /><input type=\"text\" style=\"border-color: #000000; border-style: solid; border-width: 1px; width: 346px; height: 15px;\" value=\"[img]$BASEURL/torrentbar.php?/$id.png[/img]\" readonly /></td></tr>\n");
//User Warning System Hack Start - 9:57 PM 9/8/2006
//gather all data required for the WarnLevel
   $get_warns_stats = mysql_query("SELECT * FROM warnings WHERE userid = ".$id." AND active = 'yes'");
   $warnings = mysql_fetch_array($get_warns_stats);
   $warningsnum = mysql_num_rows($get_warns_stats);

//begin warning stats
  print("<tr>\n<td class=header align=center colspan=3><b><font color=red>Warning Stats</font></b></td></tr>\n");

//display the WarnLevel
$prgsf = $row["warns"];

//display percentage of warn level
$tmp=0+$warntimes;
if ($tmp>0)
{
$wcurr=(0+$row["warns"]);
$prgs=($wcurr/$tmp) * 100;
$prgsfs=floor($prgs);
}
else
$prgsfs=0;
$prgsfs.="%";

$wl1 = $warntimes/4;
$wl2 = $warntimes/3;
$wl3 = $warntimes/2;
$wl4 = $warntimes;
if ("$prgsf" == "0")
$warnlevel = "".image_or_link("images/progress-0.gif","title=".$prgsfs."")."";
if ("$prgsf" > "0" && "$prgsf" <= "$wl1")
$warnlevel = "".image_or_link("images/progress-1.gif","title=".$prgsfs."")."";
if ("$prgsf" > "$wl1" && "$prgsf" <= "$wl2")
$warnlevel = "".image_or_link("images/progress-2.gif","title=".$prgsfs."")."";
if ("$prgsf" > "$wl2" && "$prgsf" <= "$wl3")
$warnlevel = "".image_or_link("images/progress-3.gif","title=".$prgsfs."")."";
if ("$prgsf" > "$wl3" && "$prgsf" < "$wl4")
$warnlevel = "".image_or_link("images/progress-4.gif","title=".$prgsfs."")."";
if ("$prgsf" >= "$wl4")
$warnlevel = "".image_or_link("images/progress-5.gif","title=".$prgsfs."")."";
print("<tr><td class=header>Warn Level</td><td class=lista colspan=2>".$warnlevel."</td>");

//don't show link to warns page if user has no warns
    if ($row["warns"]==0)
  $total_warns = "".$row["warns"]."";
    else
  $total_warns = "<a href=listwarns.php?uid=".$id.">".$row["warns"]."</a>";

//show the total number of warns
  print("<tr>\n<td class=header>".WARNED_TOTAL_WARNS."</td>\n<td class=lista colspan=2>".$total_warns."</td></tr>\n");

//user Warning System Hack Stop
          print("</table>");
          block_end();
          // ------------------------
          block_begin(UPLOADED." ".MNU_TORRENT);
          $resuploaded = mysql_query("SELECT namemap.filename, UNIX_TIMESTAMP(namemap.data) as added, namemap.size, summary.seeds, summary.leechers, summary.finished FROM namemap INNER JOIN summary ON namemap.info_hash=summary.info_hash WHERE uploader=$uid ORDER BY data DESC");
          $numtorrent=mysql_num_rows($resuploaded);
          if ($numtorrent>0)
             {
             list($pagertop, $pagerbottom, $limit) = pager(($utorrents==0?15:$utorrents), $numtorrent, $_SERVER["PHP_SELF"]."?uid=$uid&");
             print("$pagertop");
             $resuploaded = mysql_query("SELECT namemap.filename, UNIX_TIMESTAMP(namemap.data) as added, namemap.size, summary.seeds, summary.leechers, summary.finished, summary.info_hash as hash FROM namemap INNER JOIN summary ON namemap.info_hash=summary.info_hash WHERE uploader=$uid ORDER BY data DESC $limit");
          }
?>
<TABLE width=100% class="lista">
<!-- Column Headers  -->
<TR>
<TD align="center" class="header"><?php echo FILE; ?></TD>
<TD align="center" class="header"><?php echo ADDED; ?></TD>
<TD align="center" class="header"><?php echo SIZE; ?></TD>
<TD align="center" class="header"><?php echo SHORT_S; ?></TD>
<TD align="center" class="header"><?php echo SHORT_L; ?></TD>
<TD align="center" class="header"><?php echo SHORT_C; ?></TD>
<TD align="center" class="header"><?php echo EDIT; ?></TD>
<TD align="center" class="header"><?php echo DELETE; ?></TD>
</TR>
<?php
          if ($resuploaded && mysql_num_rows($resuploaded)>0)
             {
             while ($rest=mysql_fetch_array($resuploaded))
                   {
                   print("\n<tr>\n<td class=lista>".unesc($rest["filename"])."</td>");
                   include("include/offset.php");
                   print("\n<td class=\"lista\" align=\"center\">".date("d/m/Y",$rest["added"]-$offset)."</td>");
                   print("\n<td class=\"lista\" align=\"right\">".makesize($rest["size"])."</td>");
                   print("\n<td align=right class=\"".linkcolor($rest["seeds"])."\">$rest[seeds]</td>");
                   print("\n<td align=right class=\"".linkcolor($rest["leechers"])."\">$rest[leechers]</td>");
                   print("\n<td class=lista align=right>".($rest["finished"]>0?$rest["finished"]:"---")."</td>");
               print("<td class=lista align=center><a href=edit.php?info_hash=".$rest["hash"]."&returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>");
               print("<td class=lista align=center><a href=delete.php?info_hash=".$rest["hash"]."&returnto=".urlencode("torrents.php").">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>\n</tr>");
                   }
                   print("\n</table>");
             }
          else
              {
              print("<tr>\n<td class=lista align=center colspan=8>".NO_TORR_UP_USER."</td>\n</tr>\n</table>");
              }
          block_end();

// ------------------------
          print("<br />");
         }
     block_end();
     }

stdfoot();
exit();
?>
