<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

standardheader('Staff');
if ($CURUSER["view_news"] == "yes")
{

block_begin("Staff @ $SITENAME");

global $CURUSER, $STYLEPATH;

?>
<table align="center" class="lista">
<tr><td class="lista" align="center">Please do not contact staff until you have read any rules, guides, stickies, etc. related to your question. Then, and only then, should you PM a staff member.<br></td></tr>
</table>
       <br><table align="center" class=lista width=70%>
       <tr>
       <td class=header align=center>Avatar</td>
       <td class=header align=center><?echo PM;?></td>
       <td class=header align=center><?echo USER_NAME;?></td>
       <td class=header align=center><?echo USER_LEVEL;?></td>
       <td class=header align=center><?echo PEER_COUNTRY;?></td>
	   <td class=header align=center>Info</td>
       <td class=header align=center>Status</td>
       <?
       $query = "select prefixcolor, suffixcolor, users.id, downloaded,uploaded, username,level,avatar, users.support,UNIX_TIMESTAMP(joined) AS joined,UNIX_TIMESTAMP(lastconnect) AS lastconnect, flag, flagpic, name FROM users INNER JOIN users_level ON users.id_level=users_level.id LEFT JOIN countries ON users.flag=countries.id WHERE users.id_level>7 and users.id_level<11 ORDER BY users.id_level DESC";
       //print($query);
       $rusers = mysql_query($query);

       if (mysql_num_rows($rusers) == 0)
          // flag hack
          print("<tr><td class=lista colspan=6>No Staff found</td></tr>");
       else
           {
               while ($row_user = mysql_fetch_array($rusers))
                     {
                     print("<tr>\n");
                   
        $avatar = "";
        $avatar = ($row_user["avatar"] && $row_user["avatar"] != "" ? htmlspecialchars($row_user["avatar"]) : "");
if ($avatar=="")
      print("<td class=lista align=\"left\" valign=\"top\" class=lista><img src='images/noimage.jpg' border='0' width=80 /></td>");

else
     print("<td width=80 class=lista align=center valign=middle>". ($avatar!="" ? "<img width=80 src=$avatar>" : "")."</td>");
                    
      print("<td class=lista align=center><a href=usercp.php?do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($row_user["username"])).">".image_or_link("$STYLEPATH/pm.png","","PM")."</a></td>");
      print("<td class=lista align=center><a href=userdetails.php?id=".$row_user["id"].">".unesc($row_user["prefixcolor"]).unesc($row_user["username"]).unesc($row_user["suffixcolor"])."</a></td>");
                    print("<td class=lista align=center>".$row_user["level"]."</td>");
                    print("<td class=lista align=center>". ( $row_user["flag"] == 0 ? "<img src='images/flag/unknown.gif' alt='".UNKNOWN."' title='".UNKNOWN."' />" : "<img src='images/flag/" . $row_user['flagpic'] . "' alt='" . $row_user['name'] . "' title='" . $row_user['name'] . "' />")."</td>");
					print("<td class=lista align=center>".$row_user["support"]."</td>");

$last = $row_user['lastconnect'];

$online = time();
      $online -= 60 * 15;
if($last > $online)
      {
      print("<td class=lista align=center><img src=./images/p_online.gif border=0></td>");
                    print("</tr>\n");
      }
      else
      echo"<td class=lista align=center><img src=./images/p_offline.gif border=0></td>";
      }
          }
      print("</table>\n</div>\n<br />");
   
block_end();
}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
stdfoot();
?>
