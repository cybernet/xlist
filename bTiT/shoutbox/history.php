<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
else{

$header="Shoutbox History";
$shoutres = mysql_query('SELECT COUNT(*) FROM shoutbox ORDER BY msgid DESC');
$shoutnum = mysql_fetch_row($shoutres);
$num=$shoutnum[0];
    $perpage=$SBX['limit'];
    list($pagertop, $pagerbottom, $limit) = pager($perpage, $num, "shoutbox.php?act=history&");
$content=$pagertop;

        $query = "SELECT * FROM shoutbox ORDER BY msgid DESC $limit";
       //echo $query;
$result = mysql_query($query);
while ($row = mysql_fetch_array($result)) {

 $userdetails=mysql_query("SELECT users.username, users.id_level, users.joined, users.lastconnect, users.flag, users.avatar, users.uploaded, users.downloaded, country.name AS cname, country.flagpic AS cpic, levels.level, levels.prefixcolor AS pcol, levels.suffixcolor AS scol FROM users LEFT JOIN countries AS country ON users.flag = country.id LEFT JOIN users_level AS levels ON users.id_level = levels.id WHERE users.id =".$row['userid']."");
if($row['userid'] == 0)
$userres="";
else
$userres=mysql_fetch_array($userdetails);
//is the current user for shout still a member of site? if not use detials stored in shoutbox table
$modtoolbar=".";

//Guest settings
    if($userres=="" || $userres==0){
       $poster= unesc($row["user"]);
       $country="unknown";
       $flag="unknown.gif";
       $uploaded="0.00 KB";
       $downloaded="0.00 KB";
       $ratio="(SR ---)";
       $level=$SBX['guest'];
if ($CURUSER['delete_forum'] == "yes"){
              $modtoolbar="<a href=\"shoutbox.php?act=shout&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_delete.png","",DELETE)."</a>";
}
if ($CURUSER['edit_forum'] == "yes"){
              $modtoolbar.="<a href=\"shoutbox.php?act=edit&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_edit.png","",EDIT)."</a>";
}
       }
//Member settings
    else{
       $poster="<a href=\"userdetails.php?id=".$row["userid"]."\">" . unesc($userres["pcol"]) . unesc($userres["username"]) . unesc($userres["scol"]) . "</a>";
       $country=$userres["cname"];
          if (($CURUSER['uid'] == $row['userid'] || $CURUSER['delete_forum'] == "yes") && $CURUSER['uid'] > 1)
              $modtoolbar="<a href=\"shoutbox.php?act=shout&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_delete.png","",DELETE)."</a>";
          if (($CURUSER['uid'] == $row['userid'] || $CURUSER['edit_forum'] == "yes") && $CURUSER['uid'] > 1){
              $modtoolbar.="<a href=\"shoutbox.php?act=edit&id=".$row['msgid']."\">".image_or_link("$STYLEPATH/f_edit.png","",EDIT)."</a>";
}
       $flag=$userres['cpic'];
       $uploaded=makesize($userres['uploaded']);
       $downloaded=makesize($userres['downloaded']);
       $ratio="(SR ".($userres['downloaded']>0?number_format($userres['uploaded']/$userres['downloaded'],2):"---").")";
       $level=$userres['level'];
       $avatar=$userres['avatar'];
}
include("include/offset.php");
$postdate=date("".$SBX['date']."",$row["date"]-$offset)."";

$shout_msg=format_comment($row["message"]);

//builds the html tables
$model=make_html($SBX['layout'],$poster,$country,$flag,$level,$uploaded,$downloaded,$postdate,$ratio,$flag,$avatar,$modtoolbar,$shout_msg);

        $content.= $model;
//echo $shout_msg;
}
}

?>
