<?
require_once("include/functions.php");
require_once("include/config.php");
require_once("include/blocks.php");

?>
<table width="100%" height="100%"  border="0">
<tr>
<td height="100" colspan="2">
 <table width=100%>
 <tr><td align=left>
 <a href=./index.php><img border=0 src="<? echo $STYLEPATH ?>/logo.gif"></a>
 </td>
<td align=center>
       <?
//begin_frame("Latest News", center);

//echo "<marquee onmouseover=this.stop() onmouseout=this.start() scrollAmount=1 direction=up width='100%' height='80'><center>";
//echo file_get_contents("news.txt") ;
//echo "</marquee>";
//end_frame();
?>
</td>
<td align=right>
<a href=./index.php><img border=0 src="<? echo $STYLEPATH ?>/logo.gif"></a>
    </td></tr>
    </table>
</td>
</tr>
<tr><td height="100" colspan="2">
<?

main_menu();
?>
</td></tr><tr>

<td valign=top>
