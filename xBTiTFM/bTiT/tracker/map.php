<?php

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

if ($CURUSER["view_news"]=="yes")
{
standardheader("CyBeR FuN MaP");
block_begin("CyBeR FuN MaP");

print ("<iframe width=\"640\" height=\"480\" frameborder=\"0\" scrolling=\"no\" marginheight=\"0\" marginwidth=\"0\" src=\"http://maps.google.com/maps/ms?hl=en&amp;client=firefox-a&amp;ie=UTF8&amp;oe=UTF8&amp;t=h&amp;msa=0&amp;msid=110115485120302104654.00046b8618a239c9f33b7&amp;ll=37.09024,-95.712891&amp;spn=33.435463,56.25&amp;z=4&amp;output=embed\"></iframe><br /><small>View <a href=\"http://maps.google.com/maps/ms?hl=en&amp;client=firefox-a&amp;ie=UTF8&amp;oe=UTF8&amp;t=h&amp;msa=0&amp;msid=110115485120302104654.00046b8618a239c9f33b7&amp;ll=37.09024,-95.712891&amp;spn=33.435463,56.25&amp;z=4&amp;source=embed\" style=\"color:#0000FF;text-align:left\">CyBeR FuN Office</a> in a larger map</small>");

}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
block_end();
stdfoot();
?>
