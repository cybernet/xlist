<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");


dbconn();

standardheader('Edit Torrents');

$scriptname = $_SERVER["PHP_SELF"];
$link = $_GET["returnto"];

if ($link=="")
   $link="torrents.php";

// save editing and got back from where i come

if ((isset($_POST["comment"])) && (isset($_POST["name"]))){

// nfo add
if(empty($_FILES["nfos"]["name"])) {
	$nfo = $_POST["oldnfo"];

}
else {  
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
$nfo = mysql_real_escape_string(str_replace("\x0d\x0d\x0a", "\x0d\x0a", @file_get_contents($nfofilename)));
}

   if ($_POST["action"]==FRM_CONFIRM) {

   if ($_POST["name"]=='')
        {
        err_msg("Error!","You must specify torrent name.");
        stdfoot();
        exit;
   }

   if ($_POST["comment"]=='')
        {
        err_msg("Error!","You must specify description.");
        stdfoot();
        exit;
   }

//Screenshot
if (isset($_POST["attachment"]))
{
for ($i=0;$i<count($_POST["attachment"]);$i++)
{
if (preg_match("|http|", $_POST["attachment"][$i]))
{
$immagine=$_POST["attachment"][$i];
$screen.="$immagine";
$screen.="<br>";
}
}
}
//Screenshot

   $fname=sqlesc(htmlspecialchars($_POST["name"]));
   $torhash=AddSlashes($_POST["info_hash"]);
//sticky
$sticky=$_POST[stiiicky];
//sticky
   write_log("Modified torrent $fname ($torhash)","modify");
//Golden Torrents by CobraCRK
$free=$_POST['free'];
   if(is_null($free)) {
   		$fr="free='no', ";
	} else {
		if($free==1) { 
		$fr="free='yes', ";
   		}
   }
   echo "<center>".PLEASE_WAIT."</center>";
//Torrent Nuke/Req Hack Start - 1:09 PM 9/3/2006
$req=$_POST["request"];
$nuked=$_POST["nuke"];
$nuke_reason=$_POST["nuked_reason"];

if ($_POST["nuke"] == "false")	{
   mysql_query("UPDATE namemap SET requested='$req', nuked='$nuked' WHERE info_hash='" . $torhash . "'");
   mysql_query("UPDATE namemap SET nuke_reason=NULL WHERE info_hash='" . $torhash . "'");	}
else	{
   mysql_query("UPDATE namemap SET requested='$req', nuked='$nuked', nuke_reason='$nuke_reason' WHERE info_hash='" . $torhash . "'");	}
//Torrent Nuke/Req Hack Stop
   mysql_query("UPDATE namemap SET $fr filename=$fname, genre='" . AddSlashes($_POST["genre"]) . "', scene='" . AddSlashes($_POST["scene"]) . "', infosite='".AddSlashes($_POST["infosite"])."', screen='".$screen."', video='".AddSlashes($_POST["video"])."', dd='".AddSlashes($_POST["dd"])."', imdb='".AddSlashes($_POST["imdb"])."', comment='" . AddSlashes($_POST["comment"]) . "', category=" . intval($_POST["category"]) . ", sticky='$sticky', nfo='$nfo' WHERE info_hash='" . $torhash . "'");
   print("<script LANGUAGE=\"javascript\">window.location.href=\"$link\"</script>");
   exit();
   }

   else {
        print("<script LANGUAGE=\"javascript\">window.location.href=\"$link\"</script>");
        exit();
   }
}

// view torrent's details
if (isset($_GET["info_hash"])) {

  $query ="SELECT namemap.free as free, namemap.genre, namemap.scene, namemap.infosite, namemap.screen, namemap.video, namemap.dd, namemap.imdb, namemap.requested, namemap.nuked, namemap.nuke_reason, namemap.info_hash, namemap.filename, namemap.sticky, namemap.nfo, namemap.url, UNIX_TIMESTAMP(namemap.data) as data, namemap.size, namemap.comment, namemap.category as cat_name, summary.seeds, summary.leechers, summary.finished, summary.speed, namemap.uploader FROM namemap LEFT JOIN categories ON categories.id=namemap.category LEFT JOIN summary ON summary.info_hash=namemap.info_hash WHERE namemap.info_hash ='" . AddSlashes($_GET["info_hash"]) . "'";
  $res = mysql_query($query) or die(CANT_DO_QUERY.mysql_error());
  $results = mysql_fetch_array($res);

  if (!$results)
     err_msg(ERROR,TORRENT_EDIT_ERROR);

  else {

  block_begin(EDIT_TORRENT);

  if (!$CURUSER || ($CURUSER["edit_torrents"]=="no" && $CURUSER["uid"]!=$results["uploader"]))
     {
         err_msg(ERROR,CANT_EDIT_TORR);
         block_end();
         stdfoot();
         exit();
     }
?>
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
<div align="center">
<form action="<?php echo $scriptname."?returnto=$link"; ?>" method="post" name="edit" ENCTYPE="multipart/form-data">
<table class=lista>
<tr>
<td align=right class=header><?php echo FILE_NAME; ?>: </td><td class=lista><input type="text" name="name" value="<?php echo $results["filename"]; ?>" size="60" /></td>
</tr>
<!-- Extra options hack start -->
<?php
if ($CURUSER["can_upload"]=="yes" || $CURUSER["uid"]==$results["uploader"])
{
    print("
    <tr>
    <td align=\"center\" class=\"header\" valign=\"top\">
    <a name=\"#expand\" href=\"#expand\" onclick=\"javascript:ShowHide('files','msgfile');\">More Options:</td>
    <td align=\"left\" class=\"lista\">
    <div name=\"files\" style=\"display:none\" id=\"files\">
        <table class=\"lista\">");
print "<tr>
<td align=\"right\" class=\"header\">".IMDB." (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"imdb\" value=\"".$results["imdb"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";

print "<tr>
<td align=\"right\" class=\"header\">".INFOSITE." (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"infosite\" value=\"".$results["infosite"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";

?>
<script type="text/javascript" src="js/smf.js"></script>
<?php
print "<tr><td align=\"right\" class=\"header\">".SCREEN." (".FACOLTATIVE."):</td><td class=\"lista\">";
if (!empty($results["screen"]))
{
$split=split("<br>", $results["screen"]);
foreach($split as $idx => $img)
{
if ($idx > -1 && !empty($img))
{
$imgs.=("<input type=\"text\" name=\"attachment[]\" value=\"$img\" size=\"60\" />");
}
}
print "$imgs";
}
else
{
print ("<input type=\"text\" name=\"attachment[]\" size=\"60\" />");
}
print "<span id=\"moreAttachments\"></span><input type=\"button\" value=\"More\" onclick=\"addAttachment(60); void(0);\"></td></tr>";

/****
print "<tr>
<td align=\"right\" class=\"header\">".SCREEN." (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"screen\" value=\"".$results["screen"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";

print "<tr>
<td align=\"right\" class=\"header\">".SCREEN." (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"screen2\" value=\"".$results["screen2"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";
****/

print "<tr>
<td align=\"right\" class=\"header\">".VIDEO.": (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"video\" value=\"".$results["video"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";

print "<tr>
<td align=\"right\" class=\"header\">".DD." (".FACOLTATIVE."):</td><td class=\"lista\"><input type=\"text\" name=\"dd\" value=\"".$results["dd"]."\" size=\"60\" /><br><font size=1>(Insert full URL)</font></td>
</tr>";

    print("</table></div>
    <div name=\"msgfile\" style=\"display:block\" id=\"msgfile\" align=\"left\">".("Click on More Options, to fill in more info!")."</div>
    </td></tr>\n");
}
?>
<!-- Extra options hack ends -->
<tr>
<td align=right class=header><?php echo INFO_HASH;?>:</td><td class=lista ><?php echo $results["info_hash"];  ?></td>
</tr><tr>
<?
if($GLOBALS["nfo"] == "true"){
$nfoa = "".$results["nfo"]."";
print("<tr><td align=right class=\"header\" style=\"background-image:f_edit.png;\">Upload NFO (optional):</td><td align=left class=\"lista\" ></a><br>Upload NFO<br><input type=\"file\" name=\"nfos\" size=\"50\"><input type=\"hidden\"  name=\"oldnfo\" value=\"$nfoa\"></td></tr>\n");
}
?>
<td align=right class="header"><?php echo DESCRIPTION; ?>:</td><td class=lista><?php textbbcode("edit","comment",unesc($results["comment"])) ?></td>
</tr><tr>

<?php
       echo "<TD class=\"header\" >".CATEGORY_FULL." : </TD><TD class=\"lista\" align=\"left\">";

$category=$results["cat_name"];
    categories($category);

      echo "</TD>";
include("include/offset.php");

?>
<tr>
<td align=right class=header><? echo SCENE_RELEASE; ?>: </td><td class=lista>  <input type="radio" name="scene" value="yes" <?php if($results["scene"]=='yes'){ echo ' checked="yes" '; } ?>  />
    Yes</label>
  
  <label>
  <input type="radio" name="scene" value="no" <?php if($results["scene"]=='no'){ echo ' checked="yes" '; } ?> />
    No</label>
  <br />
</p></td>
</tr>
<tr><td align=right class=header><?php echo GENRE; ?>: </td><td class=lista><input type="text" name="genre" value="<?php echo $results["genre"]; ?>" size="30" maxlength="50" /></td></tr>
<?php
//Golden Torrents by CobraCRK
if($CURUSER["edit_torrents"]=="yes") {
if($results["free"] == "yes") { $chk=" checked='checked' "; }
print("<tr><TD class=\"header\" >Free download: </TD><TD class=\"lista\"><input type='checkbox' name='free'" . $chk . " value='1' /> Free download (only upload stats are recorded)</td></tr>"); }
?>
<?php
//Torrent Nuke/Req Hack Start - 23:45 07.08.2006
if ($results["requested"] == "true") {
$selected=" selected=\"selected\""; }
else {
$selected=""; }
print("<tr><TD class=\"header\" align=\"right\">".TORRENT_REQUESTED.": </TD><TD class=\"lista\" align=\"left\">");
print("<select name=\"request\" size=\"1\">");
print("<option value=\"false\"".$selected.">".NO."</option>");
print("<option value=\"true\"".$selected.">".YES."</option>");
print("</select></TD></tr>");

if ($results["nuked"] == "true") {
$selected=" selected=\"selected\""; }
else {
$selected=""; }
print("<tr><TD class=\"header\" align=\"right\">".TORRENT_NUKED.": </TD><TD class=\"lista\" align=\"left\">");
print("<select name=\"nuke\" size=\"1\">");
print("<option value=\"false\"".$selected.">".NO."</option>");
print("<option value=\"true\"".$selected.">".YES."</option>");
print("</select>&nbsp;<input TYPE=\"text\" name=\"nuked_reason\" value=\"".$results["nuke_reason"]."\" size=\"43\" maxlength=\"100\"></TD></tr>");
//Torrent Nuke/Req Hack Stop
//sticky
print("<tr><TD class=\"header\" align=\"right\">Sticky torrent: </TD><TD class=\"lista\" align=\"left\">");
if($results[sticky] == "no" && $CURUSER["edit_torrents"]=="yes"){
echo "
<table border='0' width='120'>
	<tr>
		<td width='30'>".YES."</td>
		<td width='30'><input type='radio' value='yes' name='stiiicky'></td>
		<td width='30'>".NO."</td>
		<td width='30'><input type='radio' value='no' checked name='stiiicky'></td>
	</tr>
</table>
";
}
elseif($results[sticky] == "yes" && $CURUSER["edit_torrents"]=="yes"){
echo "
<table border='0' width='120'>
	<tr>
		<td width='30'>".YES."</td>
		<td width='30'><input type='radio' value='yes'checked name='stiiicky'></td>
		<td width='30'>".NO."</td>
		<td width='30'><input type='radio' value='no' name='stiiicky'></td>
	</tr>
</table>
";
}
print("</TD></tr>");
//sticky
include("include/offset.php");

?>

</tr><tr>
<td align=right class="header"><?php echo SIZE; ?>:</td><td class="lista" ><?php echo makesize($results["size"]); ?></td>
</tr><tr>
<td align=right class="header"><?php echo ADDED; ?>:</td><td class="lista" ><?php echo date("d/m/Y",$results["data"]-$offset); ?></td>
</tr><tr>
<td align=right class="header"><?php echo DOWNLOADED; ?>:</td><td class="lista" ><?php echo $results["finished"]." ".X_TIMES; ?></td>
</tr><tr>
<td align=right class="header"><?php echo PEERS; ?>:</td><td class="lista" ><?php echo SEEDERS .": " .$results["seeds"].",".LEECHERS .": ". $results["leechers"]."=". ($results["leechers"]+$results["seeds"]). " ". PEERS; ?></td>
</tr>
<tr><td><INPUT TYPE=hidden NAME="info_hash" SIZE=40 VALUE=<?php echo $results["info_hash"];  ?>></TD><td></td></tr>
<tr><td ALIGN=RIGHT></td>
</table>
<table><td ALIGN=right>
<INPUT type="submit" value="<?php echo FRM_CONFIRM; ?>" name="action" />
</TD>
<td>
<INPUT type="submit" value="<?php echo FRM_CANCEL;?>" name="action" /></td>
</form>
</table>
</tr>
</div>

<?php
  }  // results

  block_end();

} // info_hash

stdfoot();

?>
