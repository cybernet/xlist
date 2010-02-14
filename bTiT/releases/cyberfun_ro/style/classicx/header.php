<?
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000; background-color: none !important;"></div>
<table width='100%' cellspacing='0' style='background: transperant; border:none;'>
  <tr>
    <td align='center'>
<table width='900px' cellspacing='2' style='background: #212121; border: 2px solid #141414;'>
  <tr>

    <td align='center'>
<table width="100%" height="100%"  border="0">
<tr>
<td height="100%" colspan="2">
    <table width=100%>
    <tr>
<td align=left>
    <a href=index.php><img border=0 src="style/classicx/logo.gif"></a>
    </td>
    </tr>
    </table>
</td>
</tr>

<?php
main_menu();
?>

<table width='99%' cellspacing='2' style='background: #282828; border: 2px solid #141414;'>
  <tr>
    <td align='center'>
<?php
side_menu();
?>
</td>
<td valign=top>