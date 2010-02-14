<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");
require_once ("include/check_username.php");


dbconn();

//Check Username fixed by fatepower to PB Edition 1.5.X
foreach($_POST as $key => $value) {
$value = trim($value);
if (get_magic_quotes_gpc()) $value = stripslashes($value);
$value = htmlspecialchars($value,ENT_QUOTES);
$_POST[$key] = $value;
$value = str_replace("\r","",$value);
$value = str_replace("\n","<br>",$value);
$msg[$key] = $value;
}
sajax_init();
sajax_export("check_user_exist");
sajax_handle_client_request();
function check_user_exist($username) {
$username = mysql_escape_string($username);
$suggest = array('2005', '2006', '2007', 'best');
$sql = "SELECT `username` FROM `users` WHERE `username` = '$username'";
$result = mysql_query($sql);
if(mysql_num_rows($result) > 0) {
$avail[0] = 'no';
$i = 2;
foreach($suggest AS $postfix) {
$sql = "SELECT `username` FROM `users` WHERE `username` = '".$username.$postfix."'";
$result = mysql_query($sql);
if(mysql_num_rows($result) < 1) {
$avail[$i] = $username.$postfix;
$i ++;
}
}
$avail[1] = $i - 1;
return $avail;
}
return array('yes');
}
//Check Username fixed by fatepower to PB Edition 1.5.X

if (!isset($_POST["language"])) $_POST["language"] = 0;
$idlang = intval($_POST["language"]);

standardheader('Account Management',true,$idlang);

?>

<script type="text/javascript">
<?php
sajax_show_javascript();
?>
function check_handle(result) {
if(result[0] == 'yes') {
document.getElementById('not_available').style.display = 'none';
document.getElementById('available').style.display = 'block';
}
else {
document.getElementById('available').style.display = 'none';
document.getElementById('not_available').style.display = 'block';
var str = 'Username already exists! <br />';
document.getElementById('not_available').innerHTML = str;
}
}

function check_user_exist() {
var username = document.getElementById('username').value;
x_check_user_exist(username, check_handle);
}

function switch_username(username) {
document.getElementById('username').value = username;
}
</script>

<style type="text/css">
#available {
display: none;
color: green;
}
#not_available {
display: none;
color: red;
}
</style>

<SCRIPT Language="Javascript">
<!--

function FormControl($nopwd)
  {
//  alert("flag="+document.utente.flag.options[document.utente.flag.selectedIndex].value);
// Controllo nome + pwd
    if (document.utente.user.value == "" )
      {
        alert(INSERT_USERNAME);
        return false;
      }

     if ($nopwd=="mod") {
        return true;
     }

    if ((document.utente.pwd.value == ""))
      {
      alert(INSERT_PASSWORD);
      return false;

      }

    if ((document.utente.pwd.value !=  document.utente.pwd1.value))
      {
      alert(DIF_PASSWORDS);
      return false;
      }
   return true;
  }
// -->
</SCRIPT>

<?php

if (isset($_GET["uid"])) $id = intval($_GET["uid"]);
 else $id = "";
if (isset($_GET["returnto"])) $link = urldecode($_GET["returnto"]);
 else $link = "";
if (isset($_GET["act"]))
	$act = $_GET["act"];
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
elseif (isset($HTTP_GET_VARS["invitenumber"]))
{
	$code = $HTTP_GET_VARS["invitenumber"];
	$act = "invite";
}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
else
	$act = "signup";
if (isset($_GET["language"])) $idlangue = intval($_GET["language"]);
 else $idlangue = "";
if (isset($_GET["style"])) $idstyle = intval($_GET["style"]);
 else $idstyle = "";
if (isset($_GET["flag"])) $idflag = intval($_GET["flag"]);
 else $idflag = "";

if (isset($_POST["uid"]) && isset($_POST["act"]))
  {
if (isset($_POST["uid"])) $id = intval($_POST["uid"]);
 else $id = "";
if (isset($_POST["returnto"])) $link = urldecode($_POST["returnto"]);
 else $link = "";
if (isset($_POST["act"])) $act = $_POST["act"];
 else $act = "";
  }
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
if (isset($HTTP_GET_VARS["invitenumber"]))
{
	$res = mysql_query("SELECT inviter FROM invites WHERE hash = '$code'") or sqlerr();
	$inv = mysql_fetch_assoc($res);  
	$inviter = $inv["inviter"];
	
	if (!$inv)
	{
		block_begin(INVALID_INVITE);
		err_msg(ERROR,"<b>".ERR_INVITE."</b>");
		block_end();
		stdfoot();
		exit;
	}
}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

print("<center>");
if ($act == "mod")
  {
   if ($CURUSER["edit_users"] != "yes" || $id == 1)
      stderr(ERROR,ERR_NOT_AUTH);
   else
      block_begin(ACCOUNT_EDIT);
  }
elseif ($act == "signup" && isset($CURUSER["uid"]) && $CURUSER["uid"] != 1) {
        $url = "index.php";
        redirect($url);
}
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
elseif ($act == "invite")
	block_begin(ACCOUNT_CREATE);
elseif ($act == "signup")
	block_begin(ACCOUNT_CREATE);
elseif ($act == "del")
{
	if ($CURUSER["delete_users"] != "yes" || $id == 1 || $CURUSER["uid"] == $id)
		stderr(ERROR,ERR_NOT_AUTH);
	else
		block_begin(ACCOUNT_DELETE);
}
elseif ($act == "confirm")
	block_begin(ACCOUNT_CONFIRM);
print("</center>");
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

$res = mysql_query("SELECT count(*) FROM users WHERE id>1");
$nusers = mysql_fetch_row($res);
$numusers = $nusers[0];

if ($act == "signup" && $PRIVATE_TRACKER)
{
	err_msg(ERROR,ONLY_INVITES);
	block_end();
	stdfoot();
	exit();
}
elseif ($act == "signup" && (($MAX_USERS != 0 && $numusers >= $MAX_USERS) || ($GLOBALS["reg"]==false)))
   {
   if ($GLOBALS["reg"] == false) $err_msg = REGISTRATION_OFFLINE; else $err_msg = REACHED_MAX_USERS;
   err_msg(ERROR,$err_msg);
   block_end();
   stdfoot();
   exit();
}

if ($act == "confirm") {
      $random = intval($_GET["confirm"]);
      $res = mysql_query("UPDATE users SET id_level=3 WHERE id_level=2 AND random=$random");
      if (!$res)
         die("ERROR: " . mysql_error() . "\n");
      else {
          block_begin(ACCOUNT_CREATE);
          print("<tr><td align=\"center\">".ACCOUNT_CONGRATULATIONS."</td></tr>");
          block_end();
          stdfoot();
          exit;
          //print("<a href=login.php>".USER_LOGIN."</A>")
          }
}

if ($CURUSER["edit_users"] == "yes") {

if (!isset($_POST["elimina"])) $_POST["elimina"] = "";
if ($_POST["elimina"] == FRM_DELETE) {
   if ($CURUSER["delete_users"] != "yes") {
      print(CANT_DELETE_USER);
      print("<a href=$link>".BACK."</a>");
      block_end();
      stdfoot();
      exit();
      }
//   $ret = mysql_query("SELECT users_level.id_level, users.id as uid, users.email AS email FROM users_level INNER JOIN users ON users.id_level=users_level.id WHERE username='".mysql_escape_string($_POST["user"])."'");
   $ret = mysql_query("SELECT users_level.id_level, users.email AS email FROM users_level INNER JOIN users ON users.id_level=users_level.id WHERE username='".mysql_escape_string($_POST["user"])."'");
   $row = @mysql_fetch_array($ret);
   if ($row && $row["id_level"] > $CURUSER["id_level"]) {
    // impossible to delete higher levels
      print(ERR_NOT_AUTH);
      print(" <a href=$link>".BACK."</a>");
      block_end();
      stdfoot();
      exit();
   }
   $email = $row["email"];
   $comment = DELETED_USER." (".mysql_escape_string($_POST["user"]).")";
   $added = sqlesc(time());
		
   @mysql_query("INSERT INTO bannedmail (added, addedby, email, comment) VALUES($added, $CURUSER[uid], '$email', '$comment')") or die(mysql_error());
   @mysql_query("DELETE FROM users WHERE username='".mysql_escape_string($_POST["user"])."'");
   @mysql_query("DELETE FROM wishlist WHERE user_id=".$row['uid']);
   @mysql_query("DELETE FROM notes WHERE userid='".mysql_escape_string($_POST["uid"])."'");
   @mysql_query("DELETE FROM warnings WHERE userid='".mysql_escape_string($_POST["uid"])."'");
   write_log("Deleted user ".mysql_escape_string($_POST["user"]),"delete");
   print("<script LANGUAGE=\"javascript\">window.location.href=\"$link\"</script>");
   block_end();
   stdfoot();
   exit();
}
elseif ($_POST["elimina"] == FRM_CANCEL)
       print("<script LANGUAGE=\"javascript\">window.location.href=\"$link\"</script>");

if (!isset($_POST["conferma"])) $_POST["conferma"] = "";
if ($_POST["conferma"]) {
   if ($act == "signup") {
      $ret = aggiungiutente();
      if ($ret == 0)
         {
             if ($VALIDATION == "user")
                {
                  print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                  print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                  print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".EMAIL_SENT."</font><br /><br /></td>\n");
                  print("</tr></table></div><br />\n");
                  block_end();
                  stdfoot();
                  exit();
                }
             else if ($VALIDATION == "none")
                  {
                  print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                  print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                  print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".ACCOUNT_CONGRATULATIONS."</font><br /><br /></td>\n");
                  print("</tr></table></div><br />\n");
                  block_end();
                  stdfoot();
                  exit();
                  }
             else
                 {
                  print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                  print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                  print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".WAIT_ADMIN_VALID."</font><br /><br /></td>\n");
                  print("</tr></table></div><br />\n");
                  block_end();
                  stdfoot();
                  exit();
                 }
         }
      elseif ($ret==-1)
        err_msg(ERROR,ERR_MISSING_DATA);
      elseif ($ret==-2)
        err_msg(ERROR,ERR_EMAIL_ALREADY_EXISTS);
      elseif ($ret==-3)
          err_msg(ERROR,"Invalid Email!"); // valid email check - by vibes
      else
        err_msg(ERROR,ERR_USER_ALREADY_EXISTS);

       block_end();
       stdfoot();
       exit();
      }
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
		elseif ($act == "invite")
		{
			$ret = aggiungiutente_invite();
			if ($ret == 0)
			{
				if ($VALID_INV == true)
				{
					print("<tr><td align='center' class='lista'>".INVITE_EMAIL_SENT1." (" . htmlspecialchars($email) . "). ".INVITE_EMAIL_SENT2."</td></tr>");
					block_end();
					stdfoot();
					exit();
				}
				else
				{
					print("<tr><td align='center' class='lista'>".INVITE_EMAIL_SENT3." (" . htmlspecialchars($email) . "). ".INVITE_EMAIL_SENT4."</td></tr>");
					block_end();
					stdfoot();
					exit();
				}
			}
			elseif ($ret==-1)
			{
				err_msg(ERROR,ERR_MISSING_DATA);
				block_end();
				stdfoot();
			}
			elseif ($ret==-2)
			{
				err_msg(ERROR,ERR_EMAIL_ALREADY_EXISTS);
				block_end();
				stdfoot();
			}
			elseif ($ret==-3)
			{
				err_msg(ERROR,EMAIL_INVALID); // valid email check - by vibes
				block_end();
				stdfoot();
			}
			else
			{
				err_msg(ERROR,ERR_USER_ALREADY_EXISTS);
				block_end();
				stdfoot();
			}
			
			block_end();
			exit();
		}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
elseif ($act == "mod" && $CURUSER['edit_users'] == "yes" && $CURUSER["uid"] > 1) {
  //$ret = mysql_query("SELECT id_level, id FROM users WHERE username='".mysql_escape_string($_POST["user"])."'");
  $ret = mysql_query("SELECT users.*, users_level.id_level as idlevel FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE username='".mysql_escape_string($_POST["user"])."'");
  $row = @mysql_fetch_array($ret);
  if ($row && $row["idlevel"] > $CURUSER["id_level"] && $CURUSER["uid"] != $row["id"]){
   // impossible to edit higher levels
      print(ERR_NOT_AUTH);
      print("<br />\n <a href=$link>".BACK."</a>");
      block_end();
      stdfoot();
      exit();
  }
       modificautente();
       print("<script LANGUAGE=\"javascript\">window.location.href=\"$link\"</script>");
       block_end();
       stdfoot();
       exit();
       }
}

if ($id != 0) {
//   $res = mysql_query("SELECT * FROM users WHERE id=$id");
   $res = mysql_query("SELECT users.*, users_level.id_level as idlevel, users_level.level FROM users INNER JOIN users_level ON users.id_level=users_level.id WHERE users.id=$id");
   $num = mysql_num_rows($res);
   if ($num = 0)
      print("<p><center>".ERROR." ".USER_NOT_FOUND."</center></p>");
   else {
        $row = mysql_fetch_array($res);
        // prevent editing users account if current user's level < edited account
        //if ($row && $row["id_level"] > $CURUSER["id_level"] && $CURUSER["uid"]!=$row["id"]){
        if ($row && $row["idlevel"] > $CURUSER["id_level"] && $CURUSER["uid"]!=$row["id"]){
         // impossible to edit higher levels
            print(ERR_NOT_AUTH);
            print("<br /> <a href=$link>\n".BACK."</a>");
            block_end();
            stdfoot();
            exit();
        }
        elseif ($row && $row["id"] == $CURUSER["uid"])
            {
            // try to edit own account???
            print("Use your panel to change your account details!");
            print("<br /> <a href=$link>\n".BACK."</a>");
            block_end();
            stdfoot();
            exit();
        }
        else
            tabella($act,$row);
      }
}
else {
 tabella($act);
 }

  print("<center><a href=\"javascript: history.go(-1);\">".BACK."</a></center>");
  }
else {
     if ($_POST["conferma"]) {
        if ($act == "signup") {
           $ret = aggiungiutente();
           if ($ret == 0)
              {
              if ($VALIDATION == "user")
                 {
                   print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                   print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                   print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".EMAIL_SENT."</font><br /><br /></td>\n");
                   print("</tr></table></div><br />\n");
                   block_end();
                   stdfoot();
                   exit();
                 }
              else if ($VALIDATION == "none")
                   {
                   print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                   print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                   print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".ACCOUNT_CONGRATULATIONS."</font><br /><br /></td>\n");
                   print("</tr></table></div><br />\n");
                   block_end();
                   stdfoot();
                   exit();
                   }
              else
                  {
                   print("<div align=\"center\"><br /><table border=\"0\" width=\"500\" cellspacing=\"0\" cellpadding=\"0\"><tr>\n");
                   print("<td bgcolor=\"#FFFFFF\" align=\"center\" style=\"border-style: dotted; border-width: 1px\" bordercolor=\"#CC0000\">\n");
                   print("<br /><font color=\"#FF0000\"><b>".ACCOUNT_CREATED."</b><br /><br />".WAIT_ADMIN_VALID."</font><br /><br /></td>\n");
                   print("</tr></table></div><br />\n");
                   block_end();
                   stdfoot();
                   exit();
                  }
              }
      elseif ($ret==-1)
        err_msg(ERROR,ERR_MISSING_DATA);
      elseif ($ret==-2)
        err_msg(ERROR,ERR_EMAIL_ALREADY_EXISTS);
      elseif ($ret==-3)
        err_msg(ERROR,"Invalid Email!"); // valid email check - by vibes
      elseif ($ret==-7)
        err_msg(ERROR,"<font color=\"black\">".ERR_NO_SPACE."<strong><font color=\"red\">".preg_replace('/\ /', '_', mysql_escape_string($_POST["user"]))."</strong></font></font><br />");
      elseif ($ret==-8)
        err_msg(ERROR,ERR_SPECIAL_CHAR);
      elseif ($ret==-9)
        err_msg(ERROR,ERR_PASS_LENGTH);
      else
        err_msg(ERROR,ERR_USER_ALREADY_EXISTS);
//           elseif ($ret==-1)
//             err_msg(ERROR,ERR_MISSING_DATA);
//           elseif ($ret==-7)
//             err_msg(ERROR,"<font color=\"black\">".ERR_NO_SPACE."<strong><font color=\"red\">".preg_replace('/\ /', '_', mysql_escape_string($_POST["user"]))."</strong></font></font><br />");
//           elseif ($ret==-8)
//             err_msg(ERROR,ERR_SPECIAL_CHAR);
//           elseif ($ret==-9)
//             err_msg(ERROR,ERR_PASS_LENGTH);
//           else
//            print(ERROR.USER_ALREADY_EXISTS); 
           }
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
	elseif ($act == "invite")
	{
		$ret = aggiungiutente_invite();
			if ($ret == 0)
			{
				if ($VALID_INV == true)
				{
					print("<tr><td align='center' class='lista'>".INVITE_EMAIL_SENT1." (" . htmlspecialchars($email) . "). ".INVITE_EMAIL_SENT2."</td></tr>");
					block_end();
					stdfoot();
					exit();
				}
				else
				{
					print("<tr><td align='center' class='lista'>".INVITE_EMAIL_SENT3." (" . htmlspecialchars($email) . "). ".INVITE_EMAIL_SENT4."</td></tr>");
					block_end();
					stdfoot();
					exit();
				}
			}
		elseif ($ret==-1)
		{
			err_msg(ERROR,ERR_MISSING_DATA);
			block_end();
			stdfoot();
		}
		elseif ($ret==-2)
		{
			err_msg(ERROR,ERR_EMAIL_ALREADY_EXISTS);
			block_end();
			stdfoot();
		}
		elseif ($ret==-3)
		{
			err_msg(ERROR,EMAIL_INVALID); // valid email check - by vibes
			block_end();
			stdfoot();
		}
		else
		{
			err_msg(ERROR,ERR_USER_ALREADY_EXISTS);
			block_end();
			stdfoot();
		}
		
		block_end();
		exit();
	}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
        }
      elseif ($act == "mod" && $CURUSER["uid"] != $id)
             err_msg(ERROR,NOT_AUTH);
      else
          tabella($act);

}

function tabella($action, $dati = array())
{
	global $idflag, $link, $idlangue, $idstyle, $CURUSER, $USE_IMAGECODE, $code, $inviter;


?>
<center>
<p>

<form name="utente" method="post" OnSubmit="return FormControl('<?php echo $action; ?>')" action="<?php echo htmlentities(urldecode($_SERVER['PHP_SELF'])) ."?act=$action&returnto=".urlencode($link); ?>">
<input type="hidden" name="act" value="<?php echo $action ?>" />
<input type="hidden" name="uid" value="<?php echo $dati["id"] ?>" />
<input type="hidden" name="returnto" value="<?php echo urlencode($link) ?> "/>
<input type="hidden" name="language" value="<?php echo $idlangue ?> "/>
<input type="hidden" name="style" value="<?php echo $idstyle ?> "/>
<input type="hidden" name="flag" value="<?php echo $idflag ?> "/>
<input type="hidden" name="username" value="<?php echo $dati["username"] ?>"/>
<table width="60%" border="0" class="lista">
	<?php
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
        if ($action == "invite")
	{
		?>
		<tr><td align=center class=lista colspan="2"><b><?php echo WELCOME_INVITE; ?></b></td></tr>
		<?php
	}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
	?>
<tr>
   <td align=left class="header"><?php echo USER_NAME ?>: </td>
   <td align="left" class="lista">
   <?php
   if ($action == "mod" || $action == "del")
       print("\n<input type=\"text\" size=\"40\" name=\"user\" value=\"".unesc($dati['username'])."\" ".($action=="mod"?"":"readonly")." />");   
	else
    print("\n<input type=\"text\" size=\"40\" name=\"user\" id=username />
   <input class=tableinborder type=button name=check value=Check onclick=check_user_exist(); return false;>
<br>
   <div id=available>Username free for you!</div>
   <div id=not_available>Username already exists!</div>");
   ?>
   </td>
</tr>
<?php
	if (($CURUSER["uid"] == $dati["id"] && $action == "mod") || $action == "signup" || $action == "invite" || ($CURUSER["edit_users"] == "yes" && $action == "mod"))
   {
   ?>
<!-- Password Hack Start -->
<!-- Deleted id="usernameprint" in input tag -->
<tr>
   <td align=left class="header"><?php echo USER_PWD?>:</td>
   <td align="left" class="lista"><img src="images/tooshort.gif" id="strength" alt="" />
   <br>
   <input maxlength="15" onkeyup="updatestrength( this.value );" type="password" size="40" name="pwd" />
</td>
<!-- Password Hack End -->
<!-- Password Hack Replace With lines Bellow Start -->
<!-- <tr> -->
<!--   <td align=left class="header"><?php echo USER_PWD?>:</td> -->
<!--   <td align="left" class="lista"><input type="password" size="40" name="pwd" /></td> -->
<!-- Password Hack Replace End -->
</tr>
<tr>
   <td align=left class="header"><?php echo USER_PWD_AGAIN?>:</td>
   <td align="left" class="lista"><input type="password" size="40" name="pwd1" /></td>
</tr>
<tr>
   <td align=left class="header"><?php echo USER_EMAIL?>:</td>
   <td align="left" class="lista"><input type="text" size="30" name="email" value="<?php if ($action=="mod") echo $dati['email']; ?>"/></td>
</tr>
<tr>
   <td align=left class="header"><?php echo USER_EMAIL_AGAIN?>:</td>
   <td align="left" class="lista"><input type="text" size="30" name="email1" /></td>
</tr>
<!-- Email note start by fatepower -->
<?php
global $VALIDATION, $act;
if ($VALIDATION == "user" && $act == "signup")
//if ($VALIDATION=="user" && $action=="signup")
//if ($action=="signup")
{
   print("<tr>\n\t<td align=left class=\"header\">Email Note:</td>");
   print("\n\t<td align=\"left\" class=\"lista\"><font color=\"red\">Use your ISP email or Yahoo, Gmail etc. You must enter an valid email!</font></td>");
   print("</tr>");
}
?>
<!-- Email note Ends by fatepower -->
<!-- GENDER/AGE Hack Start -->
		<tr>
			<td align="left" class="header"><?php echo GENDER; ?>:</td>
			<td align="left" class="lista">
				<label>
					<input name="gen" type="radio" value="1" <?php echo ($dati["gender"]==1?"checked=\"checked\"":""); ?> /><?php echo MALE; ?>
				</label>&nbsp;&nbsp;
				<label>
					<input name="gen" type="radio" value="2" <?php echo ($dati["gender"]==2?"checked=\"checked\"":""); ?> /><?php echo FEMALE; ?>
				</label>
			</td>
		</tr>
		<tr>
			<td align="left" class="header"><?php echo AGE; ?>:</td>
			<td align="left" class="lista"><input type="text" size="3" name="age" maxlength="3" value="<?php echo $dati["age"]; ?>" /></td>
		</tr>
<!-- GENDER/AGE Hack End -->
   <?php
   $lres = language_list();
   print("<tr>\n\t<td align=left class=\"header\">".USER_LANGUE.":</td>");
   print("\n\t<td align=\"left\" class=\"lista\"><select name=language>");
   foreach($lres as $langue)
     {
       $option = "\n<option ";
       if ($langue["id"] == $dati["language"])
          $option .= "selected=selected ";
       $option .= "value=".$langue["id"].">".$langue["language"]."</option>";
       print($option);
     }
   print("</select></td>\n</tr>");

   $sres = style_list();
   print("<tr>\n\t<td align=left class=\"header\">".USER_STYLE.":</td>");
   print("\n\t<td align=\"left\" class=\"lista\"><select name=style>");
   foreach($sres as $style)
     {
       $option = "\n<option ";
       if ($style["id"] == $dati["style"])
          $option .= "selected=selected ";
       $option .= "value=".$style["id"].">".$style["style"]."</option>";
       print($option);
     }
   print("</select></td>\n</tr>");
   $fres = flag_list();

   print("<tr>\n\t<td align=left class=\"header\">".PEER_COUNTRY.":</td>");
   print("\n\t<td align=left class=\"lista\"><select name=flag>\n<option value='0'>---</option>");

   $thisip = $_SERVER["REMOTE_ADDR"];
   $remotedns = gethostbyaddr($thisip);

   if ($remotedns != $thisip)
       {
       $remotedns = strtoupper($remotedns);
       preg_match('/^(.+)\.([A-Z]{2,3})$/', $remotedns, $tldm);
       if (isset($tldm[2]))
              $remotedns = mysql_escape_string($tldm[2]);
     }

   foreach($fres as $flag)
    {
        $option = "\n<option ";
            if ($flag["id"] == $dati["flag"] || ($flag["domain"] == $remotedns && $action == "signup"))
              $option .= "selected=selected ";
            $option .= "value='".$flag["id"]."'>".$flag["name"]."</option>";
         print($option);
    }
   print("</select></td>\n</tr>");

           $zone = date('Z',time());
           $daylight = date('I',time())*3600;
           $os = $zone-$daylight;
           if($os != 0){ $timeoff = $os / 3600; } else { $timeoff = 0; }

           if(!$CURUSER || $CURUSER["uid"] == 1)
              $dati["time_offset"] = $timeoff;

           $tres = timezone_list();
           print("<tr>\n\t<td align=left class=\"header\">".TIMEZONE.":</td>");
           print("\n\t<td align=\"left\" class=\"lista\" colspan=\"2\">\n<select name=\"timezone\">");
           foreach($tres as $timezone)
             {
               $option = "\n<option ";
               if ($timezone["difference"] == $dati["time_offset"])
                  $option .= "selected=selected ";
               $option .= "value=".$timezone["difference"].">".unesc($timezone["timezone"])."</option>";
               print($option);
             }
           print("</select></td>\n</tr>");

// -----------------------------
// Captcha hack
// -----------------------------
// if set to use secure code: try to display imagecode

if ($CURUSER['edit_users'] == 'yes' && $action == "mod" && $CURUSER["uid"] != $dati["id"]) {
   print("<tr>\n\t<td align=left class=\"header\">". USER_LEVEL .":</td><td align=\"left\" class=\"lista\">");
   print("<select name=\"level\">");
//   $res=mysql_query("SELECT id,level FROM users_level WHERE id_level<=".$CURUSER["id_level"]." ORDER BY id_level");
   $res = mysql_query("SELECT level FROM users_level WHERE id_level<=".$CURUSER["id_level"]." ORDER BY id_level");
   while($row = mysql_fetch_array($res))
   {
//       $select="<option value='".$row["id"]."'";
//       if ($dati["id_level"]==$row["id"])
       $select = "<option value='".unesc($row["level"])."'";
       if (unesc($dati["level"]) == unesc($row["level"]))
          $select .= "selected=\"selected\"";
//       $select.=">".$row["level"]."</option>\n";
       $select .= ">".unesc($row["level"])."</option>\n";
       print $select;
   }
   print("</select></td></tr>");
 $r = mysql_query("SELECT log FROM users WHERE id=$dati[id]");
   $lg = mysql_result($r,0,"log");
   ?>
   
   <tr>
   <td align=left class="header"><?php echo "Log"; ?>:</td>
   <td align="left" class="lista"><textarea name="logz" cols="40" rows="5"><?php echo $lg; ?></textarea></td>
   
   
   <?php
}
// Donor
if ($CURUSER['admin_access'] == "yes"){
  print("<tr><td class=\"header\">Donor</td><td class=header align=left><input name=idonor value='yes' type=radio".($dati["donor"] == "yes" ? " checked" : "").">Yes <input name=idonor value='no' type=radio" .($dati["donor"] == "no" ? " checked" : "").">No</td></tr>\n");
}
// End Donor
elseif ($USE_IMAGECODE && $action != "mod")
  {
   if (extension_loaded('gd'))
     {
       $arr = gd_info();
       if ($arr['FreeType Support'] == 1)
        {
         $p = new ocr_captcha();

         print("<tr>\n\t<td align=left class=\"header\">".IMAGE_CODE.":</td>");
         print("\n\t<td align=left class=\"lista\"><input type=text name=private_key value='' maxlength=6 size=6>\n");
         print($p->display_captcha(true));
         $private = $p->generate_private();
         print("</td>\n</tr>");
      }
     }
   }
// -----------------------------
// Captcha hack
// -----------------------------
}

// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
	if ($action == "invite")
	{
		print("<input type=hidden name=hash value=\"$code\">");
		print("<input type=hidden name=inviter value=\"$inviter\">");
	}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )

?>
<tr>
   <td align=center class="header"></td>
<?php
if ($action == "del")
   print("\n<td align=left class=lista><input type=\"submit\" name=\"elimina\" value=\"".FRM_DELETE."\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"submit\" name=\"elimina\" value=\"".FRM_CANCEL."\" /></td>");
else
   print("\n<td align=left class=lista><input type=\"submit\" name=\"conferma\" value=\"".FRM_CONFIRM."\" />&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" name=\"annulla\" value=\"".FRM_CANCEL."\" /></td>");
?>
</tr>
</table>
</form>
</center>
</p>
<?php
}

function aggiungiutente() {

global $SITENAME, $SITEEMAIL, $BASEURL, $VALIDATION, $USERLANG, $USE_IMAGECODE;

$utente = mysql_escape_string($_POST["user"]);
$pwd = mysql_escape_string($_POST["pwd"]);
$pwd1 = mysql_escape_string($_POST["pwd1"]);
$email = mysql_escape_string($_POST["email"]);
$email1 = mysql_escape_string($_POST["email1"]);
$idlangue = intval($_POST["language"]);
$idstyle = intval($_POST["style"]);
$idflag = intval($_POST["flag"]);
$timezone = intval($_POST["timezone"]);

if (strtoupper($utente) == strtoupper("Guest")) {
        print(ERROR." ".ERR_GUEST_EXISTS."<br />\n");
        print("<a href=account.php>".BACK."</a>");
        block_end();
        stdfoot();
        exit;
        }

if ($pwd != $pwd1) {
    print(ERROR." ".DIF_PASSWORDS."<br />\n");
    print("<a href=account.php>".BACK."</a>");
    block_end();
    stdfoot();
    exit;
    }
	
if ($email != $email1) {
	print(ERROR." ".DIF_EMAILS."<br>");
	print("<a href=account.php>".BACK."</a>");
	block_end();
	exit;
	}
	
if ($idflag == 0 || $idflag == 100) {
	print(ERROR." You must specify your country<br />\n");
	print("<a href=account.php>".BACK."</a>");
	block_end();
    stdfoot();
	exit;
}

if ($VALIDATION == "none")
   $idlevel = 3;
else
   $idlevel = 2;
# Create Random number
$floor = 100000;
$ceiling = 999999;
srand((double)microtime()*1000000);
$random = rand($floor, $ceiling);

if ($utente == "" || $pwd == "" || $email == "") {
   return -1;
   exit;
}

$res = mysql_query("SELECT email FROM users WHERE email='$email'");
if (mysql_num_rows($res) > 0)
   {
   return -2;
   exit;
}
// valid email check - by vibes
$regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
                ."@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
                ."\.([a-z]{2,}){1}$";
if(!eregi($regex,$email))
   {
   return -3;
   exit;
}
// valid email check end

// duplicate username
$res = mysql_query("SELECT username FROM users WHERE username='$utente'");
if (mysql_num_rows($res) > 0)
   {
   return -4;
   exit;
}

	// check if EMAIL is banned
	$cheapmail = mysql_real_escape_string($email);
	$mailisbanned = mysql_fetch_object(mysql_query("SELECT inc FROM bannedmail WHERE email LIKE '%$cheapmail%'"));
	if ($mailisbanned)
	{
		err_msg(ERROR,EMAIL_BANNED);
		block_end();
		stdfoot();
		exit;
	}
	// check if EMAIL is banned 

	// check if DOMAIN is banned
	$cheapmail = mysql_real_escape_string(substr(strrchr($email, "@"), 1));
	$cheapmail2 = mysql_real_escape_string("@".remover("@".$cheapmail, "@", ".").".");
	$mailischeap = mysql_fetch_assoc(mysql_query("SELECT domain FROM cheapmail WHERE domain LIKE '%".$cheapmail."%' OR domain ='".$cheapmail2."'"));
	if ($mailischeap)
	{
		err_msg(ERROR,DOMAIN_BANNED);
		block_end();
		stdfoot();
		exit;
	}
	// check if DOMAIN is banned

// duplicate username

if (strpos(mysql_escape_string($utente), " ")==true)
   {
   return -7;
   exit;
}
if ($USE_IMAGECODE)
{
  if (extension_loaded('gd'))
    {
     $arr = gd_info();
     if ($arr['FreeType Support'] == 1)
      {
        $public = $_POST['public_key'];
        $private = $_POST['private_key'];

          $p = new ocr_captcha();

          if ($p->check_captcha($public, $private) != true)
              {
              err_msg(ERROR,ERR_IMAGE_CODE);
              block_end();
              stdfoot();
              exit;
          }
       }
    }
}
$bannedchar = array("\\", "/", ":", "*", "?", "\"", "@", "$", "'", "`", ",", ";", ".", "<", ">", "!", "£", "%", "^", "&", "(", ")", "+", "=", "#", "~");
if (straipos(mysql_escape_string($utente), $bannedchar)==true)
   {
   return -8;
   exit;
}

if(strlen(mysql_real_escape_string($pwd)) < 4)
   {
   return -9;
   exit;
}

    $age = mysql_escape_string($_POST['age']);
	$gen = mysql_escape_string($_POST['gen']);
@mysql_query("INSERT INTO users (username, password, random, id_level, email, style, language, flag, joined, lastconnect, pid, time_offset, age, gender ) VALUES ('$utente', '" . md5($pwd) . "', $random, $idlevel, '$email', $idstyle, $idlangue, $idflag, NOW(), NOW(),'".md5(uniqid(rand(),true))."', '".$timezone."', '$age', '$gen')");
if ($VALIDATION == "user")
   {
   ini_set("sendmail_from","");
   if (mysql_errno() == 0)
     {
      mail($email,ACCOUNT_CONFIRM,ACCOUNT_MSG."\n\n".$BASEURL."/account.php?act=confirm&confirm=$random&language=$idlangue","From: $SITENAME <$SITEEMAIL>");
      write_log("Signup new user $utente ($email)","add");
      }
   else
       DIE(mysql_error());
   }
return mysql_errno();
}
// begin invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
function aggiungiutente_invite()
{
	global $SITENAME, $SITEEMAIL, $BASEURL, $VALIDATION, $USERLANG, $USE_IMAGECODE, $VALID_INV;
	
	$utente = mysql_escape_string($_POST["user"]);
	$pwd = mysql_escape_string($_POST["pwd"]);
	$pwd1 = mysql_escape_string($_POST["pwd1"]);
	$email = mysql_escape_string($_POST["email"]);
	$email1 = mysql_escape_string($_POST["email1"]);
	$idlangue = intval($_POST["language"]);
	$idstyle = intval($_POST["style"]);
	$idflag = intval($_POST["flag"]);
	$timezone = intval($_POST["timezone"]);
	$ip = getip();
	
	// if set to use secure code
	if ($USE_IMAGECODE)
	{
		if (extension_loaded('gd'))
		{
			$arr = gd_info();
			if ($arr['FreeType Support']==1)
			{
				$public = $_POST['public_key'];
				$private = $_POST['private_key'];
				$p = new ocr_captcha();
				
				if ($p->check_captcha($public,$private) != true)
				{
					err_msg(ERROR,ERR_IMAGE_CODE);
					block_end();
					stdfoot();
					exit;
				}
			}
		}
	}
	
	if ($utente == "Guest")
	{
		err_msg(ERROR,ERR_GUEST_EXISTS);
		block_end();
		stdfoot();
		exit;
	}
	
	if ($pwd != $pwd1)
	{
		err_msg(ERROR,DIF_PASSWORDS);
		block_end();
		stdfoot();
		exit;
	}
	
	if ($pwd == $utente)
	{
		err_msg(ERROR,PASSWORD_NOT_USERNAME);
		block_end();
		stdfoot();
		exit;
	}
	
	if ($VALID_INV == true)
		$idlevel = 2;
	else
		$idlevel = 3;

# Create Random number
$floor = 100000;
$ceiling = 999999;
srand((double)microtime()*1000000);
$random = rand($floor, $ceiling);
	
	if ($utente=="" || $pwd=="" || $pwd1=="" || $email=="")
	{
		return -1;
		exit;
	}
	
	$res = mysql_query("SELECT email FROM users WHERE email='$email'");
	if (mysql_num_rows($res) > 0)
	{
		return -2;
		exit;
	}
	
	// valid email check - by vibes
	$regex = "^[_+a-z0-9-]+(\.[_+a-z0-9-]+)*"
					."@[a-z0-9-]+(\.[a-z0-9-]{1,})*"
					."\.([a-z]{2,}){1}$";
	if(!eregi($regex,$email))
	{
		return -3;
		exit;
	}
	// valid email check end

	$resuser = mysql_query("SELECT username FROM users WHERE username='$utente'");
	if (mysql_num_rows($resuser)>0)
	{
		return -4;
		exit;
	}
	
	// check if EMAIL is banned
	$cheapmail = mysql_real_escape_string($email);
	$mailisbanned = mysql_fetch_object(mysql_query("SELECT inc FROM bannedmail WHERE email LIKE '%$cheapmail%'"));
	if ($mailisbanned)
	{
		err_msg(ERROR,EMAIL_BANNED);
		block_end();
		stdfoot();
		exit;
	}
	// check if EMAIL is banned 

	// check if DOMAIN is banned
	$cheapmail = mysql_real_escape_string(substr(strrchr($email, "@"), 1));
	$cheapmail2 = mysql_real_escape_string("@".remover("@".$cheapmail, "@", ".").".");
	$mailischeap = mysql_fetch_assoc(mysql_query("SELECT domain FROM cheapmail WHERE domain LIKE '%".$cheapmail."%' OR domain ='".$cheapmail2."'"));
	if ($mailischeap)
	{
		err_msg(ERROR,DOMAIN_BANNED);
		block_end();
		stdfoot();
		exit;
	}
	// check if DOMAIN is banned
	
	// check if IP is already in use
	$i = (@mysql_fetch_row(@mysql_query("SELECT count(*) FROM users WHERE cip='$ip'"))) or die(mysql_error());
	if ($i[0] != 0)
	{
		err_msg(ERROR,"($ip)<br>".ERR_IP_ALREADY_EXISTS);
		block_end();
		stdfoot();
		exit;
	}
	
	$inviter = 0 + $_POST["inviter"];
	$code = unesc($_POST["hash"]);
	$res = mysql_query("SELECT username FROM users WHERE id = $inviter") or sqlerr(__FILE__, __LINE__);
	$arr = mysql_fetch_assoc($res);
	$invusername = $arr[username];
	$wantpasshash = md5($pwd);
	
    $age = mysql_escape_string($_POST['age']);
	$gen = mysql_escape_string($_POST['gen']);
	@mysql_query("INSERT INTO users (username, password, random, email, style, language, flag, id_level, joined, pid, time_offset, invited_by, age, gender) VALUES (" .implode(",", array_map("sqlesc", array($utente, $wantpasshash, $random, $email, $idstyle, $idlangue, $idflag, $idlevel))) .", NOW(), '".md5(uniqid(rand(),true))."', '".$timezone."', $inviter, '$age', '$gen')");
	
	$id = mysql_insert_id();
	
	write_log("Signup new user $utente ($email) Invited By $invusername","invitation");
	
	$msg = sqlesc("Welcome to $SITENAME, $utente.\nBefore you start downloading, please take a moment to read this:\n\n- FAQ's\n- Rules\n\n" .
				  "This site works with share ratio's. This is your uploaded/downloaded amount. Every user starts with a 1.00 ratio and we expect from you\n" .
				  "that you try to keep it like that. If you violate this too much, you'll recieve a warning. After 3 warnings it's set, and you'll get banned from\n" .
				  "the server. So please try to keep a 0.50-1.00 ratio or higher. Also try to seed your torrent as long as possible, so our great community can enjoy\n" .
				  "the same vid's you enjoy.You can also upload and seed your own torrents.\n" .
				  "For requests we have our own request section. You can request anything you want, but check if noone has requested it before you by using\n" .
				  "the search function. Our forum needs seperate registration, so if you want to be part of our forum community, you have to register for that seperatly.\n\n" .
				  "If you have questions after this short intro, PM one of the staff members or post in the forum.\n\nI wish you a good time on $SITENAME and keep sharing!\n\nThe $SITENAME Staff.");
	
	@mysql_query("INSERT INTO messages (sender, receiver, subject, added, msg, readed) VALUES ('2', $id, 'Welcome', UNIX_TIMESTAMP(), $msg, 'no')") or sqlerr(__FILE__, __LINE__);
	
	if ($VALID_INV == true)
		mail($email, "$SITENAME ".REG_CONFIRM."", INVIT_MSGINFO."$email".INVIT_MSGINFO1." $utente\n".INVIT_MSGINFO2." $pwd\n\n".INVIT_MSGINFO3, "From: $SITENAME <$SITEEMAIL>");
	else
		mail($email, "$SITENAME ".REG_CONFIRM."", INVIT_MSG_AUTOCONFIRM."$email".INVIT_MSG_AUTOCONFIRM1." $utente\n".INVIT_MSG_AUTOCONFIRM2." $pwd\n\n\n".INVIT_MSG_AUTOCONFIRM3, "From: $SITENAME <$SITEEMAIL>");

	mysql_query("DELETE FROM invites WHERE hash = '$code'");
	
	return mysql_errno();
}
// end invites by TheDevil 25/02/2006 ( original code by EnzoF1 )
function modificautente() {

$utente = htmlspecialchars(mysql_escape_string($_POST["user"]));
$oldname = htmlspecialchars(mysql_escape_string($_POST["username"]));
if (trim($utente) == "")
  {
    err_msg(ERROR,INSERT_USERNAME);
    block_end();
    stdfoot();
    exit;
}
elseif (strtoupper($utente) == strtoupper("Guest")) {
        err_msg(ERROR,ERR_GUEST_EXISTS."<br />\n");
        block_end();
        stdfoot();
        exit;
        }

// duplicate username
$res = mysql_query("SELECT username FROM users WHERE username='$utente' AND id<>".intval($_POST["uid"]));
if (mysql_num_rows($res) > 0)
   {
        err_msg(ERROR,ERR_USER_ALREADY_EXISTS."<br />\n");
        block_end();
        stdfoot();
        exit;
}
if (isset ($_POST["pwd"])) $pwd=mysql_escape_string($_POST["pwd"]);
else $pwd = "";
global $CURUSER;
//Old Code
//if ($CURUSER["id_level"] >= $_POST["level"])
//    $level=max(0,$_POST["level"]);
//New Code
// now in $_POST["level"] there is the level name, we need to select the id_level to know if current user
// is allowed to modify the requested user
$rlev = mysql_query("SELECT id,id_level FROM users_level WHERE level='".mysql_escape_string(unesc($_POST["level"]))."'");
$reslev = mysql_fetch_assoc($rlev);
if ($CURUSER["id_level"] >= $reslev["id_level"])
    $level = intval($reslev["id"]);
else
    $level = 0;

$idlangue = intval($_POST["language"]);
$idstyle = intval($_POST["style"]);
$idflag = intval($_POST["flag"]);
$logz = $_POST["logz"];
$age = mysql_escape_string($_POST['age']);
$gen = mysql_escape_string($_POST['gen']);
$timezone = intval($_POST["timezone"]);

if (isset ($_POST["email"])) $email=mysql_escape_string($_POST["email"]);
else $email = "";
$userdonor = $_POST["idonor"];
$set = array();

if ($email != "")
   $set[] = "email='$email'";
if ($level > 0)
   $set[] = "id_level='$level'";
if ($idlangue > 0)
   $set[] = "language=$idlangue";
if ($idstyle > 0)
   $set[] = "style=$idstyle";
if ($pwd != "")
   $set[] = "password='".md5($pwd)."'";
if ($idflag > 0)
   $set[] = "flag=$idflag";
if ($logz != "")
   $set[] = "log='$logz'";
if ($userdonor != "")
  $set[] = "donor='$userdonor'";
if ($age != "")
   $set[] = "age=$age";
if ($gen != "")
   $set[] = "gender=$gen";
if ($timezone >= -12)
   $set[] = "time_offset=$timezone";
// username
$set[] = "username='$utente'";

$updateset = implode(",",$set);

if ($updateset != "")
   @mysql_query("UPDATE users SET $updateset WHERE username='$oldname'");

   write_log("Modified user $utente","modify");
}

block_end();
stdfoot();
?>