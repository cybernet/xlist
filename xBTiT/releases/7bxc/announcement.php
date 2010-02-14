<?php
/////////////////////////////////////////////////////////////////////////////////////
// xbtit - Bittorrent tracker/frontend
//
// Copyright (C) 2004 - 2009  Btiteam
//
//    This file is part of xbtit - converted from BTI to XBTIT by DiemThuy - jan 2009
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
      
require_once("include/functions.php");
require_once("include/config.php");
dbconn();

$annountpl= new bTemplate();
$annountpl->set("language",$language);
$action = $_GET["action"];

//   Delete Announce Item

if ($action == 'delete')
{

  $ann_id = $_GET["ann_id"];
  if (!is_valid_id($ann_id))
  stderr("Error","Invalid Announcement item ID - Code 1.");

  $returnto = $_GET["returnto"];

  $sure = $_GET["sure"];
  if (!$sure)
        stderr("Delete Announcement","Do you really want to delete this Announcement? Click\n" .
        "<a href=index.php?page=announcement&action=delete&ann_id=$ann_id&sure=1>here</a> if you are sure.");

        mysql_query("DELETE FROM {$TABLE_PREFIX}announcement WHERE id=$ann_id") or sqlerr(__FILE__, __LINE__);
}

//   Add Announcement Item    /////////////////////////////////////////////////////////

if ($action == 'add')
{


    $body = $_POST["body"];
    if (!$body)
        stderr("Error","The Announcement cannot be empty!");

    $title = $_POST["title"];
    if (!$title)
        stderr("Error","The Title cannot be empty!");

    $added = $_POST["added"];
    if (!$added)
    $added = sqlesc(get_date_time());

    mysql_query("INSERT INTO {$TABLE_PREFIX}announcement (userid, added, body ,title) VALUES (".
        $CURUSER['uid'] . ", NOW(), " . sqlesc($body) . ", " . sqlesc($title) . ")") or sqlerr(__FILE__, __LINE__);
    if (mysql_affected_rows() == 1)
    {
        mysql_query("UPDATE {$TABLE_PREFIX}users SET announce = 'yes' WHERE announce='no'");
            $warning = "Announcement was added successfully.";
        }
    else
        stderr("Error","Something weird just happened.");
}

//   Edit Announcement    ////////////////////////////////////////////////////////

   if ($action == 'edit')
{


    $ann_id = $_GET["ann_id"];

  if (!is_valid_id($ann_id))
    stderr("Error","Invalid Announcement item ID - Code 2.");

  $res = mysql_query("SELECT * FROM {$TABLE_PREFIX}announcement WHERE id=$ann_id") or sqlerr(__FILE__, __LINE__);

    if (mysql_num_rows($res) != 1)
      stderr("Error", "No Announcement item with ID $ann_id.");

    $arr = mysql_fetch_array($res);

  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $body = $_POST['body'];
    if ($body == "")
        stderr("Error", "Body cannot be empty!");
    $body = sqlesc($body);
    mysql_query("UPDATE {$TABLE_PREFIX}announcement SET body=$body WHERE id=$ann_id") or sqlerr(__FILE__, __LINE__);

    $title = $_POST['title'];
    if ($title == "")
        stderr("Error", "Title cannot be empty!");
    $title = sqlesc($title);
    mysql_query("UPDATE {$TABLE_PREFIX}announcement SET title=$title WHERE id=$ann_id") or sqlerr(__FILE__, __LINE__);


    $editedat = sqlesc(get_date_time());
    $returnto = $_POST['returnto'];


  }
  else
  {
        $returnto = $_GET['returnto'];

$annountpl->set("tek15","<p><table align=\"center\"><tr><td class=lista><center>");
$annountpl->set("tek16","<td class=header>Admin Function - Edit Announcement</td>\n");
$annountpl->set("tek17","</center>");
$annountpl->set("tek18","<form method=post action=$BASEURL/index.php?page=announcement&action=edit&ann_id=$ann_id>\n");
$annountpl->set("tek19","<table align=\"center\"><tr><td class=lista>\n");
$annountpl->set("tek20","<tr><td><input type=hidden name=returnto value=$returnto></td></tr>\n");
$annountpl->set("tek21","<tr><td class=lista><b>Title &nbsp </b><input type=text size=60 maxlength=60 name=title value=".htmlspecialchars($arr['title'])."></td></tr>\n");
$annountpl->set("tek22","<tr><td class=lista><textarea name=body cols=60 rows= 8 style='border: 0px'>" . htmlspecialchars($arr["body"]) . "</textarea>\n");
$annountpl->set("tek23","<br><br><div align=center><input type=submit value='Edit' class=btn></div></td></tr>\n");
$annountpl->set("tek24","</table>\n");
$annountpl->set("tek25","</form>\n");
}
}
//   Set announce to YES for all users    //////////////////////////////////////////////////////

if ($action == 'show_all')
{
   $sure = $_GET["sure"];
   if (!$sure)
        stderr("Show announcement to all users ?","This will set announce for all users to YES.  Click\n" . "<a href=index.php?page=announcement&action=show_all&sure=1>here</a> if you are sure.");
        mysql_query("UPDATE {$TABLE_PREFIX}users SET announce = 'yes' WHERE announce='no'");

}

//   Set announce to NO for all users    //////////////////////////////////////////////////////

if ($action == 'hide_all')
{
   $sure = $_GET["sure"];
    if (!$sure)
         stderr("Hide announcement to all users ?","This will set announce for all users to NO.  Click\n" .
        "<a href=index.php?page=announcement&action=hide_all&sure=1>here</a> if you are sure.");
         mysql_query("UPDATE {$TABLE_PREFIX}users SET announce = 'no' WHERE announce='yes'");
}
//   Template set new announce if admin acces

if ($CURUSER["admin_access"]=="yes"){
if ($action == 'edit' && $_SERVER['REQUEST_METHOD'] != 'POST')
   {
  $annountpl->set("tek0","");
  $annountpl->set("tek1","");
  $annountpl->set("tek2","");
  $annountpl->set("tek3","");
  $annountpl->set("tek4","");
  $annountpl->set("tek5","");
  $annountpl->set("tek6","");
  $annountpl->set("tek7","");
  $annountpl->set("tek8","");
  $annountpl->set("tek9","");
  $annountpl->set("tek10","<center>");
  $annountpl->set("tek11","[<a href=$BASEURL/index.php?page=announcement&action=show_all><b>Set Announce for all</b></a>]");
  $annountpl->set("tek12"," - [<a href=$BASEURL/index.php?page=announcement&action=hide_all><b>Hide Announce for all</b></a>]");
  $annountpl->set("tek13","</center>");
   }
else
  {
  $annountpl->set("tek0","<p><table align=\"center\"><tr><td class=lista>");
  $annountpl->set("tek1","<center>");
  $annountpl->set("tek2","<tr><td class=header>Admin Function - Create Announcement</td></tr>\n");
  $annountpl->set("tek3","</center>");
  $annountpl->set("tek4","<form method=post action=$BASEURL/index.php?page=announcement&action=add>\n");
  $annountpl->set("tek5","<table align=\"center\"><tr><td class=lista>\n");
  $annountpl->set("tek6","<tr><td class=lista><b>Title &nbsp </b><input type=text size=60 maxlength=60 name=title " . "style='border: 0px; height: 19px'></input></td></tr>\n");
  $annountpl->set("tek7","<tr><td class=lista><textarea name=body cols=60 rows=8 style='border: 0px'></textarea></td></tr>\n");
  $annountpl->set("tek8","<br><br><div align=center><input type=submit value='Announce' class=btn></div></td></tr>\n");
  $annountpl->set("tek9","</table></form>\n");
  $annountpl->set("tek10","<center>");
  $annountpl->set("tek11","[<a href=$BASEURL/index.php?page=announcement&action=show_all><b>Set Announce for all</b></a>]");
  $annountpl->set("tek12"," - [<a href=$BASEURL/index.php?page=announcement&action=hide_all><b>Hide Announce for all</b></a>]");
  $annountpl->set("tek13","</center>");
  }
}
  $res = mysql_query("SELECT * FROM {$TABLE_PREFIX}announcement ORDER BY added DESC") or sqlerr(__FILE__, __LINE__);

      $an=array();
      $i=0;

  mysql_query("UPDATE {$TABLE_PREFIX}users SET announce = 'no' WHERE id=$CURUSER[uid]");

  if (mysql_num_rows($res) > 0)
{
    while ($arr = mysql_fetch_array($res))
    {
        $ann_id = $arr["id"];
        $body = $arr["body"];
        $title = $arr["title"];
        $userid = $arr["userid"];
        $added = $arr["added"] . " (" . (get_elapsed_time(sql_timestamp_to_unix_timestamp($arr["added"]))) . " ago)";

        $res2 = mysql_query("SELECT * FROM {$TABLE_PREFIX}users WHERE id = $userid") or sqlerr(__FILE__, __LINE__);
        $arr2 = mysql_fetch_array($res2);
        
        $res3 = mysql_query("SELECT * FROM {$TABLE_PREFIX}users_level WHERE id_level='".$arr2["id_level"] ."'") or sqlerr();
        $arr3 = mysql_fetch_assoc($res3);


    $postername = $arr3['prefixcolor'].$arr2['username'].$arr3['suffixcolor'];
     $annountpl->set("tekstc","<p><table align=\"center\"><td class=lista>");
    $annountpl->set("tekstd","<p>");

    if ($postername == "")
        $by = "unknown[$userid]";
    else
       $by = "<a href=index.php?page=userdetails&id=$userid><b>$postername</b></a>";
       $an[$i][tekstf]=( "<tr><td class=lista><font color=red>Posted on $added by $by</color></td></tr>\n");
       $an[$i][tekst1]=( "<tr><td class=header><b><font size=1>$title</font></b></td></tr>\n");
       $an[$i][tekst2]=( "<tr><td class=lista>".format_comment($body)."</td></tr>\n");
 
   if ($CURUSER["admin_access"]=="yes"){
       $an[$i][tekst4]=( "<tr><td class=lista>[<a href=index.php?page=announcement&action=edit&ann_id=$ann_id><b>Edit</b></a>]");
       $an[$i][tekst5]=( "- [<a href=index.php?page=announcement&action=delete&ann_id=$ann_id><b>Delete</b></a>]</td></tr>\n");
}
$i++;
}
 $annountpl->set("an",$an);
 $annountpl->set("BACK2", "<br /><br /><center><a href=\"javascript: history.go(-1);\"><tag:language.BACK /></a></center>");
 $annountpl->set("tekst3","</td></tr></table>");
}

?>