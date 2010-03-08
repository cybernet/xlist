<?php
global $CURUSER;
if (!$CURUSER || $CURUSER["view_users"]=="no")
   {
    // do nothing
   }
else
    {
block_begin("".CF_MEMBER_STATS."");
//$thetime=time();
//$thetime = intval((time() % 7680) / 60);
//$thetime-=60*15;
$curtime=time();
$curtime-=60*15;
$print="";

if (!isset($regusers)) $regusers = 0;
if (!isset($gueststr)) $gueststr = '';
//if (!isset($users)) $users = '';
$users="";

$res=mysql_query("SELECT username, users.id, prefixcolor, suffixcolor FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE UNIX_TIMESTAMP(lastconnect)>=".$curtime." AND users.id>1") or die(mysql_error());
$print.=("\n<tr><td class=lista align=center>");
if ($res)
 {
 while ($ruser=mysql_fetch_row($res))
       {
//donor by monosgeri
$donor_stats = mysql_query("SELECT donor FROM users WHERE id = ".$ruser[1]."");
$donor_stat = mysql_fetch_array($donor_stats);
if ($donor_stat[donor] == "no")
$donor = "";
else
$donor = "&nbsp;<img src=\"images/star.gif\" style=\"border-style: none\">";
//donor by monosgeri
       $users.=(($regusers>0?", ":"")."\n<a href=userdetails.php?id=$ruser[1]&returnto=".urlencode($_SERVER['REQUEST_URI']).">".StripSlashes($ruser[2].$ruser[0].$ruser[3])."</a>". Warn_disabled($ruser[1]) . "".$donor."");
       $regusers++;
       }
}
// guest code
$guest_ip  = explode('.', $_SERVER['REMOTE_ADDR']);
$guest_ip  = pack("C*", $guest_ip [0], $guest_ip [1], $guest_ip [2], $guest_ip [3]);
if (!file_exists("addons/guest.dat"))
 {
  $handle = fopen("addons/guest.dat", "w");
  fclose($handle);
}
$handle = fopen("addons/guest.dat", "rb+");
flock($handle, LOCK_EX);
$guest_num = intval(filesize("addons/guest.dat") / 8);
if ($guest_num>0)
 $data = fread($handle, $guest_num * 8);
else
  $data = fread($handle, 8);
$guest=array();
$updated = false;
for($i=0;$i<$guest_num;$i++)
  {
  if ($guest_ip == substr($data,  $i * 8 + 4, 4))
     {
         $updated = true;
         $guest[$i]=pack("L",time()).$guest_ip;
     }
  elseif (join("",unpack("L",substr($data,  $i * 8, 4)))<$curtime)
       $guest_num--;
  else
      $guest[$i] = substr($data, $i * 8, 8);

}
if($updated == false)
{
  $guest[] = pack("L",time()).$guest_ip;
  $guest_num++;
}

rewind($handle);
ftruncate($handle, 0);
fwrite($handle, join('', $guest), $guest_num * 8);
flock($handle, LOCK_UN);
fclose($handle);
$guest_num-=$regusers;
if ($guest_num<0)
 $guest_num=0;
if ($guest_num>0)
 $gueststr.=$guest_num+$regusers." visitor".($guest_num+$regusers>1?"s":"")." ($guest_num Guest".($guest_num>1?"s":"")."\n";
elseif ($guest_num+$regusers==0)
  $print.=NOBODY_ONLINE."\n";
else
  $gueststr.=$guest_num+$regusers." guest".($guest_num+$regusers>1?"s":"")." (";

print("<table width='100%'>");
print($print. $gueststr . ($guest_num>0 && $regusers>0?" ".WORD_AND." ":"") . ($regusers>0?"$regusers ".Member.($regusers>1?"s":"")."): ":")") . $users ."\n</td></tr>");
//block_end();

print("</table>");

//require_once("../include/functions.php");
//dbconn();


//block_begin("Online Members");
//$thetime=time();
//$thetime = intval((time() % 7680) / 60);
//$thetime-=60*15;
$curtime1=time();
$curtime1-=60*15;
$print1="";

if (!isset($regusers1)) $regusers1 = '';
if (!isset($gueststr1)) $gueststr1 = '';
if (!isset($users1)) $users1 = '';

global $CURUSER;

$res1=mysql_query("SELECT username, users.id, prefixcolor, suffixcolor,users_level.id_level, users_level.level FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE UNIX_TIMESTAMP(lastconnect)>=".$curtime1." AND users.id>1") or die(mysql_error());
if ($res) {
 while ($ruser1=mysql_fetch_object($res1)){
   $userLevel1=$ruser1->level;
@$NumUsers1[$userLevel1]++;
      $regusers1++;
 }
}
$s1 = $NumUsers1["Owner"];
$s2 = $NumUsers1["Administrator"];
$s3 = $NumUsers1["Moderator"];
$staff1 = $s1 + $s2 + $s3;

print("<table width='100%'>");
print("<tr><td class='header'>".CF_TOTAL_MEMBERS."</td><td class='header'>$regusers1</td></tr>\n");

print("<tr><td class='lista'>Owner:</td><td class='lista'>");
if(isset($NumUsers1["Owner"])){
print($NumUsers1["Owner"]);
} else {
print("0");
}
print("</td></tr>\n");

print("<tr><td class='lista'>Administor:</td><td class='lista'>");
if(isset($NumUsers1["Administrator"])){
print($NumUsers1["Administrator"]);
} else {
print("0");
}
print("</td></tr>\n");

print("<tr><td class='lista'>Moderators:</td><td class='lista'>");
if(isset($NumUsers1["Moderator"])){
print($NumUsers1["Moderator"]);
} else {
print("0");
}
print("</td></tr>\n");

print("<tr><td class='lista'>VIP</td><td class='lista'>");
if(isset($NumUsers1["V.I.P."])){
print($NumUsers1["V.I.P."]);
} else {
print("0");
}

print("</td></tr>\n");

print("<tr><td class='lista'>Uploaders</td><td class='lista'>");
if(isset($NumUsers1["Uploader"])){
print($NumUsers1["Uploader"]);
} else {
print("0");
}
print("</td></tr>\n");

//poweruser start
print("<tr><td class='lista'>Poweruser</td><td class='lista'>");
if(isset($NumUsers1["Poweruser"])){
print($NumUsers1["Poweruser"]);
} else {
print("0");
}
print("</td></tr>\n");
//poweruser ends

print("<tr><td class='lista'>Members</td><td class='lista'>");
if(isset($NumUsers1["Members"])){
print($NumUsers1["Members"]);
} else {
print("0");
}
print("</td></tr>\n");
// guest code

print("<tr><td class='lista'>Guests</td><td class='lista'>");
if(isset($guest_num)){
print($guest_num);
} 
else 
{ 
print("0");
}
print("</td></tr></table>");

print("<tr><td class='header'>".CF_MEMBERS_ONLINE_TODAY."</tr>\n");
dbconn();
$sql = "SELECT users_level.prefixcolor AS prefixcolor, users_level.suffixcolor AS suffixcolor, users.id AS id, users.username AS username FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id>1 AND lastconnect BETWEEN (NOW() - INTERVAL 1 DAY )AND (NOW()) ORDER BY username";
$qry=mysql_query($sql);
print("<tr><td align=center class=lista>");
$counter = 0;
while ($res=mysql_fetch_array($qry))
{
   print("<a href=userdetails.php?id=$res[id]>".unesc($res["prefixcolor"]).unesc($res["username"]).unesc($res["suffixcolor"])."</a>" . Warn_disabled($ruser[1]) . " ");
   $counter++;
}
print("<br><br>".CF_MEMBERS_ACTIVE_TODAY." ".$counter);
print("</td></tr>");
     block_end();
}
?>
