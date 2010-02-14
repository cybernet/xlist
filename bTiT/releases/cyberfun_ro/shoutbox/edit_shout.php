<?
if(!defined("VAR_SHOUT"))
die("No direct access!");
else{
//are we deleting a shout?
if(isset($_POST['hidden'])){
//Set message
    $message=$_POST['message'];
       if($CURUSER['uid'] >= 2){
          $query = "SELECT * FROM shoutbox WHERE msgid=$id" ;
          $result = mysql_query($query);
          $edit=mysql_fetch_array($result);
             if($edit['msgid'] > 1){
               if($message != ""){
                  //Allow Admin to over rule limit setting
                 if(strlen($message) <= $SBX['shout_limit'] || $CURUSER['admin_access'] == "yes"){
                   if ($CURUSER['uid'] == $edit["userid"] || $CURUSER['edit_forum'] == "yes"){
                        mysql_query("UPDATE shoutbox SET message='".addslashes($message)."' WHERE msgid=$id");
                           redirect("shoutbox.php?act=shout");
                         }
                          //Should never get to this else!!!! added just incase
                        else
                          $SB_NOTICE="Permission dedied you dont own this shout";
                    }
                   else
                    $SB_NOTICE=SHOUT_LIMIT . " - Max " . $SBX['shout_limit'] . " characters";
                 }
                 else
                  $SB_NOTICE=NO_MSG;
              }
             else
            $SB_NOTICE=BAD_ID;
         }
}
if($id >= 1)
{

                //number check aint really needed here as we already checked it
               if (is_numeric($id) && $CURUSER['uid'] != 1){
                  $query = "SELECT * FROM shoutbox WHERE msgid=$id" ;
                  $result = mysql_query($query);
                  $edit=mysql_fetch_array($result);
                    if($edit['msgid'] > 1){
                 //check user belongs to shout or can delete forum
                      if ($CURUSER['uid'] == $edit["userid"] || $CURUSER['edit_forum'] == "yes")
                        {
                        if($message)
                        $content=shout_form(stripslashes($message),true);
                        else
                        $content=shout_form(stripslashes($edit['message']),true);
                        }
           else
                $SB_NOTICE=NO_EDIT;
        }
        else
       $SB_NOTICE=BAD_ID;
        }
        else
       $SB_NOTICE=BAD_ID;
}
else{
$SB_NOTICE=BAD_ID;
}
}
?>