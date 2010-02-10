<?php
         // backup task
         ignore_user_abort(1);

         global $dbhost, $database, $SITENAME;
         require_once(dirname(__FILE__).'/backup.functions.php');
         $db_auto=get_backup_settings("backup_auto");
         // auto backuop required
         if ($db_auto!='' && $db_auto!='0')
           {
           $db_days=(int)$db_auto * 86400;
           $last_backup_q = @mysql_fetch_assoc(do_sqlquery("SELECT * FROM `{$TABLE_PREFIX}tasks` WHERE `task` = 'backup'", true));
           // backup needed
           if (!isset($last_backup_q["last_time"]) || $last_backup_q["last_time"]<time()-$db_days)
             {
              $bkp_result=do_backup($dbhost,$database);
              write_log(($bkp_result['result']==0?'Backup task complete succesfuLly':'Backup task NOT COMPLETED:'.mysql_escape_string($bkp_result['error'])),'','System');
              if ($bkp_result['result']==0)
              {
                $bkp_email=get_backup_settings("backup_email");
                // email set, send the backup via email

                if ($bkp_email!='')
                 {
                   $files=array();
                   $files[]=$bkp_result['error'];
                   $mm=send_mail_with_attachment($bkp_email,$SITENAME . ': Your database backup ' . date("Y-m-d"),'Attached backup', false, array(), array(), $files);
                   if ($mm)
                      write_log('Backup email was sent to:'.mysql_escape_string($bkp_email),'','System');
                   else
                      write_log('Backup email FAILED!'.mysql_escape_string($bkp_email),'','System');
                 }
              }
           }
         }
         // end backup task
?>