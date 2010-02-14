<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
if (!$CURUSER || $CURUSER["admin_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}
$header="Import";
if($SBX['import'] == "f"){
$SB_NOTICE=IMPORT_ERROR;
}
else{
include ("chat.php");

$msg2 = $msg;
$count=count($msg2);
for ($i=0;$i<=$count && $i<count($msg2);++$i)
{
$uidq=mysql_query("SELECT id FROM users WHERE username='".$msg2[$i]['pseudo']."'");
$uid=mysql_fetch_array($uidq);

mysql_query("INSERT INTO shoutbox (msgid, user, message, date, userid) VALUES (NULL, '".addslashes($msg2[$i]['pseudo'])."', '".addslashes($msg2[$i]['texte'])."','".$msg2[$i]['date']."', '".$uid['id']."')") or die("error");

$content.=$msg2[$i]['date']."&nbsp;&nbsp;<b>".$msg2[$i]['pseudo']."</b> ".$uid['id'].":&nbsp;&nbsp;&nbsp;".$msg2[$i]['texte']."<br>";
}
$SB_NOTICE="<font color=black>$count shouts imported!</font><br>Please dont forget to disable import function now in SBadmin";
}
?>