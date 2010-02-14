<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

function login() {
global $PRIVATE_TRACKER;
?>
<?php
block_begin(LOGIN);
//Invalid Login System Hack Start - 10:35 12/23/2006
if ($GLOBALS["inv_login"]==true)
  {
    $real_ip = $_SERVER["REMOTE_ADDR"];
    $db_ip = sprintf("%u", ip2long($real_ip));

    $resource = mysql_query("SELECT * FROM invalid_logins WHERE ip ='".$db_ip."'") or die(mysql_error());
    $result = mysql_fetch_array($resource);

    if (!$result)
      $logins_left = $GLOBALS["login_attempts"];
    else
      $logins_left = $result["remaining"];

    if ($result["remaining"] == "0")
      {
	//find remaining minutes untill next sanity
	  //current time
	  $now = time("d/m/Y H:i:s");

	  //last sanity
	  $res = mysql_query("SELECT last_time FROM tasks WHERE task='sanity' ") or mysqlerr();
	  $sanity = mysql_fetch_assoc($res);
	  $last_sanity = $sanity["last_time"];

	  //next sanity
	  $next_sanity = $last_sanity+$GLOBALS["clean_interval"];

	  //minutes untill next sanity
	  $ban_time = ($next_sanity-$now)/60;

	  $ban = round($ban_time);

	  if ("$ban" >= "2" || "$ban" == "0")
	    $s="s";
	  elseif ("$ban" == 1)
	    $s="";

        print("<table align=\"center\" class=\"lista\" width=\"95%\"><tr><td class=\"lista\" align=\"center\"><b>This is your last remaining login attempt.<br>If you fail to login now you'll be banned for <span style=\"color:#FF6666\">".$ban." minute".$s."</span>.</b><br></td></tr></table>");
      }
  }
//Invalid Login System Hack Stop
if(!isset ($user))$user="";
?>
<form method="post" action="login.php?returnto=<?php echo urlencode("index.php"); ?>">
<table align="center" class="lista" border="0" cellpadding="10">
<!-- Invalid Login System Hack Start - 09:19 12/23/2006 -->
<?php
if ($GLOBALS["inv_login"]==true)
{
  if ("$logins_left" >= "2" || "$logins_left" == "0")
    $ss = "s";
  elseif ("$logins_left" == "1")
    $ss = "";

  print("<tr><td colspan=\"2\"  class=\"header\" align=\"center\">You have <span style=\"color:#FF6666\">".$logins_left."</span> remaining login attempt".$ss.".</td></tr>");
}
?>
<!-- Invalid Login System Hack Stop -->
<tr><td align="right" class="header"><?php echo USER_NAME;?>:</td><td class="lista"><input type="text" size="40" name="uid" value="<?php $user ?>" maxlength="40" /></td></tr>
<tr><td align="right" class="header"><?php echo USER_PWD;?>:</td><td class="lista"><input type="password" size="40" name="pwd" maxlength="40" /></td></tr>
<tr><td colspan="2"  class="header" align="center"><input type="submit" value="<?php echo FRM_CONFIRM;?>" /></td></tr>
<tr><td colspan="2"  class="header" align="center"><?php echo NEED_COOKIES;?></td></tr>
</table>
</form>
<p align="center">
	<?php
	if ($PRIVATE_TRACKER)
	{
		print("<a href=\"recover.php\">".RECOVER_PWD."</a>");
	}
	else
	{
		print("<a href=\"account.php\">".ACCOUNT_CREATE."</a>&nbsp;&nbsp;&nbsp;<a href=\"recover.php\">".RECOVER_PWD."</a>");
	}
	?>
</p>
<?php
block_end();
stdfoot();

}


if (!$CURUSER || $CURUSER["uid"]==1) {
if (isset($_POST["uid"]) && $_POST["uid"])
  $user=$_POST["uid"];
else $user='';
if (isset($_POST["pwd"]) && $_POST["pwd"])
  $pwd=$_POST["pwd"];
else $pwd='';
//Invalid Login System Hack Start - 18:32 12/27/2006
$ip = $_SERVER["REMOTE_ADDR"];
$attempts = $GLOBALS["login_attempts"];
//Invalid Login System Hack Stop
  if (isset($_POST["uid"]) && isset($_POST["pwd"]))
  {
    $res = mysql_query("SELECT * FROM users WHERE username ='".AddSlashes($user)."'")
        or die(mysql_error());
    $row = mysql_fetch_array($res);
//Invalid Login System Hack Start - 18:32 12/27/2006
    $resource = mysql_query("SELECT * FROM invalid_logins WHERE ip='".sprintf("%u", ip2long($ip))."'") or die(mysql_error());
    $results = mysql_fetch_array($resource);
//Invalid Login System Hack Stop

//User Warning System Hack Start - 11:17 01.08.2006
   if ($row["disabled"] == "yes")
        {
           standardheader("Login");
           print("<br /><br /><div align=\"center\"><font size=\"2\" color=\"#FF0000\">".ERR_ACCOUNT_DISABLED."</font></div>");
           login();
        }
//User Warning System Hack Stop

   elseif (!$row)
        {
        standardheader("Login");
        print("<br /><br /><div align=\"center\"><font size=\"2\" color=\"#FF0000\">".ERR_USERNAME_INCORRECT."</font></div>");
//Invalid Login System Hack Start - 18:04 12/27/2006
		if (!$results)
			mysql_query("INSERT INTO invalid_logins SET ip='".sprintf("%u", ip2long($ip))."', userid='".$row['id']."', username='".$row['username']."', failed=failed+1, remaining=$attempts-1") or die(mysql_error());
		elseif ($results["failed"] < "$attempts")
			mysql_query("UPDATE invalid_logins SET ip='".sprintf("%u", ip2long($ip))."', failed=failed+1, remaining=$attempts-failed WHERE ip='".sprintf("%u", ip2long($ip))."'") or die(mysql_error());
		elseif ($results["failed"] == "$attempts" && $results["remaining"] == "0")
			{
			$firstip = $ip;
			$lastip = $ip;
			$comment = "max number of invalid logins reached";
			$firstip = sprintf("%u", ip2long($firstip));
			$lastip = sprintf("%u", ip2long($lastip));
			$comment = sqlesc($comment);
			$added = sqlesc(time());
			mysql_query("INSERT INTO bannedip (added, addedby, first, last, comment) VALUES($added, '2', $firstip, $lastip, $comment)") or die(mysql_error());
			mysql_query("DELETE FROM invalid_logins WHERE ip='".sprintf("%u", ip2long($ip))."' LIMIT 1") or sqlerr();
			}
//Invalid Login System Hack Stop
        login();
        }
    elseif ($row["password"] != md5($pwd))
        {
                standardheader("Login");
                print("<br /><br /><div align=\"center\"><font size=\"2\" color=\"#FF0000\">".ERR_PASSWORD_INCORRECT."</font></div>");
//Invalid Login System Hack Start - 18:04 12/27/2006
		if (!$results)
			mysql_query("INSERT INTO invalid_logins SET ip='".sprintf("%u", ip2long($ip))."', userid='".$row['id']."', username='".$row['username']."', failed=failed+1, remaining=$attempts-1") or die(mysql_error());
		elseif ($results["failed"] < "$attempts" && $results["remaining"] != "0")
			mysql_query("UPDATE invalid_logins SET ip='".sprintf("%u", ip2long($ip))."', failed=failed+1, remaining=$attempts-failed WHERE ip='".sprintf("%u", ip2long($ip))."'") or die(mysql_error());
		elseif ($results["failed"] == "$attempts" && $results["remaining"] == "0")
			{
			$firstip = $ip;
			$lastip = $ip;
			$comment = "max number of invalid logins reached";
			$firstip = sprintf("%u", ip2long($firstip));
			$lastip = sprintf("%u", ip2long($lastip));
			$comment = sqlesc($comment);
			$added = sqlesc(time());
			mysql_query("INSERT INTO bannedip (added, addedby, first, last, comment) VALUES($added, '2', $firstip, $lastip, $comment)") or die(mysql_error());
			mysql_query("DELETE FROM invalid_logins WHERE ip='".sprintf("%u", ip2long($ip))."' LIMIT 1") or sqlerr();
			}
//Invalid Login System Hack Stop
                login();
                }
    else
    {
    logincookie($row["id"],$row["password"]);
    if (isset($_GET["returnto"]))
       $url=urldecode($_GET["returnto"]);
    else
        $url="index.php";
    //Invalid Login System Hack Start - 10:55 12/23/2006
    mysql_query("DELETE FROM invalid_logins WHERE ip='".sprintf("%u", ip2long($ip))."' LIMIT 1") or sqlerr();
    //Invalid Login System Hack Stop

    redirect($url);
    }
  }
  else
  {
   standardheader("Login");
   login();
   exit;
  }
}
else {

  if (isset($_GET["returnto"]))
     $url=urldecode($_GET["returnto"]);
  else
      $url="index.php";

  redirect($url);
}
?>
