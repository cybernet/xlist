<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

require_once ("include/functions.php");
require_once ("include/config.php");

dbconn();

if (!$CURUSER || $CURUSER["owner_access"] != "yes")
   {
	block_begin(ERROR);
	err_msg("Error", "Get a freakin' life and stop trying to hack the tracker !<br>Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot(false);
   }
else
   {
standardheader("Unconfirmed");
block_begin(UNCONFIRMED);

print("<table align=\"center\" class=\"lista\" width=\"80%\">");
print("<tr><td class=\"lista\" align=\"center\">" . UNCONFIRMED . "</td></tr>");
print("</table>");

print("<br>");

$rusers = mysql_query("SELECT prefixcolor, suffixcolor, users.id, username,level,UNIX_TIMESTAMP(joined) AS joined,UNIX_TIMESTAMP(lastconnect) AS lastconnect, flag, flagpic, name FROM users INNER JOIN users_level ON users.id_level=users_level.id LEFT JOIN countries ON users.flag=countries.id WHERE users.id_level=2 ORDER BY users.username ASC");

            // MODIFIED select for deletion by gAnDo
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
		
		if (mysql_num_rows($rusers)==0) {
		
		print("<table align=\"center\" class=\"lista\" width=\"80%\"><tr>");
		print("<tr><td class=lista align=center>" .  NOBODY . "</td></tr>");
        print("</table>");
		
		}
		else
            {

print("\n<form name=\"changeall\" method=\"post\">");
print("<table align=\"center\" class=\"lista\" width=\"80%\"><tr>");
print("<td class=header align=center width=100>" . USER_ID . "</td>");
print("<td class=header align=center>" . USER_NAME . "</td>");
print("<td class=header align=center width=60>" . USER_LEVEL . "</td>");
print("<td class=header align=center>" . PEER_COUNTRY . "</td>");
print("<td class=header align=center>" . USER_JOINED . "</td>");
print("\n<td class=\"header\" align=\"center\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('changeall','user[]',this.checked)\" /></td></tr>");

while ($row_user = mysql_fetch_array($rusers))
        {
        print("<tr>\n");
		print("<td class=lista align=center>".$row_user["id"]."</td>");
        print("<td class=lista>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=userdetails.php?id=".$row_user["id"].">".unesc($row_user["prefixcolor"]).unesc($row_user["username"]).unesc($row_user["suffixcolor"])."</a></td>");
        print("<td class=lista align=center>".$row_user["level"]."</td>");
        print("<td class=lista align=center>". ( $row_user["flag"] == 0 ? "<img src='images/flag/unknown.gif' alt='".UNKNOWN."' title='".UNKNOWN."' />" : "<img src='images/flag/" . $row_user['flagpic'] . "' alt='" . $row_user['name'] . "' title='" . $row_user['name'] . "' />")."</td>");
        print("<td class=lista align=center>".($row_user["joined"]==0 ? NOT_AVAILABLE : date("d/m/Y H:i:s",$row_user["joined"]))."</td>");
		print("<td class=\"lista\" align=\"center\"><input type=\"checkbox\" name=\"user[]\" value=\"".$row_user["id"]."\" /></td>");
		}
		print("\n<tr>\n<td class=\"lista\" align=\"right\" colspan=\"5\"><input type=\"submit\" name=\"confirm\" value=\"Validate\" /></td><td class=\"lista\" align=\"right\"><input type=\"submit\" name=\"delete\" value=\"Delete\" /></td></tr></form>");
		print("</table>\n<br />");

if ($_POST["confirm"] == 'Validate')
   {
   foreach($_POST["user"] as $selected=>$user)
   mysql_query("UPDATE users SET id_level=3 WHERE id_level=2 AND id='$user'");
   redirect("unconfirmed.php");
   }
if ($_POST["delete"] == 'Delete')
   {
   foreach($_POST["user"] as $selected=>$user)
   mysql_query("DELETE FROM users WHERE id_level=2 AND id='$user'");
   redirect("unconfirmed.php");
   }
   
	}
}
        
block_end();
stdfoot();
?>
