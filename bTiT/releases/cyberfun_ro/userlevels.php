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
require_once ("include/blocks.php");

dbconn();

standardheader('User Levels');
block_begin("$SITENAME User Levels");
global $CURUSER, $STYLEPATH;
?>
<table align="center" class=lista width=95%>
<tr><td class="lista" align="center">These are the current user groups<br></td></tr>
</table>
       <br><table align="center" class=lista width=80%>
       <tr>
       <td class=header align=center><u>User Level</u></td>
       <td class=header align=center><u>Can Upload?</u></td>
       <td class=header align=center><u>Can Download?</u></td>
       <td class=header align=center><u>View Torrents?</u></td>
       <td class=header align=center><u>View Forums?</u></td>
       <td class=header align=center><u>View News?</u></td>
       <?php

       $query="SELECT  * FROM `users_level` WHERE 1 ORDER BY id_level ASC ";
       $result=@mysql_query($query);

       if (!$result) {

          print("<tr><td class=lista colspan=4>Cannot retrieve user levels</td></tr>");

      } else {
           {
               while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                     {
                     print("<tr>\n");

           print("<td class=header align=center><a href=users.php?searchtext=&level=".$row["id_level"].">".unesc($row["prefixcolor"]).unesc($row["level"]).unesc($row["suffixcolor"])."</a></td>");
           print("<td class=lista align=center>".$row['can_upload']."</td>");
           print("<td class=lista align=center>".$row['can_download']."</td>");
           print("<td class=lista align=center>".$row['view_torrents']."</td>");
           print("<td class=lista align=center>".$row['view_forum']."</td>");
           print("<td class=lista align=center>".$row['view_news']."</td>");
                     

                     print("</tr>\n");
 }
 }
           }
       print("</table>\n</div>\n<br />");


block_end();


?>
