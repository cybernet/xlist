<?php
global $CURUSER;
if (!$CURUSER || $CURUSER["view_users"]=="no")
   {
    // do nothing
   }
else
    {
    //lastest member

     block_begin ("Latest Member");
     $a = @mysql_fetch_assoc(@mysql_query("SELECT id,username FROM users WHERE
     id_level<>1 AND id_level<>2 ORDER BY id DESC LIMIT 1"));
     if($a){
      if ($CURUSER["view_users"]=="yes")
      $latestuser = "<a href=userdetails.php?id=" . $a["id"] . ">" . $a["username"] . "</a>" . Warn_disabled($a['id']) . "";
     else
     $latestuser = $a['username'];
     echo " <div align=center> Welcome to our Tracker <br><b>$latestuser</b>!</div>\n";
     }
     block_end("");

} // end if user can view

//end
?>
