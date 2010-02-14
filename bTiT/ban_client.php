<?php
// *****************************************************************
// Version: 1.0
// *****************************************************************
//
// Filename: ban_client.php
// Parent:   peers.php
// Requires: functions.php
// Author:   Petr1fied
// Date:     2007-06-17
// Updated:  N/A
//
// Usage:
// - Bans specific BitTorrent Clients, both individual versions and
//   all versions of a client can be banned.
//
// ####### HISTORY ################################################
//
// 1.0 2007-06-17 - Petr1fied - Intital development.
//
// *****************************************************************

require_once ("include/functions.php");

dbconn();

standardheader('Ban BitTorrent Client');

if (!$CURUSER || $CURUSER["admin_access"] == "no")
{
    err_msg(ERROR,"You're not authorised to view this page");
    stdfoot();
    exit;
}
else
{
    (isset($_GET["agent"]) ? $agent = urldecode($_GET["agent"]) : $agent = "");
    (isset($_GET["peer_id"]) ? $peer_id = urldecode($_GET["peer_id"]) : $peer_id = "");
    (isset($_GET["returnto"]) ? $url = urldecode($_GET["returnto"]) : $url = "index.php");
    (isset($_POST["confirm"]) ? $confirm = $_POST["confirm"] : $confirm = "");
    (isset($_POST["reason"]) ? $reason = mysql_real_escape_string($_POST["reason"]) : $reason = "");
    (isset($_POST["banall"]) ? $banall = "yes" : $banall = "no");
    $peer_id_ascii = hex2bin($peer_id);
    $client = getagent($agent, $peer_id);

    if($_POST["confirm"])
    {
        if($confirm == "Yes" && $reason != "")
        {
            $sqlquery = "SELECT id ";
            $sqlquery .= "FROM bannedclient ";
            $sqlquery .= "WHERE peer_id=".sqlesc($peer_id)." ";
            $sqlquery .= "OR peer_id=".sqlesc(substr($peer_id, 0, 6));

            $check = mysql_query($sqlquery) or die(mysql_error());
            if(mysql_num_rows($check) > 0)
            {
                block_begin("Error");
                err_msg(ERROR,"This client is already banned!");
                block_end();
                stdfoot();
                exit();
            }
            if ($banall == "yes")
            {
                $sqlquery = "INSERT INTO bannedclient ";
                $sqlquery .= "VALUES ('', ".sqlesc(substr($peer_id, 0, 6)).", ";
                $sqlquery .= sqlesc(substr($peer_id_ascii, 0, 3)).", ";
                $sqlquery .= "'N/A', ".sqlesc(substr($client, 0, stripos($client, " "))." (All versions)").", ";
                $sqlquery .= " '".$reason."')";
            }
            else
            {
                $sqlquery = "INSERT INTO bannedclient ";
                $sqlquery .= "VALUES ('', ".sqlesc($peer_id).", ";
                $sqlquery .= sqlesc($peer_id_ascii).", ";
                $sqlquery .= sqlesc($agent).", ".sqlesc($client).", '".$reason."')";
            }
          
            @mysql_query($sqlquery) or die(mysql_error());
            block_begin("Success");
            std_msg("Success","This client has been added to the banned list");
            print("<center><a href='$url'>Return</a></center>");
            block_end();
            stdfoot();
            exit();
        }
        elseif($confirm == "No")
        {
            redirect($url);
        }
        else
        {
            block_begin("Error");
            err_msg(ERROR,"You must enter a reason!");
            block_end();
            stdfoot();
            exit();
        }
    }
    block_begin("Ban BitTorrent Client"); ?>
    <p align='center'>By visiting this page you are indicating that
    you want to ban the following client:</p>
    <form method='post' name='action'>
    <table align='center' width=70%>
      <tr>
        <td class='header' align='center'><strong>Client</strong></td>
        <td class='header' align='center'><strong>User Agent</strong></td>
        <td class='header' align='center'><strong>peer_id</strong></td>
        <td class='header' align='center'><strong>peer_id ascii</strong></td>
      </tr>
      <tr>
        <td class='lista' align='center'><?=$client?></td>
        <td class='lista' align='center'><?=$agent?></td>
        <td class='lista' align='center'><?=$peer_id?></td>
        <td class='lista' align='center'><?=$peer_id_ascii?></td>
      </tr>
      <tr>
        <td class='lista' align='right'><strong>Reason</strong></td>
        <td class='lista' colspan='3'><input type='text' name='reason' value='' size='70' maxlength='255'>
        &nbsp;&nbsp;&nbsp;<strong>Ban all versions?</strong><input type='checkbox' name='banall'></td>
      </tr>
      <tr>
        <td class='block' colspan='4'>&nbsp</td>
      <tr>
    </table>
    <p align='center'>Are you sure you want to do this? (you will receive no further confirmation).</p>
    <center>
    <input type='submit' name='confirm' value='Yes'>&nbsp;<input type='submit' name='confirm' value='No'>
    <center></form><br />
    <?php
    block_end();
}
stdfoot();
?>