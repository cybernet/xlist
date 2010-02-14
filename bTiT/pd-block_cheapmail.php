<?php

/*---------------------------------------------------------\
|           File History (pd-block_cheapmail.php)          |
|           ------------------------------------           |
|        Written by Petr1fied - 1st August 2006            |
|                                                          |
| This tool is for adding Cheapmail domain names to the    |
| database, the cheapmail table is checked at account      |
| creation and if their email address is a match they      |
| will be unable to create an account with that address.   |
\---------------------------------------------------------*/

// updates:
//
// 2005-09-17: Dave - updated link to point to new pd-* filename.

require_once ("include/config.php");
require_once ("include/functions.php");

dbconn();

standardheader('Add Cheapmail Domains',true);

global $CURUSER, $STYLEPATH;

if (!$CURUSER||$CURUSER["owner_access"]=="no")
{
   err_msg(ERROR,ERR_PERM_DENIED);
   exit;
}
else
{
$counter=0;

(isset($_GET['cheapmail'])) ? $addcheapmail = $_GET['cheapmail'] : $addcheapmail = '';
(isset($_GET['additthen'])) ? $additthen = $_GET['additthen'] : $additthen = '';
(isset($_GET['delete'])) ? $delete = $_GET['delete'] : $delete = 'false';
(isset($_GET['confirm'])) ? $confirm = $_GET['confirm'] : $confirm = 'false';

block_begin("Add Cheapmail Domains"); 

if (($delete!='false')&&($confirm=='false')) {
   print("<center><br />".CHEAP_CONFIRM_1."<strong><font color=red>".$delete."</font></strong>?<br /><strong>".CHEAP_CONFIRM_2."</strong></center><br />");
   print("<center><a href=\"pd-block_cheapmail.php?delete=".$delete."&amp;confirm=true\"><img border=\"0\" align=\"middle\" src=\"".$STYLEPATH."/delete.png\"></a>&nbsp;&nbsp;&nbsp;<a href=\"pd-block_cheapmail.php\">Cancel</a><br /><br />");
   block_end(); stdfoot(); exit;
   }
   elseif (($delete!='false')&&($confirm=='true')) {
   mysql_query("DELETE FROM cheapmail WHERE domain='".$delete."' LIMIT 1");
   print("<center><br /><strong><font color=red>".$delete."</font></strong>".CHEAP_DELETED_1."<br /><a href=\"pd-block_cheapmail.php\">".CHEAP_DELETED_2."</a>".CHEAP_DELETED_3."</center><br />");
   block_end(); stdfoot(); exit;
   }

if(($addcheapmail=="")&&($additthen=="Submit")) {
     err_msg(Error,"<strong><center><font color=\"#000000\">".ERR_CHEAP_SUBMIT."</strong></center></font>");
     }
elseif(($addcheapmail!="")&&($additthen=="Submit")) {
    block_begin("Results");
    $isthere=mysql_fetch_assoc(mysql_query("SELECT * FROM cheapmail WHERE domain='".$addcheapmail."'"));
    $wildcard="@".strrrchr($addcheapmail,".");
    $wildthere=mysql_fetch_assoc(mysql_query("SELECT * FROM cheapmail WHERE domain='".$wildcard."'"));

    if((!$isthere)&&(!$wildthere)) {
       mysql_query("INSERT INTO cheapmail VALUES ('".$addcheapmail."', '".time()."', '".$CURUSER["username"]."')");
       err_msg(Success,"<font color=\"#CC0000\"><strong><center>$addcheapmail</font><font color=\"#000000\">".CHEAP_ADDED."</strong></center>");
       } elseif((!$isthere)&&($wildthere)) {
	     err_msg(Error,"<font color=#000000><center>".ERR_WILDCARD_1."<font color=\"#CC0000\"><strong>$wildcard</strong></font>".ERR_WILDCARD_2."<font color=\"#CC0000\"><strong>$addcheapmail</strong></font>".ERR_WILDCARD_3."</center>");
	     } else {
                err_msg(Error,"<center><font color=\"#CC0000\">$addcheapmail </font><font color=\"#000000\">".ERR_CHEAP_DUPE."</center>");
                }
                 block_end(); 
   }

$list=mysql_query("SELECT * FROM cheapmail ORDER BY domain ASC"); ?>

    <br /><table class="lista" width="95%" cellpadding="2" cellspacing="0" border="0" align="center">
    <tr><td align="center" class="block"><strong><?php echo CHEAP_CURRENT; ?></strong></td>
    <td align="center" class="block"><strong><?php echo ADDED; ?></strong></td>
    <td align="center" class="block"><strong><?php echo ADDED_BY; ?></strong></td>
    <td align="center" class="block"><strong><?php echo DELETE; ?></strong></td></tr>
<?php

while($cheapmail=mysql_fetch_assoc($list))
   {
   print("<tr><td align=\"Center\" class=\"lista\">".$cheapmail["domain"]."</td>");
   if ($cheapmail["added"]==0) {
   print("<td align=\"Center\" class=\"lista\"><font color=\"Silver\">".UNKNOWN."</font></td>");
   } else {
   print("<td align=\"Center\" class=\"lista\">".date('M j Y \\a\t h:i A',$cheapmail["added"])."</td>");
   }
   if ($cheapmail["added_by"]=="Unknown") {
   print("<td align=\"Center\" class=\"lista\"><font color=\"Silver\">".UNKNOWN."</font></td>"); }
   else { print("<td align=\"Center\" class=\"lista\">".$cheapmail["added_by"]."</td>"); }
   print("<td align=\"center\" class=\"lista\"><a href=\"pd-block_cheapmail.php?delete=".$cheapmail["domain"]."\"><img border=\"0\" src=\"".$STYLEPATH."/delete.png\"></a></td></tr>");
   $counter++;
   }
   print("<tr><td align=\"center\" colspan=\"4\" class=\"lista\"><strong>".CHEAP_COUNT_1."<font color=red>$counter</font>".CHEAP_COUNT_2."</strong><br /><br />");
   print("<strong>".CHEAP_ADD."</strong><form name=\"input\" action=\"pd-block_cheapmail.php\" method=\"get\"><input type=\"text\" name=\"cheapmail\" size=\"30\" maxlength=\"100\">&nbsp;<input type=\"submit\" name=\"additthen\" value=\"Submit\"></form><br /></tr></td></table><br />");
block_end(); 

stdfoot();

}

?>
