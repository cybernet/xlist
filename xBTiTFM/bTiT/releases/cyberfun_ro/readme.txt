////////////////////////////////////
BTI Tracker 1.4.X, PB Edition 1.5.4
Release Date 10-10-2008 By FatePower
////////////////////////////////////

Thanks you for downloading
BTI Tracker 1.4.X (by btiteam), PB Edition (by panthera) 1.5.4.
PB Edition is a modded source code of btitracker 1.4's
souce code. You can more call it more like a Fully Modded Edition.
This steps are in readme.txt;

- Installation
	Info
	Upgrade
	Install (With Installer)
	Install (Without Installer)
- Credits and Copyright

**************
*INSTALLATION*
**************

//Info Bellow;

First, Some parts in the Changelog/Readme is written
as standard, like some handy things to know ect ect..
And some of the standard texts can be updated.

Installer by Jboy included (but i have change it little to fit the BTI Tracker 1.4.X, PB Edition 1.5.X). 
First i will thanks all users
on the Btiteams forum and all developer
on Btiteam, who have provided BTI Tracker 1.4.X, PB Edition 1.5.X
with the lovley hacks and the lovley Bti tracker Source.
Don't Remove the Copyright info in the footer,
think of that, btit is a open source and same with this
full modded Edition. By having that copyright in footer
you are supporting the prodject btit and now this release so
we can keep it as a open source and having
the prodject's alive and keep it free.
Why im not writing all Credits to the users who have
made the hacks i might have included in this release,
is that i can't remember all nicks, but if u "the creator" want to have
your credits in the file just send me a PM on btiteam.org. 
But allso think that i have update and mod some hacks by my self. I just want
that everything shall be okey.

Big File changes in (overall, not in 1.X.X release):
/include/functions.php
/include/config.php
/blocks/main_block-php
/blocks/mainmenu_block.php
/blocks/online_block.php
/blocks/mainusertoolbar_block.php
/blocks/mainmenu_block.php
/upload.php
/admincp.php
/torrents.php
/forum.php
/account.php
/usercp.php
/edit.php
/detalis.php
/userdetalis.php
/annouce.php
/userdetails.php

All max(,0 is changed to intval(. That should fix the security issue.
I will allso soon include an new protection system, who is helping to
stop all bloody users who are trying to inject sqls. But the base security is
fixed. So no more jokeing users who are getting admins.
The download/upload bug is allso solved in annouce, in 1.5.X i have added
so u must print your PW before changing your profile. 

/////////////////////////////////////
This changes has been done 1.5.4:
/////////////////////////////////////

* Updated scrape.php
* Updated crkprotection.php
* Updated All files to remove license
* Updated adminpanel.php
* Updated upload.php
* Added sticky torrents hack
* Cleaned up some code to remove the license completeley.


/////////////////////////////////////
This changes has been done 1.5.3:
/////////////////////////////////////

So here's the 1.5.3 release of PB Edition.
Some users asked me why im not included Anti H&R hack,
i had never think about it. But now in this release it's
included. I also added an option in ACP for the users
who not wanna to use it. They can easy turn it off.

* Fixed some knowned Bugs
* Updated emailtousers.php
* Added ANTI Hit and Run
* Added Option in ACP to TURN Anti H&R OFF
* Updated the Database
* Security updated, replaced som bad lines
* Added Recommended HACK
* Added Option in ACP To turn Recommended OFF
* Added A Search hack, so u can fast search torrent from mozilla example
* Added so u can search golden torrents
* Fixed Custom Title hack bugg
* Fixed Comments.php
* Fixed Permissions so it will fit with mod_access, admin_access or owner_access ect ect..
* Fixed Permissions for searchusers2.php
* Fixed Permissions for Report Hack instead of have ['id_level'] = 10 added owner_access
* Added MSN Inviter hack
* Fixed General Permissions for owner, admin, mod access
* Added IMDB hack
* Added hack. Check if username is avalible
* Fixed Wishlist bugg
* Added More code to the auto warn in the sanity.php
now the users get disbaled after reached $warntimes
* Added download check page
* Added Option to turn download check page to on/off
* Added Option to set the min ratio for download (if download check page is enable)
* Added Cobracrk ANTI SQL Injection security
* Updated the installer to 1.5.3



/////////////////////////////////////
This changes has been done 1.5.2:
/////////////////////////////////////

* Updated "Cut torrents name after x numb of char" and setted
an option to turn it on or off.
* Added Genre hack by cobracrk
* Added Scene or non scene hack by cobracrk
* Updated the database
* Fixed some buggs
* Uppdated the security in annouce.php
* Added ban known client hack by Petr1fied
* Updated the themplate
* Added Firefox check
* Updated the Installer and added all
tracker settings options.
* Fixed the toptorrents_block and lasttorrents_block.
So they will fit the new update to cutnames.
* Added Golden Torrents Hack


New hacks added:

Yea they are noted above, probably all ;)

Updates:
Updated to the last version though SVN,
i have added as in the last bti version 1.4.4
so u must print pw before changing the profile.
I have updated all other things who is updated on SVN.
To the next release im thinking of fixing all the shorttags to
<?php for the users who has shorttags to false.
But i can't promise that i can get time to fix
all shorttags. If enyone want to help fixning all shorttags
to <?php, just post in the BTITFM forum. But u must have
knowlage of php and what u are doin. All trough
the source is lookin fine, there is some small buggs.
But the source is running fine. 

///////////////////////////////////
This changes has been done 1.5:
///////////////////////////////////

Bug Fixes, New hack installed and
some other tools.

Hope i get all the files who i have make big changes in.
New files:
alot of new files.

User_Level Table updated:

Now Owner has id_level=10
Admin has id_level=9
and Moderator has id_level=8
i have allso created
an group named
designer, if u want to have
designers on your tracker.

Some handy things to know:

If u want only owners to have
access in some sort of files.
u can use ["owner_access"]
if u want admin to access things
(admin and owner can see this).
Use ["admin_access"] and
mod access is ["mod_access"].

If u want to custom your blocks
you can use an array and justify in block_begin
i have rewrited the function for
block_begin. You can use the function like
this:
block_begin("Disclaimer",'1','justify',
array('width'=>'500px','font'=>'10px Verdana,Tahoma', 'padding'=>'1px'));

Allso torrents
name longer than 30 char,
the rest of the word get
replaced with ... Like;
btitrackerfullmod...

Users Table Updated:

I have updated many rows in
the tbale users. Extra
options has been added. 

New Hacks in PB Edition 1.5:
- Ban Cheapmails
- Ban Cheapdomains
- Login Attempts Hack
- Force user to choose Country
- Age/Gender hack
- Signature in Forum Included
- Avatar Upload
- Extra Options in Uploads.php (Homepage, Video, Screenshot, Demo URL)
- Games Hack
- Request Hack
- Expected Torrents Hack
- Staff Page with avatars
- Advanced Forum System (Allso Updated forum)
- IP Login System
- Cut torrents name after x numbs of chars
- Javascript side menu (ACP option to turn on or off)
- Email Inactive users (ACP option to turn on or off, allso set X numbs of days)
- Show/Hide Porn

Big hacks installed:
- Owner, Admin, Mod CP
- Warning hack
- Low Ratio Warning hack / And disable account after X num warnings
- Javascript torrent browse
- Invite System hack
- Ajax News
- Auto Upgrade / Downgrade to/from Poweruser
- Custom Title
- Seed Bonus (Thanks to CyberDoc For the updated SeedBonus Shop).
- Dox Hack
- Donation System (Fixed By Fatepower for BTI Tracker 1.4, PB Edition 1.5)
- Ban Cheapmails
- Ban Cheapdomains
- Login Attempts Hack
- Force user to choose Country
- Age/Gender hack
- Signature in Forum Included
- Avatar Upload
- Extra Options in Uploads.php (Homepage, Video, Screenshot, Demo URL)
- Games Hack
- Request Hack
- Expected Torrents Hack
- Staff Page with avatars
- Advanced Forum System (Allso Updated forum)

(Probably all)
Note:
That i have made and install
some small hack's to.

NOTE:
If u want to update your rules, faq and useragreement u need 
to use the phpeditor on the tracker (in admin cp). Or just open
rules.php ect ect with your php editor.
I haven't included an database Edition, cuz its so simple
to update the rules thought an php editor.
Maybe in 1.6 or 1.7 i will include a hack with
the options so u can edit it in ACP.

Security Fixes:
Fix the max(,0 to intval(
Fix some other changes

//Install Bellow;

In this release there is no UPDATES, just upload
all the files and run the installer or install in manualy.
Unpack the archive (if you're reading this document, you've probably already done it) :)

----------------
Update:
----------------

1. Upload all files. Do the chmod (if needed, see using installer)
2. Point your browser to http://www.yoururlhere.com/upgrade/
3. Follow the instructions
4. Delete the upgrade folder

----------------
USING INSTALLER:
----------------
1. 
Read the included doc named readme_ioncube.txt
then
Upload all the files (except config.php if upgrading) into your ftp account, 

2. 

change the properties/CHMOD 777 
    * /include/config.php,
    * /include/paypal.php,
    * /include/client/license.inc.php
    * /addons/guest.dat,
    * /shoutbox/config.php,
    * /torrents/,
    * /badwords.txt,
    * /chat.php,
    * /paypal2.php,
    * /avatar,
    * /backups,
    * /newsCache,
    * /dox,
    * /phpeditor.php

so it has full read/write capabilities.

3. 
Open your browser and point to your site address, you'll find the installation wizard.
After install:
Delete the install folder for more security.
Now locate to root, and u shall auto be redired to
the licensefile, follow the inscrution there and insert
the license key u get, your name, your email and your domain.
Press Update and now your site shall be up ;)

4.
Then do THIS:
//////////////////////////////////////////////////
Settings in DB before using FM;
Login to PHPmyAdmin or other software u use.
Go to the 'users table' and edit the System user.
Set the id_level=0 and id=0 on the 'System' user, Save and logoff.
or run a SQL who looks like this:
UPDATE `users` SET `id` = '0' WHERE `users`.`id` =4 LIMIT 1 ;
But be sure that the 'System' user has the id=4, before u running the SQL. And after the
sql querry it shall has the id = 0.
If u have creat an new admin user, with
the INSTALL delete the user admin
in users table.
Then Open, Donate.php and set your changes. (Optional)
Then Open, lintous.php and set your changes. (Optional)
Then Open, Paypal2.php and set your changes. (Optional)
//////////////////////////////////////////////////

4.1
If u want to use that users only can use the url;
http://www.yoursite.com and not http://yoursite.com.
If they try to access trough http://yoursite.com they
get redericted to http://www.yoursite.com. Open the
htaccess.txt and edit the URL, then rename to .htaccess

*** IMPORTANT: ***
Then go to Admin ControlPanel, point to tracker settings,
then sett your settings.
( Dont forget to set the "cut torrent names after x numbs of char to a good choose like 30 or 40" )

*********************
*MANUAL INSTALLATION*
*********************

1. 
Read the included doc named readme_ioncube.txt
then
Upload all the files (except config.php if upgrading) into your ftp account, 

2. 

change the properties/CHMOD 777 
    * /include/config.php,
    * /include/paypal.php,
    * /include/client/license.inc.php
    * /addons/guest.dat,
    * /shoutbox/config.php,
    * /torrents/,
    * /badwords.txt,
    * /chat.php,
    * /paypal2.php,
    * /avatar,
    * /backups,
    * /newsCache,
    * /dox,
    * /phpeditor.php

so it has full read/write capabilities.

3.
Locate the "include" folder and edit config.php to set the basic
information for your mysql account. The others can be edited
with the Admin Panel.

The dbhost is the address for accessing your mysql server (90% of the time it works if
left as localhost).

$dbhost = "localhost";
dbuser is the username you use to access your mysql server.
$dbuser = "yourdbusername";
dbpass is your password you use to access your mysql server.
$dbpass = "yourdbpassword";
database is the database name.
$database = "databasename";

4.
Now, open your mysql manager (something like phpmyadmin), select your database, 
select the "SQL" tab and:
- And process sql/database_manually.sql

//////////////////////////////////////////////////
5.
Settings in DB before using FM;
Login to PHPmyAdmin or other software u use.
Go to the 'users table' and edit the System user.
Set the id_level=0 and id=0 on the 'System' user, Save and logoff.
or run a SQL who looks like this:
UPDATE `users` SET `id` = '0' WHERE `users`.`id` =4 LIMIT 1 ;
But be sure that the 'System' user has the id=4, before u running the SQL. And after the
sql querry it shall has the id = 0.
Then Open, Donate.php and set your changes. (Optional)
Then Open, lintous.php and set your changes. (Optional)
Then Open, Paypal2.php and set your changes. (Optional)
Then Open, userlevels.php and set your changes. (Optional)
//////////////////////////////////////////////////

5.1
If u want to use that users only can use the url;
http://www.yoursite.com and not http://yoursite.com.
If they try to access trough http://yoursite.com they
get redericted to http://www.yoursite.com. Open the
htaccess.txt and edit the URL, then rename to .htaccess

6.
Now point your browser to. http://www.yoursite.com
and u shall auto be redired to
the licensefile, follow the inscrution there and insert
the license key u get, your name, your email and your domain.
Press Update and now your site shall be up ;)
the login as:
user: admin
password: admin
Change your admin pass, after u have logged in.

*** IMPORTANT: ***
Then go to Admin ControlPanel, point to tracker settings,
then sett your settings.
( Dont forget to set the "cut torrent names after x numbs of char to a good choose like 30 or 40" )

*********
*Credits*
*********

/////////////////////////////////
BTI Tracker 1.4 FM, PB Edition 1.5.X Credits
/////////////////////////////////


Some hack is made by fatepower
all hacks is installed by
fatepower and supported by Panthera.
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition Beta 3 Copyright © 2007 PantheraBits.com. All Rights Reserved. 

Credits to people who have make the hacks.
(Propebly all if ur not here and u have seen your hack and 
want your name in this file, please contact me)

- Ripper
- CyberDoc
- miskotes
- fatepower
- vibes
- Lupin (thx for the great btit source)
- cooly
- Larkspeed
- TheDevil
- cobracrk
- DGD
- GeWa
- Liroy
- norris
- marmon
- Laurianti

////////////////
Btiteam Credits
////////////////

This tracker is a frontend for DeHackEd's tracker, aka phpBTTracker (now heavely modified). 
We aim to make a nice user interface and a good admin tool at the same time.
Some code and some ideas came from other trackers:
- torrentbits (http://www.torrentbits.org)
- torrenttrader (http://www.torrentrader.com)
- bytemoonsoon (deadlink)
- DHKold for original ShoutBox code.
- Tbdev: CoLdFuSiOn (http://www.tbdev.net)

the rest has been coded, designed and thought up from scratch.

Also some help from Static_Rage writing the english translation for the
tracker and this readme file. (www.voidnightmare.com)

Thanks to coder addons/hacks (many are included in this Edition): 
Petr1fied, miskotes, gAndo, Fireworx, Freelancer, Sktoch, Nimrod, etc... (sorry if someone is missed :))

Thanks to style maker: 
bmfan, pipphot78 (alias ch3), Skotch, Fireworx, etc... (sorry again if someone is missed :))

Many thanks to all guys how partecipate for the testing and for addons/styles etc.

This code is completly free of charge, as the future hack, as help, 
as all you need for put and run this tracker (no supporter club or 
other work around for paying for free scripts).
You can change it, but please give credit to us.

If you have questions, doubt or other, visit our support forum:
http://www.btiteam.org

Btiteam.

------------------------------------
Greetings,
  __      _                                    
 / _|    | |                                   
| |_ __ _| |_ ___ _ __   _____      _____ _ __ 
|  _/ _` | __/ _ \ '_ \ / _ \ \ /\ / / _ \ '__|
| || (_| | ||  __/ |_) | (_) \ V  V /  __/ |   
|_| \__,_|\__\___| .__/ \___/ \_/\_/ \___|_|   
                 | |                           
                 |_|                

"Panthera, Fast as the sun cuz faster couldn't it be" ~1886

////////////////////////////////////
BTI Tracker 1.4.X, PB Edition 1.5.4
Release Date 10-10-2008 By FatePower
////////////////////////////////////