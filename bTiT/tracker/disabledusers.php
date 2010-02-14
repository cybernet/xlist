<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if (!$CURUSER || $CURUSER["admin_access"]=="no" || $CURUSER["edit_users"]=="no")
   {
	require_once "include/functions.php";
	require_once "include/config.php";
	standardheader("Get a freakin' life and stop trying to hack the tracker !");
	block_begin(ERROR);
	err_msg("Error", "Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot(false);
   }
else
   {

block_begin("".DISABLED_USERS."");

//Per Page Listing Limitation Start - 00:06 24.06.2006
$numdisabled = mysql_query("SELECT COUNT(*) FROM users WHERE disabled='yes'") or die(mysql_error());

$row = mysql_fetch_array($numdisabled);
$count = $row[0];

$perpage = $GLOBALS["disableppage"];
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count,  "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=disabledu&".$addparams);
//Per Page Listing Limitation Stop

$res = mysql_query("SELECT username, id, warns, disabledby, disabledon, disabledreason FROM users WHERE disabled='yes' ORDER BY warns DESC $limit") or sqlerr();
$num = mysql_num_rows($res);

print("<table border=0 width=100% cellspacing=2 cellpadding=0>");

//Per Page Listing Limitation Start - 00:07 24.06.2006
if ($count > $perpage)
print("<tr><td class=lista align=center colspan=10><br>".$pagertop."</td></tr>");
//Per Page Listing Limitation Stop

//Checkbox Remove Start - 10:03 30.07.2006
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
            </script>
            ");
//Checkbox Remove Stop

//Checkbox Remove start - 10:04 30.07.2006
print ("<form method=post name=deleteall action=warn.php?action=admincpremovedisabled>");
//Checkbox Remove Stop

print("<tr><td class=header align=center>".WARNED_USERNAME."</td><td class=header align=center>".DISABLED_WARNS."</td><td class=header align=center>".WARNED_REASON."</td><td class=header align=center>".DISABLED_ON."</td><td class=header align=center>".DISABLED_BY."</td><td class=header align=center>".DISABLED_ACTIVE."</td><td class=header align=center><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','remdisabled[]',this.checked)\" /></td></tr>");

    if ("$num"=="0")
	print("<tr><td class=lista align=center colspan=10>".DISABLED_NO_USERS."</td></tr>");
    else
       {

   while ($arr = mysql_fetch_array($res))
   {

	if ($arr["warns"]=="0")
	    $total_warns = "".$arr["warns"]."";
	 else
	    $total_warns = "<a href=listwarns.php?uid=".$arr['id'].">".$arr["warns"]."</a>";

	if ($arr["disabled"]=="no")
	    $active = "<font color=green><b>".NO."</b></font>";
	 else
	    $active = "<font color=red><b>".YES."</b></font>";

	$get_staffname = mysql_query("SELECT username FROM users WHERE id = '".$arr['disabledby']."'");
	$warnedby = mysql_fetch_array($get_staffname);

print("<tr><td class=lista align=center><a href=userdetails.php?id=".$arr[id].">".$arr['username']."</a></td><td class=lista align=center>".$total_warns."</td><td class=lista align=center>".unesc($arr['disabledreason'])."</td><td class=lista align=center>".$arr['disabledon']."</td>");
if ($warnedby['username'] == "System") {
print("<td class=lista align=center>System</td>"); }
else {
print("<td class=lista align=center><a href=userdetails.php?id=".$arr['disabledby'].">".$warnedby['username']."</a></td>"); }
print("<td class=lista align=center>".$active."</td><td class=lista align=center><input type=\"checkbox\" name=\"remdisabled[]\" value=\"".$arr['id']."\" /></td></tr>");
   }

       }
print("<tr><td class=header align=center colspan=6><a href=\"javascript: history.go(-1);\">".BACK."</a></td><td class=header align=center colspan=1><input type=submit value=".DELETE."></td></tr>");
print ("</form>");

//Per Page Listing Limitation Start - 00:08 24.06.2006
if ($count > $perpage)
print("<tr><td class=lista align=center colspan=10><br>".$pagerbottom."</td></tr>");
//Per Page Listing Limitation Stop

print("</table>");

block_end();
print ("<br>");

// stdfoot(false);
   }
?>