<?php
require_once ("include/functions.php");
require_once ("include/config.php");
dbconn(true);
global $CURUSER;
// header ("Location: ../index.php");
$res = mysql_query("SELECT last_received_bonus from get_bonus_per_click WHERE user_id=$CURUSER[uid]");
$last_received_bonus = mysql_fetch_assoc($res);
$current_time_stamp_test = time();
$check_if_24_hours_past = $last_received_bonus-$current_time_stamp_test;
// check if user is a virgin in winning bonus - lol //
if (mysql_num_rows($res) < 1)
	  {
mysql_query("INSERT INTO `get_bonus_per_click` (`id`, `last_received_bonus`, `user_id`) VALUES (NULL, 'UNIX_TIMESTAMP()', '$CURUSER[uid]');");
          }
else
		  {
                 
while ($check_if_24_hours_past>=86400) {
                  mysql_query("UPDATE get_bonus_per_click SET last_received_bonus = 'UNIX_TIMESTAMP()' WHERE user_id =$CURUSER[uid]");
	          mysql_query("UPDATE users SET seedbonus = seedbonus+0.5 WHERE id=$CURUSER[uid]");
                                        }
               }
echo "$res";
echo "$check_if_24_hours_past";
?>
