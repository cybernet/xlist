<?php
/********
Copyright © 2007 BTITeam.org. All Rights Reserved. 
PB Edition 1.5.X Copyright © 2007 PantheraBits.com. All Rights Reserved. 
Do not remove the Copyright in footer!
********/
global $users, $torrents, $seeds, $leechers, $percent, $BASEURL;

define("ACP_BAN_IP", "Ban IPs");
define("ACCOUNT_CONFIRM", "Account confirmation at the $SITENAME site.");
define("ACP_FORUM", "Forums<br />Settings");
define("ACP_USER_GROUP", "Users Group<br />Settings");
define("ACCOUNT_EDIT", "Edit account");
define("ACCOUNT_MSG", "Hello,\n\nThis email has been sent because someone has request an account on our site with this email address.\nIf you aren't the requester ignore this email, otherwise please confirm the account \n\nBest regards from the staff.");
define("ACCOUNT_CONGRATULATIONS", "Congratulations your account is now valid!<br>Now you can <a href=login.php>login</a> on the site using your account.");
define("ACP_STYLES", "Styles<br />Settings");
define("ACP_LANGUAGES", "Languages<br />Settings");
define("ACP_CATEGORIES", "Categories<br />Settings");
define("ACCOUNT_CREATED", "Account Created");
define("ACTIVE_ONLY", "Active only");
define("ACCOUNT_DELETE", "Delete account");
define("ACCOUNT_DETAILS", "account details");
define("ACCOUNT_MGMT", "Account Managment");
define("ACCOUNT_CREATE", "Create account");
define("ACP_TRACKER_SETTINGS", "Tracker's<br />Settings");
define("ACTION", "Action");
define("ACP_OPTIMIZE_DB", "Optimize your<br />Database");
define("ACP_CENSURED", "Censored words<br />Settings");
define("ADD", "Add");
define("ADD_REPLY", "Add Reply");
define("ADDED", "Added");
define("ADMINCP_NOTES", "Here you can control all settings of your tracker...");
define("ADD_RATING", "add rating");
define("MOD_CPANEL", "Mod Control Panel");
define("ADMIN_CPANEL", "Admin Control Panel");
define("OWNER_CPANEL", "Owner Control Panel");
define("ALL_SHOUT", "All Shouts");
define("ALL", "All");
define("ANSWER", "Answer");
define("ANONYMOUS", "Anonymous");
define("ANNOUNCE_URL","Tracker announce url:");
define("AUTHOR", "Author");
define("AVERAGE", "Average");
define("AVATAR_URL", "Avatar (url): ");
define("BAN_NOTE", "Here you can see the banned IPs and ban new IPs from accessing the tracker");
define("BACK", "Back to");
define("BAD_ID", "Bad ID!");
define("BAD_FORUM_ID", "Bad Forum ID");
define("BCK_USERCP", "Back to User Panel");
define("BLOCK_USER", "User Info");
define("BLOCK_INFO", "Tracker Info");
define("BLOCK_MENU", "Main Menu");
define("BODY", "Body");
define("BY", "By");
define("CAT_SETTINGS", "Categories Settings");
define("CANT_DELETE_TORRENT", "You're not authorized to delete this torrent!...");
define("CATEGORY", "Cat.");
define("CATEGORY_FULL", "Category");
define("CANT_DELETE_NEWS", "You're not authorized do delete news!");
define("CATCHUP", "Mark All as Read");
define("CANT_EDIT_TORR", "You're not authorised to edit torrent!");
define("CANT_DO_QUERY", "Can't do SQL query - ");
define("CANT_DELETE_USER", "You're not authorized to delete users!");
define("CANT_DELETE_ADMIN", "It's impossible to delete another admin!");
define("CANT_WRITE_CONFIG", "Warning: couldn't write config.php!");
define("CANT_SAVE_CONFIG", "Can't save the settings into the config.php");
define("CAT_IMAGE", "Category Image");
define("CANT_FIND_TORRENT", "Can't find torrent file!");
define("CAT_INSERT_NEW", "Insert new Category");
define("CAT_SORT_INDEX", "Sort Index");
define("CAT_ADD_CAT", "Add Category");
define("CANT_DELETE_GROUP", "This Level/Group can't be canceled!");
define("CANT_SAVE_LANGUAGE", "Can't save the language file");
define("CANT_READ_LANGUAGE", "can't read the language file!");
define("CENS_ONE_PER_LINE", "Write <b>one word per line</b> to ban it (will be changed into *censured*)");
define("CHANGE_PID", "Change PID");
define("CHOOSE", "Choose");
define("CHOOSE_ONE", "choose one");
define("CHARACTERS", "characters");
define("CLOSE", "close");
define("CLICK_HERE", "click here");
define("COMMENTS", "Comments");
define("CONFIG_SAVED", "Congratulations, new configuration was saved");
define("COMMENT","Com.");
define("COMMENT_1", "Comment");
define("CURRENT_DETAILS", "Current Details");
define("DATABASE_ERROR", "Database error.");
define("DATE", "Date");
define("DB_ERROR_REQUEST", "Database error. Cannot complete request.");
define("DB_SETTINGS", "Database's settings");
define("DELETE_ALL_READED", "Delete all read");
define("DELETE_TOPIC", "Delete Topic");
define("DELETE_TORRENT", "Delete Torrent");
define("DEAD_ONLY", "Dead only");
define("DESCRIPTION", "Description");
define("DELETE_CONFIRM", "Are you sure you want to delete/remove this?");
define("DELETE", "Delete");
define("DIF_PASSWORDS", "The passwords don't match!");
define("DOWNLOADED", "Downloaded");
define("DOWN", "Dl");
define("DONT_NEED_CHANGE", "you don't need to change this settings!");
define("DOWNLOAD","Download");
define("DOWNLOAD_TORRENT", "Download Torrent");
define("EDIT_CAT", "Edit Category");
define("EDIT", "Edit");
define("EDIT_POST", "Edit Post");
define("EDIT_STYLE", "Edit Style");
define("EDIT_TORRENT", "Edit Torrent");
define("EDIT_CENSURED", "Edit Censored Words");
define("EDIT_LANGUAGE", "Edit Language");
define("EMAIL_SENT", "An email as been sent to the indicated email address<br>click on the included link to confirm your account.");
define("EMAIL", "Email");
define("ERR_DELETE_POST", "Delete post. Sanity check: You are about to delete a post. Click");
define("ERR_CANT_CONNECT", "Can't connect to local MySQL server");
define("ERR_CANT_OPEN_DB", "Can't open database");
define("ERR_500", "HTTP/1.0 500 Unauthorized access!");
define("ERR_NOT_FOUND", "Not Found...");
define("ERR_MISSING_DATA", "Missing data!");
define("ERR_EMAIL_ALREADY_EXISTS", "This Email is already in our database!");
define("ERR_USER_NOT_FOUND", "Sorry, User not Found");
define("ERR_NOT_AUTH", "you're not authorized!");
define("ERR_GUEST_EXISTS", "The Guest name is a registered named. You can't register as 'Guest'");
define("ERR_PARSER", "There seems to be an error in your torrent. The parser did not accept it.");
define("ERR_HASH", "Info hash MUST be exactly 40 hex bytes.");
define("ERR_CANT_START_TOPICS", "You are not permitted to start new topics in this forum.");
define("ERR_ALREADY_EXIST", "This torrent may already exist in our database.");
define("ERR_CANT_FIND_GROUP", "Can't find this group!");
define("ERR_TORRENT_IN_BROWSER", "This file is for BitTorrent clients.");
define("ERR_INVALID_INFO_BT_CLIENT", "Invalid information received from BitTorrent client");
define("ERR_PID_NOT_FOUND", "Please redownload the torrent. PID system is active and pid was not found in the torrent");
define("ERR_LEVEL", "Sorry, your level ");
define("ERR_INVALID_CLIENT_EVENT", "Invalid event= from client.");
define("ERROR_ID", "Error ID");
define("ERR_USER_NOT_USER", "You're not autorized to access another user's panel!");
define("ERROR", "Error:");
define("ERR_NO_POST_WITH_ID", "No post with ID ");
define("ERR_FORUM_TOPIC", "Bad forum or topic ID.");
define("ERR_TOPIC_ID", "Bad Topic ID");
define("ERR_PERM_DENIED", "Permission denied");
define("ERR_NO_BODY", "No body text");
define("ERR_NO_TOPIC_ID", "No Topic ID returned");
define("ERR_TOPIC_ID_NA", "Topic ID is N/A");
define("ERR_TOPIC_LOCKED", "Topic is Locked");
define("ERR_POST_ID_NA", "Post ID is N/A");
define("ERR_LEVEL_CANT_VIEW", "You are not permitted to view this topic.");
define("ERR_LEVEL_CANT_POST", "You are not permitted to post in this forum.");
define("ERR_FORUM_NOT_FOUND", "Forum not found");
define("ERR_DELETE_TOPIC", "Delete topic. Sanity check: You are about to delete a topic. Click");
define("ERR_NO_TOPIC_POST_ID", "No topic associated with post ID");
define("ERR_BODY_EMPTY", "Body cannot be empty!");
define("ERR_POST_NOT_FOUND", "Post not found");
define("ERR_POST_UNIQUE", "Can't delete the post; it is the only post of the topic. You should");
define("ERR_POST_UNIQUE_2", "delete the topic");
define("ERR_POST_UNIQUE_3", "instead");
define("ERR_SERVER_LOAD", "The server load is very high at the moment. Retrying, please wait...");
define("ERR_ENTER_NEW_TITLE", "You must enter a new title!");
define("ERR_NOT_PERMITED", "Not Permited");
define("ERR_USER_ALREADY_EXISTS", "There's already an user with this nick!");
define("ERR_BAD_LAST_POST", "");
define("ERR_USERNAME_INCORRECT", "Username Incorrect");
define("ERR_PASSWORD_INCORRECT", "Password Incorrect");
define("ERR_IMAGE_CODE", "Image Code dont match");
define("ERR_NO_SPACE", "Your username can not contain a space, please replace with an underscore eg:<br /><br />");
define("ERR_SPECIAL_CHAR", "<font color=\"black\">Your username can not contain special characters like:<br /><br /><font color=\"red\"><strong>* ? < > @ $ & % etc.</strong></font></font><br />");
define("ERR_PASS_LENGTH", "<font color=\"black\">Your password must be a minimum of 4 characters.</font>");
define("ERR_BAD_NEWS_ID", "Bad news ID!");
define("ERR_NO_NEWS_ID", "New's ID not found!");
define("ERR_INS_TITLE_NEWS", "You must insert both title AND news");
define("ERR_NO_EMAIL", "You must enter an email address");
define("ERR_EMAIL_NOT_FOUND_1", "The email address");
define("ERR_EMAIL_NOT_FOUND_2", "was not found in the database.");
define("ERR_DB_ERR", "Database error. Please contact an administrator about this.");
define("ERR_SEND_EMAIL", "Unable to send mail. Please contact an administrator about this error.");
define("ERR_UPDATE_USER", "Unable to update user data. Please contact an administrator about this error.");
define("ERR_FORUM_UNKW_ACT", "Forum Error: Unknown action");
define("ERR_MUST_BE_LOGGED_SHOUT", "You must be logged to shout...");
define("ERR_INV_NUM_FIELD", "Invalid numerical field(s) from client");
define("ERR_MOVING_TORR", "Error moving torrent...");
define("ERR_INVALID_IP_NUMB", "Invalid IP address. Must be standard dotted decimal (hostnames not allowed)");
define("ERR_SUBJECT", "You must enter a subject.");
define("ERR_NO_VOTE", "You must choose a value to vote.");
define("ERR_EXTERNAL_NOT_ALLOWED", "External torrents not allowed");
define("ERR_RETR_DATA", "Error retreaving data!");
define("ERR_SQL_ERR", "SQL Error");
define("FACOLTATIVE", "optional");
define("FILE_UPLOAD_ERROR_2", "File Upload Error");
define("FINISHED", "Finished");
define("FIND_USER", "Find user");
define("FILE", "File");
define("FIVE_STAR", "5 stars");
define("FIRST_IP", "First IP");
define("FILE_UPLOAD_ERROR_1", "Cant read uploaded file");
define("FILE_UPLOAD_ERROR_3", "File is zero sized");
define("FILE_NAME", "File Name");
define("FILE_CONTENTS", "File Contents");
define("FOUND", "Found");
define("FORUM_PRUNE_1", "There are topics and/or posts in this forum!<br />You will lose all data...<br />");
define("FORUM_MIN_CREATE", "Min Class Create");
define("FORUMS", "Forums");
define("FORUM_MIN_WRITE", "Min Class Write");
define("FORUM_MIN_READ", "Min Class Read");
define("FORUM_PRUNE_3", "else go back.");
define("FORUM_NAME", "Forum Name");
define("FORUM_SETTINGS", "Forums Settings");
define("FORUM_N_TOPICS", "N. Topics");
define("FORUM_ERROR", "Forum Error");
define("FOUR_STAR", "4 stars");
define("FORUM_INFO","Forum Info");
define("FORUM", "Forum");
define("FORUM_SEARCH", "Forums Search");
define("FORUM_PRUNE_2", "If you're sure to cancel this forum");
define("FORUM_N_POSTS", "N. Posts");
define("FRM_DELETE", "Delete");
define("FRM_RESET", "Reset");
define("FRM_SEND", "Send");
define("FRM_LOGIN", "Login");
define("FRM_CANCEL", "Cancel");
define("FRM_CONFIRM", "Confirm");
define("GLOBAL_SERVER_LOAD", "Global Server Load (All websites on current server)");
define("GO","Go");
define("GROUP_NAME", "Group's name");
define("GROUP_VIEW_NEWS", "View News");
define("GROUP_VIEW_FORUM", "View Forum");
define("GROUP_EDIT_FORUM", "Edit Forum");
define("GROUP_BASE_LEVEL", "Choose base level");
define("GROUP_ERR_BASE_SEL", "Error on base level select!");
define("GROUP", "Group");
define("GROUP_DELETE_NEWS", "Delete News");
define("GROUP_PCOLOR", "Prefix Color (like ");
define("GROUP_SCOLOR", "Suffix Color (like ");
define("GROUP_VIEW_TORR", "View Torrents");
define("GROUP_EDIT_TORR", "Edit Torrents");
define("GROUP_VIEW_USERS", "View Users");
define("GROUP_DELETE_TORR", "Delete Torrents");
define("GROUP_EDIT_USERS", "Edit Users");
define("GROUP_DOWNLOAD", "Can Download");
define("GROUP_DELETE_USERS", "Delete Users");
define("GROUP_DELETE_FORUM", "Delete Forum");
define("GROUP_MOD_CP", "Can access Mod CP");
define("GROUP_GO_CP", "Can access Admin CP");
define("GROUP_OWNER_CP", "Can access Owner CP");
define("GROUP_EDIT_NEWS", "Edit News");
define("GROUP_ADD_NEW", "Add New Group");
define("GROUP_UPLOAD", "Can Upload");
define("GUEST", "Guest");
define("HERE", "here");
define("HISTORY", "History");
define("HOME", "Home");
define("IF_YOU_ARE_SURE", "if you are sure.");
define("IMAGE_CODE", "Image Code");
define("IM_SURE", "I'm Sure");
define("INVALID_ID", "It's not a valid ID. Sorry!");
define("INFINITE", "Inf.");
define("IN", "in");
define("INSERT_NEW_FORUM", "Insert new forum");
define("INSERT_USERNAME", "You must insert a username!");
define("INSERT_PASSWORD", "You must insert a password!");
define("INSERT_NEW_LANGUAGE", "Insert new Language");
define("INF_CHANGED", "Informations changed!");
define("INVALID_PID", "Invalid PID");
define("INS_OLD_PWD", "Insert OLD password!");
define("INSERT_NEW_STYLE", "Insert new Style");
define("INVALID_TORRENT", "Tracker error: invalid torrent");
define("INSERT_DATA", "Unsure of what you can upload? Use the <a class=altlink href=ulguide.php>Uploading Guide.</a><br>Insert all the necessary data for the upload.<br>");
define("UPLOADERS_GUIDE", "Uploaders Guide");
define("INFO_HASH", "Info Hash");
define("INSERT_USER_GROUP", "Insert new User Group");
define("INVALID_INFO_HASH", "Invalid info hash value.");
define("INS_NEW_PWD", "Insert NEW password!");
define("IP_ERROR", "Bad IP address.");
define("KEYWORDS", "Keywords");
define("LASTPOST", "Last post");
define("LANGUAGE_SETTINGS", "Language Settings");
define("LAST_EDITED_BY", "Last edited by");
define("LAST_10_POSTS", "10 last posts, in reverse order");
define("LANGUAGE_SAVED", "Congratulations, language has been modified");
define("LAST_UPDATE", "Last Update");
define("LAST_TORRENTS", "Latest Torrents");
define("LAST_EXTERNAL", "Last External Torrents Update was done on ");
define("LAST_SANITY", "Last Sanity Check was done on ");
define("LAST_POST_BY", "Last post by");
define("LAST_NEWS", "Latest News");
define("LAST_IP", "Last IP");
define("LEECHERS", "leecher(s)");
define("LOGIN", "Login");
define("LOCKED", "Locked");
define("LOGOUT", "Logout");
define("MANAGE_NEWS", "Manage News");
define("MAILBOX", "Mailbox");
define("MEMBER", "member");
define("MEMBERS_LIST", "User List");
define("MEMBERS", "Users");
define("MINIMUM_5_SEED", "with minimum 5 seeders");
define("MINIMUM_100_DOWN", "(with minimum 100 MB downloaded)");
define("MINIMUM_5_LEECH", "with minimum 5 leechers, not included dead torrents");
define("MKTOR_INVALID_HASH", "makeTorrent: Received an invalid hash");
define("MNU_UPLOAD", "Upload");
define("MNU_MEMBERS", "Members");
define("MNU_INDEX", "Index");
define("MNU_UCP_INFO", "Change Profile");
define("MNU_UCP_NEWPM", "New PM");
define("MNU_UCP_OUT", "Your PM outbox");
define("MNU_TORRENT", "Torrents");
define("MNU_UCP_CHANGEPWD", "Change Password");
define("MNU_STATS", "Extra Stats");
define("MNU_ADMINCP", "Admin Panel");
define("MNU_FORUM", "Forum");
define("MNU_NEWS", "News");
define("MNU_UCP_IN", "Your PM inbox");
define("MNU_UCP_HOME", "User's CP Home");
define("MNU_UCP_PM", "Your PM box");
define("MORE_THAN_2", "items found, displaying first");
define("MORE_SMILES", "More Emoticons");
define("MORE_THAN", "More than ");
define("MOVE_THREAD", "Move this thread to");
define("MSG_UP_SUCCESS", "Upload successful! The torrent has been added.");
define("MSG_DOWNLOAD_PID","PID system active get your torrent with your PID");
define("NA", "N/A");
define("NAME", "Name");
define("NEWS_TITLE","Title:");
define("NEWS_INSERT","Insert your news");
define("NEW_COMMENT", "Add your comment to ");
define("NEED_COOKIES", "Note: You need cookies enabled to log in.");
define("NEWS_PANEL", "News Panel");
define("NEXT", "Next");
define("NEW_COMMENT_T", "New Comment");
define("NEWS", "the news");
define("NEWS_DESCRIPTION","News:");
define("NOT_ADMIN_CP_ACCESS", "You're not authorized to access admin panel!");
define("NO_MESSAGES", "No PM found...");
define("NO_FORUMS", "No Forums found!");
define("NOW_LOGIN", "Now, you'll be prompted for login");
define("NO_PEERS", "No peers");
define("NOT_AUTHORIZED", "You're not authorized to view this");
define("NO_COMMENTS", "No comments...");
define("NOT_AUTH_DOWNLOAD", "You're not authorized to download. Sorry...");
define("NO_SHA_NO_UP", "File uploading not available - no SHA1 function.");
define("NOT_SHA", "SHA1 function not available. You need PHP 4.3.0 or better.");
define("NOT_AUTHORIZED_UPLOAD", "You're not authorized to upload!<br><br>Click <a class=altlink href=uploaderrequest.php>here</a> to request for be an Uploader!");
define("NO", "No");
define("NO_MAIL", "you have no new mail.");
define("NO_IP_WRITE", "You haven't wrote an IP address. Sorry!");
define("NO_NEWS", "no news");
define("NONE", "None");
define("NOT_AVAILABLE", "N/A");
define("NOT_ALLOW_DOWN", "is not allowed to download from");
define("NO_TOPIC", "No topics found");
define("NO_TORRENTS", "No torrents here...");
define("NO_BANNED_IPS", "There are no banned IPs");
define("NOBODY_ONLINE", "Nobody online");
define("NOT_AUTH_VIEW_NEWS", "You're not autorized to view the news!");
define("NEED_TO_BE_AN_MEMBER", "You're not autorized to view this, you need to be an member!<br>Please create an account for free!");
define("NOT_POSS_RESET_PID", "It's not possibile to reset your PID! <br />Contact an admin...");
define("NO_TORR_UP_USER", "No torrents uploaded by this user");
define("NO_USERS_FOUND", "no users found!");
define("OLD_PWD", "Old Password");
define("ONE_STAR", "1 star");
define("ONLY_REG_COMMENT", "Only registred users can insert comments!");
define("OPT_DB_RES", "Optimizing database result");
define("PASS_RESET_CONF", "password reset confirmation");
define("PEER_PROGRESS", "Progress");
define("PEER_COUNTRY", "Country");
define("PEER_PORT", "Port");
define("PEER_STATUS", "Status");
define("PEER_LIST", "Peer(s) List");
define("PEERS", "peer(s)");
define("PEER_ID", "Peer ID");
define("PEERS_DETAILS", "Click here to view peers details");
define("PEER_CLIENT", "Client");
define("PID", "PID");
define("PICTURE", "Picture");
define("PLEASE_WAIT", "Please Wait...");
define("PM", "PM");
define("POSTED_BY", "Posted by");
define("POSTS_PER_DAY", "%s posts per day");
define("POST", "Post");
define("POSTS_PER_PAGE", "Posts per page");
define("POSTED_DATE", "Posted on");
define("POSTS", "Posts");
define("POST_REPLY", "Post Reply");
define("PRIVATE_MSG", "Private Message");
define("PREVIOUS", "Prev.");
define("PWD_CHANGED", "Password changed!");
define("QUICK_JUMP","Quick Jump");
define("QUOTE", "Quote");
define("RATING", "Rating");
define("RATIO", "Ratio");
define("RECEIVER", "Receiver");
define("READED", "Read");
define("REMOVE", "Remove");
define("RETURN_TORRENTS", "Back to the torrent listing");
define("RECOVER_PWD", "Recover password");
define("RECOVER_TITLE","Recover lost user name or password");
define("RETRY", "Retry");
define("REACHED_MAX_USERS", "Maximum number of users reached<img src=images/smilies/hooray.gif><br/> Don't worry, you can still have an account by asking an existent user to send you an invite");
define("REDOWNLOAD_TORR_FROM", "Redownload torrent from");
define("RESULT", "Result");
define("REGISTERED_EMAIL", "Registered email");
define("REPLY", "Reply");
define("REDIRECT", "if your browser doesn't have javascript enabled, click");
define("RENAME_TOPIC", "Rename topic");
define("RECOVER_DESC","Use the form below to have your password reset and your account details mailed back to you.<br>( You will have to reply to a confirmation email. )");
define("REPLIES", "Replies");
define("SEARCH_AGAIN", "Search Again");
define("SEARCH", "Search");
define("SEARCH_HELP","Enter one or more words to search for.<br>Very common words and words with less than 3 characters are ignored.");
define("SEEDERS", "seed(s)");
define("SENDER", "Sender");
define("SEARCHED_FOR", "Searched for");
define("SENT_ERROR", "Sent Error");
define("SEEN", "Seen");
define("SHORT_S", "S"); //Shortname for Seeders
define("SHORT_L", "L"); //Shortname for Leechers
define("SHORT_C", "C"); //Shortname for Completed
define("SHOUTBOX", "ShoutBox");
define("SIZE", "Size");
define("SORRY", "Sorry");
define("SPEED", "Speed");
define("STYLE_SETTINGS", "Styles Settings");
define("STYLE_NAME", "Style Name");
define("STYLE_URL", "Style URL");
define("STICKY", "Sticky");
define("STYLE_MODIFIED", "Congratulations, style has been modified");
define("STYLE_ADD", "Add a new style");
define("STYLE_ADDED", "Congratulations, the style has been added");
define("STYLE_NOTE", "In this section you can manage your style settings, but you must upload files by ftp or sftp.");
define("SUBJECT", "Subject");
define("SUC_SEND_EMAIL", "A confirmation email has been mailed to");
define("SUC_SEND_EMAIL_2", "Please allow a few minutes for the mail to arrive.");
define("SUMADD_BUG", "Tracker bug calling summaryAdd");
define("SUC_POST_SUC_EDIT", "Post was edited successfully.");
define("SUBJECT_MAX_CHAR", "Subject is limited to ");
define("SUCCESS", "Success");
define("TABLE_NAME", "Table Name");
define("THREE_STAR", "3 stars");
define("TITLE", "Title");
define("TORRENTS_PER_PAGE", "Torrents per page");
define("TOPICS_PER_PAGE", "Topics per page");
define("TOP_10_DOWNLOAD", "Top 10 Downloaders");
define("TOPIC_UNREAD_POSTS","Topics with unread posts");
define("TOP_TORRENTS", "Most Popular Torrents");
define("TORRENT","Torrent");
define("TORRENTS", "torrent(s)");
define("TORRENT_FILE","Torrent File");
define("TORRENT_CHECK","Allow the tracker to retrieve and use information from the torrent file.");
define("TORRENT_ANONYMOUS","Send as anonymous");
define("TORR_PEER_DETAILS", "Torrent peers details");
define("TORRENT_DETAIL","Torrent's details");
define("TORRENT_STATUS", "Status");
define("TOP_10_UPLOAD", "Top 10 Uploaders");
define("TOP_10_SHARE", "Top 10 Best Sharers");
define("TOP_10_WORST", "Top 10 Worst Sharers");
define("TOP_10_ACTIVE", "10 Torrents Most active");
define("TOP_10_BEST_SEED", "10 Torrents Best Seeders");
define("TOP_10_WORST_SEED", "10 Torrents Worst Seeders");
define("TOPIC_NOT_FOUND", "Topic not found");
define("TOPIC", "Topic");
define("TORRENT_SEARCH", "Search Torrents");
define("TOPICS", "Topics");
define("TOP_10_BSPEED", "10 Torrents Best Speed");
define("TORRENT_UPDATE", "Updating, please wait...");
define("TOPIC_LOCKED", "This topic is locked; no new posts are allowed.");
define("TOP_10_WSPEED", "10 Torrents Worst Speed");
define("TRACKING", "tracking");
define("TRACK_DB_ERR", "Tracker/database error. The details are in the error log.");
define("TRACKER_LOAD", "Tracker Load");
define("TRACKER_SETTINGS", "Tracker's Settings");
define("TRAFFIC", "Traffic");
define("TRACKER_STATS", "Tracker Stats");
define("TRACKER_INFO", "$users users, tracking $torrents torrents ($seeds seeds e $leechers leechers, $percent%)");
define("TWO_STAR", "2 stars");
define("UCP_NOTE_1", "Here you can control your inbox, write PM to other users,");
define("UCP_NOTE_2", "Control and modify your settings, etc...");
define("UNAUTH_IP", "Unauthorized IP address.");
define("UNKNOWN", "unknown");
define("UPLOADER","Uploader");
define("UPDATE", "Update");
define("UPLOAD_IMAGE", "Upload Image");
define("UPLOADED", "Uploaded");
define("UPLOAD_LANGUAGE_FILE", "Upload Language File");
define("UPLOADS", "Uploads");
define("URL", "URL");
define("USER_LASTACCESS", "Last access");
define("USER_PASS_RECOVER", "Password/user recovery");
define("USER_JOINED", "Joined on");
define("USER_CP_1", "User Control Panel");
define("USER_EMAIL", "Valid email");
define("USER_CP", "My Panel");
define("USER_DETAILS", "User Details");
define("USER_STYLE", "Style");
define("USER_LANGUE", "Language");
define("USER_LEVEL", "Rank");
define("USERS_SEARCH", "Users Search");
define("USER_PWD_AGAIN", "Repeat password");
define("USER_PWD", "Password");
define("USER_NAME", "User");
define("USER_GROUPS", "Users Group Settings");
define("VIEW_EDIT_DEL", "View/Edit/Del");
define("VIEW_TOPIC", "View Topic");
define("VIEW_DETAILS", "View details");
define("VIEWS", "Views");
define("VIEW_UNREAD", "View Unread");
define("VOTE", "Vote!");
define("VOTES_RATING", "votes (rating");
define("WAIT_ADMIN_VALID", "You should wait for the administrator validation...");
define("WARNING", "Warning!");
define("WELCOME_ADMINCP", "Welcome to Admin Control Panel");
define("WELCOME_BACK", "Welcome back");
define("WELCOME", "Welcome");
define("WELCOME_UCP", "Welcome to your User Control Panel");
define("WORD_NEW", "New");
define("WORD_AND", "and");
define("WROTE", "wrote");
define("WRITE_CATEGORY", "You must specify the torrent category...");
define("X_TIMES", "time(s)");
define("YES", "Yes");
define("YOU_RATE", "you rated this torrent as");

define("SUB_CATEGORY","Sub-Category");
define("ACP_BLOCKS","Block Settings");
define("BLOCK","Block");
define("POSITION","Position");
define("SORTID","Sortid");
define("ACTIVE","Status");
define("BLOCKS_SETTINGS","Block Configuration");
define("LEFT","left");
define("RIGHT","right");
define("CENTER","center");
define("TOP","top");
define("WT","WT");
define("GROUP_WT","Waitingtime if Ratio <1");
define("ACP_POLLS","Poll Settings");
define("POLLS_SETTINGS","Poll Configuration");
define("POLLID","Pollid");
define("QUESTION","Question");
define("VOTES","Votes");
define("ACTIVATED","Active");
define("INSERT_NEW_POLL","Add new Poll");
define("CANT_FIND_POLL","Can't find poll");
define("ADD_NEW_POLL","Add Poll");
define("OPTION","Option");
define("UPFAILED","Upload Failed");
define("DELFAILED","Delete Failed");
define("TIMEZONE", "Timezone");
define("FRM_PREVIEW","Preview");
define("COMMENT_PREVIEW","Comment's Preview");
define("USER_LOCAL_TIME","User's Local Time");
define("GO_BACK","Go Back");
define("TORRENT_REQUESTED", "Requested");
define("TORRENT_NUKED", "Nuked");
define("TORRENT_NUKED_REASON", "Reason");
define("REQUESTS", "Requests");
define("SORT_BY", "Sort By");
define("REQ_BLOCK_NAME", "Name");
define("REQ_BLOCK_CAT", "Cat");
define("REQ_BLOCK_DATE", "Date");
define("REQ_BLOCK_BY", "By");
define("REQ_BLOCK_FILLED", "Filled");
define("REQ_BLOCK_VOTES", "Votes");
define("REQUEST_BLOCK_NAME", "Request&nbsp;name");
define("REQUEST_BLOCK_CAT", "Request&nbsp;category");
define("REQUEST_BLOCK_ADDED", "Request&nbsp;added");
define("REQUEST_BLOCK_BY", "Requested&nbsp;by");
define("REQUEST_BLOCK_FILLEDBY", "Request&nbsp;filled&nbsp;by");
define("REQUEST_BLOCK_VOTE", "Request&nbsp;votes");
define("REQUEST_BLOCK_DETAILS", "Request&nbsp;details");
define("ADMIN_CONTROLS", "Admin Controls");
define("USERCOMMENT", "User Comment:");
define("HELPED_FOR", "Helped For:");
define("WHAT_ABOUT" ,"What is this about?");
define("OPTION" ,"Option");
define("POINTS" ,"Points");
define("EXCHANGE" ,"Exchange");
define("BONUS_DESC","If you reach the points for this case, you can exchange these points on the fly into traffic, we take off the points and you receive the traffic.");
define("BONUS_INFO1","Here you can exchange your Seeder-Bonus (current ");
define("BONUS_INFO2","(If the buttons deactivated, you have not enough to trade!");
define("BONUS_INFO3","For what I get points?<br>You receive for every hour the system is registering you as a seeder 1 point.");
define("SEED_BONUS", "Seed Bonus");
define("CUSTOM_TITLE", "Custom title");
define("NO_CUSTOM_TITLE", "no custom title available for this user");
define("REGISTRATION_OFFLINE", "Sorry<br>Registrations are currently closed, please check back later.");
define("PAYPAL", "PayPal");
define("MNU_DONATE", "Donations");
define("PAYPAL_INSERT_NEW", "Insert new PayPal button");
define("INSERT_NEW_DONATOR", "Insert new Donator");
define("DONATION", "Donation Amount");
define("YTD_DONATION", "Total Donation's By This User");
define("DONATION_SETTINGS", "Donation Setting's");
define("EDIT_DONATOR", "Edit Donator");
define("DONATOR_MODIFIED", "Congratulations, Donator has been modified");
define("DONATOR_ADD", "Add a new Donator");
define("DONATOR_NAME", "Donator's Name");
define("PAYPAL_DONATION", "Donated Funds");
define("PAYPAL_YTD_DONATION", "Total Donated Funds");
define("ERR_ACCOUNT_DISABLED", "Error: This account has been Disabled !");
define("ONE_WEEK", "1 week");
define("TWO_WEEKS", "2 weeks");
define("THREE_WEEKS", "3 weeks");
define("FOUR_WEEKS", "4 weeks");
define("PERMANENTLY", "unlimited");
define("ACP_WARNEDU", "Active Warnings");
define("DISABLE_ACCOUNT", "Account disabled");
define("ENABLE_ACCOUNT", "Account enabled");
define("WARN_FALSE", "False");
define("WARN_TRUE", "True");
define("WARN_CONFIRM", "Are you sure you want to Warn this user ?");
define("WARN_REMOVE", "Are you sure you want to remove this Warn ?");
define("WARN_LEVEL_RESET", "Reset the Warn Level for this user ?");
define("WARN_DISABLE_ACCOUNT", "Are you sure you want to Disable this account ?");
define("WARN_ENABLE_ACCOUNT", "Are you sure you want to Enable this account ?");
define("WARNED_USERS", "Warned users");
define("ACP_DISABLEDU", "Disabled Accounts");
define("DISABLED_WARNS", "Warns");
define("DISABLED_ON", "On");
define("DISABLED_BY", "By");
define("DISABLED_ACTIVE", "Disabled");
define("DISABLED_NO_USERS", "There are no Disabled accounts at this time");
define("DISABLED_USERS", "Disabled Users");
define("USER_WARNED", "This user has been warned. For more details see the FAQ");
define("USER_DISABLED", "This account has been disabled. For more details see the FAQ");
define("WARNED_ID", "ID");
define("WARNED_USERNAME", "Username");
define("WARNED_TOTAL_WARNS", "Total Warns");
define("WARNED_DATE_ADDED", "Date added");
define("WARNED_EXPIRATION", "Expiration date");
define("WARNED_DURATION", "Duration");
define("WARNED_REASON", "Reason");
define("WARNED_BY", "Warned by");
define("WARNED_ACTIVE", "Active");
define("WARNED_NO_USERS", "There are no warned users at this time.");
define("WARNED_UNLIMITED", "Unlimited warn");
define("WARNED_WEEK", " week warn");
define("WARNED_WEEKS", " weeks warn");
define("WARNED_USER_NOTWARNED", "This user has no standing warnings.");
define("ACP_PREVWARNEDU", "Inactive Warnings");
define("PREV_WARNED_USERS", "Previously Warned Users");
define("PREV_REACHED_MAX", "Reached max. warns");
define("PREV_NO_USERS", "There are no Previously Warned Users");
define("REPORT_CLICK", "Click");
define("APARKED", "Account Parked");
define("VOTE_FOR_THIS", "Vote For This");
define("REQUEST", "Request");
define("INFO", "Info");
define("REQUEST_OFFLINE", "The Request Section Is Current Offline");
define("ADD_REQUESTS", "Add Request");
define("DATE_ADDED", "Date Added");
define("ADDED_BY", "Added By");
define("FILLED_BY", "Filled By");
define("FILLED", "Filled");
define("TYPE", "Type");
define("INC_DEAD", "Included Dead");
define("MAKE_REQUEST", "Make Request");
define("DISPLAY", "Display");
define("ADDED_TO_FRIENDLIST", "Added to friend list");
define("MEMBER_ALREADY_EXIST", "Member already exist.");
define("MEMBER1", "The member");
define("ADDED_TO_YOUR_FRIENDLIST", "have got added to your friend list.");
define("HERE", "here");
define("TO_VIEW_FRIENDLIST", "to see your friends.");
define("RETURN_USERS", "Back to members list");
define("FRIENDLIST", "Friend List");
define("NOTHING_IN_FRIENDLIST", "Friend list empty");
define("ADD_TO_FRIENDLIST", "Add to friend list");
define("USER_ONLINE", "Member on line");
define("USER_OFFLINE", "Member off line");
define("FRIEND_REPORT", "Add Friend/Report User");
define("GENDER", "Gender");
define("MALE" ,"Male <img border=0 src=images/male.gif>");
define("FEMALE" ,"Female <img border=0 src=images/female.gif>");
define("AGE", "Age");
define("USER_ALREADY_EXISTS", "User Already Exist");
define("NFORCE", "Nforce");
//Personal Notepad Hack Start
define("NOTE_ADD_NEW", "Add new personal note");
define("NOTE_DATETIME", "Date/Time");
define("NOTE_DEL_ERR", "You must select at least one note to delete.");
define("NOTE_EDIT", "Edit");
define("NOTE_EDIT_ERROR", "You shouldn't try to edit other people's notes !");
define("NOTE_ID", "ID");
define("NOTE_NOTE", "Note");
define("NOTE_VIEW", "Read");
define("NOTE_READ_ERROR", "You shouldn't try to read other people's notes !");
define("NOTE_VIEW_MORE", "View more notes");
define("NOTE_NOTEPAD", "Notepad");
//Personal Notepad hack Stop
define("SNATCHERS", "Snatchers");
//EXPECTED HACK
define("INC_DEAD", "Inc. dead");
define("ADD_EXPECTED", "Add a new expected torrent");
define("EXPECTED", "Expected");
define("VIEW_MY_EXPECTED", "View my expected torrents");
define("VIEW_ONLY", "View Only");
define("FIND_EXPECT", "Find");
define("GO", "Go");
define("NO_NAME", "No Name!");
define("NO_DESCR", "Description Empty!");
define("EXP_ADD_SUCCES", "was added to the Expected section");
define("MUST_SEL_EXP", "You must select at least one request to delete.");
define("DELETED", "Deleted");
define("RETURN_EXPECT", "Go back to ");
define("DATE_EXPECTED", "Date expected");
//EXPECTED HACK END
//Change Nick
define("CHANGE_NICK", "Change your nickname");
define("PLEASE_LOGIN", "You must login");
define("ERR_MUST_LOGIN", "You must <a href='login.php'>Login</a> to access this page");
define("CURR_NICK", "Current nickname");
define("NEW_NICK", "New nickname");
define("REPEAT_NICK", "Repeat nickname");
define("NICK_NO_MATCH", "Nicknames don't match");
define("ERR_SAME_NICK", "Your nickname is already");
define("ERR_NICK_TOO_SMALL", "Your new nickname must be at least 3 characters in length");
define("ERR_NICK_NOT_ALLOWED", "This nickname is not permitted to be used");
define("CONGRATS", "Congratulations");
define("NICK_CHANGE_SUCCESS", "You have successfully changed your nickname to ");
//Change Nick End
define("MNU_EPISODES", "Episodes");
//Start Make members verify their email if they change it
define("REVERIFY_MSG", "If you attempt to change your email address you will be sent a verification link to the email address you wish to change it to.<br /><br /><font color=red><strong>The email address on your record will not update until you verify the new address by clicking the link.</strong></font>");
define("EMAIL_VERIFY", "email account update at $SITENAME");
define("EMAIL_VERIFY_BLOCK", "Verification email sent");
define("EMAIL_VERIFY_MSG", "Hello,\n\nThis email has been sent because you have requested a change to the email address currently held on your record, please click the link below to complete the change.\n\nBest regards from the staff.");
define("EMAIL_VERIFY_SENT1","<br /><center>A verification email has been sent to:<br /><br /><strong><font color=red>");
define("EMAIL_VERIFY_SENT2", "</font></strong><br /><br />You will need to click on the link contained within the email in order<br />to update your email address. The email should arrive within 10 minutes<br />(usually instantly) although some email providers may mark it as SPAM<br />so be sure to check your SPAM folder if you can't find it.<br /><br />");
define("REVERIFY_CONGRATS1", "<center><br />Congratulations, your email has been verified and successfully changed<br /><br /><strong>From: <font color=red>");
define("REVERIFY_CONGRATS2", "</strong></font><br /><strong>To: <font color=red>");
define("REVERIFY_CONGRATS3", "</strong></font><br /><br />");
define("REVERIFY_FAILURE", "<center><br /><strong><font color=red><u>Sorry but this url is not valid</u></strong></font><br /><br />A new random number is generated each time you attempt to change your email so<br />if you're seeing this message then you've most likely tried to change your email<br />more than once and you are using an old url.<br /><br /><strong>Please wait until you're absolutely sure you haven't received the new<br />verification email before attempting to change your email again.</strong><br /><br />");
define("NOT_MAIL_IN_URL", "This is not the email address that was in this url");
define("MUST_ENTER_PASSWORD", "<br /><font color='#FF0000'><strong>You must enter your password to change the settings above.</strong></font>");
define("ERR_PASS_WRONG", "Password empty or incorrect, cannot update profile.");
//End Make members verify their email if they change it 
define("SEEDBONUSEDITOR", "Seedbonus Editor");
define("SEED_CLICK", "Change bonus");
define("SEEDBONUS_EDITOR", "Seedbonus Editor");
// blackjack start
define("BLACKJACK", "BlackJack");
define("SORRY", "sorry");
define("MUST_UPLOAD", "You didn't uploaded");
define("RATIO_GREAT_THAN", "Your ratio is lower than");
define("WAIT_SOMEONE_PLAYS", "You'll have to wait until someone plays against you.");
define("FINISH_OLD_GAME", "You must finish yor old game before.");
define("FRM_CONTINUE", "Continue");
define("YOU_LOST", "You lost");
define("YOU_WON", "You won");
define("NOBODY_WON", "Nobody won");
define("TO", "to");
define("YOU_HAVE", "you had");
define("HE_HAVE", "he had");
define("HAD", "had");
define("YOUR_OPPONENT", "Your opponent was");
define("END_GAME", "End game.");
define("NO_PLAYERS", "there's no other players, so you'll have to wait until someone will play against you. You will be PM'd about game results.");
define("FROM", "from");
define("FRM_STOP", "Stop");
define("GAME_RULES", "<h3>Rules</h3>You must colect 21 points.");
define("FRM_PLAY", "Play");
define("POINTS", "points");
define("GAMES", "Games");
define("PROFIT", "Profit (Go)");
define("REQUIRED_RATIO", "Required ratio");
// blackjack ends
// PHP EDITOR
define("PHP_CHANGE", "Change file");
define("PHP_PRESENT", "File at the moment");
define("PHP_OPEN", "Open");
define("PHP_CLOSE", "Close");
define("PHP_REFRESH", "Refresh");
define("PHP_SAVE", "Save");
define("PHP_RESET", "Reset");
define("PHP_BACK", "Back");
define("PHP_NOT_SAVED", "has not been saved");
define("PHP_SHOW_HIGHLIGHT", "PHP highlights");
define("PHP_CLOSE_HIGHLIGHT", "Hide highlights");
define("PHP_DELETE", "Delete");
define("PHP_WATCH", "Watch");
define("PHP_DELETE_SUCCES", "has been deleted!");
define("PHP_DELETE_FAILED", "has not been deleted!");
define("PHP_SAVE_TIME", "has been saved at:");
define("PHP_NOT_SAVED_YET", "has not beed saved yet!");
define("PHP_FILE", "File name (also type .php)");
// PHP Editor Ends
//Lottery Start
define("LOT_SETTINGS", "Lottery Settings");
define("EXPIRE_DATE", "Expire date ");
define("EXPIRE_DATE_VIEW", "(00-00-0000 00:00 must be this format)");
define("IS_SET", "is current date and time)");
define("NUM_WINNERS", "Number of winners");
define("TICKET_COST", "Amount to pay( per ticket)");
define("MIN_WIN", "Min Amount to win");
define("LOTTERY_STATUS", "Lottery enabled");
define("UPDATE", "Update");
define("VIEW_SELLED", "View Selled Tickets");
define("NOT_USER_CLASS", "<h1>Sorry</h1><p>You must be Registered to request, see the <a href=faq.php><b>FAQ</b></a> for information on different user classes, staff cannot buy tickets</p>");
define("CANNOT_SELL", "Sorry I cannot sell you any tickets!");
define("PURCHASE_SUCCES", "Purchase was Succesfull");
define("PURCH_MSG1", "You just purchased ");
define("PURCH_MSG2", " ticket(s)!");
define("PURCH_MSG3", "Your new total is ");
define("PURCH_MSG4", "Your new upload total is ");
define("PURCH_MSG5", "You are being forwarded to the tickets page!");
define("YOUR_TICKETS", "Your buyed tickets");
define("NO_TICKET_SOLD", "No tickets sold");
define("ID", "Id");
define("USERNAME", "Username");
define("NUMBER_OF_TICKETS", "Number of tickets");
define("RESET", "Reset");
define("NEED_UPLOAD", "You must have uploaded atleast 100 MB in order to buy a ticket!");
define("TICK_MSG1", "Tickets are non-refundable");
define("TICK_MSG2", "Each ticket costs ");
define("TICK_MSG3", " which is taken from your upload amount");
define("TICK_MSG4", "Purchaseable shows how many tickets you can afford");
define("TICK_MSG5", "You can buy upto your purchaseable amount but do note your upload value will then be less then 100 Mb and you might be banned");
define("TICK_MSG6", "The competiton will end at ");
define("TICK_MSG7", "There will be ");
define("TICK_MSG8", "they will get each ");
define("TICK_MSG9", " added to their upload amount");
define("TICK_MSG10", "The winners will be announced the following day and posted on the news page");
define("TICK_MSG11", "The more tickets that are sold the bigger the pot will be!");
define("TICK_MSG12", "You own ticket numbers: ");
define("TICK_MSG13", "Good Luck!");
define("TOTAL_IN_POT", "Total in pot");
define("TOTAL_TICKETS_SELLED", "Total Tickets Purchased");
define("YOUR_TICKETS", "Tickets Purchased by You");
define("PURCHASEABLE", "Purchaseable");
define("COMP_CLOSED", "Competition is now closed!");
define("TICKETS", "tickets");
define("PURCHASE", "Purchase");
define("VIEW_LAST_WINNERS", "View Last Winners");
define("YOUR_TICKETS", "Your Tickets");
define("WINDATE", "Win Date");
define("PRICE", "Price");
define("VIEW_WINNERS", "View Lottery Winners");
define("SOLD_TICKETS", "Tickets Sold");
define("NO_WINNERS_YET", "No winners yet");
define("MAX_PURCHASE", "The max number of tickets you can purchase is ");
define("MAX_BUY", "Maximun amount user can buy");
//Lottery Ends
//Invite Hack Start
define("MNU_UCP_INVITATIONS", "Invitations");
define("INVITATIONS", "Invitations");
define("MEMBERS_INVITED_BY", "Members invited by ");
define("SEND_INVITE", "Send an invite to a friend");
define("REMAINING", "Remaining");
define("CURRENT_INVITES_CONFIRMED", "Current status of invites confirmed");
define("NO_INVITES_YET", "No invites yet");
define("STATUS", "Status");
define("CONFIRMED", "Confirmed");
define("INVITES_NEED_CONFIRM", "Invites needing confirm");
define("CURRENT_INVITES_NEED_CONFIRM", "Current status of invites needing confirm");
define("NO_NEED_CONFIRM_YET", "No invites to confirm yet");
define("PENDING", "Pending");
define("INVITES_OUT", "Invites sended");
define("SEND_DATE", "Send date");
define("CURRENT_INVITES_OUT", "Current status of invites sended");
define("NO_INVITES_OUT", "No invites send yet");
define("INVITE_SOMEONE_TO", "Invite someone to join $SITENAME");
define("INVITATION", "Invitation");
define("MESSAGE", "Message");
define("INVALID_INVITE", "Invite invalid");
define("ERR_INVITE", "Hey! You aren't invited. Bugger off....");
define("WELCOME_INVITE", "Welcome! You have accepted an invitation from one of our users. You can now register.");
define("EMAIL_INVALID", "E-mail invalid !");
define("ERR_MISSING_DATA", "Missing informations !");
define("INSERT_EMAIL", "You need to submit an email address !");
define("INSERT_MESSAGE", "Please add a personal message !");
define("INVITE_EMAIL_SENT1", "A confirmation email has been sent to the address you specified");
define("INVITE_EMAIL_SENT2", "You will need to wait until your inviter confirms your account.");
define("INVITE_EMAIL_SENT3", "A email has been sent to the address you specified");
define("INVITE_EMAIL_SENT4", "Good luck and have fun on $SITENAME !");
define("PASSWORD_NOT_USERNAME", "Sorry, password cannot be same as user name.");
define("ERR_IP_ALREADY_EXISTS", "This IP is already in use.");
define("ACCOUNT_CONFIRMED", "Account Confirmation");
define("INVIT_CONFIRM", "Invitation Confirmation");
define("REG_CONFIRM", "Registration Confirmation");
define("VALID_INV_MODE", "Need confirm the invite");
define("NO_INV", "You don't have more invites, sorry.");
define("INVITE_TIMEOUT", "Dead time for invites<br />( on days )");
define("INVITES_OFF", "Invites aren't enable");
define("INVIT_MSGCONFIRM", "Hello,\n\nYour account has been confirmed. You can now visit\n\n$BASEURL/login.php\n\nand use your login information to login in. We hope you'll read the FAQ's and Rules before you start sharing files.\n\nGood luck and have fun on $SITENAME !\n\n\n----------------\nIf you did not register for $SITENAME, please forward this email to $SITEEMAIL");
define("INVIT_MSG_AUTOCONFIRM", "You have requested a new user account on $SITENAME and you have\nspecified this address (");
define("INVIT_MSG_AUTOCONFIRM1", ") as user contact.\n\nAccount info:\nUsername:");
define("INVIT_MSG_AUTOCONFIRM2", "Password:");
define("INVIT_MSG_AUTOCONFIRM3", "----------------\nYou can now visit\n\n$BASEURL/login.php\n\nand use your login information to login in. We hope you'll read the FAQ's and Rules before you start sharing files.\n\nGood luck and have fun on $SITENAME !\n\n\n----------------\nIf you did not register for $SITENAME, please forward this email to $SITEEMAIL");
define("INVIT_MSG", "Hello,\n\nYou have been invited to join the $SITENAME community by");
define("INVIT_MSG1", "If you want to accept this invitation, you'll need to click this link:\n\n\n$BASEURL/account.php?invitenumber=");
define("INVIT_MSG2", "You'll need to accept the invitation within 24 hours, or else the link will become inactive.\nWe on $SITENAME hope that you'll accept the invitation and join our great community!\n\nPersonal message from");
define("INVIT_MSG3", "----------------\nIf you do not know the person who has invited you, please forward this email to $SITEEMAIL");
define("INVIT_MSGINFO", "You have requested a new user account on $SITENAME and you have\nspecified this address (");
define("INVIT_MSGINFO1", ") as user contact.\n\nYour account is awaiting confirmation from your inviter.\nAs long as your account isn't confirmed, you can't login to the site.\n\nAccount info:\nUsername:");
define("INVIT_MSGINFO2", "Password:");
define("INVIT_MSGINFO3", "If your account isn't being confirmed within 24 hrs, your account will be deleted.\nPlease read the RULES and FAQ before you start using $SITENAME.\n----------------\nIf you did not register for $SITENAME, please forward this email to $SITEEMAIL");
define("ACTIVE_INVITES", "To activate the invitations  :");
define("PRIVATE_TRACKER", "Private Tracker :");
define("PRIVATE_TRACKER_INFO", "For a safety acrue, if you put your site into private, please also put to the option  \"Max Users (numeric, 0 = no limits)\" at  \"1\" !");
define("ONLY_INVITES", "Only on invitation.");
//Invite Hack Ends
define("BAN_MAILS_INFO", "Theses e-mails are unauthaurized in this web site.<br>But you can disban it");
define("NO_BAN_MAILS", "No banned e-mails");
define("ACP_BAN_MAILS", "Ban e-mails");
define("WAS_BANNED_ALLREADY", "already banned !!");
define("BANNED", "banned !!");
define("NEW_BANNED_MAILS", "new e-mails.");
define("SYSTEM", "System");
define("EMAIL_BANNED", "This e-mail was banned from this web site.");
define("BAN_CHEAPMAIL", "Ban Cheapmail Domains");
define("DOMAIN_BANNED", "No disposable E-Mail Accounts allowed. (Hotmail etc.) Use a real E-Mail Account.");
define("ERR_WILDCARD_1", "The wildcard ");
define("ERR_WILDCARD_2", " is already on the list of Cheapmail Domains so there is no need to add ");
define("ERR_WILDCARD_3", " to the list.");
define("CHEAP_CONFIRM_1", "Are you sure you want to delete ");
define("CHEAP_CONFIRM_2", "You will receive no further confirmations");
define("CHEAP_DELETED_1", " has been deleted");
define("CHEAP_DELETED_2", "Click Here");
define("CHEAP_DELETED_3", " to return");
define("ERR_CHEAP_SUBMIT", "You must enter a value in the Text Box!!");
define("CHEAP_ADDED", " was added to the list of Cheapmail Domains");
define("ERR_CHEAP_DUPE", " is already on the list of Cheapmail Domains");
define("CHEAP_CURRENT", "Current Cheapmail domains");
define("ADDED_BY", "Added by");
define("CHEAP_COUNT_1", "Found ");
define("CHEAP_COUNT_2", " Cheapmail Domains");
define("CHEAP_ADD", "Add Cheapmail Domain:");
define("UNCONFIRMED_ACCOUNTS", "Unconfirmed Accounts");
define("IMPORT_ERROR","\$SBX['import'] is set to false you will need to edit config by hand and set it to \"t\" if you really wanna import chat.php!");
define("SHOUTMINI","SBmini");
define("SHOUTACP","SBAdmin");
define("SHOUTDIS","Warning Shoutbox is currently disabled!");
define("SHOUTDIS_PUBLIC","Shoutbox is currently disabled, please try again later");
define("SHOUT","Shout it!");
define("NO_MSG","No shout found!");
define("NO_USER","You didnt set a username");
define("NO_DEL","You cant Delete another members shout!");
define("NO_EDIT","You coant Edit another members shout!");
define("SHOUTBOX_NOPREM","You dont have permission to view the shoutbox!");
define("NO_ACC","Access Denied");
define("SHOUT_MAIN","Please use main shout to post");
define("INFOSITE","Homepage");
define("SCREEN","Screenshot");
define("VIDEO","Video");
define("DD","Demo Download");
define("FORUM_CATS", "Forum Catagories");
define("CAT_NAME", "Catagory Name");
define("CAT_NAME2", "Catagory");
define("CAT_MIN_VIEW", "Min Class View");
define("SORT_ORDER", "Sort Order");
define("CAT_DEL_ERROR", "You can't delete a catagory that has forums in it.");
define("SCENE_RELEASE","Scene Release");
define("USER_EMAIL_AGAIN", "Email again");
define("DIF_EMAILS", "The emails don't match!");
define("GENRE","Genre");
define("ADDREMOVESTAT", "Add or Remove Stat");
define("INVITED_BY", "Invited By");
define("IMDB", "Imdb Info");
define("ERR_PM_GUEST","Sorry you can't send PM to guest, system or to yourself!");
define("USER_ID", "User ID");
// added by cybernet 
// works on every PB 1.5.4 Edition
// updated on 1243372881
// 2009-05-26 21:21:21
// block for Wanted Seeders - found in /blocks/seedwanted_block.php
define("CF_SEEDER_WANTED", "Seeder Wanted");
// Connectable - found in /userdetails.php
define("CF_CONNECTABLE", "Connectable");
// Port - found in /userdetails.php
define("CF_PORT", "Port:");
// User Signature - found in /userdetails.php
define("CF_SIGNATURE", "Signature:");
// Staff Info - found in /userdetails.php
define("CF_STAFF_INFO", "Staff Info");
// Upload Speed - found in /userdetails.php
define("CF_UPLOAD_SPEED", "Upload Speed");
// Download Speed - found in /userdetails.php
define("CF_DOWNLOAD_SPEED", "Download Speed");
// User Not in staff - found in /userdetails.php
define("CF_USER_NOT_IN_STAFF", "<i>This user is not in Staff</i>");
// Report this user - found in /userdetails.php
define("CF_REPORT_THIS_F_USER", "  Report User");
// Warning Stats - found in /userdetails.php
define("CF_WARNING_STATS", "Warning Stats");
// Total number of Warnings - found in /userdetails.php
define("CF_TOTAL_NUMBER_OF_WARNINGS", "Total number of Warnings");
// Latest warning removed by - found in /userdetails.php
define("CF_LATEST_WARNING_REMOVED_BY", "Latest warning removed by");
// Latest warning reason - found in /userdetails.php
define("CF_LATEST_WARNING_REASON", "Latest warning reason");
// Unlimited warn - found in /userdetails.php
define("CF_UNLIMITED_WARN", "Unlimited warn");
// 1 week warn - found in /userdetails.php
define("CF_ONE_WEEK_WARN"," week warn");
// More than 1 week warn - found in /userdetails.php
define("CF_MORE_THAN_ONE_WEEK_WARN"," weeks warn");
// Current Warning duration - found in /userdetails.php
define("CF_WARNING_DURATION", "Current Warning duration");
// Warn permanent - found in /userdetails.php
define("CF_PERMANENT_WARN", "This type of warning doesn't have a time frame. It's permanent<img border=0 src=images/smilies/laugh.gif>");
// Current Warning period - found in /userdetails.php
define("CF_WARNING_PERIOD", "Current warning period");
// Current Warning reason - found in /userdetails.php
define("CF_WARNING_REASON", "Current Warning reason");
// Current warn by - found in /userdetails.php
define("CF_CURRENT_WARN_BY", "Current warn by");
// Account Disabled - found in /userdetails.php
define("CF_ACCOUNT_DISABLED", "Account Disabled");
// Account Disabled by - found in /userdetails.php
define("CF_DISABLED_BY", "Disabled by");
// Account Disabled on - found in /userdetails.php
define("CF_DISABLED_ON", "Disabled on");
// Account Disabled reason - found in /userdetails.php
define("CF_DISABLED_REASON", "Disable reason");
// Warn Level - found in /userdetails.php
define("CF_WARN_LEVEL", "Warn Level");
// Admin Controls - found in /userdetails.php
define("CF_ADMIN_CONTROLS","Admin Controls");
// Send invites - found in /userdetails.php
define("CF_SEND_INVITES", "Send Invites");
// Send invites click - found in /userdetails.php
define("CF_SEND_INVITES_CLICK","To send invites click ");
// Support for - found in /userdetails.php
define("CF_SUPPORT_FOR","Support for");
// Reset Warn Level - found in /userdetails.php
define("CF_RESET_WARN_LEVEL", "Reset Warn Level<img border=0 src=images/smilies/angel.gif>");
// Remove Warn - found in /userdetails.php
define("CF_REMOVE_WARN","Remove Warn");
// Active Torrents - found in /userdetails.php
define("CF_ACTIVE_TORRENTS", "Active torrents");
// Uploaded Torrents - found in /userdetails.php
define("CF_UPLOADED_TORRENTS_ON_USER_PAGE", "Uploaded Torrents");
// History ( snatched torrents ) - found in /userdetails.php
define("CF_SNATCHED_TORRENTS", "History ( snatched torrents )");
// No Active torrents for this user - found in /userdetails.php
define("CF_NO_ACTIVE_TORRENTS_FOR_THIS_USER", "No Active torrents for this user");
// No History for this user - found in /userdetails.php
define("CF_NO_HISTORY_FOR_THIS_USER","No History for this user");
// Donate  - found in /blocks/paypal_block.php
define("CF_DONATE", "Donate");
// Latest Member  - found in /blocks/lastmember_block.php
define("CF_LATEST_MEMBER", "Latest Member");
// Welcome to our Tracker - found in /blocks/lastmember_block.php
define("CF_WELCOME", " Welcome to our Tracker ");
// Invite A Friend - found in /blocks/invite_block.php
define("CF_INVITE_A_FRIEND", "Invite A Friend");
// Send Invitation - found in /blocks/invite_block.php
define("CF_SUBMIT_INVITE", " Send Invitation ");
// Your Name - found in /blocks/invite_block.php
define("CF_INVITE_NAME", "Your Name");
// Friends Name - found in /blocks/invite_block.php
define("CF_FRIENDS_NAME", "Friends Name");
// Friends Email - found in /blocks/invite_block.php
define("CF_FRIENDS_EMAIL", "Friends Email");
// Reports - found in /blocks/mainusertoolbar_block.php
define("CF_REPORTS", "Reports");
// WishList - found in /blocks/mainusertoolbar_block.php
define("CF_WISHLIST", "WishList");
// Member Statistics - found in /blocks/online_block.php
define("CF_MEMBER_STATS", "Member Statistics");
// Total Members - found in /blocks/online_block.php
define("CF_TOTAL_MEMBERS", "Total Members");
// Members Online Today - found in /blocks/online_block.php
define("CF_MEMBERS_ONLINE_TODAY", "Members Online Today");
// Total Users: - found in /blocks/online_block.php
define("CF_MEMBERS_ACTIVE_TODAY", "Total Users:");
// Helpdesk - found in /blocks/mainmenu_block.php
define("CF_HELPDESK", "Helpdesk");
// Is already your friend, you're starting to look like a gay - found in /friendlist.php
define("CF_FRIEND_ALREADY_EXIST", "Is already your friend, you're starting to look like a gay");
// - found in /seedbonus.php - ln 85
define("CF_SEED_BONUS_1", "If you reach the points for this case, you can exchange these points on the fly into - 10 GB Download, we take off the points and you receive the - 10 GB Download.");
// - found in /seedbonus.php - ln 76
define("CF_SEED_BONUS_2", "If you reach the points for this case, you can exchange these points on the fly into invite, we take off the points and you receive the invite.");
// - found in /seedbonus.php - ln 76
define("CF_SEED_BONUS_3", "One Invite");
// - found in /seedbonus.php - ln 90
define("CF_GIVE_SEED_BONUS", "Give Seed Bonus Points");
// - found in /seedbonus.php - ln 92
define("CF_2_USER", "To User:");
// - found in /seedbonus.php - ln 100
define("CF_CHANGE_C_TITLE", "Change Custom Title (Cost: 500 ");
// - found in /seedbonus.php - ln 96
define("CF_ANONYMOUS", "Send as Anonymous");
// - found in /details.php - ln 488
define("CF_THANKS", "Thanks:");
// - found in /details.php - ln 497
define("CF_SAY_THANKS", "Say Thanks!");
// - found in /details.php - ln 575
define("CF_USER_ONLINE", "User is online <img src=images/online.gif border=0>");
// - found in /details.php - ln 578
define("CF_USER_OFFLINE", "User is offline <img src=images/offline.gif border=0>");
// - found in /details.php - ln 480 & 477
define("CF_STATISTIC", " Statistic: ");
// - found in /details.php - ln 477
define("CF_NOT_AVAILABLE", "Not available!");
// - found in /details.php - ln 447
define("CF_RESEED_REQUEST", "Request Reseed:");
// - found in /details.php - ln 173
define("CF_VIEW_NFO", "View NFO");
// - found in /details.php - ln 111 & 109
define("CF_ADD_2_WISH_LIST", "| Add to wishlist");
// - found in /details.php - ln 109 & 111
define("CF_REPORT_THIS_TORRENT", "Report this torrent |");
// - found in /details.php - ln 379
define("CF_SHOW_HIDE", "Show/Hide Files: ");
// - found in /admininvite.php - ln 37
define("CF_INVITES_WARNING", "<center><span style='color:red'>Warning: The form bellow will update number of invites, example if you write 5, the user will have 5 invites.</span></center>");
// - found in /admininvite.php - ln 12
define("CF_SEND_INVITES","Send invites");
// - found in /torrents.php - ln 571
define("CF_OPTIONS", "Options: ");
// - found in /details.php - ln 587
define("CF_AT", " at ");
// - found in /details.php - ln 587
define("CF_SHIT", " <font color=red>|||</font> ");
// - found in /viewrequests.php - ln 50
define("CF_AVAILABLE_REQUEST", "Available Requests for ");
// - found in /viewrequests.php - ln 50
define("CF_POSTED_REQUESTS", " Posted Requests: ");
// - found in /viewrequests.php - ln 50
define("CF_REMAINING", " Remaining: ");
// - found in /viewrequests.php - ln 52
define("CF_ADD_NEW_REQUESTS", "Add New Request");
// - found in /viewrequests.php - ln 52
define("CF_VIEW_MY_REQUESTS", "View my requests");
// - found in /viewrequests.php - ln 53
define("CF_HIDE_FILLED_REQUESTS", "Hide Filled Requests");
// - found in /viewrequests.php - ln 144
define("CF_NO_RESULTS_SEARCH_FOUND", "No results that match your search criteria were found...");
// - found in /viewrequests.php - ln 200
define("CF_NOBODY", "Nobody");
// - found in /viewrequests.php - ln 215
define("CF_DELETE_THEM", "Delete Them");
// - found in /requests.php - ln 65
define("CF_REQUEST_NAME", "Name of request");
// - found in /addrequest.php - ln 18
define("CF_ALREADY_VOTED_4_REQUEST", "You've already voted for this request, only 1 vote for each request is allowed");
// - found in /addrequest.php - ln 19
define("CF_SUCC_VOTED_4_REQUEST", "Successfully voted for request");
// - found in /index.php - ln 29
define("CF_NO_GUEST_ACCESS", "You are not authorized to view this page");
// - found in /index.php - ln 34
define("CF_LOGIN_2_ACCESS_TRACKER", "<center><span style='color:red'>Please <a href='login.php'>Login</a> to view this page</span></center>");
?>
