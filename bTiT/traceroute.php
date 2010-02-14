<?php
// Traceroute mode from TbDev.Net by cazzole
// Adapted for BtitTracker Vers 1.4.x by DeathDealer 
// Powered by http://www.btiteam.org

require_once("include/functions.php");
require_once("include/config.php");


dbconn();

standardheader('Traceroute');
block_begin(Traceroute);
if ($CURUSER["mod_access"]=="no")
   {
       err_msg(ERROR,NOT_AUTH_VIEW_NEWS);
       stdfoot();
       exit;
}
else
    {
$unix = 1; //set this to 1 if you are on a *unix system
$windows = 0; //set this to 1 if you are on a windows system

$register_globals = (bool) ini_get('register_gobals');
$system = ini_get('system');
$unix = (bool) $unix;
$win = (bool) $windows;
//
If ($register_globals)
{
$ip = getenv(REMOTE_ADDR);
$self = $PHP_SELF;
}
else
{
$submit = $_GET['submit'];
$host = $_GET['host'];
$ip = $_SERVER['REMOTE_ADDR'];
$self = $_SERVER['PHP_SELF'];
};
// form submitted ?
If ($submit == "Traceroute!")
{
// replace bad chars
$host= preg_replace ("/[^A-Za-z0-9.]/","",$host);
echo '<body bgcolor="#FFFFFF" text="#000000"></body>';
echo("Trace Output:<br>");
echo '<pre>';
//check target IP or domain
if ($unix)
{
system ("traceroute $host");
system("killall -q traceroute");// kill all traceroute processes in case there are some stalled ones or use echo 'traceroute' to execute without shell
}
else
{
system("tracert $host");
}
echo '</pre>';
echo 'done ...';
}
else
{
echo '<body bgcolor="#FFFFFF" text="#000000"></body>';
echo '<p><font size="2">Your IP is: '.$ip.'</font></p>';
echo '<form methode="post" action="'.$self.'">';
echo ' Enter IP or Host <input type="text" name="host" value="'.$ip.'"></input>';
echo ' <input type="submit" name="submit" value="Traceroute!"></input>';
echo '</form>';
echo '<br><b>'.$system.'</b>';
echo '</body></html>';
}
}

block_end();
stdfoot();

?>