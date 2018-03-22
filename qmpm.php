<?php

$mysql = new mysqli("lemmingsforums.db", "LemmForums", "pmu9xfg2", "LemForums");
$result = $mysql->query('SELECT COUNT(*) AS `count` FROM `lf_pm_recipients` WHERE `id_member` = 142 AND `is_read` = 0');
$row = $result->fetch_assoc();

echo 'QuizMaster has ' . $row['count'] . ' unread private messages.';

?>