<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();
standardheader('Comments');

    if (isset($_GET["do"])) $do = $_GET["do"];
      else $do = "";
    if (isset($_GET["action"]))
       $action = $_GET["action"];
function comments_list()
         {

         $ret = array();
         $res = mysql_query("SELECT * FROM comments ORDER BY id");

         while ($row = mysql_fetch_array($res))
             $ret[] = $row;

         return $ret;
}

if ($CURUSER["view_torrents"] == "no")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

// Edit comments By Quake
// Added permissions so other members who not have access to edit and delete not can edit other members comments
// Was added by fatepower 13/12/07 01:45
if ($do=="comments" && $action == "edit")
            {
			$id = $_GET["id"];
            $subres = mysql_query("SELECT * FROM comments WHERE id = '" . $id . "' ORDER BY added DESC");
            if ($subrow = mysql_fetch_array($subres))
			 {
			if ($subrow["user"] == $CURUSER["username"] || $CURUSER["mod_access"] == "yes" || $CURUSER["edit_forum"] == "yes" || $CURUSER["delete_torrents"] == "yes")
//			if ($subrow["user"]==$CRUSUER["username"] || $subrow["user"]!=$CRUSUER["username"] && $CURUSER["mod_access"]=="no" || $subrow["user"]!=$CRUSUER["username"] && $CURUSER["edit_forum"]=="no" || $subrow["user"]!=$CRUSUER["username"] && $CURUSER["delete_torrents"]=="no")
			{
            block_begin(EDIT);
                   ?>
                   <form name="commentsedit" method="post" action="edit_comment.php?do=comments&action=write&id=<? echo $subrow["id"]; ?>"multipart/form-data">
                   <input type="hidden" name="info_hash" value="<? echo $subrow["info_hash"]; ?>" />
				   <table class="lista" width="100%" align="center">
                   <tr>
                   <td class="header" align="right"><?php echo USER_NAME; ?></td><td class="lista"><input type="text" name="user" value="<? echo $subrow["user"]; ?>" size="40" maxlength="60" disabled; readonly /></td>
                   </tr>
                   <?
                   print("<tr><td class=\"header\" align=\"right\">".COMMENT_1."</td><td class=\"lista\" align=left style='padding: 0px'>");
                   textbbcode("commentsedit","text",htmlspecialchars(unesc($subrow["text"])));
                   print("</td></tr>");
                   ?>
                   <tr>
                   <td class="lista" colspan="2" align="center"><input type="submit" name="write" value=<? echo FRM_CONFIRM ?> />&nbsp;&nbsp;&nbsp;
                   <input type="submit" name="write" value=<? echo FRM_CANCEL ?> /></td>
                   </tr>
                   </table>
                   </form>
                   <?
                   block_end();
                   print("<br />");
						}
						else {
						block_begin("Access Denied");
					    err_msg(ERROR,"You do not have permission to access this page");
			            block_end();
			            stdfoot();
			            exit();
							}		
			}
				   
                   }

// Quote Comments by Quake
elseif ($do == "comments" && $action == "quote")
            {

			$id = $_GET["id"];
			$quote = $_GET["id"];
            $subres = mysql_query("SELECT * FROM comments WHERE id = '" . $id . "' ORDER BY added DESC");
            if ($subrow = mysql_fetch_array($subres))
			 {			 
            block_begin(QUOTE);
                   ?>
                   <form name="comment" method="post" action="edit_comment.php?do=comments&action=confirm&id=<? echo $subrow["id"]; ?>"multipart/form-data">
                   <input type="hidden" name="info_hash" value="<? echo $subrow["info_hash"]; ?>" />				   
				   <table class="lista" width="100%" align="center">
                   <tr>
                   <td class="header" align="right"><?php echo USER_NAME; ?></td><td class="lista"><input type="text" name="user" value="<? echo $CURUSER["username"]; ?>" size="40" maxlength="60" disabled; readonly /></td>
                   </tr>
                   <?
                   print("<tr><td class=\"header\" align=\"right\">".COMMENT_1."</td><td class=\"lista\" align=left style='padding: 0px'>");
				   textbbcode("comment","text",($quote?(("[quote=".htmlspecialchars($subrow["user"])."]".htmlspecialchars(unesc($subrow["text"]))."[/quote]")):""));
                   print("</td></tr>");
                   ?>
                   <tr>
                   <td class="lista" colspan="2" align="center"><input type="submit" name="confirm" value=<? echo FRM_CONFIRM ?> />&nbsp;&nbsp;&nbsp;
                   <input type="submit" name="confirm" value=<? echo FRM_CANCEL ?> /></td>
                   </tr>
                   </table>
                   </form>
                   <?
                   block_end();
                   print("<br />");
                   }
            }
// End Quote Comments by Quake

// Comments by Quake
     elseif ($do == "comments" && $action == "write")
            {
            if ($_POST["write"] == FRM_CONFIRM)
               {
                       $id = intval($_GET["id"]);
                       $text = $_POST["text"];
					   $text = sqlesc($text);
                       mysql_query("UPDATE comments SET text=$text,editedby=$CURUSER[uid],editedat=NOW() WHERE id=$id") or sqlerr();
                       print(COMMENT_MOD);
                       }
  				redirect("details.php?id=" . StripSlashes($_POST["info_hash"]) ."#comments");
  			}
// End Edit comments

// Quote's by Quake
     elseif ($do == "comments" && $action == "confirm")
            {
  	   if ($_POST["confirm"] == FRM_CONFIRM)
	    {
               $comment = addslashes($_POST["text"]);
               $user=$CURUSER["username"];
       if ($user == "") $user = "Anonymous";
               $userid = $CURUSER["uid"];
       if ($userid == "") $userid = "0";
 @mysql_query("INSERT INTO comments (added,text,ori_text,user,userid,info_hash) VALUES (NOW(),\"$comment\",\"$comment\",\"$user\",\"$userid\",\"" . StripSlashes($_POST["info_hash"]) . "\")");
 redirect("details.php?id=" . StripSlashes($_POST["info_hash"]) ."#comments");
 }
else
 redirect("details.php?id=" . StripSlashes($_POST["info_hash"]) ."#comments");
}
// End Quote
stdfoot();
?>
