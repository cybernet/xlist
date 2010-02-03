<?php

// CyBerFuN.ro & xList.ro

// CyBerFuN .::. Login
// http://tracker.cyberfun.ro/
// http://www.cyberfun.ro/
// http://xList.ro/
// Modified By cybernet2u

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


require_once(load_language("lang_login.php"));

function login() {
 
   global $language, $logintpl;

    $logintpl->set("language", $language);
    $language["INSERT_USERNAME"] = AddSlashes($language["INSERT_USERNAME"]);
    $language["INSERT_PASSWORD"] = AddSlashes($language["INSERT_PASSWORD"]);

    $login = array();
    $login["action"] = "index.php?page=login&amp;returnto=".urlencode("index.php")."";
    $login["username"] = $user;
    $login["create"] = "index.php?page=signup";
    $login["recover"] = "index.php?page=recover";
    $logintpl->set("login", $login);
}


$logintpl = new bTemplate();


if (!$CURUSER || $CURUSER["uid"] == 1) {


if (isset($_POST["uid"]) && $_POST["uid"])
  $user = $_POST["uid"];
else $user = '';
if (isset($_POST["pwd"]) && $_POST["pwd"])
  $pwd = $_POST["pwd"];
else $pwd = '';

if (isset($_POST["uid"]) && isset($_POST["pwd"]))
  {
    if ($FORUMLINK == "smf")
        $smf_pass = sha1(strtolower($user) . $pwd);
    $res = do_sqlquery("SELECT u.id, u.random, u.password".(($FORUMLINK=="smf") ? ", u.smf_fid, s.passwd, s.passwordSalt" : "")." FROM {$TABLE_PREFIX}users u ".(($FORUMLINK=="smf") ? "LEFT JOIN {$db_prefix}members s ON u.smf_fid=s.ID_MEMBER" : "" )." WHERE u.username ='".AddSlashes($user)."'")
        or die(mysql_error());
    $row = mysql_fetch_array($res);

    if (!$row)
        {
          $logintpl->set("FALSE_USER", true, true);
          $logintpl->set("FALSE_PASSWORD", false, true);
          $logintpl->set("login_username_incorrent", $language["ERR_USERNAME_INCORRECT"]);
          login();
        }
    // start hack phpbb3 integration
elseif (strlen($row["password"]) != 34 && md5($row["random"].$row["password"].$row["random"]) != md5($row["random"].md5($pwd).$row["random"]))
        {
          $logintpl->set("FALSE_USER", false, true);
          $logintpl->set("FALSE_PASSWORD", true, true);
          $logintpl->set("login_password_incorrent", $language["ERR_PASSWORD_INCORRECT"]);
          login();
        }
elseif (strlen($row["password"]) == 34)
{
if (phpbb_check_hash($pwd, $row["password"]))
		{
        logincookie($row["id"], md5($row["random"].$row["password"].$row["random"]));
        if (isset($_GET["returnto"]))
           $url = urldecode($_GET["returnto"]);
        else
            $url = "index.php";
        redirect($url);
        die();
		}
}
// end hack phpbb3 integration
    else
      {
       
        logincookie($row["id"],md5($row["random"].$row["password"].$row["random"]));
        if ($FORUMLINK == "smf" && $smf_pass == $row["passwd"])
            set_smf_cookie($row["smf_fid"], $row["passwd"], $row["passwordSalt"]);
        elseif ($FORUMLINK == "smf" && $row["password"] == $row["passwd"])
        {
            $salt=substr(md5(rand()), 0, 4);
            @mysql_query("UPDATE {$db_prefix}members SET passwd='$smf_pass', passwordSalt='$salt' WHERE ID_MEMBER=".$row["smf_fid"]);
            set_smf_cookie($row["smf_fid"], $smf_pass, $salt);
        }
        if (isset($_GET["returnto"]))
           $url = urldecode($_GET["returnto"]);
        else
            $url = "index.php";
        redirect($url);
        die();
      }
  }

else
  {
    $logintpl->set("FALSE_USER", false, true);
    $logintpl->set("FALSE_PASSWORD", false, true);
    login();
  }






}
else {

  if (isset($_GET["returnto"]))
     $url = urldecode($_GET["returnto"]);
  else
      $url = "index.php";
  redirect($url);
  die();
}
// start hack phpbb3 integration

/**
* start
* @package phpBB3
* @version $Id: functions.php 9519 2009-05-23 16:11:40Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* Encode hash
*/
function _hash_encode64($input, $count, &$itoa64)
{
	$output = '';
	$i = 0;

	do
	{
		$value = ord($input[$i++]);
		$output .= $itoa64[$value & 0x3f];

		if ($i < $count)
		{
			$value |= ord($input[$i]) << 8;
		}

		$output .= $itoa64[($value >> 6) & 0x3f];

		if ($i++ >= $count)
		{
			break;
		}

		if ($i < $count)
		{
			$value |= ord($input[$i]) << 16;
		}

		$output .= $itoa64[($value >> 12) & 0x3f];

		if ($i++ >= $count)
		{
			break;
		}

		$output .= $itoa64[($value >> 18) & 0x3f];
	}
	while ($i < $count);

	return $output;
}

/**
* The crypt function/replacement
*/
function _hash_crypt_private($password, $setting, &$itoa64)
{
	$output = '*';

	// Check for correct hash
	if (substr($setting, 0, 3) != '$H$')
	{
		return $output;
	}

	$count_log2 = strpos($itoa64, $setting[3]);

	if ($count_log2 < 7 || $count_log2 > 30)
	{
		return $output;
	}

	$count = 1 << $count_log2;
	$salt = substr($setting, 4, 8);

	if (strlen($salt) != 8)
	{
		return $output;
	}

	/**
	* We're kind of forced to use MD5 here since it's the only
	* cryptographic primitive available in all versions of PHP
	* currently in use.  To implement our own low-level crypto
	* in PHP would result in much worse performance and
	* consequently in lower iteration counts and hashes that are
	* quicker to crack (by non-PHP code).
	*/
	if (PHP_VERSION >= 5)
	{
		$hash = md5($salt . $password, true);
		do
		{
			$hash = md5($hash . $password, true);
		}
		while (--$count);
	}
	else
	{
		$hash = pack('H*', md5($salt . $password));
		do
		{
			$hash = pack('H*', md5($hash . $password));
		}
		while (--$count);
	}

	$output = substr($setting, 0, 12);
	$output .= _hash_encode64($hash, 16, $itoa64);

	return $output;
}

/**
* Check for correct password
*
* @param string $password The password in plain text
* @param string $hash The stored password hash
*
* @return bool Returns true if the password is correct, false if not.
*/
function phpbb_check_hash($password, $hash)
{
	$itoa64 = './0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	if (strlen($hash) == 34)
	{
		return (_hash_crypt_private($password, $hash, $itoa64) === $hash) ? true : false;
	}

	return (md5($password) === $hash) ? true : false;
}

/**
* end
* @package phpBB3
* @version $Id: functions.php 9519 2009-05-23 16:11:40Z acydburn $
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

// end hack phpbb3 integration
?>
