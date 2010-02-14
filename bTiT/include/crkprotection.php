<?php
/*
########################################################
#   CRK-Protection v2.0                                #
#   Anti-Hacking Module by CobraCRK                    #
#   This is made by CobraCRK - cobracrk[at]yahoo.com   #
#   This shall not used without my approval!           #
#   You may not share this!!!                          #
#   DO NOT REMOVE THIS COPYRIGHT!                      #
########################################################
#         This version was made for BtitTracker        #
########################################################
*/

function crk($l) {

  global $CURUSER,$BASEURL;

  //$xip=$_SERVER["REMOTE_ADDRESS"];
	$xip=$_SERVER['REMOTE_ADDR'];
  if (function_exists("dbconn"))
     dbconn();
  if (function_exists("write_log"))
     write_log('Hacking Attempt! User: <a href="'.$BASEURL.'/index.php?page=userdetails&amp;id='.$CURUSER['uid'].'">'.$CURUSER['username'].'</a> IP:'.$xip.' - Attempt: '.htmlspecialchars($l));

  header('Location: index.php');
  die();
}

//the bad words...
$ban['union']='select';
//$ban['update']='set';
$ban['set password for']='@';

$ban2=array('delete from','insert into','<script', '.write', '.location', '.cookie', '.open', 'vbscript:', '<iframe', '<layer', '<style', ':expression', '<base', 'id_level', 'users_level', 'xbt_', 'c99.txt', 'c99shell', 'r57.txt', 'r57shell.txt','/home/', '/var/', '/www/', '/etc/', '/bin', '/sbin/', '$_GET', '$_POST', '$_REQUEST', 'window.open', 'javascript:', 'xp_cmdshell',  '.htpasswd', '.htaccess', '<?php', '<?', '?>', '</script>');

//checking the bad words
$cepl=$_SERVER['QUERY_STRING'];
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl); 
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if (str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
      crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));

$cepl=implode(' ', $_REQUEST);
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl);
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if(str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
    crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));

$cepl=implode(' ', $_COOKIE);
if (!empty($cepl)) {
  $cepl=preg_replace('/([\x00-\x08][\x0b-\x0c][\x0e-\x20])/', '', $cepl); 
  $cepl=urldecode($cepl);
  $cepl=strtolower($cepl);
}
foreach ($ban as $k => $l)
  if(str_replace($k, '',$cepl)!=$cepl&&str_replace($l, '',$cepl)!=$cepl)
   crk(($cepl));
if (str_replace($ban2,'',$cepl)!=$cepl)
  crk(($cepl));
?>
