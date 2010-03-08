<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/blocks.php");


dbconn();

standardheader('Avatar');

block_begin(Avatar);

//set these variables-----------------------------------------------------------------
global $BASEURL;
$domain="$BASEURL";
//$domain = "localhost";      //your domainname
$path = "avatars/";   
$path_after_domain = "/avatars/";
$max_size = 100000;          //maximum filesize
//------------------------------------------------------------------------------------
?>
<center>
<b>Now you can upload your Avatar on ouer Server</b><p>
<h5>Don't forget to copy the link and put it in yore Avatar url in your profil</h5>
<p>
<FORM ENCTYPE="multipart/form-data" ACTION="avatar.php" METHOD="POST">
        <p class="style1 " align="center"> 
		<table border=1 cellspacing=0 cellpadding=0 width="33">
        <tr>
         <p class="style1 " align="center"> <td class=rowhead>
			<p align="center"><span lang="se">Avatar: </span></td>
          <td>
			<p class="style1 " align="center"><p align="center"><INPUT NAME="userfile" TYPE="file" id="userfile"></td>
        </tr>
        <td><tr><p class="style1 " align="center"><td colspan=2 align=center><input name="submit" type="submit" id="submit" value="Upload">         
       </td></tr>
</table>	   
<br>

<?php
if (!isset($HTTP_POST_FILES['userfile'])) exit;

if (is_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'])) {

if ($HTTP_POST_FILES['userfile']['size']>$max_size) {
      echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">File is too big !</font><br>\n"; exit; }
if (($HTTP_POST_FILES['userfile']['type']=="image/gif") || ($HTTP_POST_FILES['userfile']['type']=="image/pjpeg") || ($HTTP_POST_FILES['userfile']['type']=="image/jpeg") | ($HTTP_POST_FILES['userfile']['type']=="image/png")) {

      if (file_exists($path . $HTTP_POST_FILES['userfile']['name'])) {
              echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">There already exists a file with this name, please rename your file and try again</font><br>\n"; exit; }

      $res = copy($HTTP_POST_FILES['userfile']['tmp_name'], $path .$HTTP_POST_FILES['userfile']['name']);

      if (!$res) { echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">Didn't work, please try again</font><br>\n"; exit; } else {
      ?>
<br>
<p>
<center>
<span lang="se"><b>
</b></font><font color="#333333" face="Geneva, Arial, Helvetica, sans-serif"> URL<strong><font color="#990000"><a href="http://<? echo $domain; ?><? echo $path_after_domain; ?><? echo $HTTP_POST_FILES['userfile']['name']; ?>" target="_blank"><br>
<? echo $domain; ?><? echo $path_after_domain; ?><? echo $HTTP_POST_FILES['userfile']['name']; ?>
</a></font></strong>
<br><br>
HTML<br><strong>
<font color="red">&lt;img src="http://<? echo $domain; ?><? echo $path_after_domain; ?><? echo $HTTP_POST_FILES['userfile']['name']; ?>&quot;&gt;</strong></font>
<br><br>
Image Code:<br><strong>
<font color="red">[img]<? echo $domain; ?><? echo $path_after_domain; ?><? echo $HTTP_POST_FILES['userfile']['name']; ?>[/img]</font>
</strong><br>


<?
}
echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\"><hr>";
echo "Namn: ".$HTTP_POST_FILES['userfile']['name']."<br>\n";
echo "Storlek: ".$HTTP_POST_FILES['userfile']['size']." bytes<br>\n";
echo "Filtyp: ".$HTTP_POST_FILES['userfile']['type']."<br>\n";
echo "</font>";
echo "<br><br><img src=\"http://".$domain."/".$path_after_domain.$HTTP_POST_FILES['userfile']['name']."\">";
} else { echo "<font color=\"#333333\" face=\"Geneva, Arial, Helvetica, sans-serif\">You may only upload file types with the extensions ????? .gif / .jpg / .rar /  !!!</font><br>\n"; exit; }

}

block_end();
 stdfoot();
?>