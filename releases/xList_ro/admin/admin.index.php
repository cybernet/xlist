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

if (!$CURUSER || ($CURUSER["admin_access"]!="yes" && $CURUSER["edit_users"]!="yes"))
   {
       err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
       stdfoot();
       exit;
}

// Additional admin check by miskotes
$aid = max(0, $_GET["user"]);
$arandom = max(0, $_GET["code"]);
if (!$aid || empty($aid) || $aid == 0 || !$arandom || empty($arandom) || $arandom == 0)
{
       err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
       stdfoot();
       exit;
}
//if ($arandom!=$ranid["random"] || $aid!=$ranid["id"])
//{
$mqry=do_sqlquery("select u.id, ul.admin_access from {$TABLE_PREFIX}users u INNER JOIN {$TABLE_PREFIX}users_level ul on ul.id=u.id_level WHERE u.id=$aid AND random=$arandom AND (admin_access='yes' OR edit_users='yes') AND username=".sqlesc($CURUSER["username"]),true);

if (mysql_num_rows($mqry) < 1)
{
       err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
       stdfoot();
       exit;
}
else
$mres = mysql_fetch_assoc($mqry);
$moderate_user = ($mres["admin_access"] == "no");
// EOF



define("IN_ACP",true);


if (isset($_GET["do"])) $do = $_GET["do"];
  else $do = "";
if (isset($_GET["action"]))
   $action = $_GET["action"];

$ADMIN_PATH = dirname(__FILE__);

include(load_language("lang_admin.php"));

if ($do!="users"  && $do != "masspm"  && $do != "pruneu"  && $do != "searchdiff" && $moderate_user)
  {
    err_msg($language["ERROR"],$language["NOT_ADMIN_CP_ACCESS"]);
    stdfoot();
    exit;
}

include("$ADMIN_PATH/admin.menu.php");

$menutpl = new bTemplate();
$menutpl->set("admin_menu",$admin_menu);
$tpl->set("main_left",set_block($language["ACP_MENU"],"center",$menutpl->fetch(load_template("admin.menu.tpl"))));

$admintpl = new bTemplate();

switch ($do)
    {
    case 'sticky':
      include("$ADMIN_PATH/admin.sticky.php");
      $tpl->set("main_content",set_block($language["STICKY_SETTINGS"],"center",$admintpl->fetch(load_template("admin.sticky.tpl"))));
      break;

    case 'free':
      include("$ADMIN_PATH/admin.freecontrol.php");
      $tpl->set("main_content",set_block($language["ACP_FREECTRL"],"center",$admintpl->fetch(load_template("admin.freecontrol.tpl"))));
      break;

    case 'invitations':
      include("$ADMIN_PATH/admin.invitations.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.invitations.tpl"))));
      break;

    case 'duplicates':
      include("$ADMIN_PATH/admin.duplicates.php");
      $tpl->set("main_content",set_block($language["DUPLICATES"],"center",$admintpl->fetch(load_template("admin.duplicates.tpl"))));
      break;

    case 'visible':
      include("$ADMIN_PATH/admin.visible.php");
      $tpl->set("main_content",set_block($language["VISIBLE_SETTINGS"],"center",$admintpl->fetch(load_template("admin.visible.tpl"))));
      break;

    case 'language':
      include("$ADMIN_PATH/admin.languages.php");
      $tpl->set("main_content",set_block($language["LANGUAGE_SETTINGS"],"center",$admintpl->fetch(load_template("admin.languages.tpl"))));
      break;

    case 'searchdiff':
      include("$ADMIN_PATH/admin.search_diff.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.search_diff.tpl"))));
      break;

    case 'forum':
      include("$ADMIN_PATH/admin.forums.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.forums.tpl"))));
      break;

    case 'seedbonus':
      include("$ADMIN_PATH/admin.bonus.php");
      $tpl->set("main_content",set_block($language["ACP_SEEDBONUS"],"center",$admintpl->fetch(load_template("admin.bonus.tpl"))));
      break;

    case 'masspm':
      include("$ADMIN_PATH/admin.masspm.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.masspm.tpl"))));
      break;

    case 'pruneu':
      include("$ADMIN_PATH/admin.prune_users.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.prune_users.tpl"))));
      break;

    case 'dbutil':
      include("$ADMIN_PATH/admin.dbutil.php");
      $tpl->set("main_content",set_block($language["DBUTILS_TABLES"]." ".$language["DBUTILS_STATUS"],"center",$admintpl->fetch(load_template("admin.dbutil.tpl"))));
      break;

    case 'logview':
      include("$ADMIN_PATH/admin.sitelog.php");
      $tpl->set("main_content",set_block($language["SITE_LOG"],"center",$admintpl->fetch(load_template("admin.sitelog.tpl"))));
      break;

    case 'warned_users':
      include("$ADMIN_PATH/admin.warned_users.php");
      $tpl->set("main_content",set_block("Warned users","center",$admintpl->fetch(load_template("admin.warned_users.tpl"))));
      break; 
    
    case 'mysql_stats':
      $content="";
      include("$ADMIN_PATH/admin.mysql_stats.php");
      $tpl->set("main_content",set_block($language["MYSQL_STATUS"],"center",$content));
      break;

    case 'prunet':
      include("$ADMIN_PATH/admin.prune_torrents.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.prune_torrents.tpl"))));
      break;

    case 'groups':
      include("$ADMIN_PATH/admin.groups.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.groups.tpl"))));
      break;

    case 'poller':
      include("$ADMIN_PATH/admin.polls.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.polls.tpl"))));
      break;

    case 'badwords':
      include("$ADMIN_PATH/admin.censored.php");
      $tpl->set("main_content",set_block($language["ACP_CENSORED"],"center",$admintpl->fetch(load_template("admin.censored.tpl"))));
      break;

    case 'blocks':
      include("$ADMIN_PATH/admin.blocks.php");
      $tpl->set("main_content",set_block($language["BLOCKS_SETTINGS"],"center",$admintpl->fetch(load_template("admin.blocks.tpl"))));
      break;

    case 'featured':
      include("$ADMIN_PATH/admin.featured.php");
      $tpl->set("main_content",set_block($language["FEATURED_SETTINGS"],"center",$admintpl->fetch(load_template("admin.featured.tpl"))));
      break;

    case 'style':
      include("$ADMIN_PATH/admin.styles.php");
      $tpl->set("main_content",set_block($language["STYLE_SETTINGS"],"center",$admintpl->fetch(load_template("admin.styles.tpl"))));
      break;

    case 'category':
      include("$ADMIN_PATH/admin.categories.php");
      $tpl->set("main_content",set_block($language["CATEGORY_SETTINGS"],"center",$admintpl->fetch(load_template("admin.categories.tpl"))));
      break;

    case 'config':
      include("$ADMIN_PATH/admin.config.php");
      $tpl->set("main_content",set_block($language["TRACKER_SETTINGS"],"center",$admintpl->fetch(load_template("admin.config.tpl"))));
      break;

    case 'banip':
      include("$ADMIN_PATH/admin.banip.php");
      $tpl->set("main_content",set_block($language["ACP_BAN_IP"],"center",$admintpl->fetch(load_template("admin.banip.tpl"))));
      break;
      
    case 'module_config':
      include("$ADMIN_PATH/admin.module_config.php");
      $tpl->set("main_content",set_block($language["ACP_MODULES_CONFIG"],"center",$admintpl->fetch(load_template("admin.module_config.tpl"))));
      break;

    case 'hacks':
      include("$ADMIN_PATH/admin.hacks.php");
      $tpl->set("main_content",set_block($language["ACP_HACKS_CONFIG"],"center",$admintpl->fetch(load_template("admin.hacks.tpl"))));
      break;

    case 'users':
      include("$ADMIN_PATH/admin.users.tools.php");
      $tpl->set("main_content",set_block($block_title,"center",$admintpl->fetch(load_template("admin.users.tools.tpl"))));
      break;
    case 'banclient':
      include("$ADMIN_PATH/admin.ban_client.php");
      $tpl->set("main_content",set_block($language["BAN_CLIENT"],"center",$admintpl->fetch(load_template("admin.ban_client.tpl"))));
      break;
      
    case 'clearclientban':
      include("$ADMIN_PATH/admin.client_clearban.php");
      $tpl->set("main_content",set_block($language["REMOVE_CLIENTBAN"],"center",$admintpl->fetch(load_template("admin.client_clearban.tpl"))));
      break;
    case 'sanity':
      require_once("$THIS_BASEPATH/include/sanity.php");

      $now = time();

      $res = do_sqlquery("SELECT last_time FROM {$TABLE_PREFIX}tasks WHERE task='sanity'");
      $row = mysql_fetch_row($res);
      if (!$row)
          do_sqlquery("INSERT INTO {$TABLE_PREFIX}tasks (task, last_time) VALUES ('sanity',$now)");
      else
      {
        $ts = $row[0];
        do_sqlquery("UPDATE {$TABLE_PREFIX}tasks SET last_time=$now WHERE task='sanity' AND last_time = $ts");
      }
      do_sanity();


    default:
      include("$ADMIN_PATH/admin.main.php");
      $tpl->set("main_content",set_block($language["WELCOME_ADMINCP"],"center",$admintpl->fetch(load_template("admin.main.tpl"))));
      break;

}


?>
