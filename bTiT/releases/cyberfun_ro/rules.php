<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5 Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
require_once ("include/functions.php");
require_once ("include/config.php");


dbconn(true);

//loggedinorreturn();

standardheader("Rules");

block_begin("Rules");

?>

<? begin_frame("General rules - <font color=Red>Breaking these rules can and will get you banned!</font>"); ?>
<ul>
<li>Do not defy the moderators expressed wishes!</li>
<li>Do not upload our torrents to other trackers! (See the <a href=faq.php#up3 class=altlink><b>FAQ</b></a> for details.)</li>
<li><a name="warning"></a>Disruptive behaviour in the forums will result in a warning (<img src="images/warned.gif"> ).<br>
You will only get <b>one</b> warning! After that it's bye bye Kansas!</li>

<? end_frame(); 
begin_frame("Downloading rules - <font color=Red>By not following these rules you will lose download privileges!</font>"); ?>
<ul>
<li>Access to the newest torrents is conditional on a good ratio! (See the <a href=faq.php#dl8 class=altlink><b>FAQ</b></a> for details.)</li>
<li>Low ratios may result in severe consequences, including banning in extreme cases.</li>
<br>
<table cellspacing=3 cellpadding=0>
 <tr>
        <td class=embedded width="70">Ratio below</td>
        <td class=embedded width="40" bgcolor="#F5F4EA"><font color="#BB0000"><div align="center">0.50</div></font></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded width="110">and/or upload below</td>
        <td class=embedded width="40" bgcolor="#F5F4EA"><font color="#BB0000"><div align="center">2.0GB</div></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded width="50">delay of</td>
        <td class=embedded width="40" bgcolor="#F5F4EA"><font color="#BB0000"><div align="center">48h</div></td>
 </tr>
 <tr>
        <td class=embedded>Ratio below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#A10000"><div align="center">0.65</div></font></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>and/or upload below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#A10000"><div align="center">3.5GB</div></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>delay of</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#A10000"><div align="center">24h</div></td>
 </tr>
 <tr>
        <td class=embedded>Ratio below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#880000"><div align="center">0.80</div></font></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>and/or upload below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#880000"><div align="center">5.0GB</div></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>delay of</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#880000"><div align="center">12h</div></td>
 </tr>
 <tr>
        <td class=embedded>Ratio below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#6E0000"><div align="center">0.95</div></font></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>and/or upload below</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#6E0000"><div align="center">7.5GB</div></td>
        <td class=embedded width="10">&nbsp;</td>
        <td class=embedded>delay of</td>
        <td class=embedded bgcolor="#F5F4EA"><font color="#6E0000"><div align="center">06h</div></td>
</td>
</tr></table>
<? end_frame(); 
begin_frame("General Forum Guidelines - <font color=Red>Please follow these guidelines or else you might end up with a warning!</font>"); ?>
<ul>
<li>No aggressive behaviour or flaming in the forums.</li>
<li>No trashing of other peoples topics (i.e. SPAM).</li>
<li>No language other than English in the forums.</li>
<li>No systematic foul language (and none at all on  titles).</li>
<li>No links to warez or crack sites in the forums.</li>
<li>No requesting or posting of serials, CD keys, passwords or cracks in the forums.</li>
<li>No requesting if there has been no '<a href="http://www.nforce.nl/">scene</a>' release in the last 7 days.</li>
<li>No bumping... (All bumped threads will be deleted.)</li>
<li>No images larger than 800x600, and preferably web-optimised.</li>
<li>No double posting. If you wish to post again, and yours is the last post
in the thread please use the EDIT function, instead of posting a double.</li>
<li>Please ensure all questions are posted in the correct section!<br>
(Game questions in the Games section, Apps questions in the Apps section, etc.)</li>
<li>Last, please read the <a href=faq.php class=altlink><b>FAQ</b></a> before asking any questions!</li>
<? end_frame(); 
begin_frame("Avatar Guidelines - <font color=Red>Please try to follow these guidelines</font>"); ?>
<ul>
<li>The allowed formats are .gif, .jpg and .png.
<li>Be considerate. Resize your images to a width of 150 px and a size of no more than 150 KB.
(Browsers will rescale them anyway: smaller images will be expanded and will not look good;
larger images will just waste bandwidth and CPU cycles.) For now this is just a guideline but
it will be automatically enforced in the near future.
<li>Do not use potentially offensive material involving porn, religious material, animal / human
cruelty or ideologically charged images. Mods have wide discretion on what is acceptable.
If in doubt PM one.
<? end_frame(); 
begin_frame("Moderating Rules - <font color=Red>Use your better judgement!</font>");
?>
<ul>
<li>The most important rule: Use your better judgment!</li>
<li>Don't be afraid to say <b>NO</b>! (a.k.a. "TreetopClimber's rule".)
<li>Don't defy another mod in public, instead send a PM or through IM.</li>
<li>Be tolerant! Give the user(s) a chance to reform.</li>
<li>Don't act prematurely, let the users make their mistakes and THEN correct them.</li>
<li>Try correcting any "off topics" rather then closing a thread.</li>
<li>Move topics rather than locking them.</li>
<li>Be tolerant when moderating the Chit-chat section (give them some slack).</li>
<li>If you lock a topic, give a brief explanation as to why you're locking it.</li>
<li>Before you disable a user account, send him/her a PM and if they reply, put them on a 2 week trial.</li>
<li>Don't disable a user account until he or she has been a member for at least 4 weeks.</li>
<li><b>Always</b> state a reason (in the user comment box) as to why the user is being banned / warned.</li>
<br>

<?
end_frame();
begin_frame("Moderating options - <font color=Red>What are my privileges as a mod?</font>");
?>
<ul>
<li>You can delete and edit forum posts.</li>
<li>You can delete and edit torrents.</li>
<li>You can delete and change users avatars.</li>
<li>You can disable user accounts.</li>
<li>You can edit the title of VIP's.</li>
<li>You can see the complete info of all users.</li>
<li>You can add comments to users (for other mods and admins to read).</li>
<li>You can stop reading now 'cuz you already knew about these options. ;)</li>
<li>Lastly, check out the <a href=http://bits.pantheraonline.com/staff.php class=altlink>Staff</a> page (top right corner).</li>

<? end_frame(); ?>

<p align=right><font size=1 color=#000000><b>Rules edited 2007-03-23 &nbsp;</b></font></p>

<?
block_end();
stdfoot();
?>