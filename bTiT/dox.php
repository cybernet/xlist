<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
 require_once "include/functions.php";
 require_once "include/config.php";
 
 
 dbconn(false);


 if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST")
 {
   $file = $_FILES['file'];
   $types= Array ("srt/plain", "application/zip", "image/jpeg", "image/gif", "image/pjpeg", "image/png");

   if ((!$file) || ($file["size"] == 0) || ($file["name"] == "") || ($file["size"]>$GLOBALS["limit_dox"]))
     {
       err_msg("Error", "Nothing received! The selected file may have been too large. MAX " . makesize($GLOBALS["limit_dox"]));
       die;
     }

   if (file_exists("$DOXPATH/$file[name]"))
   {
    err_msg("Error", "A file with the name <b>$file[name]</b> already exists!");
    die;
   }

   $title = trim($HTTP_POST_VARS["title"]);
   if ($title == "")
   {
     $title = substr($file["name"], 0, strrpos($file["name"], "."));
     if (!$title)
       $title = $file["name"];
   }

   $r = mysql_query("SELECT id FROM dox WHERE title=" . sqlesc($title)) or sqlesc();
   if (mysql_num_rows($r) > 0)
     {
       err_msg("Error", "A file with the title <b>" . htmlspecialchars($title) . "</b> already exists!");
     }

   $url = $HTTP_POST_VARS["url"];

if ($url != "")
   {
     if (substr($url, 0, 7) != "http://" && substr($url, 0, 6) != "ftp://")
     {
       err_msg("Error", "The URL <b>" . htmlspecialchars($url) . "</b> does not seem to be valid.");
     }
   }

if (!move_uploaded_file($file["tmp_name"], "$DOXPATH/$file[name]"))
 {
   err_msg("Error", "Failed to move uploaded file. You should contact an administrator about this error.");
 }

   setcookie("doxurl", $url, 0x7fffffff);

   $title = sqlesc($title);
   $filename = sqlesc($file["name"]);
   $added = sqlesc(get_date_time());
   $uppedby = $CURUSER["uid"];
   $size = $file["size"];
   $url = sqlesc($url);

   if (($size < $GLOBALS["limit_dox"]) && ($size != 0))
   mysql_query("INSERT INTO dox (title, filename, added, uppedby, size, url) VALUES($title, $filename, NOW(), $uppedby, $size, $url)") or sqlerr();

   header("Location: $BASEURL/dox.php");
die;
 }
//End POST


 if ($CURUSER["id_level"] > 1)
 {
   $delete = $HTTP_GET_VARS["delete"];
   if (is_valid_id($delete))
   {
    $r = mysql_query("SELECT filename,uppedby FROM dox WHERE id=$delete") or sqlerr(__FILE__, __LINE__);
    if (mysql_num_rows($r) == 1)
    {
         $a = mysql_fetch_assoc($r);
      if ($CURUSER["owner_access"] == "yes" || $a["uppedby"] == $CURUSER["uid"])
      {
        mysql_query("DELETE FROM dox WHERE id=$delete") or sqlerr(__FILE__, __LINE__);
        if (!unlink("$DOXPATH/$a[filename]"))
        {
             err_msg("Warning", "Unable to unlink file: <b>$a[filename]</b>. You should contact an administrator about this error.");
             die;
        }
             header("Location: $BASEURL/dox.php");
      }
    }
   }
 }

 standardheader("Dox");

 block_begin("DOX", true);

      if ($GLOBALS["dox"]==false || $CURUSER["uid"]==1)
	  {
       err_msg(ERROR,ERR_500);
       stdfoot();
       exit;
       }


     if (!isset($_GET["searchtext"])) $_GET["searchtext"] = "";
     if (!isset($_GET["level"])) $_GET["level"] = "";

         $search=$_GET["searchtext"];
         $addparams="";
         if ($search!="")
            {
            $where="WHERE title LIKE '%".mysql_escape_string($_GET["searchtext"])."%'";
            $addparams="searchtext=$search";
            }
         else
             $where="";


 $res = mysql_query("SELECT COUNT(*) FROM dox $where ORDER BY added DESC") or sqlerr();
         $scriptname=htmlspecialchars($_SERVER["PHP_SELF"]);
         $row = mysql_fetch_row($res);
         $count = $row[0];
         if ($addparams <> "")
            list($pagertop, $pagerbottom, $limit) = pager($DoxLimitPerPage, $count,  "dox.php?" . $addparams . "&");
         else
            list($pagertop, $pagerbottom, $limit) = pager($DoxLimitPerPage, $count,  "dox.php?");
         ?>
         <div align="center">
         <form action="dox.php" name="find" method="get">
           <table border="0" class="lista">
           <tr>
           <td class="block"><? echo "Find file with title"; ?> </td>
           <td class="block">&nbsp;</td>
           </tr>
           <tr>
           <td><input type="text" name="searchtext" size="30" maxlength="50" value="<? echo htmlspecialchars($search) ?>" /></td>
           <td><input type="submit" value="<? echo SEARCH; ?>" /></td>
           </tr>
           </table>
         </form>
         </div>
           <?
         print $pagertop;
 $res = mysql_query("SELECT * FROM dox $where ORDER BY added DESC $limit") or sqlerr();
 print("<p align=center>Only images and ZIP archives allowed</p>\n");
 if (mysql_num_rows($res) == 0)
   print("<p>Sorry, nothing here pal :(</p>");
 else
 {
   print("<p><table align=center border=1 cellspacing=0 cellpadding=5>\n");
   print("<tr><td class=colhead align=left>Title</td><td class=colhead>Date</td><td class=colhead>Time</td>" .
     "<td class=colhead>Size</td><td class=colhead>Hits</td><td class=colhead>Upped by</td></tr>\n");

   $mod = $CURUSER["owner_access"] == "yes";

   while ($arr = mysql_fetch_assoc($res))
   {
    $r = mysql_query("SELECT username FROM users WHERE id=$arr[uppedby]") or sqlerr();
    $a = mysql_fetch_assoc($r);
    $title = "<td align=left><a href=getdox.php?filename=".rawurlencode($arr[filename])."><b>" . htmlspecialchars($arr["title"]) . "</b></a>" .
      ($mod || $arr["uppedby"] == $CURUSER["uid"] ? " <font size=1 class=small><a href=?delete=$arr[id]>[Delete]</a></font>" : "") ."</td>\n";
    $added = "<td>" . substr($arr["added"], 0, 10) . "</td><td>" . substr($arr["added"], 10) . "</td>\n";
    $size = "<td>" . makesize($arr['size']) . "</td>\n";
    $hits = "<td>" . number_format($arr['hits']) . "</td>\n";
    $uppedby = "<td><a href=userdetails.php?id=$arr[uppedby]><b>$a[username]</b></a></td>\n";
    $arr[filename] = rawurlencode("$arr[filename]");
     print("<tr>$title$added$size$hits$uppedby</tr>\n");
   }
   print("</table></p>\n");
 }            
   print $pagerbottom;

 if ($CURUSER["id_level"] > 1)
 {
  $url = $HTTP_COOKIE_VARS["doxurl"];
   $maxfilesize = makesize($GLOBALS["limit_dox"]);
  block_begin("Upload", true);
  print("<form enctype=multipart/form-data method=post action=?>\n");
  print("<table align=center class=main border=1 cellspacing=0 cellpadding=5>\n");
  print("<tr><td class=rowhead>File</td><td align=left><input type=file name=file size=60><br>(Maximum file size: $maxfilesize.)</td></tr>\n");
  print("<tr><td class=rowhead>Title</td><td align=left><input type=text name=title size=60><br>(Optional, taken from file name if not specified.)</td></tr>\n");
  print("<tr><td colspan=2 align=center><input type=submit value='Upload file' class=btn></td></tr>\n");
  print("</table>\n");
  print("</form>\n");
  block_end();
 }
block_end();
 stdfoot();
?>