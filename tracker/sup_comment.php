<?php

if (!defined("IN_BTIT"))
    die("non direct access!");

if($CURUSER["edit_users"]=="yes" || $CURUSER["admin_access"]=="yes")
{
    $supcomment = addslashes($_POST["supcomment"]);
    $id = intval($_GET["id"]);

    $query = "UPDATE {$TABLE_PREFIX}users SET supcomment='".$supcomment."' WHERE id=".$id;
    mysql_query($query);

    $returnto = $_POST["returnto"];
    header("Location: $returnto");
}
else
    die("Unauthorised access!");

?>