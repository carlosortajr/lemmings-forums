<?php

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
	$settings['theme_version'] = '2.0';

	/* Set a setting that tells the theme that it can render the tabs. */
	$settings['use_tabs'] = true;

	/* Use plain buttons - as opposed to text buttons? */
	$settings['use_buttons'] = true;

	/* Show sticky and lock status separate from topic icons? */
	$settings['separate_sticky_lock'] = true;

	/* Does this theme use the strict doctype? */
	$settings['strict_doctype'] = false;

	/* Does this theme use post previews on the message index? */
	$settings['message_index_preview'] = false;

	/* Set the following variable to true if this theme requires the optional theme strings file to be loaded. */
	$settings['require_theme_strings'] = false;
}

// The main sub template above the content.
function template_html_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	// Show right to left and the character set for ease of translating.
	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"', $context['right_to_left'] ? ' dir="rtl"' : '', '><head>';

	// The ?fin20 part of this link is just here to make sure browsers don't cache it wrongly.
	echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/style.css?fin20" />
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/index', $context['theme_variant'], '.css?fin20" />';

	// Some browsers need an extra stylesheet due to bugs/compatibility issues.
	foreach (array('ie7', 'ie6', 'webkit') as $cssfix)
		if ($context['browser']['is_' . $cssfix])
			echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/', $cssfix, '.css" />';

	// RTL languages require an additional stylesheet.
	if ($context['right_to_left'])
		echo '
	<link rel="stylesheet" type="text/css" href="', $settings['theme_url'], '/css/rtl.css" />';

	// Here comes the JavaScript bits!
	echo '
	<script type="text/javascript" src="', $settings['default_theme_url'], '/scripts/script.js?fin20"></script>
	<script type="text/javascript" src="', $settings['theme_url'], '/scripts/theme.js?fin20"></script>
	<script type="text/javascript"><!-- // --><![CDATA[
		var smf_theme_url = "', $settings['theme_url'], '";
		var smf_default_theme_url = "', $settings['default_theme_url'], '";
		var smf_images_url = "', $settings['images_url'], '";
		var smf_scripturl = "', $scripturl, '";
		var smf_iso_case_folding = ', $context['server']['iso_case_folding'] ? 'true' : 'false', ';
		var smf_charset = "', $context['character_set'], '";', $context['show_pm_popup'] ? '
		var fPmPopup = function ()
		{
			if (confirm("' . $txt['show_personal_messages'] . '"))
				window.open(smf_prepareScriptUrl(smf_scripturl) + "action=pm");
		}
		addLoadEvent(fPmPopup);' : '', '
		var ajax_notification_text = "', $txt['ajax_in_progress'], '";
		var ajax_notification_cancel_text = "', $txt['modify_cancel'], '";
	// ]]></script>';

	echo '
	<meta http-equiv="Content-Type" content="text/html; charset=', $context['character_set'], '" />
	<meta name="description" content="', $context['page_title_html_safe'], '" />', !empty($context['meta_keywords']) ? '
	<meta name="keywords" content="' . $context['meta_keywords'] . '" />' : '', '
	<title>', $context['page_title_html_safe'], '</title>';

	// Please don't index these Mr Robot.
	if (!empty($context['robot_no_index']))
		echo '
	<meta name="robots" content="noindex" />';

	// Present a canonical url for search engines to prevent duplicate content in their indices.
	if (!empty($context['canonical_url']))
		echo '
	<link rel="canonical" href="', $context['canonical_url'], '" />';

	// Show all the relative links, such as help, search, contents, and the like.
	echo '
	<link rel="help" href="', $scripturl, '?action=help" />
	<link rel="search" href="' . $scripturl . '?action=search" />
	<link rel="contents" href="', $scripturl, '" />';

	// If RSS feeds are enabled, advertise the presence of one.
	if (!empty($modSettings['xmlnews_enable']) && (!empty($modSettings['allow_guestAccess']) || $context['user']['is_logged']))
		echo '
	<link rel="alternate" type="application/rss+xml" title="', $context['forum_name_html_safe'], ' - ', $txt['rss'], '" href="', $scripturl, '?type=rss;action=.xml" />';

	// If we're viewing a topic, these should be the previous and next topics, respectively.
	if (!empty($context['current_topic']))
		echo '
	<link rel="prev" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=prev" />
	<link rel="next" href="', $scripturl, '?topic=', $context['current_topic'], '.0;prev_next=next" />';

	// If we're in a board, or a topic for that matter, the index will be the board's index.
	if (!empty($context['current_board']))
		echo '
	<link rel="index" href="', $scripturl, '?board=', $context['current_board'], '.0" />';

	// We'll have to use the cookie to remember the header...
	if ($context['user']['is_guest'])
	{
		$options['collapse_header'] = !empty($_COOKIE['upshrink']);
		$options['collapse_header_ic'] = !empty($_COOKIE['upshrinkIC']);
	}

	// Output any remaining HTML headers. (from mods, maybe?)
	echo $context['html_headers'];

	echo '
</head>
<body>';
}

function template_body_above()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
<div id="mainframe"', !empty($settings['forum_width']) ? ' style="width: ' . $settings['forum_width'] . '"' : '', '>
	<div class="logo border">
			<img src="', !empty($settings['header_logo_url']) ? $settings['header_logo_url'] : $settings['images_url'] . '/smflogo.gif', '" alt="" />
		</div>
		<div class="buttons border"><span>';

		// Show the menu here, according to the menu sub template.
		template_menu();

		echo '</span>
		</div>
		<div class="user border">';

		// If the user is logged in, display stuff like their name, new messages, etc.
	if ($context['user']['is_logged'])
	{
		echo '
				
			', $txt['hello_member_ndt'], ' ', $context['user']['name'], '';

		// Is the forum in maintenance mode?
		if ($context['in_maintenance'] && $context['user']['is_admin'])
			echo '<br />
				<b>', $txt['maintain_mode_on'], '</b>';
	}
	// Otherwise they're a guest - so politely ask them to register or login.
	else
		echo '
				', $txt['hello_guest'], ' ', $txt['guest'], '';

	echo '
				<br />', $context['current_time'], '
	</div>';
		// Show a random news item? (or you could pick one from news_lines...)
	if (!empty($settings['enable_news']))
		echo '
	<div class="newspadding border">';
			echo'
				<b>', $txt['news'], ':</b> ', $context['random_news_line'], '
	</div>
	
	<div class="main border">';
}

function template_body_below()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	</div>
	<div class="footer border">
				', theme_copyright(), '<br /><a href="http://www.bryandeakin.com">Pagan v3 by Runic &copy; 2006 - 2011</a>
	</div></div>
</div>';
}

function template_html_below()
{
	global $context, $settings, $options, $scripturl, $txt, $modSettings;

	echo '
</body></html>';
}

// Show a linktree. This is that thing that shows "My Community | General Category | General Discussion"..
function theme_linktree($force_show = false)
{
	global $context, $settings, $options, $shown_linktree;

	// If linktree is empty, just return - also allow an override.
	if (empty($context['linktree']) || (!empty($context['dont_default_linktree']) && !$force_show))
		return;

	echo '
	<ul class="linktree" id="linktree_', empty($shown_linktree) ? 'upper' : 'lower', '">';

	// Each tree item has a URL and name. Some may have extra_before and extra_after.
	foreach ($context['linktree'] as $link_num => $tree)
	{
		echo '
		<li', ($link_num == count($context['linktree']) - 1) ? ' class="last"' : '', '>';

		// Show something before the link?
		if (isset($tree['extra_before']))
			echo $tree['extra_before'];

		// Show the link, including a URL if it should have one.
		echo $settings['linktree_link'] && isset($tree['url']) ? '
			<a href="' . $tree['url'] . '"><span>' . $tree['name'] . '</span></a>' : '<span>' . $tree['name'] . '</span>';

		// Show something after the link...?
		if (isset($tree['extra_after']))
			echo $tree['extra_after'];

		// Don't show a separator for the last one.
		if ($link_num != count($context['linktree']) - 1)
			echo ' &gt;';

		echo '
		</li>';
	}
	echo '
	</ul>';

	$shown_linktree = true;
}

// Show the menu up top. Something like [home] [help] [profile] [logout]...
function template_menu()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	<div class="main_menu">
		<ul class="reset clearfix">';

	foreach ($context['menu_buttons'] as $act => $button)
	{
		$classes = array();
		if (!empty($button['active_button']))
			$classes[] = 'active';
		if (!empty($button['is_last']))
			$classes[] = 'last';
		/* IE6 can't do multiple class selectors */
		if ($context['browser']['is_ie6'] && !empty($button['active_button']) && !empty($button['is_last']))
			$classes[] = 'lastactive';

		$classes = implode(' ', $classes);

		echo '
			<li id="button_', $act, '"', !empty($classes) ? ' class="' . $classes . '"' : '', '>
				<a title="', !empty($button['alttitle']) ? $button['alttitle'] : $button['title'], '" href="', $button['href'], '"', isset($button['target']) ? ' target="' . $button['target'] . '"' : '', '>
					<span>', ($button['active_button'] ? '' : ''), $button['title'], ($button['active_button'] ? '' : ''), '</span>
				</a>
			</li>';
	}

	echo '
		</ul>
	</div>';
}

// Generate a strip of buttons.
function template_button_strip($button_strip, $direction = 'top', $strip_options = array())
{
	global $settings, $context, $txt, $scripturl;

	if (!is_array($strip_options))
		$strip_options = array();

	// Right to left menu should be in reverse order.
	if ($context['right_to_left'])
		$button_strip = array_reverse($button_strip, true);

	// Create the buttons...
	$buttons = array();
	foreach ($button_strip as $key => $value)
		if (!isset($value['test']) || !empty($context[$value['test']]))
			$buttons[] = '
				<li' . (isset($value['active']) ? ' class="active"' : '') . '><a' . (isset($value['id']) ? ' id="button_strip_' . $value['id'] . '"' : '') . ' class="button_strip_' . $key . '" href="' . $value['url'] . '"' . (isset($value['custom']) ? ' ' . $value['custom'] : '') . '><span>' . (isset($value['active']) ? '' . $txt[$value['text']] . '' : $txt[$value['text']]) . '</span></a></li>';

	// No buttons? No button strip either.
	if (empty($buttons))
		return;

	// Make the last one, as easy as possible.
	$list_item = array('<li>', '<li class="active">');
	$active_item = array('<li class="last">', '<li class="active last lastactive">');

	$buttons[count($buttons) - 1] = str_replace($list_item, $active_item, $buttons[count($buttons) - 1]);

	echo '
		<div class="buttonlist', $direction != 'top' ? '_bottom' : '', '"', (empty($buttons) ? ' style="display: none;"' : ''), (!empty($strip_options['id']) ? ' id="' . $strip_options['id'] . '"': ''), '>
			<ul class="reset clearfix">',
				implode('', $buttons), '
			</ul>
		</div>';
}

?>