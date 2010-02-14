<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/BDecode.php");
require_once ("include/BEncode.php");

//// Configuration//
function_exists("sha1") or die('<FONT COLOR="red">".NOT_SHA."</FONT></BODY></HTML>');

dbconn();

standardheader('Uploads');

if (!$CURUSER || $CURUSER["can_upload"]=="no")
   {
       stderr(ERROR.NOT_AUTHORIZED_UPLOAD,SORRY."...");
   }

block_begin(MNU_UPLOAD);

print("<table class=\"lista\" border=\"0\" width=\"100%\">\n");
print("<tr><td align=center>");

if (isset($_FILES["torrent"]))
   {
   if ($_FILES["torrent"]["error"] != 4)
   {
      $fd = fopen($_FILES["torrent"]["tmp_name"], "rb") or die(FILE_UPLOAD_ERROR_1);
      is_uploaded_file($_FILES["torrent"]["tmp_name"]) or die(FILE_UPLOAD_ERROR_2);
      $length=filesize($_FILES["torrent"]["tmp_name"]);
      if ($length)
        $alltorrent = fread($fd, $length);
      else {
        err_msg(ERROR,FILE_UPLOAD_ERROR_3);
        print("</td></tr></table>");
        block_end();
        stdfoot();
        exit();

       }
      $array = BDecode($alltorrent);
      if (!isset($array))
         {
         echo "<FONT COLOR=\"red\">".ERR_PARSER."</FONT>";
         endOutput();
         exit;
         }
      if (!$array)
         {
         echo "<FONT COLOR=\"red\">".ERR_PARSER."</FONT>";
         endOutput();
         exit;
         }
    // if dht disabled ($DHT_PRIVATE=true), set private flag and save new info hash
    //if ($array["announce"]==$BASEURL."/announce.php" && $DHT_PRIVATE)
    if (in_array($array["announce"],$TRACKER_ANNOUNCEURLS) && $DHT_PRIVATE)
      {
      $array["info"]["private"]=1;
      $hash=sha1(BEncode($array["info"]));
      }
    else
      {
      $hash = sha1(BEncode($array["info"]));
      }
      fclose($fd);
      }

if (isset($_POST["filename"]))
   $filename=htmlspecialchars($_POST["filename"]);
else
    $filename = AddSlashes(htmlspecialchars($_FILES["torrent"]["name"]));

//Extra options hack start
if (isset($_POST["imdb"]))
   $imdb = AddSlashes(htmlspecialchars($_POST["imdb"]));
else
    $imdb = "";
	
if (isset($_POST["infosite"]))
   $infosite = AddSlashes(htmlspecialchars($_POST["infosite"]));
else
    $infosite = "";

if (isset($_POST["attachment"]))
{
for ($i=0;$i<count($_POST["attachment"]);$i++)
{
if (preg_match("|http|", $_POST["attachment"][$i]))
{
$immagine=$_POST["attachment"][$i];
$db.="$immagine";
$db.="<br>";
}
$screen = AddSlashes($db);
}
}

/****
if (isset($_POST["screen"]))
   $screen = AddSlashes(htmlspecialchars($_POST["screen"]));
else
    $screen = "";

if (isset($_POST["screen2"]))
   $screen2 = AddSlashes(htmlspecialchars($_POST["screen2"]));
else
    $screen2 = "";
****/
if (isset($_POST["video"]))
   $video = AddSlashes(htmlspecialchars($_POST["video"]));
else
    $video = "";

if (isset($_POST["dd"]))
   $dd = AddSlashes(htmlspecialchars($_POST["dd"]));
else
    $dd = "";
//Extra options hack ends

if (isset($hash) && $hash) $url = $TORRENTSDIR . "/" . $hash . ".btf";
else $url = 0;

if (isset($_POST["info"]))
   $comment = AddSlashes($_POST["info"]);
else
    $comment = "";
/*****
if (isset($_POST["autoset"]))
   {
   if (strcmp($_POST["autoset"], "enabled") == 0)
      {
 *****/
      if (strlen($filename) == 0 && isset($array["info"]["name"]))
         $filename = AddSlashes(htmlspecialchars($array["info"]["name"]));
      if (isset($array["comment"]))
         $info = AddSlashes($array["comment"]);
      else
          $info = "";
/*****
      }
   }
*****/
   
if (isset($array["info"]) && $array["info"]) $upfile=$array["info"];
    else $upfile = 0;

if (isset($upfile["length"]))
{
  $size = floatval($upfile["length"]);
}
else if (isset($upfile["files"]))
     {
// multifiles torrent
         $size=0;
         foreach ($upfile["files"] as $file)
                 {
                 $size+=floatval($file["length"]);
                 }
     }
else
    $size = "0";

if (!isset($array["announce"]))
     {
     err_msg(ERROR, "Announce is empty");
     print("</td></tr></table>");
     block_end();
     stdfoot();
     exit();
}

      $filename = ($filename);
      $url = ($url);
      $info = ($info);
      $categoria = 0+$_POST["category"];
      $categoria = ($categoria);
      $comment = ($comment);
      $announce=$array["announce"];
      $anonyme=$_POST["anonymous"];

      //Torrent Nuke/Req Hack Start - 3:13 PM 9/3/2006
      $req=$_POST["requested"];
      $nuke=$_POST["nuked"];

      if ("$nuke" == "true")
      $nuke_reason=$_POST["nuked_reason"];
      else
      $nuke_reason="";
      //Torrent Nuke/Req Hack Stop

      if ($categoria==0)
         {
             err_msg(ERROR,WRITE_CATEGORY);
             print("</td></tr></table>");
             block_end();
             stdfoot();
             exit();
         }

      if ((strlen($hash) != 40) || !verifyHash($hash))
      {
         echo("<center><FONT COLOR=\"red\">".ERR_HASH."</FONT></center>");
         endOutput();
      }
//      if ($announce!=$BASEURL."/announce.php" && $EXTERNAL_TORRENTS==false)
      if (!in_array($announce,$TRACKER_ANNOUNCEURLS) && $EXTERNAL_TORRENTS==false)
         {
           err_msg(ERROR,ERR_EXTERNAL_NOT_ALLOWED);
           unlink($_FILES["torrent"]["tmp_name"]);
           print("</td></tr></table>");
           block_end();
           stdfoot();
           exit();
         }
//      if ($announce!=$BASEURL."/announce.php")

// nfo add
if(is_uploaded_file($_FILES['nfos']['tmp_name'])) {  
	$nfofile = $_FILES['nfos'];
	$nfo_types = array ( ".nfo", ".txt");
    $nfofilename = $nfofile['tmp_name'];
    $nfo_file_name = $nfofile['name'];
    $nfo_file_size = $_FILES["nfos"]["size"];

$limit = 65535;
if ($nfofile['size'] > $limit){
       $var = $limit / 1024;
	   $var1 = $nfo_file_size / 1024;
	   $res = round($var, 1); 
       $res1 = round($var1, 1); 
       err_msg (ERROR,"file size to big for upload!! limit ". $res ." KB, nfo was ". $res1 ." KB");
	   block_end();
	   stdfoot();
	   exit;
   }

$ext = strrchr($nfo_file_name,'.');
if(!in_array(strtolower($ext),$nfo_types)) {
             err_msg(ERROR,"File is not NFO.");
             block_end();
             stdfoot();
             exit();
         }
if (!is_uploaded_file($nfofilename))  {
             err_msg(ERROR,"Filed to upload NFO.");
             block_end();
             stdfoot();
             exit();
         }
else { echo"<center>$nfo_file_name upload successful</center><br />"; }

$nfo = mysql_real_escape_string(str_replace("\x0d\x0d\x0a", "\x0d\x0a", file_get_contents($nfofilename)));
}
else {$nfo = "";}
// nfo add end

      //Torrent Nuke/Req Hack Start - 3:13 PM 9/3/2006
      //if (in_array($announce,$TRACKER_ANNOUNCEURLS))
      //   $query = "INSERT INTO namemap (info_hash, filename, url, info, category, data, size, comment, uploader,anonymous) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",".$CURUSER["uid"].",'$anonyme')";
      //else
      //   $query = "INSERT INTO namemap (info_hash, filename, url, info, category, data, size, comment,external,announce_url, uploader,anonymous) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",\"yes\",\"$announce\",".$CURUSER["uid"].",'$anonyme')";
$scene=strip_tags($_POST['scene']);

      if (in_array($announce,$TRACKER_ANNOUNCEURLS))
         $query = "INSERT INTO namemap (info_hash, filename, url, info, category, data, size, comment, uploader, anonymous, infosite, screen, video, dd, imdb, nfo, requested, nuked, nuke_reason, scene, genre) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",".$CURUSER["uid"].",'$anonyme','$infosite','$screen','$video','$dd','$imdb','$nfo','$req','$nuke','$nuke_reason','$scene','".strip_tags($_POST['genre'])."')";
      else
         $query = "INSERT INTO namemap (info_hash, filename, url, info, category, data, size, comment, external, announce_url, uploader, anonymous, infosite, screen, video, dd, imdb, nfo, requested, nuked, nuke_reason, scene, genre) VALUES (\"$hash\", \"$filename\", \"$url\", \"$info\",0 + $categoria,NOW(), \"$size\", \"$comment\",\"yes\",\"$announce\",".$CURUSER["uid"].",'$anonyme','$infosite','$screen','$video','$dd','$imdb','$nfo','$req','$nuke','$nuke_reason','$scene','".strip_tags($_POST['genre'])."')";
      //Torrent Nuke/Req Hack Stop

      //echo $query;
      $status = makeTorrent($hash, true);
      quickQuery($query);
      if ($status)
         {
         move_uploaded_file($_FILES["torrent"]["tmp_name"] , $TORRENTSDIR . "/" . $hash . ".btf") or die(ERR_MOVING_TORR);
//         if ($announce!=$BASEURL."/announce.php")
        if (!in_array($announce,$TRACKER_ANNOUNCEURLS))
            {
                require_once("./include/getscrape.php");
                scrape($announce,$hash);
                print("<center>".MSG_UP_SUCCESS."<br /><br />\n");
                write_log("Uploaded new torrent $filename - EXT ($hash)","add");
            }
         else
             {
              if ($DHT_PRIVATE)
                   {
                   $alltorrent=bencode($array);
                   $fd = fopen($TORRENTSDIR . "/" . $hash . ".btf", "rb+");
                   fwrite($fd,$alltorrent);
                   fclose($fd);
                   }
                // with pid system active or private flag (dht disabled), tell the user to download the new torrent
                write_log("Uploaded new torrent $filename ($hash)","add");
                print("<center>".MSG_UP_SUCCESS."<br /><br />\n");

                if ($PRIVATE_ANNOUNCE || $DHT_PRIVATE) {
				if ($GLOBALS["torrent_download_check"] == "true") {
# Create Random number
$floor = 100000;
$ceiling = 999999;
srand((double)microtime()*1000000);
$rand = rand($floor, $ceiling);
    @mysql_query("UPDATE users SET random2=$rand WHERE id=".$CURUSER["uid"]);

                   print(MSG_DOWNLOAD_PID."<br /><a href=\"download.php?do=download&amp;key=$rand&amp;id=$hash&f=".urlencode($filename).".torrent\">".DOWNLOAD."</a><br /><br />");
				} else {
                   print(MSG_DOWNLOAD_PID."<br /><a href=\"download.php?id=$hash&f=".urlencode($filename).".torrent\">".DOWNLOAD."</a><br /><br />");
			}			
		}
	}
/***
                if ($PRIVATE_ANNOUNCE && $GLOBALS["torrent_download_check"] == "true" || $DHT_PRIVATE && $GLOBALS["torrent_download_check"] == "true") {
				 print(MSG_DOWNLOAD_PID."<br /><a href=\"torrentdownload.php?id=$hash\">".DOWNLOAD."</a><br /><br />");
				}
				elseif ($PRIVATE_ANNOUNCE || $DHT_PRIVATE) {
                print(MSG_DOWNLOAD_PID."<br /><a href=\"download.php?id=$hash&f=".urlencode($filename).".torrent\">".DOWNLOAD."</a><br /><br />");
				}

			}
***/
         print("<a href=\"torrents.php\">".RETURN_TORRENTS."</a></center>");
		 $query2= "INSERT INTO shoutbox (msgid, user, message, date, userid) VALUES (NULL,'System message', \"New torrent Uploaded: $filename  by: ".$CURUSER["username"]."\", UNIX_TIMESTAMP(),".$CURUSER["uid"].")";
         quickQuery($query2);
         print("</td></tr></table>");
         block_end();
         }
      else
          {
              err_msg(ERROR,ERR_ALREADY_EXIST);
              unlink($_FILES["torrent"]["tmp_name"]);
              print("</td></tr></table>");
              block_end();
              stdfoot();
          }
}
else
    endOutput();

function endOutput()
{
 global $BASEURL, $user_id, $TRACKER_ANNOUNCEURLS;
  ?>
  </CENTER>
  <?php
  echo "<center>".INSERT_DATA."<BR><BR>";
  //echo " ".ANNOUNCE_URL." <b>$BASEURL/announce.php</b><BR></center>";
  echo " ".ANNOUNCE_URL."<br /><b>";
  foreach ($TRACKER_ANNOUNCEURLS as $taurl)
        echo "$taurl<br />";
  echo "</b><BR></center>";
  ?>
  <FORM name="upload" method="post" ENCTYPE="multipart/form-data">
  <TABLE class="lista" align="center">
  <TR><TD class="header"><?php echo TORRENT_FILE ?>:</TD><TD class="lista">
  <?php
  if (function_exists("sha1"))
     echo '<INPUT TYPE="file" NAME="torrent">';
  else
      echo "<I>".NO_SHA_NO_UP."</I>";
  ?>
  </TD>
  </TR>
  <?php
       echo "<TR><TD class=\"header\" >".CATEGORY_FULL." : </TD><TD class=\"lista\" align=\"left\">";

    categories( $category[0] );

      echo "</TD></TR>";
  ?>
  <TR>
  <TD class="header"><?php echo FILE_NAME;?>(<?php echo FACOLTATIVE;?>): </TD>
  <TD class="lista" ><INPUT TYPE="text" name="filename" size="50" maxlength="200" /></TD>
  </TR>
<!-- Extra options hack start -->
<script type="text/javascript" language="JavaScript">
function ShowHide(id,id1) {
    obj = document.getElementsByTagName("div");
    if (obj[id].style.display == 'block'){
     obj[id].style.display = 'none';
     obj[id1].style.display = 'block';
    }
    else {
     obj[id].style.display = 'block';
     obj[id1].style.display = 'none';
    }
}

</script>

<?php

    print("
    <tr>
    <td align=\"center\" class=\"header\" valign=\"top\">
    <a name=\"#expand\" href=\"#expand\" onclick=\"javascript:ShowHide('files','msgfile');\">More Options:</td>
    <td align=\"left\" class=\"lista\">
    <div name=\"files\" style=\"display:none\" id=\"files\">
<table class=\"lista\">");
  print "<TR><TD class=\"header\" valign=\"top\">".IMDB." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"imdb\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://www.imdb.com/title/tt8567887/)</font></TD></TR>";
  print "<TR><TD class=\"header\" valign=\"top\">".INFOSITE." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"infosite\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://server.com/forums/showthread.php?t=4849)</font></TD></TR>";
?>
<script type="text/javascript" src="js/smf.js"></script>
<TR><TD class="header" valign="top">Screenshot(s): </TD><TD class="lista"><input type="input" size="50" maxlength="200" name="attachment[]" /><span id="moreAttachments"></span><br><font size=1>(Insert full URL - example: http://server.com/image.png)</font> <input type="button" value="More" onclick="addAttachment(50); void(0);"></TD></TR>
<?php
//  print "<TR><TD class=\"header\" valign=\"top\">".SCREEN." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"screen\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://server.com/image.png)</font></TD></TR>";
//  print "<TR><TD class=\"header\" valign=\"top\">".SCREEN." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"screen2\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://server.com/image2.png)</font></TD></TR>";
  print "<TR><TD class=\"header\" valign=\"top\">".VIDEO." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"video\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://www.dailymotion.com/swf/TOt8yj6oxYXvP8bAq)</font></TD></TR>";
  print "<TR><TD class=\"header\" valign=\"top\">".DD." (".FACOLTATIVE."): </TD><TD class=\"lista\"><INPUT TYPE=\"text\" name=\"dd\" size=\"50\" maxlength=\"200\" /><br><font size=1>(Insert full URL - example: http://server.com/file.rar)</font></TD></TR>";
print("</table></div>
    <div name=\"msgfile\" style=\"display:block\" id=\"msgfile\" align=\"left\">".("Click on More Options, to fill in more info!")."</div>
    </td></tr>\n");

?>
<!-- Extra options hack ends -->
<?php
if($GLOBALS["nfo"] == "true"){
print("<TR><TD class=\"header\">Upload NFO (".FACOLTATIVE."): </TD>
 <TD class=\"lista\" ><input type=\"file\" name=\"nfos\"  size=\"50\"></TD>");
}
?>
  <TR>
  <TD class="header" valign="top"><?php echo DESCRIPTION;?> (<?php echo FACOLTATIVE;?>): </TD>
  <TD class="lista" ><?php
  textbbcode("upload","info");
  ?></TD>
  </TR>
<!-- Nfo Ripper Start -->
  <TR>
<td class="header" valign="top"><a target=New href=nforipper.php>Nfo-Ripper</a></td>
  <TD class="lista" > Ripp your NFO file so u can easy read it or put it in the description!
 </TR>
<!-- Nfo Ripper Ends -->
  <TR>
  <TD class="header"><?echo SCENE_RELEASE;?>: </TD>
  <TD class="lista" >

  <label>
  <input type="radio" name="scene" value="yes" checked="yes" />
    Yes</label>

  <label>
  <input type="radio" name="scene" value="no" />
    No</label>
  <br />
</TD>
  </TR>
    <TR>
  <TD class="header"><?echo GENRE;?>: </TD>
  <TD class="lista" ><INPUT TYPE="text" name="genre" size="30" maxlength="50" /></TD>
  </TR>
  <?php
//Torrent Nuke/Req Hack Start - 3:15 PM 9/3/2006
print('<TR><td class="header" align="left">'.TORRENT_REQUESTED.'</td><TD  class="lista">');
print('<select name="requested" size=\"1\">');
print('<option value="false" selected=\"selected\">'.NO.'</option>');
print('<option value="true">'.YES.'</option></select>');
print('</TD></TR>');

print('<TR><td class="header" align="left">'.TORRENT_NUKED.'</td><TD  class="lista">');
print('<select name="nuked" size=\"1\">');
print('<option value="false" selected=\"selected\">'.NO.'</option>');
print('<option value="true">'.YES.'</option></select>');
print('&nbsp;<INPUT TYPE="text" name="nuked_reason" size="43" maxlength="100">');
print('</TD></TR>');
//Torrent Nuke/Req Hack Stop
  print("<TR><TD colspan=\"2\"><INPUT TYPE=\"hidden\" name=\"user_id\" size=\"50\" value=\"$user_id\" /> </TD /></TR>");
  print('<TR><td class="header">'.TORRENT_ANONYMOUS.'</td><TD class="lista">&nbsp;&nbsp;'.NO.'<INPUT TYPE="radio" name="anonymous" value="false" checked />&nbsp;&nbsp;'.YES.'<INPUT TYPE="radio" name="anonymous" value="true" /></TD></TR>');
  if (function_exists("sha1"))
  //Old code
  //echo '<TR><TD class="lista" align="center" colspan="2"><INPUT TYPE="checkbox" name="autoset" value="enabled" checked />'.TORRENT_CHECK.'</TD></TR>';
     echo '<TR><TD class="lista" align="center" colspan="2"><INPUT type="checkbox" name="autoset" value="enabled" disabled checked />'.TORRENT_CHECK.'</TD></TR>';
  ?>
  <TR>
  <TD align="right"><INPUT type="submit" value="<?php echo FRM_SEND ?>" /></TD>
  <TD align="left"><INPUT type="reset" value="<?php echo FRM_RESET ?>" /></TD>
  </TR>
  </TABLE>
  </FORM>
  <?php
  print("</td></tr></table>");
  block_end();
}
stdfoot();
?>