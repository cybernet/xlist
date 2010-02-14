<?php
require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if (!$CURUSER || $CURUSER["admin_access"]=="no" || $CURUSER["edit_users"]=="no")
   {
	require_once "include/functions.php";
	require_once "include/config.php";
	block_begin(ERROR);
	err_msg("Error", "Get a freakin' life and stop trying to hack the tracker !<br>Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot(false);
   }
else
   {

block_begin("".WARNED_USERS."");

//Per Page Listing Limitation Start - 00:06 24.06.2006
$numwarns = mysql_query("SELECT COUNT(*) FROM warnings WHERE active='yes'");
$row = mysql_fetch_array($numwarns);
$count = $row[0]; 
$perpage = $GLOBALS["warnsppage"];
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count,  "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=warnedu&".$addparams);
//Per Page Listing Limitation Stop

$res = mysql_query("SELECT * FROM warnings WHERE active='yes' ORDER BY warns DESC $limit") or sqlerr();
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
print ("<form method=post name=deleteall action=warn.php?action=admincpremovewarn>");
//Checkbox Remove Stop

print("<tr><td class=header align=center>".WARNED_ID."</td><td class=header align=center>".WARNED_USERNAME."</td><td class=header align=center>".WARNED_TOTAL_WARNS."</td><td class=header align=center>".WARNED_DATE_ADDED."</td><td class=header align=center>".WARNED_EXPIRATION."</td><td class=header align=center>".WARNED_DURATION."</td><td class=header align=center>".WARNED_REASON."</td><td class=header align=center>".WARNED_BY."</td><td class=header align=center>".WARNED_ACTIVE."</td><td class=header align=center><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','remwarn[]',this.checked)\" /></td></tr>");

    if ("$num"=="0")
	print("<tr><td class=lista align=center colspan=10>".WARNED_NO_USERS."</td></tr>");
    else
       {

   while ($arr = mysql_fetch_array($res))
   {
	if ($arr["warnedfor"]==0)
	$duration = "".WARNED_UNLIMITED."";
	  elseif ($arr['warnedfor']==1)
	$duration = "".$arr['warnedfor']."".WARNED_WEEK."";
	  else
	$duration = "".$arr['warnedfor']."".WARNED_WEEKS."";

	if ($arr["active"]=="no")
	$active = "<font color=green><b>".NO."</b></font>";
	  else
	$active = "<font color=red><b>".YES."</b></font>";

	$get_staffname = mysql_query("SELECT username FROM users WHERE id = " . $arr['addedby']);
	$warnedby = mysql_fetch_array($get_staffname);

	$get_username = mysql_query("SELECT * FROM users WHERE id = " . $arr['userid']);
	$warned = mysql_fetch_array($get_username);

print("<tr><td class=lista align=center>".$arr['id']."</td><td class=lista align=center><a href=userdetails.php?id=".$arr['userid'].">".$warned['username']."</a></td><td class=lista align=center><a href=listwarns.php?uid=".$arr['userid'].">".$warned['warns']."</a></td><td class=lista align=center>".$arr['added']."</td><td class=lista align=center>".$arr['expires']."</td><td class=lista align=center>".$duration."</td><td class=lista align=center>".unesc($arr['reason'])."</td>");
if ($warnedby['username'] == "System") {
print("<td class=lista align=center>System</td>"); }
else {
print("<td class=lista align=center><a href=userdetails.php?id=".$arr['addedby'].">".$warnedby['username']."</a></td>"); }
print("<td class=lista align=center>".$active."</td><td class=lista align=center><input type=\"checkbox\" name=\"remwarn[]\" value=\"".$arr['userid']."\" /></td></tr>");
   }

       }
print("<tr><td class=header align=center colspan=9><a href=\"javascript: history.go(-1);\">".BACK."</a></td><td class=header align=center colspan=1><input type=submit value=".DELETE."></td></tr>");
print ("</form>");


//Per Page Listing Limitation Start - 00:08 24.06.2006
if ($count > $perpage)
print("<tr><td class=lista align=center colspan=10><br>".$pagerbottom."</td></tr>");
//Per Page Listing Limitation Stop

print("</table>");

block_end();
print ("<br>");
//stdfoot();
//stdfoot(false);
   }
?>