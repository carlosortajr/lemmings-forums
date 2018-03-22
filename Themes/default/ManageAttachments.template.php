<?php
/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

// Template template wraps around the simple settings page to add javascript functionality.
function template_avatar_settings_above()
{
}

function template_avatar_settings_below()
{
	echo '
	<script type="text/javascript"><!-- // --><![CDATA[
	var fUpdateStatus = function ()
	{
		document.getElementById("avatar_max_width_external").disabled = document.getElementById("avatar_download_external").checked;
		document.getElementById("avatar_max_height_external").disabled = document.getElementById("avatar_download_external").checked;
		document.getElementById("avatar_action_too_large").disabled = document.getElementById("avatar_download_external").checked;
		document.getElementById("custom_avatar_dir").disabled = document.getElementById("custom_avatar_enabled").value == 0;
		document.getElementById("custom_avatar_url").disabled = document.getElementById("custom_avatar_enabled").value == 0;

	}
	addLoadEvent(fUpdateStatus);
// ]]></script>
';
}

function template_browse()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	<div id="manage_attachments">
		<div class="cat_bar">
			<h3 class="catbg">', $txt['attachment_manager_browse_files'], '</h3>
		</div>
		<div class="windowbg2">
			<span class="topslice"><span></span></span>
			<div class="content">
				<a href="', $scripturl, '?action=admin;area=manageattachments;sa=browse">', $context['browse_type'] === 'attachments' ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '', $txt['attachment_manager_attachments'], '</a> |
				<a href="', $scripturl, '?action=admin;area=manageattachments;sa=browse;avatars">', $context['browse_type'] === 'avatars' ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '', $txt['attachment_manager_avatars'], '</a> |
				<a href="', $scripturl, '?action=admin;area=manageattachments;sa=browse;thumbs">', $context['browse_type'] === 'thumbs' ? '<img src="' . $settings['images_url'] . '/selected.gif" alt="&gt;" /> ' : '', $txt['attachment_manager_thumbs'], '</a>
			</div>
			<span class="botslice"><span></span></span>
		</div>
	</div>';

	template_show_list('file_list');
	echo '
	<br class="clear" />';

}

function template_maintenance()
{
	global $context, $settings, $options, $scripturl, $txt;

	echo '
	<div id="manage_attachments">
		<div class="cat_bar">
			<h3 class="catbg">', $txt['attachment_stats'], '</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				<dl class="settings">
					<dt><strong>', $txt['attachment_total'], ':</strong></dt><dd>', $context['num_attachments'], '</dd>
					<dt><strong>', $txt['attachment_manager_total_avatars'], ':</strong></dt><dd>', $context['num_avatars'], '</dd>
					<dt><strong>', $txt['attachmentdir_size' . ($context['attach_multiple_dirs'] ? '_current' : '')], ':</strong></dt><dd>', $context['attachment_total_size'], ' ', $txt['kilobyte'], '</dd>
					<dt><strong>', $txt['attachment_space' . ($context['attach_multiple_dirs'] ? '_current' : '')], ':</strong></dt><dd>', isset($context['attachment_space']) ? $context['attachment_space'] . ' ' . $txt['kilobyte'] : $txt['attachmentdir_size_not_set'], '</dd>
									<dt><hr /></dt><dd><hr /></dd>
					<dt><strong>', $txt['pmattachment_total'], ':</strong></dt><dd>', $context['num_pmattachments'], '</dd>
					<dt><strong>', $txt['pmattachmentdir_size' . ($context['pmattach_multiple_dirs'] ? '_current' : '')], ':</strong></dt><dd>', $context['pmattachment_total_size'], ' ', $txt['kilobyte'], ' <a href="', $scripturl, '?action=admin;area=manageattachments;sa=pmrepair;', $context['session_var'], '=', $context['session_id'], '">[', $txt['attachment_manager_repair'], ']</a></dd>
					<dt><strong>', $txt['pmattachment_space' . ($context['pmattach_multiple_dirs'] ? '_current' : '')], ':</strong></dt><dd>', isset($context['pmattachment_space']) ? $context['pmattachment_space'] . ' ' . $txt['kilobyte'] : $txt['attachmentdir_size_not_set'], '</dd>
				</dl>
			</div>
			<span class="botslice"><span></span></span>
		</div>
		<div class="cat_bar">
			<h3 class="catbg">', $txt['attachment_integrity_check'], '</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				<form action="', $scripturl, '?action=admin;area=manageattachments;sa=repair;', $context['session_var'], '=', $context['session_id'], '" method="post" accept-charset="', $context['character_set'], '">
					<p>', $txt['attachment_integrity_check_desc'], '</p>
					<input type="submit" name="submit" value="', $txt['attachment_check_now'], '" class="button_submit" />
				</form>
			</div>
			<span class="botslice"><span></span></span>
		</div>
		<div class="cat_bar">
			<h3 class="catbg">', $txt['attachment_pruning'], '</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['attachment_pruning_warning'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['attachment_remove_old'], ' <input type="text" name="age" value="25" size="4" class="input_text" /> ', $txt['days_word'], '<br />
					', $txt['attachment_pruning_message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					<input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="byAge" />
				</form>
				<hr />
				<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['attachment_pruning_warning'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['attachment_remove_size'], ' <input type="text" name="size" id="size" value="100" size="4" class="input_text" /> ', $txt['kilobyte'], '<br />
					', $txt['attachment_pruning_message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					<input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="bySize" />
				</form>
				<hr />
				<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['attachment_pruning_warning'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['attachment_manager_avatars_older'], ' <input type="text" name="age" value="45" size="4" class="input_text" /> ', $txt['days_word'], '<br />
					<input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="avatars" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="byAge" />
				</form>
			</div>
			<span class="botslice"><span></span></span>
		</div>
	<div class="cat_bar">
		<h3 class="catbg"><span class="left"></span>
				', $txt['pmattachment_options'], '
		</h3>
	</div>
	<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">
					<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					', $txt['pmattachment_remove_old'], ' <input type="text" name="age" value="25" size="4" class="input_text" /> ', $txt['days_word'], ' <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmByAge" />
					</form>
					<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					', $txt['pmattachment_remove_size'], ' <input type="text" name="size" id="size" value="100" size="4" class="input_text" /> ', $txt['kilobyte'], ' <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmBySize" />
					</form>
					<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					', $txt['pmattachment_remove_downloads'], ' <input type="text" name="downloads" id="downloads" value="1" size="4" class="input_text" /> ', $txt['pmattachment_downloads_times'], ' <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmByDowns" />
					</form>

					<hr /><form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					<a href="', $scripturl, '?action=helpadmin;help=pmattachments_remove_reported" onclick="return reqWin(this.href);" class="help"><img src="', $settings['images_url'], '/helptopics.gif" border="0" align="left" style="padding-right: 1ex;" /></a>', $txt['pmattachments_remove_reported'], ' <select name="reportedMembers"><option name="all" value="all" SELECTED>', $txt['pmattach_report_all_members'], '</option>';

					if (count($context['pmattach_reported_from']) >= 1)
					{
						echo '<optgroup label="', $txt['pmattach_specific_members'], '">';
						foreach ($context['pmattach_reported_from'] as $key => $reportedFrom)
							echo '<option name="report', $key, '" value="', $reportedFrom, '">', $reportedFrom, '</option>';

						echo '</optgroup>';
					}

					echo '</select> <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmRemoveReported" />
					</form>
					<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments_members'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					<a href="', $scripturl, '?action=helpadmin;help=pmattachments_remove_by_members" onclick="return reqWin(this.href);" class="help"><img src="', $settings['images_url'], '/helptopics.gif" border="0" align="left" style="padding-right: 1ex;" /></a>', $txt['pmattachments_remove_by_members'], ' <select name="fromtoMembers"><option name="from" value="0" SELECTED>', $txt['pmattachments_remove_by_members_from'], '</option><option name="to" value="1">', $txt['pmattachments_remove_by_members_to'], '</option></select> ', $txt['pmattachments_remove_by_members_cont'], ' <input type="text" name="members" id="members" value="" size="25" class="input_text" /> <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmRemoveByMembers" />
					</form>

					<form action="', $scripturl, '?action=admin;area=manageattachments" method="post" accept-charset="', $context['character_set'], '" onsubmit="return confirm(\'', $txt['confirm_delete_pmattachments_all'], '\');" style="margin: 0 0 2ex 0;">
					', $txt['message'], ': <input type="text" name="notice" value="', $txt['attachment_delete_admin'], '" size="40" class="input_text" /><br />
					<a href="', $scripturl, '?action=helpadmin;help=pmattachments_remove_all" onclick="return reqWin(this.href);" class="help"><img src="', $settings['images_url'], '/helptopics.gif" border="0" align="left" style="padding-right: 1ex;" /></a>', $txt['pmattachments_remove_all'], ' <input type="submit" name="submit" value="', $txt['remove'], '" class="button_submit" />
					<input type="hidden" name="type" value="attachments" />
					<input type="hidden" name="', $context['session_var'], '" value="', $context['session_id'], '" />
					<input type="hidden" name="sa" value="pmremoveall" />
					</form>
			</div>
			<span class="botslice"><span></span></span>
		</div>
	</div>
	<br class="clear" />';
}

function template_attachment_repair()
{
	global $context, $txt, $scripturl, $settings;

	// If we've completed just let them know!
	if ($context['completed'])
	{
		echo '
	<div id="manage_attachments">
		<div class="cat_bar">
			<h3 class="catbg">', $txt['repair_attachments_complete'], '</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				', $txt['repair_attachments_complete_desc'], '
			</div>
			<span class="botslice"><span></span></span>
		</div>
	</div>
	<br class="clear" />';
	}

	// What about if no errors were even found?
	elseif (!$context['errors_found'])
	{
		echo '
	<div id="manage_attachments">
		<div class="cat_bar">
			<h3 class="catbg">', $txt['repair_attachments_complete'], '</h3>
		</div>
		<div class="windowbg">
			<span class="topslice"><span></span></span>
			<div class="content">
				', $txt['repair_attachments_no_errors'], '
			</div>
			<span class="botslice"><span></span></span>
		</div>
	</div>
	<br class="clear" />';
	}
	// Otherwise, I'm sad to say, we have a problem!
	else
	{
		echo '
	<div id="manage_attachments">
		<form action="', $scripturl, '?action=admin;area=manageattachments;sa=repair;fixErrors=1;step=0;substep=0;', $context['session_var'], '=', $context['session_id'], '" method="post" accept-charset="', $context['character_set'], '">
			<div class="cat_bar">
				<h3 class="catbg">', $txt['repair_attachments'], '</h3>
			</div>
			<div class="windowbg">
				<span class="topslice"><span></span></span>
				<div class="content">
					<p>', $txt['repair_attachments_error_desc'], '</p>';

		// Loop through each error reporting the status
		foreach ($context['repair_errors'] as $error => $number)
		{
			if (!empty($number))
			echo '
					<input type="checkbox" name="to_fix[]" id="', $error, '" value="', $error, '" class="input_check" />
					<label for="', $error, '">', sprintf($txt['attach_repair_' . $error], $number), '</label><br />';
		}

		echo '		<br />
					<input type="submit" value="', $txt['repair_attachments_continue'], '" class="button_submit" />
					<input type="submit" name="cancel" value="', $txt['repair_attachments_cancel'], '" class="button_submit" />
				</div>
				<span class="botslice"><span></span></span>
			</div>
		</form>
	</div>
	<br class="clear" />';
	}
}

function template_attachment_paths()
{
	template_show_list('attach_paths');
}


function template_pm_attachment_repair()
{
	global $context, $txt, $scripturl;

	// If we've completed just let them know!
	if ($context['completed'])
	{
		echo '
	<table width="100%" cellpadding="4" cellspacing="0" align="center" border="0" class="tborder">
		<tr>
			<td class="titlebg">', $txt['repair_attachments_complete'], '</td>
		</tr><tr>
			<td class="windowbg2" width="100%">
				', $txt['repair_attachments_complete_desc'], '
			</td>
		</tr>
	</table>';
	}
	// What about if no errors were even found?
	elseif (!$context['errors_found'])
	{
		echo '
	<table width="100%" cellpadding="4" cellspacing="0" align="center" border="0" class="tborder">
		<tr>
			<td class="titlebg">', $txt['repair_attachments_complete'], '</td>
		</tr><tr>
			<td class="windowbg2" width="100%">
				', $txt['repair_attachments_no_errors'], '
			</td>
		</tr>
	</table>';
	}
	// Otherwise, I'm sad to say, we have a problem!
	else
	{
		echo '
	<form action="', $scripturl, '?action=admin;area=manageattachments;sa=pmrepair;fixErrors=1;step=0;substep=0;', $context['session_var'], '=', $context['session_id'], '" method="post" accept-charset="', $context['character_set'], '">
	<table width="100%" cellpadding="4" cellspacing="0" align="center" border="0" class="tborder">
		<tr>
			<td class="titlebg">', $txt['repair_attachments'], '</td>
		</tr><tr>
			<td class="windowbg2">
				', $txt['repair_attachments_error_desc'], '
			</td>
		</tr>';

		// Loop through each error reporting the status
		foreach ($context['repair_errors'] as $error => $number)
		{
			if (!empty($number))
			echo '
		<tr class="windowbg2">
			<td>
				<input type="checkbox" name="to_fix[]" id="', $error, '" value="', $error, '" />
				<label for="', $error, '">', sprintf($txt['attach_pmrepair_' . $error], $number), '</label>
			</td>
		</tr>';
		}

		echo '
		<tr>
			<td align="center" class="windowbg2">
				<input type="submit" value="', $txt['repair_attachments_continue'], '" />
				<input type="submit" name="cancel" value="', $txt['repair_attachments_cancel'], '" />
			</td>
		</tr>
	</table>
	</form>';
	}

}

function template_pmattachment_paths()
{
	template_show_list('pmattach_paths');
}


?>