<?php

//!miskotes TORRENT REQUEST

require_once("include/functions.php");
require_once("include/config.php");

dbconn();

standardheader("Requests Page");

global $CURUSER;
if (!$CURUSER || $CURUSER["view_torrents"]=="no")
   {
       err_msg(ERROR,NEED_TO_BE_AN_MEMBER);
       stdfoot();
       exit;
   }
else
    {
            print("<script type=\"text/javascript\">
            <!--
            function SetAllCheckBoxes(FormName, FieldName, CheckValue)
            {
            if(!document.forms[FormName])
            return;
            var objCheckBoxes = document.forms[FormName].elements[FieldName];
            if(!objCheckBoxes)
            return;
            var countCheckBoxes = objCheckBoxes.length;
            if(!countCheckBoxes)
            objCheckBoxes.checked = CheckValue;
            else
            // set the check value for all check boxes
            for(var i = 0; i < countCheckBoxes; i++)
            objCheckBoxes[i].checked = CheckValue;
            }
            -->
            </script>
            ");
block_begin("" . REQUESTS . "");
if($REQUESTSON){

       $maxallowed = $max_req_allowed;
       $res3 = mysql_query("SELECT * FROM requests as reqcount WHERE userid=$CURUSER[uid]") or mysql_error();
       $arr3 = mysql_num_rows($res3);
       $numreqs = $arr3;
       $reqrem = $maxallowed-$numreqs;

print("<div align=center>".CF_AVAILABLE_REQUEST."<b>$CURUSER[username]: $maxallowed</b> |".CF_POSTED_REQUESTS."<b>$arr3</b> |".CF_REMAINING."<b>$reqrem</b></div><br>");

print("<div align=right><a href=requests.php>".CF_ADD_NEW_REQUESTS."</a> | <a href=viewrequests.php?requestorid=$CURUSER[uid]>".CF_VIEW_MY_REQUESTS."</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
print("<br><br><a href=". $_SERVER[PHP_SELF] ."?category=" . $_GET[category] . "&sort=" . $_GET[sort] . "&filter=true><b>".CF_HIDE_FILLED_REQUESTS."</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div>");


$categ = $_GET["category"];
$requestorid = $_GET["requestorid"];
$sort = $_GET["sort"];
$search = $_GET["search"];
$filter = $_GET["filter"];

$search = " AND requests.request like '%$search%' ";


if ($sort == "votes")
$sort = " order by hits desc ";
else if ($sort == "request")
$sort = " order by request ";
else
$sort = " order by added desc ";


if ($filter == "true")
$filter = " AND requests.filledby = 0 ";
else
$filter = "";


if ($requestorid <> NULL)
{
if (($categ <> NULL) && ($categ <> 0))
 $categ = "WHERE requests.cat = " . $categ . " AND requests.userid = " . $requestorid;
else
 $categ = "WHERE requests.userid = " . $requestorid;
}

else if ($categ == 0)
$categ = '';
else
$categ = "WHERE requests.cat = " . $categ;

/*
if ($categ == 0)
$categ = 'WHERE requests.cat > 0 ';
else
$categ = "WHERE requests.cat = " . $categ;
*/


$res = mysql_query("SELECT count(requests.id) FROM requests inner join categories on requests.cat = categories.id inner join users on requests.userid = users.id  $categ $filter $search") or die(mysql_error());
$row = mysql_fetch_array($res);
$count = $row[0];

$perpage = 15;

list($pagertop, $pagerbottom, $limit) = pager($perpage, $count, $_SERVER["PHP_SELF"] ."?" . "category=" . $_GET["category"] . "&sort=" . $_GET["sort"] . "&" );

$res = mysql_query("SELECT users.downloaded, users.uploaded, users.username, requests.filled, requests.filledby, requests.id, requests.userid, requests.request, requests.added, requests.hits, categories.image as catimg, categories.id as catid, categories.name as cat FROM requests inner join categories on requests.cat = categories.id inner join users on requests.userid = users.id  $categ $filter $search $sort $limit") or sqlerr();
$num = mysql_num_rows($res);

print("<br><br><CENTER><form method=get action=viewrequests.php>");
print("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=text size=30 name=search>");
print(" <input type=submit align=center value=" . SEARCH . " style='height: 18.5px'>\n");
print("</form></CENTER><br>");

//echo $pagertop;

echo "<Table border=0 width=99% align=center cellspacing=0 cellpadding=0><TR><TD width=49.5% align=left>";

print("<p>" . SORT_BY . " <a href=" . $_SERVER[PHP_SELF] . "?category=" . $_GET[category] . "&filter=" . $_GET[filter] . "&sort=votes>" . VOTES . "</a> - <a href=". $_SERVER[PHP_SELF] ."?category=" . $_GET[category] . "&filter=" . $_GET[filter] . "&sort=request> NAME</a> - <a href=" . $_SERVER[PHP_SELF] ."?category=" . $_GET[category] . "&filter=" . $_GET[filter] . "&sort=added> DATE </a></p>");

print("<form method=get action=viewrequests.php>");
?>
</td><td width=100% align=right>
<select name="category">
<option value="0"><? print("----\n"); ?></option>
<?php

$cats = genrelist();
$catdropdown = "";
foreach ($cats as $cat) {
   $catdropdown .= "<option value=\"" . $cat["id"] . "\"";
   $catdropdown .= ">" . htmlspecialchars($cat["name"]) . "</option>\n";
}

?>
<?= $catdropdown ?>
</select>
<?php
print("<input type=submit align=center value=" . DISPLAY . ">\n");
print("</form></td></tr></table>");
if ($num=="0")
{
 print("<table width=100% align=center cellspacing=1 cellpadding=0><tr><td class=lista align=center><br><br><b>".CF_NO_RESULTS_SEARCH_FOUND."</b><br><br></td></tr></table>\n");
}
else
{
print("<form name=deleteall method=post action=takedelreq.php>");
print("<table width=99% align=center cellspacing=1 class=lista>\n");
print("<tr><td class=header align=center>" . REQUESTS . "</td><td class=header align=center>" . TYPE . "</td><td class=header align=center width=150>" . DATE_ADDED . "</td><td class=header align=center>" . ADDED_BY . "</td><td class=header align=center>" . FILLED . "</td><td class=header align=center>" . FILLED_BY . "</td><td class=header align=center>" . VOTES . "</td>\n");

if (!$CURUSER || $CURUSER["admin_access"]=="yes")
print("<td class=header align=center><input type=\"checkbox\" name=\"all\" onclick=\"SetAllCheckBoxes('deleteall','delreq[]',this.checked)\" /></td></tr>\n");


for ($i = 0; $i < $num; ++$i)
{



 $arr = mysql_fetch_assoc($res);

$privacylevel = $arr["privacy"];

if ($arr["downloaded"] > 0)
   {
     $ratio = number_format($arr["uploaded"] / $arr["downloaded"], 2);
     //$ratio = "<font color=" . get_ratio_color($ratio) . "><b>$ratio</b></font>";
   }
   else if ($arr["uploaded"] > 0)
       $ratio = "Inf.";
   else
       $ratio = "---";


$res2 = mysql_query("SELECT username from users where id=" . $arr[filledby]);
$arr2 = mysql_fetch_assoc($res2);  
if ($arr2[username])
$filledby = $arr2[username];
else
$filledby = " ";     

if (!$CURUSER || $CURUSER["delete_torrents"]=="no"){
if (!$CURUSER || $CURUSER["view_users"]=="yes"){
			$addedby = "<td class=lista align=center><a href=userdetails.php?id=$arr[userid]><b>$arr[username] ( $ratio )</b></a></td>";
		}else{
			$addedby = "<td class=lista align=center><a href=userdetails.php?id=$arr[userid]><b>$arr[username] (----)</b></a></td>";
		}
}else{
		$addedby = "<td class=lista align=center><a href=userdetails.php?id=$arr[userid]><b>$arr[username] ( $ratio )</b></a></td>";
}

$filled = $arr[filled];
if ($filled){
$filled = "<a href=$filled><font color=green><b>".YES."</b></font></a>";
$filledbydata = "<a href=userdetails.php?id=$arr[filledby]><b>$arr2[username]</b></a>";
}
else{
$filled = "<a href=reqdetails.php?id=$arr[id]><font color=red><b>".NO."</b></font></a>";
$filledbydata  = "<i>".CF_NOBODY."</i>";
}

 print("<tr><td class=lista align=left><a href=reqdetails.php?id=$arr[id]><b>$arr[request]</b></a></td>" .
 "<td class=lista align=center>".image_or_link(($arr['catimg']==''?'':'images/categories/'.$arr[catimg]),' title='.$arr[cat].'',$arr['cat'])."</td><td class=lista align=center>" . $arr["added"] . "</td>$addedby<td class=lista align=center>$filled</td><td class=lista>$filledbydata</td><td class=lista align=center><a href=votesview.php?requestid=$arr[id]><b>$arr[hits]</b></a></td>\n");

if (!$CURUSER || $CURUSER["admin_access"]=="yes")
print("<td class=lista align=center><input type=\"checkbox\" name=\"delreq[]\" value=\"" . $arr[id] . "\" /></td></tr>\n");


}

print("</table>\n");

if (!$CURUSER || $CURUSER["admin_access"]=="yes")
print("<table width=99%><td align=right><input type=submit value=".CF_DELETE_THEM."></td></table>");
print("</form>");
}

//echo $pagerbottom;
}else{
echo "" . REQUESTS_OFFLINE . "";
}
   block_end();

//START!!! AutoRemove FulFilled Requests adapted and tested by miskotes, Ripper &  TheDevil
//$request = mysql_query("SELECT id FROM requests WHERE filledby > '0' AND fulfilled < DATE_SUB(NOW(), INTERVAL $delfillreq DAY)");
//$reqrow = mysql_fetch_assoc($request);
//$reqid = $reqrow["id"];
//if (mysql_num_rows($request) > 0)
//{
//mysql_query("DELETE FROM requests WHERE filledby > 0 AND id = $reqid");
//mysql_query("DELETE FROM addedrequests WHERE requestid = $reqid");
//}
//END!!! AutoRemove FulFilled Requests adapted and tested by miskotes, Ripper &  TheDevil

}
stdfoot();
die;

?>
