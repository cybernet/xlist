<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2007  Btiteam
//
//    This file is part of xbtit.
//
// Redistribution and use in source and binary forms, with or without modification,
// are permitted provided that the following conditions are met:
//
//   1. Redistributions of source code must retain the above copyright notice,
//      this list of conditions and the following disclaimer.
//   2. Redistributions in binary form must reproduce the above copyright notice,
//      this list of conditions and the following disclaimer in the documentation
//      and/or other materials provided with the distribution.
//   3. The name of the author may not be used to endorse or promote products
//      derived from this software without specific prior written permission.
//
// THIS SOFTWARE IS PROVIDED BY THE AUTHOR ``AS IS'' AND ANY EXPRESS OR IMPLIED
// WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
// MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED.
// IN NO EVENT SHALL THE AUTHOR BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
// SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED
// TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
// PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF
// LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
// NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE,
// EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
//
////////////////////////////////////////////////////////////////////////////////////

if (!defined("IN_BTIT"))
      die("non direct access!");

if (!defined("IN_ACP"))
      die("non direct access!");

require_once(dirname(__FILE__).'/../include/backup.functions.php');
//require_once(dirname(__FILE__).'/../include/class.backup.php');

function get_passed_time($time)
{
  require(load_language("lang_main.php"));
  
  $day   = array($language["DT_SUNDAY"],
                 $language["DT_MONDAY"], 
                 $language["DT_TUESDAY"], 
                 $language["DT_WEDNESDAY"], 
                 $language["DT_THURSDAY"], 
                 $language["DT_FRIDAY"], 
                 $language["DT_SATURDAY"]);

  $month = array("", 
                 $language["DT_JANUARY"], 
                 $language["DT_FEBRUARY"], 
                 $language["DT_MARCH"], 
                 $language["DT_APRIL"], 
                 $language["DT_MAY"], 
                 $language["DT_JUNE"], 
                 $language["DT_JULY"], 
                 $language["DT_AUGUST"], 
                 $language["DT_SEPTEMBER"], 
                 $language["DT_OCTOBER"], 
                 $language["DT_NOVEMBER"], 
                 $language["DT_DECEMBER"]);
  
  $d = date("w", $time);
  $j = date("j", $time);
  $m = date("n", $time);
  $y = date("Y", $time);
  $t = date("H:i:s", $time);
  
  return $day[$d].", ".$j." ".$month[$m]." $y ".$language["DT_AT"]." ".$t;

}

$admintpl->set("language",$language);

$last_backup_q = @mysql_fetch_assoc(do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}tasks` WHERE `task` = 'backup'", true));
if ($last_backup_q["last_time"] != '0')
{
    $last_backup = get_passed_time($last_backup_q["last_time"]);
    $last_time_bkp=(int)$last_backup_q["last_time"];
}
else
{
    $last_backup = $language["DB_FIRST_TIME"];
    $last_time_bkp=0;
}

switch($action)
    
    {
    
    case 'backup':
        
        $result=do_backup($dbhost,$database);

        if ($result['result']>0)
          {
               stderr($language["ERROR"], $result['error']);
               die;
        }

        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=db-backup&action=read&export=yes");

    break;
    
    case 'edit':
        $admintpl->set("edit_settings", true, true);
        $admintpl->set("export_success", false, true);
        $admintpl->set("frm_action", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=db-backup&amp;action=save_settings");
        $db_backup_settings["add_drop_table"]=(get_backup_settings("backup_add_drop_table")=="true"?"checked=\"checked\"":"");
        $db_backup_settings["add_structure"]=(get_backup_settings("backup_add_structure")=="true"?"checked=\"checked\"":"");
        $db_backup_settings["add_data"]=(get_backup_settings("backup_add_data")=="true"?"checked=\"checked\"":"");
        $db_backup_settings["folder_backup"] = get_backup_settings("backup_folder");
        $db_backup_settings["email_backup"]=get_backup_settings("backup_email");
        $db_backup_settings["auto_backup"]=get_backup_settings("backup_auto");

        if ($db_backup_settings["folder_backup"]=='')
           $db_backup_settings["folder_backup"]=realpath("backup");

        $admintpl->set("backup", $db_backup_settings);
        unset($db_backup_settings);
    break;
    
    case 'save_settings':
        if ($_POST["confirm"]==$language["FRM_CONFIRM"])
        {
          $backup = array();
          $backup["backup_add_drop_table"]=isset($_POST["add_drop_table_to_backup"])?"true":"false";
          $backup["backup_add_structure"]=isset($_POST["add_structure_to_backup"])?"true":"false";
          $backup["backup_add_data"]=isset($_POST["add_data_to_backup"])?"true":"false";
          $backup["backup_folder"] = isset($_POST["folder_backup"])?$_POST["folder_backup"]:realpath("backup");
          $backup["backup_email"] = isset($_POST["email_backup"])?$_POST["email_backup"]:'';
          $backup["backup_auto"] = isset($_POST["auto_backup"])?$_POST["auto_backup"]:'0';
          foreach($backup as $key=>$value)
            {
              $values[]="(".sqlesc($key).",".sqlesc($value).")";
              $keys[]=sqlesc($key);
          }

          mysql_query("DELETE FROM `{$TABLE_PREFIX}settings` WHERE `key` IN (".implode(",",$keys).")") or stderr($language["ERROR"],mysql_error());
          mysql_query("INSERT INTO `{$TABLE_PREFIX}settings` (`key`,`value`) VALUES ".implode(",",$values).";") or stderr($language["ERROR"],mysql_error());
          unset($backup);
        }
        redirect("index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=db-backup&action=read");

    case 'download':
         $backup_folder = get_backup_settings("backup_folder");
         if ($backup_folder=='')
            $backup_folder=realpath("backup");

         $backup_file = $database.'-'.date("Y-m-d-H-i-s",$last_time_bkp).".sql".(function_exists("gzencode")?".gz":"");
         if (file_exists("$backup_folder/$backup_file"))
             {
             $file= "$backup_folder/$backup_file";
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename='.basename($file));
             header('Content-Transfer-Encoding: binary');
             header('Expires: 0');
             header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
             header('Pragma: public');
             header('Content-Length: ' . filesize($file));
             ob_clean();
             flush();
             readfile($file);
             exit;

         }
         else
             stderr("Error","This backup don't seems to exists!");
             die;
    break;

    case '':
    case 'read':
    default:
        $admintpl->set("edit_settings", false, true);
        $admintpl->set("export_success", $_GET["export"]=="yes", true);
        $admintpl->set("frm_action_1", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=db-backup&amp;action=backup");
        $admintpl->set("frm_action_2", "index.php?page=admin&amp;user=".$CURUSER["uid"]."&amp;code=".$CURUSER["random"]."&amp;do=db-backup&amp;action=edit");
        $backup["folder_backup"] = get_backup_settings("backup_folder");
        if ($last_time_bkp<>0)
           $backup["last_file"]="<a href=\"index.php?page=admin&user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=db-backup&action=download\">".$database.'-'.date("Y-m-d-H-i-s",$last_time_bkp).".sql".(function_exists("gzencode")?".gz":"")."</a>";
        else
           $backup["last_file"]=$language["DB_FIRST_TIME"];
        $backup["add_drop_table"]=(get_backup_settings("backup_add_drop_table")=="true"?"".$language["YES"]."":"".$language["NO"]."");
        $backup["add_structure"]=(get_backup_settings("backup_add_structure")=="true"?"".$language["YES"]."":"".$language["NO"]."");
        $backup["add_data"]=(get_backup_settings("backup_add_data")=="true"?"".$language["YES"]."":"".$language["NO"]."");
        $bkp_email=get_backup_settings("backup_email");
        $backup["email_backup"] = ($bkp_email==''?'None':$bkp_email);
        $bkp_auto=get_backup_settings("backup_auto");
        $backup["auto_backup"] = ($bkp_auto==''||$bkp_auto=='0'?'<span style="color:red">Disabled</span>':$bkp_auto);
        $admintpl->set("last_backup",$last_backup);
        $admintpl->set("backup",$backup);
        unset($backup);
    break;

} // end switch
?>