<?php
require_once("include/functions.php");
require_once("include/config.php");


dbconn();

standardheader('Users Search',false);

if (isset($_GET['action']) && $_GET['action'])
            $action=$_GET['action'];
else $action = '';;

if ($action!="find")
   {
?>

<form action="searchusers.php?action=find" name="users" method="post">
<div align="center">
  <table class=lista>
  <tr>
     <td><?php echo USER_NAME;?>:</td>
     <td class=lista><input type="text" name="user" size="40" maxlength="40" /></td>
     <td class=lista><input type="submit" name="confirm" value="Search" /></td>
  </tr>
  </table>
</div>
</form>
<?php
}
else
{
  $res=mysql_query("SELECT username FROM users WHERE id>1 AND username LIKE '%".mysql_escape_string($_POST["user"])."%' ORDER BY username");
  if (!$res or mysql_num_rows($res)==0)
     {
         print("<center>".NO_USERS_FOUND."!<br />");
         print("<a href=searchusers.php>".RETRY."</a></center>");
     }
  else {
?>
<script language=javascript>

function SendIT(){
    window.opener.document.forms['edit'].elements['receiver'].value = document.forms['result'].elements['name'].options[document.forms['result'].elements['name'].options.selectedIndex].value;
    window.close();
}
</script>

<div align="center">
  <form name=result><table class=lista>
  <tr>
     <td class=lista><?php print(USER_NAME);?>:</td>
<?php
     print("\n<td class=lista><select name=\"name\" size=\"1\">");
     while($result=mysql_fetch_array($res))
         print("\n<option name=uname value=\"".$result["username"]."\">".$result["username"]."</option>");
     print("\n</select></td>");
     print("\n<td class=lista><input type=\"button\" name=\"confirm\" onclick=\"javascript:SendIT();\" value=\"".FRM_CONFIRM."\" /></td>");
?>
  </tr>
  </table></form>
</div>
<?php
   }
}
print("\n<br />\n<div align=\"center\"><a href=\"javascript: window.close()\">".CLOSE."</a></div>");
print("</body>\n</html>\n");
?>
