<?php
$log = fopen("ws.log", "a");
fputs($log,$_SERVER['HTTP_REMOTE_ADDR'] . ' accessed ' . $_GET['url'] . ' on ' . date("g:i, D") . ' the ' .date("dS") . ' of ' . date("F") . ' from ' . $_SERVER['HTTP_REFERER'] . "\n" );
fclose($log);
Header ("Location: " . $_GET['url']);
?>
