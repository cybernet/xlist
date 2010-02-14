<?php

if (!defined("IN_ACP"))
    die("No direct access!");

block_begin("Database Tools");
	
	
switch($action)
    {
    case 'runqry':
        if (isset($_POST["confirm"]) && $_POST["confirm"]==FRM_CONFIRM)
            {
              if ($_POST["runquery"]!="")
                    {
                    // just in case...
                    $_POST["runquery"]=strip_tags($_POST["runquery"]);
                    $thequery=strtoupper($_POST["runquery"]);
                    // try to run the query
                    $dbres=mysql_query(unesc($_POST["runquery"])) or die(mysql_error());
                    if (in_array(substr($thequery,0,strpos($thequery," ")),array("SELECT","SHOW","EXPLAIN","DESCRIBE")))
                      // display result
                          {
                           // display result
                           $ad_display.="
                           <br />
                           <form name=\"dbutil\" action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=qry\" method=\"post\">
                           <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"98%\">
                           <tr>
                           <td>".
                           unesc($_POST["runquery"])
                           ."
                           </td>
                           </tr>
                           <tr>
                           <td>
                           <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"100%\">
                           <tr>";
                           // display header (fields' name)
                           $i=0;
                           $field=array();
                           while ($fname=mysql_fetch_field($dbres))
                                {
                                $ad_display.="<td align=\"center\" class=\"header\">{$fname->name}</td>";
                                $field[$i]=$fname->name;
                                $i++;
                                }
                           $ad_display.="</tr>";
                           while ($fname=mysql_fetch_array($dbres))
                              {
                              $ad_display.="
                              <tr>";
                              for($i=0; $i<count($field);$i++)
                                  $ad_display.="<td class=\"lista\">".$fname[$field[$i]]."</td>";
                              $ad_display.="
                              </tr>";
                              }
                           $ad_display.="
                           </table>
                           </td>
                           </tr>
                           </table>
                           </form>";
                          }
                    else
                        // display num rows affected...
                        $ad_display.="
                           <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"98%\">
                           <tr>
                           <td class=\"lista\">".
                           unesc($_POST["runquery"])
                           ."<tr>
                           <td class=\"header\">".
                            mysql_info()
                            ."
                           </td>
                           </tr>
                           </table>
                            ";
               }
         }
         else
            header("Location: admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=qry");
        break;
    case 'qry':  // display tables
        $ad_display.="
        <form name=\"dbutil\" action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=runqry\" method=\"post\">
        <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"100%\">
        <tr>
        <td class=\"lista\" align=\"center\">
        Input a query and press confirm to run it on current datase.
        <textarea name=\"runquery\" rows=\"8\" cols=\"75\"></textarea>
        </td>
        </tr>
        <tr>
        <td align=\"center\" class=\"header\">
        <input type=\"submit\" name=\"confirm\" value=\"".FRM_CONFIRM."\" />&nbsp;&nbsp;&nbsp;
        <input type=\"submit\" name=\"confirm\" value=\"".FRM_CANCEL."\" /></td>
        </tr>
        </table>
        </form>";
        break;
    case 'tables':
        if (isset($_POST["doit"]) && isset($_POST["tname"]))
          {
            $table_action=$_POST["doit"];
            $tables=implode(",",$_POST["tname"]);
            switch ($table_action)
               {
                case 'Repair':
                    $dbres=mysql_query("REPAIR TABLE $tables");
                    break;
                case 'Analyze':
                    $dbres=mysql_query("ANALYZE TABLE $tables");
                    break;
                case 'Optimize':
                    $dbres=mysql_query("OPTIMIZE TABLE $tables");
                    break;
                case 'Check':
                    $dbres=mysql_query("CHECK TABLE $tables");
                    break;
                case 'Delete':
                    $dbres=mysql_query("DROP TABLE $tables");
                    header("Location: admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=status");
                    exit();
                    break;
             }
             $ad_display.="
               <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"100%\">
               <tr>
               <td align=\"center\" class=\"header\">Table</td>
               <td align=\"center\" class=\"header\">Operation</td>
               <td align=\"center\" class=\"header\">Info</td>
               <td align=\"center\" class=\"header\">Status</td>
               </tr>
             ";
             while ($tstatus=mysql_fetch_array($dbres))
                  {
                     $ad_display.="
                     <tr>
                     <td class=\"lista\">{$tstatus['Table']}</td>
                     <td class=\"lista\" align=\"center\">{$tstatus['Op']}</td>
                     <td class=\"lista\" align=\"center\">{$tstatus['Msg_type']}</td>
                     <td class=\"lista\" align=\"right\">{$tstatus['Msg_text']}</td>
                     </tr>
                     ";
             }
             $ad_display.="
                </table>";
        }
         else
            header("Location: admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=status");
        break;
    case 'status':
        $dbstatus=mysql_query("SHOW TABLE STATUS");
        if (mysql_num_rows($dbstatus)>0)
            {
             $ad_display.="
               <script type=\"text/javascript\">
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
               <form name=\"dbutil\" action=\"admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=tables\" method=\"post\">
               <table class=\"lista\" cellspacing=\"1\" cellpadding=\"0\" align=\"center\" border=\"0\" width=\"100%\">
               <tr>
               <td align=\"center\" class=\"header\">&nbsp;</td>
               <td align=\"center\" class=\"header\">Name</td>
               <td align=\"center\" class=\"header\">Records</td>
               <td align=\"center\" class=\"header\">Data Length</td>
               <td align=\"center\" class=\"header\">Overhead</td>
               </tr>
               ";
               $tables=0;
               $bytes=0;
               $records=0;
               $overhead=0;
            // display current status for tables
                while ($tstatus=mysql_fetch_array($dbstatus))
                    {
                     $ad_display.="
                     <tr>
                     <td class=\"lista\" align=\"center\"><input type=\"checkbox\" name=\"tname[]\" value=\"{$tstatus['Name']}\" /></td>
                     <td class=\"lista\">{$tstatus['Name']}</td>
                     <td class=\"lista\" align=\"right\">{$tstatus['Rows']}</td>
                     <td class=\"lista\" align=\"right\">".makesize($tstatus['Data_length']+$tstatus['Index_length'])."</td>
                     <td class=\"lista\" align=\"right\">".($tstatus['Data_free']==0?"-":makesize($tstatus['Data_free']))."</td>
                     </tr>
                     ";
                    $tables++;
                    $bytes+=$tstatus['Data_length']+$tstatus['Index_length'];
                    $records+=$tstatus['Rows'];
                    $overhead+=$tstatus['Data_free'];
                    }
                $ad_display.="
                <tr>
                <td align=\"center\" class=\"lista\"><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('dbutil','tname[]',this.checked)\" /></td>
                <td align=\"center\" class=\"lista\">$tables table(s)</td>
                <td align=\"right\" class=\"lista\">$records</td>
                <td align=\"right\" class=\"lista\">".makesize($bytes)."</td>
                <td align=\"right\" class=\"lista\">".makesize($overhead)."</td>
                </tr>
                <tr>
                <td colspan=\"5\">
                &nbsp;&nbsp;If checked:&nbsp;&nbsp;
                <input type=\"submit\" name=\"doit\" value=\"Repair\" />&nbsp;&nbsp;
                <input type=\"submit\" name=\"doit\" value=\"Optimize\" />&nbsp;&nbsp;
                <input type=\"submit\" name=\"doit\" value=\"Analyze\" />&nbsp;&nbsp;
                <input type=\"submit\" name=\"doit\" value=\"Check\" />&nbsp;&nbsp;
                <input type=\"submit\" name=\"doit\" value=\"Delete\" onclick=\"return confirm('Warning, this will delete selected tables!')\" />
                </td>
                </tr>
                </table>
                ";
               unset($tables);
               unset($bytes);
               unset($records);
               unset($overhead);
            }
        break;
    default:
		/*
		        $ad_display.="
		        <table class=\"lista\" cellspacing=\"1\" cellpadding=\"2\" align=\"center\" border=\"0\" width=\"98%\">
		        <tr>
		        <td class=\"header\" align=\"center\">ID</td>
		        <td class=\"header\" align=\"center\">Command</td>
		        <td class=\"header\" align=\"center\">Time</td>
		        <td class=\"header\" align=\"center\">State</td>
		        <td class=\"header\" align=\"center\">Info</td>
		        </tr>";
		        $risultato = mysql_query("SHOW FULL PROCESSLIST");
		        while ($riga = mysql_fetch_array($risultato)){
		            $ad_display.="
		            <tr>
		            <td class=\"lista\" align=\"center\">{$riga['Id']}</td>
		            <td class=\"lista\">{$riga['Command']}</td>
		            <td class=\"lista\" align=\"right\">{$riga['Time']}</td>
		            <td class=\"lista\" align=\"center\">{$riga['State']}</td>
		            <td class=\"lista\">{$riga['Info']}</td>
		            </tr>";
		        }
		        mysql_free_result ($risultato);
		*/
        print("
		<table class=\"lista\" cellspacing=\"1\" cellpadding=\"2\" align=\"center\" border=\"0\" width=\"100%\">
        <tr>
        <td class=\"header\" align=\"center\" width=\"50%\" colspan=\"3\">
        <input type=\"button\" name=\"query\" value=\"Query\" onclick=\"window.location.href='admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=qry'\" />
        </td>
        <td class=\"header\" align=\"center\" width=\"50%\" colspan=\"2\">
        <input type=\"button\" name=\"status\" value=\"DB Status\" onclick=\"window.location.href='admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=dbutil&action=status'\" />
        </td>
        </tr>
        </table>
        ");
		// thanks to tdbdev.net and CoLdFuSiOn for the mysql stats code
		include(dirname(__FILE__)."/mysql_stats.php");
		print("<div align=\"center\">The code for mysql server status is provided by CoLdFuSiOn (Tbdev.net)</div>");
        break;
}

echo $ad_display;
block_end();


?>