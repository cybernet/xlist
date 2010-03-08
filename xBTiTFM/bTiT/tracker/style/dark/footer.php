</td>
<?php
if(mysql_query("SELECT * FROM blocks WHERE position='r'"))
right_menu();
?>
<?php
block_begin("Disclaimer",'1','justify',array('width'=>'500px','font'=>'10px Verdana,Tahoma', 'padding'=>'1px'));
global $SITENAME;
echo "None of the files shown here are actually hosted on this server ($SITENAME). The links are provided solely by this site's ($SITENAME) users. The administrator of this site ($SITENAME) cannot be held responsible for what its users post, or any other actions of its users. You may not use this site ($SITENAME) to distribute or download any material when you do not have the legal rights to do so. It is your own responsibility to adhere to these terms. By registering on and/or using this website ($SITENAME), it is assumed that you, as the user, has read, understood, and agreed to all the terms and conditions set forth by the site owner.";  
block_end();
?>
</tr>
<tr>
<td height="20%" colspan="2">
<?php

   //print("<p align=right>BtitTracker (Alpha3) by Btiteam</p>"); //mysql_stat());
?>
</td></tr>
</table>
</table>

