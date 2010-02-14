<?

$dbhost = "mysql.cyberfun.ro";
$dbuser = "tracker_new";
$dbpass = "37nnM7AteCKNqTys";
$database = "tracker_new";
$user ="4";

require_once ("include/functions.php");
// require_once ("include/config.php");

// connect to db
if ($GLOBALS["persist"])
    $conres=mysql_pconnect($dbhost, $dbuser, $dbpass) or show_error("Tracker errore - mysql_connect: " . mysql_error());
else
    $conres=mysql_connect($dbhost, $dbuser, $dbpass) or show_error("Tracker errore - mysql_connect: " . mysql_error());

    mysql_select_db($database) or show_error("Tracker errore - $database - ".mysql_error());
//	  $q=mysql_query("SELECT lastupdate AS ts, UNIX_TIMESTAMP() as xx from peers WHERE peer_id='$peer_id'");
//	  $a=mysql_result($q,0,"ts");
//	  $b=mysql_result($q,0,"xx");
//	  $pla=$b-$a;
//	 $rat = $uploaded / ( $pla + 1 );
//	 $rate=intval($rat);
// 	 if($rat>=100){
//	 $r=mysql_query("SELECT username,id as uid FROM users WHERE pid='$pid'");
//	 $uid=mysql_result($r,0,"uid");
//	 $user=mysql_result($r,0,"username");
//	 $r=mysql_query("SELECT filename FROM namemap WHERE info_hash='$info_hash'");
//	 $nm=mysql_result($r,0,"filename");
// 	 $added = "UNIX_TIMESTAMP()";
// modded by cybernet @ tracker.cyberfun.ro //
$cf_body="The member $user is possible to cheated ratio at the torrent $nm, by uploading ".makesize($uploaded)." with ".makesize($rat)." per second!";
$cf_subject = "WARNING -- $user its cheating";
$body = sqlesc($cf_body);
$subject = sqlesc($cf_subject);
$cf_forum_id = 5; // ID of the forum that topic should be created
$cf_user_id = 3; // ID of the system user
quickQuery("INSERT INTO topics (userid, forumid, subject) VALUES('$cf_user_id', '$cf_forum_id', '$cf_subject')") or sqlerr(__FILE__, __LINE__);
$cf_topic_id = mysql_insert_id() or sqlerr(__FILE__, __LINE__);
quickQuery("INSERT INTO `posts` (`topicid` , `userid` , `added` , `body` , `editedby` , `editedat` ) 
VALUES ('$cf_topic_id', '$cf_user_id', UNIX_TIMESTAMP() , '$body', '0', '0');");
quickQuery("UPDATE forums SET topiccount=topiccount+1 WHERE id=$cf_forum_id");
// update_topic_last_post("$cf_topic_id");
// warns
$msg_warn = "Hello $user";
$subj_warn = "Since you made an upload with more than ".makesize($rat)." cybernet decided to give you a little present, his giving you $cf_warned_for warning ,Have FuN, be carreful you have $cf_how_many_warns"; // cybernet funny
$cf_msg_warn = sqlesc($msg_warn);
$cf_subj_warn = sqlesc($subj_warn);
$cf_added = gmdate("Y-m-d H:i:s");
$cf_expire = date("Y-m-d H:i:s", mktime( date("H"), date("i"), date("s"), date(m), date(d)+7,date(Y)));
$cf_active = "yes";
$cf_warned_for = "a 1 week";
$cf_how_many_warns = mysql_query("SELECT warns FROM users WHERE id=".$curuid["id"]."");
while($cf_warn=mysql_fetch_assoc($cf_how_many_warns))
$sqlwarns = sqlesc($cf_warn[warns]+1);
//Executing the queries with the above info
quickQuery("Update users SET warns=warns+1 WHERE id='".$curuid["id"]."'") or sqlerr();
quickQuery("Update users SET awarn='yes' WHERE id='".$curuid["id"]."'") or sqlerr();
quickQuery("INSERT INTO warnings (userid,warns,added,expires,warnedfor,reason,addedby,active) VALUES ('".$curuid["id"]."','$sqlwarns','$added','$cf_expire','$cf_warned_for','$body','$cf_user_id','$cf_active')") or sqlerr();
quickQuery("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES('$cf_user_id','".$curuid["id"]."',UNIX_TIMESTAMP(),'$cf_msg_warn','$cf_subj_warn')") or sqlerr(__FILE__, __LINE__);
?>
