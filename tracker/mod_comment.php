<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
{
    $modcomment = addslashes($_POST["modcomment"]);
    $id = intval($_GET["id"]);

    $query = "UPDATE {$TABLE_PREFIX}users SET modcomment='".$modcomment."' WHERE id=".$id;
    mysql_query($query);

    $returnto = $_POST["returnto"];
    header("Location: $returnto");
}
else
    die("Unauthorised access!");

?>