<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
standardheader('Nfo-Ripper');
block_begin("Nfo-Ripper");
begin_frame("");?>
<center>
Ripp your NFO file with our NFO-Ripper. With a ripped NFO file if u dont want<br>
to upload the .nfo file, or if u just wont to put this source in the description.
<p>
You can easy close the ripper when u have ripped your NFO file, cuz it has open in a new window.
</center>
<?end_frame();
block_end();
$action = $_POST["action"];
$nfo = $_POST["nfo"];
if ($action == "rip")
{
$parsed_nfo="";
for ($i=0;$i<strlen($nfo);$i++)
{
//echo "$nfo[$i] =>".ord($nfo[$i])."<br>";
echo "<p>";
  if ( ((ord($nfo[$i]) >= 32) && (ord($nfo[$i]) <= 127)) || (ord($nfo[$i]) == 228) || (ord($nfo[$i]) == 229) || (ord($nfo[$i]) == 246) || (ord($nfo[$i]) == 197) || (ord($nfo[$i]) == 196) || (ord($nfo[$i]) == 214) )

  {
    $parsed_nfo.=$nfo[$i];
  }
  elseif (ord($nfo[$i]) == 13)
  {
  $parsed_nfo.="<br>";   
  }
  }
  $parsed_nfo = split("<br>",$parsed_nfo);
  echo "<table class=embedded><tr><td align=left>";
  for ($i=0;$i<count($parsed_nfo);$i++) {
  if ( (trim($parsed_nfo[$i]) == "") && (trim($parsed_nfo[$i+1]) == "") ) { } else
  {
    echo trim($parsed_nfo[$i])."<br>";
  }
  }
      exit;
  }
 
  ?>
  <p>
  <center>
  <form action="nforipper.php" method="post">
  <input type="hidden" name="action" value="rip">
  <textarea name="nfo" cols=60 rows=30></textarea>
  <p><input type=submit value=Rippa!>
  </center>
 
    <?
    stdfoot();
    ?>