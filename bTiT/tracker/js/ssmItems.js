<!--

/*
Configure menu styles below
NOTE: To edit the link colors, go to the STYLE tags and edit the ssm2Items colors
*/
YOffset=200; // no quotes!!
XOffset=10;
staticYOffset=30; // no quotes!!
slideSpeed=30 // no quotes!!
waitTime=100; // no quotes!! this sets the time the menu stays out for after the mouse goes off it.
menuBGColor="black";
menuIsStatic="yes"; //this sets whether menu should stay static on the screen
menuWidth=150; // Must be a multiple of 10! no quotes!!
menuCols=2;
hdrFontFamily="Tahoma";
hdrFontSize="2";
hdrFontColor="white";
hdrBGColor="#170088";
hdrAlign="left";
hdrVAlign="center";
hdrHeight="15";
linkFontFamily="Tahoma";
linkFontSize="2";
linkBGColor="white";
linkOverBGColor="#FFFF99";
linkTarget="_top";
linkAlign="Left";
barBGColor="#444444";
barFontFamily="Tahoma";
barFontSize="2";
barFontColor="white";
barVAlign="center";
barWidth=20; // no quotes!!
barText="SLIDEBAR"; // <IMG> tag supported. Put exact html for an image to show.

///////////////////////////

// ssmItems[...]=[name, link, target, colspan, endrow?] - leave 'link' and 'target' blank to make a header
ssmItems[0]=["Side Menu"] //create header
ssmItems[1]=["Torrents", "torrents.php", ""]
ssmItems[2]=["Request", "viewrequests.php",""]
ssmItems[3]=["Expected", "viewexpected.php", ""]
ssmItems[4]=["Upload", "upload.php"]
ssmItems[5]=["Members", "users.php", ""]
ssmItems[6]=["Top 10", "extra-stats.php", ""]

ssmItems[7]=["FAQ", "faq.php", "", 1, "no"] //create two column row
ssmItems[8]=["Rules", "rules.php", "",1]

ssmItems[9]=["External Links", "", ""] //create header
ssmItems[10]=["DOX", "dox.php", ""]
ssmItems[11]=["Forum", "forum.php", ""]
ssmItems[12]=["Link to Us", "linktous.php", ""]
ssmItems[13]=["Donate", "donate.php", ""]

ssmItems[14]=["Games/Casino", "", ""] //create header
ssmItems[15]=["Games", "games.php", ""]
ssmItems[16]=["Snake", "snake.php", ""]
ssmItems[17]=["Lottery", "tickets.php", ""]
ssmItems[18]=["BlackJack", "blackjack.php", ""]

buildMenu();

//-->