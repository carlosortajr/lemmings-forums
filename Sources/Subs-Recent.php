<?php

/**
 * Simple Machines Forum (SMF)
 *
 * @package SMF
 * @author Simple Machines http://www.simplemachines.org
 * @copyright 2011 Simple Machines
 * @license http://www.simplemachines.org/about/smf/license.php BSD
 *
 * @version 2.0
 */

if (!defined('SMF'))
	die('Hacking attempt...');

/*	!!!

*/

// Get the latest posts of a forum.
function getLastPosts($latestPostOptions)
{
	global $scripturl, $txt, $user_info, $modSettings, $smcFunc, $context;

	// Find all the posts.  Newer ones will have higher IDs.  (assuming the last 20 * number are accessable...)
	// !!!SLOW This query is now slow, NEEDS to be fixed.  Maybe break into two?
	$request = $smcFunc['db_query']('', '
		SELECT
			m.poster_time, ms.subject, m.id_topic, m.id_member, m.id_msg, b.id_board, b.name AS board_name,
			IFNULL(mem.real_name, m.poster_name) AS poster_name, 
			SUBSTRING(m.body, 1, 384) AS body, m.smileys_enabled
		FROM {db_prefix}topics AS t
			INNER JOIN {db_prefix}messages AS m ON (m.id_msg = t.id_last_msg)
			INNER JOIN {db_prefix}boards AS b ON (b.id_board = t.id_board)
			INNER JOIN {db_prefix}messages AS ms ON (ms.id_msg = t.id_first_msg)
			LEFT JOIN {db_prefix}members AS mem ON (mem.id_member = m.id_member)' . (!$user_info['is_guest'] ? '
			LEFT JOIN {db_prefix}log_topics AS lt ON (lt.id_topic = t.id_topic AND lt.id_member = {int:current_member})
			LEFT JOIN {db_prefix}log_mark_read AS lmr ON (lmr.id_board = b.id_board AND lmr.id_member = {int:current_member})' : '') . '
		WHERE t.id_last_msg >= {int:min_message_id}
			AND ' . $user_info['query_wanna_see_board'] . ($modSettings['postmod_active'] ? '
			AND t.approved = {int:is_approved}
			AND m.approved = {int:is_approved}' : '') . '
		ORDER BY t.id_last_msg DESC
		LIMIT ' . $latestPostOptions['number_posts'],
		array(
			'current_member' => $user_info['id'],
			'min_message_id' => $modSettings['maxMsgID'] - 35 * min($latestPostOptions['number_posts'], 5),
			'is_approved' => 1,
		)
	);
	$posts = array();
	while ($row = $smcFunc['db_fetch_assoc']($request))
	{
		// Censor the subject and post for the preview ;).
		censorText($row['subject']);
		censorText($row['body']);

		$row['body'] = strip_tags(strtr(parse_bbc($row['body'], $row['smileys_enabled'], $row['id_msg']), array('<br />' => '&#10;')));
		if ($smcFunc['strlen']($row['body']) > 128)
			$row['body'] = $smcFunc['substr']($row['body'], 0, 128) . '...';

		// Build the array.
		$posts[] = array(
			'board' => array(
				'id' => $row['id_board'],
				'name' => $row['board_name'],
				'href' => $scripturl . '?board=' . $row['id_board'] . '.0',
				'link' => '<a href="' . $scripturl . '?board=' . $row['id_board'] . '.0">' . $row['board_name'] . '</a>'
			),
			'topic' => $row['id_topic'],
			'poster' => array(
				'id' => $row['id_member'],
				'name' => $row['poster_name'],
				'href' => empty($row['id_member']) ? '' : $scripturl . '?action=profile;u=' . $row['id_member'],
				'link' => empty($row['id_member']) ? $row['poster_name'] : '<a href="' . $scripturl . '?action=profile;u=' . $row['id_member'] . '">' . $row['poster_name'] . '</a>'
			),
			'subject' => $row['subject'],
			'short_subject' => shorten_subject($row['subject'], 24),
			'preview' => $row['body'],
			'time' => timeformat($row['poster_time']),
			'timestamp' => forum_time(true, $row['poster_time']),
			'raw_timestamp' => $row['poster_time'],
			'href' => $scripturl . '?topic=' . $row['id_topic'] . '.new;topicseen#new',
			'link' => '<a href="' . $scripturl . '?topic=' . $row['id_topic'] . '.new;topicseen#new" rel="nofollow">' . $row['subject'] . '</a>'
			/*
			'href' => $scripturl . '?topic=' . $row['id_topic'] . '.msg' . $row['id_msg'] . ';topicseen#msg' . $row['id_msg'],
			'link' => '<a href="' . $scripturl . '?topic=' . $row['id_topic'] . '.msg' . $row['id_msg'] . ';topicseen#msg' . $row['id_msg'] . '" rel="nofollow">' . $row['subject'] . '</a>'
			*/
		);
	}
	$smcFunc['db_free_result']($request);

	return $posts;
}

// Callback-function for the cache for getLastPosts().
function cache_getLastPosts($latestPostOptions)
{
	return array(
		'data' => getLastPosts($latestPostOptions),
		'expires' => time() + 60,
		'post_retri_eval' => '
			foreach ($cache_block[\'data\'] as $k => $post)
			{
				$cache_block[\'data\'][$k][\'time\'] = timeformat($post[\'raw_timestamp\']);
				$cache_block[\'data\'][$k][\'timestamp\'] = forum_time(true, $post[\'raw_timestamp\']);
			}',
	);
}

?>