<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
function do_sanity() {

         global $warntimes, $PRIVATE_ANNOUNCE, $TORRENTSDIR, $CURRENTPATH,$LIVESTATS,$LOG_HISTORY, $invite_timeout;
//Dox Hack Start
         $r = mysql_query("SELECT id, filename, added FROM dox WHERE added < '" . date('Y-m-d', strtotime('-' . $GLOBALS["dox_del"] . ' weeks')) . "'");
         while ($del = mysql_fetch_array($r))
            {
              unlink("$DOXPATH/$del[filename]");
              quickQuery("DELETE FROM dox WHERE id=$del[id]");
            }
//Dox Hack End
/////////Update Seederbonus for BtitTracker by CobraCRK         (original ideea from TvRecall)   /////////
if ($GLOBALS["enable_bonus"] == true)
{
   $res = mysql_query("SELECT DISTINCT pid FROM peers WHERE status = 'seeder'");
   if (mysql_num_rows($res) > 0)
   {
       while ($arr = mysql_fetch_assoc($res))
       {
	   $x=$arr['pid'];
// Added for a sanity.php level on 1800 sec, 30 min. THe other one is for a sanity.php setted on 600 sec, 10 min.
	mysql_query("UPDATE users SET seedbonus = seedbonus+0.466 WHERE pid = '$x'");   
//       mysql_query("UPDATE users SET seedbonus = seedbonus+0.166 WHERE pid = '$x'");
       }
   }
}
// END SEEDBONUS HACK

  //CobraCRK's Anti Hit&Run Mod v1 Start - fixed for PB Edition by fatepower
if ($GLOBALS["enable_hr"] == true)
{
 $res = mysql_query("SELECT pid, infohash FROM peers WHERE status = 'seeder'");

   if (mysql_num_rows($res) > 0)
   {
       while ($arr = mysql_fetch_assoc($res))
       {
	   $x=$arr['pid'];
	   $t=$arr['infohash'];
	   $pl=mysql_query("SELECT id FROM users WHERE pid='$x'");
	   $ccc=mysql_result($pl,0,"id");
	   mysql_query("UPDATE history SET seed = seed+1800 WHERE uid = $ccc AND infohash='$t'");
	}
   }


$r=mysql_query("SELECT uid,infohash FROM history WHERE active='no' AND hit=0 AND date < ( UNIX_TIMESTAMP( ) - 604800) AND downloaded>104857600 AND seed<72000 AND uploaded/downloaded<0.60 ");
echo mysql_num_rows($r);				
while($x = mysql_fetch_array($r)){
	$t=mysql_query("SELECT username FROM users WHERE id=$x[uid]");
	$xa=mysql_result($t,0,"username");
	echo "$xa ";
$a=mysql_query("SELECT id_level FROM users WHERE id=$x[uid] LIMIT 1");
$p=mysql_result($a,0,"id_level");
if($p<4)
{
	@mysql_query("Update users SET uploaded=uploaded-3221225472 WHERE id=$x[uid]");
	@mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES (21313,$x[uid],UNIX_TIMESTAMP(),'You are a hit&runner','You have made hit&run at the torrent: [URL]details.php?id=$x[infohash][/URL] ! Your upload is now 3GB lower! Continue this way and you shall be banned soon!')");
	@mysql_query("Update history SET hit=2 WHERE uid=$x[uid] AND infohash='$x[infohash]'");
//	echo "Update history SET hit=2 WHERE uid=$x[uid] AND infohash=$x[infohash]";
}
}
}
  //CobraCRK's Anti Hit&Run Mod v1 Ends - fixed for PB Edition by fatepower

         // SANITY FOR TORRENTS
         $results = mysql_query("SELECT summary.info_hash, seeds, leechers, dlbytes, namemap.filename FROM summary LEFT JOIN namemap ON summary.info_hash = namemap.info_hash WHERE namemap.external='no'");
         $i = 0;
         while ($row = mysql_fetch_row($results))
         {
             list($hash, $seeders, $leechers, $bytes, $filename) = $row;

         $timeout=time()-intval($GLOBALS["report_interval"]);

         // for testing purpose -- begin
         $resupd=mysql_query("SELECT * FROM peers where lastupdate < ".$timeout ." AND infohash='$hash'");
         if (mysql_num_rows($resupd)>0)
            {
            while ($resupdate = mysql_fetch_array($resupd))
              {
                  $uploaded=max(0,$resupdate["uploaded"]);
                  $downloaded=max(0,$resupdate["downloaded"]);
                  $pid=$resupdate["pid"];
                  $ip=$resupdate["ip"];
//Golden Torrents by CobraCRK - fixed for PB Edition by fatepower

				  $q=mysql_query("SELECT free from namemap WHERE info_hash = '$hash'");
				  $t=mysql_result($q,0,"free");
				  if($t=="yes") {
						$downloaded=0;
				  }
                  // update user->peer stats only if not livestat
                  if (!$LIVESTATS)
                    {
                      if ($PRIVATE_ANNOUNCE)
                         quickQuery("UPDATE users SET uploaded=uploaded+$uploaded, downloaded=downloaded+$downloaded WHERE pid='$pid' AND id>1 LIMIT 1");
                      else // ip
                          quickQuery("UPDATE users SET uploaded=uploaded+$uploaded, downloaded=downloaded+$downloaded WHERE cip='$ip' AND id>1 LIMIT 1");
                     }

                  // update dead peer to non active in history table
                  if ($LOG_HISTORY)
                     {
                          $resuser=mysql_query("SELECT id FROM users WHERE ".($PRIVATE_ANNOUNCE?"pid='$pid'":"cip='$ip'")." ORDER BY lastconnect DESC LIMIT 1");
                          $curu=@mysql_fetch_row($resuser);
                          quickquery("UPDATE history SET active='no' WHERE uid=$curu[0] AND infohash='$hash'");
                     }

            }
         }
         // for testing purpose -- end

            quickQuery("DELETE FROM peers where lastupdate < ".$timeout." AND infohash='$hash'");
            quickQuery("UPDATE summary SET lastcycle='".time()."' WHERE info_hash='$hash'");

             $results2 = mysql_query("SELECT status, COUNT(status) from peers WHERE infohash='$hash' GROUP BY status");
             $counts = array();
             while ($row = mysql_fetch_row($results2))
                 $counts[$row[0]] = 0+$row[1];

             quickQuery("UPDATE summary SET leechers=".(isset($counts["leecher"])?$counts["leecher"]:0).",seeds=".(isset($counts["seeder"])?$counts["seeder"]:0)." WHERE info_hash=\"$hash\"");
             if ($bytes < 0)
             {
                 quickQuery("UPDATE summary SET dlbytes=0 WHERE info_hash=\"$hash\"");
             }

         }
         // END TORRENT'S SANITY

         //  optimize peers table
         quickQuery("OPTIMIZE TABLE peers");
         // PM DELETING
         quickQuery("DELETE FROM messages WHERE delbysender='yes' AND delbyreceiver='yes'");

		 // delete readposts when topic don't exist or deleted  *** should be done by delete, just in case
		 quickQuery("DELETE readposts FROM readposts LEFT JOIN topics ON readposts.topicid = topics.id WHERE topics.id IS NULL");
		 
		 // delete readposts when users was deleted *** should be done by delete, just in case
		 quickQuery("DELETE readposts FROM readposts LEFT JOIN users ON readposts.userid = users.id WHERE users.id IS NULL");
		 
         // deleting orphan image in torrent's folder (if image code is enabled)
         $tordir=realpath("$CURRENTPATH/../$TORRENTSDIR");
         if ($dir = @opendir($tordir."/"));
           {
            while(false !== ($file = @readdir($dir)))
               {
                   if ($ext = substr(strrchr($file, "."), 1)=="png")
                       unlink("$tordir/$file");
               }
            @closedir($dir);
         }
// LOTTERY HACK
$query	= mysql_query("SELECT * FROM config WHERE id=1");
$config = mysql_fetch_array($query);
$expire_date = $config['lot_expire_date'];
$expire = strtotime ($expire_date);
if (strtotime(date("d-m-Y H:i")) >= $expire )
{
$number_winners = $config['lot_number_winners'];
$number_to_win = $config['lot_number_to_win'];
$minupload = $config['lot_amount'];
$res = mysql_query("SELECT id, user FROM tickets ORDER BY RAND(NOW()) LIMIT ".$number_winners.""); //select number of winners
$total = mysql_num_rows(mysql_query("SELECT * FROM tickets")); //select total selled tickets
$pot = $total * $minupload; //selled tickets * ticket price
$pot += $number_to_win; // ticket price + minimum win
$win = $pot/$number_winners; // price for each winner
$subject = 'You have won a price witch the lottery'; //subject in pm
$msg = "Congratulations you have won a price with our Lottery Your price has been added to your account<br> Price was: ".makesize($win).""; //next 3 rows are the msg for PM
$sender = 2; // Sender id, in my case 0

//print the winners and send them PM en give them price
while($row=mysql_fetch_array($res)){

	$ras = mysql_query("SELECT id, username FROM users WHERE id='".$row['user']."'");
	$raw = mysql_fetch_array($ras);
    $rec = $raw['id'];
	mysql_query("UPDATE users SET uploaded=uploaded+".$win." WHERE id=".$row['user']."");
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES ($sender, $rec, UNIX_TIMESTAMP(), ".sqlesc($subject).",  " . sqlesc($msg) .")") or sqlerr(__FILE__,__LINE__);
	mysql_query("INSERT INTO lottery_winners (id, win_user, windate, price) VALUES ('', '".$raw['username']."', '".$expire_date."', '".$win."')"); 
}
mysql_query("TRUNCATE TABLE tickets");
mysql_query("UPDATE config SET lot_status='closed' WHERE id=1");
}
// END LOTERY HACK
//AutoWarn Low Ratio User Start - 14:32 3/10-2007 - fixed for PB Edition by fatepower
if ($GLOBALS["enable_awarn"] == true)
{
//Now only usergroups who are from id_level = 3 and up to id_level = 6 who gets warned
$autowarn=mysql_query("SELECT id, warns FROM users WHERE id_level>=3 AND id_level<=6 AND downloaded>5368709120 AND uploaded/downloaded<0.50 AND disabled='no' AND awarn='no'");
//$autowarn=mysql_query("SELECT id FROM users WHERE downloaded>5368709120 AND uploaded/downloaded<0.50 AND disabled='no' AND awarn='no'");

$period = "a 1 week";
$reason = "your ratio is under 0.5";
$subj = sqlesc("WARNING !!!");
$msg = sqlesc("You have received [b]".$period." warning[/b] from [b]The System[/b] because: [b]".$reason."[/b].");
$added = gmdate("Y-m-d H:i:s");
$sqladded = sqlesc($added);
$expiration  = date("Y-m-d H:i:s", mktime( date("H"), date("i"), date("s"), date(m), date(d)+7,date(Y)));
$warnedfor = "1";
$addedby = "0";
$active = "yes";

function warn_expiration($timestamp = 0)
 {
   return date("Y-m-d H:i:s", $timestamp);
 }

while($warn=mysql_fetch_assoc($autowarn)) {
$warnings = mysql_fetch_array($autowarn);
$sqlwarns = sqlesc($warn[warns]+1);

//Executing the queries with the above info
mysql_query("Update users SET warns=warns+1 WHERE id=$warn[id]") or sqlerr();
mysql_query("Update users SET awarn='yes' WHERE id=$warn[id]") or sqlerr();
mysql_query("INSERT INTO warnings (userid,warns,added,expires,warnedfor,reason,addedby,active) VALUES ('$warn[id]',$sqlwarns,'$added','$expiration','$warnedfor','$reason','$addedby','$active')") or sqlerr();
mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(0,'$warn[id]',UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);
}
}
//AutoWarn Low Ratio User Ends - fixed for PB Edition by fatepower
//Added Disable function and Updated for PB Edition 11:14 AM 10/2/2007
//AutoRemove User Warnings Upon Expiration Hack Start - 11:14 AM 10/2/2007
$datetime = gmdate("Y-m-d H:i:s");
$subj = sqlesc("WARN EXPIRED !!!");
$msg = sqlesc("Your warning expired and has been removed by the System.");
$warnstats = mysql_query("SELECT userid, warns, warnedfor FROM warnings WHERE expires <= '$datetime' AND active='yes'");

   while ($arr = mysql_fetch_assoc($warnstats))
   {
	if (mysql_num_rows($warnstats) > 0)
	  {
	    $numwarns = $arr["warns"]+1;
	    //SiteLog Hack Start
	    $username = mysql_query("SELECT username FROM users WHERE id='$arr[userid]'");
	    $uname = mysql_fetch_assoc($username);
	    //SiteLog Hack Stop
	    if ("$numwarns" > "$warntimes")
	      {
	        //SiteLog Hack Start
	            write_log("Account <b>".$uname["username"]."</b> was Disabled by the <b>Sanity Check</b>","delete");
	        //SiteLog Hack Stop
	        $reason="Maximum number of warnings reached!";
	        mysql_query("UPDATE warnings SET active='no' WHERE userid='$arr[userid]' AND active='yes'") or sqlerr();
	        mysql_query("UPDATE users SET warnremovedby='2', disabled='yes', disabledby='0', disabledon='$datetime', disabledreason='$reason' WHERE id='$arr[userid]' AND username='$uname[username]'") or sqlerr();
	      }
	    else
	      {
		if ($arr["warnedfor"] == "0")
		  {
		  }
		else
		  {
	        //SiteLog Hack Start
	            write_log("Warning for user <b>".$uname["username"]."</b> was AutoRemoved by the <b>Sanity Check</b>","add");
	        //SiteLog Hack Stop
		    mysql_query("UPDATE users SET awarn='no' WHERE id='$arr[userid]' AND awarn='yes'") or sqlerr();
		    mysql_query("UPDATE warnings SET active='no' WHERE userid='$arr[userid]' AND active='yes'") or sqlerr();
		    mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES('0','$arr[userid]',UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);
		    mysql_query("UPDATE users SET warnremovedby='2' WHERE id='$arr[userid]' AND username='$uname[username]'") or sqlerr();
		  }
	      }
	  }
   }
//AutoRemove user Warnings Upon Expiration Hack Stop
//Auto Delete Account After Disable Hack Start - 10:45 PM 9/8/2006
if ($GLOBALS["autodeldisabled"]==true)
{
$disable = $GLOBALS[acctdisable];
$accountdisable = $disable*86400;

$disablestats = mysql_query("SELECT disabledon, id FROM users WHERE disabled='yes' AND disabledon < DATE_SUB(NOW(), INTERVAL $accountdisable SECOND)");
   while ($arr2 = mysql_fetch_assoc($disablestats))
   {
     mysql_query("DELETE FROM users WHERE id = $arr2[id]");
   }
}
//Auto Delete Account After Disable Hack Stop
//Invalid Login System Hack Start - 11:27 12/23/2006
mysql_query("DELETE FROM bannedip WHERE comment='max number of invalid logins reached'");
//invalid Login System Hack Stop
//Start Auto upgrade/downgrade user's - fixed for PB Edition by fatepower
$demotelist=mysql_query("SELECT id FROM users WHERE uploaded>26843545600 AND uploaded/downloaded<1.05 AND id_level=4");
while($demote=mysql_fetch_assoc($demotelist)) {
mysql_query("UPDATE users SET id_level=3 WHERE id=".$demote["id"]);
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES('0', '$demote[id]',UNIX_TIMESTAMP(), 'Demoted!!', 'You have been demoted to user by the System becuse your ratio is under 1.05. DO NOT REPLY TO THIS PM, ITS AUTO GENERATED BY THE SYSTEM.')");
write_systemlog("Demoted userid $demote[id] from PowerUser to User","delete");
}
$promotelist=mysql_query("SELECT id FROM users WHERE uploaded>=26843545600 AND uploaded/downloaded>=1.25 AND id_level=3");
while($promote=mysql_fetch_assoc($promotelist)) {
mysql_query("UPDATE users SET id_level=4 WHERE id=".$promote["id"]);
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES('0', '$promote[id]',UNIX_TIMESTAMP(), 'Premoted!!', 'You have been Premoted to poweruser by the System becuse your ratio is over 1.25 and uploaded more then 25GB. DO NOT REPLY TO THIS PM, ITS AUTO GENERATED BY THE SYSTEM.')");
write_systemlog("Premoted userid $promote[id] from User to PowerUser","add");
}
//End Auto upgrade/downgrade user's - fixed for PB Edition by fatepower
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
function autoinvites($length, $minlimit, $maxlimit, $minratio, $invites)
{
	$time = $length*86400;
	$minlimit = $minlimit*1024*1024*1024;
	$maxlimit = $maxlimit*1024*1024*1024;
	$res = mysql_query("SELECT id, invites FROM users WHERE id_level >= 3  AND downloaded >= $minlimit AND downloaded < $maxlimit AND uploaded / downloaded >= $minratio AND invites < 10 AND invitedate < DATE_SUB(NOW(), INTERVAL $time SECOND)") or sqlerr(__FILE__, __LINE__);
	if (mysql_num_rows($res) > 0)
	{
		while ($arr = mysql_fetch_assoc($res))
		{
			if ($arr[invites] == 9)
				$invites = 1;
			elseif ($arr[invites] == 8 && $invites == 3)
				$invites = 2;
			mysql_query("UPDATE users SET invites=invites+$invites, invitedate = NOW() WHERE id=$arr[id]") or sqlerr(__FILE__, __LINE__);
		}
	}
}
//autoinvites(DAYS,MINDOWN,MAXDOWN,MINRATIO,#INVITES)
//all 10 days, a member with a down >1Go and <4Go, with a ratio >=0.90, will have 1 invite
autoinvites(10,1,4,.90,1);
autoinvites(10,4,7,.95,2);
autoinvites(10,7,10,1.00,3);
autoinvites(10,10,100000,1.05,4);

$deadtime = $invite_timeout*86400;
$user = mysql_query("SELECT inviter FROM invites WHERE time_invited < DATE_SUB(NOW(), INTERVAL $deadtime SECOND)");
$arr = mysql_fetch_assoc($user);
if (mysql_num_rows($user) > 0)
{
	$invites = mysql_query("SELECT invites FROM users WHERE id = $arr[inviter]");
	$arr2 = mysql_fetch_assoc($invites);
	if ($arr2[invites] < 10)
	{
		$invites = $arr2[invites] +1;
		mysql_query("UPDATE users SET invites='$invites' WHERE id = $arr[inviter]");
	}
	mysql_query("DELETE FROM invites WHERE inviter = '$arr[inviter]' AND time_invited < DATE_SUB(NOW(), INTERVAL $deadtime SECOND)");
}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

##############################################################
# Innactive users email notification - fixed for PB Edition by fatepower
#
   global $INACTIVE_DAYS, $BASEURL, $SITENAME;
   if($GLOBALS["INACTIVE_EMAIL"] == "true")
   {
	//$elapsed="45";
    $elapsed="$INACTIVE_DAYS";  # This will send email reminder if user doesn't visit for $elapsed time
    $now = time();  # Current time


    $res = mysql_query("SELECT last_time FROM tasks WHERE task='NotActiveMail'");
    $row = mysql_fetch_array($res);


    if (!$row) {
        mysql_query("INSERT INTO tasks (task, last_time) VALUES ('NotActiveMail',$now)");
        return;
    }

# I didn't need a conversion here but for one extra line of code it looks nicer

$timePlus24h = $row["last_time"] + 86400;

$NowDate = date("Y-m-d H:i:s", $now);  # Current Date

$HisDate = date("Y-m-d H:i:s", $timePlus24h); # Date of database update


if($NowDate > $HisDate)
{
mysql_query("UPDATE tasks SET last_time=$now WHERE task='NotActiveMail'");  # Updates tasks table

$sres = mysql_query("SELECT id FROM users WHERE id_level < 11 AND DATE_FORMAT(lastconnect, '%m/%d/%Y') =  DATE_FORMAT(DATE_SUB(NOW(), INTERVAL $elapsed DAY), '%m/%d/%Y')");
while($srow = mysql_fetch_assoc($sres))
{

$rec=$srow["id"];

$res = mysql_query("SELECT email, username FROM users WHERE id = $rec") or sqlerr();
$arr = mysql_fetch_assoc($res);

$email = $arr["email"];
$user = $arr["username"];

$subject = "You are innactive!";
$msg = "$user,\n
        You haven't visited $SITENAME for over $elapsed days!\n
        Your account and your details might be deleted if you do not do so in a few days.\n\n
        In case you have forgotten our website is: $BASEURL\n\n
        Thanks for understanding,\n
        Your $SITENAME";


   ini_set("sendmail_from","");
   if (mysql_errno()==0)
      mail($email, $subject, $msg, "From: $SITENAME Robot");
}
}
}
#
# End of innactive users email notification - fixed for PB Edition by fatepower
##############################################################

}
?>