<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");


dbconn();

if ($CURUSER["id_level"]==1)
{
	redirect("users.php"); // redirects to users.php if guest
	exit();
}

$do = $_GET["do"];
$friend_id = $_GET["friend_id"];

// Add member to friendlist

if ($do=="add")
{
	if (!isset($friend_id))
	{
		redirect("users.php"); // redirects to users.php if friend_id not set
		exit();
	}
	
	standardheader("Add to friendlist");
	block_begin(ADDED_TO_FRIENDLIST);
	$hmm=mysql_query("SELECT * FROM friendlist WHERE friend_id = '$friend_id' AND user_id = ".$CURUSER['uid']);
	if (mysql_num_rows($hmm))
	{
		err_msg(ERROR,CF_FRIEND_ALREADY_EXIST);
		block_end();
		stdfoot();
		exit();
	}
	$qry = mysql_query("SELECT * FROM users WHERE id = '$friend_id'");
	$res = mysql_fetch_array($qry);
	$chk = mysql_num_rows($qry);
	if (!$chk)
	{
		redirect("users.php"); // redirects to users.php if friend_id not in database
		exit();
	}
	mysql_query("INSERT INTO friendlist (user_id, friend_id, friend_name) VALUES ('".$CURUSER["uid"]."', '".$friend_id."', '".$res["username"]."')");
	print("<table width=\"100%\" class=\"lista\" align=\"center\"><tr><td class=\"lista\" align=\"center\">");
	print("<br>".MEMBER1." <b>".$res["username"]."</b> ".ADDED_TO_YOUR_FRIENDLIST."<br><br><a href=friendlist.php>".CLICK_HERE."</a> ".TO_VIEW_FRIENDLIST."<br><a href=users.php>".RETURN_USERS."</a><br><br>");
	print("</td></tr></table>");
}
// Delete friend from friendlist
elseif ($do=="del")
{
	foreach($_POST["msg"] as $selected=>$msg)
	{
		@mysql_query("DELETE FROM friendlist WHERE id=\"$msg\"");
	}
	redirect("friendlist.php");
	exit();
}
// Main friendlist page
else
{
	standardheader('Friendlist');
	block_begin(FRIENDLIST);
	print("<script type=\"text/javascript\">	
	<!--
	function SetAllCheckBoxes(FormName, FieldName, CheckValue)
	{
		if(!document.forms[FormName])
		return;
		var objCheckBoxes = document.forms[FormName].elements[FieldName];
		if(!objCheckBoxes)
		return;
		var countCheckBoxes = objCheckBoxes.length;
		if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
		else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
		objCheckBoxes[i].checked = CheckValue;
	}
	-->
	</script>");
	$qry=mysql_query("SELECT * FROM friendlist WHERE user_id = ".$CURUSER['uid']);
	$coun=mysql_num_rows($qry);
	print("\n<form action=\"friendlist.php?do=del\" name=\"delfriend\" method=\"post\">");
	?>
	<form name=delfriend action=friendlist.php?do=del method=post>
	<table width="100%" class="lista" align="center">
	<TD align="center" class="header" width="5%"><? echo USER_NAME; ?></TD>
	<TD align="center" class="header" width="5%"><? echo USER_LEVEL; ?></TD>
	<TD align="center" class="header" width="5%"><? echo USER_LASTACCESS; ?></TD>
	<TD align="center" class="header" width="5%"><? echo STATUS; ?></TD>
	<?
	if ($coun)
		print("<td class=header align=center width=5%><input type=checkbox name=all onclick=SetAllCheckBoxes('delfriend','msg[]',this.checked)></td></tr>");

	while ($res=mysql_fetch_array($qry))
	{
		$tor=mysql_query("SELECT users_level.prefixcolor, users_level.suffixcolor, users_level.level, users.username, UNIX_TIMESTAMP(users.lastconnect) AS lastconnect FROM users LEFT JOIN users_level ON users.id_level=users_level.id WHERE users.id>1 AND users.id = ".$res['friend_id']);
		$ret=mysql_fetch_array($tor);

		// Online User		   
		$last = $ret['lastconnect'];
		$online=time();
			$online-=60*15;
		if($last > $online)
		{
			$online = "".USER_ONLINE." <img src=images/online.gif border=0>";
		}
		else
			$online = "".USER_OFFLINE." <img src=images/offline.gif border=0>";
		// End Online Users

		print("<tr>\n");
		print("<td class=lista align=center><a href=userdetails.php?id=".$res["friend_id"].">".unesc($ret["prefixcolor"]).unesc($ret["username"]).unesc($ret["suffixcolor"])."</a></td>");
		print("<td class=lista align=center>".$ret['level']."</td>");
		print("<td class=lista align=center>".date("d/m/y h:i:s",$ret['lastconnect'])."</td>");
		print("<td class=lista align=center>$online</td>");
		print("<td class=lista align=center><input type=checkbox name=msg[] value=".$res["id"]."></td></tr>");
	}
	if (!$coun)
		print("\n<tr>\n<td class=lista align=center colspan=9>".NOTHING_IN_FRIENDLIST."</td></tr>");
	else
		print("\n<tr>\n<td class=lista align=right colspan=10><input type=submit name=action value=".DELETE."></td></tr>");
	print("\n</table>\n</form>");
}
block_end();
stdfoot();
?>
