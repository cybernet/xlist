<?php

require_once ("include/functions.php");
require_once ("include/config.php");

global $CURUSER;

dbconn();

//Start User Redirect if Not Logged In
if ($CURUSER["view_users"] == "yes")
{
//Stop User Redirect if Not Logged In

standardheader("Personal Notepad");

$resusrnm = mysql_query("SELECT username FROM users WHERE id=$CURUSER[uid]") or mysql_error();
$arrusrnm = mysql_fetch_array($resusrnm);
$curusername = $arrusrnm[username];
$res = mysql_query("SELECT * FROM notes WHERE userid=$CURUSER[uid] ORDER BY added DESC") or sqlerr();
$arrnotes = mysql_num_rows($res);

    if (isset($_GET["action"])) $action=$_GET["action"];
      else $action = "";
    if (isset($_GET["id"]))
       $id=$_GET["id"];

//Start Read Personal Note Page
     if  ($action == "read" && $id == "$id")
         {
$resusrid = mysql_query("SELECT userid FROM notes WHERE id=$id AND userid=$CURUSER[uid]") or sqlerr();
$arrresusrid = mysql_fetch_array($resusrid);
$curuserid = $arrresusrid["userid"];
if ($CURUSER[uid] == $curuserid)
{
block_begin("".$curusername."'s Personal Notepad");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"header\" align=\"center\">".NOTE_ID."</td><td class=\"header\" align=\"center\">".NOTE_NOTE."</td><td class=\"header\" align=\"center\">".NOTE_DATETIME."</td></tr>");
$resview = mysql_query("SELECT * FROM notes WHERE id=".$_GET[id]." AND userid='".$CURUSER[uid]."'") or sqlerr();
$arrview = mysql_fetch_assoc($resview);
$noteview = $arrview[note];
$addedview = $arrview[added];
$numberview = $arrview[id];
print ("<tr><td class=\"lista\" align=\"center\" width=\"3%\">$numberview</td><td class=\"lista\" align=\"center\" width=\"77%\">".format_comment($noteview)."</td><td class=\"lista\" align=\"center\" width=\"20%\">$addedview</td></tr>");
print ("</table>");
print ("</td></tr>");
print ("<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
print ("</table>");
block_end();
}
else
{
block_begin("".$curusername."'s Personal Notepad");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"header\" align=\"center\">".NOTE_ID."</td><td class=\"header\" align=\"center\">".NOTE_NOTE."</td><td class=\"header\" align=\"center\">".NOTE_DATETIME."</td></tr>");
print ("<tr><td class=\"lista\" align=\"center\" colspan=\"3\">".NOTE_READ_ERROR."</td></tr>");
print ("</table>");
print ("</td></tr>");
print ("<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
print ("</table>");
block_end();
}
         }
//Stop Read Personal Note Page

//Start Edit Personal Note Page
     elseif  ($action == "edit" && $id == "$id")
         {
$resusrid = mysql_query("SELECT userid FROM notes WHERE id=$id AND userid=$CURUSER[uid]") or sqlerr();
$arrresusrid = mysql_fetch_array($resusrid);
$curuserid = $arrresusrid["userid"];
if ($CURUSER[uid] == $curuserid)
{
block_begin("".$curusername."'s Personal Notepad");
print("<form name=editnote method=post action=".$_SERVER[PHP_SELF]."?action=takeedit&id=".$_GET[id].">\n");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
$resedit = mysql_query("SELECT * FROM notes WHERE id=".$_GET[id]." AND userid=".$CURUSER[uid]."") or sqlerr();
$arredit = mysql_fetch_array($resedit);
$editnote = $arredit[note];
$addededit = $arredit[added];
$numberedit = $id;
print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\"><b>".NOTE_NOTE.":</b></td><td align=left class=lista>\n");
textbbcode("editnote","editnote",htmlspecialchars(unesc($editnote)));
print("</td></tr>\n");
print("<input type=\"hidden\" name=\"edit\" value=\"note\">\n");
print("<tr><td colspan=2 align=center class=lista><input type=submit value=\"Submit\">\n");
print("</form>\n");
print("</table>\n");
print ("</td></tr>");
print ("<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
print ("</table>");
block_end();
}
else
{
block_begin("".$curusername."'s Personal Notepad");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\">".NOTE_EDIT_ERROR."</td></tr>");
print ("</table>");
print ("</td></tr>");
print ("<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
print ("</table>");
block_end();
}
         }
//Stop Edit Personal Note Page

//Start Add New Personal Note Page
     elseif  ($action == "add")
         {
block_begin("".$curusername."'s Personal Notepad");
print("<form name=takenote method=post action=".$_SERVER[PHP_SELF]."?action=takenote>\n");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");

print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\"><b>".NOTE_NOTE.":</b></td><td align=left class=lista>\n");
textbbcode("takenote","takenote");
print("</td></tr>\n");
print("<input type=\"hidden\" name=\"add\" value=\"note\">\n");
print("<tr><td colspan=2 align=center class=lista><input type=submit value=\"Submit\">\n");
print("</form>\n");
print("</table>\n");
print ("</td></tr>");
print ("<tr><td class=\"header\" align=\"center\" width=\"100%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
print ("</table>");
block_end();
         }
//Stop Add New Personal Note Page

//Start TakeAdd Personal Note Page
     elseif  ($action == "takenote")
         {
$note = $_POST["takenote"];
$note = sqlesc($note);
$added = gmdate("Y-m-d H:i:s");
mysql_query("INSERT INTO notes (userid,note,added) VALUES ('$CURUSER[uid]',$note,'$added')") or sqlerr();
redirect("".$_SERVER[PHP_SELF]."");
         }
//Stop Take Personal Note Page

//Start TakeEdit Personal Note Page
     elseif  ($action == "takeedit" && $id == "$id")
         {
$id = $_GET["id"];
$note = $_POST["editnote"];
$note = sqlesc($note);
$added = gmdate("Y-m-d H:i:s");
mysql_query("UPDATE notes SET note=".$note.", added='".$added."' WHERE id=".$id." AND userid=".$CURUSER[uid]." LIMIT 1") or sqlerr();
redirect("".$_SERVER[PHP_SELF]."");
         }
//Stop TakeEdit Personal Note Page

//Start TakeDelete Personal Note Page
     elseif  ($action == "takedelete")
         {
if (empty($_POST["delnote"]))
{
block_begin("".$curusername."'s Personal Notepad");
   print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
   print ("<tr><td class=\"lista\" align=\"center\" colspan=\"2\">".NOTE_DEL_ERR."</td></tr>");
   print ("<tr><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td class=\"header\" align=\"center\" width=\"50%\"><a href=\"".$_SERVER[PHP_SELF]."\">".NOTE_VIEW_MORE."</a></td></tr>");
   print ("</table>");
block_end();
}
else
{
$id = implode(", ", $_POST[delnote]);
mysql_query("DELETE FROM notes WHERE id IN (".implode(", ", $_POST[delnote]).") AND userid=".$CURUSER[uid]."") or sqlerr();
redirect("".$_SERVER[PHP_SELF]."");
}
         }
//Stop TakeDelete Personal Note Page

//Start Personal Note HomePage
else
         {
 if (mysql_num_rows($res) == 0)
{
block_begin("".$curusername."'s Personal Notepad (".$arrnotes." notes)");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"lista\" align=\"center\">You don't have any personal notes. Maybe you could add some...</td></tr>");
print ("<tr><td colspan=\"6\" class=\"header\" align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">Add new personal note</a></td></tr>");
print ("</table>");
block_end();
}
else
{
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
block_begin("".$curusername."'s Personal Notepad (".$arrnotes." notes)");
print ("<form method=post name=deleteall action=".$_SERVER[PHP_SELF]."?action=takedelete>");
print ("<table border=\"0\" cellspacing=\"2\" cellpadding=\"0\" class=\"lista\" align=\"center\" width=\"100%\">");
print ("<tr><td class=\"header\" align=\"center\">".NOTE_ID."</td><td class=\"header\" align=\"center\">".NOTE_NOTE."</td><td class=\"header\" align=\"center\">".NOTE_DATETIME."</td><td class=\"header\" align=\"center\">".NOTE_VIEW."</td><td class=\"header\" align=\"center\">".NOTE_EDIT."</td><td class=\"header\" align=\"center\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','delnote[]',this.checked)\" /></td></tr>");
  while ($arr = mysql_fetch_assoc($res))
   {
      $note = $arr[note];
      $added = $arr[added];
      $number = $arr[id];
      //Name of Note Too big Hack Start
      if (strlen($note) > 38)
      {
      $extension = "...";
      $note = substr($note, 0, 38)."$extension";
      }
      //Name of Note Too big Hack Stop
      print ("<tr><td class=\"lista\" align=\"center\" width=\"3%\">$number</td><td class=\"lista\" align=\"center\" width=\"38%\">$note</td><td class=\"lista\" align=\"center\" width=\"23%\">$added</td><td class=\"lista\" align=\"center\" width=\"12%\"><a href=".$_SERVER[PHP_SELF]."?action=read&id=".$number.">".NOTE_VIEW."</a></td><td class=\"lista\" align=\"center\" width=\"12%\"><a href=".$_SERVER[PHP_SELF]."?action=edit&id=".$number.">".NOTE_EDIT."</a></td><td class=\"lista\" align=\"center\" width=\"12%\"><input type=\"checkbox\" name=\"delnote[]\" value=\"".$number."\" /></td></tr>");
   }
print ("<tr><td colspan=\"5\" class=\"header\" align=\"center\"><a href=\"".$_SERVER[PHP_SELF]."?action=add\">".NOTE_ADD_NEW."</a></td><td colspan=\"1\" class=\"header\" align=\"center\"><input type=submit value=".DELETE."></td></tr>");
print ("</form>");
print ("</table>");
block_end();
}
         }
//Stop Personal Note HomePage

//Start User Redirect if Not Logged In
}
else
{
redirect("login.php");
}
//Stop User Redirect if Not Logged In

stdfoot();

?>
