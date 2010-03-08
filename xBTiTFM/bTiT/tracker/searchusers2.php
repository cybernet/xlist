<? 
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5.X Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
Fixed access so it fit owner, admin, mod. 03-08-07 by fatepower
********/
require_once("include/functions.php");
require_once("include/config.php");


dbconn();
global $CURUSER, $STYLEPATH;

standardheader('User Search');

if (!$CURUSER || $CURUSER['mod_access']!='yes') {
       err_msg(ERROR,NOT_ADMIN_CP_ACCESS);
       stdfoot();
       exit;
   }
print("<script type=\"text/javascript\">
	<!--
	function SetAllCheckBoxes(FormName, FieldName, CheckValue) {
		if(!document.forms[FormName])
			return;
		var objCheckBoxes = document.forms[FormName].elements[FieldName];
		if(!objCheckBoxes)
			return;
		var countCheckBoxes = objCheckBoxes.length;
		if(!countCheckBoxes)
			objCheckBoxes.checked = CheckValue;
		else
			for(var i = 0; i < countCheckBoxes; i++)
				objCheckBoxes[i].checked = CheckValue;
	}
    --></script>");
	block_begin("Search Users");
echo"<br /><center><font size=\"2\" color=\"red\" style=\"font-weight: bold;\"> v. 0.8</font>";

if ($_GET['h']) {	
	echo "<p align=\"center\">(<a href='".$_SERVER["PHP_SELF"]."'>Reset</a>)</p>\n";
	echo "<table width=\"95%\" border=\"0\" align=\"center\"><tr><td><div align=\"left\">\n
	Fields left blank will be ignored<br />\n
	Wildcard * may be used in Name and Email, as well as multiple values\n
	separated by spaces (e.g. 'wyz* Max*' in Name will list both users named\n
	'wyz' and those whose names start by 'Max'.<br />\n
	The subnet mask may be entered either in dotted decimal or CIDR notation\n
	(e.g. 255.255.255.0 is the same as /24).<br />\n
    Uploaded and Downloaded should be entered in GB.<br />\n
	Data should be entered in this format: yyyy-mm-dd. <br />\n
	For search parameters with multiple text fields the second will be\n
	ignored unless relevant for the type of search chosen. <br />\n
	</div></td></tr></table><br />\n";
	}
	else {
		echo "<p align=\"center\">(<a href='".$_SERVER["PHP_SELF"]."?h=1'>Instructions</a>)";
		echo "&nbsp;-&nbsp;(<a href='".$_SERVER["PHP_SELF"]."'>Reset</a>)</p>\n";
	} 
	$highlight = " bgcolor=\"#BBAF9B\"";

$DEBUG_MODE = 1;
?>
<form method="get" action="<?=$_SERVER["PHP_SELF"]?>">
<table border="1" cellspacing="0" cellpadding="5">
	<tr>
		<td valign="middle">Name:</td>
		<td<?=$_GET['n']?$highlight:""?>><input name="n" type="text" value="<?=$_GET['n']?>" size="35"></td>
		<td valign="middle">Ratio:</td>
		<td<?=$_GET['rt']?$highlight:""?>>
			<select name="rt">
	<?
		$options = array("equal","above","below","between");
		for ($i = 0; $i < count($options); $i++){
		echo "<option value=\"$i\" ".(($_GET['rt']=="$i")?"selected":"").">".$options[$i]."</option>\n";
		}
	?>
			</select>
			<input name="r" type="text" value="<?=$_GET['r']?>" size="5" maxlength="4">
			<input name="r2" type="text" value="<?=$_GET['r2']?>" size="5" maxlength="4"></td>
	</tr>
	<tr>
		<td valign="middle">Email:</td>
		<td<?=$_GET['em']?$highlight:""?>><input name="em" type="text" value="<?=$_GET['em']?>" size="35"></td>
		<td valign="middle">IP:</td>
		<td<?=$_GET['ip']?$highlight:""?>><input name="ip" type="text" value="<?=$_GET['ip']?>" maxlength="17"></td>
	</tr>
	<tr>
		<td valign="middle">Class:</td>
		<td<?=$_GET['c']?$highlight:""?>>
			<select name="c">
	<?	
		print("<option value=0".($level==0 ? " selected=selected " : "").">".ALL."</option>");
		$res=mysql_query("SELECT id,level FROM users_level WHERE id_level>1 ORDER BY id_level");
		while($row=mysql_fetch_array($res)) {
			$select="<option value='".$row["id"]."'";
            if ($level==$row["id"])
				$select.="selected=\"selected\"";
				$select.=">".$row["level"]."</option>\n";
			print $select;
		}               
	?>
			</select>
		</td>
		<td valign="middle">Mask:</td>
		<td<?=$_GET['ma']?$highlight:""?>><input name="ma" type="text" value="<?=$_GET['ma']?>" maxlength="17"></td>
	</tr>
	<tr>
		<td valign="middle">Joined:</td>
		<td<?=$_GET['dt']?$highlight:""?>>
			<select name="dt">
	<?
		$options = array("on","before","after","between");
		for ($i = 0; $i < count($options); $i++){
			echo "<option value=\"$i\" ".(($_GET['dt']=="$i")?"selected":"").">".$options[$i]."</option>\n";
		}
	?>
			</select>
		<input name="d" type="text" value="<?=$_GET['d']?>" size="10" maxlength="10">
		<input name="d2" type="text" value="<?=$_GET['d2']?>" size="10" maxlength="10"></td>
		<td valign="middle">Uploaded:</td>
		<td<?=$_GET['ult']?$highlight:""?>><select name="ult" id="ult">
	<?
		$options = array("equal","above","below","between");
		for ($i = 0; $i < count($options); $i++){
			echo "<option value=$i ".(($_GET['ult']=="$i")?"selected":"").">".$options[$i]."</option>\n";
			}
  ?>
			</select>
		<input name="ul" type="text" id="ul" size="7" maxlength="7" value="<?=$_GET['ul']?>">
		<input name="ul2" type="text" id="ul2" size="7" maxlength="7" value="<?=$_GET['ul2']?>"></td>
	</tr>
	<tr>
		<td valign="middle">Last seen:</td>
		<td<?=$_GET['lst']?$highlight:""?>><select name="lst">
	<?
		$options = array("on","before","after","between");
		for ($i = 0; $i < count($options); $i++){
			echo "<option value=\"$i\" ".(($_GET['lst']=="$i")?"selected":"").">".$options[$i]."</option>\n";
			}
  ?>
			</select>
		<input name="ls" type="text" value="<?=$_GET['ls']?>" size="10" maxlength="10">
		<input name="ls2" type="text" value="<?=$_GET['ls2']?>" size="10" maxlength="10"></td>
	<td valign="middle" class="rowhead">Downloaded:</td>
	<td<?=$_GET['dlt']?$highlight:""?>><select name="dlt" id="dlt">
	<?
		$options = array("equal","above","below","between");
		for ($i = 0; $i < count($options); $i++){
			echo "<option value=\"$i\" ".(($_GET['dlt']=="$i")?"selected":"").">".$options[$i]."</option>\n";
			}
	?>
			</select>
		<input name="dl" type="text" id="dl" size="7" maxlength="7" value="<?=$_GET['dl']?>">
		<input name="dl2" type="text" id="dl2" size="7" maxlength="7" value="<?=$_GET['dl2']?>"></td>
	</tr>
	<tr>
	<? if ($CURUSER["admin_access"]=="yes") { ?>
		<td valign="middle" class="rowhead">Show query:</td>
		<td<?=$_GET['debug']?$highlight:""?>><input name="debug" type="checkbox" value="1" <?=($_GET['debug'])?"checked":"" ?>></td>
	<?
		}
	?>
		<td colspan="6" align="center"><input name="action" type="submit" value="search"></td>
	</tr>
</table><br /></form>
<?
if (count($_GET) > 0 && !$_GET['h']) {

// Name
// checks for the usual wildcards *, ? plus mySQL ones
	$names = explode(' ',trim($_GET['n']));
	if ($names[0] !== "") {
		foreach($names as $name)	{
			$names_inc[] = $name;
			}
if (is_array($names_inc)) {
	$where_is .= isset($where_is)?"AND ":" ";
	foreach($names_inc as $name) {
		if (strpos($name,'*') === False && strpos($name,'?') === False && strpos($name,'%') === False && strpos($name,'_') === False)
			$name_is .= isset($name_is)?" OR ":" " ."users.username = '".mysql_escape_string($name)."'";
		else {
			$name = str_replace(array('?','*'), array('_','%'), $name);
			$name_is .= (isset($name_is)?" OR ":" ")."users.username LIKE '".mysql_escape_string($name)."'";
			}
		}
$where_is .= $name_is." ";
	}
  $q .= ($q ? "&amp;" : "") . "n=".urlencode(trim($_GET['n']));
}

// Search by email
// function checks for valid email
function validemail($email) {
	return preg_match('/^[\w.-]+@([\w.-]+\.)+[a-z]{2,6}$/is', $email);
	}

$emaila = explode(' ', trim($_GET['em']));
if ($emaila[0] !== "") {
	$where_is .= isset($where_is)?" AND ":" ";
	foreach($emaila as $email) {
		if (strpos($email,'*') === False && strpos($email,'?') === False && strpos($email,'%') === False) {
			if (validemail($email) !== 1) {
				err_msg(ERROR, "Bad email.");
				block_end();
				stdfoot();
				die();
				}
				$email_is .= (isset($email_is)?" OR ":"")."users.email ='".mysql_real_escape_string($email)."'";
			}
			else {
				$sql_email = str_replace(array('?','*'), array('_','%'), $email);
				$email_is .= (isset($email_is)?" OR ":"")."users.email LIKE '".mysql_real_escape_string($sql_email)."'";
				}
		}
$where_is .= $email_is."";
 $q .= ($q ? "&amp;" : "") . "em=".urlencode(trim($_GET['em']));
 }

// IP
$ip = trim($_GET['ip']);
if ($ip) {
	$regex = "/^(((1?\d{1,2})|(2[0-4]\d)|(25[0-5]))(\.\b|$)){4}$/";
	if (!preg_match($regex, $ip)) {
		err_msg(ERROR, "Bad IP.");
		block_end();
		stdfoot();
		die();
		}

$mask = trim($_GET['ma']);
if ($mask == "" || $mask == "255.255.255.255")
	$where_is .= (isset($where_is)?" AND ":" ")."users.lip = '".ip2long($ip)."'";
	else {
		if (substr($mask,0,1) == "/") {
			$n = substr($mask, 1, strlen($mask) - 1);
			if (!is_numeric($n) or $n < 0 or $n > 32) {
				err_msg(ERROR, "Bad subnet mask.");
				block_end();
				stdfoot();
				die();
				}
				else
					$mask = long2ip(pow(2,32) - pow(2,32-$n));
			}
	elseif (!preg_match($regex, $mask)) {
		err_msg(ERROR, "Bad subnet mask.");
		block_end();
		stdfoot();
		die();
		}
	$where_is .= (isset($where_is)?" AND ":" ")."users.lip & INET_ATON('$mask') = '".ip2long($ip)."' & INET_ATON('$mask')";
	$q .= ($q ? "&amp;" : "") . "ma=$mask";
  }
$q .= ($q ? "&amp;" : "") . "lip=$ip";
}

// Search by class
$class = $_GET['c'];
if ($class>0) {
	$where_is .= (isset($where_is)?" AND ":"")."users.id_level=$class";
	$q .= ($q ? "&amp;" : "") . "c=". $class;
	}
elseif ($class==0) {
	$where_is .= (isset($where_is)?" AND ":"")."users.id_level>1";
	$q .= ($q ? "&amp;" : "") . "c=". $class;
	}

// Date joined
// Validates date in the form [yy]yy-mm-dd;
// Returns date if valid, 0 otherwise.
function mkdate($date){
	if (strpos($date,'-'))
		$a = explode('-', $date);
	elseif (strpos($date,'/'))
		$a = explode('/', $date);
	else
		return 0;
for ($i=0;$i<3;$i++)
	if (!is_numeric($a[$i]))
	return 0;
if (checkdate($a[1], $a[2], $a[0]))
	return date ("Y-m-d", mktime (0,0,0,$a[1],$a[2],$a[0]));
else
	return 0;
}

$date = trim($_GET['d']);
if ($date) {
	if (!$date = mkdate($date)) {
		err_msg(ERROR, "Invalid date.");
		block_end();
		stdfoot();
		die();
		}
$q .= ($q ? "&amp;" : "") . "d=$date";
$datetype = $_GET['dt'];
$q .= ($q ? "&amp;" : "") . "dt=$datetype";
if ($datetype == "0")
	$where_is .= (isset($where_is)?" AND ":"")."(UNIX_TIMESTAMP(joined) - UNIX_TIMESTAMP('$date')) BETWEEN 0 and 86400";
	else {
		$where_is .= (isset($where_is)?" AND ":"")."users.joined ";
		if ($datetype == "3") {
			$date2 = mkdate(trim($_GET['d2']));
			if ($date2) {
				if (!$date = mkdate($date)) {
					err_msg(ERROR, "Invalid date.");
					block_end();
					stdfoot();
					die();
					}
					$q .= ($q ? "&amp;" : "") . "d2=$date2";
					$where_is .= " BETWEEN '$date' AND '$date2'";
				}
				else {
					err_msg(ERROR, "Two dates needed for this type of search.");
					block_end();
					stdfoot();
					die();
					}
			}
	elseif ($datetype == "1")
		$where_is .= "< '$date'";
	elseif ($datetype == "2")
		$where_is .= "> '$date'";
		}
}

// date last seen
$last = trim($_GET['ls']);
if ($last) {
	if (!$last = mkdate($last)) {
		err_msg(ERROR, "Invalid date.");
		block_end();
		stdfoot();
		die();
		}
$q .= ($q ? "&amp;" : "") . "ls=$last";
$lasttype = $_GET['lst'];
$q .= ($q ? "&amp;" : "") . "lst=$lasttype";
if ($lasttype == "0")
	$where_is .= (isset($where_is)?" AND ":"")."(UNIX_TIMESTAMP(lastconnect) - UNIX_TIMESTAMP('$last')) BETWEEN 0 and 86400";
	else {
		$where_is .= (isset($where_is)?" AND ":"")."users.lastconnect ";
		if ($lasttype == "3") {
			$last2 = mkdate(trim($_GET['ls2']));
			if ($last2) {
				$where_is .= " BETWEEN '$last' and '$last2'";
				$q .= ($q ? "&amp;" : "") . "ls2=$last2";
				}
				else {
					err_msg(ERROR, "The second date is not valid.");

					block_end();
					stdfoot();
					die();
					}
			}
	elseif ($lasttype == "1")
		$where_is .= "< '$last'";
	elseif ($lasttype == "2")
		$where_is .= "> '$last'";
	}
}

// uploaded
$unit = 1073741824;		// 1GB
$ul = trim($_GET['ul']);
if ($ul) {
	if (!is_numeric($ul) || $ul < 0) {
		err_msg(ERROR, "Bad uploaded amount.");
		block_end(); 
		stdfoot();
		die();
		}
$where_is .= isset($where_is)?" AND ":"";
$where_is .= "users.uploaded ";
$ultype = $_GET['ult'];
$q .= ($q ? "&amp;" : "") . "ult=$ultype";
if ($ultype == "3") {
	$ul2 = trim($_GET['ul2']);
	if(!$ul2) {
		err_msg(ERROR, "Two uploaded amounts needed for this type of search.");
		block_end();
		stdfoot();
		die();
		}
		if (!is_numeric($ul2) or $ul2 < $ul) {
			err_msg("Error", "Bad second uploaded amount.");
			block_end();
			stdfoot();
			die();
			}
$where_is .= " BETWEEN ".$ul*$unit." AND ".$ul2*$unit;
$q .= ($q ? "&amp;" : "") . "ul2=$ul2";
	}
	elseif ($ultype == "2")
		$where_is .= " < ".$ul*$unit;
	elseif ($ultype == "1")
		$where_is .= " >". $ul*$unit;
	else
		$where_is .= " BETWEEN ".($ul - 0.004)*$unit." AND ".($ul + 0.004)*$unit;
	$q .= ($q ? "&amp;" : "") . "ul=$ul";
}

// Downloaded
$dl = trim($_GET['dl']);
if ($dl) {
	if (!is_numeric($dl) || $dl < 0) {
		err_msg(ERROR, "Bad downloaded amount.");
		block_end();
		stdfoot();
		die();
		}
$where_is .= isset($where_is)?" AND ":"";
$where_is .= "users.downloaded ";
$dltype = $_GET['dlt'];
$q .= ($q ? "&amp;" : "") . "dlt=$dltype";
if ($dltype == "3") {
	$dl2 = trim($_GET['dl2']);
	if(!$dl2) {
		err_msg(ERROR, "Two downloaded amounts needed for this type of search.");
		block_end();
		stdfoot();
		die();
		}
		if (!is_numeric($dl2) or $dl2 < $dl) {
			err_msg(ERROR, "Bad second downloaded amount.");
			block_end();
			stdfoot();
			die();
			}
$where_is .= " BETWEEN ".$dl*$unit." AND ".$dl2*$unit;
$q .= ($q ? "&amp;" : "") . "dl2=$dl2";
}
	elseif ($dltype == "2")
		$where_is .= " < ".$dl*$unit;
	elseif ($dltype == "1")
		$where_is .= " > ".$dl*$unit;
	else
		$where_is .= " BETWEEN ".($dl - 0.004)*$unit." AND ".($dl + 0.004)*$unit;
	$q .= ($q ? "&amp;" : "") . "dl=$dl";
}

// Ratio
$ratio = trim($_GET['r']);
if ($ratio) {
	if ($ratio == '---') {
		$ratio2 = "";
		$where_is .= isset($where_is)?" AND ":"";
		$where_is .= " users.uploaded = 0 and users.downloaded = 0";
		}
		elseif (strtolower(substr($ratio,0,3)) == 'inf') {
			$ratio2 = "";
			$where_is .= isset($where_is)?" AND ":"";
			$where_is .= " users.uploaded > 0 and users.downloaded = 0";
			}
		else{
			if (!is_numeric($ratio) || $ratio < 0) {
				err_msg(ERROR, "Bad ratio.");
				block_end();
				stdfoot();
				die();
				}
$where_is .= isset($where_is)?" AND ":"";
$where_is .= "(users.uploaded/users.downloaded)";
$ratiotype = $_GET['rt'];
$q .= ($q ? "&amp;" : "") . "rt=$ratiotype";
if ($ratiotype == "3") {
	$ratio2 = trim($_GET['r2']);
	if(!$ratio2) {
		err_msg(ERROR, "Two ratios needed for this type of search.");
		block_end();
		stdfoot();
		die();
		}
		if (!is_numeric($ratio2) or $ratio2 < $ratio) {
			err_msg(ERROR, "Bad second ratio.");
			block_end();
			stdfoot();
			die();
			}
$where_is .= " BETWEEN $ratio and $ratio2";
$q .= ($q ? "&amp;" : "") . "r2=$ratio2";
	}
	elseif ($ratiotype == "2")
		$where_is .= " < $ratio";
	elseif ($ratiotype == "1")
		$where_is .= " > $ratio";
	else
		$where_is .= " BETWEEN ($ratio - 0.004) and ($ratio + 0.004)";
	}
	$q .= ($q ? "&amp;" : "") . "r=$ratio";
}

// Pager
$distinct = isset($distinct)?$distinct:"";
$queryc = "SELECT COUNT(".$distinct."users.id) FROM users". (($where_is == "")?"":" WHERE $where_is ");
$res = mysql_query($queryc) or sqlerr(__FILE__, __LINE__, 'searchusers2.php - $query');
$arr = mysql_fetch_row($res);
$count = $arr[0];
$q = isset($q)?($q."&amp;"):"";
$perpage = 30;
list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"]."?".$q);
$query .= $limit;

$scriptname = $_SERVER["PHP_SELF"];
$link = $_SERVER['QUERY_STRING'];
if ($link=="")
	$link="searchusers2.php";
?>
<table width="100%" cellpadding="2" cellspacing="2" border="0">
	<form method="post" action="<? echo $scriptname."?$link"; ?>" border="0" name="checkall">
	<tr>
		<td style="vertical-align: top;"><b><input name="fmsg" type="checkbox" value="evet" />MESSAGE<br /><input name="fmail" type="checkbox" value="send" CHECKED />EMAIL</b></td>
		<td><input name="sbj" type="text" value="Write subject here" size="40" maxlength="40" />
				<textarea name="msg" cols="42" rows="4">Write Your PM Here!</textarea>
		</td>
	</tr>
	<tr>
<?
if ($CURUSER["admin_access"]=="yes")
{
?>
		<td style="white-space: nowrap;"><input name="nlev" type="checkbox" value="evet" /><b>Change User Group : </b></td>
		<td>
	<?
         print("<select name=\"updlevel\">");
	     $aa = $CURUSER["id_level"] -1;
         $res=mysql_query("SELECT id,level FROM users_level WHERE id_level<=".$aa." AND id_level > 1 ORDER BY id_level");
         while($row=mysql_fetch_array($res)) {
             $select="<option value='".$row["id"]."'";
             if ($kullan1==$row["id"])
                $select.="selected=\"selected\"";
             $select.=">".$row["level"]."</option>\n";
             print $select;
         }
         print("</select>");
}
	?>
		</td>
	<? if ($CURUSER["delete_users"]=="yes") { ?>
		<td style="white-space: nowrap;"><b><input name="delu" type="checkbox" value="delet" />Delete user(s)</b></td>
	<? } ?>
		<td><input type="submit" name="changeug" value="Go"></td>
	</tr>
</table>
<? // Print pages
if ($count > $perpage)
	echo $pagertop;
?>
<table class=lista width=100%>
	<tr>
		<td class=header align=center><?echo USER_NAME ;?></td>
		<td class=header align=center><?echo USER_LEVEL; ?></td>
		<td class=header align=center><?echo USER_JOINED;?></td>
		<td class=header align=center><?echo USER_LASTACCESS;?></td>
		<td class=header align=center><?echo PEER_COUNTRY;?></td>
		<td class=header align=center><?echo RATIO;?></td>
		<td class=header align=center><?echo PM;?></td>
<?
if ($CURUSER["edit_users"]=="yes")
{
?>
		<td class=header align=center><?echo EDIT; ?></td>
<?
}
?>
<?
if ($CURUSER["delete_users"]=="yes")
{
?>
		<td class=header align=center><?echo DELETE; ?></td>
<? 
}
?>
		<td class=header align=center>	<input type="checkbox" name="all" onclick="SetAllCheckBoxes('checkall','othuid[]',this.checked)" /></td>
	<?
		$query="SELECT prefixcolor, suffixcolor, users.id, downloaded, uploaded, IF (downloaded>0, uploaded/downloaded, 0) AS ratio,  username, level, UNIX_TIMESTAMP(joined) AS joined, UNIX_TIMESTAMP(lastconnect) AS lastconnect, flag, flagpic, name FROM users INNER JOIN users_level ON users.id_level = users_level.id LEFT JOIN countries ON users.flag = countries.id WHERE $where_is ";
		$query .= $limit;
	$rusers=mysql_query($query) or sqlerr(__FILE__, __LINE__, 'searchusers2.php - $query');
	if (mysql_num_rows($rusers)==0)
		print("<tr><td class=lista colspan=6>".NO_USERS_FOUND."</td></tr>");
	else {
		while ($row_user=mysql_fetch_array($rusers)) {
			print("<tr>\n");
			print("<td class=lista><a href=userdetails.php?id=".$row_user["id"].">".unesc($row_user["prefixcolor"]).unesc($row_user["username"]).unesc($row_user["suffixcolor"])."</a></td>");
			print("<td class=lista align=center>".$row_user["level"]."</td>");
			print("<td class=lista align=center>".($row_user["joined"]==0 ? NOT_AVAILABLE : date("d/m/Y H:i:s",$row_user["joined"]))."</td>");
			print("<td class=lista align=center>".($row_user["lastconnect"]==0 ? NOT_AVAILABLE : date("d/m/Y H:i:s",$row_user["lastconnect"]))."</td>");
			print("<td class=lista align=center>". ( $row_user["flag"] == 0 ? "<img src='images/flag/unknown.gif' alt='".UNKNOWN."' title='".UNKNOWN."' />" : "<img src='images/flag/" . $row_user['flagpic'] . "' alt='" . $row_user['name'] . "' title='" . $row_user['name'] . "' />")."</td>");
			if (max(0,$row_user["downloaded"])>0)
				$ratio=number_format($row_user["uploaded"]/$row_user["downloaded"],2);
			else 
				$ratio="oo";
			print("<td class=lista align=center>$ratio</td>");
			print("<td class=lista align=center><a href=usercp.php?do=pm&action=edit&uid=$CURUSER[uid]&what=new&to=".urlencode(unesc($row_user["username"])).">".image_or_link("$STYLEPATH/pm.png","","PM")."</a></td>");
if ($CURUSER["edit_users"]=="yes")
{
			print("<td class=lista align=center><a href=account.php?act=mod&uid=".$row_user["id"]."&returnto=".urlencode("searchusers2.php?".$_SERVER['QUERY_STRING']).">".image_or_link("$STYLEPATH/edit.png","",EDIT)."</a></td>");
}
if ($CURUSER["delete_users"]=="yes")
{
			print("<td class=lista align=center><a  onclick=\"return confirm('".addslashes(DELETE_CONFIRM)."')\" href=account.php?act=del&uid=".$row_user["id"]."&returnto=".urlencode("searchusers2.php").">".image_or_link("$STYLEPATH/delete.png","",DELETE)."</a></td>");
}
			print("<td class=lista align=center><input type=\"checkbox\" name=\"othuid[]\" value=\"".$row_user["id"]."\" /></td>");
			print("</tr>\n");
			}
		}
print("</table>\n</div></form>\n");
}
block_end();

// active
$debug = $_GET['debug'];
if ($debug == "1") {
block_begin("Show query");
print("<br /><font size=\"2\" align=\"left\" color=\"red\" style=\"font-weight: bold;\">$query</font><br /><br />");
block_end();
}

stdfoot();

$message = (isset($_POST["msg"])?$_POST["msg"]:"sa");
$subject = (isset($_POST["sbj"])?$_POST["sbj"]:"sa");
$fmessage = (isset($_POST["fmsg"])?$_POST["fmsg"]:"sa");
$newlevel = (isset($_POST["updlevel"])?$_POST["updlevel"]:0);
$changeug=(isset($_POST["changeug"])?$_POST["changeug"]:"sa");
$gonewlevel=(isset($_POST["nlev"])?$_POST["nlev"]:"sa");
$delete = (isset($_POST["delu"])?$_POST["delu"]:"sa");
$mail = (isset($_POST["fmail"])?$_POST["fmail"]:"sa");

if ($changeug=="Go") {
	if ($gonewlevel=="evet") {
		foreach($_POST["othuid"] as $otheruid=>$rcv) {
			mysql_query("UPDATE users SET id_level='".$newlevel."' WHERE id='".$rcv."'");
			}
	}
	if ($fmessage=="evet") {
		$curusid = $CURUSER["uid"];
		foreach($_POST["othuid"] as $otheruid=>$rcv) {
			mysql_query("INSERT INTO messages (sender, receiver, added, subject, msg) VALUES ('".$CURUSER["uid"]."','".$rcv."',UNIX_TIMESTAMP(),'".$subject."','".$message."')");
		if($mail=="send") {
			global $BASEURL, $SITENAME, $SITEEMAIL;
			$res1 = mysql_query("SELECT email FROM users WHERE id = $rcv") or sqlerr();
			$arr = mysql_fetch_assoc($res1);
			$email = $arr["email"];
			$sender = $CURUSER['username'];
			$txt = $message;
			nl2br(htmlentities($txt));

$body = <<<EOD
You have received a new personal message from $sender.

Subject: $subject

$txt


You can use the URL below to reply (login may be required).

$BASEURL/usercp.php?uid=$rcv&do=pm&action=list&what=inbox
------------------------------------------------
$SITENAME
EOD;


   ini_set("sendmail_from","");
      if (!mail($email, "New Personal Message From - $sender", $body, "From: $SITENAME <$SITEEMAIL>"))
    stderr("Error", "Your personal message has been sent\n" .
           "However, there was a problem delivering the e-mail notifcation.\n" .
           "Please let an administrator know about this error!\n");
				}

			}
		}
	if ($delete=="delet") {
		foreach($_POST["othuid"] as $otheruid=>$rcv) {
			if ($CURUSER["delete_users"]=="yes") {
			mysql_query("DELETE FROM users WHERE id='".$rcv."' AND id_level < ".$CURUSER["id_level"]." ");
			}
		}
	}
}
?>