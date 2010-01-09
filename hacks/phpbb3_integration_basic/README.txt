#################################################
#################################################
#
#		ENGLISH
#
# Title: phpbb3 integration basic
# Version: beta 0.9.1
# Author: signo
# Date release: 2009-08-04
# Official release: http://www.btiteam.org/smf/index.php?topic=14659.0 (english)
# Installation time: about 1 min. with automatic installation
# Installation level: easy
# Requirements:
#				xbtit v2.0.559 (without HACKs is better)
#				phpBB 3.0.5 (without MODs is better)
#				xbtit and phpBB3 installed in the same MySQL database 
#				phpBB 'Account activation:' disabled
#				phpBB 'Allow username changes:' disabled
#				phpBB 'Allow e-mail address re-use:' disabled
#				
########################
#
# DESCRIPTION
# With this Hack you can integrate your phpBB3 forum with xbtit tracker.
# I suggest you ti install this hack in a xbtit tracker without hacks and in phpBB3 forum without MODs,because if you have already installed some hacks probably the automatic installation doesn't work and you have to change by yourself the xbtit code. This would be a long and very hard work!!
#
# The integration is basic,however there are lots of features:
#		* the administrator can enable/disable the 'Export/Import members function' in 'Tracker's Settings' 
#		* the administrator have to set the database prefix in 'Tracker's Settings' (for default is phpbb3_)
#		* the administrator have to set the path of phpBB3,useful for some feature as to delete phpbb3 cache
#		* in 'Tracker's Settings' the administrator can export the xbtit's users in phpbb3.
#		* in 'Tracker's Settings' the administrator can import the phpbb's users in xbtit.
#		* the administrator can disable 'Account activation/Allow username changes/Allow e-mail address re-use' on phpbb3 in 'Tracker's Settings' and also to delete the cache. Have to set the forum path correctly. 
#		* the admin can try to hide 'Edit account settings' on phpbb3 user's profile in 'Tracker's Settings' and also to delete the cache. Have to set the forum path correctly (only for prosilver and subsilver2 style and for english language)
#		* the admin can try to restore the orginal 'Edit account settings' on phpbb3 user's profile in 'Tracker's Settings' and also to delete the cache. Have to set the forum path correctly (only for prosilver and subsilver2 style and for english language)
#		* check last version on "Admin Panel"
#		* when someone creates a new account in xbtit he creates also a new member in phpBB3 in automatic.
#		* changed message after registration 
#		* when the user changes the password in his xbtit's profile,the system update the password on phpbb3, too
#		* when the user recovers the password with xbtit,the system updates both the passwords,on xbit and phpbb3,too
#		* when the user changes the email,timezone,language in xbtit's profile,the system update also the profile in phpBB3
#		* forum showed into a tracker's page 
# 
########################
# 
# INSTALLATION WITH AUTOMATIC XBTIT TOOL
# 
# - extract the archive .zip
# - enter in your revision folder. (if you use xbtit v2.0.559 enter in folder "rev559")
# - place the "hacks" folder in your webroot
# - enter in the "Admin Panel" and in "Admin Menu" choose "Hacks Settings".
# - Select the "phpbb3_integration_basic" ed install.
# 
########################
# 
# UPGRADE TO LAST VERSION WITH AUTOMATIC XBTIT TOOL
# 
# FIRST STEP
# - enter in the "Admin Panel" and in "Admin Menu" choose "Hacks Settings".
# - for uninstall the previous version of "phpbb3_integration_basic" click on "UnInstall" 
#
# SECOND STEP
# - now extract the new version present in the archive .zip
# - enter in your revision folder. (if you use xbtit v2.0.559 enter in folder "rev559")
# - place the "hacks" folder in your webroot
# - enter in the "Admin Panel" and in "Admin Menu" choose "Hacks Settings".
# - Select the "phpbb3_integration_basic" ed install.
# 
########################
# 
# UNINSTALL WITH AUTOMATIC XBTIT TOOL
# 
# - enter in the "Admin Panel" and in "Admin Menu" choose "Hacks Settings".
# - for uninstall "phpbb3_integration_basic" click on "UnInstall" 
# 
#################################################
#################################################