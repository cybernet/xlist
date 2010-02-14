<?php
// *****************************************************************
//
// Filename: deleteme.php
// Parent:   
// Requires: functions.php
// Author:   Petr1fied
// Date:     2007-06-12
// Updated:  2007-06-13
// Version:  1.1
//
// Usage:
// - Allows members to delete their own account.
//
// *****************************************************************
//
// ################### HISTORY ###################
//
// 1.0 2007-06-12 - Petr1fied: Initial development.
// 1.1 2007-06-13 - Petr1fied: Added a ratio check, change the $minratio value at the
//                             top of the file to configure.
//
// *****************************************************************

// File Start --->

require_once ("include/functions.php");


dbconn();

standardheader("Delete your account");

$minratio=0.8; // Edit this to prevent users with a ratio lower than this from deleting their account

if (!$CURUSER || $CURUSER["uid"]==1)
{
    block_begin("Please login");
    err_msg(ERROR,"You must be logged in to access this file");
    block_end();
    stdfoot();
    exit();
}

$row=mysql_fetch_assoc(mysql_query("SELECT (uploaded/downloaded) AS ratio FROM users WHERE id=".$CURUSER["uid"]));

if ($CURUSER["mod_access"]=="yes" || $CURUSER["edit_torrents"]=="yes")
{
    block_begin("Access denied");
    err_msg(ERROR,"Staff accounts can not be deleted via this page");
    block_end();
    stdfoot();
    exit();
}
elseif ($CURUSER["id_level"]>=5 && $CURUSER["id_level"]<=7)
{
    block_begin("Access denied");
    err_msg(ERROR,"VIP, Uploader & Design accounts can not be deleted via this page");
    block_end();
    stdfoot();
    exit();
}
elseif (is_null($row["ratio"]) || $row["ratio"]<$minratio)
{
    block_begin("Permission denied");
    err_msg(ERROR,"You must have a minimum ratio of ".number_format($minratio, 2)." in order to delete your account, your current ratio is ".number_format($row["ratio"], 2));
    block_end();
    stdfoot();
    exit();
}
else
{
    if ($_POST["action"])
    {
        // -----------------------------
        // Captcha hack
        // -----------------------------

        if ($USE_IMAGECODE)
        {
            if (extension_loaded('gd'))
            {
                $arr = gd_info();
                if ($arr['FreeType Support']==1)
                {
                    $public=$_POST['public_key'];
                    $private=$_POST['private_key'];

                    $p=new ocr_captcha();

                    if ($p->check_captcha($public,$private) != true)
                    {
                        block_begin("Error");
                        err_msg(ERROR,ERR_IMAGE_CODE);
                        block_end();
                        stdfoot();
                        exit();
                    }
                }
            }
        }

        @mysql_query("DELETE FROM users WHERE id=".$CURUSER["uid"]);
        write_log($CURUSER["username"]." deleted their own account","delete");
        redirect("index.php");
    }
    block_begin("Delete Account");
    ?>
    <br /> 
    <form method='post'>
    <table width='75%' class='lista' cellspacing='0' cellpadding='10' align='center'>
    Please click "" to delete your account (You will receive no further confirmation)
    <?php
    // -----------------------------
    // Captcha hack
    // -----------------------------
    if ($USE_IMAGECODE)
    {
        if (extension_loaded('gd'))
        {
            $arr = gd_info();
            if ($arr['FreeType Support']==1)
            {
                $p=new ocr_captcha();

                print("<tr><td align='right' class='header'>".IMAGE_CODE.":</td>");
                print("<td align=left class='lista'><input type='text' name='private_key' value='' maxlength='6' size='7'>");
                print($p->display_captcha(true));
                $private=$p->generate_private();
                print("</td></tr>");
            }
        }
    }
    ?>
    <tr><td colspan='2' class='block' align='center'><input type='submit' name='action' value='<?=FRM_CONFIRM?>'></td></tr>
    </form>
    </table><br />
    <?php
    block_end();
}
stdfoot();

// <--- File End

?>