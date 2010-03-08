<?php
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
standardheader("Add user");
if ($CURUSER["owner_access"]=="no")

{
err_msg(ERROR, ERR_NOT_AUTH);
stdfoot();
     exit;
}
else

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
if ($_POST["username"] == "" || $_POST["password"] == "" || $_POST["email"] == "")
err_msg(ERROR, ERR_MISSING_DATA);

if ($_POST["password"] != $_POST["password2"])
err_msg(ERROR, DIF_PASSWORDS);

$username=mysql_escape_string($_POST["username"]);
$password=$_POST["password"];
$email=mysql_escape_string($_POST["email"]);

// Create Random number
$floor = 100000;
$ceiling = 999999;
srand((double)microtime()*1000000);
$random = rand($floor, $ceiling);

$usernameexists=mysql_fetch_object(mysql_query("SELECT * FROM users WHERE username='".$username."' "));
if ($usernameexists) {
      block_begin("Add User");
print(ERROR." Username already exists.<br>");
print("<a href=adduser.php>".BACK."</a>");
block_end();
exit();
}


else {
mysql_query("INSERT INTO users (username, password, random, id_level, email, style, language, flag, joined) VALUES ('$username', '" . md5($password) . "', $random, 3, '$email', $DEFAULT_STYLE, $DEFAULT_LANGUAGE, 0, NOW())") or sqlerr(__FILE__, __LINE__);
      block_begin("Add User");
      print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
      print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
      print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b></font><br /><br />".ACCOUNT_CONGRATULATIONS."<br /><br /></td>\n");
      print("</tr></table></div><br />\n");
      block_end();
      exit();
}
}
block_begin("Add User");
?>
<center>
<form method=post action=adduser.php>
<table width="60%" border="0" class="lista">
<tr>
 <td align=left class="header"><? echo USER_NAME ?>: </td>
 <td align="left" class="lista"><input type="text" size="40" name="username" />
 </td>
</tr>
<tr>
 <td align=left class="header"><? echo USER_PWD ?>:</td>
 <td align="left" class="lista"><input type="password" size="40" name="password" /></td>
</tr>
<tr>
 <td align=left class="header"><? echo USER_PWD_AGAIN ?>:</td>
 <td align="left" class="lista"><input type="password" size="40" name="password2" /></td>
</tr>
<tr>
 <td align=left class="header"><? echo USER_EMAIL ?>:</td>
 <td align="left" class="lista"><input type="text" size="30" name="email" /></td>
</tr>
<tr>
  <td align=center class="header"></td>
  <td align=left class="lista"><input type="submit" name="conferma" value=<? echo FRM_CONFIRM ?> />&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" name="annulla" value=<? echo FRM_CANCEL ?> /></td>
</table>
</form>
</center>
<?
block_end();
stdfoot();
?>