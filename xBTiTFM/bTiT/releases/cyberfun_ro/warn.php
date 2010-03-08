<?php

// CyBerFuN.Ro source by cybernet2u
// http://cyberfun.ro/

/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();
if (!$CURUSER || $CURUSER["admin_access"] == "no" || $CURUSER["edit_users"] == "no")
   {
	require_once "include/functions.php";
	require_once "include/config.php";
	standardheader("Get a freakin' life and stop trying to hack the tracker !");
	block_begin(ERROR);
	err_msg("Error", "Piss off !!! Staff only !");
	print ("<br>");
	block_end();
	stdfoot(false);
   }
else
   {
standardheader("User Warning System");

      if (isset($_GET["action"])) $action = $_GET["action"];
         else $action = "";

      function warn_expiration($timestamp = 0)
        {
          return gmdate("Y-m-d H:i:s", $timestamp);
        }

//warn users script bellow
	if  ($action == "warn")
	   {
	     if ($HTTP_POST_VARS["reason"] == "" ||$HTTP_POST_VARS["username"] == "" || $HTTP_POST_VARS["warnfor"] == "")
		{
		  err_msg("Error", "Missing form data.");
		}
	     else
		{

		  $reason = $_POST["reason"];
		  $username = $_POST["username"];
		  $added = warn_expiration(mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y")));
		  $warnedfor = $_POST["warnfor"];

			//7 days warning period start
			if ($_POST[warnfor] == 7)
			 {
			   $weekswarn = $_POST[warnfor] / 7;
			   $period = "a 1 week";
			   $expiration  = warn_expiration(mktime(date("H"), date("i"), date("s"), date("m"), date("d")+7, date("Y")));
			 }
			//7 days warning period stop

			//14 days warning period start
			elseif ($_POST[warnfor] == 14)
			 {
			   $weekswarn = $_POST[warnfor] / 7;
			   $period = "a 2 weeks";
			   $expiration = warn_expiration(mktime(date("H"), date("i"), date("s"), date("m"), date("d")+14,  date("Y")));
			 }
			//14 days warning period stop

			//21 days warning period start
			elseif ($_POST[warnfor] == 21)
			 {
			   $weekswarn = $_POST[warnfor] / 7;
			   $period = "a 3 weeks";
			   $expiration  = warn_expiration(mktime(date("H"), date("i"), date("s"), date("m"),  date("d")+21,  date("Y")));
			 }
			//21 days warning period stop

			//28 days warning period start
			elseif ($_POST[warnfor] == 28)
			{
			   $weekswarn = $_POST[warnfor] / 7;
			   $period = "a 4 weeks";
			   $expiration  = warn_expiration(mktime(date("H"), date("i"), date("s"), date("m")+1,  date("d"),  date("Y")));
			}
			//28 days warning period stop

			//Unlimited warning period start
			else
			 {
			   $weekswarn = "0";
			   $period = "an unlimited";
			   $expiration = "0000-00-00 00-00-00";
			 }
			//Unlimited warning period start

		  //Prepare the variables for insertion in the DB
		  $userid = $_GET["id"];
		  $url = $_GET["returnto"];
		  $active = "yes";


		   $sqluserid = sqlesc($_GET["id"]);
		   $sqladded = sqlesc($added);
		   $sqlexpires = sqlesc($expiration);
		   $sqlwarnedfor = sqlesc($weekswarn);
		   $sqlreason = sqlesc($HTTP_POST_VARS["reason"]);
		   $sqladdedby = sqlesc($CURUSER["uid"]);
		   $sqlactive = sqlesc($active);
		   $sqlusername = sqlesc($HTTP_POST_VARS["username"]);

		  $warns = mysql_query("SELECT warns FROM users WHERE id=$sqluserid");
		  $warnings = mysql_fetch_array($warns);
		   $sqlwarns = sqlesc($warnings[warns]+1);


			if (($warnings["warns"]+1) >= $warntimes)
			  {
			     $disable_reason="Maximum number of warnings has been reached!";
			     $auto_reason = sqlesc($disable_reason);

			     //***********execute the queries***********
			     $warnstats = mysql_query("SELECT * FROM warnings WHERE userid=$sqluserid AND active='yes'");
				if (mysql_num_rows($warnstats) >= 1)
				  {
				     //update warnings table
				     mysql_query("UPDATE warnings SET active='no' WHERE userid=$sqluserid AND active='yes'") or sqlerr();
				     //update users table
				     mysql_query("UPDATE users SET warns=warns+1, warnremovedby=$sqladdedby, disabled='yes', disabledby=$sqladdedby, disabledon=$sqladded, disabledreason=".$auto_reason." WHERE id=$sqluserid AND username=$sqlusername") or sqlerr();
				  }
				else
				  {
				     //update users table
				     mysql_query("UPDATE users SET warns=warns+1, disabled='yes', disabledby=$sqladdedby, disabledon=$sqladded, disabledreason=".$auto_reason." WHERE id=$sqluserid AND username=$sqlusername") or sqlerr();
				  }
			     mysql_query("INSERT INTO warnings (userid,warns,added,expires,warnedfor,reason,addedby,active) VALUES ($sqluserid,$sqlwarns,$sqladded,'0000-00-00 00-00-00','0',$sqlreason,$sqladdedby,'no')") or sqlerr();
			  }
			else
			  {
			     $staff = mysql_query("SELECT username FROM users WHERE id=$sqladdedby");
			     $staffname = mysql_fetch_array($staff);
			     $subj = sqlesc("WARNING !!!");
			     $msg = sqlesc("You have received [b]".$period." warning[/b] from [b]".$staffname[username]."[/b] because: [b]".$reason."[/b].");

			     //Executing the queries with the above info
			     mysql_query("UPDATE users SET warns=warns+1 WHERE id=$sqluserid AND username=$sqlusername LIMIT 1") or sqlerr();
			     mysql_query("INSERT INTO warnings (userid,warns,added,expires,warnedfor,reason,addedby,active) VALUES ($sqluserid,$sqlwarns,$sqladded,$sqlexpires,$sqlwarnedfor,$sqlreason,$sqladdedby,$sqlactive)") or sqlerr();
			     mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(00,$sqluserid,UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);
			  }
		  redirect($url);
		}
	   }

//remove warn from users script bellow
	elseif  ($action == "removewarn")
	   {
	     $username = $_GET["username"];
	     $url = $_GET["returnto"];

	      $sqluserid = sqlesc($_GET["id"]);
	      $sqlusername = sqlesc($_GET["username"]);
	      $sqlremover = sqlesc($_GET["remover"]);
	     $subj = sqlesc("WARN Removed !!!");
	     $msg = sqlesc("Your warning has been removed by [b]".$CURUSER['level']." ".$username."[/b].");

	     //for testing purposes - you can delete all commented code bellow
	     //print("userid: ".$userid.", username: ".$username.", remover: ".$remover.", redirect: ".$url."<br><br>");
	     //print("SQLs:");
	     //print("<br>sql1: mysql_query(\"UPDATE warnings SET active='no' WHERE userid=$sqluserid LIMIT 1\") or sqlerr();");
	     //print("<br>sql2: mysql_query(\"UPDATE users SET warnremovedby=$sqlremover WHERE id=$sqluserid AND username=$sqlusername LIMIT 1\") or sqlerr();");
	     //print("<br>sql3: mysql_query(\"INSERT INTO messages (sender, receiver, added, msg, subject) VALUES($sqlremover,$sqluserid,UNIX_TIMESTAMP(),$msg,$subj)\") or sqlerr(__FILE__, __LINE__);");
	     //for testing purposes only - you can delete all commented out code above

	     mysql_query("UPDATE warnings SET active='no' WHERE userid=$sqluserid AND active='yes' LIMIT 1") or sqlerr();
		 mysql_query("UPDATE users SET awarn='no' WHERE id=$sqluserid AND awarn='yes' LIMIT 1") or sqlerr();
	     mysql_query("UPDATE users SET warnremovedby=$sqlremover WHERE id=$sqluserid AND username=$sqlusername LIMIT 1") or sqlerr();
	     mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(0,$sqluserid,UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);
	     redirect($url);
	   }


//remove warn from admincp.php script bellow
	elseif  ($action == "admincpremovewarn")
	   {
	     if (empty($_POST["remwarn"]))
		{
		  $url = "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=warnedu";
		  redirect($url);
		}
	     else
		{
		  //get data for queries
		  $url = "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=warnedu";
		  $userid = implode(", ", $_POST[remwarn]);
		   $sqluserid = sqlesc($userid);
		   $sqlremover = sqlesc($CURUSER[uid]);
		  $subj = sqlesc("WARN Removed !!!");
		  $msg = sqlesc("Your warning has been removed by [b]".$CURUSER['level']." ".$CURUSER[username]."[/b].");


		  //***********execute the queries***********
		  //update warnings table
		  mysql_query("UPDATE warnings SET active='no' WHERE userid IN (".implode(", ", $_POST[remwarn]).")  AND active='yes'") or sqlerr();

		  //update users table
		  mysql_query("UPDATE users SET warnremovedby=$sqlremover WHERE id IN (".implode(", ", $_POST[remwarn]).") ") or sqlerr();

		  //send a private message to every user that got his warn removed
		  $message = mysql_query("SELECT username, id FROM users WHERE id IN (".implode(", ", $_POST[remwarn]).") ") or sqlerr();

		     while ($get_id = mysql_fetch_array($message))
			{
			  $uid = $get_id[id];
			  mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(0,$uid,UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);
			}

		  //redirect back to admincp
		  redirect($url);
		}
	   }


//reset user warn level script bellow
	elseif  ($action == "resetwarnlevel")
	   {
	     //get data for queries
	     $userid = max(0,$_GET[uid]);
	     $url = $_GET[returnto];

	     //subject & body for the private message
	     $subj = sqlesc("Warn Level Reset !!!");
	     $msg = sqlesc("Your Warning Level has been reset by [b]".$CURUSER['level']." ".$CURUSER[username]."[/b].");


	     //***********execute the queries***********
	     //update warnings table
	     mysql_query("DELETE FROM warnings WHERE userid='$userid'") or sqlerr();

	     //update users table
	     mysql_query("UPDATE users SET warns='0', warnremovedby='0' WHERE id='$userid' ") or sqlerr();

	     //send a private message to every user that got his warn removed
	     $message = mysql_query("SELECT username, id FROM users WHERE id='$userid' ") or sqlerr();
	     $get_id = mysql_fetch_array($message);
	     $uid = $get_id[id];
	     mysql_query("INSERT INTO messages (sender, receiver, added, msg, subject) VALUES(0,$uid,UNIX_TIMESTAMP(),$msg,$subj)") or sqlerr(__FILE__, __LINE__);

	     //redirect back to admincp
	     redirect($url);
	   }


//disable account script bellow
	elseif  ($action == "disable")
	   {
	     //get data for queries
	     $disabled = $_POST[disable];
	     $reason = mysql_escape_string($_POST[reason]);
	     $username = mysql_escape_string($_POST[name]);
	     $userid = max(0,$_POST[id]);
	     $url = $_GET[returnto];
	     $datetime = gmdate("Y-m-d H:i:s");

	     if (!$reason)
		{
		  redirect($url);
		}
	     else
		{
		  if ("$disabled" == "no")
		     {
			redirect($url);
		     }
		  else
		     {
			//***********execute the queries***********
			$warnstats = mysql_query("SELECT * FROM warnings WHERE userid='$userid' AND active='yes'");
			   if (mysql_num_rows($warnstats) >= 1)
			      {
				//update warnings table
				mysql_query("UPDATE warnings SET active='no' WHERE userid='$userid' AND active='yes'") or sqlerr();
				//update users table
				mysql_query("UPDATE users SET warnremovedby='".$CURUSER[uid]."', disabled='yes', disabledby='".$CURUSER[uid]."', disabledon='$datetime', disabledreason='$reason' WHERE id='$userid' AND username='$username'") or sqlerr();
			      }
			   else
			      {
				//update users table
				mysql_query("UPDATE users SET disabled='yes', disabledby='".$CURUSER[uid]."', disabledon='$datetime', disabledreason='$reason' WHERE id='$userid' AND username='$username'") or sqlerr();
			      }
			//redirect back to userdetails
			redirect($url);
		     }
		}
	   }


//delete disabled accounts from admincp.php script bellow
	elseif  ($action == "admincpremovedisabled")
	   {

	     if (empty($_POST["remdisabled"]))
		{
		  $url = "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=disabledu";
		  redirect($url);
		}
	     else
		{
		  //get data for queries
		  $url = "admincp.php?user=".$CURUSER["uid"]."&code=".$CURUSER["random"]."&do=disabledu";

		  //***********execute the queries***********
		  //update users table
		  mysql_query("DELETE FROM users WHERE id IN (".implode(", ", $_POST[remdisabled]).") AND disabled='yes'");
		  mysql_query("DELETE FROM warnings WHERE userid IN (".implode(", ", $_POST[remdisabled]).")");

		  //redirect back to admincp
		  redirect($url);
		}
	   }


//enable account script bellow
	elseif  ($action == "enable")
	   {
	     //get data for queries
	     $disabled = $_POST[disable];
	     $username = mysql_escape_string($_POST[name]);
	     $userid = max(0,$_POST[id]);
	     $url = $_GET[returnto];

	     if ("$disabled" == "yes")
		{
		  redirect($url);
		}
	     else
		{
		  //***********execute the queries***********
		  //update users table
		  mysql_query("UPDATE users SET warnremovedby='0', disabled='no', disabledby='0', disabledon='0000-00-00 00:00:00', disabledreason=NULL WHERE id='$userid' AND username='$username'") or sqlerr();

		  //redirect back to userdetails
		  redirect($url);
		}
	   }
   }
?>
