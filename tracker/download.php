<?php
// CyBerFuN

$THIS_BASEPATH=dirname(__FILE__);
$mysiteurl = "[tracker.cyberfun.ro]";

require_once("$THIS_BASEPATH/include/functions.php");
require_once ("$THIS_BASEPATH/include/BDecode.php");
require_once ("$THIS_BASEPATH/include/BEncode.php");

dbconn();

(isset($_GET["key"])? $key=$_GET["key"] : $key=0);

if (!$CURUSER || $CURUSER["can_download"]=="no" || $CURUSER["dlrandom"]!=$key)
   {
       require(load_language("lang_main.php"));
       die($language["NOT_AUTH_DOWNLOAD"]);
   }

if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression','Off');

$infohash=$_GET["id"];
$filepath=$TORRENTSDIR."/".$infohash . ".btf";

if (!is_file($filepath) || !is_readable($filepath))
   {

       require(load_language("lang_main.php"));
       die($language["CANT_FIND_TORRENT"]);
    }

$f=urldecode($_GET["f"]);

// pid code begin
$result=do_sqlquery("SELECT pid FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER['uid']);
$row = mysql_fetch_assoc($result);
$pid=$row["pid"];
if (!$pid)
   {
   $pid=md5(uniqid(rand(),true));
   do_sqlquery("UPDATE {$TABLE_PREFIX}users SET pid='".$pid."' WHERE id='".$CURUSER['uid']."'");
   if ($XBTT_USE)
      do_sqlquery("UPDATE xbt_users SET torrent_pass='".$pid."' WHERE uid='".$CURUSER['uid']."'");
}

$result=do_sqlquery("SELECT * FROM {$TABLE_PREFIX}files WHERE info_hash='".$infohash."'");
$row = mysql_fetch_assoc($result);



###################################################################
# Append tracker announce

if ($row["external"]=="yes") {

    $fd = fopen($filepath, "rb");
    $alltorrent = fread($fd, filesize($filepath));
    fclose($fd);
    
    $alltorrent=BDecode($alltorrent);
      
      if ($PRIVATE_ANNOUNCE) {
         if ($XBTT_USE)
            $announce = $XBTT_URL."/$pid/announce";
         else
             $announce = $BASEURL."/announce.php?pid=$pid";
      } else { 
           if ($XBTT_USE)
              $announce = $XBTT_URL."/announce";
           else
               $announce = $BASEURL."/announce.php";
        }
             if (isset($alltorrent["announce-list"]))
                $alltorrent["announce-list"][][0] = $announce;
              else
                  $alltorrent["announce-list"] = array(array($announce), array($alltorrent["announce"]));

    $alltorrent["announce"] = $announce;
     
    $alltorrent=BEncode($alltorrent);

    if ($XBTT_USE) {
      $xbthash=do_sqlquery("SELECT info_hash FROM xbt_files WHERE info_hash=UNHEX('$infohash')");
        if (mysql_num_rows($xbthash)==0)
           do_sqlquery("INSERT INTO xbt_files SET info_hash=0x$infohash ON DUPLICATE KEY UPDATE flags=0",true);
    }
    do_sqlquery("UPDATE {$TABLE_PREFIX}files SET external='no' WHERE info_hash='".$infohash."'",true);


    header("Content-Type: application/x-bittorrent");
    header('Content-Disposition: attachment; filename="'.$mysiteurl.''.$f.'"');
    print_r($alltorrent);

}
# End
##################################################################
else
    {
    $fd = fopen($filepath, "rb");
    $alltorrent = fread($fd, filesize($filepath));
    $array = BDecode($alltorrent);
    fclose($fd);
//    print($alltorrent."<br />\n<br />\n");
    if ($XBTT_USE)
    {
       $array["announce"] = $XBTT_URL."/$pid/announce";
       if (isset($array["announce-list"]) && is_array($array["announce-list"]))
          {
          for ($i=0;$i<count($array["announce-list"]);$i++)
              {
              if (in_array($array["announce-list"][$i][0],$TRACKER_ANNOUNCEURLS))
                 {
                 if (strpos($array["announce-list"][$i][0],"announce.php")===false)
                    $array["announce-list"][$i][0] = trim(str_replace("/announce", "/$pid/announce", $array["announce-list"][$i][0]));
                 else
                    $array["announce-list"][$i][0] = trim(str_replace("/announce.php", "/announce.php?pid=$pid", $array["announce-list"][$i][0]));
                 }
              }
          }
    }
    else
    {
       $array["announce"] = $BASEURL."/announce.php?pid=$pid";
       if (isset($array["announce-list"]) && is_array($array["announce-list"]))
          {
          for ($i=0;$i<count($array["announce-list"]);$i++)
              {
              if (in_array($array["announce-list"][$i][0],$TRACKER_ANNOUNCEURLS))
                 {
                 if (strpos($array["announce-list"][$i][0],"announce.php")===false)
                    $array["announce-list"][$i][0] = trim(str_replace("/announce", "/$pid/announce", $array["announce-list"][$i][0]));
                 else
                    $array["announce-list"][$i][0] = trim(str_replace("/announce.php", "/announce.php?pid=$pid", $array["announce-list"][$i][0]));
                 }
              }
          }

    }
    $alltorrent=BEncode($array);

    header("Content-Type: application/x-bittorrent");
    header('Content-Disposition: attachment; filename="'.$mysiteurl.''.$f.'"');
    print($alltorrent);
    }
?>
