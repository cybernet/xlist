<?php

/********************************************************************************\
 *                                                                              *
 * ---------------------------------------------------------------------------- *
 *                              H E L P   D E S K                               *
 *                               (for TB source)                                *
 * ---------------------------------------------------------------------------- *
 *                         written by nuerher[at]gmail.com                      *
 * ---------------------------------------------------------------------------- *
 *                      rewritten for BTIT version 1.4 by JBoy                  * 
\********************************************************************************/

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
standardheader('Helpdesk');
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
    err_msg(ERROR.NOT_AUTHORIZED." ",SORRY."...");
    stdfoot();
    exit();
   }
else
    {
function round_time($ts)
{
    $mins = floor($ts / 60);
  $hours = floor($mins / 60);
  $mins -= $hours * 60;
  $days = floor($hours / 24);
  $hours -= $days * 24;
  $weeks = floor($days / 7);
  $days -= $weeks * 7;
  $t = "";
  if ($weeks > 0)
    return "$weeks week" . ($weeks > 1 ? "s" : "");
  if ($days > 0)
    return "$days day" . ($days > 1 ? "s" : "");
  if ($hours > 0)
    return "$hours hour" . ($hours > 1 ? "s" : "");
  if ($mins > 0)
    return "$mins min" . ($mins > 1 ? "s" : "");
  return "< 1 min";
}

$msg_problem = trim($_POST["msg_problem"]);
$msg_answer = trim($_POST["msg_answer"]);
$id = $_POST["id"];
$addedbyid = $_POST["addedbyid"];
$title = trim($_POST["title"]);

$action = $_GET["action"];
$solve = $_GET["solve"];

// --- action: cleanuphd
if ($action == 'cleanuphd') {
    mysql_query("DELETE FROM helpdesk WHERE solved='yes' OR solved='ignored'");
    $action = 'problems';
}
// --- action: problems

if ($action == 'problems') {

if (!$CURUSER || $CURUSER["id_level"] < 7) // 6 is default id_level for moderators
{
  err_msg("Sorry...", "You are not authorized to enter this site.");
  stdfoot();
  die;
}

// Standard HD Replies
// English
$hd_reply['1'] = array("Read FAQ","First read the [b]FAQ[/b] and then start asking questions!");
$hd_reply['2'] = array("Search forums","Search the [b]FORUMS[/b] please.");
$hd_reply['3'] = array("Die n00b","Die n00b! Such a thing knows even my grandma!");

// POST & GET
$id = $_GET["id"];
$hd_answer=$_POST["hd_answer"];
if ($hd_answer) {
		$body = $hd_reply[$hd_answer][1];
 }

block_begin("Problems");

// VIEW PROBLEM DETAILS
if ($id != 0) {

$res = mysql_query("SELECT * FROM helpdesk WHERE id='$id'");
$arr = mysql_fetch_array($res);

$zap = mysql_query("SELECT username FROM users WHERE id='$arr[added_by]'");
$wyn = mysql_fetch_array($zap);

$added_by_name = $wyn["username"];

$zap_s = mysql_query("SELECT username FROM users WHERE id='$arr[solved_by]'");
$wyn_s = mysql_fetch_array($zap_s);

$solved_by_name = $wyn_s["username"];

print("<table align=center border=1 cellpadding=5 cellspacing=0>".
      "<tr><td align=center colspan=2 class=colhead>".$arr["title"]."</td></tr>".
      "<tr><td align=right><b>Added</b></td><td align=left>On&nbsp;<b>".get_date_time($arr["added"])."</b>&nbsp;by&nbsp;<a href=userdetails.php?id=".$arr["added_by"]."><b>".$added_by_name."</b></a></td></tr>");

if ($arr["solved"] == 'yes') {

  print("<tr><td align=right><b>Problem</b></td><td align=left><textarea name=msg_problem cols=80 rows=15>".$arr["msg_problem"]."</textarea></td></tr>".
        "<tr><td align=right><b>Solved</b></td><td align=left><font color=green><b>Yes</b></font>&nbsp;on&nbsp;<b>".$arr["solved_date"]."</b>&nbsp;by&nbsp;<a href=userdetails.php?id=".$arr["solved_by"]."><b>".$solved_by_name."</b></a></td></tr>".
        "<tr><td align=right><b>Answer</b></td><td align=left><textarea name=msg_answer cols=80 rows=15>".$arr["msg_answer"]."</textarea></td></tr></table>");

}
else if ($arr["solved"] == 'ignored') {

  print("<tr><td align=right><b>Problem</b></td><td align=left><textarea name=msg_problem cols=80 rows=15>".$arr["msg_problem"]."</textarea></td></tr>".
        "<tr><td align=right><b>Solved</b></td><td align=left><font color=orange><b>Ignored</b></font>&nbsp;on&nbsp;<b>".$arr["solved_date"]."</b>&nbsp;by&nbsp;<a href=userdetails.php?id=".$arr["solved_by"]."><b>".$solved_by_name."</b></a></td></tr>".
        "</table>");

}
else if ($arr["solved"] == 'no') {

$addedbyid = $arr["added_by"];

print("<form method=post action=helpdesk.php><tr><td><tr><td align=right><b>Problem</b></td><td align=left><textarea name=msg_problem cols=80 rows=15>".$arr["msg_problem"]."</textarea></td></tr>".
      "<tr><td align=right><b>Solved</b></td><td align=center><font color=red><b>No</b></font>".
      "<tr><td align=right><b>Answer</b></td><td><textarea name=msg_answer cols=80 rows=15>$body</textarea><br/>(<a href=tags.php><b>BB code</b></a> is allowed.)<input type=hidden name=id value=$id><input type=hidden name=addedbyid value=$addedbyid></td></tr>".
      "<tr><td colspan=2 align=center><input type=submit value=Answer! class=btn> <b>||</b> <a href=helpdesk.php?action=solve&pid=$id&solved=ignored><font color=red><b>IGNORE</b></font></a></td></tr></form></table>");

}
}


// VIEW PROBLEMS
else {

print("<table align=center border=1 cellpadding=5 cellspacing=0>"
     ."<td class=colhead align=center>Added</td>"
	 ."<td class=colhead align=center>Added by</td>"
	 ."<td class=colhead align=center>Problem</td>"
	 ."<td class=colhead align=center>Solved - by</td>"
	 ."<td class=colhead align=center>Solved in*</td></tr>");

$res = mysql_query("SELECT * FROM helpdesk ORDER BY added DESC");
while($arr = mysql_fetch_array($res)) {

$zap = mysql_query("SELECT username FROM users WHERE id = $arr[added_by]");
$wyn = mysql_fetch_array($zap);

$added_by_name = $wyn["username"];

$zap_s = mysql_query("SELECT username FROM users WHERE id = $arr[solved_by]");
$wyn_s = mysql_fetch_array($zap_s);

$solved_by_name = $wyn_s["username"];

// SOLVED IN
$added = $arr["added"];
$solved_date = $arr["solved_date"];

if ($solved_date == "0") {
  $solved_in = "&nbsp;[N/A]";
  $solved_color = "black";
  }
else
{
  $solved_in_wtf = $arr["solved_date"] - $arr["added"];
  $solved_in = "&nbsp;[".round_time($solved_in_wtf)."]";

  if ($solved_in_wtf > 2*3600) {
    $solved_color = "red";
  }
  else if ($solved_in_wtf > 3600) {
    $solved_color = "black";
  }
  else if ($solved_in_wtf <= 1800) {
    $solved_color = "green";
  }

}


  print("<tr><td>".get_date_time($arr["added"])."</td>".
        "<td><a href=userdetails.php?id=".$arr["added_by"].">".$added_by_name."</a></td>".
        "<td><a href=helpdesk.php?action=problems&id=".$arr["id"]."><b>".$arr["title"]."</b></a></td>");

        if ($arr["solved"] == 'no') {
          $solved_by = "N/A";
          print("<td><font color=red><b>No</b></font>&nbsp;-&nbsp;".$solved_by."</td>");
        }
        else if ($arr["solved"] == 'yes') {
          $solved_by = "<a href=userdetails.php?id=".$arr["solved_by"].">".$solved_by_name."</a>";
          print("<td><font color=green><b>Yes</b></font>&nbsp;-&nbsp;".$solved_by."</td>");
        }
        else if ($arr["solved"] == 'ignored') {
          $solved_by = "<a href=userdetails.php?id=".$arr["solved_by"].">".$solved_by_name."</a>";
          print("<td><font color=orange><b>Ignored</b></font>&nbsp;-&nbsp;".$solved_by."</td>");
        }

  print("<td><font color=".$solved_color.">".$solved_in."</font></td></tr>");

}

print("<tr><td align=center class=colhead colspan=5><form method=get action=?><input type=hidden name=action value=cleanuphd><input type=submit value='Delete solved or ignored problems' style='height:20;align:center;'></form></tr></table>");
print("<br><br>".
      "<font color=green>[ xx ]</font> - great, ".
      "<font color=black>[ xx ]</font> - ok, ".
      "<font color=red>[ xx ]</font> - bad");
}

block_end();

if ($arr["solved"] == 'no') {


  	print("<br><br>".
  	      "<form method=post action=helpdesk.php?action=problems&id=$id>");
  	?>
	  <table align="center"  border="1" cellspacing="0" cellpadding="5">
	  <tr><td>
	  <b>HD Replies:</b>
	  <select name="hd_answer"><?
	  for ($i = 1; $i <= count($hd_reply); $i++)
	  {
	    echo "<option value=$i ".($hd_answer == $i?"selected":"").
	      ">".$hd_reply[$i][0]."</option>\n";
	  }?>
	  </select>
	  <input type="submit" value="Use" class="btn">
	  </td></tr></table></form>
	<?php

}

stdfoot();
die;

}

// Main FILE

block_begin("Helpdesk");

if ($action == 'solve') {

  $pid = $_GET["pid"];
 
  if ($solve = 'ignored') {
  
    mysql_query("UPDATE helpdesk SET solved='ignored', solved_by=$CURUSER[uid], solved_date = UNIX_TIMESTAMP() WHERE id=$pid");
    
  }
 
}

if (($msg_answer != "") && ($id != 0)){

$zap_usr = mysql_query("SELECT username FROM users WHERE id = $addedbyid");
$wyn_usr = mysql_fetch_array($zap_usr);

$addedby_name = $wyn_usr["username"];


$msg = sqlesc("[color=blue][b]==[ HELP DESK ]==[/b][/color]\n\n[quote=".$addedby_name."]".$msg_problem."[/quote]\n".$msg_answer."\n\nregards");

mysql_query("UPDATE helpdesk SET solved='yes', solved_by=$CURUSER[uid], solved_date = UNIX_TIMESTAMP(), msg_answer = ".sqlesc($msg_answer)." WHERE id=$id");
// mysql_query("INSERT INTO messages (
mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg, readed) VALUES($CURUSER[uid], $addedbyid, UNIX_TIMESTAMP(), 'Helpdesk', $msg, 'no')");

  err_msg("Help desk","<b>Problem ID:</b> $id<br>Answer:<textarea name=msg_answer cols=80 rows=15>$msg</textarea><br><b>Solved by: ".$CURUSER["id"]."</b><br>STATUS: <b>SOLVED</b><br>");
  block_end();
  stdfoot();
  die;

}


if (($msg_problem != "") && ($title != "")){

  mysql_query("INSERT INTO helpdesk (title, msg_problem, added, added_by) VALUES (".sqlesc($title).", ".sqlesc($msg_problem).", UNIX_TIMESTAMP(), $CURUSER[uid])") or sqlerr();

// mysql_query("INSERT INTO helpdesk (added) VALUES ($dt)") or sqlerr();

  err_msg("Help desk", "Message sent! Await for reply.");
  block_end();
  stdfoot();
  die;
}



// ----- MAIN HELP DESK ---------

if ($CURUSER || $CURUSER["id_level"] >= 7) // 7 is default id_level for moderators
{
print("<center><a href=helpdesk.php?action=problems><h1><font color=blue>PROBLEMS</font></h1></a></center><br/>");
}
?>
<!-- ENGLISH -->
<center><font color=red size=2><blockquote>Before using <b>Help Desk</b> make sure to read <a href=faq.php><b>FAQ</b></a> and search <a href=forum.php><b>Forums</b></a> first.</blockquote></font><br/></center>
<center><h1>HELP DESK</h1></center>
<br/>

<form method="post" action="helpdesk.php">
<table border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td align="right">&nbsp;<b>Title:</b></td>
    <td align="left"><input type="text" size="73" maxlength="60" name="title"></td>
  </tr>
<!--
  <tr>
    <td align="left" colspan="2"></td>
  </tr>
-->
  <tr>
    <td colspan="2"><textarea name="msg_problem" cols="80" rows="15"><?php print($msg_problem);?></textarea><!--<br>(<a href=tags.php class=altlink>BB</a> tags are <b>allowed</b>.)--></td>
  </tr>
  <tr>
    <td align="center" colspan="2"><input type="submit" value="Help me!" class="btn"></td>
  </tr>
</table>
</form>


<?php
block_end();
}
stdfoot();
?>