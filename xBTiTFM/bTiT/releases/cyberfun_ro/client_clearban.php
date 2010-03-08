<?php
// *****************************************************************
// Version: 1.0
// *****************************************************************
//
// Filename: client_clearban.php
// Parent:   peers.php
// Requires: functions.php
// Author:   Petr1fied
// Date:     2007-06-17
// Updated:  N/A
//
// Usage:
// - Removes bans on BitTorrent Clients.
//
// ####### HISTORY ################################################
//
// 1.0 2007-06-17 - Petr1fied - Intital development.
//
// *****************************************************************

require_once ("include/functions.php");

dbconn();

standardheader('Clear Client Ban');

if ($CURUSER["admin_access"] == "no")
{
    err_msg(ERROR,"You're not authorised to view this page");
    stdfoot();
    exit;
}
else
{
    (isset($_GET["id"]) ? $id = 0 + $_GET["id"] : $id = "");
    (isset($_GET["returnto"]) ? $url = urldecode($_GET["returnto"]) : $url = "");
    (isset($_POST["confirm"]) ? $confirm = $_POST["confirm"] : $confirm = "");

    if($_POST["confirm"])
    {
        if($confirm == "Yes")
        {
            @mysql_query("DELETE FROM `bannedclient` WHERE `id`=".$id);
            block_begin("Success");
            std_msg("Success","This client has been removed from the banned list");
            print("<center><a href='$url'>Return</a></center>");
            block_end();
            stdfoot();
            exit();
        }
        else
            redirect($url);
    }
    $row = mysql_fetch_assoc(mysql_query("SELECT * FROM `bannedclient` WHERE `id`=$id"));

    block_begin("Clear Client Ban");

    if($row)
    {
        ?>
        <p align='center'>By visiting this page you are indicating that you wish to
        remove the ban on the following client:</p>
        <form method='post' name='action'>
        <table align='center' width=70%>
          <tr>
            <td class='header' align='center'><strong>Client</strong></td>
            <td class='header' align='center'><strong>User Agent</strong></td>
            <td class='header' align='center'><strong>peer_id</strong></td>
            <td class='header' align='center'><strong>peer_id ascii</strong></td>
            <td class='header' align='center'><strong>Ban Reason</strong></td>
          </tr>
          <tr>
            <td class='lista' align='center'><?=$row["client_name"]?></td>
            <td class='lista' align='center'><?=$row["user_agent"]?></td>
            <td class='lista' align='center'><?=$row["peer_id"]?></td>
            <td class='lista' align='center'><?=$row["peer_id_ascii"]?></td>
            <td class='lista' align='center'><?=stripslashes($row["reason"])?></td>
          </tr>
          <tr>
            <td class='block'colspan='5'><strong>&nbsp;</strong></td>
          </tr>
        </table>
        <p align='center'>Are you sure you want to do this? (you will receive no further confirmation).</p>
        <center>
        <input type='submit' name='confirm' value='Yes'>&nbsp;<input type='submit' name='confirm' value='No'>
        <center></form><br />
        <?php
    }
    block_end();
}
stdfoot();
?>
