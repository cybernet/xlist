<?

// CyBerFuN.ro & xList.ro


if (!defined("IN_BTIT"))
      die("non direct access!");


$id = mysql_escape_string($_GET["info_hash"]);

if (!isset($id) || !$id)
    die("Error ID");

if ($XBTT_USE)
   $res = do_sqlquery("SELECT f.screen1, f.screen2, f.screen3, f.image, f.info_hash, f.uploader, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, c.name as cat_name, f.seeds+ ifnull(x.seeders,0) as seeds, f.leechers+ ifnull(x.leechers,0) as leechers, f.finished+ ifnull(x.completed,0) as finished, f.speed FROM {$TABLE_PREFIX}files f LEFT JOIN xbt_files x ON x.info_hash=f.bin_hash LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category WHERE f.info_hash ='" . $id . "'") or die(mysql_error());
else
    $res = do_sqlquery("SELECT f.screen1, f.screen2, f.screen3, f.image, f.info_hash, f.uploader, f.filename, f.url, UNIX_TIMESTAMP(f.data) as data, f.size, f.comment, c.name as cat_name, f.seeds, f.leechers, f.finished, f.speed FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}categories c ON c.id=f.category WHERE f.info_hash ='" . $id . "'") or die(mysql_error());

$row = mysql_fetch_assoc($res);
$image_drop = "" . $row["image"]. "";
      $image_drop1 = "" . $row["screen1"]. "";
      $image_drop2 = "" . $row["screen2"]. "";
      $image_drop3 = "" . $row["screen3"]. "";

if (!$CURUSER || $CURUSER["uid"] < 2 || ($CURUSER["delete_torrents"] != "yes" && $CURUSER["uid"] != $row["uploader"]))
   {
   stderr($language["SORRY"], $language["CANT_DELETE_TORRENT"]);
}

$scriptname = htmlspecialchars($_SERVER["PHP_SELF"]);

$link = urldecode($_GET["returnto"]);
$hash = AddSlashes($_GET["info_hash"]);

if ($link == "")
   $link="index.php?page=torrents";

if (isset($_POST["action"])) {

   if ($_POST["action"] == $language["DELETE"]) {

      $ris = do_sqlquery("SELECT info_hash,filename,url FROM {$TABLE_PREFIX}files WHERE info_hash=\"$hash\"") or die(mysql_error());
      if (mysql_num_rows($ris) == 0)
            {
            stderr("Sorry!", "torrent $hash not found.");
            }
      else
            {
            list($torhash, $torname, $torurl) = mysql_fetch_array($ris);
            }
      write_log("Deleted torrent $torname ($torhash)", "delete");
      if (!empty($image_drop))
		unlink("".$GLOBALS["uploaddir"]."$image_drop");
        if (!empty($image_drop1))
		unlink("".$GLOBALS["uploaddir"]."$image_drop1");
        if (!empty($image_drop2))
		unlink("".$GLOBALS["uploaddir"]."$image_drop2");
        if (!empty($image_drop3))
		unlink("".$GLOBALS["uploaddir"]."$image_drop3");

      @mysql_query("DELETE FROM {$TABLE_PREFIX}files WHERE info_hash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}timestamps WHERE info_hash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}comments WHERE info_hash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}ratings WHERE infohash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}peers WHERE infohash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}history WHERE infohash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}ajax_ratings WHERE info_hash=\"$hash\"");
      @mysql_query("DELETE FROM {$TABLE_PREFIX}files_thanks WHERE info_hash=\"$hash\"");

      IF ($XBTT_USE)
          mysql_query("UPDATE xbt_files SET flags=1 WHERE info_hash=UNHEX('$hash')") or die(mysql_error());

      unlink($TORRENTSDIR."/$hash.btf");

      redirect($link);
      exit();

   }

   else {

   redirect($link);
   exit();

   }

}


$torrenttpl = new bTemplate();
$torrenttpl->set("language", $language);

$torrent = array();
$torrent["filename"] = $row["filename"];
$torrent["info_hash"] = $row["info_hash"];
$torrent["description"] = format_comment($row["comment"]);
$torrent["catname"] = $row["cat_name"];
$torrent["size"] = makesize($row["size"]);
include(dirname(__FILE__)."/include/offset.php");
$torrent["date"] = date("d/m/Y", $row["data"]-$offset);
if (!$XBT_USE)
{
   if ($row["speed"] < 0) {
     $speed = "N/D";
   }
   else if ($row["speed"] > 2097152) {
     $speed = round($row["speed"] / 1048576, 2) . " MB/sec";
   }
   else {
     $speed = round($row["speed"] / 1024, 2) . " KB/sec";
   }
   $torrenttpl->set("NO_XBBT", true, true);
}
else
   $torrenttpl->set("NO_XBBT", false, true);

$torrent["speed"] = $speed;
$torrent["complete"] = $row["finished"];
$torrent["peers"] = $language["PEERS"]." :" .$row["seeds"].",".$language["LEECHERS"] .": ". $row["leechers"]."=". ($row["leechers"]+$row["seeds"]). " ". $language["PEERS"];
$torrent["return"] = urlencode($link);

unset($row);
mysql_free_result($res);

$torrenttpl->set("torrent", $torrent);

?>
