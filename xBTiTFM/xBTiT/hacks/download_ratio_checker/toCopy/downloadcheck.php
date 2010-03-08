<?php

$minratio=$btit_settings["mindlratio"];

// load language file
require(load_language("lang_downloadcheck.php"));

$dlchecktpl = new bTemplate();
$dlchecktpl -> set("language",$language);

if (!$CURUSER || $CURUSER["view_torrents"]=="no" || $CURUSER["can_download"]=="no")
{
    err_msg($language["ERROR"],$language["NOT_AUTH_DOWNLOAD"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}

(isset($_GET["id"]) ? $id=mysql_real_escape_string($_GET["id"]) : $id="");

if($id=="")
{
    err_msg($language["ERROR"],$language["BAD_ID"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
}
  
$res = do_sqlquery("SELECT f.filename, f.size, f.uploader, u.username, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}files f LEFT JOIN {$TABLE_PREFIX}users u ON u.id=f.uploader LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE info_hash='$id'");
if(mysql_num_rows($res)==1)
    $row=mysql_fetch_assoc($res);
else
{
    err_msg($language["ERROR"],$language["BAD_ID"]);
    stdfoot(($GLOBALS["usepopup"]?false:true));
    die();
} 
if ($XBTT_USE)
   $res=do_sqlquery("SELECT u.id, (u.downloaded+IFNULL(x.downloaded,0)) as downloaded, ((u.uploaded+IFNULL(x.uploaded,0))/(u.downloaded+IFNULL(x.downloaded,0))) as ratio FROM {$TABLE_PREFIX}users u LEFT JOIN xbt_users x ON x.uid=u.id WHERE u.id=".$CURUSER["uid"]);
else
   $res=do_sqlquery("SELECT id, downloaded, (uploaded/downloaded) as ratio FROM {$TABLE_PREFIX}users WHERE id=".$CURUSER["uid"]);

$user = mysql_fetch_assoc($res); 

$uploader="<a href=userdetails.php?id=".$row["uploader"].">".stripslashes($row["prefixcolor"]).$row["username"].stripslashes($row["suffixcolor"])."</a>";
(is_numeric($user["ratio"])?$ratio=number_format($user["ratio"], 3):$ratio=$user["ratio"]);

$dlcheck=array();
$dlcheck["username"]=$CURUSER["username"];

// user downloaded less than 10mb or good ratio, or by pass, or admin, or is uploader
if($user["downloaded"]<="1048576" || $ratio>=$minratio || $ratio=="oo" || $CURUSER["bypass_dlcheck"]==1 || $CURUSER["admin_access"]=="yes" || $row["uploader"]==$CURUSER["uid"]) {
    $dlcheck["result"]=$language["TORRENT_READY"];
    $dlcheck["link"]="<a href='download.php?id=$id&amp;f=".urlencode($row["filename"]).".torrent&amp;key=".$CURUSER["dlrandom"]."'><img src='images/download.gif' border='0' alt='Download ".$row["filename"]."'>&nbsp;&nbsp;Download Now</a>";
}
else {
    $dlcheck["result"]=$language["TORRENT_NOT_READY_1"] . $minratio . $language["TORRENT_NOT_READY_2"];
    $dlcheck["link"]=$language["CANT_DOWNLOAD"];
}
$dlcheck["ratio"]=$ratio;
$dlcheck["size"]=makesize($row["size"])." (".number_format($row["size"])." bytes)";
$dlcheck["uploader"]=$uploader;
$dlcheck["filename"]=$row["filename"];

$dlchecktpl -> set("dlcheck", $dlcheck);

?>