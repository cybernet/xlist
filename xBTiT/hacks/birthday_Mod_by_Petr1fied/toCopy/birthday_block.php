<?php

$res=mysql_query("SELECT u.id, u.username, u.dob, ul.prefixcolor, ul.suffixcolor FROM {$TABLE_PREFIX}users u LEFT JOIN {$TABLE_PREFIX}users_level ul ON u.id_level=ul.id WHERE DAYOFMONTH(u.dob)=".date('j')." AND MONTH(u.dob)=".date('n')." AND u.dob!=CURDATE() ORDER BY u.id ASC");

if(@mysql_num_rows($res)>0 && function_exists('userage'))
{
    $users="";
    while($row=mysql_fetch_assoc($res))
    {
        $dob=explode("-", $row["dob"]);
        $age=userage($dob[0], $dob[1], $dob[2]);
        $users.="<a href='index.php?page=userdetails&amp;id=".$row["id"]."'>" . stripslashes($row["prefixcolor"]) . $row["username"] . stripslashes($row["suffixcolor"]) . "</a> ($age), ";
    }
    $users=trim($users,", ").".";
    echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td class='blocklist' align='center'>$users</td></tr></table></div>\n";
}
else
{
    if(!isset($language["BLOCK_NO_BIRTHDAY"])) $language["BLOCK_NO_BIRTHDAY"]="Please disable the birthday block in the AdminCP";
    echo "<div align='center'><table border='0' align='center' cellpadding='0' cellspacing='0' width='100%'><tr><td class='blocklist' align='center'>".$language["BLOCK_NO_BIRTHDAY"]."</td></tr></table></div>\n";
}

block_end();

?>