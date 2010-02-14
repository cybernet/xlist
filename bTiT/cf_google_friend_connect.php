<?php

require_once ("include/functions.php");
require_once ("include/config.php");


dbconn();

if ($CURUSER["view_news"]=="yes")
{
standardheader("Chat");
block_begin("Chat");

print ("<center><iframe src=\"http://www.google.com/friendconnect/discuss?scope=site&topic=Torrents\" style=\"width:600px;height:410px;\" scrolling=\"no\" allowtransparency=\"true\" border=\"0\" frameborder=\"0\" ></iframe></center>");
print ("<!-- Include the Google Friend Connect javascript library. -->
<script type=\"text/javascript\" src=\"http://www.google.com/friendconnect/script/friendconnect.js\"></script>
<!-- Define the div tag where the gadget will be inserted. -->
<div id=\"div-193746193053485453\" style=\"width:276px;border:1px solid #1D1D1D;\"></div>
<!-- Render the gadget into a div. -->
<script type=\"text/javascript\">
var skin = {};
skin['BORDER_COLOR'] = '#1D1D1D';
skin['ENDCAP_BG_COLOR'] = '#e0ecff';
skin['ENDCAP_TEXT_COLOR'] = '#838383';
skin['ENDCAP_LINK_COLOR'] = '#838383';
skin['ALTERNATE_BG_COLOR'] = '#transparent';
skin['CONTENT_BG_COLOR'] = '#transparent';
skin['CONTENT_LINK_COLOR'] = '#838383';
skin['CONTENT_TEXT_COLOR'] = '#FFFFFF';
skin['CONTENT_SECONDARY_LINK_COLOR'] = '#838383';
skin['CONTENT_SECONDARY_TEXT_COLOR'] = '#c0c0c0';
skin['CONTENT_HEADLINE_COLOR'] = '#838383';
skin['NUMBER_ROWS'] = '4';
google.friendconnect.container.setParentUrl('/');
google.friendconnect.container.renderMembersGadget(
 { id: 'div-193746193053485453',
   site: '10944103732438789953' },
  skin);
</script>");
print ("<!-- Include the Google Friend Connect javascript library. -->
<script type=\"text/javascript\" src=\"http://www.google.com/friendconnect/script/friendconnect.js\"></script>
<!-- Define the div tag where the gadget will be inserted. -->
<div id=\"div-6946765839167009138\" style=\"width:282px;border:1px solid #cccccc;\"></div>
<!-- Render the gadget into a div. -->
<script type=\"text/javascript\">
google.friendconnect.container.setParentUrl('/' /* location of rpc_relay.html and canvas.html */);
google.friendconnect.container.renderOpenSocialGadget(
 { id: 'div-6946765839167009138',
   url:'http://www.google.com/friendconnect/gadgets/sample.xml',
   site: '10944103732438789953' });
</script>");

}
	else
	{
    err_msg(ERROR.NOT_AUTHORIZED."!",SORRY."...");
	}
block_end();
stdfoot();
?>
