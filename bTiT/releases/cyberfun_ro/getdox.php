<?php
require "include/functions.php";
require "include/config.php";


dbconn();
if (!$CURUSER)
{
Header("Location: $BASEURL/");
die;
}

if(isset($_GET["filename"])) {

$filename = $_GET["filename"];

} else
die("File name missing\n"); 
if ( ! function_exists ( 'mime_content_type' ) )
{
   function mime_content_type ( $f )
   {
       return trim ( exec ('file -bi ' . escapeshellarg ( $f ) ) ) ;
   }
}


header("Content-Type: " . mime_content_type("./" . $DOXPATH . "/" . $filename));
header('Content-Disposition: attachment; filename="'.$filename.'"');
if ($CURUSER["id_level"] < 12 && filesize("$DOXPATH/$filename") > 1024*1024)
die("Sorry, you need to be a power user or higher to download files larger than 1.00 MB.\n");
$filename = sqlesc($filename);
$res = mysql_query("SELECT * FROM dox WHERE filename=$filename") or sqlerr();
$arr = mysql_fetch_assoc($res);

if (!$arr)
 die("Not found\n");
mysql_query("UPDATE dox SET hits=hits+1 WHERE id=$arr[id]") or sqlerr(__FILE, __LINE__);
$file = "$DOXPATH/$arr[filename]";
if (!is_file($file)) 
die("File not found\n");
$f = fopen($file, "rb");
if (!$f)
die("Cannot open file\n");
header("Content-Length: " . filesize($file));
do
{
$s = fread($f, 4096);
print($s);
} while (!feof($f));
closefile($f);
?>