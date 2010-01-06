<?php
// Version: 1.1; index

/*	This template is, perhaps, the most important template in the theme. It
	contains the main template layer that displays the header and footer of
	the forum, namely with main_above and main_below. It also contains the
	menu sub template, which appropriately displays the menu; the init sub
	template, which is there to set the theme up; (init can be missing.) and
	the linktree sub template, which sorts out the link tree.

	The init sub template should load any data and set any hardcoded options.

	The main_above sub template is what is shown above the main content, and
	should contain anything that should be shown up there.

	The main_below sub template, conversely, is shown after the main content.
	It should probably contain the copyright statement and some other things.

	The linktree sub template should display the link tree, using the data
	in the $context['linktree'] variable.

	The menu sub template should display all the relevant buttons the user
	wants and or needs.

	For more information on the templating system, please see the site at:
	http://www.simplemachines.org/
*/

// Initialize the template... mainly little settings.
function template_init()
{
	global $context, $settings, $options, $txt;

	/* Use images from default theme when using templates from the default theme?
		if this is 'always', images from the default theme will be used.
		if this is 'defaults', images from the default theme will only be used with default templates.
		if this is 'never' or isn't set at all, images from the default theme will not be used. */
	$settings['use_default_images'] = 'never';

	/* What document type definition is being used? (for font size and other issues.)
		'xhtml' for an XHTML 1.0 document type definition.
		'html' for an HTML 4.01 document type definition. */
	$settings['doctype'] = 'xhtml';

	/* The version this template/theme is for.
		This should probably be the version of SMF it was created for. */
	$settings['theme_version'] = '1.1';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as oppossed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status seperate from topic icons? */
	$settings['seperate_sticky_lock'] = true;
	
	// Color changer
	if(!$context['user']['is_guest'] && isset($_POST['options']['theme_color']))
	{
	   include_once($GLOBALS['sourcedir'] . '/Profile.php');
	   makeThemeChanges($context['user']['id'], $settings['theme_id']);
	   $options['theme_color'] = $_POST['options']['theme_color'];
	}
	elseif ($context['user']['is_guest'])
	{
	   if (isset($_POST['options']['theme_color']))
	   {
		  $_SESSION['theme_color'] = $_POST['options']['theme_color'];
		  $options['theme_color'] = $_SESSION['theme_color'];
	   }
	   elseif (isset($_SESSION['theme_color']))
		  $options['theme_color'] = $_SESSION['theme_color'];
	}
}

// The main sub template above the content.
function template_main_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;
	
	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title'], '" />', empty($context['robot_no_index']) ? '' : '
	<meta name="robots" content="noindex" />', '
	<meta name="keywords" content="PHP, MySQL, bulletin, board, free, open, source, smf, simple, machines, forum" />
	<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/script.js?fin11"></script>
	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";
	// ]]></script>
	<title>', $context['page_title'], '</title>';
	
	// Any color set by user?
	if (isset($options['theme_color']))
		$settings['theme_main_color'] = $options['theme_color'];

	// If not set, or if not allowed to set
	if(!isset($options['theme_color']) || (isset($settings['allow_color_change']) && $settings['allow_color_change'] == 'no'))
	{
		// Defaults.
		$options['theme_color'] = isset($settings['theme_main_color']) ? $settings['theme_main_color'] : 'lightblue';
		$settings['theme_main_color'] = $options['theme_color'];
	}

	// The ?fin11 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style.css?fin11" />
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style_' , $settings['theme_main_color'] , '.css?fin11" />
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/print.css?fin11" media="print" />';

	/* Internet Explorer 4/5 and Opera 6 just don't do font sizes properly. (they are big...)
		Thus, in Internet Explorer 4, 5, and Opera 6 this will show fonts one size smaller than usual.
		Note that this is affected by whether IE 6 is in standards compliance mode.. if not, it will also be big.
		Standards compliance mode happens when you use xhtml... */
	if ($context['browser']['needs_size_fix'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['default_theme_url'], '/fonts-compat.css" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" target="_blank" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name'], ' - RSS" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="' . $scripturl . '?board=' . $context['current_board'] . '.0" />';

	// We'll have to use the cookie to remember the header...
	if ($context['user']['is_guest'])
		$options['collapse_header'] = !empty($_COOKIE['upshrink']);

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'], '

	<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
		var current_header = ', empty($options['collapse_header']) ? 'false' : 'true', ';

		function shrinkHeader(mode)
		{';

	// Guests don't have theme options!!
	if ($context['user']['is_guest'])
		echo '
			document.cookie = "upshrink=" + (mode ? 1 : 0);';
	else
		echo '
			smf_setThemeOption("collapse_header", mode ? 1 : 0, null, "', $context['session_id'], '");';

	echo '
			document.getElementById("upshrink").src = smf_images_url + '  . '"/'. $settings['theme_main_color'] . '" + (mode ? "/expand.gif" : "/collapse.gif");

			document.getElementById("upshrinkHeader").style.display = mode ? "none" : "";
			document.getElementById("upshrinkHeader2").style.display = mode ? "none" : "";

			current_header = mode;
		}
	// ]]></script>';

	// the routine for the info center upshrink
	echo '
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
			var current_header_ic = ', empty($options['collapse_header_ic']) ? 'false' : 'true', ';

			function shrinkHeaderIC(mode)
			{';

	if ($context['user']['is_guest'])
		echo '
				document.cookie = "upshrinkIC=" + (mode ? 1 : 0);';
	else
		echo '
				smf_setThemeOption("collapse_header_ic", mode ? 1 : 0, null, "', $context['session_id'], '");';

	echo '
				document.getElementById("upshrink_ic").src = smf_images_url + '  . '"/'. $settings['theme_main_color'] . '" + (mode ? "/expand.gif" : "/collapse.gif");

				document.getElementById("upshrinkHeaderIC").style.display = mode ? "none" : "";

				current_header_ic = mode;
			}
		// ]]></script>
</head>
<body>';

	echo '
	<div class="maindiv" style="width: ' , (isset($settings['page_div_width']) && !empty($settings['page_div_width'])) ? $settings['page_div_width'] : '99%' ,  ';">
		<div style="width: 100%;" class="topbar">
			<table cellspacing="0" cellpadding="0" border="0" style="width:100%;">
				<tr>
					<td style="padding:0;" width="1" height="120">';

	if(!($settings['logo_not_show']))
	{
		if (empty($settings['header_logo_url']))
			echo '
						<a href="', $scripturl, '"><img src="', $settings['images_url'] . '/'. $settings['theme_main_color'], '/logo.jpg" style="margin: 0px;" alt="', $context['forum_name'], '" title="', $context['forum_name'], '"/></a>';
		else
			echo '
						<a href="', $scripturl, '"><img src="', $settings['header_logo_url'], '" style="margin: 0px;" alt="', $context['forum_name'], '" /></a>';
	}
	echo '
					</td>';

	if (!empty($settings['show_name_near_logo']))
		echo '	
					<td>
						<span style="font-family: \'Trebuchet MS\', Verdana, sans-serif; font-size: 150%; color: white; padding-top: 30px; padding-left: 30px; white-space: normal;">', $context['forum_name'], '</span>
					</td>';
	if (!empty($settings['top_right_html']))
		echo '
					<td valign="top" align="right">
						<div style="color: white; padding-top: 10px; float:right;">', $settings['top_right_html'], '</div>
					</td>';

	echo '
				</tr>
			</table>
		</div>
		<div style="width: 100%; padding-top: 4px;" class="topbar2">
			<table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
				<tr>';

	// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '

					<td valign="middle" height="30" class="smalltext" style="padding-left:10px; padding-top:0px; padding-bottom:0px;">
						<b>', $txt[102], '</b>: ', $context['random_news_line'], '
					</td>
			';
	echo '
					<td valign="middle" height="30" style="padding-top:0px; padding-bottom:0px; padding-right:20px;" class="middletext" align="right">
				<form action="', $scripturl, '?action=search2" method="post" accept-charset="', $context['character_set'], '" style="margin: 0px;">
					<a href="', $scripturl, '?action=search;advanced"><img src="'.$settings['images_url'].'/filter.gif" align="middle" style="margin: 0px;" alt="" /></a>
					<input type="text" name="search" value="" style="width: 190px;" />&nbsp;
					<input type="submit" name="submit" value="', $txt[182], '" style="width: 11ex;" />
					<input type="hidden" name="advanced" value="0" />';

	// Search within current topic?
	if (!empty($context['current_topic']))
		echo '
					<input type="hidden" name="topic" value="', $context['current_topic'], '" />';

		// If we're on a certain board, limit it to this board ;).
	elseif (!empty($context['current_board']))
		echo '
					<input type="hidden" name="brd[', $context['current_board'], ']" value="', $context['current_board'], '" />';

	echo '
				</form>

					</td>
				</tr>
			</table>
		</div>
		<div class="menubar">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr>';
					// Show the menu here, according to the menu sub template.
						template_menu();
		echo '
				</tr>
			</table>
		</div>';
		
	// Here we start the main page, after the menu bar.
	// Unfortunately, IE 6 couldn't handle a div here with a CSS background property, no matter how much I tried. So we use a table for IE here. I love Firefox ^_^ visit getfirefox.com for more info.
	// It is time for Microsoft to get rid of IE and make Firefox their primary browser :P
	// Ok, Opera can also display the div properly. I love both FF & Opera :)

	echo '
			', $context['browser']['is_ie'] ? '<table border="0" cellspacing="0" cellpadding="0" width="100%">
		<tr><td class="mainpage">' : '<div class="mainpage">', '
			<a style="float:right;" href="#" onclick="shrinkHeader(!current_header); return false;"><img id="upshrink" src="', $settings['images_url'], '/', $settings['theme_main_color'], '/', empty($options['collapse_header']) ? 'collapse.gif' : 'expand.gif', '" alt="*" title="', $txt['upshrink_description'], '" align="bottom" style="margin: 0 1ex;" /></a>		

			<div class="memberbardiv">
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td width="20">
						</td>
						<td class="memberbar">';
						
				if($context['user']['is_logged'])
					echo '
						', $txt['hello_member_ndt'], ' <b>', $context['user']['name'] , '</b>';
				else
					echo $txt['welcome_guest'];
					
				echo '
						</td>

						<td class="middletext" align="right" valign="top" style="padding-right:10px; padding-left:10px;">
							' , $context['current_time'], '
							<br/>
						</td>

					</tr>
					
					<tr id="upshrinkHeader"', empty($options['collapse_header']) ? '' : ' style="display: none;"', '>
						<td valign="middle" width="1" style="padding-right:10px; padding-left:10px;">', !empty($context['user']['avatar']) ? $context['user']['avatar']['image'] : '', '</td>
						
						<td class="memberbar">';
		
			if($context['user']['is_logged'])
				echo '
						<br/>
						<span class="middletext">'
						, $context['allow_pm'] ? '<b>' . $txt[152] . ' <a href="' . $scripturl . '?action=pm">' . $context['user']['messages'] . ' ' . ($context['user']['messages'] != 1 ? $txt[153] : $txt[471]) . '</a>' . $txt['newmessages4'] . ' ' . $context['user']['unread_messages'] . ' ' . ($context['user']['unread_messages'] == 1 ? $txt['newmessages0'] : $txt['newmessages1']).'</b>' : '<br/>', '.<br/><br/>
						> <a href="', $scripturl, '?action=unread">', $txt['unread_since_visit'], '</a> <br />
						> <a href="', $scripturl, '?action=unreadreplies">', $txt['show_unread_replies'], '</a><br />
						
						</span>';
						
			echo '
						</td>
						<td class="middletext" align="right" valign="top" style="padding-right:10px; padding-left:10px;">
							<br/>';
				// Are they logged in?
				if ($context['user']['is_logged'])
				{	
						// Show the total time logged in?
						if (!empty($context['user']['total_time_logged_in']))
						{
							echo '
												', $txt['totalTimeLogged1'];
				
							// If days is just zero, don't bother to show it.
							if ($context['user']['total_time_logged_in']['days'] > 0)
								echo $context['user']['total_time_logged_in']['days'] . $txt['totalTimeLogged2'];
				
							// Same with hours - only show it if it's above zero.
							if ($context['user']['total_time_logged_in']['hours'] > 0)
								echo $context['user']['total_time_logged_in']['hours'] . $txt['totalTimeLogged3'];
				
							// But, let's always show minutes - Time wasted here: 0 minutes ;).
							echo $context['user']['total_time_logged_in']['minutes'], $txt['totalTimeLogged4'], '<br />';
						}
						// Is the forum in maintenance mode?
						if ($context['in_maintenance'] && $context['user']['is_admin'])
							echo '
												<b>', $txt[616], '</b><br />';
				
						// Are there any members waiting for approval?
						if (!empty($context['unapproved_members']))
							echo '
												', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'], '<br />';
	
				}
				// Otherwise they're a guest - this time ask them to either register or login - lazy bums...
				else
				{
					echo '
											<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/sha1.js"></script>
			
											<form action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '" style="margin: 3px 1ex 1px 0;"', empty($context['disable_login_hashing']) ? ' onsubmit="hashLoginPassword(this, \'' . $context['session_id'] . '\');"' : '', '>
												<input type="text" name="user" size="10" /> <input type="password" name="passwrd" size="10" />
												<select name="cookielength">
													<option value="60">', $txt['smf53'], '</option>
													<option value="1440">', $txt['smf47'], '</option>
													<option value="10080">', $txt['smf48'], '</option>
													<option value="43200">', $txt['smf49'], '</option>
													<option value="-1" selected="selected">', $txt['smf50'], '</option>
												</select>
												<input type="submit" value="', $txt[34], '" /><br />
												<span class="middletext">', $txt['smf52'], '</span>
												<input type="hidden" name="hash_passwrd" value="" />
											</form>
											<br/><br/>';
				}
			
			echo '
						</td>
					</tr>
					<tr id="upshrinkHeader2"', empty($options['collapse_header']) ? '' : ' style="display: none;"', '>
						<td colspan="3" class="memberbardivbottom">';
					
					// color selection box
					if(isset($settings['allow_color_change']) && $settings['allow_color_change'] == 'box')
					  echo '
					  	<div style="position: relative; bottom: 13px; right:15px; float:right; font-size:16px;">
							<form action="', $scripturl, '" method="post">
							<select name="options[theme_color]">
							<option style="color:#6699CC;" value="lightblue" '			,$settings['theme_main_color'] == 'lightblue' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#5371AD;" value="lightnavy" '			,$settings['theme_main_color'] == 'lightnavy' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#6C7F93;" value="lightsilver" '		,$settings['theme_main_color'] == 'lightsilver' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#53ADAD;" value="lightturquoise" '	,$settings['theme_main_color'] == 'lightturquoise' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#4DB45D;" value="lightgreen" '		,$settings['theme_main_color'] == 'lightgreen' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#93A659;" value="lightolive" '		,$settings['theme_main_color'] == 'lightolive' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#D8A259;" value="lightgolden" '		,$settings['theme_main_color'] == 'lightgolden' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#a67259;" value="lightbrown" '		,$settings['theme_main_color'] == 'lightbrown' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#E15050;" value="lightred" '			,$settings['theme_main_color'] == 'lightred' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#D47BC5;" value="lightrose" '			,$settings['theme_main_color'] == 'lightrose' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#A185D6;" value="lightlilac" '		,$settings['theme_main_color'] == 'lightlilac' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							<option style="color:#7F88B2;" value="lightviolet" '		,$settings['theme_main_color'] == 'lightviolet' ? 'selected="selected"': '', '>&bull;&bull;&bull;</option>
							</select>
							<input type="submit" name="submit" value="&raquo;&raquo;" style="width: 8ex;  font-size:12px;" />
							</form>
						</div>';
					if(isset($settings['allow_color_change']) && $settings['allow_color_change'] == 'bars')
					echo '
						<div style="position: relative; bottom: 15px; right:15px; float:right; ">
							<form action="', $scripturl, '" method="post" class="smalltext">
							<input style="border: solid 2px #6699CC; background-color: #6699CC; color: #6699CC; width: 20px; font-size: 1px;" type="submit" value="lightblue" name="options[theme_color]"/>
							<input style="border: solid 2px #5371AD; background-color: #5371AD; color: #5371AD; width: 20px; font-size: 1px;" type="submit" value="lightnavy" name="options[theme_color]"/>
							<input style="border: solid 2px #6C7F93; background-color: #6C7F93; color: #6C7F93; width: 20px; font-size: 1px;" type="submit" value="lightsilver" name="options[theme_color]"/>
							<input style="border: solid 2px #53ADAD; background-color: #53ADAD; color: #53ADAD; width: 20px; font-size: 1px;" type="submit" value="lightturquoise" name="options[theme_color]"/>
							<input style="border: solid 2px #4DB45D; background-color: #4DB45D; color: #4DB45D; width: 20px; font-size: 1px;" type="submit" value="lightgreen" name="options[theme_color]"/>
							<input style="border: solid 2px #93A659; background-color: #93A659; color: #93A659; width: 20px; font-size: 1px;" type="submit" value="lightolive" name="options[theme_color]"/>
							<input style="border: solid 2px #D8A259; background-color: #D8A259; color: #D8A259; width: 20px; font-size: 1px;" type="submit" value="lightgolden" name="options[theme_color]"/>
							<input style="border: solid 2px #a67259; background-color: #a67259; color: #a67259; width: 20px; font-size: 1px;" type="submit" value="lightbrown" name="options[theme_color]"/>
							<input style="border: solid 2px #E15050; background-color: #E15050; color: #E15050; width: 20px; font-size: 1px;" type="submit" value="lightred" name="options[theme_color]"/>
							<input style="border: solid 2px #D47BC5; background-color: #D47BC5; color: #D47BC5; width: 20px; font-size: 1px;" type="submit" value="lightrose" name="options[theme_color]"/>
							<input style="border: solid 2px #A185D6; background-color: #A185D6; color: #A185D6; width: 20px; font-size: 1px;" type="submit" value="lightlilac" name="options[theme_color]"/>
							<input style="border: solid 2px #7F88B2; background-color: #7F88B2; color: #7F88B2; width: 20px; font-size: 1px;" type="submit" value="lightviolet" name="options[theme_color]"/>
							</form>
						</div>';
			echo '
						</td>
					</tr>

				</table>
			</div>';
			
		if(!empty($settings['custom_global_html']))
		echo '
			<div align="center" style="width: 90%; margin-left: auto; margin-right: auto; margin-top:10px; border: 0px solid;" class="middletext">
				', $settings['custom_global_html'], '
			</div>';
		
	// The main content should go here.
	echo '
	<div id="bodyarea" style="padding: 1ex 25px 2ex 25px;">';
}

function template_main_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	</div>';

	// Show the "Powered by" and "Valid" logos, as well as the copyright. Remember, the copyright must be somewhere!
	echo '

	<div id="footerarea" style="text-align: center; padding-bottom: 1ex;', $context['browser']['needs_size_fix'] && !$context['browser']['is_ie6'] ? ' width: 100%;' : '', '">
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
			function smfFooterHighlight(element, value)
			{
				element.src = smf_images_url + "/" + (value ? "h_" : "") + element.id + ".gif";
			}
		// ]]></script>
		<table cellspacing="0" cellpadding="3" border="0" align="center" width="100%">
			<tr>
				<td width="28%" valign="middle" align="', !$context['right_to_left'] ? 'right' : 'left', '">
					<a href="http://www.mysql.com/" target="_blank"><img id="powered-mysql" src="', $settings['images_url'], '/powered-mysql.gif" alt="', $txt['powered_by_mysql'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
					<a href="http://www.php.net/" target="_blank"><img id="powered-php" src="', $settings['images_url'], '/powered-php.gif" alt="', $txt['powered_by_php'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
				</td>
				<td valign="middle" align="center" style="white-space: nowrap;">
					', theme_copyright(), '
					<br/><br/>
					<span class="smalltext">'. $settings['custom_copyright'] . '</span>
				</td>
				<td width="28%" valign="middle" align="', !$context['right_to_left'] ? 'left' : 'right', '">
					<a href="http://validator.w3.org/check/referer" target="_blank"><img id="valid-xhtml10" src="', $settings['images_url'], '/valid-xhtml10.gif" alt="', $txt['valid_xhtml'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
					<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank"><img id="valid-css" src="', $settings['images_url'], '/valid-css.gif" alt="', $txt['valid_css'], '" width="54" height="20" style="margin: 5px 16px;" onmouseover="smfFooterHighlight(this, true);" onmouseout="smfFooterHighlight(this, false);" /></a>
					<span style="float:right; margin-right:10px; font-size:70%;"><b>Dilber MC</b> Theme by <b><a href="http://www.harzem.com/themes/themes.php?theme=dilbermc;color=', $settings['theme_main_color'], '" target="_blank">HarzeM</a></b></span>
				</td>
			</tr>
		</table>';

		// Show the load time?
	if ($context['show_load_time'])
		echo '
		<span class="smalltext">', $txt['smf301'], $context['load_time'], $txt['smf302'], $context['load_queries'], $txt['smf302b'], '</span>';

	// This is an interesting bug in Internet Explorer AND Safari. Rather annoying, it makes overflows just not tall enough.
	if (($context['browser']['is_ie'] && !$context['browser']['is_ie4']) || $context['browser']['is_mac_ie'] || $context['browser']['is_safari'] || $context['browser']['is_firefox'])
	{
		// The purpose of this code is to fix the height of overflow: auto div blocks, because IE can't figure it out for itself.
		echo '
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[';

		// Unfortunately, Safari does not have a "getComputedStyle" implementation yet, so we have to just do it to code...
		if ($context['browser']['is_safari'])
			echo '
			window.addEventListener("load", smf_codeFix, false);

			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = 0; i < codeFix.length; i++)
				{
					if ((codeFix[i].className == "code" || codeFix[i].className == "post" || codeFix[i].className == "signature") && codeFix[i].offsetHeight < 20)
						codeFix[i].style.height = (codeFix[i].offsetHeight + 20) + "px";
				}
			}';
		elseif ($context['browser']['is_firefox'])
			echo '
			window.addEventListener("load", smf_codeFix, false);
			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = 0; i < codeFix.length; i++)
				{
					if (codeFix[i].className == "code" && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0))
						codeFix[i].style.overflow = "scroll";
				}
			}';
		else
			echo '
			var window_oldOnload = window.onload;
			window.onload = smf_codeFix;

			function smf_codeFix()
			{
				var codeFix = document.getElementsByTagName ? document.getElementsByTagName("div") : document.all.tags("div");

				for (var i = codeFix.length - 1; i > 0; i--)
				{
					if (codeFix[i].currentStyle.overflow == "auto" && (codeFix[i].currentStyle.height == "" || codeFix[i].currentStyle.height == "auto") && (codeFix[i].scrollWidth > codeFix[i].clientWidth || codeFix[i].clientWidth == 0) && (codeFix[i].offsetHeight != 0 || codeFix[i].className == "code"))
						codeFix[i].style.height = (codeFix[i].offsetHeight + 36) + "px";
				}

				if (window_oldOnload)
				{
					window_oldOnload();
					window_oldOnload = null;
				}
			}';

		echo '
		// ]]></script>';
	}

	echo '
	</div>
	',($context['browser']['is_ie']) ? '</td></tr></table>' : '</div>' , '
	</div>';
	// The following will be used to let the user know that some AJAX process is running
	echo '
	<div id="ajax_in_progress" class="ajax_in_progress" style="display: none;', $context['browser']['is_ie'] && !$context['browser']['is_ie7'] ? 'position: absolute;' : '', '">', $txt['ajax_in_progress'], '</div>
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{
	global $context, $settings, $options;

	echo '<div class="nav" style="font-size: 85%; margin-bottom: 2ex; margin-top: 2ex;">';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo '<b>', $settings['linktree_link'] && isset($tree['url']) ? '<a href="' . $tree['url'] . '" class="nav">' . $tree['name'] . '</a>' : $tree['name'], '</b>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo '&nbsp;>&nbsp;';
	}

	echo '</div>';
}

// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	// Work out where we currently are.
	$current_action = 'home';
	if (in_array($context['current_action'], array('admin', 'ban', 'boardrecount', 'cleanperms', 'detailedversion', 'dumpdb', 'featuresettings', 'featuresettings2', 'findmember', 'maintain', 'manageattachments', 'manageboards', 'managecalendar', 'managesearch', 'membergroups', 'modlog', 'news', 'optimizetables', 'packageget', 'packages', 'permissions', 'pgdownload', 'postsettings', 'regcenter', 'repairboards', 'reports', 'serversettings', 'serversettings2', 'smileys', 'viewErrorLog', 'viewmembers')))
		$current_action = 'admin';
	if (in_array($context['current_action'], array('search', 'admin', 'calendar', 'profile', 'mlist', 'register', 'login', 'help', 'pm')))
		$current_action = $context['current_action'];
	if ($context['current_action'] == 'search2')
		$current_action = 'search';
	if ($context['current_action'] == 'theme')
		$current_action = isset($_REQUEST['sa']) && $_REQUEST['sa'] == 'pick' ? 'profile' : 'admin';

	// Dummy place holder, to set the height
	echo'
				<td align="center" class="menubg" height="30" width="20">
				</td>';

	// Show the [home] button.
	echo'
				<td align="center" class="menubg' , $current_action == 'home' ? '2' : '' , '">
					<a href="', $scripturl, '">' , $txt[103] , '</a>
				</td>';
	// Show the [help] button.
	echo'
				<td align="center" class="menubg' , $current_action == 'help' ? '2' : '' , '">
					<a href="', $scripturl, '?action=help">' , $txt[119] , '</a>
				</td>';
	// How about the [search] button?
	if ($context['allow_search'])
	echo'
				<td align="center" class="menubg' , $current_action == 'search' ? '2' : '' , '">
						<a href="', $scripturl, '?action=search">' , $txt[182] , '</a>				
				</td>';
	// Is the user allowed to administrate at all? ([admin])
	if ($context['allow_admin'])
	echo'
				<td align="center" class="menubg' , $current_action == 'admin' ? '2' : '' , '">
						<a href="', $scripturl, '?action=admin">' , $txt[2] , '</a>				
				</td>';
	// Edit Profile... [profile]
	if ($context['allow_edit_profile'])	
	echo'
				<td align="center" class="menubg' , $current_action == 'profile' ? '2' : '' , '">
					<a href="', $scripturl, '?action=profile">' , $txt[79] , '</a>					
				</td>';
	// Go to PM center... [pm]
	if ($context['user']['is_logged'] && $context['allow_pm'])		
	echo'
				<td align="center" class="menubg' , $current_action == 'pm' ? '2' : '' , '">
					<a href="', $scripturl, '?action=pm">' , $txt['pm_short'] , ' ', $context['user']['unread_messages'] > 0 ? '[<strong>'. $context['user']['unread_messages'] . '</strong>]' : '' , '</a>					
				</td>';
	// The [calendar]!
	if ($context['allow_calendar'])				
	echo'
				<td align="center" class="menubg' , $current_action == 'calendar' ? '2' : '' , '">
					<a href="', $scripturl, '?action=calendar">' , $txt['calendar24'] , '</a>					
				</td>';				
	// the [member] list button
	if ($context['allow_memberlist'])				
	echo'
				<td align="center" class="menubg' , $current_action == 'mlist' ? '2' : '' , '">
					<a href="', $scripturl, '?action=mlist">' , $txt[331] , '</a>					
				</td>';				

	// If the user is a guest, show [login] button.
	if ($context['user']['is_guest'])
	echo'
				<td align="center" class="menubg' , $current_action == 'login' ? '2' : '' , '">
					<a href="', $scripturl, '?action=login">' , $txt[34] , '</a>					
				</td>';				
	// If the user is a guest, also show [register] button.
	if ($context['user']['is_guest'])				
	echo'
				<td align="center" class="menubg' , $current_action == 'register' ? '2' : '' , '">
					<a href="', $scripturl, '?action=register">' , $txt[97] , '</a>				
				</td>';				
	// Otherwise, they might want to [logout]...
	if ($context['user']['is_logged'])				
	echo'
				<td align="center" class="menubg' , $current_action == 'logout' ? '2' : '' , '">
					<a href="', $scripturl, '?action=logout;sesc=', $context['session_id'], '">' , $txt[108] , '</a>					
				</td>';				
				
				
	// Dummy place holder, to end things
	echo'
				<td align="center" class="menubg" width="20">
				</td>';				

}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $force_reset = false, $custom_td = '')
{
	global $settings, $buttons, $context, $txt, $scripturl;

	// Create the buttons...
	foreach ($button_strip as $key => $value)
	{
		if (isset($value['test']) && empty($context[$value['test']]))
		{
			unset($button_strip[$key]);
			continue;
		}
		elseif (!isset($buttons[$key]) || $force_reset)
			$buttons[$key] = '<a href="' . $value['url'] . '" ' .( isset($value['custom']) ? $value['custom'] : '') . '>' . $txt[$value['text']] . '</a>';

		$button_strip[$key] = $buttons[$key];
	}

	if (empty($button_strip))
		return '<td>&nbsp;</td>';

	echo '
		<td class="', $direction == 'top' ? 'main' : 'main', 'strip_first', '">&nbsp;</td>
		<td class="', $direction == 'top' ? 'main' : 'main', 'strip">', implode(' &nbsp;|&nbsp; ', $button_strip) , '</td>
		<td class="', $direction == 'top' ? 'main' : 'main', 'strip_last' , '">&nbsp;</td>';
}

?>
