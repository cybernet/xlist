<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn(true);

standardheader('PHP Editor');

if (!$CURUSER || $CURUSER["owner_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
else
    {

	block_begin('PHP Editor');
?>
<html> 
<head> 
<title></title> 
</head> 
<body topmargin="2" leftmargin="1" bottommargin="0" bgcolor="#F9F9FF"> 
<?php 
if (isset($_GET['bestand'])) { 
$bestand = $_GET['bestand']; } 
if (isset($_POST['bestand'])) { 
$bestand = $_POST['bestand']; } 

if (isset($bestand)) { 

if (isset($_POST['verwijder'])) { 
if (unlink($_POST['verwijder']) == TRUE) 
{ $melding = "<b>" . $_POST['verwijder'] . "</b> ". PHP_DELETE_SUCCES . "";  } 
else  { $melding = "<b>" . $_POST['verwijder'] . "</b> " . PHP_DELETE_FAILED . ""; } } 

if(is_dir($bestand)) { 
$dir = "$bestand/"; 
$bestand = "Nieuw.php"; } 
else { $dir = "."; } 
$file_array = array(); 
$filesfound = opendir($dir); 
while ($file = readdir($filesfound)) { 
if ($file != "." && $file != "..") { 
array_push($file_array,$file); }  } 
closedir($filesfound); 
if ($dir == ".") { $dir = ""; } 

if (isset($_POST['inhoud'])) { 
$text = stripslashes($_POST['inhoud']); 
$fopen=fopen($bestand,"w"); 
if (fwrite($fopen,$text)) { 
$melding = "<b>". $bestand . "</b> " . PHP_SAVE_TIME . ": " . date("G:i:s"); } 
else { $melding = "<b>". $bestand . "</b> " . PHP_NOT_SAVED . ""; } 
fclose($fopen); } 
if (isset($melding)) { } else { 
$melding = "<b>" . $bestand . "</b> " . PHP_NOT_SAVED_YET . ""; } 

$curos=strtolower($_SERVER['HTTP_USER_AGENT']); 
if (strstr($curos,"firefox")) { 
if (isset($_GET['mooi'])) { 
$cols = "120"; 
$rows = "6"; } else { 
$cols = "123"; 
$rows = "34"; } } 
if (strstr($curos,"msie"))    { 
if (isset($_GET['mooi'])) { 
$cols = "122"; 
$rows = "6"; } else { 
$cols = "122"; 
$rows = "32"; } } 

?> 

<table border="0" cellpadding="2" cellspacing="0">
	<tr>
		<td width="12%"><form name="Bestand" action="<?php echo "$PHP_SELF"; ?>"><?php echo PHP_CHANGE;?>: </td><td width="60%"><select size="1" name="bestand"> 
<?php 
echo "<option>" . $dir . $bestand . "</option>"; 
while (list($key, $file) = each ($file_array)) { 
echo "<option>". $dir . $file . "</option>"; } 
?> 
</select> <input style="width: 80;" type="submit" name="Submit" value="<?php echo PHP_OPEN;?>"> 
<input style="width: 80;" type="button" onClick="javascript:window.close();" value="<?php echo PHP_CLOSE;?>"> 
<input style="width: 80;" type=button onClick="history.go()" value="<?php echo PHP_REFRESH;?>"> 
</form></td>
		<td width="28%" align="right"><?php echo $melding;?></td></tr><tr><td><form name="PHP" method="post" action="<?php echo "$PHP_SELF"; ?>"><?php echo PHP_PRESENT;?>: </td><td><input type="text" name="bestand" value="<?php echo "$dir$bestand"; ?>"> 
<input style="width: 80;" type="submit" name="Submit" value="<?php echo PHP_SAVE;?>"> 
<input style="width: 80;" type="reset" name="Submit2" value="<?php echo PHP_RESET;?>"> 
<input style="width: 80;" type=button onClick="javascript:window.history.go(-1)" value="<?php echo PHP_BACK;?>"> 

</td><td align="right"> 
<?php if (isset($_GET['mooi'])) { 
echo "<a href=\"phpeditor.php?bestand=$bestand\">" . PHP_CLOSE_HIGHLIGHT . "</a> - "; } else { 
echo "<a href=\"phpeditor.php?mooi=$bestand&bestand=$bestand\">" . PHP_SHOW_HIGHLIGHT . "</a> - "; } 
echo "<a href=\"phpeditor.php?bestand=Nieuw.php\">" . PHP_BACK . "</a> - "; 
echo "<a href=\"phpeditor.php?verwijder=$bestand&bestand=Nieuw.php\">" . PHP_DELETE . "</a> - "; 
echo "<a href=\"$bestand\" target=\"_blank\">" . PHP_WATCH . "</a>"; 

echo "</td></tr><tr><td colspan=\"4\"><textarea name=inhoud cols=\"$cols\" rows=\"$rows\" style=\"font-family: Courier New; font-size: 10pt; border: 1px solid #000000;\">"; 
if (isset($text)) { 
echo htmlspecialchars($text); } 
else { 
$fopen=fopen($bestand,"rb"); 
$output=fread($fopen,filesize($bestand)); 
fclose($fopen); 
echo htmlspecialchars($output); } 
echo "</textarea></form></td></tr></table>"; } 

if (isset($_GET['mooi'])) { 
$fopen=fopen($_GET['mooi'],"rb"); 
$kleur=fread($fopen,filesize($_GET['mooi'])); 
fclose($fopen); 
echo "<br><table border=\"1\" cellpadding=\"2\" cellspacing=\"0\" 
style=\"border-collapse: collapse\" width=\"99%\"  bordercolorlight=\"#000000\" 
bordercolordark=\"#000000\" bgcolor=\"#FFFFFF\"><tr><td width=\"30\" valign=\"top\">"; 
$regels = explode ("\n", $kleur); 
$int = count ($regels) + 1; 
for ($i = 1; $i < $int; $i++) 
{ echo $i . ".<br>"; } 
echo "</td><td valign=\"top\">"; 
highlight_string($kleur); 
echo "</td></tr></table><br></body></html>";
			block_end();
		} 
	}
?> 