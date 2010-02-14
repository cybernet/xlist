<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
if (!$CURUSER || $CURUSER["owner_access"]!="yes")
  {
      err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
      stdfoot();
      exit;
}

standardheader("Ratio");

block_begin("Ratio");
if ($HTTP_SERVER_VARS["REQUEST_METHOD"] == "POST")
{
if ($_POST["username"] == "" || $_POST["uploaded"] == "" || $_POST["downloaded"] == "")
{
err_msg("Error", "Missing form data.");
}

$username = sqlesc($_POST["username"]);
if($_POST["bytes"]=='1')
{
$uploaded = $_POST["uploaded"];
$downloaded = $_POST["downloaded"];
}
elseif($_POST["bytes"]=='2')
{
$uploaded = $_POST["uploaded"]*1024;
$downloaded = $_POST["downloaded"]*1024;
}
elseif($_POST["bytes"]=='3')
{
$uploaded = $_POST["uploaded"]*1024*1024;
$downloaded = $_POST["downloaded"]*1024*1024;
}
elseif($_POST["bytes"]=='4')
{
$uploaded = $_POST["uploaded"]*1024*1024*1024;
$downloaded = $_POST["downloaded"]*1024*1024*1024;
}
elseif($_POST["bytes"]=='5')
{
$uploaded = $_POST["uploaded"]*1024*1024*1024*1024;
$downloaded = $_POST["downloaded"]*1024*1024*1024*1024;
}

if($_POST["action"] =='1')
{
$result = mysql_query("SELECT uploaded, downloaded FROM users WHERE username=$username") or sqlerr(__FILE__, __LINE__);
$arr = mysql_fetch_assoc($result);
$uploaded = $arr["uploaded"]+$uploaded;
$downloaded = $arr["downloaded"]+$downloaded;
mysql_query("UPDATE users SET uploaded=$uploaded, downloaded=$downloaded WHERE username=$username") or sqlerr(__FILE__, __LINE__);
}
elseif($_POST["action"] =='2')
{
$result = mysql_query("SELECT uploaded, downloaded FROM users WHERE username=$username") or sqlerr(__FILE__, __LINE__);
$arr = mysql_fetch_assoc($result);
$uploaded = $arr["uploaded"]-$uploaded;
$downloaded = $arr["downloaded"]-$downloaded;
mysql_query("UPDATE users SET uploaded=$uploaded, downloaded=$downloaded WHERE username=$username") or sqlerr(__FILE__, __LINE__);
}
elseif($_POST["action"] =='3')

mysql_query("UPDATE users SET uploaded=$uploaded, downloaded=$downloaded WHERE username=$username") or sqlerr(__FILE__, __LINE__);

}

print("<table border=\"0\" width=\"95%\" align=\"center\">");
print("<tr><td class=\"lista\" align=\"center\" width=\"90%\">Update Users Ratio");
print("</td></tr></table>");

print("<form method=\"post\" action=\"ratio.php\">");
print("<table cellspacing=\"0\" cellpadding=\"5\" class=\"lista\" align=\"center\">");
print("<tr><td class=\"header\">User name</td><td><input type=\"text\" name=\"username\" size=\"40\"></td></tr>");
print("<tr><td class=\"header\">Uploaded</td><td><input type=\"uploaded\" name=\"uploaded\" size=\"40\"></td></tr>");
print("<tr><td class=\"header\">Downloaded</td><td><input type=\"downloaded\" name=\"downloaded\" size=\"40\"></td></tr>");

print("<tr><td width=\"58\" class=\"header\">Select input measure:</td>");
print("<td><input type=\"radio\" name=\"bytes\" value=\"1\">Bytes");
print("<input type=\"radio\" name=\"bytes\" value=\"2\">KBytes");
print("<input type=\"radio\" name=\"bytes\" value=\"3\">MBytes");
print("<input type=\"radio\" name=\"bytes\" value=\"4\">GBytes");
print("<input type=\"radio\" name=\"bytes\" value=\"5\">TBytes");
print("</td></tr>");
print("<tr><td class=\"header\">Action:</td><td><input type=\"radio\" name=\"action\" value=\"1\">Add");
print("<input type=\"radio\" name=\"action\" value=\"2\">Remove");
print("<input type=\"radio\" name=\"action\" value=\"3\">Replace</td></tr>");
print("<tr><td width=\"58\" class=\"blocklist\">&nbsp;</td><td align=\"center\" colspan=\"2\">");
print("<tr><td class=\"header\" colspan=\"2\" align=\"center\"><input type=\"submit\" value=\"Okay\"></td></tr>");
print("</table></form>");

block_end();
stdfoot();
?>