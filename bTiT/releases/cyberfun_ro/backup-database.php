<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once("include/functions.php");
require_once("include/config.php");


dbconn();

if (!$CURUSER || $CURUSER["owner_access"]!="yes")
   {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
}

 // Enter your MySQL access data 
 $host= $dbhost;       
 $user= $dbuser;             
 $pass= $dbpass;
 $db= $database;

 $backupdir = '/backups'; 

 // Compute day, month, year, hour and min.
 $today = getdate();
 $day = $today[mday];
 if ($day < 10) {
    $day = "0$day";
 }
 $month = $today[mon];
 if ($month < 10) {
    $month = "0$month";
 }
 $year = $today[year];
 $hour = $today[hours];
 $min = $today[minutes];
 $sec = "00";

 // Execute mysqldump command.
 // It will produce a file named $db-$year$month$day-$hour$min.gz
 // under $DOCUMENT_ROOT/$backupdir
 system(sprintf(
 // 'mysqldump --opt -h %s -u %s -p%s %s > %s/%s/%s-%s-%s-%s.sql',    
 'mysqldump --opt -h %s -u %s -p%s %s | gzip > %s/%s/%s-%s-%s-%s.gz',
 // 'mysqldump --help %s -u %s -p%s %s | gzip > %s/%s/%s-%s-%s-%s.gz',                                   
  
     $host,
  $user,
  $pass,
  $db,
  getenv('DOCUMENT_ROOT'),
  $backupdir,
  $db,
  $day,
  $month,
  $year
 )); 



$name = $db."-".$day."-".$month."-".$year.".gz";
$date = date("Y-m-d");
$day = date("d");
  mysql_query("INSERT INTO dbbackup (name, added, day) VALUES ('$name', '$date', '$day')") or sqlerr(); 
echo 'Database backup successful, entry inserted into database.'; 
?>