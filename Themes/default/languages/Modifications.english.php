<?php
// Version: 2.0; Modifications


// Spoiler Mod
// BBC Strings
$txt['bbc_spoiler'] = 'Insert Spoiler';

// Post View Text
$txt['spoiler_tag_text'] = 'Spoiler';
$txt['spoiler_tag_click_info'] = '(click to show/hide)';
$txt['spoiler_tag_hover_info'] = '(hover to show)';

// Mod Settings
$txt['defaultSpoilerStyle'] = 'Spoiler Mode';
$txt['spoiler_tag_onhoverovershow'] = 'Show on Hover';
$txt['spoiler_tag_onlinkclickshow'] = 'Show on Link Click';
$txt['spoiler_tag_onbuttonclickshow'] = 'Show on Button Click';


// Extra Settings String for per-theme selection
$txt['spoiler_tag_label'] = 'Spoiler Mode';
$txt['spoiler_tag_desc'] = 'Choose how spoilers will display on the theme.';
$txt['spoiler_tag_default'] = '(use global default spoiler mode)';

//
// PM Attachments MOD Begin
//

global $scripturl;

$txt['attach_restrict_attachmentNumPerPMLimit'] = '%1$d per pm';
$txt['attach_restrict_attachmentPMLimit'] = 'maximum total size %1$dKB';
$txt['attach_restrict_pmAttachmentSizeLimit'] = 'maximum individual size %1$dKB';

// PM Attachments by Mail
$txt['pmattachments_mail'] = 'The following are direct links to all of the attachments that were included in this Personal Message (Please note, you must be logged in to the site in order to be able to download them):';

// Settings Titles
$txt['pmattachment_manager_settings'] = 'PM Attachment Settings';

// Maintenance Settings
$txt['pmattachment_options'] = 'PM File Attachment Options';
$txt['pmattachment_remove_old'] = 'Remove PM attachments older than';
$txt['pmattachment_remove_size'] = 'Remove PM attachments larger than';
$txt['pmattachment_remove_downloads'] = 'Remove PM attachments downloaded/viewed atleast';
$txt['pmattachment_downloads_times'] = 'time(s), by all recipients';
$txt['pmattachments_remove_by_members'] = 'Remove All PM Attachments sent';
$txt['pmattachments_remove_by_members_from'] = 'from';
$txt['pmattachments_remove_by_members_to'] = 'to';
$txt['pmattachments_remove_by_members_cont'] = 'the following members:';
$txt['pmattachments_remove_reported'] = 'Remove PM Attachments reported from the following members:';
$txt['pmattach_report_all_members'] = 'All Members';
$txt['pmattach_specific_members'] = 'Specific Members';
$txt['pmattachments_remove_all'] = 'Remove All PM Attachments by ALL Members!';

// Reporting for DUTY, SIR!
$txt['pm_report_attachments_sent'] = 'The following are all attachments that were sent to this user(s):';

// Settings Options
$txt['pmAttachmentEnable'] = 'PM Attachments mode';
$txt['pmAttachmentEnable_deactivate'] = 'Disable attachments';
$txt['pmAttachmentEnable_enable_all'] = 'Enable all attachments';
$txt['pmAttachmentEnable_disable_new'] = 'Disable new attachments';
$txt['pmAttachmentCheckExtensions'] = 'Check attachment\'s extension';
$txt['pmAttachmentExtensions'] = 'Allowed attachment extensions';
$txt['pmAttachmentShowImages'] = 'Display image attachments as pictures under PM\'s';
$txt['pmAttachmentEncryptFilenames'] = 'Encrypt stored filenames';
$txt['pmAttachmentUploadDir'] = 'PM Attachments directory<div class="smalltext"><a href="' . $scripturl . '?action=admin;area=manageattachments;sa=pmattachpaths">Configure multiple PM attachment directories</a></div>';
$txt['pmAttachmentUploadDir_multiple'] = 'PM Attachments directory';
$txt['pmAttachmentUploadDir_multiple_configure'] = '<a href="' . $scripturl . '?action=admin;area=manageattachments;sa=pmattachpaths">[Configure multiple PM attachment directories]</a>';
$txt['pmAttachmentDirSizeLimit'] = 'Max attachment folder space<div class="smalltext">(0 for no limit)</div>';
$txt['attachmentPMLimit'] = 'Max attachment size per PM<div class="smalltext">(0 for no limit)</div>';
$txt['pmAttachmentSizeLimit'] = 'Max size per attachment<div class="smalltext">(0 for no limit)</div>';
$txt['attachmentNumPerPMLimit'] = 'Max number of attachments per PM<div class="smalltext">(0 for no limit)</div>';
$txt['pmAttachmentThumbnails'] = 'Resize images when showing under PM\'s';
$txt['pmAttachmentThumbWidth'] = 'Maximum width of thumbnails';
$txt['pmAttachmentThumbHeight'] = 'Maximum height of thumbnails';

$txt['pmattach_dir_does_not_exist'] = 'Does Not Exist';
$txt['pmattach_dir_not_writable'] = 'Not Writable';
$txt['pmattach_dir_files_missing'] = 'Files Missing (<a href="' . $scripturl . '?action=admin;area=manageattachments;sa=pmrepair;sesc=%1$s">Repair</a>)';
$txt['pmattach_dir_unused'] = 'Unused';
$txt['pmattach_dir_ok'] = 'OK';

$txt['pmattach_path_manage'] = 'Manage Attachment Paths';
$txt['pmattach_paths'] = 'Attachment Paths';
$txt['pmattach_current_dir'] = 'Current Directory';
$txt['pmattach_path'] = 'Path';
$txt['pmattach_current_size'] = 'Current Size (KB)';
$txt['pmattach_num_files'] = 'Files';
$txt['pmattach_dir_status'] = 'Status';
$txt['pmattach_add_path'] = 'Add Path';
$txt['pmattach_path_current_bad'] = 'Invalid current attachment path.';

$txt['pmattachment_total'] = 'Total PM Attachments';
$txt['pmattachmentdir_size'] = 'Total Size of PM Attachment Directory';
$txt['pmattachmentdir_size_current'] = 'Total Size of Current PM Attachment Directory';
$txt['pmattachment_space'] = 'Total Space Available in PM Attachment Directory';
$txt['pmattachment_space_current'] = 'Total Space Available in Current PM Attachment Directory';

// Deletion of PM Attachments
$txt['confirm_delete_pmattachments_all'] = 'Are you sure you want to delete all PM attachments?';
$txt['confirm_delete_pmattachments'] = 'Are you sure you want to delete the selected PM attachments?';
$txt['confirm_delete_pmattachments_members'] = 'Are you sure you want to delete all PM attachments sent, either, from or to the following member(s)?';

// Error Handling
$txt['pm_attach_not_allowed'] = 'Sorry, you are not allowed to send attachments to other users via Personal Messages!';
$txt['attach_pmrepair_missing_thumbnail_parent'] = '%d thumbnails are missing a parent attachment';
$txt['attach_pmrepair_parent_missing_thumbnail'] = '%d parents are flagged as having thumbnails but don\'t';
$txt['attach_pmrepair_file_missing_on_disk'] = '%d attachments have an entry but no longer exist on disk';
$txt['attach_pmrepair_file_wrong_size'] = '%d attachments are being reported as the wrong filesize';
$txt['attach_pmrepair_file_size_of_zero'] = '%d attachments have a size of zero on disk. (These will be deleted)';
$txt['attach_pmrepair_attachment_no_pm'] = '%d attachments no longer have a personal message associated with them';
$txt['attach_pmrepair_wrong_folder'] = '%d attachments are in the wrong folder';
$txt['pm_cant_upload_type'] = 'You cannot upload that type of file. The only allowed extensions are';
$txt['pm_restricted_filename'] = 'That is a restricted filename. Please try a different filename.';
$txt['cannot_pm_view_attachments'] = 'You are not allowed to access this section';
$txt['pmattach_no_selection'] = 'Strange thing happened, nothing was selected!';

// PM Attachment Permissions...
$txt['permissionname_pm_view_attachments'] = 'View PM attachments';
$txt['permissionhelp_pm_view_attachments'] = 'PM Attachments are files that are attached to personal messages. This feature can be enabled and configured in \'Attachments and Avatars - PM Attachment Settings\'. Since PM attachments are not directly accessed, you can protect them from being downloaded by users that don\'t have this permission.';
$txt['permissionname_pm_post_attachments'] = 'Upload PM attachments';
$txt['permissionhelp_pm_post_attachments'] = 'PM Attachments are files that are attached to personal messages. One personal message can contain multiple attachments. Unchecking this completely disables these users from being able to upload attachments in personal messages.';


//
// PM Attachments MOD End
//



//	Text for the Recent Topics On Board Index.
$txt['RecentTopicsOnBoardIndex_recenttopics'] = 'Recently Updated Topics';

?>