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

	// The ?fin11 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
  <!--<link rel="stylesheet" href="', $settings['theme_url'], '/dialog.css" media="screen" />-->
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/style.css?fin11" />
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
			document.getElementById("upshrink").src = smf_images_url + (mode ? "/expand.gif" : "/collapse.gif");

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
				document.getElementById("upshrink_ic").src = smf_images_url + (mode ? "/expand.gif" : "/collapse.gif");

				document.getElementById("upshrinkHeaderIC").style.display = mode ? "none" : "";

				current_header_ic = mode;
			}
		// ]]></script>

</head><body>';

	echo '
	<div class="hdrborder" ', $context['browser']['needs_size_fix'] && !$context['browser']['is_ie6'] ? ' style="width: 100%;"' : '', '>
	<table cellpadding="0" cellspacing="0" width="100%" align="center">
  <tr><td valign="top">';


	// display user name
	echo '
<table cellpadding="0" cellspacing="0" width="100%" align="center">
  <tr>
<td width="21" height="21" border="0"><img src="' . $settings['images_url'] . '/tbl/tlc.gif" /></td>';
// this is the upshrink button for the user info section
	echo '
					<td width="100%" height="21" valign="bottom" background="' . $settings['images_url'] . '/tbl/tm.gif" style="text-align:right;font-size:8pt;color: #8D8D8D;">
					<span class="smalltext">' , $context['current_time'],'</span>
				</td>
			<td width="21" height="21" border="0"><img src="' . $settings['images_url'] . '/tbl/trc.gif" /></td>
  </tr></table>
<table cellpadding="0" cellspacing="0" width="100%" align="center">
  <tr>
	<td width="21" valign="top" background="' . $settings['images_url'] . '/tbl/left.gif" rowspan="2"><img src="' . $settings['images_url'] . '/tbl/left.gif" /></td>
				<td width="100%" height="100%" align="center" bgcolor="#e5e5e5">
				<table width="100%" cellpadding="4" cellspacing="1" border="0"><tr><td width="100%" valign="top" class="header"><div align="center" valign="top">' , template_menu(), '</div></td>';
echo '
			<table width="100%" cellpadding="8" cellspacing="1" border="0">';

	if (!empty($context['user']['avatar']))
	
		echo '
							<td class="windowbg2" height="80" valign="middle">', $context['user']['avatar']['image'], '</td>';

	echo '
							<td colspan="2" width="100%" valign="top" class="windowbg"><span class="middletext">';

	// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '      
		           <span class="middletext" style="font-size: 12px;"> ', $txt['hello_member_ndt'], ' ', $context['user']['name'] , '</span><br />
								<a href="', $scripturl, '?action=unread">', $txt['unread_since_visit'], '</a> <br />
								<a href="', $scripturl, '?action=unreadreplies">', $txt['show_unread_replies'], '</a><br />';

	}
	// Otherwise they're a guest - send them a lovely greeting...
	else
		echo $txt['welcome_guest'];

	// Now, onto our second set of info, are they logged in again?
	if ($context['user']['is_logged'])
	{
		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '
								<b>', $txt[616], '</b><br />';

		// Are there any members waiting for approval?
		if (!empty($context['unapproved_members']))
			echo '
								', $context['unapproved_members'] == 1 ? $txt['approve_thereis'] : $txt['approve_thereare'], ' <a href="', $scripturl, '?action=viewmembers;sa=browse;type=approve">', $context['unapproved_members'] == 1 ? $txt['approve_member'] : $context['unapproved_members'] . ' ' . $txt['approve_members'], '</a> ', $txt['approve_members_waiting'], '<br />';

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
		echo '				</span>';
	}
	// Otherwise they're a guest - this time ask them to either register or login - lazy bums...
	else
	{
		echo '				</span>
								<script language="JavaScript" type="text/javascript" src="', $settings['default_theme_url'], '/sha1.js"></script>

								<form action="', $scripturl, '?action=login2" method="post" accept-charset="', $context['character_set'], '" class="middletext" style="margin: 3px 1ex 1px 0;"', empty($context['disable_login_hashing']) ? ' onsubmit="hashLoginPassword(this, \'' . $context['session_id'] . '\');"' : '', '>
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
								</form>';
	}

	echo '
							</td>
						</tr>
					</table>';

	echo '
   </td>
<td width="21" valign="top"  background="' . $settings['images_url'] . '/tbl/right.gif" rowspan="2"><img src="' . $settings['images_url'] . '/tbl/right.gif" /></td>
  </tr></table>
<table cellpadding="0" cellspacing="0" width="100%" align="center">
  <tr>
<td width="21" height="21" valign="top" border="0"><img src="' . $settings['images_url'] . '/tbl/blc.gif" /></td>
<td width="100%" height="21" align="center" valign="top" background="' . $settings['images_url'] . '/tbl/bm.gif"></td>
<td width="21" height="21" valign="top" border="0"><img src="' . $settings['images_url'] . '/tbl/brc.gif" /></td>
  </tr></table>';
	echo '
	</td>
			</tr>
		</table></div>';

if(!empty($settings['mybannerbox']))
	echo '<div style="padding-top: 5px;">',$settings['mybannerbox'],'</div>';
	
	// The main content should go here.
	echo '
	
	<div id="bodyarea" style="padding: 1ex 1ex 0ex 1ex;">';
}

function template_main_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	</div>';

	// Show the "Powered by" and "Valid" logos, as well as the copyright.  Remember, the copyright must be somewhere!
	echo '
	<div id="footer" style="text-align: center; padding-bottom: 1ex;', $context['browser']['needs_size_fix'] && !$context['browser']['is_ie6'] ? ' width: 100%;' : '', '">
		<script language="JavaScript" type="text/javascript"><!-- // --><![CDATA[
			function smfFooterHighlight(element, value)
			{
				element.src = smf_images_url + "/" + (value ? "h_" : "") + element.id + ".gif";
			}
		// ]]></script>
		<table cellspacing="0" cellpadding="3" style="padding-top:60px;" border="0" align="center" width="100%">
			<tr>
				<td width="28%" valign="bottom" align="left" style="padding-left:10px;">
					<a href="http://www.mysql.com/" target="_blank" style="font-size:10px;">MySQL</a>&nbsp;|&nbsp;<a href="http://www.php.net/" target="_blank" style="font-size:10px;">PHP</a>
				</td>
				<td valign="bottom" align="center" style="white-space: nowrap;">
					<small>Redline2 by:<a href="http://global-bttracker.no-ip.org/forum/" target="_blank"> TreetopClimber</a> &copy; 2006-2008 | <a href="#">Back To Top</a></small><br>', theme_copyright(), '
				</td>
				<td width="28%" valign="bottom" align="right" style="padding-right:10px;">
					<a href="http://validator.w3.org/check/referer" target="_blank" style="font-size:10px;">XHTML</a>&nbsp;|&nbsp;<a href="http://jigsaw.w3.org/css-validator/check/referer" target="_blank" style="font-size:10px;">CSS</a>
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
	</div>';

	// The following will be used to let the user know that some AJAX process is running
	echo '
	<div id="ajax_in_progress" style="display: none;', $context['browser']['is_ie'] && !$context['browser']['is_ie7'] ? 'position: absolute;' : '', '">', $txt['ajax_in_progress'], '</div>';
echo '
</div>
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree()
{
	global $context, $settings, $options;

	echo '<div class="nav" style="font-size: smaller; margin-bottom: 2ex; margin-top: 2ex;">';

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
			echo $settings['linktree_inline'] ? '&nbsp;<img src="' . $settings['images_url'] . '/icons/nav.gif" alt="" border="0" />&nbsp;' : '<br />';
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

	// Are we using right-to-left orientation?
	if ($context['right_to_left'])
	{
		$first = 'last';
		$last = 'first';
	}
	else
	{
		$first = 'first';
		$last = 'last';
	}

	// Show the start of the tab section.
	echo '
			<table cellpadding="0" cellspacing="0" border="0" style="margin-left:20px;">
				<tr>
					<td nowrap="nowrap" class="maintab_' , $first , '">&nbsp;</td>';

	// Show the [home] button.
	echo ($current_action=='home' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'home' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '">' , $txt[103] , '</a>
				</td>' , $current_action == 'home' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';
	
	// Show the [help] button.
	echo ($current_action == 'help' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'help' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=help">' , $txt[119] , '</a>
				</td>' , $current_action == 'help' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// How about the [search] button?
	if ($context['allow_search'])
		echo ($current_action == 'search' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'search' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=search">' , $txt[182] , '</a>
				</td>' , $current_action == 'search' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// Is the user allowed to administrate at all? ([admin])
	if ($context['allow_admin'])
		echo ($current_action == 'admin' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'admin' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=admin">' , $txt[2] , '</a>
				</td>' , $current_action == 'admin' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// Edit Profile... [profile]
	if ($context['allow_edit_profile'])
		echo ($current_action == 'profile' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'profile' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=profile">' , $txt[79] , '</a>
				</td>' , $current_action == 'profile' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// Go to PM center... [pm]
	if ($context['user']['is_logged'] && $context['allow_pm'])
		echo ($current_action == 'pm' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'pm' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=pm">' , $txt['pm_short'] , ' ', $context['user']['unread_messages'] > 0 ? '[<strong>'. $context['user']['unread_messages'] . '</strong>]' : '' , '</a>
				</td>' , $current_action == 'pm' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// The [calendar]!
	if ($context['allow_calendar'])
		echo ($current_action == 'calendar' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'calendar' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=calendar">' , $txt['calendar24'] , '</a>
				</td>' , $current_action == 'calendar' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// the [member] list button
	if ($context['allow_memberlist'])
		echo ($current_action == 'mlist' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'mlist' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=mlist">' , $txt[331] , '</a>
				</td>' , $current_action == 'mlist' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';


	// If the user is a guest, show [login] button.
	if ($context['user']['is_guest'])
		echo ($current_action == 'login' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'login' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=login">' , $txt[34] , '</a>
				</td>' , $current_action == 'login' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';


	// If the user is a guest, also show [register] button.
	if ($context['user']['is_guest'])
		echo ($current_action == 'register' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'register' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=register">' , $txt[97] , '</a>
				</td>' , $current_action == 'register' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';


	// Otherwise, they might want to [logout]...
	if ($context['user']['is_logged'])
		echo ($current_action == 'logout' || $context['browser']['is_ie4']) ? '<td class="maintab_active_' . $first . '">&nbsp;</td>' : '' , '
				<td nowrap="nowrap" valign="top" class="maintab_' , $current_action == 'logout' ? 'active_back' : 'back2' , '">
					<a href="', $scripturl, '?action=logout;sesc=', $context['session_id'], '">' , $txt[108] , '</a>
				</td>' , $current_action == 'logout' ? '<td class="maintab_active_' . $last . '">&nbsp;</td>' : '';

	// The end of tab section.
	echo '
				<td class="maintab_' , $last , '">&nbsp;</td>
			</tr>
		</table>';

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
		<td class="maintab_back smalltext">', implode('</td><td class="maintab_back smalltext">', $button_strip) , '</td>';
}

?>